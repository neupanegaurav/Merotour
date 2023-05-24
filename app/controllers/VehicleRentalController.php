<?php

class VehicleRentalController extends BaseController {
    
    public function getFrontPage() {
        
        $entries = VehicleRental::paginate(10);
        
        return View::make('frontend.vehicle_rentals.index', compact('entries'));

    }
 
    public function getVehicleOrder($id) {
                
        if (is_null($entry = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected vehicle rental.");
		}
        
        return View::make('frontend.vehicle_rentals.order', compact('entry'));
            
    }
    
    public function postVehicleOrder() {

        // Declare the rules for the form validation
		$rules = array(
            'check_in'        => 'required',
            'check_out'       => 'required',
            'total_days'      => 'required|Integer',
            'total_kms'       => 'required|Integer',
            'id'              => 'required',
            'payment_options' => 'required'
		);
	
		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		if (is_null($vehicle_rental = VehicleRental::find(Input::get('id'))))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected package.");
		}

		if ($vehicle_rental->stock <= 0) {
			return Redirect::back()->with('error', "The selected item's stock is finished. Please try another item.");
		}

		$payment_options = Input::get('payment_options');

		// Create a new category
		$post = new Orders;
                
        $userdetails = Sentry::getUser();

        $old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		} else {
			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}

		// Update the blog post data
        $post->category_name    = e('Vacation Rentals');
        $post->package_name     = e($vacation_rental->name);              
        $post->package_id       = e(Input::get('id'));
        $post->user_id          = e($userdetails->id);
        $post->check_in         = e(Input::get('check_in'));
        $post->check_out        = e(Input::get('check_out'));
        $post->invoice_no       = e($invoice_no);
        $post->status           = e('Pending');

        $total_rent   = (int)e(Input::get('total_rent'));
        $total_strickthrow = (int)e(Input::get('total_strickthrow'));

        $rent_price  = $vacation_rental->rent_price;
        $strickthrow_price  = $vacation_rental->strickthrow_price;

        $total_rent_price = ($rent_price) * ($total_rent);
        $total_strickthrow_price = ($strickthrow_price) * ($total_strickthrow);

        $total_usd = $total_rent_price + $total_strickthrow_price;

        //For amount
        $currency = Session::get('currency');

        $total_npr = ceil($total_usd * FXRate::where('iso_code', 'USD')->first()->exchange_rate);   

        $post->total_rent        = $total_rent;
        $post->total_strickthrow = $total_strickthrow;
        $post->currency          = e($currency);
        $post->amount            = e($total_usd);   

        // Subtract the stock number by 1 if stock is set.
        if (!empty($vacation_rental->stock)) {
            $vacation_rental->stock = $vacation_rental->stock - 1;
        }

