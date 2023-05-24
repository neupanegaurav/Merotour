<?php

class BookingController extends BaseController {
      
    public function getIndex() {

    	if(Request::is(Session::get('account_type') . '/cancelled-tickets')) 
    	{    		
    		$entries = BookedDomesticTickets::where('status', 'Cancel Requested')->orderBy('created_at', 'DESC')->paginate(10);
    		$q = 'Cancelled Tickets';
    	}

    	else
    	{    		
    		$entries = BookedDomesticTickets::orderBy('created_at', 'DESC')->paginate(10);
    		$q = 'Issued Tickets';
    	}

        
        return View::make('backend.booking.index', compact('entries', 'q'));            
    
    }

    public function getAgentIndex() {
    	
    	$entries = BookedDomesticTickets::
    	where('user_id', Sentry::getUser()->id)
    	->where('offline_processing', 0)
    	->where('status', '!=', 'Cancel Requested')
    	->paginate(10);
        
        return View::make('backend.agent.booking.index', compact('entries'));

    }

    public function searchAgentIndex() {

    	$query = e(Input::get('query'));

    	$entries = BookedDomesticTickets::
    	//where('user_id', Sentry::getUser()->id)
    	//->where('offline_processing', 0)
    	where('contact_name', 'Admin')->get();
    	//->paginate(10);
        
        return View::make('backend.agent.booking.index', compact('entries')); 
    }

