<?php

class MakePaymentController extends BaseController {
    
    public function getIndex() {
        
        return View::make('backend.agent.make_payment');         
    }
                
    public function postCash()
	{
		// Declare the rules for the form validation
		$rules = array(
			'cash_currency'   => 'required',
			'cash_amount' => 'required',
			'cash_date' => 'required',
			'cash_transaction_id' => 'required',
			'cash_deposited_in_bank' => 'required',
			'cash_bank_branch' => 'required',
			'cash_remarks' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator)->with('tab', 'cash');
		}

		// Create a new ledger
		$post = new PaymentVerify;

		// Update the blog post data

		$old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		}

		else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}
		$post->invoice_no   = $invoice_no;
	
		
		$post->user_id     = Sentry::getUser()->id;
		$post->payment_for  = e('cash');
		$post->debit_credit  = e('credit');
		$post->currency     = e(Input::get('cash_currency'));
		$post->amount = e(Input::get('cash_amount'));
		$post->date      = e(Input::get('cash_date'));
		$post->transaction_id      = e(Input::get('cash_transaction_id'));
		$post->deposited_in_bank = e(Input::get('cash_deposited_in_bank'));
		$post->bank_branch = e(Input::get('cash_bank_branch'));
		$post->remarks = e(Input::get('cash_remarks'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your payment details has been submitted for verification");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Ledger coudn't be created");
	}

	 public function postBankTransfer()
	{
		
		// Declare the rules for the form validation
		$rules = array(
			'bank_transfer_currency'   => 'required',
			'bank_transfer_amount' => 'required',
			'bank_transfer_date' => 'required',
			'bank_transfer_transaction_id' => 'required',
			'bank_transfer_deposited_in_bank' => 'required',
			'bank_transfer_bank_branch' => 'required',
			'bank_transfer_remarks' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator)->with('tab', 'cash');
		}

		// Create a new ledger
		$post = new PaymentVerify;

		// Update the blog post data

		$old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		}

		else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}
		$post->invoice_no   = $invoice_no;
	
		
		$post->user_id     = Sentry::getUser()->id;
		$post->payment_for  = e('cash');
		$post->debit_credit  = e('credit');
		$post->currency     = e(Input::get('bank_transfer_currency'));
		$post->amount = e(Input::get('bank_transfer_amount'));
		$post->date      = e(Input::get('bank_transfer_date'));
		$post->transaction_id      = e(Input::get('bank_transfer_transaction_id'));
		$post->deposited_in_bank = e(Input::get('bank_transfer_deposited_in_bank'));
		$post->bank_branch = e(Input::get('bank_transfer_bank_branch'));
		$post->remarks = e(Input::get('bank_transfer_remarks'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your payment details has been submitted for verification");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Ledger coudn't be created");
	}

	 public function postCreditRequest()
	{

		// Declare the rules for the form validation
		$rules = array(
			'credit_request_currency'    => 'required',
			'credit_request_amount'      => 'required',
			'credit_request_start_date'  => 'required',
			'credit_request_expire_date' => 'required',
			'credit_request_remarks'     => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator)->with('tab', 'cash');
		}

		$previous_credit = CreditLimitManagement::where('user_id', Sentry::getUser()->id)->where('paid_unpaid', 0);


		if ($previous_credit->count()) {

			return Redirect::back()->withInput()->withErrors($validator)->with('tab', 'cash')->with('error', 'Sorry, you cannot make more credit requests before you pay the previous one');

		}

		// Create a new ledger
		$post = new CreditLimitManagement;

		// Update the blog post data

		$old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		}

		else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}
		$post->invoice_no   = $invoice_no;
		
		$post->user_id     	= Sentry::getUser()->id;
		$post->payment_for  = e('Credit Request');
		$post->debit_credit = e('debit');
		$post->currency     = e(Input::get('credit_request_currency'));
		$post->amount 		= e(Input::get('credit_request_amount'));
		$post->start_date 	= Input::get('credit_request_start_date');
		$post->expire_date 	= Input::get('credit_request_expire_date');
		$post->remarks 		= e(Input::get('credit_request_remarks'));
		$post->remarks1 	= e('CreditLimitRequest');
		$post->status  		= 'Pending';
		$post->paid_unpaid  = 0;



		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your credit request has been submitted for verification");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Credit request not set.");
	}

	 public function postPaypal()
	{

		// Declare the rules for the form validation
		$rules = array(
			'paypal_currency'   => 'required',
			'paypal_amount' => 'required',
			'paypal_date' => 'required',
			'paypal_transaction_id' => 'required',
			'paypal_deposited_in_bank' => 'required',
			'paypal_bank_branch' => 'required',
			'paypal_remarks' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator)->with('tab', 'cash');
		}

		// Create a new ledger
		$post = new PaymentVerify;

		// Update the blog post data

		$old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		}

		else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}
		$post->invoice_no   = $invoice_no;
	
		
		$post->user_id     = Sentry::getUser()->id;
		$post->payment_for  = e('Paypal');
		$post->debit_credit  = e('credit');
		$post->currency     = e(Input::get('credit_request_currency'));
		$post->amount = e(Input::get('credit_request_amount'));
		$post->date      = e(Input::get('credit_request_date'));
		$post->remarks1 = e('CreditLimitRequest');


		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Your payment details has been submitted for verification");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Ledger coudn't be created");
	}    
        
    public function getEdit($id)
	{
		if(is_null($entry = ConfigureAccount::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ledger.");
		}

		// Show the page
		return View::make('backend.account_management.configure_account.edit', compact('entry'));
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
                
        if (is_null($post = ConfigureAccount::find($id)))
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
		if (is_null($entry = ConfigureAccount::find($id)))
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