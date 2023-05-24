<?php

class AgentController extends AuthorizedController {
    

	public function getIndex() {

			// Get all the blog posts
		$posts = Post::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate();

		// Show the page
		return View::make('backend.agent.index', compact('posts'));              
            
        }
        
        public function ListAllClients()
	{
		// Grab all the users
		//$users = Sentry::getUserProvider()->createModel();
            
            $id= Sentry::getUser()->id;
                            
         
                
               $users = User::where('added_by', $id);

		// Do we want to include the deleted users?
		if (Input::get('withTrashed'))
		{
			$users = $users->withTrashed();
		}
		else if (Input::get('onlyTrashed'))
		{
			$users = $users->onlyTrashed();
		}

		// Paginate the users
		$users = $users->paginate()
			->appends(array(
				'withTrashed' => Input::get('withTrashed'),
				'onlyTrashed' => Input::get('onlyTrashed'),
			));

		// Show the page
		return View::make('backend/agent/users/index', compact('users'));
	}
        
        public function clientgetEdit($id = null)
	{
		try
		{
			// Get the user information
			$user = Sentry::getUserProvider()->findById($id);

			// Get this user groups
			$userGroups = $user->groups()->lists('name', 'group_id');

			// Get this user permissions
			$userPermissions = array_merge(Input::old('permissions', array('superuser' => -1)), $user->getPermissions());
			$this->encodePermissions($userPermissions);

			// Get a list of all the available groups
			$groups = Sentry::getGroupProvider()->findAll();

			// Get all the available permissions
			$permissions = Config::get('permissions');
			$this->encodeAllPermissions($permissions);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}

		// Show the page
		return View::make('backend/users/edit', compact('user', 'groups', 'userGroups', 'permissions', 'userPermissions'));
	}