		// Was the order created?
		if($post->save() and $vehicle_rental->save())
		{
			/**
             * Send New Order Email to administrator
             */            
            // Data to be used on the email view
            $data = array(
                'user'          => $userdetails,
                'invoice_no'    => $invoice_no,
                'category'      => 'Vehicle Rentals',
            );
            
            //Send Mail
            Mail::queue('emails.booking-blackeye', $data, function($m) use ($invoice_no)
            {
                $m->from('support@blackeyetravels.com', 'Blackeye Travels');
                $m->to('booking@blackeyetravels.com', 'Booking Department');
                $m->subject('New Order Placed #' . $invoice_no );
            });

            /**
             * Check for the requested payment options and deduct the user balance
             * @var $payment_options
             */
            if ($payment_options == 'account_balance') {

                $entry = Funds::where('user_id', Sentry::getUser()->id)->first();
                $balance = $entry->balance;

                if($balance and $balance >= $total_npr) {
                    $new_balance = $balance - $total_npr;

                    $entry->balance = $new_balance;

                    if(!$entry->save()) {
                        return Redirect::back()->with('error', 'Balance could not be updated.');
                    }

                    return Redirect::back()->with('success', "Your order has been created");
                
                } else {
                    return Redirect::back()->with('error', 'Insufficient Balance');

                }
            }

            if ($payment_options == 'credit_balance') {

                $entry = Funds::where('user_id', Sentry::getUser()->id)->first();

                if(!empty($entry->credit_balance) and $entry->credit_balance >= $total_npr) {

                    $new_credit_balance = $entry->credit_balance - $total_npr;

                    $entry->credit_balance = $new_credit_balance;

                    $entry->used_credit_balance = $entry->used_credit_balance + $total_npr;

                    if(!$entry->save()) 
                    {
                        return Redirect::back()->with('error', 'Credit balance could not be updated.');
                    }

                    $user = Sentry::getUser();

                    $test = Input::get('backend');

                    /*$post = new CreditLimitTransactions;

                    $post->category_name    = e('Package Tours');
                    $post->package_name     = e($hotel->name);              
                    $post->package_id       = e(Input::get('id'));
                    $post->user_id          = e($userdetails->id);
                    $post->date             = e(Input::get('date'));
                    $post->group_size       = e(Input::get('group_size'));
                    $post->invoice_no       = e($invoice_no);
                    $post->status           = e('Pending');

                    //For amount
                    $currency = Session::get('currency');

                    if($currency == 'usd') 
                    {
                        $amount = $hotel->cost;
                        $total = ceil($hotel->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
                    }
                    elseif ($currency == 'npr') 
                    {
                        $amount = ceil($hotel->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
                        $total = $amount;
                    }

                    $post->currency = e($currency);
                    $post->amount   = e($amount);   

                    if(!$post->save()) 
                    {
                        return Redirect::back()->with('error', 'Credit History could not be updated.');
                    }*/
             
                    return Redirect::back()->with('success', "Your order has been created");    
              
                } else {
                    return Redirect::back()->with('error', 'Insufficient Credit Balance');

                }           
            }

	        elseif($payment_options == 'paypal') 
	        {
		        $user = Sentry::getUser();
		        $_GET['sandbox'] = 1;

		        //require_once('paypal/library.php'); // include the library file
				define('EMAIL_ADD', 'sameernyaupane@outlook.com'); // define any notification email
				define('PAYPAL_EMAIL_ADD', 'nyaupane5-facilitator@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
				require_once('paypal/paypal_class.php');

				$p 				= new paypal_class(); // paypal class
				$p->admin_mail 	= EMAIL_ADD; // set notification email

				//mysql_query("INSERT INTO `purchases` (`invoice`, `product_id`, `product_name`, `product_quantity`, `product_amount`, `payer_fname`, `payer_lname`, `payer_address`, `payer_city`, `payer_state`, `payer_zip`, `payer_country`, `payer_email`, `payment_status`, `posted_date`) VALUES ('".$_POST["invoice"]."', '".$_POST["product_id"]."', '".$_POST["product_name"]."', '".$_POST["product_quantity"]."', '".$_POST["product_amount"]."', '".$_POST["payer_fname"]."', '".$_POST["payer_lname"]."', '".$_POST["payer_address"]."', '".$_POST["payer_city"]."', '".$_POST["payer_state"]."', '".$_POST["payer_zip"]."', '".$_POST["payer_country"]."', '".$_POST["payer_email"]."', 'pending', NOW())");
				
				$this_script = route('paypal-redirect');
				
				$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
				$p->add_field('cmd', '_cart'); // cmd should be _cart for cart checkout
				$p->add_field('upload', '1');
				$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over
				$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
				$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
				$p->add_field('currency_code', 'USD');
				$p->add_field('invoice', $invoice_no);
				$p->add_field('item_name_1', $vehicle_rental->name);
				$p->add_field('item_number_1', $vehicle_rental->id);
				$p->add_field('quantity_1', '1');
				$p->add_field('amount_1', $total_usd);
				$p->add_field('first_name', $user->first_name);
				$p->add_field('last_name', $user->last_name);
				$p->add_field('address1', 'Address');
				$p->add_field('city', 'Kathmandu');
				$p->add_field('state', 'NRS');
				$p->add_field('country', 'Nepal');
				$p->add_field('zip', '12345');
				$p->add_field('email', $user->email);
				$p->submit_paypal_post(); // POST it to paypal    

                exit();

	        }

			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your order has been created");
		}



		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Order coudn't be created");           
    }    
    
