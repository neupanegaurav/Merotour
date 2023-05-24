<?php

class FlightApiController extends Controller {

  /**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;
      
  public function getIndex()
	{

		if (Input::has('json')) {
			
			$json_encoded = stripslashes(Input::get('json'));

			$json = json_decode($json_encoded);		

		
			//return Response::make($json_encoded)->header('Content-Type', "application/json");

			//return var_dump($json);

			//$test = $json->flight_availability->sector_from;

			

			//return $sector_from ." - " . $sector_to ." - " . $flight_date ." - " . $return_date ." - " .  $trip_type ." - " . $adults ." - " . $children;

			//return var_dump($json);

			if (isset($json->flight_availability)) {

				if (isset($json->flight_availability->sector_from)
					and isset($json->flight_availability->sector_to)
					and isset($json->flight_availability->flight_date)
					and isset($json->flight_availability->trip_type)
					and isset($json->flight_availability->nationality)
					and isset($json->flight_availability->adults)
					and isset($json->flight_availability->children)
					) {
					$sector_from 	= $json->flight_availability->sector_from;
				$sector_to		= $json->flight_availability->sector_to;
				$flight_date 	= $json->flight_availability->flight_date;
				$trip_type 		= $json->flight_availability->trip_type;
				$return_date    = $json->flight_availability->return_date;
				$nationality    = $json->flight_availability->nationality;
				$adults         = $json->flight_availability->adults;
				$children       = $json->flight_availability->children;

				try {
					$client = @new SoapClient("http://116.66.198.19/us/UnitedSolutions?wsdl", array(
			                            "trace"=>1,
			                            "location" =>"http://116.66.198.19/us/UnitedSolutions",
			                            "uri" =>"http://booking.us.org/"));

					$addRequest = new stdClass();
					$addRequest->strUserId      = "BLKEYE"; 
					$addRequest->strPassword    = "PASSWORD";
					$addRequest->strAgencyId    = "PLZ004";
					$addRequest->strSectorFrom  = $sector_from;
					$addRequest->strSectorTo    = $sector_to;
					$addRequest->strFlightDate  = $flight_date;
					$addRequest->strTripType    = $trip_type;
					$addRequest->strReturnDate  = $return_date;
					$addRequest->strNationality = "NP";
					$addRequest->intAdult       = $adults;
					$addRequest->intChild       = $children;


					$raw_flightavailability = $client->FlightAvailability($addRequest);

					$flightavailability = new SimpleXMLElement($raw_flightavailability->return);

				} catch (SoapFault $exception) {

				//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
				$error = ($exception->getMessage());

				return Response::json(array('error' => $error));
				}

				$json_encode_soap = json_encode($flightavailability);

				//$json_piece = json_decode($json_encode_soap);

				//return var_dump($json_encode_soap);

				//$json_full = '[' . $json_encode_soap . ']';

				//$json_encoded = json_encode($json_full);	

				return Response::make($json_encode_soap)->header('Content-Type', "application/json");

				}

			
			}

			//return Response::json($json);
			
		}

		/*$response = array(
				array(
					'vehicleType2' 	=> 'excavator2',
					'vehicleColor' => 'yellow',
					 'fuel'         => 'diesel'
				)
			);

		return Response::json($response);*/

		return Response::json(array(array('success' => 'Welcome to Blackeye API.')));

		/*$json = '{
		    "auth": {
		        "api_key": "53fdab101c770"
		    },
		    "flight_availability": {
		            "sector_from": "kathmandu",
		            "sector_to": "pokhara",
		            "flight_date": "2014-08-30",
		            "trip_type": "o",
		            "return_date": null,
		            "nationality": "NP",
		            "adults": 1,
		            "children": 0
		    }
		}';

		$json = preg_replace('/\s+/', '', $json);

		return $json;*/
    	//{"auth":{"api_key":"53fdab101c770"},"flight_availability":{"sector_from":"KTM","sector_to":"PKR","flight_date":"30-08-2014","trip_type":"O","return_date":"","nationality":"NP","adults":1,"children":0}}
		

		

