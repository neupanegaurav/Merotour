<?php

class ReservedTicketsController extends BaseController {
      
  public function getIndex() {

    	if (Session::get('account_type') == 'admin') {
    		 $entries = ReservedDomesticTickets::orderBy('created_at', 'DESC')->paginate(10);
    	} else {
    		$entries = ReservedDomesticTickets::where('user_id', Sentry::getUser()->id)->orderBy('created_at', 'DESC')->paginate(10);    		
    	}

    	$q = 'Reserved Tickets';
        
        return View::make('backend.reserved_tickets.index', compact('entries', 'q'));
             
    }
    
  public function getCreate()
	{
		// Show the page
		return View::make('backend.reserved_tickets.create');
	}

        
  public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'contact_prefix'    	=> 'required',
			'contact_first_name' 	=> 'required',
			'contact_last_name'  	=> 'required',
			'airline' 				=> 'required',
			'departure' 			=> 'required',
			'arrival' 				=> 'required',		
			'api' 					=> 'required',			
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new Booking
		$post = new ReservedDomesticTickets;

		// Update the blog post data
			$post->airline  	= e(Input::get('airline'));
			$post->flight_no    = e(Input::get('flight_no'));
			$post->departure 	= e(Input::get('departure'));
			$post->arrival 		= e(Input::get('arrival'));
			$post->pnr_no 		= e(Input::get('pnr_no'));
			$post->flight_date 	= e(Input::get('flight_date'));
			$post->class_code 	= e(Input::get('class_code'));
			$post->contact_name = e(Input::get('contact_prefix') . Input::get('contact_first_name') . Input::get('contact_last_name'));
			$post->user_id = Sentry::getUser()->id;

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
		if (is_null($entry = ReservedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Booking.");
		}

		$passengers = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no)->get();

		// Show the page
		return View::make('backend.reserved_tickets.edit', compact('entry', 'passengers'));
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
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = ReservedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Booking.");
		}

			// Update the blog post data
		
				$post->departure = Input::get('departure');
				$post->arrival = Input::get('arrival');
				$post->class_code = Input::get('class_code');
				$post->trip_type = Input::get('trip_type');
				//$post->airline = $airline;
				$post->airline_id = Input::get('flight_no');
				$post->ttl_date = Input::get('ttl_date');
				$post->ttl_time = Input::get('ttl_time');	
				$post->api = 'Domestic Flights';


		   for ($i=1; $i <= Input::get('inc'); $i++) { 

		   		if (is_null($post2 = DomesticPassengerDetails::where('passenger_no', $i)->where('pnr_no', $post->pnr_no)->first()))
				{
					// Redirect to the blogs management page
					return Redirect::back()->with('error', "Couldn't find the selected passenger.");
				}      

				// Update the blog post data
				$post2->ticket_no = Input::get('passenger'. $i .'_ticket_no');
				//$post2->title = Input::get('passenger'. $i .'title');
				//$post2->first_name = Input::get('passenger'. $i .'first_name');
				//$post2->last_name = Input::get('passenger'. $i .'last_name');
				$post2->pax_type = Input::get('passenger'. $i .'pax_type');											
		
				// Was the blog post created?
				if(!$post2->save())
				{
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}
			}
			


		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Reservation updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update reservation.");
	
	}
       
  public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = ReservedDomesticTickets::find($id)))
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
		if (is_null($entry = ReservedDomesticTickets::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find entry.");
		}

		$passengers = DomesticPassengerDetails::where('invoice_no', $entry->invoice_no)->get();

		//return var_dump($passengers);
		// Show the page
		return View::make('backend.reserved_tickets.details', compact('entry', 'passengers'));
	}

	public function issueTicket($id) 
	{
		// Check if the blog post exists
		if (is_null($entry = ReservedDomesticTickets::find($id))) {
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find entry.");
		}

		if (is_null($entry = ReservedDomesticTickets::find($id))) {
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find entry.");
		}

		//Booked Domestic Tickets

				// Create a new category
				$post = new BookedDomesticTickets;

				// Update the blog post data
				$post->user_id = $entry->user_id;
				$post->invoice_no = $entry->invoice_no;
				$post->pnr_no = $entry->pnr_no;
				$post->contact_name = $entry->contact_number;
				$post->contact_number = $entry->contact_number;
				$post->contact_email = $entry->contact_email;
				$post->adults = $entry->adults;
				$post->children = $entry->children;
				$post->api = 'Domestic Flights';
				$post->airline = $entry->airline;
				$post->flight_no = $entry->flight_no;
				$post->departure = $entry->departure;
				$post->arrival = $entry->arrival;
				$post->booking_status = $entry->reservation_status;
				$post->class_code = $entry->class_code;
				$post->currency = $entry->currency;
				$post->offline_processing = 1;				
				
				// Was the blog post created?
				if(!$post->save()) {
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}

				$entry->status = 'Ticket Issued';
				$entry->save();

		return Redirect::back()->with('success', "Ticket Issued");
	}
}
