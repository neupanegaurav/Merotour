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


 <form action="{{URL::to('agent/flightavail')}}" method="post" style="width:500px;">
                                 <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                                    <div class="trip">
                                        <input type="radio" name="trip_type" checked="checked" value="R"><span>Roud-Trip</span>
                                        <input type="radio" name="trip_type" value="O"><span>One-way</span>
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

                                        </div>
                                    </div>

                                    <div class="location clearfix">

                                        <div class="pull-left">
                                            <div class="date clearfix">
                                                <div class="Depart-Date">
                                                    <label>Depart Date</label>
                                                    <input type="text" name="flight_date" value="{{ date('d-m-Y') }}" id="datepicker">
                                                </div>
                                                <div>
                                                    <label>Return Date</label>
                                                    <input type="text" name="return_date" value="{{ date('d-m-Y') }}" id="clender">
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
                                                    <input type="text" name="children" value="1" id="spinner-two">
                                                </div>
                                                                                            </div>
                                        </div>
                                    </div>

                                    
                                <input type="submit" name="search" value="SEARCH" class="btn btn-success" >
                                    
                                </form>



 <!-- /Right Content -->   
	


                </div>

                                
    
                  

@stop
