@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Update your Profile ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Update your Profile
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        My Info
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>Update your Profile
			                                    
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
        

 <form method="post" action="" class="form-vertical" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- First Name -->
	<div class="control-group{{ $errors->first('first_name', ' error') }}">
		<label class="control-label" for="first_name">First Name</label>
		<div class="controls">
			<input class="span4" type="text" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}" />
			{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Last Name -->
	<div class="control-group{{ $errors->first('last_name', ' error') }}">
		<label class="control-label" for="last_name">Last Name</label>
		<div class="controls">
			<input class="span4" type="text" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}" />
			{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Website URL -->
	<div class="control-group{{ $errors->first('website', ' error') }}">
		<label class="control-label" for="website">Website URL</label>
		<div class="controls">
			<input class="span4" type="text" name="website" id="website" value="{{ Input::old('website', $user->website) }}" />
			{{ $errors->first('website', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Country -->
        
        
        
<!--	<div class="control-group" {{ $errors->has('country') ? 'error' : '' }}">
		<label class="control-label" for="country">Country</label>
		<div class="controls">
			<select name="country">

			@foreach($countries as $country)
				<option value="{{ $country->id }}" {{ Input::old('country', $user->country) == $country->id ? 'selected="selected"' : ''  }}   > {{ $country->value }} </option>
			@endforeach
			</select>

			{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
		</div>
	</div>-->

	<!-- Company Name -->
	<div class="control-group {{ $errors->has('company_name') ? 'error' : '' }}">
		<label class="control-label" for="company_name">Company Name</label>
		<div class="controls">
			<input type="text" name="company_name" id="company_name" value="{{ Input::old('company_name', $user->company_name) }}" />
			{{ $errors->first('company_name', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<!-- Company Address -->
	<div class="control-group {{ $errors->has('company_address') ? 'error' : '' }}">
		<label class="control-label" for="company_address">Company Address</label>
		<div class="controls">
			<input type="text" name="company_address" id="company_address" value="{{ Input::old('company_address', $user->company_address) }}" />
			{{ $errors->first('company_address', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<!-- PAN Holder Name -->
	<div class="control-group {{ $errors->has('pan_holder_name') ? 'error' : '' }}">
		<label class="control-label" for="pan_holder_name">PAN Holder Name</label>
		<div class="controls">
			<input type="text" name="pan_holder_name" id="pan_holder_name" value="{{ Input::old('pan_holder_name', $user->pan_holder_name) }}" />
			{{ $errors->first('pan_holder_name', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
        
        
        <div class="control-group{{ $errors->first('mobile', ' error') }}">
		<label class="control-label" for="mobile">Mobile</label>
		<div class="controls">
			<input class="span4" type="text" name="mobrile" id="mobile" value="{{ Input::old('mobile', $user->mobile) }}" />
			{{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        
        
        
        

	<!-- PAN Card No. -->
	<div class="control-group {{ $errors->has('pan_card_no') ? 'error' : '' }}">
		<label class="control-label" for="pan_card_no">PAN Card No.</label>
		<div class="controls">
			<input type="text" name="pan_card_no" id="pan_card_no" value="{{ Input::old('pan_card_no', $user->pan_card_no) }}" />
			{{ $errors->first('pan_card_no', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update your Profile</button>
		</div>
	</div>
</form>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         





<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

@stop

