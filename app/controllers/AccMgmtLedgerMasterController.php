<?php

class AccMgmtLedgerMasterController extends BaseController {
    
    
    public function getIndex() {
        
        $entries = LedgerMaster::paginate(10);
        
        return View::make('backend.account_management.ledger_master.index', compact('entries'));
             
    }
          
    
    public function getCreate()
	{

		// Show the page
		return View::make('backend.account_management.ledger_master.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'product'   => 'required',
			'account_group' => 'required',
			'account_sub_group' => 'required',
			'account_type' => 'required',
			'ledger' => 'required',

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new ledger
		$post = new LedgerMaster;

		// Update the blog post data
		$post->product           = e(Input::get('product'));
		$post->account_group     = e(Input::get('account_group'));
		$post->account_sub_group = e(Input::get('account_sub_group'));
		$post->account_type      = e(Input::get('account_type'));
		$post->ledger    	     = e(Input::get('ledger'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Ledger has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Ledger coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = LedgerMaster::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}

		// Show the page
		return View::make('backend.account_management.ledger_master.edit', compact('entry'));
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
			'product'   => 'required',
			'account_group' => 'required',
			'account_sub_group' => 'required',
			'account_type' => 'required',
			'ledger' => 'required',

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = LedgerMaster::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}


		// Update the blog post data
		$post->product           = e(Input::get('product'));
		$post->account_group     = e(Input::get('account_group'));
		$post->account_sub_group = e(Input::get('account_sub_group'));
		$post->account_type      = e(Input::get('account_type'));
		$post->ledger    	     = e(Input::get('ledger'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Ledger updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update ledger.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = LedgerMaster::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Ledger deleted successfully");
	}
    
    
    
    
}
