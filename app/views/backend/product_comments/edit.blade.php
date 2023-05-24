@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Comments Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Comments Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			             

			                        <li>Comments Update
			                                    
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

                        
                        <div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label">Content</label>
				<div class="controls">
                                    
                    <textarea class="span10 ckeditor" name="content" rows="10">{{ Input::old('content', $entry->content) }}</textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                        
                      
                       
            
		
		

	
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('product-comments') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Comment</button>
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





    
    </div>
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>
@stop
