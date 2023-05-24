<?php

class CreditTransactionHistoryController extends BaseController {
    
    public function getIndex() {
        
        $entries = CreditLimitTransactions::where('user_id', Sentry::getUser()->id)->orderBy('created_at', 'DESC')->paginate(10);
        
        return View::make('backend.credit_transaction_history.index', compact('entries'));
             
    }

    public function postIndex()
	{
		$from = Input::get('from_date');
		$to = Input::get('to_date');

		$entriesq = CreditLimitTransactions::query();

		if(!empty($from) and !empty($to)) {
			$entriesq->whereBetween('created_at', array($from, $to));
		}
		
		$entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend.credit_transaction_history.index', compact('entries'));
	}
          
    
    public function getCreate()
	{
		//Get users

		$users_list = User::all();

		// Show the page
		return View::make('backend.credit_transaction_history.create', compact('users_list'));
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'dr_cr'   => 'required',
			'account_name' => 'required',
			'narration' => 'required',
			'payment_for' => 'required'

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new general voucher
		$post = new CreditLimitTransactions;

		// Update the blog post data
		$post->user_id                  = e(Input::get('user_id'));
		$post->payment_for           	= e(Input::get('payment_for'));
		$post->dr_cr           			= e(Input::get('dr_cr'));
		$post->amount           		= e(Input::get('amount'));
		$post->date           			= e(Input::get('date'));
		$post->transaction_id           = e(Input::get('transaction_id'));
		$post->currency     			= e(Input::get('currency'));
		$post->deposited_in_bank 		= e(Input::get('deposited_in_bank'));
		$post->bank_branch      		= e(Input::get('bank_branch'));
		$post->category_name    	    = e(Input::get('category_name'));
		$post->package_name    	    	= e(Input::get('package_name'));
		$post->package_id    	    	= e(Input::get('package_id'));
		$post->remarks    	    		= e(Input::get('remarks'));

		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "General Voucher has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "General Voucher coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = CreditLimitTransactions::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected general voucher.");
		}

		//Get users

		$users_list = User::all();

		// Show the page
		return View::make('backend.credit_transaction_history.edit', compact('entry', 'users_list'));
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
			'dr_cr'   => 'required',
			'account_name' => 'required',
			'narration' => 'required',
			'payment_for' => 'required'

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = CreditLimitTransactions::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected general voucher.");
		}


		// Update the blog post data
		$post->user_id                  = e(Input::get('user_id'));
		$post->payment_for           	= e(Input::get('payment_for'));
		$post->dr_cr           			= e(Input::get('dr_cr'));
		$post->amount           		= e(Input::get('amount'));
		$post->date           			= e(Input::get('date'));
		$post->transaction_id       	= e(Input::get('transaction_id'));
		$post->currency     			= e(Input::get('currency'));
		$post->deposited_in_bank 		= e(Input::get('deposited_in_bank'));
		$post->bank_branch      		= e(Input::get('bank_branch'));
		$post->category_name    	    = e(Input::get('category_name'));
		$post->package_name    	    	= e(Input::get('package_name'));
		$post->package_id    	    	= e(Input::get('package_id'));
		$post->remarks    	    		= e(Input::get('remarks'));

		
		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "General Voucher updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update general voucher.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = CreditLimitTransactions::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "General Voucher deleted successfully");
	}
    
    
    
    
}
