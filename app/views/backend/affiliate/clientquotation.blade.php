@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Change your email ::
@parent
@stop

{{-- Page content --}}
@section('content')

@include('backend.agent.sidebar')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Send Quotation to Client

	</h3>
        
    </div>
    
	

<form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

       
                        
			<div class="control-group {{ $errors->has('from') ? 'error' : '' }}">
				<label class="control-label" >From (Your Email address)</label>
				<div class="controls">
					<input type="text" name="from"  value="{{ Input::old('from') }}" />
					{{ $errors->first('from', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                       
			<div class="control-group {{ $errors->has('to') ? 'error' : '' }}">
				<label class="control-label" >To (Client's Email address</label>
				<div class="controls">
					<input type="text" name="to"  value="{{ Input::old('to') }}" />
					{{ $errors->first('to', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
			
			
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label" >Email Title</label>
				<div class="controls">
					<input type="text" name="title"  value="{{ Input::old('title') }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                        
                        
                        <div class="control-group {{ $errors->has('body') ? 'error' : '' }}">
				<label class="control-label" for="description">Email Body</label>
				<div class="controls">
                                    
                                    <textarea class="span7" name="body" rows="10">{{ Input::old('body') }}</textarea>
					{{ $errors->first('body', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
                       

	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('agent') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Send </button>
		</div>
	</div>
        
       
        
        
</form>


                </div>

                                
    
       
    
  
                              
                              
                       

@stop
