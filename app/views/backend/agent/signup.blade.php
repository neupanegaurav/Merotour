@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Register a new Client ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Register a new Client
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        My Info
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>Register a new Client
			                                    
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
        

<form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- First Name -->
		<div class="control-group{{ $errors->first('first_name', ' error') }}">
		<label class="control-label" for="first_name">First Name</label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
				{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Last Name -->
		<div class="control-group{{ $errors->first('last_name', ' error') }}">
			<label class="control-label" for="last_name">Last Name</label>
			<div class="controls">
				<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
				{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Email -->
		<div class="control-group{{ $errors->first('email', ' error') }}">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Email Confirm -->
		<div class="control-group{{ $errors->first('email_confirm', ' error') }}">
			<label class="control-label" for="email_confirm">Confirm Email</label>
			<div class="controls">
				<input type="text" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" />
				{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password -->
		<div class="control-group{{ $errors->first('password', ' error') }}">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" name="password" id="password" value="" />
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password Confirm -->
		<div class="control-group{{ $errors->first('password_confirm', ' error') }}">
			<label class="control-label" for="password_confirm">Confirm Password</label>
			<div class="controls">
				<input type="password" name="password_confirm" id="password_confirm" value="" />
				{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
			</div>
		</div>
                
                <input type="hidden" name="agent_id" value="{{Sentry::getUser()->id}}">

		

		<!-- Form actions -->
		<div class="control-group">
			<div class="controls">
				<a class="btn" href="{{ route('home') }}">Back</a>

				<button type="submit" class="btn">Sign up</button>
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