@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a User ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Create a New User
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        User Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Create user
			                                    
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
</ul>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- First Name -->
			<div class="control-group {{ $errors->has('first_name') ? 'error' : '' }}">
				<label class="control-label" for="first_name">First Name</label>
				<div class="controls">
					<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
					{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Last Name -->
			<div class="control-group {{ $errors->has('last_name') ? 'error' : '' }}">
				<label class="control-label" for="last_name">Last Name</label>
				<div class="controls">
					<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
					{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Email -->
			<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
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
				<label class="control-label" for="activated">User Activated</label>
				<div class="controls">
					<select name="activated" id="activated">
						<option value="1"{{ (Input::old('activated', 0) == 1 ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
						<option value="0"{{ (Input::old('activated', 0) == 0 ? ' selected="selected"' : '') }}>@lang('general.no')</option>
					</select>
					{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Groups -->
			<div class="control-group {{ $errors->has('groups') ? 'error' : '' }}">
				<label class="control-label" for="groups">Group</label>
				<div class="controls">
					<select name="groups[]" id="groups[]">
						@foreach ($groups as $group)
						<option value="{{ $group->id }}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
						@endforeach
					</select>

					<span class="help-block">
						Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
					</span>
				</div>
			</div>
		</div>

		<!-- Permissions tab -->
		<div class="tab-pane" id="tab-permissions">
			<div class="control-group">
				<div class="controls" style="margin-left: 100px;">

					@foreach ($permissions as $area => $permissions)
					<fieldset>
						<legend>{{ $area }}</legend>

						<style type="text/css">
						legend + .control-group 
						{
							margin-top:0px !important;
						}

						#allpermissions .control-group 
						{
							margin-bottom: 10px !important;
						}

						.btn-group .btn { padding: 4px 6px;}

						#allpermissions {
							float:left; 
							width:206px; 
							border:1px solid #dddddd; 
							padding:12px; 
							margin-right:12px; 
							border-radius:4px;
						}

						</style>

						@foreach ($permissions as $permission)
						<div id="allpermissions" class="control-group">
							<label class="control-group">{{ $permission['label'] }}</label>

							
							<div class="btn-group" data-toggle="buttons">
	                            <label class="btn btn-default">
	                                <input type="radio" name="permissions[{{ $permission['permission'] }}]" value="1" {{ (array_get($selectedPermissions, $permission['permission']) == 1 ? ' checked="checked"' : '') }}>
	                            Allow 
	                            </label>
	                            <label class="btn btn-default">
	                                <input type="radio" name="permissions[{{ $permission['permission'] }}]" value="0" {{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
	                            Deny 
	                            </label>

	                            @if ($permission['can_inherit'])
								<label class="btn btn-default">
									<input type="radio" value="0" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
									Inherit
								</label>
								@endif

                        	</div>

							
						</div>
						@endforeach

					</fieldset>
					@endforeach

				</div>
			</div>
		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('users') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create User</button>
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



