<?php

class AuthApiController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;
    
	public function postSignin()
	{
		if(Input::has('auth')) {
			$auth = Input::get('auth');
			echo $auth;

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

		$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
          	'email' => Input::get('email'),
          	'password' => Input::get('password'),
	    );

		// Declare the rules for the form validation
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|between:3,32',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
    	return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);         
		}

	 	try {

			// Try to log the user in
			Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));
                       

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

			$email = Input::get('email');
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
			return Response::json(array('success' => true,  'message' => 'You have successfully logged in.', 'user_id' => Sentry::getUser()->id)); 

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$this->messageBag->add('success', false);
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		}  catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		return $this->messageBag;

		// Ooops.. something went wrong
		//return Response::make($this->messageBag);

		//return Redirect::back()->withInput()->withErrors($this->messageBag);
	}

	public function postSignup()
	{
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}
		
		$this->messageBag = new Illuminate\Support\MessageBag;

	  $input = array(
      'first_name' 				=> Input::get('first_name'),
      'last_name' 				=> Input::get('last_name'),
      'email' 						=> Input::get('email'),
      'password' 					=> Input::get('password'),
    );

		// Declare the rules for the form validation
		$rules = array(
			'first_name'       => 'required|min:3',
			'last_name'        => 'required|min:3',
			'email'            => 'required|email|unique:users',
			'password'         => 'required|between:3,32',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'message' => $validator->getMessageBag()->toArray()]);
		}
                
    $agent_id = Input::get('agent_id');
    if (!isset($agent_id)) {      
        $agent_id = 0;
    }
                
		try
		{
			// Register the user
			$user = Sentry::register(array(
				'first_name' => Input::get('first_name'),
				'last_name'  => Input::get('last_name'),
				'email'      => Input::get('email'),
				'password'   => Input::get('password'),
        		'added_by'   => $agent_id
			));

			$group = Sentry::getGroupProvider();

			if (Input::has('isagent')) {
				$agent = $group->findById(3);
				$user->addGroup($agent);								
			} else {
				$nuser = $group->findById(2);
				$user->addGroup($nuser);
			}
			
			$fund = new Funds;

			$fund->user_id = $user->id;
			$fund->balance = 0;
			$fund->credit_balance = 0;

			$fund->save();

			// Data to be used on the email view
			$data = array(
				'user'          => $user,
				'activationUrl' => URL::route('activate', $user->getActivationCode()),
			);

			//Mail::pretend();
			// Send the activation code through email
			Mail::queue('emails.register-activate', $data, function($m) use ($user)
			{
				$m->from('support@blackeyetravels.com', 'Blackeye Travels');
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Welcome ' . $user->first_name);
			});

			// Redirect to the register page
			return Response::json(['success' => Lang::get('auth/message.signup.success')]);

		} catch (Cartalyst\Sentry\Users\UserExistsException $e) {
			$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
		}

		// Ooops.. something went wrong
		return $this->messageBag;
	}

	public function getUserProfile()
	{
		$auth = Input::get('auth');
		echo "ram" .$auth;
		if(Input::has('auth')) {
			$auth = Input::get('auth');
			echo $auth;

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}

		if (Input::has('user_id')) {
			$user_id = Input::get('user_id');
			echo $user_id;
		} else {
			return Response::json(['success' => 'false', 'message' => 'User_id attribute is missing.']);
		}

		$profile_info = User::find($user_id);

		return $profile_info;				
	}

	public function getUserBalance()
	{
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}

		if (Input::has('user_id')) {
			$user_id = Input::get('user_id');
		} else {
			return Response::json(['success' => 'false', 'message' => 'User_id attribute is missing.']);
		}

		$entry = Funds::where('user_id', $user_id)->first();

		return $entry;				
	}
    
}
