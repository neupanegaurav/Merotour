@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Flight Payment ::
@parent
@stop

{{-- Page content --}}
@section('content')
<style>
    #maincont {background: #fff; margin-top:20px; padding:5px;}
    table strong {font-size:14px;}
    table thead td {background:none;}
    td img {float:left; margin-right:10px; width:170px; height:115px;}
    a:hover {text-decoration:none;}
    td p {color: rgb(102, 102, 102);}
     
</style>




<!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
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
                                        <input type="hidden" name="backend" value="1" />


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
                                                                                    
                                                                                    @if($dom=="flightint")
                                                                                    <td id="base_fare">
                                                                                    <?php 
                                                                                        $adult_fare = Session::get('adult_fare');
                                                                                        if (isset($agent_commission)) {       
                                                                                            $final_af = ceil( $adult_fare -(($agent_commission/100) * $adult_fare));
                                                                                            echo '<del style="color:red;">'. $adult_fare.'</del>'.' ' . $final_af . ' (' . $agent_commission . '%' . ' agent commission)';
                                                                                        } else {
                                                                                            $final_af = $adult_fare;
                                                                                            echo $adult_fare;
                                                                                        }
                                                                                    ?>
                                                                                    </td>


                                                                                    @else
                                                                                    <td id="base_fare">
                                                                                    <?php 
                                                                                        $adult_fare = Session::get('adult_fare'.$flightid);
                                                                                        if (isset($agent_commission)) {       
                                                                                            $final_af = ceil( $adult_fare -(($agent_commission/100) * $adult_fare));
                                                                                            echo '<del style="color:red;">'. $adult_fare.'</del>'.' ' . $final_af . ' (' . $agent_commission . '%' . ' agent commission)';
                                                                                        } else {
                                                                                            $final_af = $adult_fare;
                                                                                            echo $adult_fare;
                                                                                        }
                                                                                    ?>
                                                                                    </td>

                                                                                    @endif
                                                                                    
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
                            </div>
                        </div>
                    </div>
                </div>               
                       

@stop
