@extends('backend/layouts/default')
@section('title')
New Booking :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                New Booking
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Booking
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>New Booking
                                                
                                        </li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
    <div class="header">
    

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body"> 

        <form class="form-horizontal" method="post" action="" autocomplete="off">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input id="inc" type="hidden" name="inc" value="1">
                
            <table class="table table-bordered table-striped table-hover pull-left" style="width:300px; margin:10px; margin-left:0px;">
                <thead>
                    <tr>
                        <th>Account Detail</th>
                    </tr>
                    <tr>
                                    <th class="span2"></th>
                                    <th class="span2">NPR</th>
                                    <th class="span2">USD</th>
                    </tr>
                </thead>
                <tbody>
               
                    <tr>
                        <td>Credit Limit</td>
                        <td>
                            <?php $user = User::where('id', Sentry::getUser()->id)->first(); ?>

                            {{$user->credit_limit}}
                        </td> 
                        <td></td>               
                    </tr>

                    <tr>
                        <td>Available Balance</td>
                        <td id="balance">

                        </td> 
                        <td></td>               
                    </tr>

                     <tr>
                        <td>Ledger Balance</td>
                        <td></td> 
                        <td></td>               
                    </tr>       
                </tbody>
            </table>

            <div class="pull-left">

                <table class="table table-bordered table-striped table-hover" style="width:300px; margin:10px;">
                    <thead>

                        <tr>
                                        <th class="span2">User Role</th>
                                       
                        </tr>
        
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td id="userrole"></td>                            
                        </tr>

                      
                    </tbody>
                </table>

                <table class="table table-bordered table-striped table-hover" style="width:300px; margin:10px;">
                    <thead>

                        <tr>
                                        <th class="span2">Branch</th>
                                        <th class="span2">Distributor</th>            
                        </tr>
        
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td id="branch">  </td>    
                            <td id="distributor">  </td>                        
                        </tr>

                    </tbody>
                </table>

            </div>

            <table class="table table-bordered table-striped table-hover pull-left" style="width:300px; margin:10px;">
                <thead>
                    <tr>
                        <th>User Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>User</td>
                        <td>
                            <select id="users_list" name="user">
                                <?php 
                                    $userprovider = Sentry::getUserProvider();
                                 
                                ?>

                                @foreach($users_list as $user)

                                 <?php 

                                    $current_user = $userprovider->findById($user->id);

                                    $groups = $current_user->groups()->get();

                                    $funds= Funds::where('user_id', $user->id)->first();

                                 ?>

                                    <option value="{{ $user->id }}" balance="{{ isset($funds) ? $funds->balance : '0'  }}" userrole="{{ $groups[0]->name }}" address="{{ $user->address }}" mobile="{{ $user->mobile }}">
                                        {{ $user->first_name . ', ' . $user->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>               
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td><input id="address" type="text" name="address"></td>               
                    </tr>

                     <tr>
                        <td>Mobile</td>
                        <td><input id="mobile" type="text" name="mobile"></td>               
                    </tr>       
                </tbody>
            </table>

            <br clear="all">


            <div>

            <style type="text/css">

            div .control-label {width: 100px !important; }

            </style>

                <div style="margin-bottom:12px;">
                    <div class="control-group pull-left {{ $errors->has('api') ? 'error' : '' }}">
                        <label class="control-label">Source Using</label>
                        <div class="controls">
                            <select name="api"><option>United Solutions</option><option>Travel Port</option></select>
                            {{ $errors->first('api', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    
                    <div class="control-group pull-left {{ $errors->has('gds_pnr') ? 'error' : '' }}">
                        <label class="control-label">GDS PNR</label>
                        <div class="controls">
                            <input type="text" name="gds_pnr" value="{{ Input::old('gds_pnr') }}" />
                            {{ $errors->first('gds_pnr', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <div class="control-group pull-left {{ $errors->has('pcc') ? 'error' : '' }}">
                        <label class="control-label">PCC</label>
                        <div class="controls">
                            <input type="text" name="pcc" value="{{ Input::old('pcc') }}" />
                            {{ $errors->first('pcc', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <div class="control-group pull-left {{ $errors->has('remarks') ? 'error' : '' }}">
                        <label class="control-label">Remarks</label>
                        <div class="controls">
                            <input type="text" name="remarks" value="{{ Input::old('remarks') }}" />
                            {{ $errors->first('remarks', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>PNR Information</th>
                        </tr>
                        <tr>
                            <th class="span2">Prefix</th>
                            <th class="span2">First Name</th>
                            <th class="span2">Last name</th>              
                        </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td>
                                <div class="control-group {{ $errors->has('contact_prefix') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="contact_prefix" value="{{Input::old('contact_prefix')}}" />
                                    {{ $errors->first('contact_prefix', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('contact_first_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="contact_first_name" value="{{Input::old('contact_first_name')}}" />
                                    {{ $errors->first('contact_first_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="control-group {{ $errors->has('contact_last_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="contact_last_name" value="{{Input::old('contact_last_name')}}" />
                                    {{ $errors->first('contact_last_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                        </tr>  
                    </tbody>
                </table>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="7">Passenger Information <div id="add_new" class="btn btn-success pull-right">Add New</div></th>
                        </tr>
                        <tr>
                            <th class="span2">Pax Type</th>
                            <th class="span2">Prefix</th>
                            <th class="span2">First Name</th>
                            <th class="span2">Last name</th>
                            <th class="span2">Ticket No.</th>
                            <th class="span2">DOB</th> 
                            <th class="span2">Action</th>            
                        </tr>
                    </thead>
                    <tbody id="passengers">
                   
                        <tr>
                            <td>
                                <select name="passenger1_pax_type" style="width:80px;"><option>Adult</option><option>Child</option></select>                            
                            </td>
                            <td>
                                 <div class="control-group {{ $errors->has('passenger1_title') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:80px;" type="text" name="passenger1_title" value="" />
                                    {{ $errors->first('passenger1_title', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_first_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="passenger1_first_name" value="" />
                                    {{ $errors->first('passenger1_first_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                 <div class="control-group {{ $errors->has('passenger1_last_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="passenger1_last_name" value="" />
                                    {{ $errors->first('passenger1_last_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_ticket_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="passenger1_ticket_no" value="" />
                                    {{ $errors->first('passenger1_ticket_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_dob') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input id="datepick3" style="width:100px;" type="text" name="passenger1_dob" value="" />
                                    {{ $errors->first('passenger1_dob', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="btn btn-mini btn-danger disabled">Remove</div>
                            </td>

                        </tr>  
                    </tbody>
                </table>

                     
                <table class="table table-bordered table-striped table-hover">
                    <thead>

                        <tr>
                            <th colspan="9">Segment Information <div id="simple-msg"></div><div id="recheck" class="btn btn-info pull-right">Re-check</div></th>
                        </tr>
                        <tr>
                            <th class="span2">Airline</th>
                            <th class="span2">Flight No.</th>
                            <th class="span2">Class</th>
                            <th class="span2">From</th>
                            <th class="span2">Departure Date(Time)</th>
                            <th class="span2">To</th>
                            <th class="span2">Arrival Date(Time)</th>
                            <th class="span2">Airline PNR</th>
                            <th class="span2">Baggage</th>      
                        </tr>
                    </thead>
                    <tbody>


   
                    
                   
                        <tr>
                            <td>
                                <div class="control-group {{ $errors->has('airline') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="airline" value="{{Input::old('airline')}}" />
                                    {{ $errors->first('airline', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('flight_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="flight_no" value="{{Input::old('flight_no')}}" />
                                    {{ $errors->first('flight_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="control-group {{ $errors->has('class_code') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="class_code" value="{{Input::old('class_code')}}" />
                                    {{ $errors->first('class_code', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('departure') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="departure" value="{{Input::old('departure')}}" />
                                    {{ $errors->first('departure', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="control-group {{ $errors->has('issue_date') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input id="datepick2" style="width:100px;" type="text" name="issue_date" value=" {{Input::old('issue_date')}}" />
                                    {{ $errors->first('issue_date', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                                                   
                            </td>

                            <td>
                                <div class="control-group {{ $errors->has('arrival') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="arrival" value="{{Input::old('arrival')}}" />
                                    {{ $errors->first('arrival', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="control-group {{ $errors->has('flight_date') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="flight_date" value="{{Input::old('flight_date')}}" />
                                    {{ $errors->first('flight_date', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            

                            <td>
                                <div class="control-group {{ $errors->has('pnr_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input id="datepick" class="ui-datepicker" style="width:100px;" type="text" name="pnr_no" value="{{Input::old('pnr_no')}}" />
                                    {{ $errors->first('pnr_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="control-group {{ $errors->has('free_baggage') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="free_baggage" value="{{Input::old('free_baggage')}}" />
                                    {{ $errors->first('free_baggage', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            
                            </td>

                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Fare Information</th>
                        </tr>
                        <tr>
                            <th class="span2" colspan="2">Purchase</th>
                            <th class="span2" colspan="2">Sales</th>             
                        </tr>
                         <tr>
                            <th class="span2" colspan="4">Currency NPR</th>             
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pax Type</td>
                            <td><select style="width:80px;"><option>Adult</option><option>Child</option></select></td> 
                            <td>Markup</td>
                            <td>
                                <div class="control-group {{ $errors->has('markup') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="markup" value="{{ Input::old('markup')}}"/>
                                    {{ $errors->first('markup', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Base Fare</td>
                            <td>
                                <div class="control-group {{ $errors->has('base_fare') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="base_fare" value="{{ Input::old('base_fare')}}" />
                                    {{ $errors->first('base_fare', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling BF</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_bf') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_bf" value="{{ Input::old('selling_bf')}}" />
                                    {{ $errors->first('selling_bf', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr> 

                        <tr>
                            <td>Additional Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('additional_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="additional_txn_fee" value="{{Input::old('additional_txn_fee')}}" />
                                    {{ $errors->first('additional_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling Additional Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_additional_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_additional_txn_fee" value="{{Input::old('selling_additional_txn_fee')}}" />
                                    {{ $errors->first('selling_additional_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>Airline Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('airline_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="airline_txn_fee" value="{{Input::old('airline_txn_fee')}}" />
                                    {{ $errors->first('airline_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling Airline Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_airline_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_airline_txn_fee" value="{{Input::old('selling_airline_txn_fee')}}" />
                                    {{ $errors->first('selling_airline_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="tax" value="{{Input::old('tax')}}" />
                                    {{ $errors->first('tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_tax" value="{{Input::old('selling_tax')}}" />
                                    {{ $errors->first('selling_tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>Service Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('service_tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="service_tax" value="{{Input::old('service_tax')}}" />
                                    {{ $errors->first('service_tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling Service Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_service_tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_service_tax" value="{{Input::old('selling_service_tax')}}" />
                                    {{ $errors->first('selling_service_tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>FSC</td>
                            <td>
                                <div class="control-group {{ $errors->has('fsc') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="fsc" value="{{Input::old('fsc')}}" />
                                    {{ $errors->first('fsc', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling FSC</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_fsc') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_fsc" value="{{Input::old('selling_fsc')}}" />
                                    {{ $errors->first('selling_fsc', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>Commission</td>
                            <td>
                                <div class="control-group {{ $errors->has('commission') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="commission" value="{{Input::old('commission')}}" />
                                    {{ $errors->first('commission', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Discount</td>
                            <td>
                                <div class="control-group {{ $errors->has('discount') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="discount" value="{{Input::old('discount')}}" />
                                    {{ $errors->first('discount', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>Other Charges</td>
                            <td>
                                <div class="control-group {{ $errors->has('other_charges') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="other_charges" value="{{Input::old('other_charges')}}" />
                                    {{ $errors->first('other_charges', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>Selling Other Charges</td>
                            <td>
                                <div class="control-group {{ $errors->has('selling_other_charges') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="selling_other_charges" value="{{Input::old('selling_other_charges')}}" />
                                    {{ $errors->first('selling_other_charges', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                        </tr>
                    </tbody>
                </table>
            </div>

        

            <!-- Form Actions -->
            <div class="control-group">
                <div class="controls">
                    <a class="btn btn-link" href="{{ route('general-voucher') }}">Back</a>

                    <button type="reset" class="btn">Reset</button>

                    <button type="submit" class="btn btn-success">Process Booking</button>
                </div>
            </div>
        </form>



<br clear="all">
        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>

@stop


@section('currentpagejs')

<script type="text/javascript">

    $(document).ready(function() {

    
        $("#datepick").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick2").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick3").datepicker({       
              dateFormat: "dd-mm-yy"
            });

        inc = 2;

        $('#add_new').click(function(){   
            $('#inc').val(inc);        
            $('#passengers').append('<tr id="passenger'+ inc +'"><td><select name="passenger'+inc+'_pax_type" style="width:80px;"><option>Adult</option><option>Child</option></select></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:80px;" type="text" name="passenger'+ inc +'_title" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:200px;" type="text" name="passenger'+ inc +'_first_name" value="" /></div></div></td> <td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:200px;" type="text" name="passenger'+ inc +'_last_name" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:100px;" type="text" name="passenger'+ inc +'_ticket_no" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input id="dob'+inc+'" style="width:100px;" type="text" name="passenger'+ inc +'_dob" value="" /></div></div></td><td><div id="remove" value="'+ inc +'" class="btn btn-mini btn-danger">Remove</div></td></tr>');
            $("#dob"+inc).datepicker({       
              dateFormat: "dd-mm-yy"
            });
            inc++;              
        });

        $("#passengers").on('click', '#remove', function() {
             passenger_id = $(this).attr('value'); 

             //alert(passenger_id);

             $('#passenger'+ passenger_id).remove();
            inc--; 

        });

             balance = $('#users_list option:selected').attr('balance');
             userrole = $('#users_list option:selected').attr('userrole');
             address = $('#users_list option:selected').attr('address');
             mobile = $('#users_list option:selected').attr('mobile'); 

             $('#balance').text(balance);
             $('#userrole').text(userrole);
             $('#address').val(address);
             $('#mobile').val(mobile);

        $("#users_list").change(function() {

             balance = $(this).find('option:selected').attr('balance');
             userrole = $(this).find('option:selected').attr('userrole');
             address = $(this).find('option:selected').attr('address');
             mobile = $(this).find('option:selected').attr('mobile'); 

            

             $('#balance').text(balance);
             $('#userrole').text(userrole);
             $('#address').val(address);
             $('#mobile').val(mobile);

            
        });
        
        

    /*$("#recheck").click(function()
        {


            $("#ajaxform").submit(function(e)
            {

                alert("test");
                $("#simple-msg").html("Test");
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
                $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success:function(data, textStatus, jqXHR) 
                    {
                        $("#simple-msg").html('<pre><code class="prettyprint">'+data+'</code></pre>');

                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        $("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
                    }
                });
                e.preventDefault(); //STOP default action
                e.unbind();
            });
                
            $("#ajaxform").submit(); //SUBMIT FORM
        });*/

    }); //Onload

</script>



@stop