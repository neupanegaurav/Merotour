@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Flight Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Flight Search
	                <span class="icon-angle-right"></span>
	            </li>                       		                                           
			</ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box" style="display:inline-block; width:1109px;">
   
            <!-- BEGIN TABLE BODY -->
            <div class="body">
           
                <!-- BEGIN TABLE DATA -->

                <div class="top" style="padding:10px;">
                                    
                                    <h3>Flight Search Results</h3>
                                    
                                </div><!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">

                                    @if(isset($error)) 

                                    {{ $error }}

                                    @elseif(isset($offline_processing))

                                    Ticket Issued Successfully. Please wait for confimation in your email soon.

                                    @elseif(isset($entries))

                                    Congratulations. Your ticket has been issued. Please make a payment to one of the following bank accounts:

                                    <table class="table table-bordered table-striped table-hover" style="margin-top:12px;">
                                                            <thead>
                                                                <tr>
                                                                                
                                                                    <th class="span2">SN</th>
                                                                    <th class="span2">Bank</th>
                                                                    <th class="span2">Branch</th>
                                                                    
                                                                    <th class="span2">Account Name</th>
                                                                    <th class="span2">Account Number</th>   
                                                                    <th class="span2">Swift Code</th>
                                                                    <th class="span2">Company Name</th>                 
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($entries as $entry)
                                                                
                                                                <tr>

                                                                    <td>{{$entry->id}}</td>
                                                                    <td>{{$entry->bank}}</td> 
                                                                    <td>{{$entry->branch}}</td>
                                                                    <td>{{$entry->account_name}}</td>
                                                                    <td>{{$entry->account_number}}</td>
                                                                    <td>{{$entry->swift_code}}</td>
                                                                    <td>{{$entry->company_name}}</td>                                         
                                                                </tr>

                                                            @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                    
                                    @else

                                    <h4 style="margin:10px;">Ticket Issued Successfully.</h4>


                                    <table class="table table-bordered table-striped table-hover" style="width:570px;">
                                        <thead>
                                            <tr>
                                            <th colspan="2">Your Ticket Details 
                                                <div class="pull-right">

                                                <form action="{{ route('pdf-generator')}}" method="post" target="_blank" >
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    
                                    <input type="hidden" name="issue_date" value="{{$issueticket->Passenger->IssueDate}}" >
                                    <input type="hidden" name="airline" value="{{$issueticket->Passenger->Airline}}" >
                                    <input type="hidden" name="departure" value="{{$issueticket->Passenger->Departure}}" >
                                    <input type="hidden" name="arrival" value="{{$issueticket->Passenger->Arrival}}" >
                                    <input type="hidden" name="fare" value="{{$issueticket->Passenger->Fare}}" >
                                    <input type="hidden" name="surcharge" value="{{$issueticket->Passenger->Surcharge}}" >
                                    <input type="hidden" name="tax" value="{{$issueticket->Passenger->Tax}}" >

                                    <input type="hidden" name="p_count" value="{{count($issueticket->Passenger)}}">
                                        <?php $count = 1; ?>
                                        @foreach($issueticket->Passenger as $passenger)

                                    <input type="hidden" name="p_{{$count}}_name" value="{{$issueticket->Passenger->FirstName}}" >
                                    <input type="hidden" name="p_{{$count}}_ticket_no" value="{{$issueticket->Passenger->TicketNo}}" >

                                        <?php $count++; ?>
                                        
                                        @endforeach

                                                        <button type="submit">Download PDF</button>
                                          </form>          
                                                </div>
                                            </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Airline</th><td>{{$issueticket->Passenger->Airline}}</td>
                                            </tr>

                                            <tr>
                                                <th>Flight No.</th><td>{{$issueticket->Passenger->FlightNo}}</td>
                                            </tr>

                                            <tr>
                                                <th>Departure</th><td>{{$issueticket->Passenger->Departure}}</td>
                                            </tr>

                                            <tr>
                                                <th>Arrival</th><td>{{$issueticket->Passenger->Arrival}}</td>
                                            </tr>

                                            <tr>
                                                <th>PNR No.</th><td>{{$issueticket->Passenger->PnrNo}}</td>
                                            </tr>

                                             <tr>
                                                <th>Ticket No.</th><td>{{$issueticket->Passenger->TicketNo}}</td>
                                            </tr>

                                            <tr>
                                                <th>Gender</th><td>{{$issueticket->Passenger->Gender}}</td>
                                            </tr>

                                            <tr>
                                                <th>Name</th><td>{{$issueticket->Passenger->FirstName}}</td>
                                            </tr>

                                            

                                            <tr>
                                                <th>Passenger Type</th><td>{{$issueticket->Passenger->PaxType}}</td>
                                            </tr>

                                            <tr>
                                                <th>Nationality</th><td>{{$issueticket->Passenger->Nationality}}</td>
                                            </tr>

                                            <tr>
                                                <th>Issue Date</th><td>{{$issueticket->Passenger->IssueDate}}</td>
                                            </tr>

                                            <tr>
                                                <th>Flight Date</th><td>{{$issueticket->Passenger->FlightDate}}</td>
                                            </tr>

                                             <tr>
                                                <th>Flight Time</th><td>{{$issueticket->Passenger->FlightTime}}</td>
                                            </tr>

                                             <tr>
                                                <th>Booking Status</th><td>{{$issueticket->Passenger->BookingStatus}}</td>
                                            </tr>

                                             <tr>
                                                <th>Class Code</th><td>{{$issueticket->Passenger->ClassCode}}</td>
                                            </tr>

                                             <tr>
                                                <th>Currency</th><td>{{$issueticket->Passenger->Currency}}</td>
                                            </tr>

                                             <tr>
                                                <th>Fare</th><td>{{$issueticket->Passenger->Fare}}</td>
                                            </tr>

                                             <tr>
                                                <th>Surcharge</th><td>{{$issueticket->Passenger->Surcharge}}</td>
                                            </tr>

                                            <tr>
                                                <th>Tax</th><td>{{$issueticket->Passenger->Tax}}</td>
                                            </tr>

                                            <tr>
                                                <th>Reporting Time</th><td>{{$issueticket->Passenger->ReportingTime}}</td>
                                            </tr>

                                            <tr>
                                                <th>Free Baggage</th><td>{{$issueticket->Passenger->FreeBaggage}}</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    @foreach($issueticket->Passenger as $passenger)
                                 
                                        <table class="table table-bordered table-striped table-hover" style="width:570px;">
                                            <thead>
                                                <tr>
                                                <th colspan="2">Passenger Details </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <th>Ticket No.</th><td>{{$passenger->TicketNo}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Gender</th><td>{{$passenger->Gender}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Name</th><td>{{$passenger->FirstName}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Passenger Type</th><td>{{$passenger->PaxType}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Nationality</th><td>{{$passenger->Nationality}}</td>
                                                </tr>

                                                 <tr>
                                                    <th>Booking Status</th><td>{{$passenger->BookingStatus}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Class Code</th><td>{{$passenger->ClassCode}}</td>
                                                </tr>

                                                 <tr>
                                                    <th>Currency</th><td>{{$passenger->Currency}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Fare</th><td>{{$passenger->Fare}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Surcharge</th><td>{{$passenger->Surcharge}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Tax</th><td>{{$passenger->Tax}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Reporting Time</th><td>{{$passenger->ReportingTime}}</td>
                                                </tr>

                                                <tr>
                                                    <th>Free Baggage</th><td>{{$passenger->FreeBaggage}}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    @endforeach

                                    @endif
                                </div> <!-- /Bottom -->

        		<!-- END TABLE DATA -->
        	</div> <!-- END TABLE BODY -->
        </div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop


@section('currentpagejs')

 <script type="text/javascript">
     $(document).ready(function() {

        //For Reservation form
    $( "#datepicker" ).datepicker({       
          dateFormat: "dd-mm-yy"
        });
    $( "#clender" ).datepicker({       
          dateFormat: "dd-mm-yy"
        }); 

        $("#domestic").on('click', function() {
    
            $("#h4").text('Domestic Flight Search');
            
            $(".sectorFromIntl").hide();
            $("#sectorFrom").show();

            $(".sectorToIntl").hide();
            $("#sectorTo").show();

            $(".flight_date_intl").hide();
            $(".flight_date").show();

            $(".return_date_intl").hide();
            $(".return_date").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearch')}}" );  
    
        });
            
    
        $("#international").on('click', function() {
    
            $("#h4").text('International Flight Search');

            $("#sectorFrom").hide();
            $(".sectorFromIntl").show();

            $("#sectorTo").hide();
            $(".sectorToIntl").show();

            $(".flight_date").hide();
            $(".flight_date_intl").show();

            $(".return_date").hide();
            $(".return_date_intl").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearchintl')}}" );

    
        }); 


    }); //Onload


</script>

@stop