    public function getVehicleView($id) {
      
        if (is_null($entry = VehicleRental::find($id))) {
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected vehicle rental.");
		}

        //Countries list
        $country = Country::where('id', $entry->country)->first();

        if (!empty($entry->area_city)) {
            $city = Location::where('country', $country->value)->where('city', $entry->area_city)->first();

        } else {
            $city = null;
        }

		$product_comments = ProductComment::where('product_type', 'Vehicle Rentals')->where('product_id', $id)->get();

		// Show the page
		return View::make('frontend.vehicle_rentals.show', compact('entry', 'product_comments', 'city'));
        
    }
    
    
    public function getIndex() {
        
 		if (!Sentry::getUser()->hasAccess('admin')) {
                
                $userid = Sentry::getUser()->id;
            
            
                $entries = VehicleRental::where('added_by', $userid )->paginate(10);
								$slug = 'Vehicle Rental';                                
                
            } else {

            	if(Request::is(Session::get('account_type') . '/vehicle_rentals/dealsetup')) 
			    	{

			    	 $entries = VehicleRental::where('deal', 1)->paginate(10);

			    	 $slug = 'Vehicle Rental Deal Setup';

			    		
			    	} else {

			    		$slug = 'Vehicle Rental';

			    		$entries = VehicleRental::paginate(10);

			    	}

            }
        
        
        return View::make('backend.vehicle_rentals.index', compact('entries', 'slug'));
        
      
    }
          
    
    public function getCreate()
	{
        //Countries list

		$countries = Country::all();
         
		// Show the page
		return View::make('backend.vehicle_rentals.create', compact('countries'));
                   
                
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
            'name'              => 'required',
            'short_description' => 'required',
            'vehicle_from'      => 'required',
            'vehicle_to'        => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        // Add new Vehicle Rental        
                
        $post = new VehicleRental;
            
		// Update the vehicle post data
     
        //Vehicle Info 
        $post->name              = e(Input::get('name'));
        $post->type_of_service   = e(Input::get('type_of_service'));
        $post->vehicle_type      = e(Input::get('vehicle_type'));              
        $post->enabled           = e(Input::get('enabled'));
        $post->short_description = e(Input::get('short_description'));
        $post->description       = e(Input::get('description'));


        //Picture Upload
        $file = Input::file('uploaded_file');
        
        if(isset($file)) {                           
            $filenamepart = time() . '-' . Str::random(20);
        
            $big_filemove = $file->move('assets/img/uploads/vehicle_rentals',  $filenamepart . '.' . $file->getClientOriginalExtension());

            $img = Image::make('assets/img/uploads/vehicle_rentals/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
            $img->save('assets/img/uploads/vehicle_rentals/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
        
            
            $post->photo        =  $filenamepart . '.' . $file->getClientOriginalExtension();

            $post->thumb        =  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();    
        } else {
            $post->thumb     = 'default.png';
      
            $post->photo     = "default.png";         
        }

        //Price Information
        $post->price_per_day   = e(Input::get('price_per_day'));
        $post->price_per_hour  = e(Input::get('price_per_hour'));
        $post->price_per_km    = e(Input::get('price_per_km'));

        //Address Information
        $post->country      = e(Input::get('country'));
        $post->vehicle_from = e(Input::get('vehicle_from'));
        $post->vehicle_to   = e(Input::get('vehicle_to'));
        $post->state        = e(Input::get('state'));
        $post->area_city    = e(Input::get('area_city'));

        //Feature Information
        $post->passengers             = e(Input::get('passengers'));
        $post->large_suitcase         = e(Input::get('large_suitcase'));
        $post->small_suitcase         = e(Input::get('small_suitcase'));
        $post->automatic_transmission = Input::has('automatic_transmission') ? 1 : 0;
        $post->air_conditioning       = Input::has('air_conditioning') ? 1 : 0;
        $post->sixteen_km_per_liters  = Input::has('sixteen_km_per_liters') ? 1 : 0;

        //Information of Availabilities
        $post->stock          = e(Input::get('stock'));
        $post->effective_from = e(Input::get('effective_from'));
        $post->expire_on      = e(Input::get('expire_on'));

        //Discounts
        $post->discount_percentage_agents       = e(Input::get('discount_percentage_agents'));
        $post->discount_percentage_distributors = e(Input::get('discount_percentage_distributors'));

        // Added by User id
        $post->added_by                         = Sentry::getUser()->id;

        // Was the blog post created?
		if($post->save())
		{

			//Multiple Images
            $images_json = Input::get('multiple_images_json');

            $images_array = json_decode($images_json);

            if (empty($images_array)) {
                $images_array = [];
            }

            foreach ($images_array as $guid) {
                
                $file = Input::file('uploaded_file_'.$guid);

                if(isset($file)) 
                {
                    $p_multiple_images = new MultipleImages;   

                    $filenamepart = time() . '-' . Str::random(20);

                    $big_filemove = $file->move('assets/img/uploads/vehicle_rentals/',  $filenamepart . '.' . $file->getClientOriginalExtension());

                    $img = Image::make('assets/img/uploads/vehicle_rentals/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
                    $img->save('assets/img/uploads/vehicle_rentals/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
              
                    $p_multiple_images->category_name = 'Vehicle Rentals';
                    $p_multiple_images->product_id    = $post->id;  
                    $p_multiple_images->image_guid    = $guid;  
                    $p_multiple_images->name          = $filenamepart. '.' . $file->getClientOriginalExtension(); 
                    $p_multiple_images->thumb         =  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();
                    
                    //Send query to database
                    $p_multiple_images->save();  
                }
            }
            // Multiple Images End

			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Vehicle has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Vehicle coudn't be created");
                
		
	}
        
        
    public function getEdit($id)
	{
             
		if (is_null($entry = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}

		//If user is not an admin, check for permission
		if (Session::get('account_type') != 'admin') {
			$user_id = Sentry::getUser()->id;

			if ($entry->added_by != $user_id) {
				return Redirect::to(route('dashboard'))->with('error', 'You do not have sufficient privilege.');
			}
		}

		//Countries list
        $countries = Country::all();

        $country = Country::where('id', $entry->country)->first();

        $cities = Location::where('country', $country->value)->get();

		$multiple_images = MultipleImages::where('category_name', 'Vehicle Rentals' )->where('product_id', $entry->id)->get();

		// Show the page
		return View::make('backend.vehicle_rentals.edit', compact('entry', 'countries', 'cities', 'multiple_images'));
                              
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id)
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required',
			'short_description' => 'required',
            'uploaded_file' => 'image'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        if (is_null($post = VehicleRental::find($id))){
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
    	}

		//If user is not an admin, check for permission
		if (Session::get('account_type') != 'admin') {
			$user_id = Sentry::getUser()->id;

			if ($post->added_by != $user_id) {
				return Redirect::to(route('dashboard'))->with('error', 'You do not have sufficient privilege.');
			}
		}

        // Update the vehicle post data
     
        //Vehicle Info 
        $post->name              = e(Input::get('name'));
        $post->type_of_service   = e(Input::get('type_of_service'));
        $post->vehicle_type      = e(Input::get('vehicle_type'));              
        $post->enabled           = e(Input::get('enabled'));
        $post->short_description = e(Input::get('short_description'));
        $post->description       = e(Input::get('description'));


        //Picture Upload
        $file = Input::file('uploaded_file');

        if(isset($file)) 
        {                 
          $filenamepart = time() . '-' . Str::random(20);

      		$big_filemove = $file->move('assets/img/uploads/vehicle_rentals/',  $filenamepart . '.' . $file->getClientOriginalExtension());

          $img = Image::make('assets/img/uploads/vehicle_rentals/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
          $img->save('assets/img/uploads/vehicle_rentals/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
      
          
          $post->photo     	=  $filenamepart . '.' . $file->getClientOriginalExtension();

          $post->thumb 		=  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();	                      
        }            

		//Price Information
        $post->price_per_day   = e(Input::get('price_per_day'));
        $post->price_per_hour  = e(Input::get('price_per_hour'));
        $post->price_per_km    = e(Input::get('price_per_km'));

        //Address Information
        $post->country      = e(Input::get('country'));
        $post->vehicle_from = e(Input::get('vehicle_from'));
        $post->vehicle_to   = e(Input::get('vehicle_to'));
        $post->state        = e(Input::get('state'));
        $post->area_city    = e(Input::get('area_city'));

        //Feature Information
        $post->passengers             = e(Input::get('passengers'));
        $post->large_suitcase         = e(Input::get('large_suitcase'));
        $post->small_suitcase         = e(Input::get('small_suitcase'));
        $post->automatic_transmission = Input::has('automatic_transmission') ? 1 : 0;
        $post->air_conditioning       = Input::has('air_conditioning') ? 1 : 0;
        $post->sixteen_km_per_liters  = Input::has('sixteen_km_per_liters') ? 1 : 0;

        //Information of Availabilities
        $post->stock          = e(Input::get('stock'));
        $post->effective_from = e(Input::get('effective_from'));
        $post->expire_on      = e(Input::get('expire_on'));

        //Discounts
        $post->discount_percentage_agents       = e(Input::get('discount_percentage_agents'));
        $post->discount_percentage_distributors = e(Input::get('discount_percentage_distributors'));

        // Added by User id
        $post->added_by                         = Sentry::getUser()->id;
		
		

		// Was the blog post created?
		if($post->save())
		{
		    //Multiple Images
            $images_delete_json = Input::get('multiple_images_delete_json');

            $images_delete_array = json_decode($images_delete_json);

            if (empty($images_delete_array)) {
                $images_delete_array = [];
            }
            
            foreach ($images_delete_array as $guid) {

                if (!is_null($multiple_entry = MultipleImages::where('category_name', 'Vehicle Rentals' )->where('product_id', $id)->where('image_guid', $guid)->first() ) ) {
                    $multiple_entry->delete();
                }
            }

            $images_json = Input::get('multiple_images_json');

            $images_array = json_decode($images_json);

            if (empty($images_array)) {
                $images_array = [];
            }

            foreach ($images_array as $guid) {

                $file = Input::file('uploaded_file_'.$guid);

                if(isset($file)) 
                {

                    if (!is_null($multiple_entry = MultipleImages::where('category_name', 'Vehicle Rentals' )->where('product_id', $id)->where('image_guid', $guid)->first() ) ) {
                        
                        $p_multiple_images = $multiple_entry;

                        unlink('assets/img/uploads/vehicle_rentals/'. $p_multiple_images->name);
                        unlink('assets/img/uploads/vehicle_rentals/'. $p_multiple_images->thumb);

                    } else {
                        $p_multiple_images = new MultipleImages;   
                    }


                    $filenamepart = time() . '-' . Str::random(20);

                    $big_filemove = $file->move('assets/img/uploads/vehicle_rentals/',  $filenamepart . '.' . $file->getClientOriginalExtension());

                    $img = Image::make('assets/img/uploads/vehicle_rentals/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
                    $img->save('assets/img/uploads/vehicle_rentals/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
              
                    $p_multiple_images->category_name = 'Vehicle Rentals';
                    $p_multiple_images->product_id    = $post->id;  
                    $p_multiple_images->image_guid    = $guid;  
                    $p_multiple_images->name          = $filenamepart. '.' . $file->getClientOriginalExtension(); 
                    $p_multiple_images->thumb         =  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();
                    
                    //Send query to database
                    $p_multiple_images->save();  
                }
            }


            // Multiple Images End

			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Vehicle updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update package.");
	
	}
   
    
    public function getDelete($id)
	{
        
         if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_delete') ))
                {
		// Check if the blog post exists
		if (is_null($entry = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete package.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Vehicle deleted successfully");
                
                
                  }

                else {

                    $message = "Sorry. You do not have permissions to view this page. Please contact the administrator for more information";

                    return View::make('backend.info', compact('message'));


                }
	}
    
    
    
    
}
