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
                Send a Newsletter
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
			        Newsletter Management
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>Send a Newsletter
			                                    
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
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label" for="title">Email Title</label>
				<div class="controls">
					<input type="text" name="title" id="name" value="{{ Input::old('title') }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                         <div class="control-group {{ $errors->has('body') ? 'error' : '' }}">
				<label class="control-label" for="description">Email Body</label>
				<div class="controls">
                                    
                                    <textarea class="span7 ckeditor" name="body" rows="10">{{ Input::old('body') }}</textarea>
					{{ $errors->first('body', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                       

	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('mailinglist') }}">Back</a>

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


<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

         

@stop