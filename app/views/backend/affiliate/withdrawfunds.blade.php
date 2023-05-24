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
		Withdraw Funds

		
	</h3>
        
    </div>
    
	
<form method="post" action="">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<fieldset>
            
            <h4> Current Balance: {{ "$" . $balance }} </h4> 
             
            <br><br>
            
             <div  class="control-group{{ $errors->first('amount', ' error') }}">
                    <label class="pull-left" style="margin-right:10px;"> Payment Method</label>
                      <input type="radio" name="trip" value="paypal">Paypal 
                      <input type="radio" name="trip" value="e-sewa">E-Sewa 
                      <input type="radio" name="trip" value="bank_transfer">Bank Transfer 
			
		</div>
            
                <!-- Interested in -->
		<div  class="control-group{{ $errors->first('amount', ' error') }}">
                    <label class="pull-left" style="margin-right:10px;">Withdraw amount $ </label><input type="text"  name="amount" class="span3" >
			{{ $errors->first('amount', '<span class="help-block">:message</span>') }}
		</div>
                
                
                
            
		<!-- Form actions -->
		<button type="submit" class="btn btn-warning pull-right">Submit</button>
	</fieldset>
</form>

                </div>

                                
    
                  

@stop
