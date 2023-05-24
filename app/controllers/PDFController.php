<?php

class PDFController extends BaseController {

	public function Post()
	{  
        $id = Input::get('id');

        if(is_null($entry = BookedDomesticTickets::find($id)))
        {
            return Redirect::back()->with('error', 'Could not find the entry.');
        }

        if (Session::get('account_type') == 'agent') {
            $user = Sentry::getUser();
            $logo_name = $user->logo;
            $logo = asset("assets/img/uploads/agents/". $logo_name);

            if(!empty($user->company_name)) {
                $issuing_agent = $user->company_name;
            } else {
                $issuing_agent = 'Default Company Name';
            }

        } else {
            $logo_name = ApplicationSetting::find(6)->image;
            $logo = asset("assets/frontend/images/". $logo_name);
            $issuing_agent = 'Black Eye Journeys Pvt Ltd';  
        }

        $passengers = null;

        $passengers_data = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no)->get();
        
        foreach ($passengers_data as $passenger) { 
            $passengers .='<tr>
                                <td style="padding: 2px 10px;">
                                    '.$passenger->first_name.' 
                                </td>
                                <td style="padding: 2px 10px;">
                                    '.$passenger->ticket_no.'
                                </td>
                                <td style="padding: 2px 10px;">
                                    -
                                </td>
                            </tr>
                            ';
        }
        $fares = null;
        $total = 0;
        foreach ($passengers_data as $passenger) { 
            $fares .= '
                <tr>
                    <td colspan="5" style="text-align: center;">
                        <strong>'.$passenger->first_name.'</strong>
                    </td>                  
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Base Fare:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        '.$passenger->fare.'
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Fuel Surcharge:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        '.$passenger->surcharge.'    
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Tax:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        '.$passenger->tax.'
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center;">
                       <hr>
                    </td>                  
                </tr>
            ';

            $total += $passenger->fare + $passenger->surcharge + $passenger->tax ;
        }

