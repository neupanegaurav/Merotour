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
                <style type="text/css">
                    .flight_info > div { display:inline-block; vertical-align: top; margin-right: 12px; margin-top: 12px; }
                    .flight_info div p { width: 120px; margin:auto; }
                    .flight_details div { display:inline-block; margin:12px; margin-right:24px; height: 22px; }
                    #details { padding:0px; margin:0px; }
                    #details td { background: #ffffff; border-left: none; }
                    #details td div { margin:0px; }
                    .flight_header div { display: inline-block; margin-bottom: 12px; }
                </style>






                    <?php 
    /*  echo var_dump($results);
    exit() */?>

    @if(isset($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary))
        @if ($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary->count() >= 1)
            @foreach($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary as $option )

                <?php 
                    /*$origin = Session::get('origin');
                    $destination = Session::get('destination');

                    $curr_origin = (string) $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->DepartureAirport->attributes()->LocationCode;
                    $curr_destination = (string) $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->ArrivalAirport->attributes()->LocationCode;

                    if($curr_origin != $origin  or $curr_destination != $destination) {
                        continue;
                    }*/
                ?>

                <div style="border:1px solid #adadad; margin-bottom:12px; box-shadow: 0 0 8px 1px rgba(173,173,173,0.5); padding:8px;">
                            
                        @foreach($option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment as $flight_segment )
                            <div class="flight_info">
                                <div>
                                    <div style="display:block; width:120px; height:auto;">
                                        <?php $airline = FlightAirlines::where('airlines_shortcode', $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->TPA_Extensions->ValidatingCarrier->attributes()->Code)->first();  ?>
                                        @if(isset($airline->airlines_logo))
                                            <img style="width:88px; height:auto;" src="{{ asset('assets/img/airlines/' . $airline->airlines_logo) }}">
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>

                                    @if (isset($airline->airlines_name)) 
                                            <div>
                                                {{ $airline->airlines_name }}
                                            </div>
                                    @endif                                                                                  
                                </div>

                                <div>
                                    {{ $flight_segment->DepartureAirport->attributes()->LocationCode }} 
                                    <br>
                                    {{ $flight_segment->attributes()->DepartureDateTime }}

                                </div>

                                <div>
                                    →
                                </div>

                                <div>
                                    {{ $flight_segment->ArrivalAirport->attributes()->LocationCode }} 
                                    <br>
                                    {{ $flight_segment->attributes()->ArrivalDateTime }}                            
                                </div>

                                <div>
                                    Class: {{ $flight_segment->attributes()->ResBookDesigCode }} <br>
                                </div>

                                <div>
                                    Price: 
                                    {{ $option->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount }} 
                                    <br>
                                </div>

                               </div>

                            <br clear="all">
                        @endforeach

                        <div>
                            <button class="btn btn-success pull-right">Book Now</button>
                        </div>

                        <br clear="all">


                        <div class="flight_header">
                            <div class="btn btn-small btn-info flight_details ">Flight Details</div>
                            <div class="btn btn-small btn-info fare_details">Fare Details</div>
                            <div class="btn btn-small btn-info baggage_information">Baggage Information</div>
                            <div class="btn btn-small btn-info flight_amenities" >Flight Amenities</div>
                        </div>
                        <div class="flight_content">
                            <div class="flight_details_content" style="display:none;"> 
                                <div style="border: 1px solid #dddddd; background:#ffffff;">
                                    <div style="width:180px; height:auto;">
                                        <?php $airline = FlightAirlines::where('airlines_shortcode', $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->TPA_Extensions->ValidatingCarrier->attributes()->Code)->first();  ?>
                                        @if(isset($airline->airlines_logo))
                                            <img style="width:120px; height:auto;" src="{{ asset('assets/img/airlines/' . $airline->airlines_logo) }}">
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>

                                    <table id="details" class="table">
                                        <thead>
                                            <tr>                                            
                                                    @if (isset($airline->airlines_name)) 
                                                        <td colspan="2" >
                                                            <div style="height:40px; width:120px;">
                                                                {{ $airline->airlines_name }}
                                                            </div>
                                                        </td>
                                                    @endif                                                                                  
                                            </tr>
                                            <tr>
                                                <td style="border-right:1px solid #dddddd;">
                                                    Flight Code
                                                </td>
                                                <td> 
                                                    {{ $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->TPA_Extensions->ValidatingCarrier->attributes()->Code }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid #dddddd;">
                                                    Flight No
                                                </td>
                                                <td>
                                                    {{ $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->attributes()->{'FlightNumber'} }}
                                                </td>
                                            </tr>                                                                           
                                        </thead>
                                    </table>

                                </div>
                            </div>

                            <div class="fare_details_content" style="display:none; border:1px solid #dddddd; padding:12px; margin:12px;" >
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Type</th>
                                        <th>Passengers</th>
                                        <th>Base Fare</th>
                                        <th>Taxes</th>
                                        <th>Total</th>
                                    </thead>                                
                                    <tbody>
                                        <td>Adult(s)</td>
                                        <td> 1 </td>
                                        <td>{{ $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->BaseFare->attributes()->Amount }} </td>
                                        <td>
                                            <?php $taxes = 0; ?>
                                            @foreach($option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->Taxes->Tax as $tax)
                                                <?php $taxes += (int)$tax->attributes()->Amount; ?>
                                            @endforeach 
                                            {{ $taxes }}
                                        </td>
                                        <td>{{ $option->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount }} </td>
                                    </tbody>
                                </table>
                                <h3>Fare Rules:</h3>
                                <h4> Cancellation Fee </h4>
                                <p>                             
                                    
                                    Airline Fee* - NPR 5,130 per passenger, for cancellations done before the departure of the first flight.
                                    Blackeye Travels Fee - NPR 814 per passenger.
                                    Partly utilized tickets cannot be cancelled.
                                </p>

                                <h4>Change Fee</h4>     
                                <p>                                     
                                    Airline Fee* - NPR 4,275 per passenger + fare difference (if applicable).
                                    Blackeye Travels Fee - NPR 814 per passenger.
                                     
                                    *Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
                                    The airline fee is indicative based on an automated interpretation of airline fare rules. Blackeye Travels doesn't guarantee the accuracy of this information. 
                                    The change/cancellation fee may also vary based on fluctuations in currency conversion rates. For exact cancellation/change fee, please call us at our customer care number.
                                </p>                                                        
                            </div>  
                        </div>
                    
                    </div>      
            @endforeach
        @else
        Empty result.
        @endif
    @else
    No results found.
    @endif



            </div>
        	<!-- END TABLE BODY -->
		</div> 
        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         
@stop



@section('currentpagejs')

<script>
  $(document).ready(function(){
    $('.flight_details').click(function() {
            $(this).parent().next('div').children('.fare_details_content').slideUp('fast');
        $(this).parent().next('div').children('.flight_details_content').slideToggle('fast');        
    });

    $('.fare_details').click(function() {
            $(this).parent().next('div').children('.flight_details_content').slideUp('fast');
        $(this).parent().next('div').children('.fare_details_content').slideToggle('fast');
    });
  });
</script>


@stop
