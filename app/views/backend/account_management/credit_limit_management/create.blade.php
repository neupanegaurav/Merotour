@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create Credit Request ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Create Credit Request
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account Management
			                <span class="icon-angle-right"></span>
			            </li>
			            <li><a href="{{ route('general-voucher') }}">Credit Limit</a>
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            

			                        <li>Create Credit Request
			                                    
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
						<option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
					
						echo $id;
					@endforeach
					</select>
					{{ $errors->first('user_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 
			  
		
			<div class="control-group {{ $errors->has('amount') ? 'error' : '' }}">
				<label class="control-label" for="amount">Amountt</label>
				<div class="controls">
					<input type="text" name="amount" id="amount" value="{{ Input::old('amount') }}" />
					{{ $errors->first('amount', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('currency') ? 'error' : '' }}">
				<label class="control-label">Currency</label>
				<div class="controls">
					<select name="currency">
						<option>NPR</option>
						<option>USD</option>
					</select>
					{{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('currency') ? 'error' : '' }}">
				<label class="control-label">Debit/Credit</label>
				<div class="controls">
					<select class="status">
						<option>Debit</option>
						<option>Credit</option>
					</select>
					{{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
				</div>
			</div>


			<div class="control-group {{ $errors->has('payment_for') ? 'error' : '' }}">
				<label class="control-label">Payment For</label>
				<div class="controls">
					<input type="text" name="payment_for" value="{{ Input::old('payment_for')}}" />
					{{ $errors->first('payment_for', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                                           
            <div class="control-group {{ $errors->has('status') ? 'error' : '' }}">
				<label class="control-label" for="status">Status</label>
				<div class="controls">
					<select name="status">
						<option>Pending</option>
						<option>Approved</option>
						<option>Unapproved</option>
					</select>
					{{ $errors->first('status', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		
                        
            <div class="control-group {{ $errors->has('remarks') ? 'error' : '' }}">
				<label class="control-label" >Remarks</label>
				<div class="controls">
					<input type="text" name="remarks" value="{{ Input::old('remarks')}}" />
					{{ $errors->first('remarks', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                                                        	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('credit-limit-management') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Credit Request</button>
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
