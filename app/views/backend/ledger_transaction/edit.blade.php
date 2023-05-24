@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit General Voucher ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit General Voucher
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account Management
			                <span class="icon-angle-right"></span>
			            </li>
			            <li><a href="{{ route('general-voucher') }}">General Voucher</a>
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            

			                        <li>Edit General Voucher
			                                    
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
		
			<!-- Currency -->
				<div class="control-group {{ $errors->has('cash_currency') ? 'error' : '' }}">
					<label class="control-label">Currency</label>
					<div class="controls">
						<select name="cash_currency"><option value="NPR">NPR</option></select>
						{{ $errors->first('cash_currency', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Amount -->
				<div class="control-group {{ $errors->has('cash_amount') ? 'error' : '' }}">
					<label class="control-label">Amount</label>
					<div class="controls">
						<input type="text" name="cash_amount" value="{{ Input::old('cash_amount') }}" />
						{{ $errors->first('cash_amount', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Date -->
				<div class="control-group {{ $errors->has('cash_date') ? 'error' : '' }}">
					<label class="control-label" >Date</label>
					<div class="controls">
						<input type="text" name="cash_date" id="datepick1" value="{{ Input::old('cash_date') }}" />
						{{ $errors->first('cash_date', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Transaction Id -->
				<div class="control-group {{ $errors->has('cash_transaction_id') ? 'error' : '' }}">
					<label class="control-label" >Transaction Id</label>
					<div class="controls">
						<input type="text" name="cash_transaction_id"  value="{{ Input::old('cash_transaction_id') }}" />
						{{ $errors->first('cash_transaction_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Deposited In Bank -->
				<div class="control-group {{ $errors->has('cash_deposited_in_bank') ? 'error' : '' }}">
					<label class="control-label">Deposited In Bank</label>
					<div class="controls">
						<select name="cash_deposited_in_bank"><option value="Kist Bank Ltd.">Kist Bank Ltd.</option></select>
						{{ $errors->first('cash_deposited_in_bank', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Bank Branch -->
				<div class="control-group {{ $errors->has('cash_bank_branch') ? 'error' : '' }}">
					<label class="control-label" >Bank Branch</label>
					<div class="controls">
					<select name="cash_bank_branch"><option value="Kist Bhainsepati">Kist Bhainsepati</option></select>
						{{ $errors->first('cash_bank_branch', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Remarks -->
				<div class="control-group {{ $errors->has('cash_remarks') ? 'error' : '' }}">
					<label class="control-label" >Remarks</label>
					<div class="controls">
					<textarea name="cash_remarks">{{ Input::old('cash_remarks') }}</textarea>
						{{ $errors->first('cash_remarks', '<span class="help-inline">:message</span>') }}
					</div>
				</div>                                              	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('general-voucher') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit General Voucher</button>
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

@section('currentpagejs')

<script type="text/javascript">
	 $(document).ready(function() {
	 		
    
        $( "#dr_cr" )
  .change(function () {
    
    $( "#dr_cr option:selected" ).each(function() {

    	if ($(this).text() == 'Dr'){

    		$('#dr').show();
    		$('#cr').hide();


    	}

    	if ($(this).text() == 'Cr'){

    		$('#cr').show();
    		$('#dr').hide();
    		

    	}


       
    });
    
  })
  .change();
     
        


    }); //Onload


</script>
         
@stop
