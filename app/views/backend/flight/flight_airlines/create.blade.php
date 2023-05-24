@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create a new Airline::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Create a new Airline
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			             <li>
			        </i>
			        Menu Management
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>Create a new Airline
			                                    
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
        
<form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	
		
			<!-- Airlines Name -->
			<div class="control-group {{ $errors->has('airlines_name') ? 'error' : '' }}">
				<label class="control-label" >Airlines Name</label>
				<div class="controls">
					<input type="text" name="airlines_name" value="{{ Input::old('airlines_name') }}" />
					{{ $errors->first('airlines_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

            <!-- Airlines Hub -->           
            <div class="control-group {{ $errors->has('airlines_hub') ? 'error' : '' }}">
				<label class="control-label" for="airlines_hub">Airlines Hub</label>
				<div class="controls">
					<input type="text" name="airlines_hub" id="airlines_hub" value="{{ Input::old('airlines_hub') }}" />
					{{ $errors->first('airlines_hub', '<span class="help-inline">:message</span>') }}
				</div>
			</div>



			<!-- Airlines Hub City -->           
            <div class="control-group {{ $errors->has('airlines_hub_city') ? 'error' : '' }}">
				<label class="control-label" for="airlines_hub_city">Airlines Hub City</label>
				<div class="controls">
					<input type="text" name="airlines_hub_city" id="airlines_hub_city" value="{{ Input::old('airlines_hub_city') }}" />
					{{ $errors->first('airlines_hub_city', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		
			<div class="control-group {{ $errors->has('primary_image') ? 'error' : '' }}">
				<label class="control-label" for="description">Airline Logo</label>
				<div class="controls">
                                       Upload new logo: <input type="file" name="primary_image" accept="image/jpg,image/gif">
					{{ $errors->first('primary_image', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
            
                        
            <div class="control-group" {{ $errors->has('airlines_shortcode') ? 'error' : '' }}">
				<label class="control-label" for="airlines_shortcode">Airlines Shortcode</label>
				<div class="controls">
					<input type="text" name="airlines_shortcode" id="airlines_shortcode" value="{{ Input::old('airlines_shortcode')}}" />
					{{ $errors->first('airlines_shortcode', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group" {{ $errors->has('airlines_code') ? 'error' : '' }}">
				<label class="control-label" for="airlines_code">Airlines Code</label>
				<div class="controls">
					<input type="text" name="airlines_code" id="airlines_code" value="{{ Input::old('airlines_code')}}" />
					{{ $errors->first('airlines_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('airlines_short_desc') ? 'error' : '' }}">
				<label class="control-label" for="airlines_short_desc">Airlines Short Desc</label>
				<div class="controls">
					<input type="text" name="airlines_short_desc" id="airlines_short_desc" value="{{ Input::old('airlines_short_desc') }}" />
					{{ $errors->first('airlines_short_desc', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('airlines_date') ? 'error' : '' }}">
				<label class="control-label" for="country">Airlines Date</label>
				<div class="controls">
					<input type="text" name="airlines_date" id="airlines_date" value="{{ Input::old('airlines_date') }}" />
					{{ $errors->first('airlines_date', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('package_tours') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Airline</button>
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