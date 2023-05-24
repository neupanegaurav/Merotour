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
        <style>
        #maincont {background: #fff; margin-top:20px; padding:5px;}
        table strong {font-size:14px;}
        table thead td {background:none;}
        td img {float:left; margin-right:10px; width:170px; height:115px;}
        a:hover {text-decoration:none;}
        td p {color: rgb(102, 102, 102);}
         
    </style>

                
                <div class="top" style="padding:10px;">
                    
                    <h3>Flight Search Results</h3>
                    
                </div><!-- /Top -->

                 <br clear="all" >

                            <div class="control-group error">
                                {{ $errors->first('flightid', '<span class="help-inline">:message</span>') }}
                                {{ $errors->first('flight_no', '<span class="help-inline">:message</span>') }}
                                {{ $errors->first('adults', '<span class="help-inline">:message</span>') }}
                                {{ $errors->first('children', '<span class="help-inline">:message</span>') }}
                                {{ $errors->first('airline', '<span class="help-inline">:message</span>') }}
                            </div>


                @if(!is_null($trip_type))

                    <div style="border:1px solid #dddddd; border-radius: 4px;">
                        <div style="border-bottom:1px solid #dddddd; padding:4px;">
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

                        <div id="modify-collapse" style="padding:4px; display:none; width:450px;">
                            <form id="flight_form"  action="{{URL::route('flightsearch')}}" method="post">
                                 <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                <input type="hidden" name="backend" value="1" /> 
                                <input type="hidden" name="dom_int" value="domestic" />
                                                                                                                        
                                <h4 id="h4" style="margin:10px;">Domestic Flight Search </h4>
                                    
                                <div class="trip">
                                    <input type="radio" name="trip_type" checked="checked" value="O"><span>One-way</span>
                                    <input type="radio" name="trip_type" value="R"><span>Roud-Trip</span>                 
                                </div>

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label>Your Location</label>
                            
                                            <select name="sectorFrom"  id="sectorFrom">                        
                                                <option value="KTM" SELECTED>KATHMANDU</option> 

                                                <option value="BDP">BHADRAPUR</option>

                                                <option value="BWA">BHAIRAHAWA</option>

                                                <option value="BHR">BHARATPUR</option>

                                                <option value="BIR">BIRATNAGAR</option>

                                                <option value="DHI">DHANGADI</option>

                                                <option value="JKR">JANAKPUR</option>

                                                <option value="KTM">KATHMANDU</option>

                                                <option value="MTN">MOUNTAIN</option>

                                                <option value="KEP">NEPALJUNG</option>

                                                <option value="PKR">POKHARA</option>

                                                <option value="SIF">SIMARA</option>
                                            </select>
        

                                                <input style="display:none;" class="sectorFromIntl" name="origin" type="text" id="tags">
                                                </div>

                                        <div class="pull-right">
                                            <label class="dst">Destination</label>
                             
                                            <select name="sectorTo"  id="sectorTo">
                                                <option value="PKR"  SELECTED>POKHARA</option>

                                                <option value="BDP">BHADRAPUR</option>

                                                <option value="BWA">BHAIRAHAWA</option>

                                                <option value="BHR">BHARATPUR</option>

                                                <option value="BIR">BIRATNAGAR</option>

                                                <option value="DHI">DHANGADI</option>

                                                <option value="JKR">JANAKPUR</option>

                                                <option value="KTM">KATHMANDU</option>

                                                <option value="MTN">MOUNTAIN</option>

                                                <option value="KEP">NEPALJUNG</option>

                                                <option value="PKR">POKHARA</option>

                                                <option value="SIF">SIMARA</option>

                                            </select>

                                           
                                            <input style="display:none;" class="sectorToIntl" name="destination" type="text" id="tags2">
                                        </div>
                                    </div>

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <div class="date clearfix">
                                                <div class="Depart-Date">
                                                    <label>Depart Date</label> 
                                                    <input type="text" class="flight_date" name="flight_date" value="<?php echo date('d-m-Y');?>" id="<?php echo 'datepicker';?>">
                                                    <input style="display:none" type="text" class="flight_date_intl" name="flight_date_intl" value="<?php echo date('Y-m-d');?>" id="<?php echo 'datepickerintl';?>">
                                                </div>
                                                <div id="returndiv" style="visibility:hidden;">
                                                    <label>Return Date</label>
                                                    <input type="text" class="return_date" name="return_date" value="<?php echo date('d-m-Y');?>" id="<?php echo 'clender';?>">
                                                    <input style="display:none" type="text" class="return_date_intl" name="return_date_intl" value="<?php echo date('Y-m-d');?>" id="<?php echo 'clenderintl';?>">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="persons">
                                                <div class="ad">
                                                    <label>Adults</label>
                                                    <input class=""type="text" name="adults" value="1" id="spinner">
                                                </div>
                                                <div class="ad">
                                                    <label>Children</label>
                                                    <input type="text" name="children" value="0" id="spinner-two">
                                                </div>

                                                <div class="ad">
                                                    <label>Nationality</label>
                                                    <select name="nationality" style="width:90px" >
                                                        <option value="Nepalese">Nepalese</option>
                                                        <option value="IN">Indian</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="search">
                                        <input type="submit" name="search" value="SEARCH" >
                                    </div>
                            </form>
                        </div>
                        

                    </div> <!-- Modify search box -->

                @endif

                    <br clear="all" >

                    <div id="previous_next">
                        <?php
                            $sectorFrom     = Session::get('sectorFrom');
                            $sectorTo       = Session::get('sectorTo');
                            $flight_date    = Session::get('flight_date');
                            $trip_type      = Session::get('trip_type');
                            $return_date    = Session::get('return_date');
                            $adults         = Session::get('adults');
                            $children       = Session::get('children');
                            $nationality    = Session::get('nationality');

                            $previous_day = date('d-m-Y', strtotime($flight_date . "-1 days"));
                            $next_day = date('d-m-Y', strtotime($flight_date . "+1 days"));
                        ?>
                        <div class="pull-left">
                            <form action="{{route('flightsearch')}}" method="post">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                <input type="hidden" name="sectorFrom" value="{{ $sectorFrom }}">
                                <input type="hidden" name="sectorTo" value="{{ $sectorTo }}">
                                <input type="hidden" name="flight_date" value="{{ $previous_day }}">
                                <input type="hidden" name="trip_type" value="{{ $trip_type }}">
                                <input type="hidden" name="return_date" value="{{ $return_date }}">
                                <input type="hidden" name="adults" value="{{ $adults }}">
                                <input type="hidden" name="children" value="{{ $children }}">
                                <input type="hidden" name="nationality" value="{{ $nationality }}">
                                <input type="hidden" name="dom_int" value="domestic" />
                                <input type="hidden" name="backend" value="1" />
               
                                <button type="submit" class="btn">&lt; ({{ $previous_day }}) Previous Day</button>
                            </form>
                        </div>

                        <div class="pull-left" style="margin-left:200px;">
                             Current Search Date ({{ $flight_date }})
                        </div>
                        
                        <div class="pull-right">
                            <form action="{{route('flightsearch')}}" method="post">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                <input type="hidden" name="sectorFrom" value="{{ $sectorFrom }}">
                                <input type="hidden" name="sectorTo" value="{{ $sectorTo }}">
                                <input type="hidden" name="flight_date" value="{{ $next_day }}">
                                <input type="hidden" name="trip_type" value="{{ $trip_type }}">
                                <input type="hidden" name="return_date" value="{{ $return_date }}">
                                <input type="hidden" name="adults" value="{{ $adults }}">
                                <input type="hidden" name="children" value="{{ $children }}">
                                <input type="hidden" name="nationality" value="{{ $nationality }}">  
                                <input type="hidden" name="dom_int" value="domestic" />                              
                                <input type="hidden" name="backend" value="1" />

                                <button type="submit" class="btn">Next Day ({{ $next_day }}) &gt;</button>
                            </form>
                        </div>
                    </div>


                    <div class="bottom clearfix">


                         <table class="table table-bordered table-striped pull-left" style="
                                                        @if($trip_type == 'R')
                                                        width:506px;
                                                        @endif">
                            <thead>
                            <tr>
                            <th colspan="12">

                            <div class="pull-left"> Initial Flight </div>

                            <div class="pull-right">

                                Sort By: 
                              
                                <select id="sort_by" style="width:160px;" >
                                    <option value="low_high">Price (Low to High)</option>
                                    <option value="high_low">Price (High to Low)</option>
                                    <option value="STOPS_0">Stops (0 to 2+)</option>
                                    <option value="STOPS_1">Stops (2+ to 0)</option>
                                    <option value="DEPTIME_0">Departure (Early to Late)</option>
                                    <option value="DEPTIME_1">Departure (Late to Early)</option>
                                    <option value="DURATION_0">Duration (Min to Max)</option>
                                    <option value="DURATION_1">Duration (Max to Min)</option>
                                    <option value="AIRLINE_0">Airline (A to Z)</option>
                                    <option value="AIRLINE_1">Airline (Z to A)</option>
                                </select>

                                Currency: 
                                <select style="width:80px;">
                                    <option>NPR</option>
                                    <option>USD</option>
                                    <option>INR</option>
                                </select>
                                
                            </div>

                            </th>
                            </tr>
                            
                            </thead>
                            <tbody>


                        @if(isset($error)) 

                        <tr><td colspan="12">{{ $error }}</td></tr>

                        @elseif($flightavailability->count() == 0) 
                        
                        <tr><td colspan="12">No Flights Available.</td></tr>

                        @else
                                                
                                @foreach($flightavailability->Outbound->Availability as $outbound) 


                                        <tr>

                                            <form class="reservation" method="post" action="{{ URL::to('reservation')}}" >
                                    
                                            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                            <input type="hidden" name="flight_no" value="{{ $outbound->FlightNo }}" /> 
                                            <input type="hidden" name="adults" value="{{ $adults }}" /> 
                                            <input type="hidden" name="children" value="{{ $children }}" />
                                            <input type="hidden" name="flightid" value="{{$outbound->FlightId}}" style="height:16px; width:16px;">                              

                                            <?php
                                                Session::put('departure', (string)$outbound->Departure); 
                                                Session::put('arrival', (string)$outbound->Arrival); 

                                                $flight_id = (string)$outbound->FlightId;

                                                Session::put('adult_fare_'. $flight_id, (int)$outbound->AdultFare);
                                                Session::put('airline_'. $flight_id, (string)$outbound->Airline);
                                                Session::put('child_fare_'. $flight_id, (int)$outbound->ChildFare);
                                                Session::put('fuel_surcharge_'. $flight_id, (int)$outbound->FuelSurcharge);
                                                Session::put('tax_'. $flight_id, (int)$outbound->Tax);
                                                Session::put('class_code_'. $flight_id, (string)$outbound->FlightClassCode);
                                                Session::put('free_baggage_'. $flight_id, (string)$outbound->FreeBaggage);
                                                Session::put('flight_currency', (string)$outbound->Currency);
                                            ?>


                                            <td colspan="8">

                                            <div class="pull-left" style="margin:20px 0px 20px 20px; width:149px;">
                                              <?php
                                            if($outbound->Airline == 'U4') 
                                            { 
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/buddha.jpg') . '">';
                                                echo 'Buddha Airlines';
                                                echo '<p>'. $outbound->FlightNo .'</p>';
                                                echo '<input type="hidden" name="airline" value="Buddha Airlines">';
                                            }
                                            elseif($outbound->Airline == 'RMK') 
                                            {
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                echo 'Simrik Airlines';
                                                echo '<p>'. $outbound->FlightNo .'</p>';
                                                echo '<input type="hidden" name="airline" value="Simrik Airlines">';

                                            }
                                            elseif($outbound->Airline == 'YA' or $outbound->Airline == 'YT' ) 
                                            {
                                                echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/yeti.jpg') . '">';
                                                echo 'Yeti Airlines';
                                                echo '<p>'. $outbound->FlightNo .'</p>';
                                                echo '<input type="hidden" name="airline" value="Yeti Airlines">';

                                            }
                                            elseif($outbound->Airline == 'NA') 
                                            {
                                                //echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                echo 'Nepal Airlines';
                                                echo '<p>'. $outbound->FlightNo .'</p>';
                                                echo '<input type="hidden" name="airline" value="Nepal Airlines">';

                                            }
                                            else
                                                {
                                                    echo $outbound->Airline; 
                                                    echo '<p>'. $outbound->FlightNo .'</p>';
                                                    echo '<input type="hidden" name="airline" value="'.$outbound->Airline.' Airlines">';

                                                }

                                            ?>

                                            </div>

                                            <div style="height:125px;">

                                            <div style="margin-left:12px; margin-top:20px; float:left;">

                                                <strong>Departure:</strong>

                                                {{ $outbound->Departure }} 

                                                <?php 
                                                    Session::put('departure', (string)$outbound->Departure); 
                                                    Session::put('arrival', (string)$outbound->Arrival); 
                                                ?>

                                                 
                                                {{ $outbound->DepartureTime }}

                                                <strong>Arrival: </strong>

                                                {{ $outbound->Arrival }} 

                                                
                                                {{ $outbound->ArrivalTime }} 

                                            <br>

                                            <strong>Class:</strong> {{ $outbound->FlightClassCode }} <br>

                                            <strong>Fare Type:</strong> {{ $outbound->Refundable == 'T' ? 'Refundable' : 'Non-Refundable' }}  <br>
                                                
                                            </div>

                                            <style>
                                             table .pull-right {background-color: #ffffff;}
                                             table .pull-right th {height:21px; padding:0px; background-color: #ffffff;}
                                             table .pull-right td {height:21px; padding:0px; background-color: #ffffff;}
                                            </style>



                                            <input type="submit" name="search" value="Book Now" class="btn btn-success pull-right" >

                                            <table id="{{$outbound->FlightNo}}" class="table table-bordered pull-right" style="width:440px; margin-right:12px;">
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
                                                        <td id="adult_fare">{{ $outbound->Currency . " " . ceil($outbound->AdultFare) }}</td>
                                                        <td id="fuel_surcharge_adult">{{ $outbound->Currency . " " . ceil($outbound->FuelSurcharge)}}</td>
                                                        <td id="tax_adult">{{ $outbound->Currency . " " . ceil($outbound->Tax)}}</td>
                                                        <td id="total_adult">{{ $outbound->Currency . " " .  ceil($outbound->AdultFare + $outbound->FuelSurcharge + $outbound->Tax)}}</td>
                                                    </tr>
                                                    <tr id="child_pricebox">
                                                        <td id="type">Child</td>
                                                        <td id="child_fare">{{ $outbound->Currency . " " . ceil($outbound->ChildFare) }}</td>
                                                        <td id="fuel_surcharge_child">{{ $outbound->Currency . " " . ceil($outbound->FuelSurcharge)}}</td>
                                                        <td id="tax_child">{{ $outbound->Currency . " " . ceil($outbound->Tax)}}</td>
                                                        <td id="total_child">{{ $outbound->Currency . " " .  ceil($outbound->ChildFare + $outbound->FuelSurcharge + $outbound->Tax)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>  

                                            </div>                              
                      
                                            </td>

                                            </form>

                                                                                                
                                         </tr>

                                   



                            @endforeach

                                </div>
                            
 @endif
                                
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

                         <table id="initial_flight" class="table table-bordered table-striped table-hover pull-right" style="width:528px;">
                            <thead>
                            <tr><th colspan="7" style="text-align:center;">Return Flight</th></tr>
                                <tr>
                                <th class="span2">Select</th>
                                                <th class="span2">Airline</th>
                                                <th class="span2">Depart</th>
                                    <th class="span2">Arrive</th>
                                                <th class="span2">Class</th>
                                    <th class="span2">Fare Type</th>
                                    <th class="span2">Total Fare</th>
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
                                 elseif($outbound->Airline == 'YA' or $outbound->Airline == 'YT') {
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


                                    <td>Adult: <h3> Rs. {{ $inbound->AdultFare + $inbound->FuelSurcharge +$inbound->Tax }} </h3>
                                     <br>
                                     Child: <h3> Rs. {{ $inbound->ChildFare + $inbound->FuelSurcharge +$inbound->Tax }} </h3>                                                      
                                    </td>
                                             
                               </tr>
                                @endforeach

                            @else

                            <tr><td colspan="7">No return flights were found for this date.</td> </tr>

                            @endif
                           
                            </tbody>
                        </table>

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

        $( "#datepicker1" ).datepicker({       
                      dateFormat: "dd-mm-yy"
                    });

        $( "#datepicker2" ).datepicker({       
          dateFormat: "dd-mm-yy"
        }); 

        jQuery.fn.visible = function() {
            return this.css('visibility', 'visible');
        };

        jQuery.fn.invisible = function() {
            return this.css('visibility', 'hidden');
        };

        jQuery.fn.visibilityToggle = function() {
            return this.css('visibility', function(i, visibility) {
                return (visibility == 'visible') ? 'hidden' : 'visible';
            });
        };
    

        /**
         * Show/Hide Return input box according to checkbox( One way, Return trip)
         */
        $('input[name="trip_type"]').change(function() {
                trip_type = $(this).val();
                if (trip_type == 'O') {
                    $('#returndiv').invisible();
                } else {
                    $('#returndiv').visible();
                }
        });

        $('.classes').each(function() {

            $('input[type=radio]:first', this).attr('checked', true);

            value =  $('input[type=radio]:first', this).val();

            airline = $('input[type=radio]:first', this).attr("airline");

            adult_fare = parseInt($('#prefix_' + value + ' input#adult_fare').val()) || 0;
            child_fare = parseInt($('#prefix_' + value + ' input#child_fare').val()) || 0;
            fuel_surcharge = parseInt($('#prefix_' + value + ' input#fuel_surcharge').attr("value") || 0);
            tax = parseInt($('#prefix_' + value + ' input#tax').attr("value") || 0);
            commission = parseInt($('#prefix_' + value + ' span#agent_commission').attr("value") || 0);

            if (commission) {

                final_af = Math.ceil(adult_fare -((commission/100) *adult_fare));

                if (child_fare <= 0) {
                    $('table#' + airline + ' tr#child_pricebox').hide();
                } else {
                    final_cf = Math.ceil(child_fare -((commission/100) *child_fare));
                    $('table#' + airline + ' td#child_fare').html('<del style="color:red;">'+child_fare+'</del>'+' ' +final_cf + ' (' + commission + '%' + ' agent commission)');
                    $('table#' + airline + ' td#fuel_surcharge_child').html(fuel_surcharge);
                    $('table#' + airline + ' td#tax_child').html(tax);
                    $('table#' + airline + ' td#total_child').html( Math.ceil(final_cf+fuel_surcharge+tax) );                
                }

                $('table#' + airline + ' td#adult_fare').html('<del style="color:red;">'+adult_fare+'</del>'+' ' +final_af + ' (' + commission + '%' + ' agent commission)');
                $('table#' + airline + ' td#fuel_surcharge_adult').html(fuel_surcharge);
                $('table#' + airline + ' td#tax_adult').html(tax);
                $('table#' + airline + ' td#total_adult').html( Math.ceil(final_af+fuel_surcharge+tax) );
            } else {

                if (child_fare <= 0) {
                    final_cf = 0;
                    $('table#' + airline + ' tr#child_pricebox').hide();
                } else {
                    $('table#' + airline + ' td#child_fare').html(child_fare);
                    $('table#' + airline + ' td#fuel_surcharge_child').html(fuel_surcharge);
                    $('table#' + airline + ' td#tax_child').html(tax);
                    $('table#' + airline + ' td#total_child').html( child_fare+fuel_surcharge+tax );

                }

                $('table#' + airline + ' td#adult_fare').html(adult_fare);
                $('table#' + airline + ' td#fuel_surcharge_adult').html(fuel_surcharge);
                $('table#' + airline + ' td#tax_adult').html(tax);
                $('table#' + airline + ' td#total_adult').html( adult_fare+fuel_surcharge+tax );
            }

        });


    $('input[type="radio"]').change(function() 
    {

            value = $(this).val();
            airline = $(this).attr("airline");           

            adult_fare = parseInt($('#prefix_' + value + ' input#adult_fare').val()) || 0;
            child_fare = parseInt($('#prefix_' + value + ' input#child_fare').val()) || 0;
            fuel_surcharge = parseInt($('#prefix_' + value + ' input#fuel_surcharge').attr("value") || 0);
            tax = parseInt($('#prefix_' + value + ' input#tax').attr("value") || 0);
            commission = parseInt($('#prefix_' + value + ' span#agent_commission').attr("value") || 0);

            if (commission) {
                
                final_af = Math.ceil(adult_fare -((commission/100) *adult_fare));

                if (child_fare <= 0) {
                    $('table#' + airline + ' tr#child_pricebox').hide();
                } else {
                    final_cf = Math.ceil(child_fare -((commission/100) *child_fare));
                    $('table#' + airline + ' tr#child_pricebox').show();
                    $('table#' + airline + ' td#child_fare').html('<del style="color:red;">'+child_fare+'</del>'+' ' +final_cf + ' (' + commission + '%' + ' agent commission)');
                    $('table#' + airline + ' td#fuel_surcharge_child').html(fuel_surcharge);
                    $('table#' + airline + ' td#tax_child').html(tax);
                    $('table#' + airline + ' td#total_child').html( Math.ceil(final_cf+fuel_surcharge+tax) );                
                }

                $('table#' + airline + ' td#adult_fare').html('<del style="color:red;">'+adult_fare+'</del>'+' ' +final_af + ' (' + commission + '%' + ' agent commission)');
                $('table#' + airline + ' td#fuel_surcharge_adult').html(fuel_surcharge);
                $('table#' + airline + ' td#tax_adult').html(tax);
                $('table#' + airline + ' td#total_adult').html( Math.ceil(final_af+fuel_surcharge+tax) );
            } else {

                if (child_fare <= 0) {
                    final_cf = 0;
                    $('table#' + airline + ' tr#child_pricebox').hide();
                } else {
                    $('table#' + airline + ' tr#child_pricebox').show();
                    $('table#' + airline + ' td#child_fare').html(child_fare);
                    $('table#' + airline + ' td#fuel_surcharge_child').html(fuel_surcharge);
                    $('table#' + airline + ' td#tax_child').html(tax);
                    $('table#' + airline + ' td#total_child').html( child_fare+fuel_surcharge+tax );

                }

                $('table#' + airline + ' td#adult_fare').html(adult_fare);
                $('table#' + airline + ' td#fuel_surcharge_adult').html(fuel_surcharge);
                $('table#' + airline + ' td#tax_adult').html(tax);
                $('table#' + airline + ' td#total_adult').html( adult_fare+fuel_surcharge+tax );
            }
    });


    $('#modify-toggle').click(function() {

        $('#modify-collapse').toggle('slow');

    });


    $("#sort_by").change(function() {

             value = $(this).find('option:selected').val();

             highest_price = 0;

             switch(value) {
                    case 'low_high':
        

                    $('#initial_flightt').find('tr').each(function(){

                        current_price = parseInt($(this).find('input[name="highest_price"]').val()) || 0;

                        alert(current_price);

                    });

                        
                        break;
                    case 'high_low':
                        break;
                    default:
                        
                }
            
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
