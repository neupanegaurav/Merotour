@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Make Payment ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Make Payment
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>Make Payment
			                                    
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
    <div class="body" style="min-height:600px;">
   
        <!-- BEGIN TABLE DATA -->

	<!-- Tabs -->
	<ul class="nav nav-tabs">
		@if(PGSettings::find(2)->enabled == 1)
		<li class="active" {{ Session::get('tab') == 'cash' ? 'active1' : 'active' }}><a href="#tab-cash" data-toggle="tab">Cash</a></li>
		<?php $count = 1; ?>
		@else 
		<?php $count = 0; ?>
		@endif

		@if(PGSettings::find(3)->enabled == 1)
		<li {{ $count == 0 ? 'class="active"' : ''}}><a href="#tab-bank-transfer" data-toggle="tab">Bank Transfer</a></li>
		<?php $count++; ?>
		@else 
		@endif

		<li {{ $count == 0 ? 'class="active"' : ''}}><a href="#tab-credit-request" data-toggle="tab">Credit Request</a></li>
		
		@if(PGSettings::find(1)->enabled == 1)
		<li><a href="#tab-paypal" data-toggle="tab">Paypal</a></li>
		@endif
	</ul>

    <!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->

		@if(PGSettings::find(2)->enabled == 1)
		<div class="tab-pane active" id="tab-cash">
			<form class="form-horizontal" method="post" action="{{route('make-payment/cash')}}" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />       
					
				<!-- Currency -->
				<div class="control-group {{ $errors->has('cash_currency') ? 'error' : '' }}">
					<label class="control-label">Currency</label>
					<div class="controls">
						<select name="cash_currency"><option value="NPR">NPR</option></select>
						{{ $errors->first('cash_currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Amount -->
				<div class="control-group {{ $errors->has('cash_amount') ? 'error' : '' }}">
					<label class="control-label">Amount</label>
					<div class="controls">
						<input type="text" name="cash_amount" value="{{ Input::old('cash_amount') }}" />
						{{ $errors->first('cash_amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Date -->
				<div class="control-group {{ $errors->has('cash_date') ? 'error' : '' }}">
					<label class="control-label" >Date</label>
					<div class="controls">
						<input type="text" name="cash_date" id="datepick1" value="{{ Input::old('cash_date') }}" />
						{{ $errors->first('cash_date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Transaction Id -->
				<div class="control-group {{ $errors->has('cash_transaction_id') ? 'error' : '' }}">
					<label class="control-label" >Transaction Id</label>
					<div class="controls">
						<input type="text" name="cash_transaction_id"  value="{{ Input::old('cash_transaction_id') }}" />
						{{ $errors->first('cash_transaction_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Deposited In Bank -->
				<div class="control-group {{ $errors->has('cash_deposited_in_bank') ? 'error' : '' }}">
					<label class="control-label">Deposited In Bank</label>
					<div class="controls">
						<select name="cash_deposited_in_bank">
							<?php $banks = MyBankAccount::all(); ?>
							@foreach($banks as $bank)
							<option value="{{$bank->bank}}">{{$bank->bank}}</option>
							@endforeach
						</select>
						{{ $errors->first('cash_deposited_in_bank', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Bank Branch -->
				<div class="control-group {{ $errors->has('cash_bank_branch') ? 'error' : '' }}">
					<label class="control-label" >Bank Branch</label>
					<div class="controls">
						<input type="text" name="cash_bank_branch"  value="{{ Input::old('cash_transaction_id') }}" />
						{{ $errors->first('cash_bank_branch', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Remarks -->
				<div class="control-group {{ $errors->has('cash_remarks') ? 'error' : '' }}">
					<label class="control-label" >Remarks</label>
					<div class="controls">
					<textarea name="cash_remarks">{{ Input::old('cash_remarks') }}</textarea>
						{{ $errors->first('cash_remarks', '<span class="help-inline">:message</span>') }}
					</div>
				</div>	
				<!-- Form Actions -->
				<div class="control-group">
					<div class="controls">
						<a class="btn btn-link" href="{{ route('users') }}">Back</a>

						<button type="reset" class="btn">Reset</button>

						<button type="submit" class="btn btn-success">Make Payment</button>
					</div>
				</div>
			</form>		
		</div>
		@endif
		
		@if(PGSettings::find(3)->enabled == 1)        
		<!-- Bank Transfer tab -->
		<div class="tab-pane {{ $count == 0 ? 'active' : ''}}" id="tab-bank-transfer">
			<form class="form-horizontal" method="post" action="{{route('make-payment/bank-transfer')}}" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />       
					
				<!-- Currency -->
				<div class="control-group {{ $errors->has('bank_transfer_currency') ? 'error' : '' }}">
					<label class="control-label">Currency</label>
					<div class="controls">
						<select name="bank_transfer_currency"><option value="NPR">NPR</option></select>
						{{ $errors->first('bank_transfer_currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Amount -->
				<div class="control-group {{ $errors->has('bank_transfer_amount') ? 'error' : '' }}">
					<label class="control-label">Amount</label>
					<div class="controls">
						<input type="text" name="bank_transfer_amount" value="{{ Input::old('bank_transfer_amount') }}" />
						{{ $errors->first('bank_transfer_amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Date -->
				<div class="control-group {{ $errors->has('bank_transfer_date') ? 'error' : '' }}">
					<label class="control-label" >Date</label>
					<div class="controls">
						<input type="text" name="bank_transfer_date" id="datepick2" value="{{ Input::old('bank_transfer_date') }}" />
						{{ $errors->first('bank_transfer_date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Transaction Id -->
				<div class="control-group {{ $errors->has('bank_transfer_transaction_id') ? 'error' : '' }}">
					<label class="control-label" >Transaction Id</label>
					<div class="controls">
						<input type="text" name="bank_transfer_transaction_id"  value="{{ Input::old('bank_transfer_transaction_id') }}" />
						{{ $errors->first('bank_transfer_transaction_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Deposited In Bank -->
				<div class="control-group {{ $errors->has('bank_transfer_deposited_in_bank') ? 'error' : '' }}">
					<label class="control-label">Deposited In Bank</label>
					<div class="controls">
						<select name="bank_transfer_deposited_in_bank">
						<?php $banks = MyBankAccount::all(); ?>
							@foreach($banks as $bank)
							<option value="{{$bank->bank}}">{{$bank->bank}}</option>
							@endforeach
						</select>
						{{ $errors->first('bank_transfer_deposited_in_bank', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Bank Branch -->
				<div class="control-group {{ $errors->has('bank_transfer_bank_branch') ? 'error' : '' }}">
					<label class="control-label" >Bank Branch</label>
					<div class="controls">
					<input type="text" name="bank_transfer_bank_branch"  value="{{ Input::old('bank_transfer_transaction_id') }}" />
						{{ $errors->first('bank_transfer_bank_branch', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Remarks -->
				<div class="control-group {{ $errors->has('bank_transfer_remarks') ? 'error' : '' }}">
					<label class="control-label" >Remarks</label>
					<div class="controls">
					<textarea name="bank_transfer_remarks">{{ Input::old('bank_transfer_remarks') }}</textarea>
						{{ $errors->first('bank_transfer_remarks', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- Form Actions -->
				<div class="control-group">
					<div class="controls">
						<a class="btn btn-link" href="{{ route('users') }}">Back</a>

						<button type="reset" class="btn">Reset</button>

						<button type="submit" class="btn btn-success">Make Payment</button>
					</div>
				</div>
			</form>	
		</div> <!-- /Bank Transfer Tab -->
		@endif

		<!-- Credit Request tab -->
		<div class="tab-pane {{ $count == 0 ? 'active' : ''}}" id="tab-credit-request">

			<form class="form-horizontal" method="post" action="{{route('make-payment/credit-request')}}" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />       
					
				<!-- Currency -->
				<div class="control-group {{ $errors->has('credit_request_currency') ? 'error' : '' }}">
					<label class="control-label">Currency</label>
					<div class="controls">
						<select name="credit_request_currency"><option value="NPR">NPR</option></select>
						{{ $errors->first('credit_request_currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Amount -->
				<div class="control-group {{ $errors->has('credit_request_amount') ? 'error' : '' }}">
					<label class="control-label">Amount</label>
					<div class="controls">
						<input type="text" name="credit_request_amount" value="{{ Input::old('credit_request_amount') }}" />
						{{ $errors->first('credit_request_amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Start Date -->
				<div class="control-group {{ $errors->has('credit_request_start_date') ? 'error' : '' }}">
					<label class="control-label">Start Date</label>
					<div class="controls">
						<input type="text" id="start_date" name="credit_request_start_date" value="{{ Input::old('credit_request_start_date') }}" />
						{{ $errors->first('credit_request_start_date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Expire Date -->
				<div class="control-group {{ $errors->has('credit_request_expire_date') ? 'error' : '' }}">
					<label class="control-label">Expire Date</label>
					<div class="controls">
						<input type="text" id="expire_date" name="credit_request_expire_date" value="{{ Input::old('credit_request_expire_date') }}" />
						{{ $errors->first('credit_request_expire_date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Remarks -->
				<div class="control-group {{ $errors->has('credit_request_remarks') ? 'error' : '' }}">
					<label class="control-label" >Remarks</label>
					<div class="controls">
					<textarea name="credit_request_remarks">{{ Input::old('credit_request_remarks') }}</textarea>
						{{ $errors->first('credit_request_remarks', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- Form Actions -->
				<div class="control-group">
					<div class="controls">
						<a class="btn btn-link" href="{{ route('users') }}">Back</a>

						<button type="reset" class="btn">Reset</button>

						<button type="submit" class="btn btn-success">Make Payment</button>
					</div>
				</div>
			</form>
		</div>

		@if(PGSettings::find(1)->enabled == 1)
		<!-- Paypal tab -->
		<div class="tab-pane" id="tab-paypal">

			<form class="form-horizontal" method="post" action="{{ URL::to('paypal/paypal.php?sandbox=1') }}" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />

				@if($user = Sentry::getUser())

	        <input type="hidden" name="action" value="process" />
	        <input type="hidden" name="cmd" value="_cart" /> <?php // use _cart for cart checkout ?>
	        <input type="hidden" name="currency_code" value="USD" />
	        <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />
	    
	        <input type='hidden' name="product_id" value="1" />   
	        
	        <input type='hidden' name="product_name" value="Make Payment" />
	   
	        <input type='hidden' name="product_quantity" value="1" />
	    
	        <input type='hidden' name="payer_fname" value="{{$user->first_name}}" />
	    
	        <input type='hidden' name="payer_lname" value="{{$user->last_name}}" />
	   
	        <input type='hidden' name="payer_address" value="Address of me" />
	    
	        <input type='hidden' name="payer_city" value="City of me" />
	    
	        <input type='hidden' name="payer_state" value="State of me" />
	    
	        <input type='hidden' name="payer_zip" value="123456" />
	    
	        <input type='hidden' name="payer_country" value="US" />
	    
	        <input type='hidden' name="payer_email" value="{{$user->email}}" />
	    
        	@endif    

        		<!-- Amount -->
				<div class="control-group {{ $errors->has('product_amount') ? 'error' : '' }}">
					<label class="control-label">Amount (USD)</label>
					<div class="controls">
						<input type="text" name="product_amount" value="100" />
						{{ $errors->first('product_amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>   
					
				
				<!-- Form Actions -->
				<div class="control-group">
					<div class="controls">
						<a class="btn btn-link" href="{{ route('users') }}">Back</a>

						<button type="reset" class="btn">Reset</button>

						<input type="submit" name="search" value="" style="box-shadow:none; outline:none; border:0px; width: 200px; height:26px; background:url('{{asset('assets/img/paypal_checkout.gif')}}') no-repeat;" >

					</div>
				</div>

			</form>
		</div>
		@endif



	</div>


        

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop

@section('currentpagejs')

<style>
#ui-datepicker-div {
	top:160px !important;
}
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

<script type="text/javascript">

    $(document).ready(function() {

        $("#datepick1").datepicker({       
              dateFormat: "yy-mm-dd"
        });
        $("#datepick2").datepicker({       
              dateFormat: "yy-mm-dd"
        });
        $("#datepick3").datepicker({       
              dateFormat: "yy-mm-dd"
        });

        $( "#start_date" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#expire_date" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

    });

</script>



@stop

