@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Order Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Order Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Order Update
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

			<!-- Package Name -->
			<div class="control-group {{ $errors->has('package_name') ? 'error' : '' }}">
				<label class="control-label" for="package_name">Package Name</label>
				<div class="controls">
					<input type="text" name="package_name" id="package_name" value="{{ Input::old('package_name', $entry->package_name) }}" />
					{{ $errors->first('package_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>        
                        
            <div class="control-group" {{ $errors->has('date') ? 'error' : '' }}">
				<label class="control-label" for="date">Date</label>
				<div class="controls">
					<input type="text" name="date" id="datepickerorder" value="{{ Input::old('date', $entry->date) }}" />
					{{ $errors->first('date', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('group_size') ? 'error' : '' }}">
				<label class="control-label" for="group_size">Group Size</label>
				<div class="controls">
					<input type="text" name="group_size" id="group_size" value="{{ Input::old('group_size', $entry->group_size) }}" />
					{{ $errors->first('group_size', '<span class="help-inline">:message</span>') }}
				</div>
			</div>                      

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('orders') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Order</button>
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


@section('currentpagejs')

<script type="text/javascript">
	$(document).ready(function() 
	{
		$("#datepickerorder").datepicker(
		{       
          dateFormat: "yy-mm-dd"
        });
	});

</script>


@stop

