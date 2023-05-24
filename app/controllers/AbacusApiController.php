<?php

class AbacusApiController extends BaseController {

	public $ipcc = "1B48";
	public static $abacus_test_url = 'abacus@blackeyetravels.com';
	public static $abacus_live_url = 'abacus@blackeyetravels.com';
	public static $abacus_url 	   = 'abacus@blackeyetravels.com';

	public static $abacus_live_strUserId   = "BLKEYE"; 
	public static $abacus_live_strPassword = "jan2015";
	public static $abacus_live_strAgencyId = "7971";
    
	public function getFlightAvailability() 
	{

		$rules = array(
			'origin'   		=> 'required',
			'destination' 	=> 'required',
			'trip_type' 	=> 'required',
			'flight_date_intl' 	=> 'required',
			'adults'      	=> 'required',
			
		);



// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}



		$origin = Input::get('origin');
		$destination = Input::get('destination');
		$flight_date = Input::get('flight_date_intl');
		$adults = Input::get('adults');
		$trip_type = Input::get('trip_type');


		

		if (Input::has('return_date_intl')) {
			$return_date = Input::get('return_date_intl');
		} else {
			$return_date = '';
		}

		
		
		Session::put('origin', $origin);
		Session::put('destination', $destination);
		Session::put('flight_date', $flight_date);
		Session::put('return_date', $return_date);
		Session::put('adults', $adults);
		Session::put('trip_type', $trip_type);

		$backend = Input::get('backend');

		/*
		$action = 'OTA_AirAvailLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'OTA_AirAvailLLSRQ';

   		$payload = '<OTA_AirAvailRQ Version="2.1.0" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	      <OriginDestinationInformation>
	         <FlightSegment DepartureDateTime="12-21">
	            <DestinationLocation LocationCode="'. $destination .'"/>
	            <OriginLocation LocationCode="'. $origin .'"/>
	         </FlightSegment>
	      </OriginDestinationInformation>
	   	</OTA_AirAvailRQ>'; 
		
		*/
	   		

	  if($trip_type=="R"){
	   	
	  $action = 'OTA_AirLowFareSearchLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'OTA_AirLowFareSearchLLSRQ';

   	$payload = '<OTA_AirLowFareSearchRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" EchoToken="String" TimeStamp="2001-12-17T09:30:47-05:00" Target="Production" Version="1.13.1" SequenceNmbr="1" PrimaryLangID="en-us" AltLangID="en-us">
  <POS>
    <Source PseudoCityCode="'. $this->ipcc .'"/>
  </POS>
  <TPA_Extensions>
    <MessagingDetails>
      <MDRSubset Code="INT5" />
    </MessagingDetails>
  </TPA_Extensions>
  <OriginDestinationInformation RPH="1">

                     

                        <DepartureDateTime>'. $flight_date .'</DepartureDateTime>

                        <OriginLocation LocationCode="'. $origin  .'" CodeContext="IATA"/>

                        <DestinationLocation LocationCode="'. $destination .'" CodeContext="IATA"/>

            </OriginDestinationInformation>

            <OriginDestinationInformation RPH="2">

                        <DepartureDateTime>'. $return_date .'</DepartureDateTime>

                        <OriginLocation LocationCode="'. $destination .'" CodeContext="IATA"/>

                        <DestinationLocation LocationCode="'. $origin  .'" CodeContext="IATA"/>

            </OriginDestinationInformation>





  
  <TravelerInformation>
    <PassengerTypeQuantity Code="ADT" Quantity="'. $adults .'"/>
  </TravelerInformation>
</OTA_AirLowFareSearchRQ>';
}
else{


	 $action = 'OTA_AirLowFareSearchLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'OTA_AirLowFareSearchLLSRQ';

   	$payload = '<OTA_AirLowFareSearchRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" EchoToken="String" TimeStamp="2001-12-17T09:30:47-05:00" Target="Production" Version="1.13.1" SequenceNmbr="1" PrimaryLangID="en-us" AltLangID="en-us">
  <POS>
    <Source PseudoCityCode="'. $this->ipcc .'"/>
  </POS>
  <TPA_Extensions>
    <MessagingDetails>
      <MDRSubset Code="INT5" />
    </MessagingDetails>
  </TPA_Extensions>
  <OriginDestinationInformation RPH="1">

                     

                        <DepartureDateTime>'. $flight_date .'</DepartureDateTime>

                        <OriginLocation LocationCode="'. $origin  .'" CodeContext="IATA"/>

                        <DestinationLocation LocationCode="'. $destination .'" CodeContext="IATA"/>

            </OriginDestinationInformation>
  
  <TravelerInformation>
    <PassengerTypeQuantity Code="ADT" Quantity="'. $adults .'"/>
  </TravelerInformation>
</OTA_AirLowFareSearchRQ>';
}
	
	
		

		$results = $this->query($action, $payload, $eb_type, $eb_service, null);

		//return  var_dump($results);

		//echo $results;

		//exit;

		//return Response::make($results)->header('Content-Type', 'text/xml;charset=utf-8');

		if(empty($backend)) {
			$slug = 'frontend';		
		} else {
			$slug = 'backend.flight_search';
		}

		
	

			return  View::make($slug.'.flightresultsintl', compact('results', 'origin', 'destination', 'flight_date', 'return_date', 'trip_type'));	

	}

