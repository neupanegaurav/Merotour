<?php namespace Controllers\Admin;

use AdminController;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Config;
use Input;
use Lang;
use Redirect;
use Sentry;
use Validator;
use View;
use User;
use Session;
use Request;

class UsersController extends AdminController {

	/**
	 * Declare the rules for the form validation
	 *
	 * @var array
	 */
	protected $validationRules = array(
		'first_name'       => 'required|min:3',
		'last_name'        => 'required|min:3',
		'email'            => 'required|email|unique:users,email',
                'role'             => 'required|min:3',
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
		// Grab all the users
		$users = Sentry::getUserProvider()->createModel();

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
		$users = $users->get();
                               
//                $users= DB::table('user_groups')->get();
		$userprovider = Sentry::getUserProvider();
  	$group = Sentry::getGroupProvider(); 
		$nuser = $group->findById(2);

		if(Request::is(Session::get('account_type') . '/b2c/userslist'))
    {
			$users = $users->filter(function($user) use($userprovider, $nuser)
				    {
				    	try {
				    			$current_user = $userprovider->findById($user->id);
				    	} catch (UserNotFoundException $e) {
				    	 	return false;				    	 	
				    	} 

				        if ($current_user->inGroup($nuser)) 
					        {
				            	return true;
				        	}
				   	});	
		}

		

		// Show the page
		return View::make('backend/users/index', compact('users'));
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
		$nuser = $group->findById(2);

		if(Request::is(Session::get('account_type') . '/b2c/userslist'))
    {
			$users = $users->filter(function($user) use($userprovider, $nuser)
				    { 
				        $current_user = $userprovider->findById($user->id);

				        if ($current_user->inGroup($nuser)) 
					        {
				            	return true;
				        	}
				   	});	
		}

		// Show the page
		return View::make('backend/users/index', compact('users'));
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
		$permissions = Config::get('permissions');
		$this->encodeAllPermissions($permissions);

		// Selected permissions
		$selectedPermissions = Input::old('permissions', array('superuser' => -1));
		$this->encodePermissions($selectedPermissions);

		// Show the page
		return View::make('backend/users/create', compact('groups', 'selectedGroups', 'permissions', 'selectedPermissions'));
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
				// Assign the selected groups to this user
				foreach (Input::get('groups', array()) as $groupId)
				{
					$group = Sentry::getGroupProvider()->findById($groupId);

					$user->addGroup($group);
				}

				// Prepare the success message
				$success = Lang::get('admin/users/message.success.create');

				// Redirect to the new user page
				return Redirect::route('create/user')->with('success', $success);
			}

			// Prepare the error message
			$error = Lang::get('admin/users/message.error.create');

			// Redirect to the user creation page
			return Redirect::route('create/user')->with('error', $error);
		}
		catch (LoginRequiredException $e)
		{
			$error = Lang::get('admin/users/message.user_login_required');
		}
		catch (PasswordRequiredException $e)
		{
			$error = Lang::get('admin/users/message.user_password_required');
		}
		catch (UserExistsException $e)
		{
			$error = Lang::get('admin/users/message.user_exists');
		}

		// Redirect to the user creation page
		return Redirect::route('create/user')->withInput()->with('error', $error);
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

			reset($userGroups);
			$first_key = key($userGroups);

			switch ($first_key) {
				case 1:
					$permissions = Config::get('permissions');
					break;
				case 3:
					$permissions = Config::get('agent_permissions');
					break;
				case 5:
					$permissions = Config::get('manager_permissions');
					break;					
				default:
					$permissions = Config::get('permissions');
					break;
			}

			$this->encodeAllPermissions($permissions);
		} catch (UserNotFoundException $e) {
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
                        $user->role       = Input::get('role');
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
			$error = Lang::get('admin/users/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
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
			$success = Lang::get('admin/users/message.success.restored');

			// Redirect to the user management page
			return Redirect::route('users')->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
	}

}
