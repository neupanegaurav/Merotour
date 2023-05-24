@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Unapprove Message ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Unapprove Message
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Orders		
			        <span class="icon-angle-right"></span>
               
	            </li>
			                        <li>Unapprove Message
			                                    
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
			
			  <!-- Description-->
		<div class="control-group {{ $errors->has('message') ? 'error' : '' }}">
			<label class="control-label">Unapprove Message to Customer</label>
			<div class="controls">
				<textarea type="text" name="message">{{ Input::old('message') }}</textarea>
				{{ $errors->first('message', '<span class="help-inline">:message</span>') }}
			</div>
		</div>    
                      

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('orders') }}">Back</a>

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