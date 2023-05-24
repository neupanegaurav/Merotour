@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Flight Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Flight Search
	                <span class="icon-angle-right"></span>
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

                <div class="top" style="padding:10px;">
                                    
                                    <h3>Flight Payment </h3>
                                    
                                </div><!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">

                                @if(isset($error)) 
                                    {{ $error }}

                                    @else

                                    <h4 style="margin:5px; margin-bottom:20px; "> Please make a payment to proceed.</h4> 

                                    <style type="text/css">                                       
                                        .panel-default 
                                        {
                                           border:1px solid #dddddd; 
                                           border-radius:4px; 
                                           padding:12px; 
                                           margin-bottom:12px; 

                                        }
                                    </style>

                                        <form method="post" action="{{ URL::to('payment-process') }}" class="form-horizontal" autocomplete="off">
                                            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="flightid" value="{{ $flightid }}" >
                                            <input type="hidden" name="returnflightid" value="{{ $returnflightid }}" >
                                            <input type="hidden" name="adults" value="{{ $adults }}" >
                                            <input type="hidden" name="children" value="{{ $children }}" >

                                            <div class="pull-left" style="width:450px;">  
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"> 
                                                        <h3>Payment Details </h3> 
                                                    </div>
                                                    <div class="panel-body">
                                                        Adults: {{$adults}}  <br>
                                                        @if($children >= 1)
                                                        Children: {{$children}} <br>
                                                        @endif
                                                        Airline: {{$airline}} <br>
                                                        Flight No: {{$flight_no}} <br>
                                                        Class Code: {{$class_code}} <br>
                                                        Flight Id: {{$flightid}}  <br>

                                                        <?php

                                                                                if($airline == 'Buddha Airlines') 
                                                                                { 
                                                                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/buddha.jpg') . '">';
                                                                                }
                                                                                elseif($airline == 'Simrik Airlines') 
                                                                                {
                                                                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                                                    
                                                                                }
                                                                                elseif($airline == 'Yeti Airlines' or $airline == 'YT' ) 
                                                                                {
                                                                                    echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/yeti.jpg') . '">';
                                                                                   
                                                                                }
                                                                                elseif($airline == 'Nepal Airlines') 
                                                                                {
                                                                                    //echo '<img style="width:40px; height:auto;" src="' . asset('assets/img/simrik.jpg') . '">';
                                                                                    echo 'Nepal Airlines';
                                                                                }
                                                                                else
                                                                                { 
                                                                                   
                                                                                }

                                                                                ?> 



                                                                            <table id="RMK153" class="table table-bordered table-striped table-hover" style="margin-top:12px; margin-bottom:0px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th colspan="5"><div class="pull-right">Currency: <span class="label label-primary">{{ Session::get('flight_currency'); }}</span></div></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Type</th>
                                                                                        <th>Base Fare</th>
                                                                                        <th>Fuel Surcharge</th>
                                                                                        <th>Tax</th>
                                                                                        <th>Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="type">Adult x {{ $adults }}</td>
                                                                                        <td id="base_fare">
                                                                                        
                                                                                        <?php 
                                                                                            $adult_fare = Session::get('adult_fare_'.$flightid);
                                                                                            if (isset($agent_commission)) {       
                                                                                                $final_af = ceil( $adult_fare -(($agent_commission/100) * $adult_fare));
                                                                                                echo '<del style="color:red;">'. $adult_fare.'</del>'.' ' . $final_af . ' (' . $agent_commission . '%' . ' agent commission)';
                                                                                            } else {
                                                                                                $final_af = $adult_fare;
                                                                                                echo $adult_fare;
                                                                                            }
                                                                                        ?>
                                                                                        </td>
                                                                                        <td id="fuel_surcharge">{{Session::get('fuel_surcharge_'.$flightid)}}</td>
                                                                                        <td id="tax">{{Session::get('tax_'.$flightid)}}</td>
                                                                                        <td id="total"> {{ $adult_total = ($final_af + Session::get('fuel_surcharge_'.$flightid) + Session::get('tax_'.$flightid)) * ($adults) }} </td>
                                                                                    </tr>
                                                                                    @if($children >= 1)
                                                                                        <tr>
                                                                                            <td id="type">Children x {{ $children }}</td>
                                                                                            <td id="base_fare">{{Session::get('child_fare_'.$flightid)}}</td>
                                                                                            <td id="fuel_surcharge">{{Session::get('fuel_surcharge_'.$flightid)}}</td>
                                                                                            <td id="tax">{{Session::get('tax_'.$flightid)}}</td>
                                                                                            <td id="total"> {{ $children_total = (Session::get('child_fare_'.$flightid) + Session::get('fuel_surcharge_'.$flightid) + Session::get('tax_'.$flightid)) * ($children) }} </td>
                                                                                        </tr>
                                                                                    @else
                                                                                        <?php $children_total = 0; ?>
                                                                                    @endif
                                                                                    <tr>
                                                                                        <td colspan="4"> <span style="float:right" >Total checkout</span> </td>
                                                                                        <td>{{ $adult_total + $children_total }}</td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>

                                                    </div>
                                                </div>
                                            </div>

                                            <br clear="all">


                                            <div class="pull-left" style="width:450px;">  
                                                <div class="panel panel-default" >
                                                    <div class="panel-heading"> 
                                                        <h3>Payment Options </h3> 
                                                    </div>
                                                    <div class="panel-body">
                                                        
                                                        <select name="payment_options">

                                                            <option value="account_balance">Account Balance 
                                                            (Rs. 
                                                                <?php 
                                                                $funds = Funds::where('user_id', Sentry::getUser()->id)->first();
                                                                if(!empty($funds->balance)) {
                                                                    echo $funds->balance;
                                                                } else {
                                                                    echo 0;
                                                                }
                                                                ?>
                                                            )
                                                            </option>

                                                            @if(Session::get('account_type') == 'agent')

                                                            <option value="credit_balance"> Credit Balance 
                                                            (Rs.
                                                                <?php 
                                                                if(!empty($funds->credit_balance)) {
                                                                    echo $funds->credit_balance;
                                                                } else {
                                                                    echo 0;
                                                                }
                                                                ?>
                                                            )
                                                            </option>

                                                            @endif

                                                            @if(PGSettings::find(1)->enabled == 1)
                                                            <option value="paypal">Paypal</option>
                                                            @endif

                                                            @if(PGSettings::find(3)->enabled == 1)

                                                            <option value="bank_transfer">Bank Transfer</option>

                                                            @endif

                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>



                                            <br clear="all">
                                          
                                            <!-- Form actions -->
                                            <div class="control-group">
                                                <div class="controls">
                                                    <a class="btn" href="{{ route('home') }}">Cancel</a>

                                                    <button type="submit" class="btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        

                                 @endif

                                
                                </div> <!-- /Bottom -->    

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

        //For Reservation form
    $( "#datepicker" ).datepicker({       
          dateFormat: "dd-mm-yy"
        });
    $( "#clender" ).datepicker({       
          dateFormat: "dd-mm-yy"
        }); 

        $("#domestic").on('click', function() {
    
            $("#h4").text('Domestic Flight Search');
            
            $(".sectorFromIntl").hide();
            $("#sectorFrom").show();

            $(".sectorToIntl").hide();
            $("#sectorTo").show();

            $(".flight_date_intl").hide();
            $(".flight_date").show();

            $(".return_date_intl").hide();
            $(".return_date").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearch')}}" );  
    
        });
            
    
        $("#international").on('click', function() {
    
            $("#h4").text('International Flight Search');

            $("#sectorFrom").hide();
            $(".sectorFromIntl").show();

            $("#sectorTo").hide();
            $(".sectorToIntl").show();

            $(".flight_date").hide();
            $(".flight_date_intl").show();

            $(".return_date").hide();
            $(".return_date_intl").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearchintl')}}" );

    
        }); 


    }); //Onload


</script>

@stop
