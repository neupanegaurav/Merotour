@extends('backend/layouts/default')
@section('title')
Credit Transaction History  :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            Credit Transaction History 
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                <i class="icon-home"></i>
                Account
                <span class="icon-angle-right"></span>
                </li>
                <li>Credit Transaction History</li>                         
            </ul>
			<!-- END BREADCRUMBS -->
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="" method="post">
                                                                     
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('from_date') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="from_date">From Date</label>
                        <div class="controls">
                            <input type="text" name="from_date" id="datepicker1" value="{{ Input::old('from_date') }}" />
                            {{ $errors->first('from_date', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group {{ $errors->has('to_date') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="to_date">To Date</label>
                        <div class="controls">
                            <input type="text" name="to_date" id="datepicker2" value="{{ Input::old('to_date') }}" />
                            {{ $errors->first('to_date', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="search" style=" display:inline-block; margin-top:-10px; vertical-align: middle;">
                        <input type="submit" name="search" value="SEARCH" >
                    </div> 
                </form>                                                                              
            </ul>
            <!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
    <div class="header">
    

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     

@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif


    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        <th class="span2">Id</th>
                        <th class="span2">Date</th>
                        <th class="span2">Voucher#</th> 
                        <th class="span2">Narration</th>
                        <th class="span2">Debit/Credit</th>
                        <th class="span2">Balance</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $total = 0;

    ?>

    @foreach($entries as $entry)


        <tr>
            <td>{{$entry->id}}</td>
            <td>{{$entry->created_at}}</td>
            <td>{{$entry->invoice_no}}</td>
            <td>{{$entry->remarks}}</td>
            <td>{{$entry->debit_credit}}</td>
            <td>NPR {{$entry->amount}}</td>  

            <?php 

            if($entry->debit_credit == 'debit') 
            {
                $total -= $entry->amount; 
            }
            else 
            {
                $total += $entry->amount; 
            }

            ?>       
            
        </tr>



    @endforeach
        
    </tbody>
</table>

<p class="pull-right" style="margin-right:34px;"> <strong>Total </strong> : NPR {{$total}} </p>

<br clear="all">

        

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop

@section('currentpagejs')

<style>
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

<script>

    jQuery(document).ready(function() {

        $( "#datepicker1" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#datepicker2" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#timepicker1" ).timepicker({       
          timeFormat: "HH:mm:ss"
        });

        $( "#timepicker2" ).timepicker({       
          timeFormat: "HH:mm:ss"
        });


    });


</script>


@stop