	public function RetrivePNRAgentIndex()
	{
	    $entries = BookedDomesticTickets::where('user_id', 1)
									    ->where('offline_processing', 0)
									    ->orderBy('created_at', 'DESC')
									    ->paginate(10);
		// Show the page
		return View::make('backend.agent.retrive.index', compact('entries'));
	}
          
    
    public function getCreate()
	{
		//Users List
		$users_list = User::all();

		// Show the page
		return View::make('backend.booking.create', compact('users_list'));
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'contact_prefix'     => 'required',
			'contact_first_name' => 'required',
			'contact_last_name'  => 'required',
			'airline'            => 'required',
			'departure'          => 'required',
			'arrival'            => 'required',		
			'api'                => 'required',			
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new Booking
		$post = new BookedDomesticTickets;

		// Update the blog post data
		$post->user_id      = Sentry::getUser()->id;
		$post->contact_name = e(Input::get('contact_prefix') . Input::get('contact_first_name') . Input::get('contact_last_name'));
		$post->airline      = e(Input::get('airline'));
		$post->flight_no    = e(Input::get('flight_no'));
		$post->class_code   = e(Input::get('class_code'));
		$post->departure    = e(Input::get('departure'));
		$post->arrival      = e(Input::get('arrival'));
		$post->flight_date  = e(Input::get('flight_date'));
		$post->flight_time  = e(Input::get('flight_time'));
		$post->pnr_no       = e(Input::get('pnr_no'));
		$post->free_baggage = e(Input::get('free_baggage'));
						

        for ($i=1; $i <= Input::get('inc'); $i++) { 
        
				// Create a new category
				$post2 = new DomesticPassengerDetails;


				// Update the blog post data
				$post2->user_id =  Sentry::getUser()->id;
				$post2->pnr_no 	= e(Input::get('pnr_no'));
				$post2->ticket_no = Input::get('passenger'. $i .'ticket_no');
				//$post2->gender = Input::get('passenger'. $i .'pax_type');
				$post2->title = Input::get('passenger'. $i .'title');
				$post2->first_name = Input::get('passenger'. $i .'first_name');
				$post2->last_name = Input::get('passenger'. $i .'last_name');
				//$post2->nationality = Input::get('passenger'. $i .'pax_type');
				$post2->pax_type = Input::get('passenger'. $i .'pax_type');	
				$post2->fare = Input::get('base_fare');
				$post2->selling_bf = Input::get('selling_bf');
				$post2->surcharge = Input::get('fsc');
				$post2->selling_fsc = Input::get('selling_fsc');
				$post2->tax = Input::get('tax');
				$post2->selling_tax = Input::get('selling_tax');
				$post2->additional_txn_fee = Input::get('additional_txn_fee');
				$post2->selling_additional_txn_fee = Input::get('selling_additional_txn_fee');
				$post2->airline_txn_fee = Input::get('airline_txn_fee');
				$post2->selling_airline_txn_fee = Input::get('selling_airline_txn_fee');
				$post2->service_tax = Input::get('service_tax');
				$post2->selling_service_tax = Input::get('selling_service_tax');
				$post2->commission = Input::get('commission');
				$post2->discount = Input::get('discount');
				$post2->other_charges = Input::get('other_charges');
				$post2->selling_other_charges = Input::get('selling_other_charges');
				

				//$post2->pax_remarks = Input::get('passenger'. $i .'pax_type');

		
				// Was the blog post created?
				if(!$post2->save())
				{
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}
		}

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Booking has been created");
		}


		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Booking coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Booking.");
		}

		// Show the page
		return View::make('backend.booking.edit', compact('entry'));
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
			'setup_from'  		=> 'required',
			'setup_to' 			=> 'required',
			'airline' 			=> 'required',
			'class' 			=> 'required',
			'departure_time' 	=> 'required',
			'arrival_time' 		=> 'required',
			'flight_number' 	=> 'required|integer',
			'base_fare' 		=> 'required|integer',
			'currency' 			=> 'required',
			'tax_name_1' 		=> 'required',
			'tax_amount_1' 		=> 'required|integer',
			'tax_name_2' 		=> 'required',
			'tax_amount_2' 		=> 'required|integer',
			'tax_name_3' 		=> 'required',
			'tax_amount_3' 		=> 'required|integer',
			'effective_from' 	=> 'required',
			'expire_on' 		=> 'required',
			'total_seat_quota' 	=> 'required',
			'status' 			=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Booking.");
		}

			// Update the blog post data
			$post->setup_from  		= e(Input::get('setup_from'));
			$post->setup_to    		= e(Input::get('setup_to'));
			$post->airline 			= e(Input::get('airline'));
			$post->class 			= e(Input::get('class'));
			$post->departure_time 	= e(Input::get('departure_time'));
			$post->arrival_time 	= e(Input::get('arrival_time'));
			$post->flight_number 	= e(Input::get('flight_number'));
			$post->base_fare 		= e(Input::get('base_fare'));
			$post->currency 		= e(Input::get('currency'));
			$post->tax_name_1 		= e(Input::get('tax_name_1'));
			$post->tax_amount_1 	= e(Input::get('tax_amount_1'));
			$post->tax_name_2 		= e(Input::get('tax_name_2'));
			$post->tax_amount_2 	= e(Input::get('tax_amount_2'));
			$post->tax_name_3 		= e(Input::get('tax_name_3'));
			$post->tax_amount_3 	= e(Input::get('tax_amount_3'));
			$post->fare_rules 		= e(Input::get('fare_rules'));
			$post->effective_from 	= e(Input::get('effective_from'));
			$post->expire_on 		= e(Input::get('expire_on'));
			$post->total_seat_quota = e(Input::get('total_seat_quota'));
			$post->status 			= e(Input::get('status'));
			$post->note 			= e(Input::get('note'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Booking updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update Booking.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = BookedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Deleted successfully");
	}


	 public function getDetails($id)
	{
		// Check if the blog post exists
		if (is_null($entry = BookedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find entry.");
		}

		$passengers = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no )->get();

		//return var_dump($passengers);
		// Show the page
		return View::make('backend.booking.details', compact('entry', 'passengers'));
	}

	public function getAgentDetails($id)
	{
		// Check if the blog post exists
		if (is_null($entry = BookedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find entry.");
		}

		$passengers = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no )->get();

		//return var_dump($passengers);
		// Show the page
		return View::make('backend.agent.booking.details', compact('entry', 'passengers'));
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

		if (is_null($post = BookedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected order.");
		}

		$post->status = e($status);

		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Status updated");
		}

		return Redirect::back()->with('error', "Couldn't find the selected booking list.");
	}

	public function getCancelRequestIndex() {
    	
    	$entries = BookedDomesticTickets::
    	where('user_id', Sentry::getUser()->id)
    	->where('offline_processing', 0)
    	->where('status', '!=' , 'Cancel Requested')
    	->paginate(10);
        
        return View::make('backend.agent.cancel_request.index', compact('entries'));

    }

	public function CancelRequest($id)
	{

		if (is_null($post = BookedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected ticket.");
		}


		/*
		Note :  You may Use Back End system provided by Buddha air and Simrik air
		For Cancel and refund  reservation. For yeti airlines call function
		below to cancel reservation. Note that Yeti airlines reservation cancel
		procedure is done by airline manually. This function send only the 
		request. But Buddha Air Simrik airlines refund the amount immediately.

		operationName = "CancelReservation"
		Parameters
		strUserId,
		strPassword
		strAgencyId,
		strPnrNo,
		strTicketNo,
		strAirlineId
		Call for sales report
		operationName = "SalesReport"
		Parameters
		strUserId,
		strPassword,
		strAgencyId,
		strFromDate, (Start Date)
		strToDate (End date)*/


		/*if ($post->airline == 'YT') {

			$passengers = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no )->get();

			foreach ($passengers as $passenger) {

				try 
				{
						$client = @new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
				                            "trace"=>1,
				                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
				                            "uri" =>"http://booking.us.org/"));

						$addRequest = new stdClass();
						$addRequest->strUserId      = "BLKEYE"; 
						$addRequest->strPassword    = "PASSWORD";
						$addRequest->strAgencyId    = "PLZ004";
						$addRequest->strPnrNo  		= $post->pnr_no;
						$addRequest->strTicketNo    = $passenger->ticket_no;
						$addRequest->strAirlineId  	= $post->airline;
					
						$raw_flightavailability = $client->CancelReservation($addRequest);


						$flightavailability = new SimpleXMLElement($raw_flightavailability->return);
				}
				catch(SoapFault $exception)
				{
				$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
				//$error = ($exception->getMessage());

				return Redirect::back()->with('error', "Couldn't send request to API.");
				}
				
			}

		}*/


		$post->status = 'Cancel Requested';

		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Cancel request sent. We will email you soon about your ticket status");
		}

		return Redirect::back()->with('error', "Couldn't find the selected ticket.");
	}
        
}
