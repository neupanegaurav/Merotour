@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Agent Class ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Agent Class
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Agent Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Agent Class
			                                    
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
	<input type="hidden" name="_token" value="{{ csrf_token() }}">



		@foreach($entries as $entry)

	


			<h3>Class {{$entry->class}}</h3> 

			<!-- Discount Percentage -->
			<div class="control-group {{ $errors->has('discount_percentage') ? 'error' : '' }}">
				<label class="control-label" for="discount_percentage">Discount Percentage</label>
				<div class="controls">
					<input type="text" name="discount_percentage_{{ strtolower($entry->class)}}" id="discount_percentage" value="{{ Input::old('discount_percentage', $entry->discount_percentage) }}" />
					{{ $errors->first('discount_percentage', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Credit Limit -->
			<div class="control-group {{ $errors->has('credit_limit') ? 'error' : '' }}">
				<label class="control-label" for="credit_limit">Credit Limit</label>
				<div class="controls">
					<input type="text" name="credit_limit_{{ strtolower($entry->class)}}" id="credit_limit" value="{{ Input::old('credit_limit', $entry->credit_limit) }}" />
					{{ $errors->first('credit_limit', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
	    @endforeach
		

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('agent-management') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Update Agent Class</button>
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