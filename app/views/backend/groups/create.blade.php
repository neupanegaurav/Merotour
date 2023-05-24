@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create a New Role ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Create a New Role
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        User Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Create a New Role
			                                    
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
			<!-- Name -->
			<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="{{ Input::old('name') }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
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

						<style type="text/css">
						legend + .control-group 
						{
							margin-top:0px !important;
						}

						#allpermissions .control-group {
							margin-bottom: 10px !important;
							

							}

						</style>

						@foreach ($permissions as $permission)
						<div id="allpermissions" class="control-group" style="float:left; width:155px; border:1px solid #dddddd; padding:12px; margin-right:12px; border-radius:4px;">
							<label class="control-group">{{ $permission['label'] }}</label>

							<div class="btn-group" data-toggle="buttons">
	                            <label class="btn btn-default">
	                                <input type="radio" name="permissions[{{ $permission['permission'] }}]" value="1">
	                            Allow 
	                            </label>
	                            <label class="btn btn-default">
	                                <input type="radio" name="permissions[{{ $permission['permission'] }}]" checked="checked" value="0">
	                            Deny 
	                            </label>
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
			<a class="btn btn-link" href="{{ route('groups') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Role</button>
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