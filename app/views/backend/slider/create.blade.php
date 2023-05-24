@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Send a Newsletter ::
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Add New Slider
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
			        Slider Management
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>Add New Slider
			                                    
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

       
		 <div class="control-group {{ $errors->has('uploaded_picture') ? 'error' : '' }}">
				<label class="control-label" >Slider Image</label>
				<div class="controls">
					
                                        
                                        
                                        Upload picture: <input type="file" name="uploaded_picture" accept="image/jpg">
					{{ $errors->first('uploaded_picture', '<span class="help-inline">:message</span>') }}
                                    
					
				</div>
			</div>
			
			<!-- Name -->
			<div class="control-group {{ $errors->has('country') ? 'error' : '' }}">
				<label class="control-label" for="title">Country</label>
				<div class="controls">
					<input type="text" name="country" id="name" value="{{ Input::old('country') }}" />
					{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                         <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
				<label class="control-label" for="description">Description</label>
				<div class="controls">
                                    
                                    <textarea class="span7" name="description" rows="3">{{ Input::old('description') }}</textarea>
					{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                       

	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('slider') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Send </button>
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