		//return $json->Outbound->Availability[1]->FlightNo;
	}

	public function postIndex()
	{

		$flight_availability = Input::get('flight_availability');

		//$inputget = Input::get();	


		//return $inputget;

		//return $flight_availability['sector_from'];

		//return $json_encoded;

		//$json = json_decode($json_encoded);
	
		//return Response::make($json_encoded)->header('Content-Type', "application/json");

		//return var_dump($json_encoded);

		//$test = $json->flight_availability->sector_from;

		

		//return $sector_from ." - " . $sector_to ." - " . $flight_date ." - " . $return_date ." - " .  $trip_type ." - " . $adults ." - " . $children;

		//return var_dump($json);

		if (isset($flight_availability)) {

				if (isset($flight_availability['sector_from'])
					and isset($flight_availability['sector_to'])
					and isset($flight_availability['flight_date'])
					and isset($flight_availability['trip_type'])
					and isset($flight_availability['nationality'])
					and isset($flight_availability['adults'])
					and isset($flight_availability['children'])
					) {
					$sector_from 	= $flight_availability['sector_from'];
					$sector_to		= $flight_availability['sector_to'];
					$flight_date 	= $flight_availability['flight_date'];
					$trip_type 		= $flight_availability['trip_type'];
					$return_date    = $flight_availability['return_date'];
					$nationality    = $flight_availability['nationality'];
					$adults         = $flight_availability['adults'];
					$children       = $flight_availability['children'];

					try {
						$client = @new SoapClient("http://116.66.198.19/us/UnitedSolutions?wsdl", array(
				                            "trace"=>1,
				                            "location" =>"http://116.66.198.19/us/UnitedSolutions",
				                            "uri" =>"http://booking.us.org/"));

						$addRequest = new stdClass();
						$addRequest->strUserId      = "BLKEYE"; 
						$addRequest->strPassword    = "PASSWORD";
						$addRequest->strAgencyId    = "PLZ004";
						$addRequest->strSectorFrom  = $sector_from;
						$addRequest->strSectorTo    = $sector_to;
						$addRequest->strFlightDate  = $flight_date;
						$addRequest->strTripType    = $trip_type;
						$addRequest->strReturnDate  = $return_date;
						$addRequest->strNationality = "NP";
						$addRequest->intAdult       = $adults;
						$addRequest->intChild       = $children;


						$raw_flightavailability = $client->FlightAvailability($addRequest);

						$flightavailability = new SimpleXMLElement($raw_flightavailability->return);

					} catch (SoapFault $exception) {

					//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
					$error = ($exception->getMessage());

					return Response::json(array('error' => $error));
					}

					$json_encode_soap = json_encode($flightavailability);

					//$json_piece = json_decode($json_encode_soap);

					//return var_dump($json_encode_soap);

					//$json_full = '[' . $json_encode_soap . ']';

					//$json_encoded = json_encode($json_full);	

					return Response::make($json_encode_soap)->header('Content-Type', "application/json");

				}

			
			}


		return Response::json(array('error' => 'Error. Please check your json request data.'));

		/*$json = '{
		    "auth": {
		        "api_key": "53fdab101c770"
		    },
		    "flight_availability": {
		            "sector_from": "kathmandu",
		            "sector_to": "pokhara",
		            "flight_date": "2014-08-30",
		            "trip_type": "o",
		            "return_date": null,
		            "nationality": "NP",
		            "adults": 1,
		            "children": 0
		    }
		}';

		$json = preg_replace('/\s+/', '', $json);

		return $json;*/
    	//{"auth":{"api_key":"53fdab101c770"},"flight_availability":{"sector_from":"KTM","sector_to":"PKR","flight_date":"30-08-2014","trip_type":"O","return_date":"","nationality":"NP","adults":1,"children":0}}
		

		

		//return $json->Outbound->Availability[1]->FlightNo;
	}

	public function postPnr() 
  {
  	//$inputget = Input::get();	

		//return $inputget;

  	if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}

		if (Input::has('logged_in_user')) {
			$logged_in_user = Input::get('logged_in_user');
		} else {
			return Response::json(['success' => 'false', 'message' => 'logged_in_user attribute is missing.']);
		}

		if (Input::has('booking_info')) {
			$booking_info = Input::get('booking_info');
		} else {
			return Response::json(['success' => 'false', 'message' => 'booking_info attribute is missing.']);
		}

		if (Input::has('contact_info')) {
			$contact_info = Input::get('contact_info');
		} else {
			return Response::json(['success' => 'false', 'message' => 'contact_info attribute is missing.']);
		}

		if (Input::has('passenger_info')) {
			$passenger_info = Input::get('passenger_info');
		} else {
			return Response::json(['success' => 'false', 'message' => 'passenger_info attribute is missing.']);
		}
  	
  	$this->messageBag = new Illuminate\Support\MessageBag;

		$input = array(
			'flightid' 				=> $booking_info['flightid'],
			'returnflightid' 	=> $booking_info['returnflightid'],
			'flight_no' 			=> $booking_info['flight_no'],
			'airline' 				=> $booking_info['airline'],
			'adults' 					=> $booking_info['adults'],
			'children' 				=> $booking_info['children'],
			'adult_fare' 			=> $booking_info['adult_fare'],
			'child_fare' 			=> $booking_info['child_fare'],
			'fuel_surcharge' 	=> $booking_info['fuel_surcharge'],
			'tax' 						=> $booking_info['tax'],
			'class_code' 			=> $booking_info['class_code'],
			'free_baggage' 		=> $booking_info['free_baggage'],
			'sector_from' 		=> $booking_info['sector_from'],
			'sector_to' 			=> $booking_info['sector_to'],
			'trip_type' 			=> $booking_info['trip_type'],
			'contact_name' 		=> $contact_info['contact_name'],
			'contact_number' 	=> $contact_info['contact_number'],
			'contact_email' 	=> $contact_info['contact_email'],
		);

    // Declare the rules for the form validation
		$rules = array(
			'flightid' 				=> 'required',
			'flight_no' 			=> 'required',
			'airline' 				=> 'required',
			'adults' 					=> 'required',
			'children' 				=> 'required',
			'adult_fare' 			=> 'required',
			'child_fare' 			=> 'required',
			'fuel_surcharge' 	=> 'required',
			'tax' 						=> 'required',
			'class_code' 			=> 'required',
			'free_baggage' 		=> 'required',
			'sector_from' 		=> 'required',
			'sector_to' 		=> 'required',
			'trip_type' 		=> 'required',
			'contact_name' 		=> 'required',
			'contact_number' 	=> 'required',
			'contact_email' 	=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
		}

		$flightid 			= $input['flightid'];		
		$returnflightid = $input['returnflightid'];
		$flight_no 			= $input['flight_no'];
		$airline 				= $input['airline'];
		$adults 				= $input['adults'];
		$children 			= $input['children'];
		$adult_fare 		= $input['adult_fare'];
    $child_fare 		= $input['child_fare'];
    $fuel_surcharge = $input['fuel_surcharge'];
    $tax 						= $input['tax'];
    $class_code 		= $input['class_code'];
    $free_baggage   = $input['free_baggage'];
    $sector_from   = $input['sector_from'];
    $sector_to   = $input['sector_to'];
    $trip_type   = $input['trip_type'];

    $contact_name   = $input['contact_name'];
    $contact_number = $input['contact_number'];
    $contact_email  = $input['contact_email'];


		$user = $logged_in_user;

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
	
		$post->invoice_no   = $invoice_no;

		$post->contact_name 	= $contact_name;
		$post->contact_number =	$contact_number;
		$post->contact_email 	= $contact_email;
		$post->user_id 				= $logged_in_user;
		$post->flightid 			= $flightid;
		$post->flight_no 			= $flight_no;
		$post->returnflightid = $returnflightid;
		$post->adults 				= $adults;
		$post->children 			= $children;
		$post->adult_fare 		= $adult_fare;
		$post->child_fare 		= $child_fare;
		$post->fsc 						= $fuel_surcharge;
		$post->tax 						= $tax;
		$post->departure 			= $sector_from;
		$post->arrival 				= $sector_to;
		$post->class_code 		= $class_code;
		$post->trip_type 			= $trip_type;
		$post->airline 				= $airline;
		$post->api 						= 'Domestic Flights';
		$post->free_baggage 	= $free_baggage;
		

		if (!$post->save()) {
			return Response::json(['error' => 'Could not save the reserved ticket.']);
		}

		foreach ($passenger_info as $passenger) {

			$post = new DomesticPassengerDetails;

			$post->invoice_no 	= $invoice_no;
			$post->user_id 			= $logged_in_user;
			$post->passenger_no = $passenger['passenger_no'];
			$post->gender 			= $passenger['passenger_gender'];
			$post->title 				= $passenger['passenger_title'];
			$post->first_name 	= $passenger['passenger_first_name'];
			$post->last_name 		= $passenger['passenger_last_name'];
			$post->nationality 	= $passenger['passenger_nationality'];
			$post->pax_type 		= $passenger['passenger_pax_type'];	
			$post->pax_remarks 	= $passenger['passenger_pax_remarks'];	
			
			if($passenger['passenger_pax_type'] == 'ADULT'){
				$post->fare = $adult_fare;
			} elseif ($passenger['passenger_pax_type'] == 'CHILD') {
				$post->fare = $child_fare;
			}

			$post->surcharge 		= $fuel_surcharge;
			$post->tax 					= $tax;

			// Was the blog post created?
			if(!$post->save()) {
				// Redirect to the new blog post page
				return Response::json(['error' => 'Passenger Data could not be saved to the system.']);
			}
		}			

		return Response::json(['success' => 'PNR records successfully saved to database.']);	
	}

	public function getReservedTickets() {
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}

		if (Input::has('logged_in_user')) {
			$logged_in_user = Input::get('logged_in_user');
		} else {
			return Response::json(['success' => 'false', 'message' => 'logged_in_user attribute is missing.']);
		}

		$entries = ReservedDomesticTickets::where('user_id', $logged_in_user)->orderBy('created_at', 'DESC')->get(); 

		return $entries;

	}

	public function getIssuedTickets() {
		if(Input::has('auth')) {
			$auth = Input::get('auth');

			if (isset($auth['api_key'])) {
				if ($auth['api_key'] != '53fdab101c770') {
					return Response::json(['success' => 'false', 'message' => 'api_key is invalid.']);
				}
			} else {
				return Response::json(['success' => 'false', 'message' => 'Auth->api_key attribute is missing.']);
			}
		} else {
			return Response::json(['success' => 'false', 'message' => 'Auth attribute is missing.']);
		}

		if (Input::has('logged_in_user')) {
			$logged_in_user = Input::get('logged_in_user');
		} else {
			return Response::json(['success' => 'false', 'message' => 'logged_in_user attribute is missing.']);
		}

		$entries = BookedDomesticTickets::where('user_id', $logged_in_user)->orderBy('created_at', 'DESC')->get(); 

		return $entries;

	}

}