	public function airBook()
	{
		$origin = Input::get('origin');
		$destination = Input::get('destination');

		$backend = Input::get('backend');

	  $action = 'OTA_AirLowFareSearchLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'OTA_AirLowFareSearchLLSRQ';

   	$payload = '<OTA_AirBookRQ Version="2.0.0" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
 <OriginDestinationInformation>
  <FlightSegment DepartureDateTime="2012-12-21T12:25" ArrivalDateTime="2012-12-21T13:25" FlightNumber="1717" NumberInParty="2" ResBookDesigCode="Y" Status="NN">
   <DestinationLocation LocationCode="LAS"/>
   <Equipment AirEquipType="757"/>
   <MarketingAirline Code="AA" FlightNumber="1717"/>
   <OperatingAirline Code="AA"/>
   <OriginLocation LocationCode="DFW"/>
  </FlightSegment>
  <FlightSegment DepartureDateTime="2012-12-24T11:10" ArrivalDateTime="2012-12-24T15:50" FlightNumber="1174" NumberInParty="2" ResBookDesigCode="Y" Status="NN">
   <DestinationLocation LocationCode="DFW"/>
   <Equipment AirEquipType="757"/>
   <MarketingAirline Code="AA" FlightNumber="1174"/>
   <OperatingAirline Code="AA"/>
   <OriginLocation LocationCode="LAS"/>
  </FlightSegment>
 </OriginDestinationInformation>
</OTA_AirBookRQ>';

		$results = $this->query($action, $payload, $eb_type, $eb_service, null);

		//return  var_dump($results);

		//return Response::make($results)->header('Content-Type', 'text/xml;charset=utf-8');

		if(empty($backend)) {
			$slug = 'frontend';		
		} else {
			$slug = 'backend.flight_search';
		}

		return  View::make($slug.'.flightresultsintl', compact('results'));	
		//return results;			           
	}


	public function getHotelAvailability($city = 'KTM') 
	{

		$action = 'OTA_HotelAvailLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'OTA_HotelAvailLLSRQ';		

	  $payload = '<OTA_HotelAvailRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" EchoToken="String" TimeStamp="2001-12-17T09:30:47-05:00" Target="Production" Version="1.9.1" SequenceNmbr="1" PrimaryLangID="en-us" AltLangID="en-us">
								  <POS>
								    <Source PseudoCityCode="1B48"/>
								  </POS>
								  <AvailRequestSegments>
								    <AvailRequestSegment>
								      <StayDateRange Start="2014-09-22T00:00:00" End="2014-09-25T00:00:00"/>
								      <RoomStayCandidates>
								        <RoomStayCandidate>
								          <GuestCounts>
								            <GuestCount Count="2"/>
								          </GuestCounts>
								        </RoomStayCandidate>
								      </RoomStayCandidates>
								      <HotelSearchCriteria>
								        <Criterion>
								          <HotelRef HotelCityCode="'. $city .'" /> 
								        </Criterion>
								      </HotelSearchCriteria>
								    </AvailRequestSegment>
								  </AvailRequestSegments>
								</OTA_HotelAvailRQ>​'; 	


		$results = $this->query($action, $payload, $eb_type, $eb_service, null);

		//echo $results;

		//exit();

		return $results;

		//return Response::make($results)->header('Content-Type', 'text/xml;charset=utf-8');

		//return  View::make('frontend.hotels.index', compact('results'));				           
	}

