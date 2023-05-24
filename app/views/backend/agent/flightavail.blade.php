@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Change your email ::
@parent
@stop

{{-- Page content --}}
@section('content')


<div id="right_section">
    
    <div id="right_header">
    	<h3>
    		Search Flights	
    	</h3>
        
    </div>
 
 <!-- Right content -->

 <div class="top" style="padding:10px;">
                                    
    <h3>Flight Search Results</h3>
                                    
  </div><!-- /Top -->

    <div class="bottom clearfix" style="padding:10px;">

            @if(isset($error)) 

            {{ $error }}

            @else

            <form method="post" action="{{ URL::to('agent/reservation')}}" >
            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 


            <input type="submit" name="search" value="Book Now" class="btn btn-success pull-right" >

            
            <br clear="all" >


                                        <table class="table table-bordered table-striped table-hover 

                                        

                                        pull-left" style="
                                        @if($trip_type == 'R')
                                        width:460px;
                                        @endif
                                        

                                        ">
            <thead>
            <tr><th>Initial Flight</th></tr>
                <tr>
                    <th>Select</th>
                    <th >Airline</th>
                    <th >Depart</th>
                    <th >Arrive</th>
                    <th >Class</th>
                    
                    <th >Adult Fare</th>
                </tr>
            </thead>
            <tbody>


            

                @foreach ($flightavailability->Outbound->Availability as $outbound)
                <tr>

                    <td>

                    <input type="radio" name="FlightId" value="{{$outbound->FlightId}}"> 

                    </td>

                    <td>
                      <?php
                    if($outbound->Airline == 'U4') { 
                        echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                        echo 'Simrik Airlines';
                    }
                    else{echo $outbound->Airline; }

                    ?>
                    </td>

                    <td>{{ $outbound->Departure }} <br>

                     <strong>{{ $outbound->FlightDate }}, 

                    {{ $outbound->DepartureTime }}</strong>

                    </td>

                    <td>{{ $outbound->Arrival }} <br>

                    <strong>{{ $outbound->FlightDate }}, 

                    {{ $outbound->ArrivalTime }} </strong>

                    </td>

                    <td>{{ $outbound->FlightClassCode }}</td>

                    


                    <td><h4> NPR {{ $outbound->AdultFare }} </h4>
                                <br>

                               

                                

                                

                    </td>
                             
               </tr>
                @endforeach

           
                    </tbody>
                </table>


                @if($trip_type == 'R')

                 <table class="table table-bordered table-striped table-hover pull-right" style="width:460px;">
                    <thead>
                    <tr><th colspan="7" style="text-align:center;">Return Flight</th></tr>
                        <tr>
                        <th class="span2">Select</th>
                                        <th class="span2">Airline</th>
                                        <th class="span2">Depart</th>
                            <th class="span2">Arrive</th>
                                        <th class="span2">Class</th>
                           <th class="span2">Adult Fare</th>
                        </tr>
                    </thead>
                    <tbody>


                

                    @foreach ($flightavailability->Inbound->Availability as $inbound)
                    <tr>
                    <td>

                    <input type="radio" name="ReturnFlightId" value="{{$inbound->ReturnFlightId}}">

                    </td>

                        <td>
                          <?php
                        if($inbound->Airline == 'U4') { 
                            echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                            echo 'Simrik Airlines';
                        }
                        else{echo $inbound->Airline; }

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

                       
                        <td><h4> NPR {{ $inbound->AdultFare }} </h4>
                                    <br>

                                   

                                    

                                    
                            </td>
                                     
                       </tr>
                        @endforeach

                   
                    </tbody>
                </table>

                @endif

                </form>



                @endif


    </div> <!-- /Bottom -->


    <!-- /Right Content -->   	
</div>

                                
    
                  

@stop
