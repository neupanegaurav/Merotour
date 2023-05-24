<?php

class MyBankAccountController extends BaseController {
      
    public function getIndex() {
        $entries = MyBankAccount::all();
        $paypal = PGSettings::find(1);
        $cash = PGSettings::find(2);
        $bank = PGSettings::find(3);
		return View::make('backend.payment_gateways.index', compact('entries', 'paypal', 'cash', 'bank'));             
    }

    public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'paypal_enabled'   		=> 'required',
			'cash_enabled'   		=> 'required',
			'bank_enabled'   		=> 'required',

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (
                	is_null($post1 = PGSettings::find(1)) or
                	is_null($post2 = PGSettings::find(2)) or
                	is_null($post3 = PGSettings::find(3))
                	)
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected bank.");
		}

		// Update the blog post data
		$post1->enabled = e(Input::get('paypal_enabled'));
		$post1->address = e(Input::get('paypal_email_address'));
		$post2->enabled = e(Input::get('cash_enabled'));
		$post3->enabled = e(Input::get('bank_enabled'));


		// Was the blog post updated?
		if($post1->save() and $post2->save() and $post3->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Payment gateway settings updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update payment gateway settings.");
	
	}
   
    public function getCreate()
	{
		// Show the page
		return View::make('backend.account_management.my_bank_account.create');
	}
       
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'bank_name'   		=> 'required',
			'bank_branch' 		=> 'required',
			'account_name' 		=> 'required',
			'account_number' 	=> 'required',
			'swift_code' 		=> 'required',
			'company_name' 		=> 'required'

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new bank
		$post = new MyBankAccount;

		// Update the blog post data
		$post->bank           		= e(Input::get('bank_name'));
		$post->branch     			= e(Input::get('bank_branch'));
		$post->account_name 		= e(Input::get('account_name'));
		$post->account_number      	= e(Input::get('account_number'));
		$post->swift_code    	    = e(Input::get('swift_code'));
		$post->company_name    	    = e(Input::get('company_name'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Bank has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Bank coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = MyBankAccount::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected bank.");
		}

		// Show the page
		return View::make('backend.account_management.my_bank_account.edit', compact('entry'));
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
			'bank_name'   		=> 'required',
			'bank_branch' 		=> 'required',
			'account_name' 		=> 'required',
			'account_number' 	=> 'required',
			'swift_code' 		=> 'required',
			'company_name' 		=> 'required'

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = MyBankAccount::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected bank.");
		}


		// Update the blog post data
		$post->bank           = e(Input::get('bank_name'));
		$post->branch     = e(Input::get('bank_branch'));
		$post->account_name = e(Input::get('account_name'));
		$post->account_number      = e(Input::get('account_number'));
		$post->swift_code    	     = e(Input::get('swift_code'));
		$post->company_name    	     = e(Input::get('company_name'));
		
		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Bank updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update bank.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = ConfigureAccount::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Bank deleted successfully");
	}
    
   
}
