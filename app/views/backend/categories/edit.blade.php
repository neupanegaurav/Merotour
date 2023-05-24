@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Category Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Category Update

		<div class="pull-right">
			<a href="{{ route('categories') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>


<form class="form-horizontal" method="post" action="" autocomplete="off">
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
					<input type="text" name="description" id="description" value="{{ Input::old('description', $entry->description) }}" />
					{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		

	
	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('categories') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Category</button>
		</div>
	</div>
</form>
@stop
