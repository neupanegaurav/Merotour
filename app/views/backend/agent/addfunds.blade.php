@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Change your email ::
@parent
@stop

{{-- Page content --}}
@section('content')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Add Funds

		
	</h3>
        
    </div>
    
	
<form method="post" action="@if(Sentry::check())
                                        
                                         {{ URL::to('paypal/paypal.php?sandbox=1') }}
                                        @endif">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<fieldset>
            
            <h4> Current Balance: {{ "$" . $balance }} </h4> 
             
            <br><br>


            @if($user = Sentry::getUser())

        <input type="hidden" name="action" value="process" />
        <input type="hidden" name="cmd" value="_cart" /> <?php // use _cart for cart checkout ?>
        <input type="hidden" name="currency_code" value="USD" />
        <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />
    
        <input type='hidden' name="product_id" value="344" />   
        
        <input type='hidden' name="product_name" value="Add Funds" />
   
        <input type='hidden' name="product_quantity" value="1" />
    
       
        <input type='hidden' name="payer_fname" value="{{$user->first_name}}" />
    
        <input type='hidden' name="payer_lname" value="{{$user->last_name}}" />
   
        <input type='hidden' name="payer_address" value="Address of me" />
    
        <input type='hidden' name="payer_city" value="City of me" />
    
        <input type='hidden' name="payer_state" value="State of me" />
    
        <input type='hidden' name="payer_zip" value="123456" />
    
        <input type='hidden' name="payer_country" value="US" />
    
        <input type='hidden' name="payer_email" value="{{$user->email}}" />
    
        @endif


            
            <div  class="control-group{{ $errors->first('amount', ' error') }}">
                    <label class="pull-left" style="margin-right:10px;"> Payment Method</label>
                      <input type="radio" name="trip" value="paypal" checked>Paypal 

                        
                      
                     
			
		</div>
            
          
                <!-- Interested in -->
		<div  class="control-group{{ $errors->first('amount', ' error') }}">
                    <label class="pull-left" style="margin-right:10px;">Add amount $ </label><input type="text"  name="product_amount" class="span3" >
			{{ $errors->first('amount', '<span class="help-block">:message</span>') }}
		</div>
                
                               
            
		<!-- Form actions -->
		<button type="submit" class="btn btn-warning pull-right">Submit</button>
	</fieldset>
</form>

                </div>

                                
    
                  

@stop
