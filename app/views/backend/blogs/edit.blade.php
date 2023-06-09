@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
News Post Update ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                News Post Update
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
			        News Management
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>News Post Update
			                                    
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
        
<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-meta-data" data-toggle="tab">Meta Data</a></li>
</ul>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- Post Title -->
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label" for="title">Post Title</label>
				<div class="controls">
					<input type="text" name="title" id="title" value="{{ Input::old('title', $post->title) }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Post Slug -->
			<div class="control-group">
				<label class="control-label" for="slug">Slug</label>
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on">
							{{ str_finish(URL::to('/'), '/') }}
						</span>
						<input class="span6" type="text" name="slug" id="slug" value="{{ Input::old('slug', $post->slug) }}">
					</div>
				</div>
			</div>

			<!-- Content -->
			<div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label" for="content">Content</label>
				<div class="controls">
					<textarea class="span10 ckeditor" name="content" value="content" rows="10">{{ Input::old('content', $post->content) }}</textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>

		<!-- Meta Data tab -->
		<div class="tab-pane" id="tab-meta-data">
			<!-- Meta Title -->
			<div class="control-group {{ $errors->has('meta-title') ? 'error' : '' }}">
				<label class="control-label" for="meta-title">Meta Title</label>
				<div class="controls">
					<input class="span6" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title', $post->meta_title) }}" />
					{{ $errors->first('meta-title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Meta Description -->
			<div class="control-group {{ $errors->has('meta-description') ? 'error' : '' }}">
				<label class="control-label" for="meta-description">Meta Description</label>
				<div class="controls">
					<input class="span6" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description', $post->meta_description) }}" />
					{{ $errors->first('meta-description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Meta Keywords -->
			<div class="control-group {{ $errors->has('meta-keywords') ? 'error' : '' }}">
				<label class="control-label" for="meta-keywords">Meta Keywords</label>
				<div class="controls">
					<input class="span6" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords', $post->meta_keywords) }}" />
					{{ $errors->first('meta-keywords', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('blogs') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Publish</button>
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
