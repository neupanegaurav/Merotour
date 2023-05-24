@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit Airline::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit Airport
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

			                        <li>Edit Airport
			                                    
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

	
		
			<!-- Airport Name -->
			<div class="control-group {{ $errors->has('airport_name') ? 'error' : '' }}">
				<label class="control-label" >Airport Name</label>
				<div class="controls">
					<input type="text" name="airport_name" value="{{ Input::old('airport_name', $entry->airport_name) }}" />
					{{ $errors->first('airport_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Airport Country -->
			<div class="control-group {{ $errors->has('country_id') ? 'error' : '' }}">
				<label class="control-label" >Country</label>
				<div class="controls">
					<input type="text" name="country_id" value="{{ Input::old('country_id', $entry->country_id) }}" />
					{{ $errors->first('country_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

            <!-- Airport Hub -->           
            <div class="control-group {{ $errors->has('state_id') ? 'error' : '' }}">
				<label class="control-label" for="state_id">State Code</label>
				<div class="controls">
					<input type="text" name="state_id" id="state_id" value="{{ Input::old('state_id', $entry->state_id) }}" />
					{{ $errors->first('state_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>


			<!-- Airport Hub City -->           
            <div class="control-group {{ $errors->has('city_id') ? 'error' : '' }}">
				<label class="control-label" for="city_id">City Code</label>
				<div class="controls">
					<input type="text" name="city_id" id="city_id" value="{{ Input::old('city_id', $entry->city_id) }}" />
					{{ $errors->first('city_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		
			
            
                        
            <div class="control-group" {{ $errors->has('icao_code') ? 'error' : '' }}">
				<label class="control-label" for="icao_code">ICAO Code</label>
				<div class="controls">
					<input type="text" name="icao_code" id="icao_code" value="{{ Input::old('icao_code', $entry->icao_code)}}" />
					{{ $errors->first('icao_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group" {{ $errors->has('iata_code') ? 'error' : '' }}">
				<label class="control-label" for="iata_code">IATA Code</label>
				<div class="controls">
					<input type="text" name="iata_code" id="iata_code" value="{{ Input::old('iata_code', $entry->iata_code)}}" />
					{{ $errors->first('iata_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('flight_airport') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit Airport</button>
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