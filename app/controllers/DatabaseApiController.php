<?php

class DatabaseApiController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;
    
	public function getAllPackageTours()
	{

		if(!Request::isJson()) {
			return Response::json(['success' => false, 'message' => 'The request is not JSON.']);
		} 

		$json = Request::json()->all();

		if(empty($json)) {
		    return Response::json(['success' => false, 'message' => 'Invalid JSON recieved.']);
		}

		$input = Input::get();

		if(empty($input)) {
		 	return Response::json(['success' => false, 'message' => 'The request is empty.']);
		}

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$package_tours = PackageTours::all();

		if (!$package_tours->isEmpty()) {

	 	return $package_tours;
	 	
		} else {
	 	return Response::json(['success' => false, 'message' => 'No results found.']);
	 	}

	}

	public function getSinglePackageTour($id)
	{
		
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$package_tours = PackageTours::find($id);

	 	if (isset($package_tours)) {

	 	return $package_tours;
	 	
	 	} else {
	 	return Response::json(['success' => false, 'message' => 'Cannot find the package with id of '. $id .'.']);
	 	}

	}

	public function postPackageOrder($id)
	{
		/**
		 * Check for authentication, api key
		 */
		if(!Request::isJson()) {
			return Response::json(['success' => false, 'message' => 'The request is not JSON.']);
		} 

		$json = Request::json()->all();

		if(empty($json)) {
		    return Response::json(['success' => false, 'message' => 'Invalid JSON recieved.']);
		}

		$input = Input::get();

		if(empty($input)) {
		 	return Response::json(['success' => false, 'message' => 'The request is empty.']);
		}

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}



		/**
		 * Authenticate user info
		 */

		if(Input::has('user_info')) {

			$user_info = Input::get('user_info');

			if (!isset($user_info['email'])) {
				return Response::json(['success' => false, 'message' => 'user_info->email attribute is missing.']);
			} 
			if (!isset($user_info['password'])) {
				return Response::json(['success' => false, 'message' => 'user_info->password attribute is missing.']);
			} 
		} else {
			return Response::json(['success' => false, 'message' => 'user-info attribute is missing.']);
		}


		$email = $user_info['email'];

		$password = $user_info['password'];


		try {

			// Try to log the user in
			Sentry::authenticate(['email' => $email, 'password' => $password], 0);      

			$login_history = new LoginHistory;

			$login_history->user_id = Sentry::getUser()->id;

			$login_history->ip_address = getenv('HTTP_CLIENT_IP')?:
										 getenv('HTTP_X_FORWARDED_FOR')?:
										 getenv('HTTP_X_FORWARDED')?:
										 getenv('HTTP_FORWARDED_FOR')?:
										 getenv('HTTP_FORWARDED')?:
										 getenv('REMOTE_ADDR');

			$login_history->method = 'api';	

			$login_history->save();

			$email = $user_info['email'];
			$userprovider = Sentry::getUserProvider();
			$group = Sentry::getGroupProvider();
			$user = Sentry::getUser();
   	 	    $admin = $group->findById(1); 
			$agent = $group->findById(3); 
			$affiliate = $group->findById(4);
			$manager = $group->findById(5); 
			$distributor = $group->findById(6);
			$corporate = $group->findById(7);

			if ($user->inGroup($agent)) {

	    		$credit_requested = CreditLimitManagement::where('user_id', $user->id)->where('expired', 0)->get();

	    		foreach ($credit_requested as $credit) {

	    			$todaysDate = strtotime(date("Y-m-d H:i:s"));

	      		$expire_date = strtotime($credit->expire_date); 

	        	if($todaysDate > $expire_date) {

	            $funds = Funds::where('user_id', $user->id)->first();

	          	if($funds->credit_balance >= $credit->amount) {
	          		$funds->credit_balance = $funds->credit_balance - $credit->amount;
	          	} else {
	          		$funds->credit_balance = 0;
	          	}

	          	$funds->save();

	          	$credit->expired = 1;

	          	$credit->save();

	        	}					    			
	    		}

	    		if (ApplicationSetting::find(3)->value == 0) {
	  				return Response::json(array('success' => false, 'message' => 'Agent login temporarily disabled. Please check back later.'));
	    		}
			} 
			
			// Redirect to the users page
			//return Response::json(array('success' => true,  'message' => 'You have successfully logged in.', 'user_id' => Sentry::getUser()->id)); 

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		}  catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		if (!empty($this->messageBag)) {
			return $this->messageBag;
		}

		/**
		 * Get json attribute 'order' and validate the order sub-attributes
		 * @var array
		 */
		$order = Input::get('order');

		$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
          	'check_in'        => $order['check_in'],
          	'check_out'       => $order['check_out'],
			'total_adults'    => $order['total_adults'],
			'total_children'  => $order['total_children'],
			'total_infants'   => $order['total_infants'],
			'payment_options' => $order['payment_options']
      	);

        // Declare the rules for the form validation
		$rules = array(
            'check_in'        => 'required',
            'check_out'       => 'required',
            'total_adults'    => 'required|Integer',
            'total_children'  => 'required|Integer',
            'total_infants'   => 'required|Integer',
            'payment_options' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);;
		}

		if (is_null($package = PackageTours::find($id)))
		{
			// Redirect back
			return Response::json(['success' => false, 'message' => 'Coudn\'t find the selected package.']);
		}

		if ($package->stock <= 0) {

			return Response::json(['success' => false, 'message' => 'The selected item\'s stock is finished. Please try another item.']);
		}


		$payment_options = $input['payment_options'];

		// Create a new category
		$post = new Orders;
                
        $userdetails = Sentry::getUser();

        $old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		}

		else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}

		// Update the post data
        $post->category_name    = e('Package Tours');
		$post->package_name  	= e($package->name);              
        $post->package_id       = e($id);
        $post->user_id       	= e($userdetails->id);
		$post->check_in         = e($input['check_in']);
		$post->check_out        = e($input['check_out']);
		$post->invoice_no       = e($invoice_no);
		$post->status           = e('Pending');

        $total_adults   = (int)e($input['total_adults']);
        $total_children = (int)e($input['total_children']);
        $total_infants  = (int)e($input['total_infants']);

        $adult_price  = $package->adult_price;
        $child_price  = $package->child_price;
        $infant_price = $package->infant_price;

        $total_adult_price = ($adult_price) * ($total_adults);
        $total_child_price = ($child_price) * ($total_children);
        $total_infant_price = ($infant_price) * ($total_infants);  

        $total_usd = $total_adult_price + $total_child_price + $total_infant_price;

		//For amount
		$currency = 'usd';

   		$total_npr = ceil($total_usd * FXRate::where('iso_code', 'USD')->first()->exchange_rate);	

        $post->total_adults   = $total_adults;
        $post->total_children = $total_children;
        $post->total_infants  = $total_infants;
        $post->currency       = e($currency);
        $post->amount         = e($total_usd);	

		// Subtract the stock number by 1 if stock is set.
		if (!empty($package->stock)) {
			$package->stock = $package->stock - 1;
		}

		// Was the blog post created?
		if($post->save() and $package->save())
		{
			
            /**
             * Send New Order Email to administrator
             */            
            // Data to be used on the email view
			$data = array(
				'user'          => $userdetails,
				'invoice_no'    => $invoice_no,
				'category'      => 'Package Tours',
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
            
            $payment_options = $input['payment_options'];
            

			if ($payment_options == 'account_balance') {

	        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();
	        	$balance = $entry->balance;

	            if($balance and $balance >= $total_npr) {
	            	$new_balance = $balance - $total_npr;

	            	$entry->balance = $new_balance;

	            	if(!$entry->save()) {
	            		return Response::json(['success' => false, 'message' => 'Balance could not be updated.']);
	            	}

	            	return Response::json(['success' => true, 'message' => 'Your order has been created']);
	            
	            } else {

	            	return Response::json(['success' => false, 'message' => 'Insufficient Balance']);
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
	            		return Response::json(['success' => false, 'message' => 'Credit balance could not be updated.']);
	            	}

					$user = Sentry::getUser();

					$test = Input::get('backend');

					/*$post = new CreditLimitTransactions;

					$post->category_name    = e('Package Tours');
					$post->package_name  	= e($package->name);              
			        $post->package_id       = e(Input::get('id'));
			        $post->user_id       	= e($userdetails->id);
					$post->date        		= e(Input::get('date'));
			        $post->group_size       = e(Input::get('group_size'));
					$post->invoice_no       = e($invoice_no);
					$post->status           = e('Pending');

					//For amount
					$currency = 'usd';

			        if($currency == 'usd') 
			        {
			        	$amount = $package->cost;
			        	$total = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        }
			        elseif ($currency == 'npr') 
			        {
			       		$amount = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        	$total = $amount;
			        }

			        $post->currency = e($currency);
					$post->amount 	= e($amount);	

					if(!$post->save()) 
	            	{
	            		return Redirect::back()->with('error', 'Credit History could not be updated.');
	            	}*/

	            	return Response::json(['success' => true, 'message' => 'Your order has been created.']);
	         	          
	            } else {
	            	return Response::json(['success' => false, 'message' => 'Insufficient Credit Balance']);

	            }       	
       		}

			// Redirect to the new blog post page
			//return Redirect::back()->with('success', "Your order has been created");
		}

		// Redirect to the blog post create page
		
	    return Response::json(['success' => false, 'message' => 'Order coudn\'t be created']);  

	}


	public function getAllHotels()
	{

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$hotels = Hotel::all();

		if (!$hotels->isEmpty()) {

	 	return $hotels;
	 	
		} else {
	 	return Response::json(['success' => false, 'message' => 'No results found.']);
	 	}

	}

	public function getSingleHotel($id)
	{
		
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$hotel = Hotel::find($id);

	 	if (isset($hotel)) {

	 	return $hotel;
	 	
	 	} else {
	 	return Response::json(['success' => false, 'message' => 'Cannot find the hotel with id of '. $id .'.']);
	 	}

	}

	public function postHotelOrder($id)
	{
		/**
		 * Check for authentication, api key
		 */
		if(!Request::isJson()) {
			return Response::json(['success' => false, 'message' => 'The request is not JSON.']);
		} 

		$json = Request::json()->all();

		if(empty($json)) {
		    return Response::json(['success' => false, 'message' => 'Invalid JSON recieved.']);
		}

		$input = Input::get();

		if(empty($input)) {
		 	return Response::json(['success' => false, 'message' => 'The request is empty.']);
		}

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}



		/**
		 * Authenticate user info
		 */

		if(Input::has('user_info')) {

			$user_info = Input::get('user_info');

			if (!isset($user_info['email'])) {
				return Response::json(['success' => false, 'message' => 'user_info->email attribute is missing.']);
			} 
			if (!isset($user_info['password'])) {
				return Response::json(['success' => false, 'message' => 'user_info->password attribute is missing.']);
			} 
		} else {
			return Response::json(['success' => false, 'message' => 'user-info attribute is missing.']);
		}


		$email = $user_info['email'];

		$password = $user_info['password'];


		try {

			// Try to log the user in
			Sentry::authenticate(['email' => $email, 'password' => $password], 0);      

			$login_history = new LoginHistory;

			$login_history->user_id = Sentry::getUser()->id;

			$login_history->ip_address = getenv('HTTP_CLIENT_IP')?:
										 getenv('HTTP_X_FORWARDED_FOR')?:
										 getenv('HTTP_X_FORWARDED')?:
										 getenv('HTTP_FORWARDED_FOR')?:
										 getenv('HTTP_FORWARDED')?:
										 getenv('REMOTE_ADDR');

			$login_history->method = 'api';	
			
			$login_history->save();

			$email = $user_info['email'];
			$userprovider = Sentry::getUserProvider();
			$group = Sentry::getGroupProvider();
			$user = Sentry::getUser();
   	 	    $admin = $group->findById(1); 
			$agent = $group->findById(3); 
			$affiliate = $group->findById(4);
			$manager = $group->findById(5); 
			$distributor = $group->findById(6);
			$corporate = $group->findById(7);

			if ($user->inGroup($agent)) {

	    		$credit_requested = CreditLimitManagement::where('user_id', $user->id)->where('expired', 0)->get();

	    		foreach ($credit_requested as $credit) {

	    			$todaysDate = strtotime(date("Y-m-d H:i:s"));

	      		$expire_date = strtotime($credit->expire_date); 

	        	if($todaysDate > $expire_date) {

	            $funds = Funds::where('user_id', $user->id)->first();

	          	if($funds->credit_balance >= $credit->amount) {
	          		$funds->credit_balance = $funds->credit_balance - $credit->amount;
	          	} else {
	          		$funds->credit_balance = 0;
	          	}

	          	$funds->save();

	          	$credit->expired = 1;

	          	$credit->save();

	        	}					    			
	    		}

	    		if (ApplicationSetting::find(3)->value == 0) {
	  				return Response::json(array('success' => false, 'message' => 'Agent login temporarily disabled. Please check back later.'));
	    		}
			} 
			
			// Redirect to the users page
			//return Response::json(array('success' => true,  'message' => 'You have successfully logged in.', 'user_id' => Sentry::getUser()->id)); 

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		if (!empty($this->messageBag)) {
			return $this->messageBag;
		}

		/**
		 * Get json attribute 'order' and validate the order sub-attributes
		 * @var array
		 */
		$order = Input::get('order');

		$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
          	'check_in'        => $order['check_in'],
          	'check_out'       => $order['check_out'],
			'total_adults'    => $order['total_adults'],
			'total_children'  => $order['total_children'],
			'total_infants'   => $order['total_infants'],
			'payment_options' => $order['payment_options']
      	);

        // Declare the rules for the form validation
		$rules = array(
            'check_in'        => 'required',
            'check_out'       => 'required',
            'total_adults'    => 'required|Integer',
            'total_children'  => 'required|Integer',
            'total_infants'   => 'required|Integer',
            'payment_options' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);;
		}

		if (is_null($hotel = Hotel::find($id)))
		{
			// Redirect back
			return Response::json(['success' => false, 'message' => 'Coudn\'t find the selected package.']);
		}

		if ($hotel->stock <= 0) {

			return Response::json(['success' => false, 'message' => 'The selected item\'s stock is finished. Please try another item.']);
		}

		$payment_options = $input['payment_options'];

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
        $currency = 'usd';

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
            
            $payment_options = $input['payment_options'];
            

			if ($payment_options == 'account_balance') {

	        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();
	        	$balance = $entry->balance;

	            if($balance and $balance >= $total_npr) {
	            	$new_balance = $balance - $total_npr;

	            	$entry->balance = $new_balance;

	            	if(!$entry->save()) {
	            		return Response::json(['success' => false, 'message' => 'Balance could not be updated.']);
	            	}

	            	return Response::json(['success' => true, 'message' => 'Your order has been created']);
	            
	            } else {

	            	return Response::json(['success' => false, 'message' => 'Insufficient Balance']);
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
	            		return Response::json(['success' => false, 'message' => 'Credit balance could not be updated.']);
	            	}

					$user = Sentry::getUser();

					$test = Input::get('backend');

					/*$post = new CreditLimitTransactions;

					$post->category_name    = e('Package Tours');
					$post->package_name  	= e($package->name);              
			        $post->package_id       = e(Input::get('id'));
			        $post->user_id       	= e($userdetails->id);
					$post->date        		= e(Input::get('date'));
			        $post->group_size       = e(Input::get('group_size'));
					$post->invoice_no       = e($invoice_no);
					$post->status           = e('Pending');

					//For amount
					$currency = 'usd';

			        if($currency == 'usd') 
			        {
			        	$amount = $package->cost;
			        	$total = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        }
			        elseif ($currency == 'npr') 
			        {
			       		$amount = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        	$total = $amount;
			        }

			        $post->currency = e($currency);
					$post->amount 	= e($amount);	

					if(!$post->save()) 
	            	{
	            		return Redirect::back()->with('error', 'Credit History could not be updated.');
	            	}*/

	            	return Response::json(['success' => true, 'message' => 'Your order has been created.']);
	         	          
	            } else {
	            	return Response::json(['success' => false, 'message' => 'Insufficient Credit Balance']);

	            }       	
       		}

			// Redirect to the new blog post page
			//return Redirect::back()->with('success', "Your order has been created");
		}

		// Redirect to the blog post create page
		
	    return Response::json(['success' => false, 'message' => 'Order coudn\'t be created']);  

	}

	public function getAllVacationRentals()
	{

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$vacation_rentals = VacationRental::all();

		if (!$vacation_rentals->isEmpty()) {

	 	return $vacation_rentals;
	 	
		} else {
	 	return Response::json(['success' => false, 'message' => 'No results found.']);
	 	}

	}

	public function getSingleVacationRental($id)
	{
		
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$vacation_rental = VacationRental::find($id);

	 	if (isset($vacation_rental)) {

	 	return $vacation_rental;
	 	
	 	} else {
	 	return Response::json(['success' => false, 'message' => 'Cannot find the vacation rental with id of '. $id .'.']);
	 	}

	}

	public function postVacationOrder($id)
	{
		/**
		 * Check for authentication, api key
		 */
		if(!Request::isJson()) {
			return Response::json(['success' => false, 'message' => 'The request is not JSON.']);
		} 

		$json = Request::json()->all();

		if(empty($json)) {
		    return Response::json(['success' => false, 'message' => 'Invalid JSON recieved.']);
		}

		$input = Input::get();

		if(empty($input)) {
		 	return Response::json(['success' => false, 'message' => 'The request is empty.']);
		}

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}


		/**
		 * Authenticate user info
		 */

		if(Input::has('user_info')) {

			$user_info = Input::get('user_info');

			if (!isset($user_info['email'])) {
				return Response::json(['success' => false, 'message' => 'user_info->email attribute is missing.']);
			} 
			if (!isset($user_info['password'])) {
				return Response::json(['success' => false, 'message' => 'user_info->password attribute is missing.']);
			} 
		} else {
			return Response::json(['success' => false, 'message' => 'user-info attribute is missing.']);
		}


		$email = $user_info['email'];

		$password = $user_info['password'];


		try {

			// Try to log the user in
			Sentry::authenticate(['email' => $email, 'password' => $password], 0);      

			$login_history = new LoginHistory;

			$login_history->user_id = Sentry::getUser()->id;

			$login_history->ip_address = getenv('HTTP_CLIENT_IP')?:
										 getenv('HTTP_X_FORWARDED_FOR')?:
										 getenv('HTTP_X_FORWARDED')?:
										 getenv('HTTP_FORWARDED_FOR')?:
										 getenv('HTTP_FORWARDED')?:
										 getenv('REMOTE_ADDR');

			$login_history->method = 'api';	
			
			$login_history->save();

			$email = $user_info['email'];
			$userprovider = Sentry::getUserProvider();
			$group = Sentry::getGroupProvider();
			$user = Sentry::getUser();
   	 	    $admin = $group->findById(1); 
			$agent = $group->findById(3); 
			$affiliate = $group->findById(4);
			$manager = $group->findById(5); 
			$distributor = $group->findById(6);
			$corporate = $group->findById(7);

			if ($user->inGroup($agent)) {

	    		$credit_requested = CreditLimitManagement::where('user_id', $user->id)->where('expired', 0)->get();

	    		foreach ($credit_requested as $credit) {

	    			$todaysDate = strtotime(date("Y-m-d H:i:s"));

	      		$expire_date = strtotime($credit->expire_date); 

	        	if($todaysDate > $expire_date) {

	            $funds = Funds::where('user_id', $user->id)->first();

	          	if($funds->credit_balance >= $credit->amount) {
	          		$funds->credit_balance = $funds->credit_balance - $credit->amount;
	          	} else {
	          		$funds->credit_balance = 0;
	          	}

	          	$funds->save();

	          	$credit->expired = 1;

	          	$credit->save();

	        	}					    			
	    		}

	    		if (ApplicationSetting::find(3)->value == 0) {
	  				return Response::json(array('success' => false, 'message' => 'Agent login temporarily disabled. Please check back later.'));
	    		}
			} 
			
			// Redirect to the users page
			//return Response::json(array('success' => true,  'message' => 'You have successfully logged in.', 'user_id' => Sentry::getUser()->id)); 

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		if (!empty($this->messageBag)) {
			return $this->messageBag;
		}

		/**
		 * Get json attribute 'order' and validate the order sub-attributes
		 * @var array
		 */
		$order = Input::get('order');

		$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
			'check_in'          => $order['check_in'],
			'check_out'         => $order['check_out'],
			'total_rent'        => $order['total_rent'],
			'total_strickthrow' => $order['total_strickthrow'],
			'payment_options'   => $order['payment_options']
      	);

        // Declare the rules for the form validation
		$rules = array(
			'check_in'          => 'required',
			'check_out'         => 'required',
			'total_rent'        => 'required|Integer',
			'total_strickthrow' => 'required|Integer',
			'payment_options'   => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);;
		}

		if (is_null($vacation_rental = VacationRental::find($id)))
		{
			// Redirect back
			return Response::json(['success' => false, 'message' => 'Coudn\'t find the selected vacation rental.']);
		}

		if ($vacation_rental->stock <= 0) {

			return Response::json(['success' => false, 'message' => 'The selected item\'s stock is finished. Please try another item.']);
		}


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
		$post->package_name  	= e($vacation_rental->name);              
        $post->package_id       = e($id);
        $post->user_id       	= e($userdetails->id);
		$post->check_in         = e($input['check_in']);
        $post->check_out        = e($input['check_out']);
		$post->invoice_no       = e($invoice_no);
		$post->status           = e('Pending');

		$total_rent        = (int)e($input['total_rent']);
		$total_strickthrow = (int)e($input['total_strickthrow']);

		$rent_price        = $vacation_rental->rent_price;
		$strickthrow_price = $vacation_rental->strickthrow_price;

		$total_rent_price        = ($rent_price) * ($total_rent);
		$total_strickthrow_price = ($strickthrow_price) * ($total_strickthrow);

        $total_usd = $total_rent_price + $total_strickthrow_price;

        //For amount
        $currency = 'usd';

        $total_npr = ceil($total_usd * FXRate::where('iso_code', 'USD')->first()->exchange_rate);   

		$post->total_rent        = $total_rent;
		$post->total_strickthrow = $total_strickthrow;
		$post->currency          = e($currency);
		$post->amount            = e($total_usd);	

		// Subtract the stock number by 1 if stock is set.
		if (!empty($vacation_rental->stock)) {
			$vacation_rental->stock = $vacation_rental->stock - 1;
		}

		// Was the blog post created?
		if($post->save() and $vacation_rental->save())
		{
			
            /**
             * Send New Order Email to administrator
             */            
            // Data to be used on the email view
			$data = array(
				'user'          => $userdetails,
				'invoice_no'    => $invoice_no,
				'category'      => 'Vacation Rentals',
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
            
            $payment_options = $input['payment_options'];
            

			if ($payment_options == 'account_balance') {

	        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();
	        	$balance = $entry->balance;

	            if($balance and $balance >= $total_npr) {
	            	$new_balance = $balance - $total_npr;

	            	$entry->balance = $new_balance;

	            	if(!$entry->save()) {
	            		return Response::json(['success' => false, 'message' => 'Balance could not be updated.']);
	            	}

	            	return Response::json(['success' => true, 'message' => 'Your order has been created']);
	            
	            } else {

	            	return Response::json(['success' => false, 'message' => 'Insufficient Balance']);
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
	            		return Response::json(['success' => false, 'message' => 'Credit balance could not be updated.']);
	            	}

					$user = Sentry::getUser();

					/*$post = new CreditLimitTransactions;

					$post->category_name    = e('Package Tours');
					$post->package_name  	= e($package->name);              
			        $post->package_id       = e(Input::get('id'));
			        $post->user_id       	= e($userdetails->id);
					$post->date        		= e(Input::get('date'));
			        $post->group_size       = e(Input::get('group_size'));
					$post->invoice_no       = e($invoice_no);
					$post->status           = e('Pending');

					//For amount
					$currency = 'usd';

			        if($currency == 'usd') 
			        {
			        	$amount = $package->cost;
			        	$total = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        }
			        elseif ($currency == 'npr') 
			        {
			       		$amount = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        	$total = $amount;
			        }

			        $post->currency = e($currency);
					$post->amount 	= e($amount);	

					if(!$post->save()) 
	            	{
	            		return Redirect::back()->with('error', 'Credit History could not be updated.');
	            	}*/

	            	return Response::json(['success' => true, 'message' => 'Your order has been created.']);
	         	          
	            } else {
	            	return Response::json(['success' => false, 'message' => 'Insufficient Credit Balance']);

	            }       	
       		}

			// Redirect to the new blog post page
			//return Redirect::back()->with('success', "Your order has been created");
		}

		// Redirect to the blog post create page
		
	    return Response::json(['success' => false, 'message' => 'Order coudn\'t be created']);  

	}

	public function getAllVehicleRentals()
	{

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$vehicle_rentals = VehicleRental::all();

		if (!$vehicle_rentals->isEmpty()) {

	 	return $vehicle_rentals;
	 	
		} else {
	 	return Response::json(['success' => false, 'message' => 'No results found.']);
	 	}

	}

	public function getSingleVehicleRental($id)
	{
		
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}

	 	$vehicle_rental = VehicleRental::find($id);

	 	if (isset($vehicle_rental)) {
	 		
	 		return $vehicle_rental;
	 	
	 	} else {
	 		return Response::json(['success' => false, 'message' => 'Cannot find the vehicle rental with id of '. $id .'.']);
	 	}

	}

	public function postVehicleOrder($id)
	{
		/**
		 * Check for authentication, api key
		 */
		if(!Request::isJson()) {
			return Response::json(['success' => false, 'message' => 'The request is not JSON.']);
		} 

		$json = Request::json()->all();

		if(empty($json)) {
		    return Response::json(['success' => false, 'message' => 'Invalid JSON recieved.']);
		}

		$input = Input::get();

		if(empty($input)) {
		 	return Response::json(['success' => false, 'message' => 'The request is empty.']);
		}

		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => false, 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => false, 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => false, 'message' => 'Auth attribute is missing.']);
		}


		/**
		 * Authenticate user info
		 */

		if(Input::has('user_info')) {

			$user_info = Input::get('user_info');

			if (!isset($user_info['email'])) {
				return Response::json(['success' => false, 'message' => 'user_info->email attribute is missing.']);
			} 
			if (!isset($user_info['password'])) {
				return Response::json(['success' => false, 'message' => 'user_info->password attribute is missing.']);
			} 
		} else {
			return Response::json(['success' => false, 'message' => 'user-info attribute is missing.']);
		}


		$email = $user_info['email'];

		$password = $user_info['password'];


		try {

			// Try to log the user in
			Sentry::authenticate(['email' => $email, 'password' => $password], 0);      

			$login_history = new LoginHistory;

			$login_history->user_id = Sentry::getUser()->id;

			$login_history->ip_address = getenv('HTTP_CLIENT_IP')?:
										 getenv('HTTP_X_FORWARDED_FOR')?:
										 getenv('HTTP_X_FORWARDED')?:
										 getenv('HTTP_FORWARDED_FOR')?:
										 getenv('HTTP_FORWARDED')?:
										 getenv('REMOTE_ADDR');

			$login_history->method = 'api';	
			
			$login_history->save();

			$email = $user_info['email'];
			$userprovider = Sentry::getUserProvider();
			$group = Sentry::getGroupProvider();
			$user = Sentry::getUser();
   	 	    $admin = $group->findById(1); 
			$agent = $group->findById(3); 
			$affiliate = $group->findById(4);
			$manager = $group->findById(5); 
			$distributor = $group->findById(6);
			$corporate = $group->findById(7);

			if ($user->inGroup($agent)) {

	    		$credit_requested = CreditLimitManagement::where('user_id', $user->id)->where('expired', 0)->get();

	    		foreach ($credit_requested as $credit) {

	    			$todaysDate = strtotime(date("Y-m-d H:i:s"));

	      		$expire_date = strtotime($credit->expire_date); 

	        	if($todaysDate > $expire_date) {

	            $funds = Funds::where('user_id', $user->id)->first();

	          	if($funds->credit_balance >= $credit->amount) {
	          		$funds->credit_balance = $funds->credit_balance - $credit->amount;
	          	} else {
	          		$funds->credit_balance = 0;
	          	}

	          	$funds->save();

	          	$credit->expired = 1;

	          	$credit->save();

	        	}					    			
	    		}

	    		if (ApplicationSetting::find(3)->value == 0) {
	  				return Response::json(array('success' => false, 'message' => 'Agent login temporarily disabled. Please check back later.'));
	    		}
			} 
			
			// Redirect to the users page
			//return Response::json(array('success' => true,  'message' => 'You have successfully logged in.', 'user_id' => Sentry::getUser()->id)); 

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		if (!empty($this->messageBag)) {
			return $this->messageBag;
		}

		/**
		 * Get json attribute 'order' and validate the order sub-attributes
		 * @var array
		 */
		$order = Input::get('order');

		$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
			'check_in'        => $order['check_in'],
			'check_out'       => $order['check_out'],
			'total_days'      => $order['total_days'],
			'total_weeks'     => $order['total_weeks'],
			'total_months'    => $order['total_months'],
			'total_kms'       => $order['total_kms'],
			'payment_options' => $order['payment_options']
      	);

        // Declare the rules for the form validation
		$rules = array(
			'check_in'        => 'required',
			'check_out'       => 'required',
			'total_days'      => 'required|Integer',
			'total_weeks'     => 'required|Integer',
			'total_months'    => 'required|Integer',
			'total_kms'       => 'required|Integer',
			'payment_options' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);;
		}

		if (is_null($vacation_rental = VacationRental::find($id)))
		{
			// Redirect back
			return Response::json(['success' => false, 'message' => 'Coudn\'t find the selected package.']);
		}

		if ($package->stock <= 0) {

			return Response::json(['success' => false, 'message' => 'The selected item\'s stock is finished. Please try another item.']);
		}

		$payment_options = $input['payment_options'];

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
        $post->package_id       = e($id);
        $post->user_id          = e($userdetails->id);
        $post->check_in         = e($input['check_in']);
        $post->check_out        = e($input['check_out']);
        $post->invoice_no       = e($invoice_no);
        $post->status           = e('Pending');

        $total_rent   = (int)e($input['total_rent']);
        $total_strickthrow = (int)e($input['total_strickthrow']);

        $rent_price  = $vacation_rental->rent_price;
        $strickthrow_price  = $vacation_rental->strickthrow_price;

        $total_rent_price = ($rent_price) * ($total_rent);
        $total_strickthrow_price = ($strickthrow_price) * ($total_strickthrow);

        $total_usd = $total_rent_price + $total_strickthrow_price;

        //For amount
        $currency = 'usd';

        $total_npr = ceil($total_usd * FXRate::where('iso_code', 'USD')->first()->exchange_rate);   

        $post->total_rent        = $total_rent;
        $post->total_strickthrow = $total_strickthrow;
        $post->currency          = e($currency);
        $post->amount            = e($total_usd);   

        // Subtract the stock number by 1 if stock is set.
        if (!empty($vacation_rental->stock)) {
            $vacation_rental->stock = $vacation_rental->stock - 1;
        }

		// Was the blog post created?
		if($post->save() and $package->save())
		{
			
            /**
             * Send New Order Email to administrator
             */            
            // Data to be used on the email view
			$data = array(
				'user'          => $userdetails,
				'invoice_no'    => $invoice_no,
				'category'      => 'Vacation Rentals',
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
            
            $payment_options = $input['payment_options'];
            

			if ($payment_options == 'account_balance') {

	        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();
	        	$balance = $entry->balance;

	            if($balance and $balance >= $total_npr) {
	            	$new_balance = $balance - $total_npr;

	            	$entry->balance = $new_balance;

	            	if(!$entry->save()) {
	            		return Response::json(['success' => false, 'message' => 'Balance could not be updated.']);
	            	}

	            	return Response::json(['success' => true, 'message' => 'Your order has been created']);
	            
	            } else {

	            	return Response::json(['success' => false, 'message' => 'Insufficient Balance']);
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
	            		return Response::json(['success' => false, 'message' => 'Credit balance could not be updated.']);
	            	}

					$user = Sentry::getUser();

					/*$post = new CreditLimitTransactions;

					$post->category_name    = e('Package Tours');
					$post->package_name  	= e($package->name);              
			        $post->package_id       = e(Input::get('id'));
			        $post->user_id       	= e($userdetails->id);
					$post->date        		= e(Input::get('date'));
			        $post->group_size       = e(Input::get('group_size'));
					$post->invoice_no       = e($invoice_no);
					$post->status           = e('Pending');

					//For amount
					$currency = 'usd';

			        if($currency == 'usd') 
			        {
			        	$amount = $package->cost;
			        	$total = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        }
			        elseif ($currency == 'npr') 
			        {
			       		$amount = ceil($package->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			        	$total = $amount;
			        }

			        $post->currency = e($currency);
					$post->amount 	= e($amount);	

					if(!$post->save()) 
	            	{
	            		return Redirect::back()->with('error', 'Credit History could not be updated.');
	            	}*/

	            	return Response::json(['success' => true, 'message' => 'Your order has been created.']);
	         	          
	            } else {
	            	return Response::json(['success' => false, 'message' => 'Insufficient Credit Balance']);

	            }       	
       		}

			// Redirect to the new blog post page
			//return Redirect::back()->with('success', "Your order has been created");
		}

		// Redirect to the blog post create page
		
	    return Response::json(['success' => false, 'message' => 'Order coudn\'t be created']);  

	}


	
}
