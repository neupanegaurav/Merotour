@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Tour Package Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Tour Package Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Package Tours
			                <span class="icon-angle-right"></span>
			            </li>
			             

			                        <li>Tour Package Update
			                                    
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
        

<form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	
		
			<!-- Name -->
			<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="{{ Input::old('name', $entry->name) }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
				<label class="control-label" for="description">Description</label>
				<div class="controls">
                                    <textarea class="span10 ckeditor" name="description" value="description" rows="10" name="description" id="description" >{{ Input::old('description', $entry->description) }}</textarea>
					{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		

                        <div class="control-group {{ $errors->has('uploaded_file') ? 'error' : '' }}">
				<label class="control-label" for="description">Picture</label>
				<div class="controls">
                                    <div style="margin:5px;">Current picture:<br> <img style="width:160px; height:160px;" src="{{ asset('assets/img/uploads/') }}/{{ Input::old('uploaded_file', $entry->photo) }}"></div>
                                          Upload new picture: <input type="file" name="uploaded_file" accept="image/jpg,image/gif">
					{{ $errors->first('uploaded_file', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                         <div class="control-group" {{ $errors->has('difficulty') ? 'error' : '' }}">
				<label class="control-label" for="difficulty">Difficulty</label>
				<div class="controls">
					<input type="text" name="difficulty" id="difficulty" value="{{ Input::old('difficulty', $entry->difficulty) }}" />
					{{ $errors->first('difficulty', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group" {{ $errors->has('country') ? 'error' : '' }}">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
					<input type="text" name="country" id="country" value="{{ Input::old('country', $entry->country) }}" />
					{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                           <div class="control-group" {{ $errors->has('duration') ? 'error' : '' }}">
				<label class="control-label" for="country">Duration</label>
				<div class="controls">
					<input type="text" name="duration" id="duration" value="{{ Input::old('duration', $entry->duration) }}" />
					{{ $errors->first('duration', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('activities') ? 'error' : '' }}">
				<label class="control-label" for="country">Activities</label>
				<div class="controls">
					<input type="text" name="activities" id="activities" value="{{ Input::old('activities', $entry->activities) }}" />
					{{ $errors->first('activities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('season') ? 'error' : '' }}">
				<label class="control-label" for="country">Season</label>
				<div class="controls">
					<input type="text" name="season" id="season" value="{{ Input::old('season', $entry->season) }}" />
					{{ $errors->first('season', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('area') ? 'error' : '' }}">
				<label class="control-label" for="country">Area</label>
				<div class="controls">
					<input type="text" name="area" id="area" value="{{ Input::old('area', $entry->area) }}" />
					{{ $errors->first('area', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                         <div class="control-group" {{ $errors->has('group_size') ? 'error' : '' }}">
				<label class="control-label" for="country">Group Size</label>
				<div class="controls">
					<input type="text" name="group_size" id="group_size" value="{{ Input::old('group_size', $entry->group_size) }}" />
					{{ $errors->first('group_size', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                         <div class="control-group" {{ $errors->has('cost') ? 'error' : '' }}">
				<label class="control-label" for="country">Cost</label>
				<div class="controls">
					<input type="text" name="cost" id="cost" value="{{ Input::old('cost', $entry->cost) }}" />
					{{ $errors->first('cost', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group">
				<label class="control-label" for="country">Popular Package</label>
				<div class="controls">
					<input type="checkbox" name="popular" <?php if($entry->popular_package){echo "checked";} ?>  value="1" />
					
				</div>
			</div>
                        
                        <div class="control-group" >
				<label class="control-label" for="country">Featured Package</label>
				<div class="controls">
					<input type="checkbox" name="featured" <?php if($entry->featured_package){echo "checked";} ?>  value="1" />
					
				</div>
			</div>
                        
                        
                        <div class="control-group" >
				<label class="control-label" for="country">Special Package</label>
				<div class="controls">
					<input type="checkbox" name="special"<?php if($entry->special_package){echo "checked";} ?>  value="1" />
					
				</div>
			</div>
                        
                          <div class="control-group">
				<label class="control-label" for="special_price">Special Price</label>
				<div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', $entry->special_price)}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                        
	
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('package_tours') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Package</button>
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
