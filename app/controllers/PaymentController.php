<?php

class PaymentController extends BaseController {

    public function postRequest() {    	
     // Declare the rules for the form validation
		$rules = array(
			'payment_options' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$flightid 				= Session::get('flightid');
		$returnflightid 	= Session::get('returnflightid');
		$adults 					= Session::get('adults');
		$children 				= Session::get('children');

		$payment_options 	= Input::get('payment_options');

		$account_type = Session::get('account_type');

		$airline 		= Session::get('airline');
		$class_code = Session::get('class_code_'.$flightid);	
		$departure 	= Session::get('departure');
		$arrival 		= Session::get('arrival');

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

			$adult_fare = Session::get('adult_fare_'.$flightid);
      if (isset($agent_commission)) {       
          $final_af = ceil( $adult_fare -(($agent_commission/100) * $adult_fare));
      } else {
          $final_af = $adult_fare;
      }

        $child_fare 		= Session::get('child_fare_'.$flightid);
        $fuel_surcharge 	= Session::get('fuel_surcharge_'.$flightid);
        $tax 				= Session::get('tax_'.$flightid);

        $adult_total 		= ($final_af + $fuel_surcharge + $tax) * ($adults);
        $child_total 		= ($child_fare + $fuel_surcharge + $tax) * ($children);

        $total 				= $adult_total + $child_total;

        $test = Input::get('backend');

				if(!empty($test)) {
					$slug = 'backend.flight_search';
				} else {
					$slug = 'frontend';
				}


        if ($payment_options == 'account_balance') {

        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();


            if(!empty($entry->balance) and $entry->balance >= $total) {

            	$new_balance = $entry->balance - $total;

            	$entry->balance = $new_balance;

            	if(!$entry->save()) {
            		return Redirect::back()->with('error', 'Balance could not be updated.');
            	}

					$user = Sentry::getUser();

					//Reserve Ticket API Call
					if(ApplicationSetting::first()->value == 1 ) {
						try {
							$client = new SoapClient(FlightController::$united_url);

						  	$addRequest = new stdClass();	
							$addRequest->strFlightId       = $flightid;
							$addRequest->strReturnFlightId = $returnflightid;
							
							$raw_reservation = $client->Reservation($addRequest);

							//return var_dump($raw_reservation);

							$reservation = new SimpleXMLElement($raw_reservation->return);


							if (is_null($post = ReservedDomesticTickets::where('invoice_no', Session::get('invoice_no'))->first())) {
									// Redirect to the blogs management page
									return Redirect::back()->with('error', "Couldn't find the reserved ticket.");
							}

							
							$post->airline_id = (string)$reservation->PNRDetail->AirlineID;
							$post->pnr_no = (string)$reservation->PNRDetail->PNRNO;
							$post->reservation_status = (string)$reservation->PNRDetail->ReservationStatus;
							$post->ttl_date = (string)$reservation->PNRDetail->TTLDate;
							$post->ttl_time = (int)$reservation->PNRDetail->TTLTime;	
							$post->payment_method = 'account_balance';
							
							if (!$post->save()) {
								$error = 'Could not save reservation data';
								return View::make('frontend.reservation', compact('error'));
							}
						} catch (SoapFault $exception) {
							//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
							
							$error = ($exception->getMessage());

							return View::make($slug. '.reservation', compact('error'));
						}
					}

				//Issue Ticket
				$flightid 		= Session::get('flightid');
				$returnflightid = Session::get('returnflightid');
				$adults 		= Session::get('adults');
				$children 		= Session::get('children');			

				if(ApplicationSetting::first()->value == 0 )
				{
					try {

						$client = new SoapClient(FlightController::$united_url);

						$passengers = NULL;

						for ($i=1; $i <= ($adults + $children); $i++) {

							$passengers .= '
						<Passenger>
						<PaxType>'. Session::get("passenger{$i}_pax_type") .'</PaxType>
						<Title>'. Session::get("passenger{$i}_title") .'</Title>
						<Gender>'. Session::get("passenger{$i}_gender") .'</Gender>
						<LastName>'. Session::get("passenger{$i}_last_name") .'</LastName>
						<FirstName>'. Session::get("passenger{$i}_first_name") .'</FirstName>
						<Nationality>'. Session::get("passenger{$i}_nationality") .'</Nationality>
						<PaxRemarks>'. Session::get("passenger{$i}_pax_remarks") .'</PaxRemarks>
						</Passenger>';

						}

						$passengerdetail = "<PassengerDetail>
						 $passengers
						</PassengerDetail>
						";

					  $addRequest = new stdClass();	
						$addRequest->strFlightId       = $flightid;
						$addRequest->strReturnFlightId = $returnflightid;
						$addRequest->strContactName = Session::get('contact_name');
						$addRequest->strContactEmail = Session::get('contact_email');
						$addRequest->strContactMobile = Session::get('contact_number');
						$addRequest->strPassengerDetail = $passengerdetail;
						
						$raw_issueticket = $client->IssueTicket($addRequest);


						$issueticket = new SimpleXMLElement($raw_issueticket->return);

					} catch(SoapFault $exception) {
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
				$post->contact_name = Session::get('contact_name');
				$post->contact_number = Session::get('contact_number');
				$post->contact_email = Session::get('contact_email');
				$post->adults = $adults;
				$post->children = $children;
				$post->api = 'Domestic Flights';

				if(ApplicationSetting::first()->value == 0 )
				{
					$post->pnr_no = (string)$issueticket->Passenger[0]->PnrNo;
					$post->airline = (string)$issueticket->Passenger[0]->Airline;
					$post->flight_no = (string)$issueticket->Passenger[0]->FlightNo;
					$post->departure = (string)$issueticket->Passenger[0]->Departure;
					$post->arrival = (string)$issueticket->Passenger[0]->Arrival;
					$post->issue_date = (string)$issueticket->Passenger[0]->IssueDate;
					$post->flight_date = (string)$issueticket->Passenger[0]->FlightDate;
					$post->flight_time = (string)$issueticket->Passenger[0]->FlightTime;
					$post->arrival_time = (string)$issueticket->Passenger[0]->ArrivalTime;	
					$post->booking_status = (string)$issueticket->Passenger[0]->BookingStatus;
					$post->class_code = (string)$issueticket->Passenger[0]->ClassCode;
					$post->currency = (string)$issueticket->Passenger[0]->Currency;
					$post->reporting_time = (string)$issueticket->Passenger[0]->ReportingTime;
					$post->free_baggage = (string)$issueticket->Passenger[0]->FreeBaggage;
				}
	
				// Was the blog post created?
				if(!$post->save())
				{
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}

				if(ApplicationSetting::first()->value == 0 )
				{
					$i = 1;
					foreach($issueticket->Passenger as $passenger) 
						{
							if (is_null($post = DomesticPassengerDetails::where('invoice_no', Session::get('invoice_no'))->where('passenger_no', $i)->first())) {
								// Redirect to the blogs management page
								return Redirect::back()->with('error', "Couldn't find the selected Booking.");
							}

							// Update the blog post data
							$post->user_id = Sentry::getUser()->id;
							$post->pnr_no = (string)$passenger->PnrNo;
							$post->ticket_no = (int)$passenger->TicketNo;
							$post->gender = (string)$passenger->Gender;
							$post->title = (string)$passenger->Title;
							$post->first_name = (string)$passenger->FirstName;
							$post->last_name = (string)$passenger->LastName;
							$post->nationality = (string)$passenger->Nationality;
							$post->pax_type = (string)$passenger->PaxType;	
							$post->fare = (int)$passenger->Fare;
							$post->surcharge = (int)$passenger->Surcharge;
							$post->tax = (int)$passenger->Tax;
							$post->pax_remarks = (string)$passenger->PaxRemarks;

							// Was the blog post created?
							if(!$post->save())
							{
								// Redirect to the new blog post page
								return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
							}
							$i++;
						}

				}

				// /Issue Ticket

				if(ApplicationSetting::first()->value == 1 ) {
         		$offline_processing = true;
         		return View::make($slug. '.issueticket', compact('offline_processing'));	
         		}
         
				// Redirect to the new blog post page
				return View::make($slug. '.issueticket', compact('issueticket'));		


                //return View::make($slug.'.reservation', compact('adults', 'children', 'user'));
          
            } else {
            	return Redirect::back()->with('error', 'Insufficient Balance');

            }       	
        } elseif ($payment_options == 'credit_balance') {

        	$entry = Funds::where('user_id', Sentry::getUser()->id)->first();

            if(!empty($entry->credit_balance) and $entry->credit_balance >= $total) 
            {
            	$new_credit_balance = $entry->credit_balance - $total;

            	$entry->credit_balance = $new_credit_balance;

            	if(!$entry->save()) 
            	{
            		return Redirect::back()->with('error', 'Credit balance could not be updated.');
            	}

				$user = Sentry::getUser();

				$test = Input::get('backend');

				if(!empty($test)) {
					$slug = 'backend.flight_search';
				} else {
					$slug = 'frontend';
				}

				//Reserve Ticket API Call
				if(ApplicationSetting::first()->value == 1 ) {
					try {
						$client = new SoapClient(FlightController::$united_url);

					  	$addRequest = new stdClass();	
						$addRequest->strFlightId       = $flightid;
						$addRequest->strReturnFlightId = $returnflightid;
						
						$raw_reservation = $client->Reservation($addRequest);

						//return var_dump($raw_reservation);

						$reservation = new SimpleXMLElement($raw_reservation->return);


						if (is_null($post = ReservedDomesticTickets::where('invoice_no', Session::get('invoice_no'))->first())) {
								// Redirect to the blogs management page
								return Redirect::back()->with('error', "Couldn't find the reserved ticket.");
						}

						
						$post->airline_id = (string)$reservation->PNRDetail->AirlineID;
						$post->pnr_no = (string)$reservation->PNRDetail->PNRNO;
						$post->reservation_status = (string)$reservation->PNRDetail->ReservationStatus;
						$post->ttl_date = (string)$reservation->PNRDetail->TTLDate;
						$post->ttl_time = (int)$reservation->PNRDetail->TTLTime;	
						$post->payment_method = 'account_balance';
						
						if (!$post->save()) {
							$error = 'Could not save reservation data';
							return View::make('frontend.reservation', compact('error'));
						}
					} catch (SoapFault $exception) {
						//$error = "Oops, we have some issue :<br/> Service temporarily unavailable. Please check back later.";
						
						$error = ($exception->getMessage());

						return View::make($slug. '.reservation', compact('error'));
					}
				}

				/*//Issue Ticket
				$flightid 		= Session::get('flightid');
				$returnflightid = Session::get('returnflightid');
				$adults 		= Session::get('adults');
				$children 		= Session::get('children');			

				if(ApplicationSetting::first()->value == 0 )
				{
					try {

						$client = new SoapClient("http://116.66.198.19:800/usBookingService/UnitedSolutions?wsdl", array(
				                            "trace"=>1,
				                            "location" =>"http://116.66.198.19:800/usBookingService/UnitedSolutions",
				                            "uri" =>"http://booking.us.org/",
												 ));

						$passengers = NULL;

						for ($i=1; $i <= ($adults + $children); $i++) {

							$passengers .= '
						<Passenger>
						<PaxType>'. Session::get("passenger{$i}_pax_type") .'</PaxType>
						<Title>'. Session::get("passenger{$i}_title") .'</Title>
						<Gender>'. Session::get("passenger{$i}_gender") .'</Gender>
						<LastName>'. Session::get("passenger{$i}_last_name") .'</LastName>
						<FirstName>'. Session::get("passenger{$i}_first_name") .'</FirstName>
						<Nationality>'. Session::get("passenger{$i}_nationality") .'</Nationality>
						<PaxRemarks>'. Session::get("passenger{$i}_pax_remarks") .'</PaxRemarks>
						</Passenger>';

						}

						$passengerdetail = "<PassengerDetail>
						 $passengers
						</PassengerDetail>
						";

					  	$addRequest = new stdClass();	
						$addRequest->strFlightId       = $flightid;
						$addRequest->strReturnFlightId = $returnflightid;
						$addRequest->strContactName = Session::get('contact_name');
						$addRequest->strContactEmail = Session::get('contact_email');
						$addRequest->strContactMobile = Session::get('contact_number');
						$addRequest->strPassengerDetail = $passengerdetail;
						
						$raw_issueticket = $client->IssueTicket($addRequest);


						$issueticket = new SimpleXMLElement($raw_issueticket->return);

					} catch(SoapFault $exception) {
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
				$post->contact_name = Session::get('contact_name');
				$post->contact_number = Session::get('contact_number');
				$post->contact_email = Session::get('contact_email');
				$post->adults = $adults;
				$post->children = $children;
				$post->api = 'Domestic Flights';

				if(ApplicationSetting::first()->value == 0 )
				{
					$post->pnr_no = (string)$issueticket->Passenger[0]->PnrNo;
					$post->airline = (string)$issueticket->Passenger[0]->Airline;
					$post->flight_no = (string)$issueticket->Passenger[0]->FlightNo;
					$post->departure = (string)$issueticket->Passenger[0]->Departure;
					$post->arrival = (string)$issueticket->Passenger[0]->Arrival;
					$post->issue_date = (string)$issueticket->Passenger[0]->IssueDate;
					$post->flight_date = (string)$issueticket->Passenger[0]->FlightDate;
					$post->flight_time = (string)$issueticket->Passenger[0]->FlightTime;
					$post->arrival_time = (string)$issueticket->Passenger[0]->ArrivalTime;	
					$post->booking_status = (string)$issueticket->Passenger[0]->BookingStatus;
					$post->class_code = (string)$issueticket->Passenger[0]->ClassCode;
					$post->currency = (string)$issueticket->Passenger[0]->Currency;
					$post->reporting_time = (string)$issueticket->Passenger[0]->ReportingTime;
					$post->free_baggage = (string)$issueticket->Passenger[0]->FreeBaggage;
				}
	
				// Was the blog post created?
				if(!$post->save())
				{
					// Redirect to the new blog post page
					return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
				}

				if(ApplicationSetting::first()->value == 0 )
				{
					$i = 1;
					foreach($issueticket->Passenger as $passenger) 
						{
							if (is_null($post = DomesticPassengerDetails::where('pnr_no', (string)$passenger->PnrNo)->where('passenger_no', $i)->first())) {
								// Redirect to the blogs management page
								return Redirect::back()->with('error', "Couldn't find the selected Booking.");
							}

							// Update the blog post data
							$post->user_id = Sentry::getUser()->id;
							$post->pnr_no = (string)$passenger->PnrNo;
							$post->ticket_no = (int)$passenger->TicketNo;
							$post->gender = (string)$passenger->Gender;
							$post->title = (string)$passenger->Title;
							$post->first_name = (string)$passenger->FirstName;
							$post->last_name = (string)$passenger->LastName;
							$post->nationality = (string)$passenger->Nationality;
							$post->pax_type = (string)$passenger->PaxType;	
							$post->fare = (int)$passenger->Fare;
							$post->surcharge = (int)$passenger->Surcharge;
							$post->tax = (int)$passenger->Tax;
							$post->pax_remarks = (string)$passenger->PaxRemarks;

							// Was the blog post created?
							if(!$post->save())
							{
								// Redirect to the new blog post page
								return Redirect::to("home")->with('error', "Passenger Data coud not be saved to the system.");
							}
							$i++;
						}

				}

				// /Issue Ticket*/


				if(ApplicationSetting::first()->value == 1 ) {
         		$offline_processing = true;
         		return View::make($slug. '.issueticket', compact('offline_processing'));	
         		}
        
				// Redirect to the new blog post page
				return View::make($slug. '.issueticket', compact('issueticket'));		
          
            } else {
            	return Redirect::back()->with('error', 'Insufficient Credit Balance');

            }       	
        } elseif ($payment_options == 'paypal') {
	        $user = Sentry::getUser();
	        $_GET['sandbox'] = 1;

	       //require_once('paypal/library.php'); // include the library file
			define('EMAIL_ADD', 'sameernyaupane@outlook.com'); // define any notification email
			define('PAYPAL_EMAIL_ADD', 'nyaupane5-facilitator@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
			require_once(app_path().'/includes/paypal_class.php');

			$p 				= new paypal_class(); // paypal class
			$p->admin_mail 	= EMAIL_ADD; // set notification email

			//mysql_query("INSERT INTO `purchases` (`invoice`, `product_id`, `product_name`, `product_quantity`, `product_amount`, `payer_fname`, `payer_lname`, `payer_address`, `payer_city`, `payer_state`, `payer_zip`, `payer_country`, `payer_email`, `payment_status`, `posted_date`) VALUES ('".$_POST["invoice"]."', '".$_POST["product_id"]."', '".$_POST["product_name"]."', '".$_POST["product_quantity"]."', '".$_POST["product_amount"]."', '".$_POST["payer_fname"]."', '".$_POST["payer_lname"]."', '".$_POST["payer_address"]."', '".$_POST["payer_city"]."', '".$_POST["payer_state"]."', '".$_POST["payer_zip"]."', '".$_POST["payer_country"]."', '".$_POST["payer_email"]."', 'pending', NOW())");
			
			$this_script = route('paypal-redirect');
			
			$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
			$p->add_field('cmd', '_cart'); // cmd should be _cart for cart checkout
			$p->add_field('upload', '1');
			$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over
			$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
			$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
			$p->add_field('currency_code', 'USD');
			$p->add_field('invoice', Session::get('invoice_no'));
			$p->add_field('item_name_1', 'Flight Payment');
			$p->add_field('item_number_1', $flightid);
			$p->add_field('quantity_1', $adults+$children);
			$p->add_field('amount_1', $total);
			$p->add_field('first_name', $user->first_name);
			$p->add_field('last_name', $user->last_name);
			$p->add_field('address1', 'Address');
			$p->add_field('city', 'Kathmandu');
			$p->add_field('state', 'NRS');
			$p->add_field('country', 'Nepal');
			$p->add_field('zip', '12345');
			$p->add_field('email', $user->email);
			$p->submit_paypal_post(); // POST it to paypal    

			exit();
        } elseif ($payment_options == 'sctnpay') {

           define("MERCHANT_ID","147");
             //define("MERCHANT_USER_NAME","black_ejourneys_uat_user");
            // define("MERCHANT_PASSWORD","blackejourneys@31-api");
          // define("SIGNATURE_PASSCODE","BEJUAT01");
           define("MERCHANT_USER_NAME","socheko_uat");
            define("MERCHANT_PASSWORD","socheko@uat-api");
           define("SIGNATURE_PASSCODE","SOUAT01");
            define("NPAY_SOAP_URL","https://gateway.sandbox.npay.com.np/websrv/Service.asmx?WSDL");
            define("NPAY_GATEWAY_URL","https://gateway.sandbox.npay.com.np/pay.aspx");
# Define other variables
            $transaction_id = '11240120978';
            $strAmount = '100';
            $description = "Test transaction Transaction ID: " . $transaction_id . " || Amount: " . $strAmount;

            # Hash password with SHA256. Combination = MERCHANT_USER_NAME + MERCHANT_PASSWORD
            $sha256Pwd = hash ("sha256", MERCHANT_USER_NAME . MERCHANT_PASSWORD);
           // var_dump($sha256Pwd); die();

            # Hash signature with SHA256. Combination = SIGNATURE_PASSCODE + MERCHANT_USER_NAME + transaction_id
            $signature = hash("sha256", SIGNATURE_PASSCODE . MERCHANT_USER_NAME . $transaction_id);
            //var_dump($signature);die();
            # Initialize webservice with WSDL
            $client = new SoapClient(NPAY_SOAP_URL);
			//var_dump($client); die();
            # Set your parameters for the request
            $params = array(
              "MerchantId" => MERCHANT_ID,
              "MerchantTxnId" => $transaction_id,
              "MerchantUserName" => MERCHANT_USER_NAME,
              "MerchantPassword" => $sha256Pwd,
              "Signature" => $signature,
              "AMOUNT" => $strAmount,
              "purchaseDescription" => $description,
            );

             $response = $client->__soapCall("ValidateMerchant", array($params));
         //  var_dump($response); die();

             if($response->ValidateMerchantResult->STATUS_CODE != "0")
            {
                $STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
                # Error occured while validating merchant. End process.
                die("Error on validating merchant. <br> Error Code: " . $STATUS_CODE . " <br>MESSAGE: " . $response->ValidateMerchantResult->MESSAGE);
            }

              $STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
            $PROCESS_ID = $response->ValidateMerchantResult->PROCESSID;

             

            $data = [
                'url' => NPAY_GATEWAY_URL,
                'process_id' => $PROCESS_ID,
                'merchant_id' => MERCHANT_ID,
                'transaction_id' => $transaction_id,
                'amount' => $strAmount,
                'username' => MERCHANT_USER_NAME,
                'description' => $description
            ];
            //var_dump($data); die();

        
      return View::make('frontend.sctnpay')->with('data', $data);   

        }elseif ($payment_options == 'bank_transfer') {

         	$entries = MyBankAccount::all();

         	if(ApplicationSetting::first()->value == 1 ) {
         		$offline_processing = true;
				return View::make($slug. '.issueticket', compact('entries', 'offline_processing'));		
         	}
         
         	return View::make($slug. '.issueticket', compact('entries'));	
        } else {
        	return Redirect::back()->with('error', 'Please select a payment option to continue.');
        }

		//return View::make($slug. '.reservation', compact('error'));
                            
    }

       
}
