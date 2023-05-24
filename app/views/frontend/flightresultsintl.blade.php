@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Page content --}}
@section('content')

<style type="text/css">
	.flight_info > div { display:inline-block; vertical-align: top; margin-right: 12px; margin-top: 12px; }
	.flight_info div p { width: 120px; margin:auto; }
	.flight_details div { display:inline-block; margin:12px; margin-right:24px; height: 22px; }
	#details { padding:0px; margin:0px; }
	#details td { background: #ffffff; border-left: none; }
	#details td div { margin:0px; }
	.flight_header div { display: inline-block; margin-bottom: 12px; }
</style>

<h3>International Flight Search Results</h3>

 @if(!is_null($trip_type))

                    <div style="border:1px solid #dddddd; border-radius: 4px;">
                        <div style="border-bottom:1px solid #dddddd; padding:4px;">
                            @if($trip_type == 'O')
                                One Way 
                            @elseif( $trip_type == 'R')
                                Round Trip
                            @endif

                            : {{ $origin }} - {{ $destination }}

                            <div class="pull-right">
                                <div id="modify-toggle" class="btn btn-info"> Modify Search </div>
                            </div>
                            <br clear="all">
                        </div>

                        </div>
                        @endif


	@if(isset($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary))		
		
		@if ($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary->count() >=1)
			@foreach($results->Body->OTA_AirLowFareSearchRS->PricedItineraries->PricedItinerary as $option)
		

			<form method="post" action="{{ URL::to('reservation')}}" >
			
			<!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                            <input type="hidden" name="flight_no" value="{{ $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->attributes()->{'FlightNumber'} }}" />
                                             <input type="hidden" name="flightid" value="{{ $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->attributes()->{'FlightNumber'} }}" /> 
                                             <input type="hidden" name="adults" value="{{ $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerTypeQuantity->attributes()->Quantity }}" /> 
                                              <input type="hidden" name="origin" value="{{ $origin }}" />
                                              <input type="hidden" name="destination" value="{{ $destination }}" /> 
                                              <input type="hidden" name="flightint" value="flightint" />   
                                             




				<div style="border:1px solid #adadad; margin-bottom:12px; box-shadow: 0 0 8px 1px rgba(173,173,173,0.5); padding:8px;">
							
						@foreach($option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment as $flight_segment )
							
							@endforeach
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

									<input type="hidden" name="airline" value="{{ $airline->airlines_name}}" /> 
									<input type="hidden" name="airline_hub" value="{{ $airline->airlines_hub}}" /> 
									<input type="hidden" name="airlines_shortcode" value="{{ $airline->airlines_shortcode}}" />
									<input type="hidden" name="adult_fare" value="{{ $option->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount}}" />  
									<input type="hidden" name="class_code" value="{{ $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->attributes()->ResBookDesigCode}}" />

									@if (isset($airline->airlines_name)) 
											<div>
												{{ $airline->airlines_name }}


											</div>
									@endif																					
								</div>

								<div>
									{{ $origin }}	
									<br>									
									{{ $flight_segment->attributes()->DepartureDateTime }}
									<br>								

								</div>

								<div>
									→
								</div>

								<div>

									{{ $destination }}
									<br>
									{{ $flight_segment->attributes()->ArrivalDateTime }}
								</div>

								<!--

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
								-->
								<div style="float:right;">
								<div style=" color:#0000FF;">
									Price(NPR.): 
									{{ $option->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount }} 
								</div>
								
								<div>									
									All Incl. per adult
								</div>
								<br>
								</div>
								<br clear="all">
						
								
							</div>


							

						<div>
							  
							<button name="search" class="btn btn-success pull-right">Book Now</button>
							
						</div>
						</form>

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
								<div class="flight_info">
									@foreach($option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment as $flight_segment )

								
									<div style="width:180px; height:auto;">
										<?php $airline = FlightAirlines::where('airlines_shortcode', $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->TPA_Extensions->ValidatingCarrier->attributes()->Code)->first();  ?>
										@if(isset($airline->airlines_logo))
											<img style="width:120px; height:auto;" src="{{ asset('assets/img/airlines/' . $airline->airlines_logo) }}">
										<br>
										{{ $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerFare->TPA_Extensions->ValidatingCarrier->attributes()->Code }}
										-
										{{ $option->AirItinerary->OriginDestinationOptions->OriginDestinationOption->FlightSegment->attributes()->{'FlightNumber'} }}
										<br>

										Class: {{ $flight_segment->attributes()->ResBookDesigCode }} <br>

										@else
											&nbsp;
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

								<?php
								 $date1=$flight_segment->attributes()->DepartureDateTime;
								 $date2=$flight_segment->attributes()->ArrivalDateTime;

								


								
								 // $dteDiff  = date_diff($date1, $date2); 

							//$daysForExtraCoding = diffInHours($date1, $date2);

								  // echo $dteDiff->format("%H:%I:%S"); 

  								 ?>
  								 
								<hr>

								@endforeach

								</div>
									
									
								<!--
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
									-->

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
										<td>{{ $option->AirItineraryPricingInfo->PTC_FareInfo->PTC_FareBreakdown->PassengerTypeQuantity->attributes()->Quantity }}</option></option></td>
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

@stop

@section('customjs')

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