	public function getHotelDescription($code = 1) 
	{
		$action = 'HotelPropertyDescriptionLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'HotelPropertyDescriptionLLSRQ';		

	  $payload = '<HotelPropertyDescriptionRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" EchoToken="String" TimeStamp="2001-12-17T09:30:47-05:00" Target="Production" Version="1.12.1" SequenceNmbr="1" PrimaryLangID="en-us" AltLangID="en-us">
								  <POS>
								    <Source PseudoCityCode="1B48" />
								  </POS>
								  <AvailRequestSegments>
								    <AvailRequestSegment ResponseType="PropertyList">
								      <StayDateRange Start="2014-12-15T00:00:00" End="2014-12-20T00:00:00" />
								      <RoomStayCandidates>
								        <RoomStayCandidate>
								          <GuestCounts IsPerRoom="">
								            <GuestCount Count="1" />
								          </GuestCounts>
								        </RoomStayCandidate>
								      </RoomStayCandidates>
								      <HotelSearchCriteria>
								        <Criterion>
								          <HotelRef HotelCode="'. $code .'" />
								        </Criterion>
								      </HotelSearchCriteria>
								    </AvailRequestSegment>
								  </AvailRequestSegments>
								</HotelPropertyDescriptionRQ>​'; 	


		$results = $this->query($action, $payload, $eb_type, $eb_service, null);

		//echo $results;

		//exit();

		return $results;

		//return Response::make($results)->header('Content-Type', 'text/xml;charset=utf-8');

		//return  View::make('frontend.hotels.index', compact('results'));				           
	}

	public function getVehicleAvailability($state_code = 'TX', $postal_code = '76051') 
	{
		$action = 'VehLocationFinderLLSRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'VehLocationFinderLLSRQ';		

	   	$payload = '<VehLocationFinderRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07" xmlns:xs="http://www.w3.org/2001/XMLSchema" AltLangID="en-us" EchoToken="String" PrimaryLangID="en-us" SequenceNmbr="1" Target="Production" TimeStamp="2001-12-17T09:30:47-05:00" Version="1.5.1">
								  <POS>
								    <Source PseudoCityCode="'. $this->ipcc .'" />
								  </POS>
								  <VehAvailRQCore>
								    <VehRentalCore PickUpDateTime="2014-09-22T09:00:00" ReturnDateTime="2014-09-29T09:00:00">
								    </VehRentalCore>
								    <Info>
								      <LocationDetails>
								        <Address>
								          <PostalCode>'. $postal_code .'</PostalCode>
								          <StateCountyProv StateCode="'. $state_code .'" />
								        </Address>
								      </LocationDetails>
								    </Info>
								  </VehAvailRQCore>
								</VehLocationFinderRQ>​'; 	


		$results = $this->query($action, $payload, $eb_type, $eb_service, null);

		//echo $results;

		//exit();

		return $results;

		//return Response::make($results)->header('Content-Type', 'text/xml;charset=utf-8');

		//return  View::make('frontend.hotels.index', compact('results'));				           
	}

	public function sessionCreate($task_remaining) 
	{
		$action = 'SessionCreateRQ';
		$eb_type = 'sabreXML';
		$eb_service = 'Session';

		$payload = '<SessionCreateRQ>
				      <POS>
				        <Source PseudoCityCode="1B48"/>
				      </POS>
			    	</SessionCreateRQ>';

		return  $this->query($action, $payload, $eb_type, $eb_service, $task_remaining);
	}
    
