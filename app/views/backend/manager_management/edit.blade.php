@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Manager Update ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Manager Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Manager Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Update Manager
			                                    
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
        
<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
	<li><a href="#tab-company-info" data-toggle="tab">Company Info</a></li>
</ul>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- First Name -->
			<div class="control-group {{ $errors->has('first_name') ? 'error' : '' }}">
				<label class="control-label" for="first_name">First Name</label>
				<div class="controls">
					<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}" />
					{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Last Name -->
			<div class="control-group {{ $errors->has('last_name') ? 'error' : '' }}">
				<label class="control-label" for="last_name">Last Name</label>
				<div class="controls">
					<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}" />
					{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Email -->
			<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<input type="text" name="email" id="email" value="{{ Input::old('email', $user->email) }}" />
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password -->
			<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password Confirm -->
			<div class="control-group {{ $errors->has('password_confirm') ? 'error' : '' }}">
				<label class="control-label" for="password_confirm">Confirm Password</label>
				<div class="controls">
					<input type="password" name="password_confirm" id="password_confirm" value="" />
					{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Activation Status -->
			<div class="control-group {{ $errors->has('activated') ? 'error' : '' }}">
				<label class="control-label" for="activated">Manager Activated</label>
				<div class="controls">
					<select{{ ($user->id == Sentry::getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
						<option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
						<option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.no')</option>
					</select>
					{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Manager Credit Limit -->
			<div class="control-group {{ $errors->has('credit_limit') ? 'error' : '' }}">
				<label class="control-label">Manager Credit Limit</label>
				<div class="controls">
					<input type="text" name="credit_limit"  value="{{ Input::old('credit_limit', $user->credit_limit) }}" />
					{{ $errors->first('credit_limit', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>

		<!-- Permissions tab -->
		<div class="tab-pane" id="tab-permissions">
			<div class="controls">
				<div class="control-group">

					@foreach ($permissions as $area => $permissions)
					<fieldset>
						<legend>{{ $area }}</legend>

						@foreach ($permissions as $permission)
						<div class="control-group">
							<label class="control-group">{{ $permission['label'] }}</label>

							<div class="radio inline">
								<label for="{{ $permission['permission'] }}_allow" onclick="">
									<input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) == 1 ? ' checked="checked"' : '') }}>
									Allow
								</label>
							</div>

							<div class="radio inline">
								<label for="{{ $permission['permission'] }}_deny" onclick="">
									<input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) == -1 ? ' checked="checked"' : '') }}>
									Deny
								</label>
							</div>

							@if ($permission['can_inherit'])
							<div class="radio inline">
								<label for="{{ $permission['permission'] }}_inherit" onclick="">
									<input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($userPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
									Inherit
								</label>
							</div>
							@endif
						</div>
						@endforeach

					</fieldset>
					@endforeach

				</div>
			</div>
		</div>

		<!-- Company Info tab -->
		<div class="tab-pane" id="tab-company-info">

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

			<!-- PAN Card No. -->
			<div class="control-group {{ $errors->has('pan_card_no') ? 'error' : '' }}">
				<label class="control-label" for="pan_card_no">PAN Card No.</label>
				<div class="controls">
					<input type="text" name="pan_card_no" id="pan_card_no" value="{{ Input::old('pan_card_no', $user->pan_card_no) }}" />
					{{ $errors->first('pan_card_no', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('agent-management') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Manager</button>
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