@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Office Update ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Update Branch Office
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        System Setup
			                <span class="icon-angle-right"></span>
			            </li>
			              <li>
			       
			        Branch Office Management
			                <span class="icon-angle-right"></span>
			            </li>

			                        <li>Update office
			                                    
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

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- Office Name -->
			<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label" for="name">Office Name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="{{ Input::old('name'), $entry->name }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Location -->
			<div class="control-group {{ $errors->has('location') ? 'error' : '' }}">
				<label class="control-label" for="location">Location</label>
				<div class="controls">
					<input type="text" name="location" id="location" value="{{ Input::old('location'), $entry->location }}" />
					{{ $errors->first('location', '<span class="help-inline">:message</span>') }}
				</div>
			</div>	

	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('branch-offices') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Office</button>
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