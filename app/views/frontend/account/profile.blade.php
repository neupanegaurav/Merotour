@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign in ::
@parent
@stop

{{-- Page content --}}
@section('content')


   <!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
                                <div class="top" style="padding:10px;">
                                    
                                    
                                     <h3>Update your Profile</h3>
                                   
                                </div> <!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">
                                   
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

        
        <!-- company name -->
	<div class="control-group{{ $errors->first('company_name', ' error') }}">
		<label class="control-label" for="company_name">Company Name</label>
		<div class="controls">
			<input class="span4" type="text" name="company_name" id="last_name" value="{{ Input::old('company_name', $user->company_name) }}" />
			{{ $errors->first('company_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        
        
        <!-- company address -->
	<div class="control-group{{ $errors->first('company_address', ' error') }}">
		<label class="control-label" for="company_address">Company Address</label>
		<div class="controls">
			<input class="span4" type="text" name="company_address" id="company_address" value="{{ Input::old('company_address', $user->company_address) }}" />
			{{ $errors->first('company_address', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        
        
        <!-- pan holder name -->
	<div class="control-group{{ $errors->first('pan_holder_name', ' error') }}">
		<label class="control-label" for="pan_holder_name">Pan Holder Name</label>
		<div class="controls">
			<input class="span4" type="text" name="pan_holder_name" id="pan_holder_name" value="{{ Input::old('pan_holder_name', $user->pan_holder_name) }}" />
			{{ $errors->first('pan_holder_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        <!-- pan card number -->
	<div class="control-group{{ $errors->first('pan_card_no', ' error') }}">
		<label class="control-label" for="pan_card_no">Pan card no</label>
		<div class="controls">
			<input class="span4" type="text" name="pan_card_no" id="pan_holder_name" value="{{ Input::old('pan_card_no', $user->pan_card_no) }}" />
			{{ $errors->first('pan_card_no', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        
        
        <!--mobile number-->
        <div class="control-group{{ $errors->first('mobile', ' error') }}">
		<label class="control-label" for="mobile">Mobile</label>
		<div class="controls">
			<input class="span4" type="text" name="mobile" id="mobile" value="{{ Input::old('mobile', $user->mobile) }}" />
			{{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
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
        
<!--        <div class="control-group {{ $errors->has('country_id') ? 'error' : '' }}">
                <label class="control-label" >Country Name</label>
                <div class="controls">
                    <select name="country_id">

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ Input::old('country') == $country->country_id ? 'selected="selected"' : ''  }}   >{{ $country->value }}</option>
                    @endforeach
                    
                    </select>

                    {{ $errors->first('country_id', '<span class="help-inline">:message</span>') }}
                </div>
            </div>-->
        
        
        <div class="control-group" {{ $errors->has('country') ? 'error' : '' }}">
		<label class="control-label" for="country">Country</label>
		<div class="controls">
			<select name="country">

			@foreach($countries as $country)
				<option value="{{ $country->value }}" {{ Input::old('country', $user->country) == $country->id ? 'selected="selected"' : ''  }}   > {{ $country->value }} </option>
			@endforeach
			</select>

			{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
        
        
        
        
        
        
        
        
        
<!--        country name
        
	<div class="control-group{{ $errors->first('country', ' error') }}">
		<label class="control-label" for="country">Country</label>
		<div class="controls">
                    
			<input class="span4" type="text" name="country" id="countury" value="{{ Input::old('country', $user->countries   ) }}" />
			{{ $errors->first('country', '<span class="help-block">:message</span>') }}
		</div>
	</div>-->
        
        
        
        <div class="control-group{{ $errors->first('address', ' error') }}">
		<label class="control-label" for="address">Address</label>
		<div class="controls">
			<input class="span4" type="text" name="address" id="address" value="{{ Input::old('address', $user->address) }}" />
			{{ $errors->first('address', '<span class="help-block">:message</span>') }}
		</div>
	</div>
        
        
        
        
        

<!--country-->

<!-- <div class="control-group {{ $errors->has('country_id') ? 'error' : '' }}">
                <label class="control-label" >Country Name</label>
                <div class="controls">
                    <select name="country_id">

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ Input::old('country') == $country->country_id ? 'selected="selected"' : ''  }}   >{{ $country->value }}</option>
                    @endforeach
                    
                    </select>

                    {{ $errors->first('country_id', '<span class="help-inline">:message</span>') }}
                </div>
            </div>-->

	

	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update your Profile</button>
		</div>
	</div>
</form>
                                   
                                </div> <!-- /Bottom -->
                            </div>
                        </div>
                    </div>
                </div>

              
                       

@stop

