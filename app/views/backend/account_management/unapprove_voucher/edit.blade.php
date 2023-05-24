@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit Unapproved Voucher ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit Unapproved Voucher
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account Management
			                <span class="icon-angle-right"></span>
			            </li>
			            <li><a href="{{ route('general-voucher') }}">General Voucher</a>
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            

			                        <li>Edit Unapproved Voucher
			                                    
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

				<div class="control-group {{ $errors->has('user_id') ? 'error' : '' }}">
					<label class="control-label" >User</label>
					<div class="controls">
						<select name="status">
						@foreach($users_list as $user)
							<option value="{{ $user->id }}" {{ $entry->user_id == $user->id ? 'selected="selected"' : '' }}>{{ $user->first_name . ' ' . $user->last_name }}</option>
						@endforeach
						</select>
						{{ $errors->first('user_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
        		
				<!-- Payment For -->
				<div class="control-group {{ $errors->has('payment_for') ? 'error' : '' }}">
					<label class="control-label">Payment For</label>
					<div class="controls">
						<input type="text" name="payment_for" value="{{ Input::old('payment_for', $entry->payment_for) }}" />
						{{ $errors->first('payment_for', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Debit/Credit -->
				<div class="control-group {{ $errors->has('currency') ? 'error' : '' }}">
					<label class="control-label">Debit/Credit</label>
					<div class="controls">
						<select name="currency"><option value="debit">Debit</option><option value="credit">Credit</option></select>
						{{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Amount -->
				<div class="control-group {{ $errors->has('amount') ? 'error' : '' }}">
					<label class="control-label">Amount</label>
					<div class="controls">
						<input type="text" name="amount" value="{{ Input::old('amount', $entry->amount) }}" />
						{{ $errors->first('amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Date -->
				<div class="control-group {{ $errors->has('date') ? 'error' : '' }}">
					<label class="control-label" >Date</label>
					<div class="controls">
						<input type="text" name="date" id="datepick1" value="{{ Input::old('date', $entry->date) }}" />
						{{ $errors->first('date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Transaction Id -->
				<div class="control-group {{ $errors->has('transaction_id') ? 'error' : '' }}">
					<label class="control-label" >Transaction Id</label>
					<div class="controls">
						<input type="text" name="transaction_id"  value="{{ Input::old('transaction_id', $entry->transaction_id) }}" />
						{{ $errors->first('transaction_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Currency -->
				<div class="control-group {{ $errors->has('currency') ? 'error' : '' }}">
					<label class="control-label">Currency</label>
					<div class="controls">
						<select name="currency"><option value="NPR">NPR</option></select>
						{{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Deposited In Bank -->
				<div class="control-group {{ $errors->has('deposited_in_bank') ? 'error' : '' }}">
					<label class="control-label">Deposited In Bank</label>
					<div class="controls">
						<select name="deposited_in_bank"><option value="Kist Bank Ltd.">Kist Bank Ltd.</option></select>
						{{ $errors->first('deposited_in_bank', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Bank Branch -->
				<div class="control-group {{ $errors->has('bank_branch') ? 'error' : '' }}">
					<label class="control-label" >Bank Branch</label>
					<div class="controls">
					<select name="bank_branch"><option value="Kist Bhainsepati">Kist Bhainsepati</option></select>
						{{ $errors->first('bank_branch', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Category Name -->
				<div class="control-group {{ $errors->has('category_name') ? 'error' : '' }}">
					<label class="control-label" >Category Name</label>
					<div class="controls">
						<input type="text" name="category_name"  value="{{ Input::old('category_name', $entry->category_name) }}" />
						{{ $errors->first('category_name', '<span class="help-inline">:message</span>') }}
					</div>
				</div> 

				<!-- Package Name -->
				<div class="control-group {{ $errors->has('package_name') ? 'error' : '' }}">
					<label class="control-label" >Package Name</label>
					<div class="controls">
						<input type="text" name="package_name"  value="{{ Input::old('package_name', $entry->package_name) }}" />
						{{ $errors->first('package_name', '<span class="help-inline">:message</span>') }}
					</div>
				</div> 

				<!-- Package Id -->
				<div class="control-group {{ $errors->has('package_id') ? 'error' : '' }}">
					<label class="control-label" >Package Id</label>
					<div class="controls">
						<input type="text" name="package_id"  value="{{ Input::old('package_id', $entry->package_id) }}" />
						{{ $errors->first('package_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div> 

				<!-- Remarks -->
				<div class="control-group {{ $errors->has('remarks') ? 'error' : '' }}">
					<label class="control-label" >Remarks</label>
					<div class="controls">
					<textarea name="remarks">{{ Input::old('remarks', $entry->remarks) }}</textarea>
						{{ $errors->first('remarks', '<span class="help-inline">:message</span>') }}
					</div>
				</div>                                             	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('general-voucher') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit Unapproved Voucher</button>
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

<script type="text/javascript">
	 $(document).ready(function() {
	 		
    //For Reservation form
    $("#datepick1").datepicker({       
          dateFormat: "dd-mm-yy"
        });
       
    }); //Onload


</script>
         
@stop