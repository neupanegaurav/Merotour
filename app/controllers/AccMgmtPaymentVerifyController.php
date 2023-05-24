<?php

class AccMgmtPaymentVerifyController extends BaseController {
    
    
    public function getIndex() {
     
        $entries = PaymentVerify::paginate(10);
        
        return View::make('backend.account_management.payment_verify.index', compact('entries'));
             
    }
          
    
    public function getCreate()
	{

		// Show the page
		return View::make('backend.account_management.payment_verify.create');
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
		if (is_null($entry = PaymentVerify::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}

		// Show the page
		return View::make('backend.account_management.payment_verify.edit', compact('entry'));
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
                
                if (is_null($post = PaymentVerify::find($id)))
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
		if (is_null($entry = PaymentVerify::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Ledger deleted successfully");
	}

	public function getApprove($id)
	{
		// Check if the blog post exists
		if (is_null($entry = PaymentVerify::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the payment.");
		}

		$post = new GeneralVoucher;

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


		$funds = Funds::where('user_id', $entry->user_id)->first();
        
        $balance = $funds->balance;

    	$new_balance = $balance + $entry->amount;

    	$checkcredit = CreditLimitTransactions::where('user_id', $entry->user_id)->first();

    	if (!empty($checkcredit)) {
    		$credit_amount = $checkcredit->amount;

    		$new_balance = $new_balance - $credit_amount;
    	}


    	$funds->balance = $new_balance;

		if($post->save() and $funds->save() )
		{
			$entry->delete();
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Payment approved successfully");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Payment coudn't be approved");	
	
	}

	public function getUnapprove($id)
	{
		// Check if the blog post exists
		if (is_null($entry = PaymentVerify::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the payment.");
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

		if($post->save())
		{
			$entry->delete();
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Payment unapproved");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Payment coudn't be approved");	

		
	}


    
    
    
}
