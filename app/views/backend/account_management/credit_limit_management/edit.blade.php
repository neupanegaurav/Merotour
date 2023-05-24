@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit Credit Limit ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Edit Credit Limit
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account Management
			                <span class="icon-angle-right"></span>
			            </li>
			            <li><a href="{{ route('general-voucher') }}">Credit Limit</a>
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            

			                        <li>Edit Credit Limit
			                                    
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
	
			<div class="control-group {{ $errors->has('amount') ? 'error' : '' }}">
				<label class="control-label" for="amount">Amount</label>
				<div class="controls">
					<input type="text" name="amount" id="amount" value="{{ Input::old('amount', $entry->amount) }}" />
					{{ $errors->first('amount', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('start_date') ? 'error' : '' }}">
				<label class="control-label" >Start Date</label>
				<div class="controls">
					<input type="text" id="start_date" name="start_date" value="{{ Input::old('start_date', $entry->start_date) }}" />
					{{ $errors->first('start_date', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('expire_date') ? 'error' : '' }}">
				<label class="control-label" >Expire Date</label>
				<div class="controls">
					<input type="text" id="expire_date" name="expire_date" value="{{ Input::old('expire_date', $entry->expire_date) }}" />
					{{ $errors->first('expire_date', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			 <div class="control-group {{ $errors->has('remarks') ? 'error' : '' }}">
				<label class="control-label" for="remarks">Remarks</label>
				<div class="controls">
					<input type="text" name="remarks" id="remarks" value="{{ Input::old('remarks', $entry->remarks)}}" />
					{{ $errors->first('remarks', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group {{ $errors->has('status') ? 'error' : '' }}">
				<label class="control-label" for="status">Status</label>
				<div class="controls">
					<select name="status">
						<option {{ $entry->status == 'Pending' ? 'selected' : '' }}>Pending</option>
						<option {{ $entry->status == 'Approved' ? 'selected' : '' }}>Approved</option>
						<option {{ $entry->status == 'Unapproved' ? 'selected' : '' }}>Unapproved</option>
					</select>
					{{ $errors->first('status', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('paid_unpaid') ? 'error' : '' }}">
				<label class="control-label">Paid/Unpaid</label>
				<div class="controls">
					<select name="paid_unpaid">
						<option value="0" {{ $entry->paid_unpaid == 0 ? 'selected' : '' }}>Unpaid</option>
						<option value="1" {{ $entry->paid_unpaid == 1 ? 'selected' : '' }}>Paid</option>
					</select>
					{{ $errors->first('paid_unpaid', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group {{ $errors->has('paid_date') ? 'error' : '' }}">
				<label class="control-label" >Paid Date</label>
				<div class="controls">
					<input type="text" id="paid_date" name="paid_date" value="{{ Input::old('paid_date', $entry->paid_date) }}" />
					{{ $errors->first('paid_date', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

                                                        	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('credit-limit-management') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit Credit Limit</button>
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

<style>
#ui-datepicker-div {
	top:160px !important;
}
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
</style>

<script src="{{asset('assets/backend/js/jquery-ui-timepicker-addon.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {

        $("#datepick1").datepicker({       
              dateFormat: "yy-mm-dd"
        });
        $("#datepick2").datepicker({       
              dateFormat: "yy-mm-dd"
        });
        $("#datepick3").datepicker({       
              dateFormat: "yy-mm-dd"
        });

        $( "#start_date" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#expire_date" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#paid_date" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

    });

</script>



@stop
