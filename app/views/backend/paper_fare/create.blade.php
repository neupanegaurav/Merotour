@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Add Airline Deal Setup ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Airline Deal Setup 
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Deal Setup
                            <span class="icon-angle-right"></span>
                </li>
                         
                <li> <a href="{{ route('deal-setup') }}">Airline </a>
                <span class="icon-angle-right"></span> 
                </li>

                <li>Add</li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
   
    <!-- BEGIN TABLE BODY -->
    <div class="body">



   
        <!-- BEGIN TABLE DATA -->
        

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />       
           
          <div class="control-group error">
                {{ $errors->first('setup_from', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('setup_to', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('airline', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('class', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('departure_time', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('arrival_time', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('flight_number', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('base_fare', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_name_1', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_amount_1', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_name_2', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_amount_2', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_name_3', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('tax_amount_3', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('effective_from', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('expire_on', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('total_seat_quota', '<span class="help-inline">:message</span>') }}
                {{ $errors->first('status', '<span class="help-inline">:message</span>') }}
          </div>

           <h4>Segment Details</h4>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                                
                                <th class="span2">From</th>
                                <th class="span2">To</th>
                                <th class="span2">Airline</th>
                                <th class="span2">Class</th>
                                <th class="span2">Departure Time</th>
                                <th class="span2">Arrival Time</th>
                                <th class="span3">Flight Number</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                   

                    <td>

                          <select name="setup_from" style="width:130px">
                            <option value="KTM" >KATHMANDU</option> 
                            
                            <option value="BDP" >BHADRAPUR</option>

                            <option value="BWA" >BHAIRAHAWA</option>

                            <option value="BHR" >BHARATPUR</option>

                            <option value="BIR" >BIRATNAGAR</option>

                            <option value="DHI" >DHANGADI</option>

                            <option value="JKR" >JANAKPUR</option>

                            <option value="MTN" >MOUNTAIN</option>

                            <option value="KEP" >NEPALJUNG</option>

                            <option value="PKR" >POKHARA</option>

                            <option value="SIF" >SIMARA</option>
                          </select>
                           

                    </td>
                    

                    <td>

                    <select name="setup_to" style="width:130px">
                        <option value="KTM" >KATHMANDU</option> 

                        <option value="BDP" >BHADRAPUR</option>

                        <option value="BWA" >BHAIRAHAWA</option>

                        <option value="BHR" >BHARATPUR</option>

                        <option value="BIR" >BIRATNAGAR</option>

                        <option value="DHI" >DHANGADI</option>

                        <option value="JKR" >JANAKPUR</option>

                        <option value="MTN" >MOUNTAIN</option>

                        <option value="KEP" >NEPALJUNG</option>

                        <option value="PKR" >POKHARA</option>

                        <option value="SIF" >SIMARA</option>

                    </select>
                    
                    </td>

                    <td>
                    <select name="airline" style="width:180px">
                    <option value="U4" >Buddha Airlines (U4)</option>
                    <option value="RMK" >Simrik Airlines (RMK)</option>
                    <option value="YT" >Yeti Airlines (YT)</option>
                    <option value="NA" >Nepal Airlines (NA)</option>
                    </select>
                    </td>
                    <td><input name="class" style="width:80px" type="text" value="{{ Input::old('class') }}"></td>
                    <td><input name="departure_time" id="timepicker1"  style="width:120px" type="text" value="{{ Input::old('departure_time') }}"></td>
                    <td><input name="arrival_time" id="timepicker2" style="width:120px" type="text" value="{{ Input::old('arrival_time') }}"></td>  
                    <td>
                    <input name="flight_number" style="width:120px" type="text" value="{{ Input::old('flight_number')}}">
                    </td>
                    </tr>

                
                </tbody>
            </table>

            
             <h4>Tax</h4>

                <div class="social-box ">
                            
                            <div class="body">
                               
                                <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                                            
                                            <tbody>
                    
                                                <tr>
                                                <td>Base Fare <input name="base_fare" style="width:120px" type="text" value="{{ Input::old('base_fare') }}"></td>
                                                <td>
                                                <select name="currency">
                                                <option value="NPR" >NPR</option>
                                                <option value="USD" >USD</option>
                                                </select>
                                                </td>
                                                </tr>

                                                <tr>
                                                <td>Tax Name <input name="tax_name_1" style="width:120px" type="text" value="{{ Input::old('tax_name_1') }}"> </td>
                                                <td>Tax Amount <input name="tax_amount_1" style="width:120px" type="text" value="{{ Input::old('tax_amount_1') }}"> </td>
                                               
                        
                                                </tr>

                                                 <tr>
                                                    <td>Tax Name <input name="tax_name_2" style="width:120px" type="text" value="{{ Input::old('tax_name_2') }}"> </td>
                                                    <td>Tax Amount <input name="tax_amount_2" style="width:120px" type="text" value="{{ Input::old('tax_amount_2') }}"> </td>
                                                </tr>

                                                <tr>
                                                    <td>Tax Name <input name="tax_name_3" style="width:120px" type="text" value="{{ Input::old('tax_name_3') }}"> </td>
                                                    <td>Tax Amount <input name="tax_amount_3" style="width:120px" type="text" value="{{ Input::old('tax_amount_3') }}"> </td>  
                                                </tr>

                                                <tr>
                                                    <td colspan="2"> Fare Rules <textarea name="fare_rules" style="width:600px;">{{Input::old('fare_rules')}}</textarea></td>
                                                    
                                                </tr>



                                            </tbody>

                                </table>

                    <h4>Search Control</h4>

                    <table class="table table-bordered table-striped table-hover">
                        
                            <tbody>
                            
                                <tr>
                                    <td>Effective From 
                                    <input name="effective_from" type="text" value="{{ Input::old('effective_from') }}" id="datepicker1" class="ui-datepicker">
                                    </td>
                                    
                                    <td>Expire On 
                                    <input name="expire_on" id="datepicker2" style="width:160px" type="text" value="{{ Input::old('expire_on') }}"> 
                                    </td>
                               
                                           
                                </tr>

                                <tr>
                                    <td>Total Seat Quota <input name="total_seat_quota" style="width:120px" type="text" value="{{ Input::old('total_seat_quota') }}"> </td>
                                    <td>Status: <input type="radio" name="status" value="1" checked > Active </input> <input type="radio" value="0" name="status" > Deactive</input> </td>
                                         
                                </tr>

                                <tr>
                                    <td colspan="2"> Note <textarea name="note" style="width:600px;">{{ Input::old('note') }}</textarea></td>
                                </tr> 
                            </tbody>
                    </table>
                                                     


        </div>
    </div>                                             	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('deal-setup') }}">Back</a>

			<button type="submit" class="btn btn-success">Add Airline Deal Setup</button>
		</div>
	</div>
             
        
</form>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         
@stop

@section('currentpagejs')

<style>
    /* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
</style>

<script src="{{asset('assets/backend/js/jquery-ui-timepicker-addon.js')}}"></script>


<script>
    jQuery(document).ready(function() {

        $( "#datepicker1" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#datepicker2" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#timepicker1" ).timepicker({       
          timeFormat: "HH:mm:ss"
        });

        $( "#timepicker2" ).timepicker({       
          timeFormat: "HH:mm:ss"
        });







    });


</script>

@stop