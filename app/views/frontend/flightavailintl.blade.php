@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Page content --}}
@section('content')
<style>
    #maincont {background: #fff; margin-top:20px; padding:5px;}
    table strong {font-size:14px;}
    table thead td {background:none;}
    td img {float:left; margin-right:10px; width:170px; height:115px;}
    a:hover {text-decoration:none;}
    td p {color: rgb(102, 102, 102);}
     
</style>

<!-- Grid page -->
<div class="content booking_wrap">
    <div class="container">
        <div class="row">
            <div class="span12 booking confrm clearfix">
                                <div class="top" style="padding:10px;">
                                    
                                    <h3>Flight Search Results</h3>
                                    
                                </div><!-- /Top -->

 <div style="border:1px solid #dddddd; border-radius: 4px;">
                        <div style="border-bottom:1px solid #dddddd; padding:4px;">hi
                            @if($trip_type == 'O')
                                One Way 
                            @elseif( $trip_type == 'R')
                                Round Trip
                            @endif

                            : {{ $sectorFrom }} - {{ $sectorTo }}

                            <div class="pull-right">
                                <div id="modify-toggle" class="btn btn-info"> Modify Search </div>
                            </div>
                            <br clear="all">
                        </div>



                    <div class="bottom clearfix" style="padding:10px;">

                                    @if(isset($error)) 

                        {{ $error }}

                        @else

                        <form method="post" action="{{ URL::to('reservation')}}" >
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 


                        <input type="submit" id="bookbtn" name="search" value="Book Now" class="btn btn-success pull-right" >

                        
                        <br clear="all" >


                                                    <table class="table table-bordered table-striped table-hover 

                                                    

                                                    pull-left" style="
                                                    @if($trip_type == 'RR')
                                                    width:570px;
                                                    @endif
                                                    

                                                    ">
                        <thead>
                        <tr><th>Initial Flight</th></tr>
                            <tr>
                                <th >Select</th>
                                <th >Airline</th>
                                <th >Depart</th>
                                <th >Arrive</th>
                                <th >Class</th>
                                <th >Source</th>
                                <th >Adult Fare</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php $count = 0; $realcount = 0; ?>

                            @foreach ($parser->FlightDetailsList->FlightDetails as $outbound)

                            @if($outbound->attributes()->Origin != $SectorFrom or 
                                $outbound->attributes()->Destination != $SectorTo or
                                empty($prices[$count]) ) 
                                
                                <?php 

                                $count++;

                                continue; ?>

                            @endif

                            <?php $realcount++; ?>   

                            
                            <tr>


                                <td>

                                <input name="flightid" class="flightid" type="radio"  value="{{$outbound->FlightId}}">

                                </td>

                                <td>

                                <?php 

                                $airlines_shortcode = $parser->AirSegmentList->AirSegment[$count]->attributes()->{'Carrier'};

                                $airline = FlightAirlines::where('airlines_shortcode', $airlines_shortcode)->first() ?>

                                @if(!empty($airline))
                                <img style="width:80px; height:auto;" src="{{ asset("assets/img/airlines/$airline->airlines_logo") }}"> 
                               
                                {{ $airline->airlines_name }} <br>

                                @endif

                                ({{ $airlines_shortcode }}
                                {{ $parser->AirSegmentList->AirSegment[$count]->attributes()->{'FlightNumber'} }})
                                  
                                </td>

                                <td>{{ $outbound->attributes()->{'Origin'} }} <br>

                                 <strong> 

                              

                               <?php $datetime = explode("T", $outbound->attributes()->{'DepartureTime'}); ?>
                                     
                                      {{ $datetime[0] .', '. substr($datetime[1] , 0, 5)

                                       }}
                                 
                                </strong>

                                </td>

                                <td>{{ $outbound->attributes()->{'Destination'} }} <br>

                                <strong>       <?php $datetime = explode("T", $outbound->attributes()->{'ArrivalTime'}); ?>
                                     
                                      {{ $datetime[0] .', '. substr($datetime[1] , 0, 5)

                                       }}
                                  </strong>

                                </td>

                                <td>

                                @foreach($parser->AirSegmentList->AirSegment[$count]->AirAvailInfo->BookingCodeInfo as $class)

                                {{ $class->attributes()->{'CabinClass'} }} :
                                {{ $class->attributes()->{'BookingCounts'} }}

                                <br>

                                 
                                @endforeach

                                </td>

                                <td>
                                {{
                                $parser->AirSegmentList->AirSegment[$count]->attributes()->{'AvailabilitySource'}
                                }}
                                </td>


                                <td>
                                <h3> 

                                @if(!empty($prices[$count]))

                                {{ $prices[$count] }}

                                @endif

                                 </h3>
                                            <br>

                                           

                                            

                                            

                                </td>
                                         
                           </tr>

                           <?php $count++; ?>

                            @endforeach

                            

                       
                            </tbody>
                        </table>








                        @if ($realcount == 0) 

                            <style>table {display:none;} form #bookbtn {display:none;}</style>

                            <h4>Sorry, no flights were found for this date.</h4>

                            <a class="btn btn-success" href="{{URL::to('international')}}" > Back to flight search </a>

                            @endif

                        
                        

                        @if($trip_type == 'RR')

                         <table class="table table-bordered table-striped table-hover pull-right" style="width:570px;">
                            <thead>
                            <tr><th colspan="7" style="text-align:center;">Return Flight</th></tr>
                                <tr>
                                <th class="span2">Select</th>
                                                <th class="span2">Airline</th>
                                                <th class="span2">Depart</th>
                                    <th class="span2">Arrive</th>
                                                <th class="span2">Class</th>
                                    <th class="span2">Fare Type</th>
                                    <th class="span2">Adult Fare</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if($parser->count() == 2) 

                            

                                @foreach ($parser->Inbound->Availability as $inbound)
                                <tr>
                                <td>

                                <input type="radio" name="returnflightid" value="{{$inbound->ReturnFlightId}}">

                                </td>

                                    <td>
                                        
                                    </td>

                                    <td>{{ $inbound->Departure }} <br>

                                     <strong>{{ $inbound->FlightDate }}, 

                                    {{ $inbound->DepartureTime }}</strong>

                                    </td>

                                    <td>{{ $inbound->Arrival }} <br>

                                    <strong>{{ $inbound->FlightDate }}, 

                                    {{ $inbound->ArrivalTime }} </strong>

                                    </td>

                                    <td>{{ $inbound->FlightClassCode }}</td>

                                    <td>Non-Refundable</td>


                                    <td><h3> USD {{ $inbound->AdultFare }} </h3>
                                                <br>

                                               

                                                

                                                
                                    </td>
                                             
                               </tr>
                                @endforeach

                            @else

                            <tr><td colspan="7">No return flights were found for this date.</td> </tr>

                            @endif


                           
                            </tbody>
                        </table>

                        @endif

                        </form>



                        @endif




                    </div> <!-- /Bottom -->
            </div>
        </div>
    </div>
</div>

                                
    
       
    
  
                              
                              
                       

@stop