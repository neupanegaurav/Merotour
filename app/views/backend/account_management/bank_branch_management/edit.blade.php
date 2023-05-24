@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit General Voucher ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit General Voucher
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
			            

			                        <li>Edit General Voucher
			                                    
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
		
			<div class="control-group {{ $errors->has('dr_cr') ? 'error' : '' }}">
				<label class="control-label" for="dr_cr">Dr/Cr</label>
				<div class="controls">
					<input type="text" name="dr_cr" id="dr_cr" value="{{ Input::old('dr_cr', $entry->dr_cr) }}" />
					{{ $errors->first('dr_cr', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group {{ $errors->has('account_name') ? 'error' : '' }}">
				<label class="control-label" for="account_name">Account Name</label>
				<div class="controls">
					<input type="text" name="account_name" id="account_name" value="{{ Input::old('account_name', $entry->account_name) }}" />
					{{ $errors->first('account_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		
                        
            <div class="control-group" {{ $errors->has('narration') ? 'error' : '' }}">
				<label class="control-label" for="narration">Narration</label>
				<div class="controls">
					<input type="text" name="narration" id="narration" value="{{ Input::old('narration', $entry->narration)}}" />
					{{ $errors->first('narration', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('debit') ? 'error' : '' }}">
				<label class="control-label" for="debit">Debit</label>
				<div class="controls">
					<input type="text" name="debit" id="debit" value="{{ Input::old('debit', $entry->debit) }}" />
					{{ $errors->first('debit', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group" {{ $errors->has('credit') ? 'error' : '' }}">
				<label class="control-label" for="credit">Credit</label>
				<div class="controls">
					<input type="text" name="credit" id="credit" value="{{ Input::old('credit', $entry->credit) }}" />
					{{ $errors->first('credit', '<span class="help-inline">:message</span>') }}
				</div>
			</div>                                              	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('general-voucher') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit General Voucher</button>
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
