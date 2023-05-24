<?php

class CreditLimitManagement extends BaseController {
    
    
    public function getIndex() 
    {  
    	if(Request::is(Session::get('account_type') . '/account-management/credit-limit-management-bo')) 
    	{
    		$slug = 'credit_limit_management_bo';
    	}
    	elseif(Request::is(Session::get('account_type') . '/account-management/credit-limit-management-db')) 
    	{
    		$slug = 'credit_limit_management_db';
    	}
    	else
    	{
    		$slug = 'credit_limit_management';
    	}

        $entries = CreditLimitManagement::paginate(10);
        
        return View::make('backend.account_management.'.$slug.'.index', compact('entries'));    
    }

     public function postIndex()
	{

		if(Request::is(Session::get('account_type') . '/account-management/credit-limit-management-bo')) 
    	{
    		$slug = 'credit_limit_management_bo';
    	}
    	elseif(Request::is(Session::get('account_type') . '/account-management/credit-limit-management-db')) 
    	{
    		$slug = 'credit_limit_management_db';
    	}
    	else
    	{
    		$slug = 'credit_limit_management';
    	}
	

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
			$user = $userq->first();
		}

		$entriesq = CreditLimitManagement::query();

		if(!empty($user->id)) {

		 $entriesq->where('user_id', $user->id);

		}
		
		$entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend.account_management.' .$slug. '.index', compact('entries'));

	}
          
    
    public function getCreate()
	{

		$user = Sentry::getUser();
	    $group = Sentry::getGroupProvider(); 
	    $admin = $group->findById(1);
	    $nuser = $group->findById(2);  
	    $agent = $group->findById(3); 
	    $affiliate = $group->findById(4);
	    $manager = $group->findById(5); 
	    $distributor = $group->findById(6);
	    $corporate = $group->findById(7);

	    if($user->inGroup($admin)) 
	    {

	        $prefix = 'admin';
	        Session::put('account_type', $prefix);

	    }
	    elseif ($user->inGroup($nuser)) {
	        $prefix = 'user';
	        Session::put('account_type', $prefix);
	    }

	    elseif ($user->inGroup($agent)) {
	        $prefix = 'agent';
	        Session::put('account_type', $prefix);
	    }

	    elseif ($user->inGroup($manager)) {
	        $prefix = 'manager';
	        Session::put('account_type', $prefix);
	    }

	    elseif ($user->inGroup($affiliate)) {
	        $prefix = 'affiliate';
	        Session::put('account_type', $prefix);
	    }

	    elseif ($user->inGroup($distributor)) {
	        $prefix = 'distributor';
	        Session::put('account_type', $prefix);
	    }

	    elseif ($user->inGroup($corporate)) {
	        $prefix = 'corporate';
	        Session::put('account_type', $prefix);
	    }

	    else{

	        $prefix = 'admin';
	        Session::put('account_type', $prefix);

	    }
		//Get users
		$users_list = User::all();



		// Show the page
//		return View::make('backend.account_management.credit_limit_management.create', compact('users_list'));
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'amount'   => 'required|integer',
			'currency' => 'required',
			'debit_credit' => 'required',
			'user' => 'required',
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
		$post = new CreditLimitManagement;

		// Update the blog post data
		$post->invoice_no 			= $entry->invoice_no;
		$post->user_id     			= $entry->user_id;
		$post->payment_for  		= $entry->payment_for;
		$post->debit_credit         = $entry->debit_credit;
		$post->currency     		= $entry->currency;
		$post->amount 				= $entry->amount;
		$post->date      			= $entry->date;
		$post->remarks 				= $entry->remarks;
		$post->remarks1             = 'CreditLimitRequest';
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Credit Request has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Credit Request coudn't be created");
	}
        
        
    public function getEdit($id)
	{

		if (is_null($entry = CreditLimitManagement::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}

		// Show the page
		return View::make('backend.account_management.credit_limit_management.edit', compact('entry'));
	}

	public function postEdit($id)
	{

		// Declare the rules for the form validation
		$rules = array(
			'amount'   => 'required',
			'start_date' => 'required',
			'expire_date' => 'required',
			'remarks' => 'required',
			'status' => 'required',
			'paid_unpaid' => 'required|integer',
			
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}               
                if (is_null($post = CreditLimitManagement::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}

		// Update the blog post data
		$post->amount 	= e(Input::get('amount'));
		$post->start_date 	= Input::get('start_date');
		$post->expire_date 	= Input::get('expire_date');
		$post->remarks 	= e(Input::get('remarks'));
		$post->status 	= e(Input::get('status'));
		$post->paid_unpaid 	= e(Input::get('paid_unpaid'));
		$post->paid_date 	= e(Input::get('paid_date'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Credit Request updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update ledger.");
	
	}
   
    
    public function getDelete($id)
	{

		// Check if the blog post exists
		if (is_null($entry = CreditLimitManagement::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Credit Request deleted successfully");
	}

	public function getApprove($id)
	{
		// Check if the entry exists
		if (is_null($entry = CreditLimitManagement::find($id)))
		{
			return Redirect::back()->with('error', "Couldn't find the credit request.");
		}
		if($entry->status != 'Pending') 
		{
			return Redirect::back()->with('error', "Credit Request is already processed.");
		}

		/*$post = new CreditLimitTransactions;

		$post->invoice_no 			= $entry->invoice_no;
		$post->user_id     			= $entry->user_id;
		$post->payment_for  		= $entry->payment_for;
		$post->debit_credit         = $entry->debit_credit;
		$post->currency     		= $entry->currency;
		$post->amount 				= $entry->amount;
		$post->date      			= $entry->date;
		$post->transaction_id      	= $entry->transaction_id;
		$post->deposited_in_bank 	= $entry->deposited_in_bank;
		$post->bank_branch 			= $entry->bank_branch;
		$post->remarks 				= $entry->remarks;
		$post->remarks1             = $entry->remarks1;*/

		$entry->status = 'Approved';

		$funds = Funds::where('user_id', $entry->user_id)->first();
        
        $credit_balance = $funds->credit_balance;

    	$new_credit_balance = $credit_balance + $entry->amount;

    	$funds->credit_balance = $new_credit_balance;


		if($entry->save() and $funds->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Credit approved successfully");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Credit coudn't be approved");	

	}

	public function getUnapprove($id)
	{
		// Check if the blog post exists
		if (is_null($entry = CreditLimitManagement::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the credit request.");
		}

		elseif($entry->status != 'Pending') 
		{
			return Redirect::back()->with('error', "Credit Request is already processed.");
		}

		$post = new UnapproveVoucher;

		$post->invoice_no 			= $entry->invoice_no;
		$post->user_id     			= $entry->user_id;
		$post->payment_for  		= $entry->payment_for;
		$post->debit_credit         = $entry->debit_credit;
		$post->currency     		= $entry->currency;
		$post->amount 				= $entry->amount;
		$post->date      			= $entry->date;
		$post->transaction_id      	= $entry->transaction_id;
		$post->deposited_in_bank 	= $entry->deposited_in_bank;
		$post->bank_branch 			= $entry->bank_branch;
		$post->remarks 				= $entry->remarks;
		$post->remarks1             = $entry->remarks1;

		$entry->status = 'Unapproved';

		if($post->save() and $entry->save())
		{
			
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Credit uapproved");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Credit coudn't be approved");	

		
	}


    
    
    
}
