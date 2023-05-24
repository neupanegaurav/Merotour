@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
FXRate Update ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Update FXRate
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        System Setup
			                <span class="icon-angle-right"></span>
			            </li>
			              <li>
			       
			        FX Rate Setting
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>Update FX Rate
			                                    
			                            </li>
			                                           
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

		<!-- FXRate Name -->
			<div class="control-group {{ $errors->has('currency') ? 'error' : '' }}">
				<label class="control-label" for="currency">Currency Name</label>
				<div class="controls">
					<input type="text" name="currency" currency="currency" id="currency" value="{{ Input::old('currency'), $entry->currency }}" />
					{{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			
			<!-- ISO Code -->
			<div class="control-group {{ $errors->has('iso_code') ? 'error' : '' }}">
				<label class="control-label" for="iso_code">ISO Code</label>
				<div class="controls">
					<input type="text" name="iso_code" id="iso_code" value="{{ Input::old('iso_code'), $entry->iso_code }}" />
					{{ $errors->first('iso_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>	

			<!-- Symbol -->
			<div class="control-group {{ $errors->has('symbol') ? 'error' : '' }}">
				<label class="control-label" for="symbol">Symbol</label>
				<div class="controls">
					<input type="text" name="symbol" id="symbol" value="{{ Input::old('symbol'), $entry->symbol }}" />
					{{ $errors->first('symbol', '<span class="help-inline">:message</span>') }}
				</div>
			</div>	

			<!-- Exchange Rate -->
			<div class="control-group {{ $errors->has('exchange_rate') ? 'error' : '' }}">
				<label class="control-label" for="exchange_rate">Exchange Rate</label>
				<div class="controls">
					<input type="text" name="exchange_rate" id="exchange_rate" value="{{ Input::old('exchange_rate'), $entry->exchange_rate }}" />
					{{ $errors->first('exchange_rate', '<span class="help-inline">:message</span>') }}
				</div>
			</div>	
		

	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('fx-rate') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update FXRate</button>
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