    public function query($action, $payload, $eb_type, $eb_service, $task_remaining)
	{

		$from ="abacus@blackeyetravels.com";
		$conversation_id = time() ."@resourcecentre.abacus.com.sg";
		$username = "7971";
		$password = "mar2017";
		
		$token= "";
		$error= "";
		$system="https://webservices.sabre.com/websvc";
		$system_test = 'https://sws-sts.cert.sabre.com';
		$system_cert = 'https://sws-crt.cert.sabre.com';
		$system_production = 'https://webservices.sabre.com/websvc';

		$message_id = "mid:" . time() . $from;
		$timestamp = gmdate("Y-m-d\TH-i-s\Z");
	    	$timetolive = gmdate("Y-m-d\TH-i-s\Z");

	    if($action != "SessionCreateRQ") {
			if (!Session::has('abacus_conversation_id') or !Session::has('abacus_token')) {	    	

		    	$task_remaining = array(
		    		'action' => $action, 
		    		'payload' => $payload, 
		    		'eb_type' => $eb_type, 
		    		'eb_service' => $eb_service, 
		    		);

		    	return $this->SessionCreate($task_remaining);

		    } else {

			    $conversation_id = Session::get('abacus_conversation_id');

					$token= Session::get('abacus_token');	

					$abacus_timestamp = Session::get('abacus_timestamp');

					//echo 'We are here. ' . $abacus_timestamp;
					//exit();

					$timestamp = strtotime($abacus_timestamp);

					$curtime = time();

					if(($curtime - $timestamp) > 1800) {
						
					 	$task_remaining = array(
						    		'action' => $action, 
						    		'payload' => $payload, 
						    		'eb_type' => $eb_type, 
						    		'eb_service' => $eb_service, 
						    		);

			    	return $this->SessionCreate($task_remaining);				
					}
				//return $timestamp;
		    }	    	
	    }

	    if($action=="SessionCreateRQ") {
			$security =   '<wsse:UsernameToken>
						   <wsse:Username>'. $username .'</wsse:Username>
						   <wsse:Password>'. $password .'</wsse:Password>
						   <Organization>'. $this->ipcc .'</Organization>
						   <Domain>Default</Domain>
						   </wsse:UsernameToken>';
		} else {
		   	$security = '<wsse:BinarySecurityToken>'. $token .'</wsse:BinarySecurityToken>';	   	

		}

		$envelope='<?xml version="1.0" encoding="utf-8"?>
				      <soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">
				      <soap-env:Header>
			          	<eb:MessageHeader xmlns:eb="http://www.ebxml.org/namespaces/messageHeader">
			          		<eb:From><eb:PartyId eb:type="urn:x12.org.IO5:01">'. $from .'</eb:PartyId></eb:From>
			          		<eb:To><eb:PartyId eb:type="urn:x12.org.IO5:01">webservices.sabre.com</eb:PartyId></eb:To>
			          		<eb:ConversationId>'. $conversation_id .'</eb:ConversationId>
				      		<eb:Service eb:type="'. $eb_type .'">'. $eb_service .'</eb:Service>
				      		<eb:Action>'. $action .'</eb:Action>
					          <eb:CPAID>'. $this->ipcc .'</eb:CPAID>"
			          		<eb:MessageData>
		              			<eb:MessageId>'. $message_id .'</eb:MessageId>
				      			<eb:Timestamp>'. $timestamp .'</eb:Timestamp>
  				      			<eb:TimeToLive>'. $timetolive .'</eb:TimeToLive>
		              		</eb:MessageData>
					  	</eb:MessageHeader>
                      	<wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">'. $security .'</wsse:Security>
					  </soap-env:Header>
					  <soap-env:Body>
					  	'. $payload .'
					  </soap-env:Body>
					  </soap-env:Envelope>';

		ini_set('max_execution_time', 300);
		libxml_use_internal_errors(true);	

		$soap_do = curl_init($system);
		$header = array(
		"Content-Type: text/xml;charset=utf-8",
		"Accept: gzip,deflate",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"Content-Length: ".strlen($envelope));
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 100);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $envelope);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_HEADER, false);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);

		$raw_xml = curl_exec($soap_do);

		curl_close($soap_do);

		if ($action == 'OTA_AirLowFareSearchLLSRQ') {
			//echo $raw_xml;
			}


		if(empty($raw_xml)) {

		        	$error = 'Sorry, we could not connect to international system this time. Please try again later.'
		            	.'<br> ' . $raw_xml;
		        	return $error;
		}

		//return $raw_xml;


		if($action=="SessionCreateRQ") {

      $your_xml_response = $raw_xml;
			$clean_xml = str_ireplace(['soap-env:', 'soap:', 'eb:', 'wsse:'], '', $your_xml_response);
			
			//return $clean_xml;

			$xml = simplexml_load_string($clean_xml);

			$conversation_id = (string)$xml->Header->MessageHeader->ConversationId;

			$token = (string)$xml->Header->Security->BinarySecurityToken;

			if (isset($conversation_id) and isset($token)) {

				Session::put('abacus_conversation_id', $conversation_id);
				Session::put('abacus_token', $token);

				$current_timestamp = new DateTime;

				$abacus_timestamp = $current_timestamp->format('Y-m-d H:i:s');

				Session::put('abacus_timestamp', $abacus_timestamp);

				if (is_array($task_remaining)) {

					return  $this->query($task_remaining['action'], $task_remaining['payload'], $task_remaining['eb_type'], $task_remaining['eb_service'], null);
					
				} else {
					return 'Session Created. ConversationId: ' . Session::get('abacus_conversation_id') . ' Token: ' . Session::get('abacus_token') ;
				}
			}
		    //$parser = new SimpleXMLElement($flightavailability5);
		    return 'Session could not be created.';
	 	} else {

	    	// converting
	    		//$your_xml_response = $raw_xml;			

			//$clean_xml =  preg_replace("/<.*(xmlns *= *[\"'].[^\"']*[\"']).[^>]*>/i", "",  $raw_xml); // This removes ALL default namespaces.

	 		// Gets rid of all namespace definitions 
			//$xml_string = preg_replace('/xmlns[^=]*="[^"]*"/i', '', $raw_xml);

			// Gets rid of all namespace references
			//$xml_string = preg_replace('/(<\/*)[^>:]+:/', '$1', $xml_string);

			$clean_xml = str_ireplace(['soap-env:', 'soap:', 'eb:', 'wsse:'], '', $raw_xml);

			/*if ($action == 'HotelPropertyDescriptionLLSRQ') {
				echo $clean_xml;
				exit();
			}*/
			

			$xml = simplexml_load_string($clean_xml);




	 	}


		  return $xml;



	}
    
    
    
}
