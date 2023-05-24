<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;
use Country;

class ProfileController extends AuthorizedController {

	/**
	 * User profile page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get the user information
		$user = Sentry::getUser();

		//Countries list
		$countries = Country::all();

		// Show the page
		return View::make('frontend/account/profile', compact('user', 'countries'));
	}
        
    public function getIndexAgent()
	{
		// Get the user information
		$user = Sentry::getUser();

		//Countries list
		$countries = Country::all();

		// Show the page
		return View::make('backend.agent.profile', compact('user', 'countries'));
	}
        
	/**
	 * User profile form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name'  => 'required|min:3',
			'website'    => 'url',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Grab the user
		$user = Sentry::getUser();

		// Update the user information
		$user->first_name      = Input::get('first_name');
		$user->last_name       = Input::get('last_name');
		$user->website         = Input::get('website');
		$user->country         = Input::get('country');
		$user->company_name    = Input::get('company_name');
		$user->company_address = Input::get('company_address');
		$user->pan_holder_name = Input::get('pan_holder_name');
		$user->pan_card_no     = Input::get('pan_card_no');
		$user->mobile          = Input::get('mobile'); 
                $user->address          = Input::get('address');
                
		$user->save();

		// Redirect to the settings page
		return Redirect::back()->with('success', 'Account successfully updated');
	}

}