	/**
	 * User update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function clientpostEdit($id = null)
	{
		// We need to reverse the UI specific logic for our
		// permissions here before we update the user.
		$permissions = Input::get('permissions', array());
		$this->decodePermissions($permissions);
		app('request')->request->set('permissions', $permissions);

		try
		{
			// Get the user information
			$user = Sentry::getUserProvider()->findById($id);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}

		//
		$this->validationRules['email'] = "required|email|unique:users,email,{$user->email},email";

		// Do we want to update the user password?
		if ( ! $password = Input::get('password'))
		{
			unset($this->validationRules['password']);
			unset($this->validationRules['password_confirm']);
			#$this->validationRules['password']         = 'required|between:3,32';
			#$this->validationRules['password_confirm'] = 'required|between:3,32|same:password';
		}

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $this->validationRules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try
		{
			// Update the user
			$user->first_name  = Input::get('first_name');
			$user->last_name   = Input::get('last_name');
			$user->email       = Input::get('email');
			$user->activated   = Input::get('activated', $user->activated);
			$user->permissions = Input::get('permissions');

			// Do we want to update the user password?
			if ($password)
			{
				$user->password = $password;
			}

			// Get the current user groups
			$userGroups = $user->groups()->lists('group_id', 'group_id');

			// Get the selected groups
			$selectedGroups = Input::get('groups', array());

			// Groups comparison between the groups the user currently
			// have and the groups the user wish to have.
			$groupsToAdd    = array_diff($selectedGroups, $userGroups);
			$groupsToRemove = array_diff($userGroups, $selectedGroups);

			// Assign the user to groups
			foreach ($groupsToAdd as $groupId)
			{
				$group = Sentry::getGroupProvider()->findById($groupId);

				$user->addGroup($group);
			}

			// Remove the user from groups
			foreach ($groupsToRemove as $groupId)
			{
				$group = Sentry::getGroupProvider()->findById($groupId);

				$user->removeGroup($group);
			}

			// Was the user updated?
			if ($user->save())
			{
				// Prepare the success message
				$success = Lang::get('admin/users/message.success.update');

				// Redirect to the user page
				return Redirect::route('update/user', $id)->with('success', $success);
			}

			// Prepare the error message
			$error = Lang::get('admin/users/message.error.update');
		}
		catch (LoginRequiredException $e)
		{
			$error = Lang::get('admin/users/message.user_login_required');
		}

		// Redirect to the user page
		return Redirect::route('update/user', $id)->withInput()->with('error', $error);
	}

	/**
	 * Delete the given user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function clientgetDelete($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->findById($id);

			// Check if we are not trying to delete ourselves
			if ($user->id == Sentry::getId())
			{
				// Prepare the error message
				$error = Lang::get('admin/users/message.error.delete');

				// Redirect to the user management page
				return Redirect::route('users')->with('error', $error);
			}

			// Do we have permission to delete this user?
			if ($user->isSuperUser() and ! Sentry::getUser()->isSuperUser())
			{
				// Redirect to the user management page
				return Redirect::route('users')->with('error', 'Insufficient permissions!');
			}

			// Delete the user
			$user->delete();

			// Prepare the success message
			$success = Lang::get('admin/users/message.success.delete');

			// Redirect to the user management page
			return Redirect::route('users')->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id' ));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
	}


	public function SearchFlights() {
            
            return View::make('backend.agent.searchflights');
            
        }

 	public function getFlightAvailability() {

		$rules = array(
			'sectorFrom'   => 'required',
			'sectorTo' => 'required',
			'trip_type' => 'required',

			);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try {

		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));

		$addRequest = new stdClass();
		$addRequest->strUserId      = "BLKEYE"; 
		$addRequest->strPassword    = "PASSWORD";
		$addRequest->strAgencyId    = "PLZ004";
		$addRequest->strSectorFrom  = Input::get('sectorFrom');
		$addRequest->strSectorTo    = Input::get('sectorTo');
		$addRequest->strFlightDate  = Input::get('flight_date');
		$addRequest->strTripType    = Input::get('trip_type');
		$addRequest->strReturnDate  = Input::get('return_date');
		$addRequest->strNationality = "NP";
		$addRequest->intAdult       = Input::get('adults');
		$addRequest->intChild       = Input::get('children');

		$raw_flightavailability = $client->FlightAvailability($addRequest);

	    $flightavailability = new SimpleXMLElement($raw_flightavailability->return);

		}
		catch(SoapFault $exception)
		{
		$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		//$specific = ($exception->getMessage());

		return View::make('backend.agent.flightavail', compact('error'));
		}


		$trip_type = Input::get('trip_type');

		// Redirect to the new blog post page
		return View::make('backend.agent.flightavail', compact('flightavailability', 'trip_type'));
    }

    public function Reservation() {
    
    	// Declare the rules for the form validation
		$rules = array(
			'FlightId'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$flightid = Input::get('FlightId');

		$returnflightid = Input::get('ReturnFlightId');

		if (!empty($returnflightid)) {


			try {


		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));

	  	$addRequest = new stdClass();	
		$addRequest->strFlightId       = $flightid;
		$addRequest->strReturnFlightId = $returnflightid;

		$raw_reservation = $client->Reservation($addRequest);


		  $reservation = new SimpleXMLElement($raw_reservation->return);

		}
		catch(SoapFault $exception)
		{
		//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		
		$error = ($exception->getMessage());

		return View::make('backend.agent.reservation', compact('error'));

		}

		// Redirect to the new blog post page
		return View::make('backend.agent.reservation', compact('reservation'));	

		}
		else {

			try {


		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));


	  	$addRequest = new stdClass();	
		$addRequest->strFlightId       = $flightid;
		
		$raw_reservation = $client->Reservation($addRequest);


		  $reservation = new SimpleXMLElement($raw_reservation->return);

		}
		catch(SoapFault $exception)
		{
		//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		
		$error = ($exception->getMessage());

		return View::make('backend.agent.reservation', compact('error'));

		}

		// Redirect to the new blog post page
		return View::make('backend.agent.reservation', compact('reservation'));

		}
	}   

	public function getAgentLogo() {
		$entry = Sentry::getUser();		
		return View::make('backend.agent.logo', compact('entry'));
	}

	public function postAgentLogo() {

		// Declare the rules for the form validation
		$rules = array(
				'uploaded_picture' => 'required|image'
			);		

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$post = Sentry::getUser();	
		
		//Picture upload              
        $image = Input::file('uploaded_picture');
        
        if(isset($image)) {

	        File::delete('assets/img/uploads/agents'. $post->logo);

	        $filenamepart = time() . '-' . Str::random(20); 
	        
	        $imagename = 'logo_'. $filenamepart .'.'. $image->getClientOriginalExtension();

	        $imagemove = $image->move('assets/img/uploads/agents',  $imagename);
	        
	        $post->logo     = e($imagename);
        }     
        // /Picture Upload	

        // Was the agent logo updated?
        if ($post->save()) {
        	// Redirect back with sucess message
			return Redirect::back()->with('success', "Agent Logo updated");
        }

        // Redirect back with error message
		return Redirect::back()->with('error', "Agent Logo could not be updated.");
	}

}