		$pdf = PDF::loadHTML('
    	<div style="width: 720px; margin: 0px auto; font-family: Tahoma; font-size: 13px;
        background-color: 10px; padding: 10px; page-break-after: always">
        
        
        <div class="agentBrandingLogo">
            <img src="'. $logo .'" style="width:120px; height:auto;" alt="Logo " id="agentLogo">
        </div>
                
        <br>
        <center>
            <strong>ELECTRONIC TICKET</strong>
            <br>
            Passenger Itinerary/Receipt<br>
            Customer Copy
        </center>
        <br>
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Issuing Agent:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        '. $issuing_agent .'
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Issued Date:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        '.$entry->issue_date.'
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Issuing Airline:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        '.$entry->airline.'
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>PNR No:</strong>
                    </td>
                    <td colspan="1" style="padding: 2px 10px; background-color: #ccc;">
                        '.$entry->pnr_no.'
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Tour Code:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Operating Airline:</strong>
                    </td>
                    <td colspan="1" style="padding: 2px 10px;">
                        
                    </td>
                    <td style="padding: 2px 10px;">
                        &nbsp;
                    </td>
                    <td style="padding: 2px 10px;">
                        &nbsp;
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="border-bottom: 0.5px solid #000; border-right: 5px solid #fff;">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Passenger Name:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Ticket No:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Frequent Flyer No:</strong>
                    </td>
                </tr>
            </thead>
            <tbody>
                
                '.$passengers.'
                
            </tbody>
        </table>
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Day</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Date</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            &nbsp;</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            City/Terminal/<br>
                            Stopover City</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Time</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            Flight/Class/<br>
                            Status</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            Stop/<br>
                            Flying Time</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Fare Basis</strong>
                    </th>
                </tr>
            </thead>
            
            <tbody style="padding: 10px;">
                <tr>
                    <td style="padding-top: 20px;">
                        Saturday
                    </td>
                    <td style="padding-top: 20px; width:76px;">
                        07 Jun 2014
                    </td>
                    <td style="padding-top: 20px;">
                        DEP
                    </td>
                    <td style="padding-top: 20px;">
                        '.$entry->departure.'<br>
                        
                    </td>
                    <td style="padding-top: 20px;">
                        16:00:00
                    </td>
                    <td style="padding-top: 20px;">
                        YT-573/Y         /Confirmed
                    </td>
                    <td style="padding-top: 20px;">
                        Non-Stop/0:0<br>
                    </td>
                    <td style="padding-top: 20px;">
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Saturday
                    </td>
                    <td>
                        07 Jun 2014
                    </td>
                    <td>
                        ARR
                    </td>
                    <td>
                        '.$entry->arrival.'<br>
                        
                    </td>
                    <td>
                        16:30:00
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <br>
                        <strong>
                            Yeti Airlines
                            Ref:&nbsp;</strong>A0QITC
                    </td>
                    <td>
                        <br>
                        <strong>NVB:&nbsp;
                        </strong>
                    </td>
                    <td>
                        <br>
                        <strong>NVA:&nbsp;
                        </strong>
                    </td>
                    <td>
                        <br>
                        <strong>Baggage:&nbsp;</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <strong></strong>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="3" style="padding-top: 30px;">
                        <strong>Form of Payment:</strong>
                    </td>
                    <td colspan="5" style="padding-top: 30px;">
                        Cash (NPR)
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>Fare BreakDown </strong>
                    </td>
                    <td colspan="5">
                    </td>
                </tr>
            </tbody>
            <tbody style="background-color: #eaeaea;">
                '.$fares.'
                 <tr>
                    <td colspan="3" style="background-color: #ccc; text-align: right;">
                        <strong>Total:&nbsp;</strong>
                    </td>
                    <td colspan="2" style="background-color: #ccc;">
                        '.$total.'
                    </td>
                </tr>
            </tbody>
            <tbody>  
            <tr>
                <td colspan="8" style="padding-top: 20px;">
                    <strong>IATA Ticket Notice:</strong> <a href="http://www.iatatravelcentre.com/e-ticket-notice/General/English/">http://www.iatatravelcentre.com/e-ticket-notice/General/English/</a><br>
                    (Subject to change without prior notice)
                </td>
            </tr>
            <tr>
                <td colspan="8" style="padding-top: 20px; text-align: right;">
                    Powered by <a href="http://www.blackeye.com/" target="_blank" id="poweredByLogo">
                    Blackeye Travels</a>
                </td>
            </tr>
            </tbody>
            
            </table>
        </div>
			');
		return $pdf->download('FlightInvoice_'.$entry->pnr_no.'.pdf');
	}

