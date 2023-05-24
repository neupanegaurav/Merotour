<?php

class OrdersController extends BaseController {
        
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() { 

    	$query = Orders::query();

    	if(Request::is(Session::get('account_type') . '/package_tours/orders')) 
    	{    		
    		  $query->where('category_name', 'Package Tours');
    		  $query->where('status', '!=', 'Cancel Requested');
    		  $order_category = 'Package Tour';

    	}

    	elseif(Request::is(Session::get('account_type') . '/package_tours/cancelled-orders')) 
    	{    		
    		  $query->where('category_name', 'Package Tours');
    		  $query->where('status', 'Cancel Requested');

    		  $order_category = 'Cancelled Package Tour';

    	}


    	elseif (Request::is(Session::get('account_type') . '/hotels/orders')) 
    	{
    		  $query->where('category_name', 'Hotels');
    		  $order_category = 'Hotel';
    	}

    	elseif (Request::is(Session::get('account_type') . '/hotels/cancelled-orders')) 
    	{
    		  $query->where('category_name', 'Hotels');
      		  $query->where('status', 'Cancel Requested');

    		  $order_category = 'Cancelled Hotel';
    	}

    	elseif (Request::is(Session::get('account_type') . '/vacation_rentals/orders')) 
    	{
    		$query->where('category_name', 'Vacation Rentals');
    		$order_category = 'Vacation Rental';  		
    	}

    	elseif (Request::is(Session::get('account_type') . '/vacation_rentals/cancelled-orders')) 
    	{
    		$query->where('category_name', 'Vacation Rentals');
    		$query->where('status', 'Cancel Requested');

    		$order_category = 'Cancelled Vacation Rental';  		
    	}


    	elseif (Request::is(Session::get('account_type') . '/vehicle_rentals/orders')) 
    	{
    		$query->where('category_name', 'Vehicle Rentals'); 
    		$order_category = 'Vehicle Rental';  		
    	}

    	elseif (Request::is(Session::get('account_type') . '/vehicle_rentals/cancelled-orders')) 
    	{
    		$query->where('category_name', 'Vehicle Rentals'); 
    		$query->where('status', 'Cancel Requested');
    		$order_category = 'Cancelled Vehicle Rental';  		
    	}

    	else {

    	}

    	if(Session::get('account_type') != 'admin') {

    		$query->where('user_id', Sentry::getUser()->id);
    	}

    	$entries = $query->orderBy('created_at', 'DESC')->paginate(10);
                             
        $this->layout->content = View::make('backend.orders.index', compact('entries', 'order_category'));      
    }

