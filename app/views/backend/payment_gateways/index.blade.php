@extends('backend/layouts/default')
@section('title')
Payment Gateway Settings :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Payment Gateway Settings
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Payment Gateway Settings
                                                
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
           
            <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                                
                                <th class="span2">Settings</th>
                                <th class="span2">Options</th>
                    
                </tr>
            </thead>
            <tbody>



           
                <tr>
                    <td>Paypal</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="paypal_enabled" {{$paypal->enabled == 1 ? 'checked="checked"':''}}  value="1">
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="paypal_enabled"  {{$paypal->enabled == 0 ? 'checked="checked"':''}}  value="0">
                            Disable 
                            </label>
                        </div>           

                        <!-- Paypal Email Address -->
                        <div class="control-group {{ $errors->has('paypal_email_address') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="paypal_email_address">Paypal Email Address</label>
                            <div class="controls">
                                <input type="text" name="paypal_email_address" id="paypal_email_address" value="{{ Input::old('paypal_email_address', 'test5-facilitator@gmail.com') }}" />
                                {{ $errors->first('paypal_email_address', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                    </td>       
                </tr>

                <tr>
                    <td>E-sewa</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="e_sewa"  value="1">
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="e_sewa" checked="" value="0">
                            Disable 
                            </label>
                        </div>

                        <!-- Merchant Username -->
                        <div class="control-group {{ $errors->has('merchant_username') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="merchant_username">Merchant Username</label>
                            <div class="controls">
                                <input type="text" name="merchant_username" id="merchant_username" value="{{ Input::old('merchant_username', 'operations@blackeyejourneys.com') }}" />
                                {{ $errors->first('merchant_username', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                        <!-- Merchant Password -->
                        <div class="control-group {{ $errors->has('merchant_password') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="merchant_password">Merchant Password</label>
                            <div class="controls">
                                <input type="text" name="merchant_password" id="merchant_password" value="{{ Input::old('merchant_password', 'test123') }}" />
                                {{ $errors->first('merchant_password', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                        <!-- Service Code -->
                        <div class="control-group {{ $errors->has('service_code') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="service_code">Service Code</label>
                            <div class="controls">
                                <input type="text" name="service_code" id="service_code" value="{{ Input::old('service_code', 'krishna') }}" />
                                {{ $errors->first('service_code', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>


                    </td>       
                    
                </tr>

                <tr>
                    <td>NIBL</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="nibl"  value="1">
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="nibl" checked="" value="0">
                            Disable 
                            </label>
                        </div>

                         <!-- Merchant Username -->
                        <div class="control-group {{ $errors->has('merchant_username') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="merchant_username">Merchant Username</label>
                            <div class="controls">
                                <input type="text" name="merchant_username" id="merchant_username" value="{{ Input::old('merchant_username', 'test@test.com') }}" />
                                {{ $errors->first('merchant_username', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                        <!-- Merchant Password -->
                        <div class="control-group {{ $errors->has('merchant_password') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="merchant_password">Merchant Password</label>
                            <div class="controls">
                                <input type="text" name="merchant_password" id="merchant_password" value="{{ Input::old('merchant_password', 'test123') }}" />
                                {{ $errors->first('merchant_password', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                        <!-- Service Code -->
                        <div class="control-group {{ $errors->has('service_code') ? 'error' : '' }}" style="margin-top:10px;">
                            <label class="control-label" for="service_code">Service Code</label>
                            <div class="controls">
                                <input type="text" name="service_code" id="service_code" value="{{ Input::old('service_code', 'test') }}" />
                                {{ $errors->first('service_code', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>

                    </td>       
                    
                </tr>

                <tr>
                    <td>Cash</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="cash_enabled" {{$cash->enabled == 1 ? 'checked="checked"':''}}  value="1">
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="cash_enabled" {{$cash->enabled == 0 ? 'checked="checked"':''}} value="0">
                            Disable 
                            </label>
                        </div>
                    </td>       
                    
                </tr>

                <tr>
                    <td>Bank Transfer</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="bank_enabled" {{$bank->enabled == 1 ? 'checked="checked"':''}}  value="1">
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="bank_enabled" {{$bank->enabled == 0 ? 'checked="checked"':''}} value="0">
                            Disable 
                            </label>
                        </div>

                        <br clear="all">

                        <div class="btn-group pull-right" style="margin-bottom:12px;">
                            <a class="btn btn-primary" id="add-row" href="{{route('create/payment-gateways')}}"><i class="icon-pencil"></i> Add</a>            
                        </div>

                        <table class="table table-bordered table-striped table-hover" style="margin-top:12px;">
                            <thead>
                                <tr>
                                                
                                    <th class="span2">SN</th>
                                    <th class="span2">Bank</th>
                                    <th class="span2">Branch</th>
                                    
                                    <th class="span2">Account Name</th>
                                    <th class="span2">Account Number</th>   
                                    <th class="span2">Swift Code</th>
                                    <th class="span2">Company Name</th>                 
                                    <th class="span3">@lang('table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($entries as $entry)
                                
                                <tr>

                                    <td>{{$entry->id}}</td>
                                    <td>{{$entry->bank}}</td> 
                                    <td>{{$entry->branch}}</td>
                                    <td>{{$entry->account_name}}</td>
                                    <td>{{$entry->account_number}}</td>
                                    <td>{{$entry->swift_code}}</td>
                                    <td>{{$entry->company_name}}</td>
                                         
                                             
                                    <td>                                                                                    
                                        <a href="{{route('edit/payment-gateways', $entry->id)}}" class="btn btn-mini">Edit</a>                                            
                                        <a href="{{route('delete/payment-gateways', $entry->id)}}" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
                                    </td>
                                </tr>

                            @endforeach
                                
                            </tbody>
                        </table>

                    </td>       
                    
                </tr> 
                
            </tbody>
        </table>

         <button type="submit" class="btn btn-success pull-right" style="margin-bottom:12px;">Save</button>
     <br clear="all">

    </form>


     


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