    public function Order()
    {
        $issue_date             = Input::get('issue_date');
        $customer_name          = Input::get('customer_name');
        $invoice_no             = Input::get('invoice_no');
        $email                  = Input::get('email');
        $package_type           = Input::get('package_type');
        $package_name           = Input::get('package_name');
        $group_size             = Input::get('group_size');
        $date                   = Input::get('date');
        $base_price             = Input::get('base_price');

        if (Session::get('account_type') == 'agent') {
            $user = Sentry::getUser();
            $logo_name = $user->logo;
            $logo = asset("assets/img/uploads/agents/". $logo_name);

            if(!empty($user->company_name)) {
                $issuing_agent = $user->company_name;
            } else {
                $issuing_agent = 'Default Company Name';
            }

        } else {
            $logo_name = ApplicationSetting::find(6)->image;
            $logo = asset("assets/frontend/images/". $logo_name);
            $issuing_agent = 'Black Eye Journeys Pvt Ltd';  
        } 

        $pdf = PDF::loadHTML('
        <div style="width: 720px; margin: 0px auto; font-family: Tahoma; font-size: 13px;
        background-color: 10px; padding: 10px; page-break-after: always">

        <div class="agentBrandingLogo">
            <img src="'. $logo .'" style="width:120px; height:auto;" alt="Logo " id="agentLogo">
        </div>
        <br>
        <center>
            <strong>ORDER INVOICE</strong>
            <br>
            Customer Copy
        </center>
        <br>
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Issuing Agent:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        '. $issuing_agent .'
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Issued Date:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        '.$issue_date.'
                    </td>
                   
                </tr>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Invoice No:</strong>
                    </td>
                    <td colspan="1" style="padding: 2px 10px; background-color: #ccc;">
                        #INV '.$invoice_no.'
                    </td>
                   
                    <td style="padding: 2px 10px; width:340px;">
                        &nbsp;
                    </td>
                </tr>
              
            </tbody>
        </table>
        <hr style="border-bottom: 0.5px solid #000; border-right: 5px solid #fff;">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <td style="padding: 2px 10px;">
                        <strong>Customer Name:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Email:</strong>
                    </td>
                    <td style="padding: 2px 10px;">
                        <strong>Phone:</strong>
                    </td>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td style="padding: 2px 10px;">
                      '.$customer_name.' 
             
                    </td>
                    <td style="padding: 2px 10px;">
                         '.$email.'
                    </td>
                    <td style="padding: 2px 10px;">
                        -
                    </td>
                </tr>
                
            </tbody>
        </table>
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Package Type</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Package Name</strong>
                    </th>
               
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            
                            </strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Group Size</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            Date</strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            </strong>
                    </th>
                    <th style="border-bottom: 2px solid #000; border-right: 5px solid #fff;">
                        <strong>
                            <br>
                            <br>
                            Base Price</strong>
                    </th>
                </tr>
            </thead>
            
            <tbody style="padding: 10px;">
                <tr>
                    <td style="padding-top: 20px; padding-left:30px; width:160px;">
                        '.$package_type.'
                    </td>
                    <td style="padding-top: 20px; width:76px;">
                        '.$package_name.'
                    </td>
                    <td style="padding-top: 20px; width:10px;">
                        
                    </td>
                    <td style="padding-top: 20px; padding-left:40px; ">
                        '.$group_size.'<br>
                        
                    </td>
                    <td style="padding-top: 20px; padding-left:40px;">
                        '.$date.'
                    </td>
                    <td style="padding-top: 20px;">
                    </td>
                    <td style="padding-top: 20px; padding-left:20px;">
                        '.$base_price.'<br>
                    </td>
                    <td style="padding-top: 20px;">
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <strong></strong>
                    </td>
                </tr>
               
                
                <tr>
                    <td colspan="8">
                        <strong></strong>
                    </td>
                </tr>
            </tbody>
            

            <tbody>
                <tr>
                    <td colspan="3" style="padding-top: 30px;">
                        <strong>Form of Payment:</strong>
                    </td>
                    <td colspan="5" style="padding-top: 30px;">
                        Cash (NPR)
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>Fare BreakDown </strong>
                    </td>
                    <td colspan="5">
                    </td>
                </tr>
            </tbody>
            <tbody style="background-color: #eaeaea;">
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Base Price:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        '.$base_price.'
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Taxes/Fees/Charges:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        0
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <strong>Service Tax:&nbsp;</strong>
                    </td>
                    <td colspan="2">
                        0
                    </td>
                </tr>
             
                <tr>
                    <td colspan="3" style="background-color: #ccc; text-align: right;">
                        <strong>Total:&nbsp;</strong>
                    </td>
                    <td colspan="2" style="background-color: #ccc;">
                        '.$base_price.'
                    </td>
                </tr>
            </tbody>
            <tbody>
            <tr>
                <td colspan="8" style="padding-top: 20px; text-align: right;">
                    Powered by <a href="http://www.blackeyetravels.com/" target="_blank" id="poweredByLogo">
                    Blackeye Travels</a>
                </td>
            </tr>
            </tbody>
            
        </table>
    </div>');
        return $pdf->download('OrderInvoice_'.$invoice_no.'.pdf');

    }

}