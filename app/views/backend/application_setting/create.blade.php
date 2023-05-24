@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create a Category ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Create a Package
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Package Tours
			                <span class="icon-angle-right"></span>
			            </li>
			             

			                        <li>Create a Package
			                                    
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
        
        <div class="pull-left" >
		
			<!-- Name -->
			<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="{{ Input::old('name') }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
				<label class="control-label" for="description">Description</label>
				<div class="controls">
					<input type="text" name="description" id="description" value="{{ Input::old('description') }}" />
					{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		

                        <div class="control-group {{ $errors->has('uploaded_file') ? 'error' : '' }}">
				<label class="control-label" for="description">Picture</label>
				<div class="controls">
                                       Upload new picture: <input type="file" name="uploaded_file" accept="image/jpg,image/gif">
					{{ $errors->first('uploaded_file', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                         <div class="control-group" {{ $errors->has('difficulty') ? 'error' : '' }}">
				<label class="control-label" for="difficulty">Difficulty</label>
				<div class="controls">
					<input type="text" name="difficulty" id="difficulty" value="{{ Input::old('difficulty')}}" />
					{{ $errors->first('difficulty', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group" {{ $errors->has('country') ? 'error' : '' }}">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
					<input type="text" name="country" id="country" value="{{ Input::old('country') }}" />
					{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                           <div class="control-group" {{ $errors->has('duration') ? 'error' : '' }}">
				<label class="control-label" for="country">Duration</label>
				<div class="controls">
					<input type="text" name="duration" id="duration" value="{{ Input::old('duration') }}" />
					{{ $errors->first('duration', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('activities') ? 'error' : '' }}">
				<label class="control-label" for="country">Activities</label>
				<div class="controls">
					<input type="text" name="activities" id="activities" value="{{ Input::old('activities') }}" />
					{{ $errors->first('activities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('season') ? 'error' : '' }}">
				<label class="control-label" for="country">Season</label>
				<div class="controls">
					<input type="text" name="season" id="season" value="{{ Input::old('season') }}" />
					{{ $errors->first('season', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                          <div class="control-group" {{ $errors->has('area') ? 'error' : '' }}">
				<label class="control-label" for="country">Area</label>
				<div class="controls">
					<input type="text" name="area" id="area" value="{{ Input::old('area') }}" />
					{{ $errors->first('area', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                         <div class="control-group" {{ $errors->has('group_size') ? 'error' : '' }}">
				<label class="control-label" for="country">Group Size</label>
				<div class="controls">
					<input type="text" name="group_size" id="group_size" value="{{ Input::old('group_size') }}" />
					{{ $errors->first('group_size', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                         <div class="control-group" {{ $errors->has('cost') ? 'error' : '' }}">
				<label class="control-label" for="country">Cost</label>
				<div class="controls">
					<input type="text" name="cost" id="cost" value="{{ Input::old('cost') }}" />
					{{ $errors->first('cost', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                      
                        
                        
                         <div class="control-group">
				<label class="control-label" for="country">Popular Package</label>
				<div class="controls">
					<input type="checkbox" name="popular"  value="1" />
					
				</div>
			</div>
                        
                        <div class="control-group" >
				<label class="control-label" for="country">Featured Package</label>
				<div class="controls">
					<input type="checkbox" name="featured"  value="1" />
					
				</div>
			</div>
                        
                        
                        <div class="control-group" >
				<label class="control-label" for="country">Special Package</label>
				<div class="controls">
					<input type="checkbox" name="special"  value="1" />
					
				</div>
			</div>
                        
                          <div class="control-group">
				<label class="control-label" for="special_price">Special Price</label>
				<div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                        
                        
                        
                        
	
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('package_tours') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Package</button>
		</div>
	</div>
        
        
        </div>
        
        
    <!-- Pull Right -->
                         <div class="pull-right" style=" margin-top: 200px; margin-right:50px; border:1px solid #DDDDDD; border-radius:4px; padding:5px;">
                             
                             <h3>Discount Form</h3>
                             <div class="control-group" {{ $errors->has('cost') ? 'error' : '' }}">
				<label class="control-label" for="country">Discount on</label>
				<div class="controls">
                                    
                                            <div class="radio inline">
								<label for="permission" onclick="">
									<input type="radio" name="type" value="percentage"  >
									Percentage
								</label>
                                            </div>

                                            <div class="radio inline">
								<label for="permission" onclick="">
									<input type="radio" name="type" value="price"  >
									Price
								</label>
                                            </div>  
                                    </div>
                                    
                                
                                </div>
                             
                             
                                                       
                             
                                <div class="control-group" >
                                         <label class="control-label" for="special_price">For Agent</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                                 <div class="control-group" >
                                         <label class="control-label" for="special_price">For Affiliate</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                                <div class="control-group" >
                                         <label class="control-label" for="special_price">For Manager</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                                <div class="control-group" >
                                         <label class="control-label" for="special_price">For Normal User</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                               <div class="control-group" >
                                         <label class="control-label" for="special_price">Start Date</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                               <div class="control-group" >
                                         <label class="control-label" for="special_price">End Date</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                             
                             
                             
                             
                             
                               
                                <div class="control-group" >
                                         <label class="control-label" for="special_price">Coupon Code (Normal User only)</label>
                                        <div class="controls">
					<input type="text" name="special_price"  value="{{ Input::old('special_price', '0')}}" />
					{{ $errors->first('special_price', '<span class="help-inline">:message</span>') }}
                                        </div>
                                </div>
                             
                             
                                    
                                                       
                                
                                
			</div>
                        
                        
    <!-- /Pull Right -->      
        
        
        
</form>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop
