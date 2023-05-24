<?php 

class ManagerManagementController extends AdminController {

	/**
	 * Declare the rules for the form validation
	 *
	 * @var array
	 */
	protected $validationRules = array(
		'first_name'       => 'required|min:3',
		'last_name'        => 'required|min:3',
		'email'            => 'required|email|unique:users,email',
		'password'         => 'required|between:3,32',
		'password_confirm' => 'required|between:3,32|same:password',
	);

	/**
	 * Show a list of all the users.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Paginate the users
		//$users = User::paginate(10);

		$user_list_raw = User::all();

	    $userprovider = Sentry::getUserProvider();
	   	$group = Sentry::getGroupProvider(); 
		$manager = $group->findById(5);

	  	$users = $user_list_raw->filter(function($user) use($userprovider, $manager)
	    { 
	        $current_user = $userprovider->findById($user->id);

	        if ($current_user->inGroup($manager)) 
		        {
	            	return true;
	        	}
	   	});	

		// Show the page
		return View::make('backend.manager_management.index', compact('users'));
	}

	public function postIndex()
	{
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');

		$userq = User::query();

		if(!empty($first_name))
		{
			$userq->where('first_name', $first_name);

		}
		if(!empty($last_name))
		{
			$userq->where('last_name', $last_name);
		}	

		// Run query if at least one of the two variables above is not empty.
		if(!empty($first_name) or !empty($last_name))
		{
			$users = $userq->get();
		} else {
			$users = User::all();
		}

		$userprovider = Sentry::getUserProvider();
   	$group = Sentry::getGroupProvider(); 
		$manager = $group->findById(5);

  	$users = $users->filter(function($user) use($userprovider, $manager)
    { 
        $current_user = $userprovider->findById($user->id);

        if ($current_user->inGroup($manager)) 
	        {
            	return true;
        	}
   	});

		// Show the page
		return View::make('backend.manager_management.index', compact('users'));
	}



	/**
	 * User create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Get all the available groups
		$groups = Sentry::getGroupProvider()->findAll();

		// Selected groups
		$selectedGroups = Input::old('groups', array());

		// Get all the available permissions
		$permissions = Config::get('manager_permissions');
		$this->encodeAllPermissions($permissions);

		// Selected permissions
		$selectedPermissions = Input::old('permissions', array('superuser' => -1));
		$this->encodePermissions($selectedPermissions);

		// Show the page
		return View::make('backend.manager_management.create', compact('groups', 'selectedGroups', 'permissions', 'selectedPermissions'));
	}

	/**
	 * User create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
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
			// We need to reverse the UI specific logic for our
			// permissions here before we create the user.
			$permissions = Input::get('permissions', array());
			$this->decodePermissions($permissions);
			app('request')->request->set('permissions', $permissions);

			// Get the inputs, with some exceptions
			$inputs = Input::except('csrf_token', 'password_confirm', 'groups');

			// Was the user created?
			if ($user = Sentry::getUserProvider()->create($inputs))
			{
				// Assign the manager group to this user
				
					$group = Sentry::getGroupProvider()->findById(5);

					$user->addGroup($group);
				
				// Prepare the success message
				$success = Lang::get('admin/managers/message.success.create');

				// Redirect to the new user page
				return Redirect::back()->with('success', $success);
			}

			// Prepare the error message
			$error = Lang::get('admin/managers/message.error.create');

			// Redirect to the user creation page
			return Redirect::back()->with('error', $error);
		}
		catch (LoginRequiredException $e)
		{
			$error = Lang::get('admin/managers/message.user_login_required');
		}
		catch (PasswordRequiredException $e)
		{
			$error = Lang::get('admin/managers/message.user_password_required');
		}
		catch (UserExistsException $e)
		{
			$error = Lang::get('admin/managers/message.user_exists');
		}

		// Redirect to the user creation page
		return Redirect::back()->withInput()->with('error', $error);
	}

	/**
	 * User update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getEdit($id = null)
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
			$permissions = Config::get('manager_permissions');
			$this->encodeAllPermissions($permissions);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/managers/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::back()->with('error', $error);
		}

		// Show the page
		return View::make('backend.manager_management.edit', compact('user', 'groups', 'userGroups', 'permissions', 'userPermissions'));
	}

	/**
	 * User update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
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
			$error = Lang::get('admin/managers/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::back()->with('error', $error);
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
			$user->company_name = Input::get('company_name');
			$user->company_address = Input::get('company_address');
			$user->credit_limit = Input::get('credit_limit');
			$user->pan_holder_name = Input::get('pan_holder_name');
			$user->pan_card_no = Input::get('pan_card_no');


			// Do we want to update the user password?
			if ($password)
			{
				$user->password = $password;
			}


			// Was the user updated?
			if ($user->save())
			{
				// Prepare the success message
				$success = Lang::get('admin/managers/message.success.update');

				// Redirect to the user page
				return Redirect::back()->with('success', $success);
			}

			// Prepare the error message
			$error = Lang::get('admin/managers/message.error.update');
		}
		catch (LoginRequiredException $e)
		{
			$error = Lang::get('admin/managers/message.user_login_required');
		}

		// Redirect to the user page
		return Redirect::back()->withInput()->with('error', $error);
	}

	/**
	 * Delete the given user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->findById($id);

			// Check if we are not trying to delete ourselves
			if ($user->id == Sentry::getId())
			{
				// Prepare the error message
				$error = Lang::get('admin/managers/message.error.delete');

				// Redirect to the user management page
				return Redirect::back()->with('error', $error);
			}

			// Do we have permission to delete this user?
			if ($user->isSuperUser() and ! Sentry::getUser()->isSuperUser())
			{
				// Redirect to the user management page
				return Redirect::back()->with('error', 'Insufficient permissions!');
			}

			// Delete the user
			$user->delete();

			// Prepare the success message
			$success = Lang::get('admin/managers/message.success.delete');

			// Redirect to the user management page
			return Redirect::back()->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/managers/message.user_not_found', compact('id' ));

			// Redirect to the user management page
			return Redirect::back()->with('error', $error);
		}
	}


	public function getClass()
	{
		// Paginate the users
		$entries = AgentClass::all();

		// Show the page
		return View::make('backend.manager_management.class', compact('entries'));
	}

	public function postClass()
	{
		// Declare the rules for the form validation
		$rules = array(
			'discount_percentage_a'   => 'required',
			'credit_limit_a' => 'required',
			'discount_percentage_b'   => 'required',
			'credit_limit_b' => 'required',
			'discount_percentage_c'   => 'required',
			'credit_limit_c' => 'required',
			'discount_percentage_d'   => 'required',
			'credit_limit_d' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        if (is_null($post_a = AgentClass::where('class', 'A')->first()))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the class.");
		}


		// Update the blog post data
		$post_a->discount_percentage = e(Input::get('discount_percentage_a'));
		$post_a->credit_limit    = e(Input::get('credit_limit_a'));
		
		if (is_null($post_b = AgentClass::where('class', 'B')->first()))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the class.");
		}


		// Update the blog post data
		$post_b->discount_percentage = e(Input::get('discount_percentage_b'));
		$post_b->credit_limit    = e(Input::get('credit_limit_b'));

		if (is_null($post_c = AgentClass::where('class', 'C')->first()))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the class.");
		}


		// Update the blog post data
		$post_c->discount_percentage = e(Input::get('discount_percentage_c'));
		$post_c->credit_limit    = e(Input::get('credit_limit_c'));

		if (is_null($post_d = AgentClass::where('class', 'D')->first()))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the class.");
		}


		// Update the blog post data
		$post_d->discount_percentage = e(Input::get('discount_percentage_d'));
		$post_d->credit_limit    = e(Input::get('credit_limit_d'));



		// Was the blog post updated?
		if($post_a->save() and $post_b->save() and $post_c->save() and $post_d->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Agent Class updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update Agent Class.");
	
	}

	/**
	 * Restore a deleted user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getRestore($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->createModel()->withTrashed()->find($id);

			// Restore the user
			$user->restore();

			// Prepare the success message
			$success = Lang::get('admin/managers/message.success.restored');

			// Redirect to the user management page
			return Redirect::back()->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/managers/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::back()->with('error', $error);
		}
	}


}
