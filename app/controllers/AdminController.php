<?php

class AdminController extends AuthorizedController {

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Apply the admin auth filter
		$this->beforeFilter('admin-auth');
	}



	/**
	 * Encodes the permissions so that they are form friendly.
	 *
	 * @param  array  $permissions
	 * @param  bool   $removeSuperUser
	 * @return void
	 */
	protected function encodeAllPermissions(array &$allPermissions, $removeSuperUser = false)
	{
		foreach ($allPermissions as $area => &$permissions)
		{
			foreach ($permissions as $index => &$permission)
			{
				if ($removeSuperUser == true and $permission['permission'] == 'superuser')
				{
					unset($permissions[$index]);
					continue;
				}

				$permission['can_inherit'] = ($permission['permission'] != 'superuser');
				$permission['permission']  = base64_encode($permission['permission']);
			}

			// If we removed a super user permission and there are
			// none left, let's remove the group
			if ($removeSuperUser == true and empty($permissions))
			{
				unset($allPermissions[$area]);
			}
		}
	}

	/**
	 * Encodes user permissions to match that of the encoded "all"
	 * permissions above.
	 *
	 * @param  array  $permissions
	 * @return void
	 */
	protected function encodePermissions(array &$permissions)
	{
		$encodedPermissions = array();

		foreach ($permissions as $permission => $access)
		{
			$encodedPermissions[base64_encode($permission)] = $access;
		}

		$permissions = $encodedPermissions;
	}

	/**
	 * Decodes user permissions to match that of the encoded "all"
	 * permissions above.
	 *
	 * @param  array  $permissions
	 * @return void
	 */
	protected function decodePermissions(array &$permissions)
	{
		$decodedPermissions = array();

		foreach ($permissions as $permission => $access)
		{
			$decodedPermissions[base64_decode($permission)] = $access;
		}

		$permissions = $decodedPermissions;
	}


	public function SearchFlights() 
	{
            
            return View::make('backend.flight.searchflights');         
    }

 	public function getFlightAvailability() {

		$rules = array(
			'sectorFrom'   => 'required',
			'sectorTo' => 'required',
			'trip_type' => 'required',

			);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try {


		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));


		  $addRequest = new stdClass();
		$addRequest->strUserId      = "BLKEYE"; 
		$addRequest->strPassword    = "PASSWORD";
		$addRequest->strAgencyId    = "PLZ004";
		$addRequest->strSectorFrom  = Input::get('sectorFrom');
		$addRequest->strSectorTo    = Input::get('sectorTo');
		$addRequest->strFlightDate  = Input::get('flight_date');
		$addRequest->strTripType    = Input::get('trip_type');
		$addRequest->strReturnDate  = Input::get('return_date');
		$addRequest->strNationality = "NP";
		$addRequest->intAdult       = Input::get('adults');
		$addRequest->intChild       = Input::get('children');


		$raw_flightavailability = $client->FlightAvailability($addRequest);


		  $flightavailability = new SimpleXMLElement($raw_flightavailability->return);

		}
		catch(SoapFault $exception)
		{
		$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		//$specific = ($exception->getMessage());

		return View::make('backend.flight.flightavail', compact('error'));

		}


		$trip_type = Input::get('trip_type');

		// Redirect to the new blog post page
		return View::make('backend.flight.flightavail', compact('flightavailability', 'trip_type'));
	

    }

    public function Reservation() {
    

    	// Declare the rules for the form validation
		$rules = array(
			'FlightId'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$flightid = Input::get('FlightId');

		$returnflightid = Input::get('ReturnFlightId');

		if (!empty($returnflightid)) {


			try {


		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));


	  	$addRequest = new stdClass();	
		$addRequest->strFlightId       = $flightid;
		$addRequest->strReturnFlightId = $returnflightid;


		$raw_reservation = $client->Reservation($addRequest);


		  $reservation = new SimpleXMLElement($raw_reservation->return);

		}
		catch(SoapFault $exception)
		{
		//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		
		$error = ($exception->getMessage());

		return View::make('backend.flight.reservation', compact('error'));

		}


		// Redirect to the new blog post page
		return View::make('backend.flight.reservation', compact('reservation'));
	





		}
		else {

			try {


		$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
                            "trace"=>1,
                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
                            "uri" =>"http://booking.us.org/",
								 ));


	  	$addRequest = new stdClass();	
		$addRequest->strFlightId       = $flightid;
		
		$raw_reservation = $client->Reservation($addRequest);


		  $reservation = new SimpleXMLElement($raw_reservation->return);

		}
		catch(SoapFault $exception)
		{
		//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
		
		$error = ($exception->getMessage());

		return View::make('backend.flight.reservation', compact('error'));

		}


		// Redirect to the new blog post page
		return View::make('backend.flight.reservation', compact('reservation'));
	









		}
   
	}










	

}
