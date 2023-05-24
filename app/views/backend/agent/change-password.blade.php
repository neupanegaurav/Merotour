@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Change your password ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Change your password
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        My Info
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>Change your password
			                                    
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
        

<form method="post" action="" class="form-horizontal" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Old Password -->
	<div class="control-group{{ $errors->first('old_password', ' error') }}">
		<label class="control-label" for="old_password">Old Password</label>
		<div class="controls">
			<input type="password" name="old_password" id="old_password" value="" />
			{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- New Password -->
	<div class="control-group{{ $errors->first('password', ' error') }}">
		<label class="control-label" for="password">New Password</label>
		<div class="controls">
			<input type="password" name="password" id="password" value="" />
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Confirm New Password  -->
	<div class="control-group{{ $errors->first('password_confirm', ' error') }}">
		<label class="control-label" for="password_confirm">Confirm New Password</label>
		<div class="controls">
			<input type="password" name="password_confirm" id="password_confirm" value="" />
			{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update Password</button>

			<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
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

