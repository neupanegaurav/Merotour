@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Newsletter Update ::
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Slider Edit
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

			                        <li>Slider Edit
			                                    
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


	<!-- Name -->
		<div class="control-group {{ $errors->has('banner_name') ? 'error' : '' }}">
			<label class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="banner_name" value="{{ Input::old('banner_name') }}" />
				{{ $errors->first('banner_name', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<div class="control-group {{ $errors->has('uploaded_picture') ? 'error' : '' }}">
				<label class="control-label">Banner Image</label>
				<div class="controls">

					 Current picture: 
                                        
                     <img src="{{asset('assets/img/uploads/banners')}}/{{$entry->image}}" /> <br> <br>
                                        

                      Upload picture: <input type="file" name="uploaded_picture" accept="image/jpg">
					{{ $errors->first('uploaded_picture', '<span class="help-inline">:message</span>') }}				
				</div>
		</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('slider') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit Slider </button>
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