    public function postIndex() {

    	// Declare the rules for the form validation
		$rules = array(
			'invoice_no'   => 'required|Integer',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$invoice_no = Input::get('invoice_no');

		$entries = Orders::
		where('invoice_no', $invoice_no)
		->paginate(10);

        $this->layout->content = View::make('backend.orders.index', compact('entries'));
             
    }
          
    
    public function getCreate()
	{

		// Show the page
		$this->layout->content = View::make('backend.orders.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new order
		$post = new Orders;

		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->description     = e(Input::get('description'));

		// Create a new ledger
		$post_pv = new PaymentVerify;

		// Update the blog post data

		$old_invoice = GeneralVoucher::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$post_pv->invoice_no = 10001;

		}
		
		else {

			$post_pv->invoice_no = $old_invoice->invoice_no + 1;

		}
	
		
		$post_pv->user_id     = Sentry::getUser()->id;
		$post_pv->payment_for  = e('cash');
		$post_pv->debit_credit  = e('debit');
		$post_pv->invoice_no  = e('debit');
		$post_pv->category_name  = e('debit');
		$post_pv->package_name = e('debit');
		$post_pv->currency     = e(Input::get('cash_currency'));
		$post_pv->amount = e(Input::get('cash_amount'));
		$post_pv->date      = e(Input::get('cash_date'));
		$post_pv->remarks = e(Input::get('cash_remarks'));
		

		// Was the blog post created?
		if($post->save() and $post_pv->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/categories/create")->with('success', "Order has been created");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/categories/create')->with('error', "Order coudn't be created");
	}

	public function StatusChange($id)
	{

		// Declare the rules for the form validation
		$rules = array(
			'status'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$status = Input::get('status');

		if (is_null($post = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected order.");
		}

		$post->status = e($status);

		if($post->save())
		{

			if($status == 'Order Completed')
			{
				$entry  = new GeneralVoucher;

				$entry ->invoice_no 			= $post->invoice_no;
				$entry ->user_id     			= $post->user_id;
				$entry ->payment_for  			= $post->payment_for;
				$entry ->debit_credit         	= $post->debit_credit;
				$entry ->currency     			= $post->currency;
				$entry ->amount 				= $post->amount;
				$entry ->date      				= $post->date;
				$entry ->transaction_id      	= $post->transaction_id;
				$entry ->deposited_in_bank 		= $post->deposited_in_bank;
				$entry ->bank_branch 			= $post->bank_branch;
				$entry ->remarks 				= $post->remarks;
				$entry ->remarks1             	= $post->remarks1;
				$entry ->category_name        	= $post->category_name;
				$entry ->package_name         	= $post->package_name;
				$entry ->package_id           	= $post->package_id;

				$entry->save();
			}

			elseif ($status == 'Rejected') 
			{
				$entry  = new UnapproveVoucher;

				$entry ->invoice_no 			= $post->invoice_no;
				$entry ->user_id     			= $post->user_id;
				$entry ->payment_for  			= $post->payment_for;
				$entry ->debit_credit         	= $post->debit_credit;
				$entry ->currency     			= $post->currency;
				$entry ->amount 				= $post->amount;
				$entry ->date      				= $post->date;
				$entry ->transaction_id      	= $post->transaction_id;
				$entry ->deposited_in_bank 		= $post->deposited_in_bank;
				$entry ->bank_branch 			= $post->bank_branch;
				$entry ->remarks 				= $post->remarks;
				$entry ->remarks1             	= $post->remarks1;
				$entry ->category_name        	= $post->category_name;
				$entry ->package_name         	= $post->package_name;
				$entry ->package_id           	= $post->package_id;
				
				$entry->save();
			}

			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Status updated");
		}

		return Redirect::back()->with('error', "Couldn't find the selected order.");
	
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Selected order could not be found.");
		}
		// Show the page
		$this->layout->content = View::make('backend.orders.edit', compact('entry'));
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
			'package_name'   => 'required',
			'date' => 'required',
			'group_size' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected order.");
		}


		// Update the blog post data
		$post->package_name = e(Input::get('package_name'));
		$post->date     	= e(Input::get('date'));
		$post->group_size   = e(Input::get('group_size'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Order updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Order could not be updated.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete order.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Order deleted successfully");
	}

	public function getDetails($id)
	{
		if (is_null($entry = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Selected order could not be found.");
		}
		// Show the page
		$this->layout->content = View::make('backend.orders.details', compact('entry'));
	}

	public function getCancellationRequest($id) 
	{
		// Check if the blog post exists
		if (is_null($post = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete order.");
		}

		$post->status = 'Cancel Requested';

		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Cancel request sent. We will email you soon about your order status");
		}

		return Redirect::back()->with('error', "Couldn't save the cancellation request.");
	}

	public function approveCancelled($id)
	{
		

		// Check if the blog post exists
		if (is_null($entry = Orders::find($id))){

			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the order.");
		}

		if ($entry->status == 'Cancel Requested') {

			$entry->status = 'Cancel Approved';	

			if(!$entry->save()) {

        		return Redirect::back()->with('error', "Couldn't change status");

        	}

			$funds = Funds::where('user_id', $entry->user_id)->first();

			if ($entry->currency == 'usd') {
				$amount = ceil($entry->amount * FXRate::where('iso_code', 'USD')->first()->exchange_rate);
			} else {
				$amount = $entry->amount;
			}


       		$new_balance = $funds->balance + $amount;

        	$funds->balance = $new_balance;

        	if(!$funds->save()) {

        		return Redirect::back()->with('error', "Couldn't refund the balance.");

        	}

			
			/*// Data to be used on the email view
			$data = array(
				'user'          => $userdetails,
				'invoice_no'    => $invoice_no,
				'category'      => 'Package Tours',
			);

			// Send the order email to booking@blackeyetravels.com 
			Mail::queue('emails.booking-blackeye', $data, function($m) use ($invoice_no)
			{
				$m->from('support@blackeyetravels.com', 'Blackeye Travels');
				$m->to('booking@blackeyetravels.com', 'Booking Department');
				$m->subject('New Order Placed #' . $invoice_no );
			});*/


		} else {

			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Sorry, this order is not yet cancelled.");

		}


		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Cancelled Order accepted successfully");
	}

	public function unapproveCancelled()
	{

		// Declare the rules for the form validation
		$rules = array(
			'message'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$id = Input::get('dataid');


        if (is_null($post = Orders::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected order.");
		}

		if ($post->status == 'Cancel Requested') {

			$message = Input::get('message');
			$invoice_no = $post->invoice_no;
			$category = $post->category;
			$package_name = $post->package_name;

			$userprovider = Sentry::getUserProvider(); 

			$userdetails = $userprovider->findById($post->user_id);

			//Data to be used on the email view
			$data = array(
				'user'          => $userdetails,
				'invoice_no'    => $invoice_no,
				'message'		=> $message,
				'category'      => $category,
				'package_name'  => $package_name
			);

			//Send the order email to booking@blackeyetravels.com 
			Mail::queue('emails.order-cancel-unapprove-message', $data, function($m) use ($invoice_no, $userdetails)
			{
				$m->from('support@blackeyetravels.com', 'Blackeye Travels');
				$m->to($userdetails->email, $userdetails->first_name . ' ' . $userdetails->last_name);
				$m->subject('New Order Placed #' . $invoice_no );
			});

		} else {

			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Sorry, this order is not yet cancelled.");

		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Cancel Order unapproved.");
	
	}
        
}
