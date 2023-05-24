@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Menu Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Menu Update
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

			                        <li>Menu Update
			                                    
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
			<div class="control-group {{ $errors->has('slug') ? 'error' : '' }}">
				<label class="control-label">Page name/slug</label>
				<div class="controls">
					<input type="text" class="span5" name="slug" " value="{{ Input::old('slug', $entry->slug) }}" />
					{{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label">Title</label>
				<div class="controls">
					<input type="text" class="span5" name="title"  value="{{ Input::old('title', $entry->title) }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
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
			<a class="btn btn-link" href="{{ route('menu') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Menu</button>
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
