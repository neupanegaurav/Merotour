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

                        @elseif($flightavailability->count() == 0) 

                        No Flights Available.

                        @else

                        
                        
                        
                        <br clear="all" >


                        <!-- Filters -->

                        <p>
                          <label for="amount">Price range:</label>
                          <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
                        </p>
                         
                        <div id="slider-range"></div>

                        <!-- /Filters -->


                                                    <table class="table table-bordered table-striped table-hover 

                                                    

                                                    pull-left" style="
                                                    @if($trip_type == 'R')
                                                    width:570px;
                                                    @endif
                                                    

                                                    ">
                        <thead>
                        <tr>
                        <th>Initial Flight</th>
                        </tr>
                        
                        </thead>
                        <tbody>

                        <?php


                            $airlines_list = array();
                            

                            foreach($flightavailability->Outbound->Availability as $outbound) 
                            {

                                if(!in_array((string)$outbound->FlightNo, $airlines_list)) 
                                    {
                                        $airlines_list[] =  (string)$outbound->FlightNo; 

                                    ?>

                                    <tr>
                                    <form class="reservation" method="post" action="{{ URL::to('reservation')}}" >
                                        <!-- CSRF Token -->
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                        <input type="hidden" name="flight_no" value="{{ $outbound->FlightNo }}" /> 
                                        <input type="hidden" name="adults" value="{{ $adults }}" /> 
                                        <input type="hidden" name="children" value="{{ $children }}" /> 

                             

                                        <td colspan="8">

                                        <div class="pull-left" style="margin:20px; height:120px;">
                                          <?php
                                        if($outbound->Airline == 'U4') 
                                        { 
                                            echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/buddha.jpg') . '">';
                                            echo 'Buddha Airlines';
                                            echo '<p>'. $outbound->FlightNo .'</p>';
                                        }
                                        elseif($outbound->Airline == 'RMK') 
                                        {
                                            echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                            echo 'Simrik Airlines';
                                            echo '<p>'. $outbound->FlightNo .'</p>';

                                        }
                                        elseif($outbound->Airline == 'YA' or $outbound->Airline == 'YT' ) 
                                        {
                                            echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/yeti.jpg') . '">';
                                            echo 'Yeti Airlines';
                                            echo '<p>'. $outbound->FlightNo .'</p>';

                                        }
                                        elseif($outbound->Airline == 'NA') 
                                        {
                                            //echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                            echo 'Nepal Airlines';
                                            echo '<p>'. $outbound->FlightNo .'</p>';

                                        }
                                        else
                                            {
                                                echo $outbound->Airline; 
                                            }

                                        ?>

                                        </div>

                                        <div style="height:80px;">

                                        <div style="margin-left:12px; margin-top:20px; float:left;">

                                            <strong>Departure:</strong>

                                            {{ $outbound->Departure }} 

                                             
                                            {{ $outbound->DepartureTime }}

                                            <strong>Arrival: </strong>

                                            {{ $outbound->Arrival }} 

                                            
                                            {{ $outbound->ArrivalTime }} 
                                            



                                        </div>

                                        <style>
                                        table .pull-right {background-color: #ffffff;}
                                         table .pull-right th {height:21px; padding:0px; background-color: #ffffff;}
                                         table .pull-right td {height:21px; padding:0px; background-color: #ffffff;}
                                        </style>

                                        <input type="submit" name="search" value="Book Now" class="btn btn-success pull-right" >

                                        <table id="{{$outbound->FlightNo}}" class="table table-bordered table-striped table-hover pull-right" style="width:380px; margin-right:12px;">
                                        <thead>
                                        <tr>
                                        <th>Type</th>
                                        <th>Base Fare</th>
                                        <th>Fuel Surcharge</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        <td id="type">Adult</td>
                                        <td id="base_fare"></td>
                                        <td id="fuel_surcharge"></td>
                                        <td id="tax"></td>
                                        <td id="total"></td>
                                        </tr>
                                        </tbody>
                                        </table>  

                                        </div>



                                        
                                        <div>

                                         
                                         <?php

                                         foreach ($flightavailability->Outbound->Availability as $flight) 
                                         {

                                            if((string)$outbound->FlightNo == (string)$flight->FlightNo) 
                                                {
                                        

                                        ?>

                                       
                                                    <div class="pull-left" style="text-align: center; margin:12px; background:#fff; border:1px solid #ddd; border-radius:4px; padding:5px;">

                                                    Class: {{ $flight->FlightClassCode }} <br>

                                                    Non-Refundable <br>

                                                    <div id="prefix_{{ $flight->FlightId }}" class="price_data" style="display:none;">

                                                        <input type="hidden" id="adult_fare" value="{{$flight->AdultFare}}"></span>
                                                        <span id="fuel_surcharge" value="{{$flight->FuelSurcharge}}"></span>
                                                        <span id="tax" value="{{$flight->Tax}}"></span>

                                                    </div>


                                                    
                                                    <input id="radio" name="flightid" type="radio" airline="{{$outbound->FlightNo}}"  value="{{$flight->FlightId}}" style="height:16px; width:16px;">

                                                    </div>

                                       <?php
                                                }
                                        }
                                            ?>
                                            
                                       


                                        
                                        


                                      
                                      
                                        
                                        
                                   </td>

                                </form>
                                    
                                    
                                             
                               </tr>



                                    <?php
                                    }                         

                            }

                            
                           
                        ?>

                            </div>
                            

                            <?php 
                            $entries = DealSetupAirline::all();
                            $todaysDate = strtotime(date("Y-m-d H:i:s"));
                            
                            ?>

                            @if($entries->isEmpty())

                            @else

                                @foreach($entries as $entry)

                                <?php
                                    $effective_from = strtotime($entry->effective_from);
                                    $expire_on = strtotime($entry->expire_on); 
                                    //$todaysDate > $effective_from and
                                
                                ?>

                                    @if($entry->status == 1 and 
                                        $entry->setup_from == $sectorFrom and
                                        $entry->setup_to == $sectorTo and
                                        ($todaysDate < $expire_on) and
                                        ($todaysDate > $effective_from)
                                        )

                                        <tr>

                                            <td>
                                            <?php

                                            if($entry->airline == 'U4') 
                                            { 
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/buddha.jpg') . '">';
                                                echo 'Buddha Airlines (Deal)';
                                            }
                                            elseif($entry->airline == 'RMK') 
                                            {
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                echo 'Simrik Airlines (Deal)';
                                            }
                                            elseif($entry->airline == 'YA' or $entry->airline == 'YT' ) 
                                            {
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/yeti.jpg') . '">';
                                                echo 'Yeti Airlines (Deal)';
                                            }
                                            elseif($entry->airline == 'NA') 
                                            {
                                                //echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                echo 'Nepal Airlines (Deal)';
                                            }
                                            else
                                            { 
                                                echo $entry->airline; 
                                            }

                                            ?>
                                            </td>

                                            <td>{{ $entry->setup_from }} <br>

                                             <strong>{{ date("Y-m-d") }}, 

                                            {{ $entry->departure_time }}</strong>

                                            </td>

                                            <td>{{ $entry->setup_to }} <br>

                                            <strong>{{ date("Y-m-d") }}, 

                                            {{ $entry->arrival_time }} </strong>

                                            </td>

                                            <td>{{$entry->class}}</td>

                                            <td>Non-Refundable</td>


                                            <td>
                                            <h3>{{ $entry->currency . " " .  ($entry->base_fare + $entry->tax_amount_1 + $entry->tax_amount_2 + $entry->tax_amount_3) }} </h3>
                                                                               
                                            </td>

                                            <td>

                                    <input type="submit" name="search" value="Book Now" class="btn btn-success pull-right" >

                                    <input name="flightid" class="flightid" type="hidden"  value="">

                                    </td>
                                                     
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        



                       
                            </tbody>
                        </table>

                        

                        @if($trip_type == 'R')

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

                            @if($flightavailability->count() == 2) 

                            

                                @foreach ($flightavailability->Inbound->Availability as $inbound)
                                <tr>
                                <td>

                                <input type="radio" name="returnflightid" value="{{$inbound->ReturnFlightId}}">

                                </td>

                                    <td>
                                        <?php
                                if($outbound->Airline == 'U4') { 
                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/buddha.jpg') . '">';
                                    echo 'Buddha Airlines';
                                }
                                elseif($outbound->Airline == 'RMK') {
                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                    echo 'Simrik Airlines';

                                }
                                 elseif($outbound->Airline == 'YA') {
                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/yeti.jpg') . '">';
                                    echo 'Yeti Airlines';

                                }
                                elseif($outbound->Airline == 'NA') {
                                    //echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                    echo 'Nepal Airlines';

                                }
                                else{echo $outbound->Airline; }

                                ?>
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


                                    <td><h3> NPR {{ $inbound->AdultFare }} </h3>
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

                       



                        @endif




                    </div> <!-- /Bottom -->


	

			 <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop


@section('currentpagejs')

<script>
    $(document).ready(function(){

        


    $('input[type="radio"]').change(function() 
    {
            value = $(this).val();
            airline = $(this).attr("airline");           

            adult_fare = parseInt($('#prefix_' + value + ' input#adult_fare').val()) || 0;
            fuel_surcharge = parseInt($('#prefix_' + value + ' span#fuel_surcharge').attr("value") || 0);
            tax = parseInt($('#prefix_' + value + ' span#tax').attr("value") || 0);

            $('table#' + airline + ' td#base_fare').text(adult_fare);
            $('table#' + airline + ' td#fuel_surcharge').html(fuel_surcharge);
            $('table#' + airline + ' td#tax').html(tax);
            $('table#' + airline + ' td#total').html( adult_fare+fuel_surcharge+tax );

        
    });


   /* $('.reservation').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$(this).children('#radio').is(':checked')) {
            //prevent the default form submit if it is not checked
            e.preventDefault();

            alert('Please select at least one class for booking.');
        }
    });*/





       
    });
</script>

@stop
