<?php

class AuthController extends BaseController {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	public function getSignin()
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		// Show the page
		return View::make('frontend.auth.signin');
	}

	/**
	 * Account sign in form processing.
	 *
	 * @return Redirect
	 */
	public function postSignin()
	{
		// Declare the rules for the form validation
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|between:3,32',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			Session::put('loginboxerror', TRUE);
			return Redirect::back()->withInput()->withErrors($validator);
		}


       try
		{

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

			$login_history->method = 'web';	

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

			if(Session::has('loginRedirect')) {

				$redirect = Session::get('loginRedirect');	

				Session::remove('loginRedirect');	   

			}	else {
					if ( $user->inGroup($admin) ) 
					 	{ 
							$redirect = 'admin'; 
					 	}

		            elseif ($user->inGroup($agent)) 
				    	{

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
			    				return Redirect::back()->withInput()->with('error', 'Agent login temporarily disabled. Please check back later.');
				    		} else {
				    			$redirect = 'agent';
				    		}	
						}

		            elseif ($user->inGroup($manager)) 
		            	{
		            		$redirect = 'manager';
		        		}
		            elseif ($user->inGroup($affiliate)) 
		            	{
		            		$redirect = 'affiliate';
		        		}

		        	elseif ($user->inGroup($distributor)) 
		            	{
		            		$redirect = 'distributor';
		        		}

		        	elseif ($user->inGroup($corporate)) 
		            	{
		            		$redirect = 'corporate';
		        		}

		            else 
		            	{
		            	$redirect = 'account/profile';
		        		}
					}



			if (Session::has('flightloginredirect')) {

				return Redirect::to('reservation')->with('success', 'Login successful, please continue booking');

			}


			// Redirect to the users page
			return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));
                        
                        
                        
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		Session::put('loginboxerror', TRUE);

		// Ooops.. something went wrong
		return Redirect::back()->withInput()->withErrors($this->messageBag);
	}

	/**
	 * Account sign up.
	 *
	 * @return View
	 */
	public function getSignup()
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		// Show the page
		return View::make('frontend.auth.signup');
	}
        
    public function getSignupAgent()
	{
		
		// Show the page
		return View::make('backend.agent.signup');
	}

	/**
	 * Account sign up form processing.
	 *
	 * @return Redirect
	 */
	public function postSignup()
	{
		// Declare the rules for the form validation
		$rules = array(
			'first_name'       => 'required|min:3',
			'last_name'        => 'required|min:3',
			'email'            => 'required|email|unique:users',
			'email_confirm'    => 'required|email|same:email',
			'password'         => 'required|between:3,32',
			'password_confirm' => 'required|same:password',
			'captcha' 		   => 'required|captcha',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
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

			// Send the activation code through email
			Mail::queue('emails.register-activate', $data, function($m) use ($user)
			{
				$m->from('support@blackeyetravels.com', 'Blackeye Travels');
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Welcome ' . $user->first_name);
			});

			// Redirect to the register page
			return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
		}

		// Ooops.. something went wrong
		return Redirect::back()->withInput()->withErrors($this->messageBag);
	}

	/**
	 * User account activation page.
	 *
	 * @param  string  $actvationCode
	 * @return
	 */
	public function getActivate($activationCode = null)
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		try
		{
			// Get the user we are trying to activate
			$user = Sentry::getUserProvider()->findByActivationCode($activationCode);

			// Try to activate this user account
			if ($user->attemptActivation($activationCode))
			{
				// Redirect to the login page
				return Redirect::route('signin')->with('success', Lang::get('auth/message.activate.success'));
			}

			// The activation failed.
			$error = Lang::get('auth/message.activate.error');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$error = Lang::get('auth/message.activate.error');
		}

		// Ooops.. something went wrong
		return Redirect::route('signin')->with('error', $error);
	}

	/**
	 * Forgot password page.
	 *
	 * @return View
	 */
	public function getForgotPassword()
	{
		// Show the page
		return View::make('frontend.auth.forgot-password');
	}

	/**
	 * Forgot password form processing page.
	 *
	 * @return Redirect
	 */
	public function postForgotPassword()
	{
		// Declare the rules for the validator
		$rules = array(
			'email' => 'required|email',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password')->withInput()->withErrors($validator);
		}

		try
		{
			// Get the user password recovery code
			
			$user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

			// Data to be used on the email view
			$data = array(
				'user'              => $user,
				'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
			);

			// Send the activation code through email
			Mail::queue('emails.forgot-password', $data, function($m) use ($user)
			{
				$m->from('support@blackeyetravels.com', 'Blackeye Travels');
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Account Password Recovery');
			});
			
		}
		
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Even though the email was not found, we will pretend
			// we have sent the password reset code through email,
			// this is a security measure against hackers.
		}

		//  Redirect to the forgot password
		return Redirect::route('forgot-password')->with('success', Lang::get('auth/message.forgot-password.success'));
	}

	/**
	 * Forgot Password Confirmation page.
	 *
	 * @param  string  $passwordResetCode
	 * @return View
	 */
	public function getForgotPasswordConfirm($passwordResetCode = null)
	{
		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
		}
		catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}

		// Show the page
		return View::make('frontend.auth.forgot-password-confirm');
	}

	/**
	 * Forgot Password Confirmation form processing page.
	 *
	 * @param  string  $passwordResetCode
	 * @return Redirect
	 */
	public function postForgotPasswordConfirm($passwordResetCode = null)
	{
		// Declare the rules for the form validation
		$rules = array(
			'password'         => 'required',
			'password_confirm' => 'required|same:password'
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
		}

		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

			// Attempt to reset the user password
			if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
			{
				// Password successfully reseted
				return Redirect::route('signin')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
			}
			else
			{
				// Ooops.. something went wrong
				return Redirect::route('signin')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}
	}

	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		// Log the user out
		Sentry::logout();

		// Redirect to the users page
		return Redirect::route('home')->with('success', 'You have successfully logged out!');
	}

}
