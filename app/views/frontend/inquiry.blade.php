@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Inquiry Form::
@parent
@stop

{{-- Page content --}}
@section('content')

<style>
    #maincont {background: #fff; margin-top:20px; padding:5px;}
</style>

<div id="maincont">
<div class="page-header">
	<h3>Inquiry Form</h3>
       
</div>

<?php echo Session::get('message'); ?>

<form method="post" action="">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<fieldset>
            
             <h4>Trip Details</h4>
                <!-- Interested in -->
		<div  class="control-group{{ $errors->first('interested_in', ' error') }}">
			<input type="text" id="interested_in" name="interested_in" class="input-block-level" placeholder="Interested in">
			{{ $errors->first('name', '<span class="help-block">:message</span>') }}
		</div>
                
                <!-- No. of Person -->
		<div  class="control-group{{ $errors->first('noofperson', ' error') }}">
			<input type="text" id="noofperson" name="noofperson" class="input-block-level" placeholder="No. of Person">
			{{ $errors->first('noofperson', '<span class="help-block">:message</span>') }}
		</div>
                
                <h4>Personal Details</h4>
                
                <!-- Name -->
		<div  class="control-group{{ $errors->first('name', ' error') }}">
			<input type="text" id="name" name="name" class="input-block-level" placeholder="Name">
			{{ $errors->first('name', '<span class="help-block">:message</span>') }}
		</div>
                
                <!-- Email -->
		<div  class="control-group{{ $errors->first('email', ' error') }}">
			<input type="text" id="email" name="email" class="input-block-level" placeholder="Email">
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>
                
                 <!-- Address -->
		<div  class="control-group{{ $errors->first('address', ' error') }}">
			<input type="text" id="address" name="address" class="input-block-level" placeholder="Address">
			{{ $errors->first('address', '<span class="help-block">:message</span>') }}
		</div>
                 
                 <!-- Country -->
		<div  class="control-group{{ $errors->first('country', ' error') }}">
			<input type="text" id="country" name="country" class="input-block-level" placeholder="Country">
			{{ $errors->first('address', '<span class="help-block">:message</span>') }}
		</div>
                
                 <!-- Telephone -->
		<div  class="control-group{{ $errors->first('telephone', ' error') }}">
			<input type="text" id="telephone" name="telephone" class="input-block-level" placeholder="Telephone/Mobile">
			{{ $errors->first('telephone', '<span class="help-block">:message</span>') }}
		</div>
		

		
		<!-- Description -->
		<div  class="control-group{{ $errors->first('description', ' error') }}">
			<textarea rows="4" id="description" name="description" class="input-block-level" placeholder="Description"></textarea>
			{{ $errors->first('description', '<span class="help-block">:message</span>') }}
		</div>

		<!-- Form actions -->
		<button type="submit" class="btn btn-warning pull-right">Submit</button>
	</fieldset>
</form>
    
</div>
@stop
