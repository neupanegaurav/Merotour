@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Page content --}}
@section('content')

<style type="text/css">
	.flight_info div { display:inline-block; margin:12px;  width: 178px; height: 120px; vertical-align: top; }
	.flight_details div {display:inline-block; margin:12px; margin-right:24px; height: 22px;}

</style>

<table id="flight_results" class="table table-bordered table-striped table-hover">
	<thead>
	<tr>
		<th colspan="6"> International Flight Search Results </th>
	</tr>
	</thead>
	<tbody>
	<?php 
	/*	echo var_dump($results);
	exit() */?>

	@if(isset($results->Body->OTA_AirAvailRS->OriginDestinationOptions->OriginDestinationOption))
		@if ($results->Body->OTA_AirAvailRS->OriginDestinationOptions->OriginDestinationOption->count() >= 1)
			@foreach($results->Body->OTA_AirAvailRS->OriginDestinationOptions->OriginDestinationOption as $option )

				@foreach($option->FlightSegment->BookingClassAvail as $class)
				<tr>
					<td>	
						<div class="flight_info">
							<div>
							<div style="display:block; width:60px; height:60px; border:1px solid #dddddd;">
								 &nbsp;
							</div>
							 	@if (isset($option->FlightSegment->DisclosureAirline)) 
									{{ $option->FlightSegment->DisclosureAirline->attributes()->CompanyShortName }}
								@endif
			         	Flight No: {{ $option->FlightSegment->attributes()->{'FlightNumber'} }}						
							</div>

							<div>
								{{ $option->FlightSegment->OriginLocation->attributes()->LocationCode }}	→
							
								{{ $option->FlightSegment->DestinationLocation->attributes()->LocationCode }} <br>

								Arrival :  {{ $option->FlightSegment->attributes()->ArrivalDateTime }}

								Departure : {{ $option->FlightSegment->attributes()->DepartureDateTime }}
							</div>

							<div>
								Class: {{ $class->attributes()->ResBookDesigCode }} <br>
							</div>

							<div>
								Price: <br>
							</div>

							<div>
								<button class="btn btn-success">Book Now</button>
							</div>
						</div>
						<br clear="all">

						<div class="flight_details">
							<div>Flight Details</div>
							<div>Fare Details</div>
							<div>Baggage Information</div>
							<div>Flight Amenities</div>
						</div>
					</td>
				</tr>
				@endforeach
			@endforeach
		@else
		Empty result.
		@endif
	@else
	No results found.
	@endif
	</tbody>
</table>

@stop