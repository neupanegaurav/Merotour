<?php

class AccMgmtGeneralVoucherController extends BaseController {
  
    public function getIndex() {
        
        $entries = GeneralVoucher::orderBy('created_at', 'DESC')->paginate(10);
        
        return View::make('backend.account_management.general_voucher.index', compact('entries'));           
    }

    public function postIndex()
	{
	

		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		$invoice_no = Input::get('invoice_no');

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
			$user = $userq->first();
		}

		$entriesq = GeneralVoucher::query();

		if(!empty($user->id)) {

		 $entriesq->where('user_id', $user->id);

		}

		if(!empty($invoice_no))
		{
			$entriesq->where('invoice_no', $invoice_no);
		}	
		

		$entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend.account_management.general_voucher.index', compact('entries'));

	}
          
    
    public function getCreate()
	{
		//Get users

		$users_list = User::all();

		// Show the page
		return View::make('backend.account_management.general_voucher.create', compact('users_list'));
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
		$post = new GeneralVoucher;

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
		if (is_null($entry = GeneralVoucher::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected general voucher.");
		}

		//Get users

		$users_list = User::all();

		// Show the page
		return View::make('backend.account_management.general_voucher.edit', compact('entry', 'users_list'));
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
                
                if (is_null($post = GeneralVoucher::find($id)))
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
		if (is_null($entry = GeneralVoucher::find($id)))
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
