@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create a Page ::
@parent
@stop

{{-- Content --}}
@section('content')
@include('backend.administration.sidebar')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Create a Page

		<div class="pull-right">
			<a href="{{ route('pages') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>
	     
                        

<form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />


		
			<!-- Name -->
			<div class="control-group {{ $errors->has('slug') ? 'error' : '' }}">
				<label class="control-label">Page name/slug</label>
				<div class="controls">
					<input type="text" class="span5" name="slug" " value="{{ Input::old('slug') }}" />
					{{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label">Title</label>
				<div class="controls">
					<input type="text" class="span5" name="title"  value="{{ Input::old('title') }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        <div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label">Content</label>
				<div class="controls">
                                    
                                    <textarea class="span10 ckeditor" name="content" rows="10">{{ Input::old('content') }}</textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('pages') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Page</button>
		</div>
	</div>
</form>

</div>
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

@stop
