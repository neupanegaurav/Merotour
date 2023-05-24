@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit Bank ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit Bank
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Payment Gateways
			                <span class="icon-angle-right"></span>
			            </li>
			            <li><a href="{{ route('general-voucher') }}">General Voucher</a>
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            
			                        <li>Edit Bank
			                                    
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

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		
			<div class="control-group {{ $errors->has('bank_name') ? 'error' : '' }}">
				<label class="control-label" for="bank_name">Bank Name</label>
				<div class="controls">
					<input type="text" name="bank_name" id="bank_name" value="{{ Input::old('bank_name', $entry->bank) }}" />
					{{ $errors->first('bank_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('bank_branch') ? 'error' : '' }}">
				<label class="control-label" for="bank_branch">Bank Branch</label>
				<div class="controls">
					<input type="text" name="bank_branch" id="bank_branch" value="{{ Input::old('bank_branch', $entry->branch) }}" />
					{{ $errors->first('bank_branch', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group {{ $errors->has('account_name') ? 'error' : '' }}">
				<label class="control-label" for="account_name">Account Name</label>
				<div class="controls">
					<input type="text" name="account_name" id="account_name" value="{{ Input::old('account_name', $entry->account_name) }}" />
					{{ $errors->first('account_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		                   
            <div class="control-group" {{ $errors->has('account_number') ? 'error' : '' }}">
				<label class="control-label" for="account_number">Account Number</label>
				<div class="controls">
					<input type="text" name="account_number" id="account_number" value="{{ Input::old('account_number', $entry->account_number)}}" />
					{{ $errors->first('account_number', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('swift_code') ? 'error' : '' }}">
				<label class="control-label" for="swift_code">Swift Code</label>
				<div class="controls">
					<input type="text" name="swift_code" id="swift_code" value="{{ Input::old('swift_code', $entry->swift_code) }}" />
					{{ $errors->first('swift_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group" {{ $errors->has('company_name') ? 'error' : '' }}">
				<label class="control-label" for="company_name">Company Name</label>
				<div class="controls">
					<input type="text" name="company_name" id="company_name" value="{{ Input::old('company_name', $entry->company_name) }}" />
					{{ $errors->first('company_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>                                              	

			<!-- Form Actions -->
			<div class="control-group">
				<div class="controls">
					<a class="btn btn-link" href="{{ route('payment-gateways') }}">Back</a>

					<button type="reset" class="btn">Reset</button>

					<button type="submit" class="btn btn-success">Edit Bank</button>
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