<?php

class HotelController extends BaseController {
    
    public function getFrontPage()
    {

        $entries = Hotel::paginate(6);       
        return View::make('frontend.hotels.index', compact('entries'));
    }
    
    public function getHotelView($id) 
    {
        if (is_null($entry = Hotel::find($id)))
    	{
    		// Redirect to the blogs management page
    		return Redirect::back()->with('error', "Couldn't find the selected hotel.");
    	}

    	$product_comments = ProductComment::where('product_type', 'Package Tours')->where('product_id', $id)->get();

    	// Show the page
    	return View::make('frontend.hotels.show', compact('entry', 'id', 'product_comments'));    
    }

    public function getHotelOrder($id) 
    {   	
        if (is_null($entry = Hotel::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected hotel.");
		}
        
        return View::make('frontend.hotels.order', compact('entry'));    
    }
    
    public function postHotelOrder() 
    {
    	      
        // Declare the rules for the form validation
		$rules = array(
            'check_in'       => 'required',
            'check_out'      => 'required',
            'total_adults'   => 'required|Integer',
            'total_children' => 'required|Integer',
            'total_infants'  => 'required|Integer',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		if (is_null($hotel = Hotel::find(Input::get('id'))))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected hotel.");
		}

		if ($hotel->stock <= 0) {
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
        $post->category_name    = e('Hotels');
		$post->package_name  	= e($hotel->name);              
        $post->package_id       = e(Input::get('id'));
        $post->user_id       	= e($userdetails->id);
		$post->check_in         = e(Input::get('check_in'));
        $post->check_out        = e(Input::get('check_out'));
		$post->invoice_no       = e($invoice_no);
		$post->status           = e('Pending');

		$total_adults   = (int)e(Input::get('total_adults'));
        $total_children = (int)e(Input::get('total_children'));
        $total_infants  = (int)e(Input::get('total_infants'));


        $adult_price  = $hotel->adult_price;
        $child_price  = $hotel->child_price;
        $infant_price = $hotel->infant_price;

        $total_adult_price = ($adult_price) * ($total_adults);
        $total_child_price = ($child_price) * ($total_children);
        $total_infant_price = ($infant_price) * ($total_infants);  

        $total_usd = $total_adult_price + $total_child_price + $total_infant_price;

        //For amount
        $currency = Session::get('currency');

        $total_npr = ceil($total_usd * FXRate::where('iso_code', 'USD')->first()->exchange_rate);   

        $post->total_adults   = $total_adults;
        $post->total_children = $total_children;
        $post->total_infants   = $total_infants;
        $post->currency       = e($currency);
        $post->amount         = e($total_usd);  	

		// Subtract the stock number by 1 if stock is set.
		if (!empty($hotel->stock)) {
			$hotel->stock = $hotel->stock - 1;
		}

		// Was the blog post created?
		if($post->save() and $hotel->save())
		{
            /**
             * Send New Order Email to administrator
             */            
            // Data to be used on the email view
            $data = array(
                'user'          => $userdetails,
                'invoice_no'    => $invoice_no,
                'category'      => 'Hotels',
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

		        require_once('paypal/library.php'); // include the library file
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
				$p->add_field('item_name_1', $hotel->name);
				$p->add_field('item_number_1', $hotel->id);
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
	        }

			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your order has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Order coudn't be created");           
    }
           
    public function getIndex() {
        
		if (!Sentry::getUser()->hasAccess('admin')) {
	      
      $userid = Sentry::getUser()->id;
  
      $entries = Hotel::where('added_by', $userid )->paginate(10);

      $slug = 'Hotels';                 
	  } else {
		  if(Request::is(Session::get('account_type') . '/hotels/dealsetup')) 
			{

			 $entries = Hotel::where('deal', 1)->paginate(10);

			 $slug = 'Hotels Deal Setup';

				
			} else {

				$slug = 'Hotels';

				$entries = Hotel::paginate(10);

			}
	 	}
	      
		return View::make('backend.hotels.index', compact('entries', 'slug')); 
  }
          
    
  public function getCreate()
	{
        //Countries list
		$countries = Country::all();
        
		// Show the page
		return View::make('backend.hotels.create', compact('countries'));
	}

        
    public function postCreate()
	{	
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                   
        $post = new Hotel;
                  

		// Add the hotel data
     
        //General Information
        $post->name              = e(Input::get('name'));
        $post->title             = e(Input::get('title'));
        $post->grade             = e(Input::get('grade'));
        $post->status            = e(Input::get('status'));
        $post->added_by          = e(Input::get('added_by'));              
        $post->hotels_group      = e(Input::get('hotels_group'));
        $post->business_type     = e(Input::get('business_type'));
        $post->category_tree     = e(Input::get('category_tree'));
        $post->room_type         = e(Input::get('room_type'));
        $post->short_description = e(Input::get('short_description'));
        $post->description       = e(Input::get('description'));

        //Picture Upload
        $file = Input::file('uploaded_file');
        
        if( isset($file)) {               
        
        $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();

        $filemove = $file->move('assets/img/uploads/hotels',  $filename);
        
        $post->photo     = e($filename);
        } else {
            
            $post->photo     = e("default.png");
            $post->thumb     = e("thumb.png");
            
        } 

        //Showroom Information
        $post->country              = e(Input::get('country'));
        $post->state                = e(Input::get('state'));
        $post->state                = e(Input::get('state'));
        $post->area_city            = e(Input::get('area_city'));
        $post->location_of_hotel    = e(Input::get('location_of_hotel'));
        $post->building_name        = e(Input::get('building_name'));
        $post->building_number      = e(Input::get('building_number'));
        $post->telephone            = e(Input::get('telephone'));
        $post->fax                  = e(Input::get('fax'));
        $post->hotels_email_address = e(Input::get('hotels_email_address'));
        $post->post_code            = e(Input::get('post_code'));
        $post->address              = e(Input::get('address'));

        //Information of Availabilities
        $post->stock          = e(Input::get('stock'));
        $post->effective_from = e(Input::get('effective_from'));
        $post->expire_on      = e(Input::get('expire_on'));

        //Summary Information
        $post->distance_from_airport     = e(Input::get('distance_from_airport'));
        $post->distance_from_city_market = e(Input::get('distance_from_city_market'));
        $post->pet_allow                 = e(Input::get('pet_allow'));
        $post->payment_option            = e(Input::get('payment_option'));
        $post->internet_information      = e(Input::get('internet_information'));
        $post->parking_information       = e(Input::get('parking_information'));

        //Price and Payment Information
        $post->adult_price         = e(Input::get('adult_price'));
        $post->child_price         = e(Input::get('child_price'));
        $post->infant_price        = e(Input::get('infant_price'));
        $post->payment_description = e(Input::get('payment_description'));

        //Discounts
        $post->discount_percentage_agents       = e(Input::get('discount_percentage_agents'));
        $post->discount_percentage_distributors = e(Input::get('discount_percentage_distributors'));        
       
        //Profile Information
        $post->information              = e(Input::get('information'));
        $post->general_information      = e(Input::get('general_information'));
        $post->services                 = e(Input::get('services'));
        $post->surroundings_information = e(Input::get('surroundings_information'));
        $post->other_information        = e(Input::get('other_information'));

        //Policy Information
        $post->policies             = e(Input::get('policies'));
        $post->terms_and_conditions = e(Input::get('terms_and_conditions'));
        $post->privacy_policy       = e(Input::get('privacy_policy'));
        $post->cancellation_policy  = e(Input::get('cancellation_policy'));

        // Hotel Property Options
        $post->ada_accessible                 = Input::has('ada_accessible') ? 1 : 0;
        $post->adults_only                    = Input::has('adults_only') ? 1 : 0;
        $post->airport_shuttle                = Input::has('airport_shuttle') ? 1 : 0;
        $post->beach_front                    = Input::has('beach_front') ? 1 : 0;
        $post->breakfast                      = Input::has('breakfast') ? 1 : 0;
        $post->business_center                = Input::has('business_center') ? 1 : 0;
        $post->business_ready                 = Input::has('business_ready') ? 1 : 0;
        $post->car_rental_counter             = Input::has('car_rental_counter') ? 1 : 0;
        $post->conventions                    = Input::has('conventions') ? 1 : 0;
        $post->dataport                       = Input::has('dataport') ? 1 : 0;
        $post->dining                         = Input::has('dining') ? 1 : 0;
        $post->dry_clean                      = Input::has('dry_clean') ? 1 : 0;
        $post->eco_certified                  = Input::has('eco_certified') ? 1 : 0;
        $post->executive_floors               = Input::has('executive_floors') ? 1 : 0;
        $post->family_plan                    = Input::has('family_plan') ? 1 : 0;
        $post->fitness_center                 = Input::has('fitness_center') ? 1 : 0;
        $post->free_local_calls               = Input::has('free_local_calls') ? 1 : 0;
        $post->free_parking                   = Input::has('free_parking') ? 1 : 0;
        $post->free_shuttle                   = Input::has('free_shuttle') ? 1 : 0;
        $post->free_wifi_in_meeting_rooms     = Input::has('free_wifi_in_meeting_rooms') ? 1 : 0;
        $post->free_wifi_in_public_spaces     = Input::has('free_wifi_in_public_spaces') ? 1 : 0;
        $post->free_wifi_in_rooms             = Input::has('free_wifi_in_rooms') ? 1 : 0;
        $post->full_service_spa               = Input::has('full_service_spa') ? 1 : 0;
        $post->game_facilities                = Input::has('game_facilities') ? 1 : 0;
        $post->golf                           = Input::has('golf') ? 1 : 0;
        $post->govt_safety_fire               = Input::has('govt_safety_fire') ? 1 : 0;
        $post->high_speed_internet            = Input::has('high_speed_internet') ? 1 : 0;
        $post->hypoallergenic_rooms           = Input::has('hypoallergenic_rooms') ? 1 : 0;
        $post->indoor_pool                    = Input::has('indoor_pool') ? 1 : 0;
        $post->ind_pet_restriction            = Input::has('ind_pet_restriction') ? 1 : 0;
        $post->in_room_coffee_tea             = Input::has('in_room_coffee_tea') ? 1 : 0;
        $post->in_room_mini_bar               = Input::has('in_room_mini_bar') ? 1 : 0;
        $post->in_room_refrigerator           = Input::has('in_room_refrigerator') ? 1 : 0;
        $post->in_room_safe                   = Input::has('in_room_safe') ? 1 : 0;
        $post->interior_doorways              = Input::has('interior_doorways') ? 1 : 0;
        $post->jacuzzi                        = Input::has('jacuzzi') ? 1 : 0;
        $post->kids_facilities                = Input::has('kids_facilities') ? 1 : 0;
        $post->kitchen_facilities             = Input::has('kitchen_facilities') ? 1 : 0;
        $post->meal_service                   = Input::has('meal_service') ? 1 : 0;
        $post->meeting_facilities             = Input::has('meeting_facilities') ? 1 : 0;
        $post->no_adult_tv                    = Input::has('no_adult_tv') ? 1 : 0;
        $post->non_smoking                    = Input::has('non_smoking') ? 1 : 0;
        $post->outdoor_pool                   = Input::has('outdoor_pool') ? 1 : 0;
        $post->parking                        = Input::has('parking') ? 1 : 0;
        $post->pets                           = Input::has('pets') ? 1 : 0;
        $post->pool                           = Input::has('pool') ? 1 : 0;
        $post->public_transportation_adjacent = Input::has('public_transportation_adjacent') ? 1 : 0;
        $post->recreation                     = Input::has('recreation') ? 1 : 0;
        $post->restricted_room_access         = Input::has('restricted_room_access') ? 1 : 0;
        $post->room_service                   = Input::has('room_service') ? 1 : 0;
        $post->room_service_24_hours          = Input::has('room_service_24_hours') ? 1 : 0;
        $post->rooms_with_balcony             = Input::has('rooms_with_balcony') ? 1 : 0;
        $post->ski_in_out_property            = Input::has('ski_in_out_property') ? 1 : 0;
        $post->smoke_free                     = Input::has('smoke_free') ? 1 : 0;
        $post->smoking_rooms_avail            = Input::has('smoking_rooms_avail') ? 1 : 0;
        $post->tennis                         = Input::has('tennis') ? 1 : 0;
        $post->water_purification_system      = Input::has('water_purification_system') ? 1 : 0;
        $post->wheelchair                     = Input::has('wheelchair') ? 1 : 0;
        $post->all_inclusive                  = Input::has('all_inclusive') ? 1 : 0;
        $post->apartments                     = Input::has('apartments') ? 1 : 0;
        $post->bed_breakfast                  = Input::has('bed_breakfast') ? 1 : 0;
        $post->castle                         = Input::has('castle') ? 1 : 0;
        $post->economy                        = Input::has('economy') ? 1 : 0;
        $post->extended_stay                  = Input::has('extended_stay') ? 1 : 0;
        $post->farm                           = Input::has('farm') ? 1 : 0;
        $post->first                          = Input::has('first') ? 1 : 0;
        $post->luxury                         = Input::has('luxury') ? 1 : 0;
        $post->moderate                       = Input::has('moderate') ? 1 : 0;
        $post->motel                          = Input::has('motel') ? 1 : 0;
        $post->resort                         = Input::has('resort') ? 1 : 0;
        $post->suites                         = Input::has('suites') ? 1 : 0;

        //Hotel Attractions
	    $attractions_json = Input::get('attractions_json');

		$attractions_array = json_decode($attractions_json);

		$attractions_value_array = [];

		foreach ($attractions_array as $attraction) {
			if (Input::has($attraction)) {
				array_push($attractions_value_array, Input::get($attraction));
			}			
		}

		$attractions_value_json = json_encode($attractions_value_array);

		$post->attractions = $attractions_value_json;
	    // Hotel Attractions End

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

                    $big_filemove = $file->move('assets/img/uploads/hotels/',  $filenamepart . '.' . $file->getClientOriginalExtension());

                    $img = Image::make('assets/img/uploads/hotels/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
                    $img->save('assets/img/uploads/hotels/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
              
                    $p_multiple_images->category_name = 'Hotels';
                    $p_multiple_images->product_id    = $post->id;  
                    $p_multiple_images->image_guid    = $guid;  
                    $p_multiple_images->name          = $filenamepart. '.' . $file->getClientOriginalExtension(); 
                    $p_multiple_images->thumb         =  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();
                    
                    //Send query to database
                    $p_multiple_images->save();  
                }
            }
            // Multiple Images End

			// Redirect back with success
			return Redirect::back()->with('success', "Hotel has been created");
		}

		// Redirect back with error
		return Redirect::back()->with('error', "Hotel coudn't be created");
		
	}
        
        
  public function getEdit($id)
	{

		if (is_null($entry = Hotel::find($id)))
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


        // Get all multiple images
		$multiple_images = MultipleImages::where('category_name', 'Hotels' )->where('product_id', $entry->id)->get();

		// Show the page
		return View::make('backend.hotels.edit', compact('entry', 'countries', 'cities', 'multiple_images'));
                     
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
			'description' => 'required',
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
                
    if (is_null($post = Hotel::find($id)))
		{
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

        /**
         * Update the blog post data
         */        
        
        //General Information
        $post->name              = e(Input::get('name'));
        $post->title             = e(Input::get('title'));
        $post->grade             = e(Input::get('grade'));
        $post->status            = e(Input::get('status'));
        $post->added_by          = e(Input::get('added_by'));              
        $post->hotels_group      = e(Input::get('hotels_group'));
        $post->business_type     = e(Input::get('business_type'));
        $post->category_tree     = e(Input::get('category_tree'));
        $post->room_type         = e(Input::get('room_type'));
        $post->short_description = e(Input::get('short_description'));
        $post->description       = e(Input::get('description'));

        //Picture Upload       
        $file = Input::file('uploaded_file');
        
        if(isset($file)) 
        {                 
            $filenamepart = time() . '-' . Str::random(20);

	        		$big_filemove = $file->move('assets/img/uploads/hotels/',  $filenamepart . '.' . $file->getClientOriginalExtension());

            $img = Image::make('assets/img/uploads/hotels/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
            $img->save('assets/img/uploads/hotels/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
        
            
            $post->photo     	=  $filenamepart . '.' . $file->getClientOriginalExtension();

            $post->thumb 		=  $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension();	                      
        }
                
		      
        //Showroom Information
        $post->country              = e(Input::get('country'));
        $post->state                = e(Input::get('state'));
        $post->state                = e(Input::get('state'));
        $post->area_city            = e(Input::get('area_city'));
        $post->location_of_hotel    = e(Input::get('location_of_hotel'));
        $post->building_name        = e(Input::get('building_name'));
        $post->building_number      = e(Input::get('building_number'));
        $post->telephone            = e(Input::get('telephone'));
        $post->fax                  = e(Input::get('fax'));
        $post->hotels_email_address = e(Input::get('hotels_email_address'));
        $post->post_code            = e(Input::get('post_code'));
        $post->address              = e(Input::get('address'));

        //Information of Availabilities
        $post->stock          = e(Input::get('stock'));
        $post->effective_from = e(Input::get('effective_from'));
        $post->expire_on      = e(Input::get('expire_on'));

        //Summary Information
        $post->distance_from_airport     = e(Input::get('distance_from_airport'));
        $post->distance_from_city_market = e(Input::get('distance_from_city_market'));
        $post->pet_allow                 = e(Input::get('pet_allow'));
        $post->payment_option            = e(Input::get('payment_option'));
        $post->internet_information      = e(Input::get('internet_information'));
        $post->parking_information       = e(Input::get('parking_information'));

        //Price and Payment Information
        $post->adult_price         = e(Input::get('adult_price'));
        $post->child_price         = e(Input::get('child_price'));
        $post->infant_price        = e(Input::get('infant_price'));
        $post->payment_description = e(Input::get('payment_description'));

        //Discounts
        $post->discount_percentage_agents       = e(Input::get('discount_percentage_agents'));
        $post->discount_percentage_distributors = e(Input::get('discount_percentage_distributors'));        
       
        //Profile Information
        $post->information              = e(Input::get('information'));
        $post->general_information      = e(Input::get('general_information'));
        $post->services                 = e(Input::get('services'));
        $post->surroundings_information = e(Input::get('surroundings_information'));
        $post->other_information        = e(Input::get('other_information'));

        //Policy Information
        $post->policies             = e(Input::get('policies'));
        $post->terms_and_conditions = e(Input::get('terms_and_conditions'));
        $post->privacy_policy       = e(Input::get('privacy_policy'));
        $post->cancellation_policy  = e(Input::get('cancellation_policy'));

        // Hotel Property Options
        $post->ada_accessible                 = Input::has('ada_accessible') ? 1 : 0;
        $post->adults_only                    = Input::has('adults_only') ? 1 : 0;
        $post->airport_shuttle                = Input::has('airport_shuttle') ? 1 : 0;
        $post->beach_front                    = Input::has('beach_front') ? 1 : 0;
        $post->breakfast                      = Input::has('breakfast') ? 1 : 0;
        $post->business_center                = Input::has('business_center') ? 1 : 0;
        $post->business_ready                 = Input::has('business_ready') ? 1 : 0;
        $post->car_rental_counter             = Input::has('car_rental_counter') ? 1 : 0;
        $post->conventions                    = Input::has('conventions') ? 1 : 0;
        $post->dataport                       = Input::has('dataport') ? 1 : 0;
        $post->dining                         = Input::has('dining') ? 1 : 0;
        $post->dry_clean                      = Input::has('dry_clean') ? 1 : 0;
        $post->eco_certified                  = Input::has('eco_certified') ? 1 : 0;
        $post->executive_floors               = Input::has('executive_floors') ? 1 : 0;
        $post->family_plan                    = Input::has('family_plan') ? 1 : 0;
        $post->fitness_center                 = Input::has('fitness_center') ? 1 : 0;
        $post->free_local_calls               = Input::has('free_local_calls') ? 1 : 0;
        $post->free_parking                   = Input::has('free_parking') ? 1 : 0;
        $post->free_shuttle                   = Input::has('free_shuttle') ? 1 : 0;
        $post->free_wifi_in_meeting_rooms     = Input::has('free_wifi_in_meeting_rooms') ? 1 : 0;
        $post->free_wifi_in_public_spaces     = Input::has('free_wifi_in_public_spaces') ? 1 : 0;
        $post->free_wifi_in_rooms             = Input::has('free_wifi_in_rooms') ? 1 : 0;
        $post->full_service_spa               = Input::has('full_service_spa') ? 1 : 0;
        $post->game_facilities                = Input::has('game_facilities') ? 1 : 0;
        $post->golf                           = Input::has('golf') ? 1 : 0;
        $post->govt_safety_fire               = Input::has('govt_safety_fire') ? 1 : 0;
        $post->high_speed_internet            = Input::has('high_speed_internet') ? 1 : 0;
        $post->hypoallergenic_rooms           = Input::has('hypoallergenic_rooms') ? 1 : 0;
        $post->indoor_pool                    = Input::has('indoor_pool') ? 1 : 0;
        $post->ind_pet_restriction            = Input::has('ind_pet_restriction') ? 1 : 0;
        $post->in_room_coffee_tea             = Input::has('in_room_coffee_tea') ? 1 : 0;
        $post->in_room_mini_bar               = Input::has('in_room_mini_bar') ? 1 : 0;
        $post->in_room_refrigerator           = Input::has('in_room_refrigerator') ? 1 : 0;
        $post->in_room_safe                   = Input::has('in_room_safe') ? 1 : 0;
        $post->interior_doorways              = Input::has('interior_doorways') ? 1 : 0;
        $post->jacuzzi                        = Input::has('jacuzzi') ? 1 : 0;
        $post->kids_facilities                = Input::has('kids_facilities') ? 1 : 0;
        $post->kitchen_facilities             = Input::has('kitchen_facilities') ? 1 : 0;
        $post->meal_service                   = Input::has('meal_service') ? 1 : 0;
        $post->meeting_facilities             = Input::has('meeting_facilities') ? 1 : 0;
        $post->no_adult_tv                    = Input::has('no_adult_tv') ? 1 : 0;
        $post->non_smoking                    = Input::has('non_smoking') ? 1 : 0;
        $post->outdoor_pool                   = Input::has('outdoor_pool') ? 1 : 0;
        $post->parking                        = Input::has('parking') ? 1 : 0;
        $post->pets                           = Input::has('pets') ? 1 : 0;
        $post->pool                           = Input::has('pool') ? 1 : 0;
        $post->public_transportation_adjacent = Input::has('public_transportation_adjacent') ? 1 : 0;
        $post->recreation                     = Input::has('recreation') ? 1 : 0;
        $post->restricted_room_access         = Input::has('restricted_room_access') ? 1 : 0;
        $post->room_service                   = Input::has('room_service') ? 1 : 0;
        $post->room_service_24_hours          = Input::has('room_service_24_hours') ? 1 : 0;
        $post->rooms_with_balcony             = Input::has('rooms_with_balcony') ? 1 : 0;
        $post->ski_in_out_property            = Input::has('ski_in_out_property') ? 1 : 0;
        $post->smoke_free                     = Input::has('smoke_free') ? 1 : 0;
        $post->smoking_rooms_avail            = Input::has('smoking_rooms_avail') ? 1 : 0;
        $post->tennis                         = Input::has('tennis') ? 1 : 0;
        $post->water_purification_system      = Input::has('water_purification_system') ? 1 : 0;
        $post->wheelchair                     = Input::has('wheelchair') ? 1 : 0;
        $post->all_inclusive                  = Input::has('all_inclusive') ? 1 : 0;
        $post->apartments                     = Input::has('apartments') ? 1 : 0;
        $post->bed_breakfast                  = Input::has('bed_breakfast') ? 1 : 0;
        $post->castle                         = Input::has('castle') ? 1 : 0;
        $post->economy                        = Input::has('economy') ? 1 : 0;
        $post->extended_stay                  = Input::has('extended_stay') ? 1 : 0;
        $post->farm                           = Input::has('farm') ? 1 : 0;
        $post->first                          = Input::has('first') ? 1 : 0;
        $post->luxury                         = Input::has('luxury') ? 1 : 0;
        $post->moderate                       = Input::has('moderate') ? 1 : 0;
        $post->motel                          = Input::has('motel') ? 1 : 0;
        $post->resort                         = Input::has('resort') ? 1 : 0;
        $post->suites                         = Input::has('suites') ? 1 : 0;

        //Hotel Attractions
        $attractions_json = Input::get('attractions_json');

        $attractions_array = json_decode($attractions_json);

        $attractions_value_array = [];

        foreach ($attractions_array as $attraction) {
            if (Input::has($attraction)) {
                array_push($attractions_value_array, Input::get($attraction));
            }           
        }

        $attractions_value_json = json_encode($attractions_value_array);

        $post->attractions = $attractions_value_json;
        // Hotel Attractions End	

		// Was the blog post updated?
		if($post->save())
		{
			//Multiple Images
            $images_delete_json = Input::get('multiple_images_delete_json');

            $images_delete_array = json_decode($images_delete_json);

            if (empty($images_delete_array)) {
                $images_delete_array = [];
            }
            
            foreach ($images_delete_array as $guid) {

                if (!is_null($multiple_entry = MultipleImages::where('category_name', 'Hotels' )->where('product_id', $id)->where('image_guid', $guid)->first() ) ) {
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
                    if (!is_null($multiple_entry = MultipleImages::where('category_name', 'Hotels' )->where('product_id', $id)->where('image_guid', $guid)->first() ) ) {
                        
                        $p_multiple_images = $multiple_entry;

                        unlink('assets/img/uploads/hotels/'. $p_multiple_images->name);
                        unlink('assets/img/uploads/hotels/'. $p_multiple_images->thumb);

                    } else {
                        $p_multiple_images = new MultipleImages;   
                    }   

                    $filenamepart = time() . '-' . Str::random(20);

                    $big_filemove = $file->move('assets/img/uploads/hotels/',  $filenamepart . '.' . $file->getClientOriginalExtension());

                    $img = Image::make('assets/img/uploads/hotels/'. $filenamepart . '.' . $file->getClientOriginalExtension())->resize(97, 74);
                    $img->save('assets/img/uploads/hotels/'. $filenamepart. '_thumb' . '.' . $file->getClientOriginalExtension(), 100);
              
                    $p_multiple_images->category_name = 'Hotels';
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
			return Redirect::back()->with('success', "Hotel updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update hotel.");
	
	}
   
    
    public function getDelete($id)
	{
        
     
		// Check if the blog post exists
		if (is_null($entry = Hotel::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete hotel.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Hotel deleted successfully");
                            
                
	}
    
    
    
    
}
