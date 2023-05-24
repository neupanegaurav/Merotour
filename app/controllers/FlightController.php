<?php

class FlightController extends BaseController {

	public static $united_test_url = 'http://116.66.198.19/us/UnitedSolutions?wsdl';
	public static $united_live_url = 'http://116.90.239.74/us/UnitedSolutions?wsdl';
	public static $united_url 	   = 'http://116.90.239.74/us/UnitedSolutions?wsdl';

	public static $united_live_strUserId   = "BLKEYE"; 
	public static $united_live_strPassword = "BLC@US.SXPT0311";
	public static $united_live_strAgencyId = "PLZ003";

	public static $united_test_strUserId   = "BLKEYE"; 
	public static $united_test_strPassword = "PASSWORD";
	public static $united_test_strAgencyId = "PLZ004";

    public static $strUserId   = "BLKEYE"; 
    public static $strPassword = "BLC@US.SXPT0311";
    public static $strAgencyId = "PLZ003";
         
    public function getIndex() {       
    return View::make('backend.flight.index');
    }

    public function getBackendIndex() {             
    return View::make('backend.flight_search.index');
    }

    public function searchingFlights() 
    {
  	    $rules = array(
			'trip_type'     => 'required',
			'adults'      	=> 'required',
			'children'    	=> 'required',
			'nationality' 	=> 'required',
			'dom_int'       => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

        $sectorFrom       = Input::get('sectorFrom');
        $sectorTo         = Input::get('sectorTo');
        $origin           = Input::get('origin');
        $destination      = Input::get('destination');
        $flight_date      = Input::get('flight_date');
        $trip_type        = Input::get('trip_type');
        $return_date      = Input::get('return_date');
        $flight_date_intl = Input::get('flight_date_intl');
        $return_date_intl = Input::get('return_date_intl');        
        $adults           = Input::get('adults');
        $children         = Input::get('children');
        $nationality      = Input::get('nationality');
        $token            = Input::get('_token');
        $dom_int          = Input::get('dom_int');
        $backend          = Input::get('backend');

      


		return View::make("frontend.searching_flights", compact('sectorFrom', 'sectorTo', 'origin', 'destination', 'dom_int', 'flight_date', 'trip_type', 'return_date', 'flight_date_intl', 'return_date_intl' , 'adults', 'children', 'nationality', 'token', 'backend'));   	
    }

    public function getFlightAvailability() 
    {    	
		$rules = array(
			'sectorFrom'   	=> 'required',
			'sectorTo' 		=> 'required',
			'trip_type' 	=> 'required',
			'flight_date' 	=> 'required',
			'adults'      	=> 'required',
			'children'    	=> 'required',
			'nationality' 	=> 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$sectorFrom 	= Input::get('sectorFrom');
		$sectorTo 		= Input::get('sectorTo');
		$flight_date 	= Input::get('flight_date');
		$trip_type 		= Input::get('trip_type');
		$return_date  = Input::get('return_date');
		$adults       = Input::get('adults');
		$children     = Input::get('children');
		$nationality  = Input::get('nationality');
		$test 			 	= Input::get('backend');

		//return $sectorFrom ." - " . $sectorTo ." - " . $flight_date ." - " . $return_date ." - " .  $trip_type ." - " . $adults ." - " . $children;

		Session::put('sectorFrom', $sectorFrom);
		Session::put('sectorTo', $sectorTo);
		Session::put('flight_date', $flight_date);
		Session::put('trip_type', $trip_type);
		Session::put('return_date', $return_date);
		Session::put('adults', $adults);
		Session::put('children', $children);
		Session::put('nationality', $nationality);

		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);

		// Userid : BLKEYE PASSWORD : PASSWORD AGENCYID :PLZ004

		// Userid : BLKEYE PASSWORD : BLC@US.SXPT0311 AGENCYID :PLZ003

		//Test http://116.66.198.19/us/UnitedSolutions?wsdl

		//live http://116.90.239.74/us/UnitedSolutions?wsdl
	
		$united_solutions = ServiceProviderSetting::find(2);

        //return 'Test';

		if(!empty($united_solutions->search) and $united_solutions->search == 1 ) {
			try {
					ini_set('max_execution_time', 300);
					$client = @new SoapClient(self::$united_url);
					$addRequest = new stdClass();
					$addRequest->strUserId      = self::$strUserId; 
					$addRequest->strPassword    = self::$strPassword;
					$addRequest->strAgencyId    = self::$strAgencyId;
					$addRequest->strSectorFrom  = $sectorFrom;
					$addRequest->strSectorTo    = $sectorTo;
					$addRequest->strFlightDate  = $flight_date;
					$addRequest->strTripType    = $trip_type;
					$addRequest->strReturnDate  = $return_date;
					$addRequest->strNationality = $nationality;
					$addRequest->intAdult       = $adults;
					$addRequest->intChild       = $children;


					$raw_flightavailability = $client->FlightAvailability($addRequest);

					//return var_dump($raw_flightavailability);

					$flightavailability = new SimpleXMLElement($raw_flightavailability->return);
			} catch (SoapFault $exception) {
				$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
				//$error = ($exception->getMessage());
				return View::make("frontend.flightavail", compact('error', 'sectorFrom', 'sectorTo', 'flight_date', 'trip_type'));
			}

		} else {
			$error = "Domestic Search Unavailable at the moment.";

			return View::make("frontend.flightavail", compact('error', 'sectorFrom', 'sectorTo', 'flight_date', 'trip_type'));		
		}

		if(!empty($test)) {
			$slug = 'backend.flight_search';
		} else {
			$slug = 'frontend';
		}

		// Redirect to the new blog post page
		return View::make($slug.'.flightavail', compact('flightavailability','sectorFrom', 'sectorTo', 'flight_date', 'trip_type', 'adults', 'children'));
	}

  public function payment() 
  {
    // Declare the rules for the form validation

   $dom = Input::get('flightint');

    if($dom=="flightint"){
    	$rules = array(
			'contact_name' 		=> 'required',
			'contact_number' 	=> 'required',
			'contact_email' 	=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}



		//$airline 		= Input::get('airline');
		$flightid 			= Session::get('flight_no');		
		$returnflightid = Session::get('returnflightid');
		$flight_no 			= Session::get('flight_no');
		$airline 				= Session::get('airline');		
		$origin 			= Session::get('origin');
		$destination 				= Session::get('destination');
		$airlines_shortcode			= Session::get('airlines_shortcode');	
		$adults 				= Session::get('adults');
		$children 			= Session::get('children');
		$adult_fare 		= Session::get('adult_fare');

    $child_fare 		= Session::get('child_fare_'.$flightid);
    $fuel_surcharge = Session::get('fuel_surcharge_'.$flightid);
    $tax 						= Session::get('tax_'.$flightid);
    $class_code 		= Session::get('class_code');
   
    $free_baggage   = Session::get('free_baggage_'.$flightid);

		Session::put('contact_name', Input::get('contact_name'));
		Session::put('contact_number', Input::get('contact_number'));
		Session::put('contact_email', Input::get('contact_email'));

   $account_type = Session::get('account_type');

//return $airline;

   $test = Input::get('backend');

		if(!empty($test)) {
			$slug = 'backend.flight_search';
		} else {
			$slug = 'frontend';
		}

		return View::make($slug.'.payment', compact('user', 'flightid', 'flight_no' , 'returnflightid','adults', 'children', 'airline', 'class_code', 'agent_commission', 'adult_fare', 'dom'));		

    }
    else{
		$rules = array(
			'contact_name' 		=> 'required',
			'contact_number' 	=> 'required',
			'contact_email' 	=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$flightid 			= Session::get('flightid');		
		$returnflightid = Session::get('returnflightid');
		$flight_no 			= Session::get('flight_no');
		$airline 				= Session::get('airline');
		$departure 			= Session::get('departure');
		$arrival 				= Session::get('arrival');
		$adults 				= Session::get('adults');
		$children 			= Session::get('children');
		$adult_fare 		= Session::get('adult_fare_'.$flightid);
    $child_fare 		= Session::get('child_fare_'.$flightid);
    $fuel_surcharge = Session::get('fuel_surcharge_'.$flightid);
    $tax 						= Session::get('tax_'.$flightid);
    $class_code 		= Session::get('class_code_'.$flightid);
    $free_baggage   = Session::get('free_baggage_'.$flightid);

		Session::put('contact_name', Input::get('contact_name'));
		Session::put('contact_number', Input::get('contact_number'));
		Session::put('contact_email', Input::get('contact_email'));

   $account_type = Session::get('account_type');


    if ($account_type == 'agent') {                                                          
      switch ($airline) {
                    case 'Yeti Airlines':
                        $entry = AgentFCDomesticYeti::where('sector_from', $departure)->where('sector_to', $arrival)->first();

                        break;
                    case 'Simrik Airlines':
                        $entry = AgentFCDomesticSimrik::where('sector_from', $departure)->where('sector_to', $arrival)->first();
                        break;
                    case 'Buddha Airlines':
                        $entry = AgentFCDomesticBuddha::where('sector_from', $departure)->where('sector_to', $arrival)->first();
                        break;
                    default:                                                                                
                        break;
      }

      if (isset($entry)) {
      	switch ($class_code) {       	                                                                     
          case 'A':
          		$agent_commission = $entry->a;            
              break;
          case 'B':
          		$agent_commission = $entry->b;            
              break;
          case 'C':
          		$agent_commission = $entry->c;            
              break;
          case 'D':
          		$agent_commission = $entry->d;            
              break;
          case 'E':
          		$agent_commission = $entry->e;            
              break;
          case 'F':
          		$agent_commission = $entry->f;            
              break;
          case 'G':
          		$agent_commission = $entry->g;            
              break;
          case 'H':
          		$agent_commission = $entry->h;            
              break;                                                                                                                                               
          case 'N':
              if ($outbound->Currency == 'USD') {
                  # code...
              } else {
          		$agent_commission = $entry->n;            

              }
              break;
          case 'O':
          		$agent_commission = $entry->o;            
              break;
          case 'S':
          		$agent_commission = $entry->s;            
              break;        
          case 'V':
          		$agent_commission = $entry->v;            
              break;
          case 'Y':
          		$agent_commission = $entry->y;            
              break;                                                                                
          default:
              break;
        }

      }

    }                                                  



		$user = Sentry::getUser();

		$post = new ReservedDomesticTickets;

		//Invoice no

		$old_invoice = InvoiceNo::orderBy('created_at', 'DESC')->first();

		if(empty($old_invoice)) {

			$invoice_no = 10001;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();			
		} else {

			$invoice_no = $old_invoice->invoice_no + 1;

			$post_invoice = new InvoiceNo;

			$post_invoice->invoice_no = $invoice_no;

			$post_invoice->save();
		}

		Session::put('invoice_no', $invoice_no);
	
		$post->invoice_no   = $invoice_no;

		$post->contact_name = Input::get('contact_name');
		$post->contact_number = Input::get('contact_number');
		$post->contact_email = Input::get('contact_email');
		$post->user_id = e($user->id);
		$post->flightid = e($flightid);
		$post->flight_no = e($flight_no);
		$post->returnflightid = e($returnflightid);
		$post->adults = e($adults);
		$post->children = e($children);
		$post->adult_fare = $adult_fare;
		$post->child_fare = $child_fare;
		$post->fsc = $fuel_surcharge;
		$post->tax = $tax;
		$post->departure = Session::get('sectorFrom');
		$post->arrival = Session::get('sectorTo');
		$post->class_code = $class_code;
		$post->trip_type = Session::get('trip_type');
		$post->airline = $airline;
		$post->api = 'Domestic Flights';
		$post->free_baggage = $free_baggage;
		

		if (!$post->save()) {
			return Redirect::back()->with('error', "Couldn't save the reserved ticket.");
		}

		for ($i=1; $i <= ($adults + $children); $i++) {

			$post = new DomesticPassengerDetails;

			$post->invoice_no = Session::get('invoice_no');
			$post->user_id = $user->id;
			$post->pnr_no = Session::get('pnr_no');
			$post->passenger_no = $i;
			$post->gender = Input::get("passenger{$i}_gender");
			$post->title = Input::get("passenger{$i}_title");
			$post->first_name = Input::get("passenger{$i}_first_name");
			$post->last_name = Input::get("passenger{$i}_last_name");
			$post->nationality = Input::get("passenger{$i}_nationality");
			$post->pax_type = Input::get("passenger{$i}_pax_type");	
			$post->pax_remarks = Input::get("passenger{$i}_pax_remarks");	
			
			if(Input::get("passenger{$i}_pax_type") == 'ADULT'){

				$post->fare = $adult_fare;

			} elseif (Input::get("passenger{$i}_pax_type") == 'CHILD') {
				$post->fare = $child_fare;
			}

			$post->surcharge = $fuel_surcharge;
			$post->tax = $tax;
			$post->pax_remarks = Input::get("passenger{$i}_pax_remarks");

			// Was the blog post created?
			if(!$post->save()) {
				// Redirect to the new blog post page
				return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
			}

			Session::put("passenger{$i}_pax_type", Input::get("passenger{$i}_gender"));
			Session::put("passenger{$i}_title", Input::get("passenger{$i}_title"));
			Session::put("passenger{$i}_gender", Input::get("passenger{$i}_gender"));
			Session::put("passenger{$i}_last_name", Input::get("passenger{$i}_last_name"));
			Session::put("passenger{$i}_first_name", Input::get("passenger{$i}_first_name"));
			Session::put("passenger{$i}_nationality", Input::get("passenger{$i}_nationality"));
			Session::put("passenger{$i}_pax_remarks", Input::get("passenger{$i}_pax_remarks"));
		}	
		
		$test = Input::get('backend');

		if(!empty($test)) {
			$slug = 'backend.flight_search';
		} else {
			$slug = 'frontend';
		}

		return View::make($slug.'.payment', compact('user', 'flightid', 'flight_no' , 'returnflightid','adults', 'children', 'airline', 'class_code', 'agent_commission', 'dom'));		

		// Redirect to the new blog post page
		//return View::make('frontend.flightpayment', compact('user', 'flightid', 'returnflightid','adults', 'children'));			
	}
	}

  public function reservation() 
  {

 $dom = Input::get('flightint');
  	//$dom="flightint";

  	if($dom=="flightint"){

  		if (!Session::has('flightloginredirect')) {
		$rules = array(			
				'flight_no'  => 'required',
				'adults'     => 'required',

					);
				
				$validator = Validator::make(Input::all(), $rules);

				// If validation fails, we'll exit the operation now.
			if ($validator->fails())
			{
				// Ooops.. something went wrong
				return Redirect::back()->withInput()->withErrors($validator);
			}


			$flightid = Input::get('flight_no');
			$adult_fare = Input::get('adult_fare');
			$trip_type = Session::get('trip_type');
			$airline   =Input::get('airline');
			$class_code=Input::get('class_code');
			$returnflightid = Input::get('returnflightid');

			if ($trip_type == 'R' and empty($returnflightid)) {

				return Redirect::back()->with('error', 'Please select a return flight.');
			}	

			$flight_no = Input::get('flight_no');
			//$airline = Session::get('airline'. $flightid);

			
			
			
			$children = Input::get('children');

			Session::put('flightid', $flightid);
			Session::put('returnflightid', $returnflightid);
			Session::put('flight_no', $flight_no);



			$adults = Input::get('adults');
		
			$flight_no = Input::get('flight_no');		 
			 Session::put('flight_no', $flight_no);	
			 Session::put('airline', $airline);
			 Session::put('adult_fare', $adult_fare);
			 Session::put('class_code', $class_code);


		
			}
			else {
			Session::remove('flightloginredirect');

		}
			if (!Sentry::check()) {
  		// Store the current uri in the session
			Session::put('flightloginredirect', true);

			return Redirect::to('auth/signin')->with('error', 'Please login to continue with your flight booking');			
		}





		$adults         = Session::get('adults');
		$flight_no      = Session::get('flight_no');


		 $flightid       = Session::get('flight_no');
        $returnflightid = Session::get('returnflightid');
        $flight_no      = Session::get('flight_no');
        //$airline        = Session::get('airline');

       
        //$adults         = Session::get('adults');
       // $children       = Session::get('children');
        $adult_fare     = Session::get('adult_fare');
        
       // $child_fare     = Session::get('child_fare_'.$flightid);
        //$fuel_surcharge = Session::get('fuel_surcharge_'.$flightid);
       // $tax            = Session::get('tax_'.$flightid);
       //$class_code     = Session::get('class_code_'.$flightid);
       // $free_baggage   = Session::get('free_baggage_'.$flightid);
        	
        	

		$user = Sentry::getUser();

		$backend = Input::get('backend');
		if(empty($backend)) {
			$slug = 'frontend';
		} else {
			$slug = 'backend.flight_search';
		}


		return View::make($slug. '.reservation', compact('user', 'flightid', 'flight_no' , 'adults', 'children', 'airline', 'adult_fare', 'dom'));

  	}
  	
  	else{
  		
		if (!Session::has('flightloginredirect')) {
	    	// Declare the rules for the form validation	    	
			$rules = array(

				'flightid'   => 'required',
				'flight_no'  => 'required',
				'adults'     => 'required',
				'children'   => 'required',
			);
  			
			// Create a new validator instance from our validation rules
			$validator = Validator::make(Input::all(), $rules);



			// If validation fails, we'll exit the operation now.
			if ($validator->fails())
			{
				// Ooops.. something went wrong
				return Redirect::back()->withInput()->withErrors($validator);
			}


			$flightid = Input::get('flightid');

			$trip_type = Session::get('trip_type');

			$returnflightid = Input::get('returnflightid');

			if ($trip_type == 'R' and empty($returnflightid)) {

				return Redirect::back()->with('error', 'Please select a return flight.');
			}	

			$flight_no = Input::get('flight_no');
			$airline = Session::get('airline_'. $flightid);
			$adults = Input::get('adults');
			$children = Input::get('children');

echo $flightid;
			
			echo $airline;
			echo $class_code;
			echo $returnflightid;

			return "Home";


			

			Session::put('flightid', $flightid);
			Session::put('returnflightid', $returnflightid);
			Session::put('flight_no', $flight_no);

			switch ($airline) {
	      case 'YA':
	          Session::put('airline', 'Yeti Airlines');
	          break;
	      case 'YT':
	          Session::put('airline', 'Yeti Airlines');
	          break;
	      case 'RMK':
	          Session::put('airline', 'Simrik Airlines');
	          break;
	      case 'U4':
	          Session::put('airline', 'Buddha Airlines');
	          break;
	      default:                                                                                
	          break;
      }			

		} else {

			Session::remove('flightloginredirect');

		}

		if (!Sentry::check()) {
  		// Store the current uri in the session
			Session::put('flightloginredirect', true);

			return Redirect::to('auth/signin')->with('error', 'Please login to continue with your flight booking');			
		}

        $flightid       = Session::get('flightid');
        $returnflightid = Session::get('returnflightid');
        $flight_no      = Session::get('flight_no');
        $airline        = Session::get('airline');
        $adults         = Session::get('adults');
        $children       = Session::get('children');
        $adult_fare     = Session::get('adult_fare_'.$flightid);
        $child_fare     = Session::get('child_fare_'.$flightid);
        $fuel_surcharge = Session::get('fuel_surcharge_'.$flightid);
        $tax            = Session::get('tax_'.$flightid);
        $class_code     = Session::get('class_code_'.$flightid);
        $free_baggage   = Session::get('free_baggage_'.$flightid);
        $dom="flightdom";

        

        


        //return $dom;

		$user = Sentry::getUser();

		$backend = Input::get('backend');

		if(empty($backend)) {
			$slug = 'frontend';
		} else {
			$slug = 'backend.flight_search';
		}
			
		return View::make($slug. '.reservation', compact('user', 'flightid', 'flight_no' , 'returnflightid','adults', 'children', 'airline', 'dom'));		

		// Redirect to the new blog post page
		//return View::make('frontend.flightpayment', compact('user', 'flightid', 'returnflightid','adults', 'children'));						
	}
}

	public function issueTicket() 
  {
  	if(!Sentry::check()) {


  		return Redirect::route('signin')->with('error', 'Please login to continue booking');
  	}
    
    // Declare the rules for the form validation
		$rules = array(
			'contact_name' 		=> 'required',
			'contact_number' 	=> 'required',
			'contact_email' 	=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$test = Input::get('backend');

			if(!empty($test)) {
				$slug = 'backend.flight_search';
			}else {
				$slug = 'frontend';
			}

		$flightid 		= Session::get('flightid');
		$returnflightid = Session::get('returnflightid');
		$adults 		= Session::get('adults');
		$children 		= Session::get('children');

		if(ApplicationSetting::first()->value == 0 )
		{

			try {

			$client = new SoapClient(self::$united_url);

			$passengers = NULL;

			for ($i=1; $i <= ($adults + $children); $i++) {

				$passengers .= '
			<Passenger>
			<PaxType>'. Input::get("passenger{$i}_pax_type") .'</PaxType>
			<Title>'. Input::get("passenger{$i}_title") .'</Title>
			<Gender>'. Input::get("passenger{$i}_gender") .'</Gender>
			<LastName>'. Input::get("passenger{$i}_last_name") .'</LastName>
			<FirstName>'. Input::get("passenger{$i}_first_name") .'</FirstName>
			<Nationality>'. Input::get("passenger{$i}_nationality") .'</Nationality>
			<PaxRemarks>'. Input::get("passenger{$i}_pax_remarks") .'</PaxRemarks>
			</Passenger>';

			}

			$passengerdetail = "<PassengerDetail>
			 $passengers
			</PassengerDetail>
			";


		  	$addRequest = new stdClass();	
			$addRequest->strFlightId       = $flightid;
			$addRequest->strReturnFlightId = $returnflightid;
			$addRequest->strContactName = Input::get('contact_name');
			$addRequest->strContactEmail = Input::get('contact_email');
			$addRequest->strContactMobile = Input::get('contact_number');
			$addRequest->strPassengerDetail = $passengerdetail;

			
			$raw_issueticket = $client->IssueTicket($addRequest);


			  $issueticket = new SimpleXMLElement($raw_issueticket->return);

			}

			catch(SoapFault $exception)
			{
			//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
			
			$error = ($exception->getMessage());

			return View::make($slug.'.issueticket', compact('error'));

			}

		}

		//Booked Domestic Tickets

		// Create a new category
				$post = new BookedDomesticTickets;

				// Update the blog post data
				$post->user_id = Sentry::getUser()->id;
				$post->contact_name = Input::get('contact_name');
				$post->contact_number = Input::get('contact_number');
				$post->contact_email = Input::get('contact_email');
				$post->adults = $adults;
				$post->children = $children;
				$post->api = 'Domestic Flights';

				if(ApplicationSetting::first()->value == 0 )
				{
					$post->pnr_no = $issueticket->Passenger[0]->PnrNo;
					$post->airline = $issueticket->Passenger[0]->Airline;
					$post->flight_no = $issueticket->Passenger[0]->FlightNo;
					$post->departure = $issueticket->Passenger[0]->Departure;
					$post->arrival = $issueticket->Passenger[0]->Arrival;
					$post->issue_date = $issueticket->Passenger[0]->IssueDate;
					$post->flight_date = $issueticket->Passenger[0]->FlightDate;
					$post->flight_time = $issueticket->Passenger[0]->FlightTime;
					$post->arrival_time = $issueticket->Passenger[0]->ArrivalTime;	
					$post->booking_status = $issueticket->Passenger[0]->BookingStatus;
					$post->class_code = $issueticket->Passenger[0]->ClassCode;
					$post->currency = $issueticket->Passenger[0]->Currency;
					$post->reporting_time = $issueticket->Passenger[0]->ReportingTime;
					$post->free_baggage = $issueticket->Passenger[0]->FreeBaggage;
				}
	
				// Was the blog post created?
				if(!$post->save())
				{
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}

				

				if(ApplicationSetting::first()->value == 0 )
				{
					for ($i=1; $i <= ($adults + $children); $i++) {
					
						// Create a new category
						$post = new DomesticPassengerDetails;

						// Update the blog post data
						$post->user_id = Sentry::getUser()->id;
						$post->pnr_no = $passenger->PnrNo;
						$post->ticket_no = $passenger->TicketNo;
						$post->gender = Input::get("passenger{$i}_gender");
						$post->title = Input::get("passenger{$i}_title");
						$post->first_name = Input::get("passenger{$i}_first_name");
						$post->last_name = Input::get("passenger{$i}_last_name");
						$post->nationality = Input::get("passenger{$i}_nationality");
						$post->pax_type = Input::get("passenger{$i}_pax_type");	

						if(Input::get("passenger{$i}_pax_type") == 'ADULT'){

							$post->fare = Session::get('adult_fare');

						}
						elseif (Input::get("passenger{$i}_pax_type") == 'CHILD') {
							$post->fare = Session::get('child_fare');
						}

						$post->surcharge = Session::get('surcharge');
						$post->tax = Session::get('tax');
						$post->pax_remarks = Input::get("passenger{$i}_pax_remarks");

						// Was the blog post created?
						if(!$post->save())
						{
							// Redirect to the new blog post page
							return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
						}

					}
				} else {

					foreach($issueticket->Passenger as $passenger) 
					{
						// Create a new category
						$post = new DomesticPassengerDetails;

						// Update the blog post data
						$post->user_id = Sentry::getUser()->id;
						$post->pnr_no = $passenger->PnrNo;
						$post->ticket_no = $passenger->TicketNo;
						$post->gender = $passenger->Gender;
						$post->title = $passenger->Title;
						$post->first_name = $passenger->FirstName;
						$post->last_name = $passenger->LastName;
						$post->nationality = $passenger->Nationality;
						$post->pax_type = $passenger->PaxType;	
						$post->fare = $passenger->Fare;
						$post->surcharge = $passenger->Surcharge;
						$post->tax = $passenger->Tax;
						$post->pax_remarks = $passenger->PaxRemarks;

						// Was the blog post created?
						if(!$post->save())
						{
							// Redirect to the new blog post page
							return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
						}
					}

				}
		// Redirect to the new blog post page
		return View::make('frontend.issueticket', compact('issueticket'));		
	}

	public function getPNR ($id)
	{
		// Declare the rules for the form validation
		$rules = array(
			'pnr_no' 		=> 'required',
			'ticket_no' 	=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$pnr_no = Input::get('pnr_no');
		$ticket_no = Input::get('ticket_no');

		try {
			$client = new SoapClient(self::$united_url);
		  	$addRequest = new stdClass();	
			$addRequest->strPnoNo       = $pnr_no;
			//$addRequest->strTicketNo 	= $ticket_no;

			$raw_getitinerary = $client->GetItinerary($addRequest);

			return var_dump($raw_getitinerary);

			$getitinerary = new SimpleXMLElement($raw_getitinerary->return);
			}

			catch(SoapFault $exception)
			{
			//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
			
			$error = ($exception->getMessage());

			return $error;

			}


			if (is_null($entry = BookedDomesticTickets::find($id)))
				{
					// Redirect to the blogs management page
					return Redirect::back()->with('error', "Couldn't find entry.");
				}

			$passengers = DomesticPassengerDetails::where('pnr_no', $pnr_no )->get();


			return View::make('backend.agent.retrive.details', compact('error', 'getitinerary', 'passengers', 'entry'));

	}

	public function YetiCancelReservation ()
	{		
		try {

			$client = new SoapClient(self::$united_url);

			$passengers = NULL;

			for ($i=1; $i <= ($adults + $children); $i++) {
	

				$passengers .= '
			<Passenger>
			<PaxType>'. Input::get("passenger{$i}_pax_type") .'</PaxType>
			<Title>'. Input::get("passenger{$i}_title") .'</Title>
			<Gender>'. Input::get("passenger{$i}_gender") .'</Gender>
			<LastName>'. Input::get("passenger{$i}_last_name") .'</LastName>
			<FirstName>'. Input::get("passenger{$i}_first_name") .'</FirstName>
			<Nationality>'. Input::get("passenger{$i}_nationality") .'</Nationality>
			<PaxRemarks>'. Input::get("passenger{$i}_pax_remarks") .'</PaxRemarks>
			</Passenger>';

			}

			$passengerdetail = "<PassengerDetail>
			 $passengers
			</PassengerDetail>
			";


		  	$addRequest = new stdClass();	
			$addRequest->strFlightId       = $flightid;
			$addRequest->strReturnFlightId = $returnflightid;
			$addRequest->strContactName = Input::get('contact_name');
			$addRequest->strContactEmail = Input::get('contact_email');
			$addRequest->strContactMobile = Input::get('contact_number');
			$addRequest->strPassengerDetail = $passengerdetail;

			
			$raw_issueticket = $client->IssueTicket($addRequest);


			  $issueticket = new SimpleXMLElement($raw_issueticket->return);

			}

			catch(SoapFault $exception)
			{
			//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
			
			$error = ($exception->getMessage());

			return View::make('frontend.issueticket', compact('error'));

			}
	}

    
}
