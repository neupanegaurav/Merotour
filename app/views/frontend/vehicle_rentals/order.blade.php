@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Order ::
@parent
@stop

{{-- Page content --}}
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/pages/bookpay.css')}}">

    @if($errors->has())
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    @endif

    @if (isset($_GET['action']) and $_GET['action'] == 'cancel' ) 
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Cancelled</h4>
            Please try another payment method.
        </div>
    @elseif (isset($_GET['action']) and $_GET['action'] == 'success')

    <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Success</h4>
            Paypal payment transaction done successfully.</p>
            You will receive an email soon, regarding the transaction details.
            Please check your orders from the <a href="{{ route('dashboard') }}">dashboard</a>.<br>
            Thank you.

        </div>


    @endif

    <!-- Content  -->

    <form method="post" action="">
            
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{$entry->id}}" >

        <div id="content">
            <div class="wrapcontent">
                        <div class="left">
                        <div class="title">
                            <h2>Trip Payment Info</h2>
                        </div>
                            <table class="sbox">
                            <tbody>                 
                                <tr>
                                    <td>
                                        <div style="float:left; margin-right:12px;">
                                            Check-In
                                            <div class="control-group {{ $errors->has('check_in') ? 'error' : '' }}" >
                                                <div class="controls">
                                                    <input type="text" style="width:90px;" name="check_in" id="datepicker1" value="{{ Input::old('check_in') }}" />
                                                    {{ $errors->first('check_in', '<span class="help-inline">:message</span>') }}
                                                </div>
                                            </div>
                                        </div>   

                                        Check-Out
                                        <div class="control-group {{ $errors->has('check_out') ? 'error' : '' }}">
                                            <div class="controls">
                                                <input type="text" style="width:90px;" name="check_out" id="datepicker2" value="{{ Input::old('check_out') }}" />
                                                {{ $errors->first('check_out', '<span class="help-inline">:message</span>') }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>   

                                <tr>
                                    <td>
                                        <div class="price">
                                            <table class="table" style="width:290px;">
                                                <thead>
                                                    <tr><th>Name</th><th>Amount</th> <th> Quantity</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr><td>Price Per Day</td> <td> $ <span id="price_per_day">{{ $entry->price_per_day }}</span> </td><td><input type="text" name="total_days" value="{{ isset($_GET['total_days']) ? $_GET['total_days'] : '' }}" style="width:40px;"></td></tr>
                                                    <tr><td>Price Per Hour</td> <td> $ <span id="price_per_hour">{{ $entry->price_per_hour }}</span> </td><td><input type="text" name="total_hours" value="{{ isset($_GET['total_hours']) ? $_GET['total_hours'] : '' }}" style="width:40px;"></td></tr>
                                                    <tr><td>Price Per Km</td> <td> $ <span id="price_per_km">{{ $entry->price_per_km }}</span> </td><td><input type="text" name="total_kms" value="{{ isset($_GET['total_kms']) ? $_GET['total_kms'] : '' }}" style="width:40px;"></td></tr>
                                                    <tr><td colspan="2">Total</td><td> <span id="order_total"></span> </td></tr>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                         <h2> Payment Options </h2>
                                        <select name="payment_options" style="background: #F0F0F0; box-shadow: 1px 1px 3px 0px rgba(0, 0, 0, 0.15); border:0px;">
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
                                    </td>
                                </tr>
                            <tr>
                                <td colspan="2"><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="terms" value="terms" id="terms2" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="terms">I have read and agree to the <a href="#">Terms of Use</a> and the <a href="#">Privacy Policy</a>.</div></td>
                            </tr>
                            </tbody></table>

                                <input class="nextstep" type="submit" name="nextstep" value="Continue To Next Step">
                        </div>

                        <div class="right">
                            <div class="box">
                                <div class="top">
                                    <h2>Accommodation Details</h2>
                                </div>
                                <div class="mid">
                                    <ul>
                                        <li>Destination<div class="subli">{{ $entry->country }}</div></li>
                                        <li>Name<div class="subli">{{ $entry->name }}</div></li>                             
                                        <li>Short Detail<div class="subli">{{ $entry->short_description }}</div></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="box">
                                <div class="top">
                                    <h2>Accommodation Costing</h2>
                                </div>
                                <div class="mid">
                                    <ul class="costing">
                                        <li class="total">Total Price<span class="detail">${{ $entry->cost }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    <div class="clear"></div>
            </div>

        </div>     

    </form>
@stop

@section('customjs')

    <script type="text/javascript">

     $(document).ready(function() {

            $( "#datepicker1" ).datepicker({       
              format: "yyyy-mm-dd",
              autoclose: true
            });
            $( "#datepicker2" ).datepicker({       
              format: "yyyy-mm-dd",
              autoclose: true
            }); 

            $('#ui-datepicker-div').wrap('<div id="themedp"></div>');

            /**
             * Run once and populate total value
             */
            //Grab the latest values
            total_days      = parseInt($('input[name="total_days"]').val() || 0);
            
            total_hours     = parseInt($('input[name="total_hours"]').val() || 0);
                        
            total_kms       = parseInt($('input[name="total_kms"]').val() || 0);
            
            price_per_day   = parseInt($('#price_per_day').text() || 0);
            
            price_per_hour  = parseInt($('#price_per_hour').text() || 0);
                        
            price_per_km    = parseInt($('#price_per_km').text() || 0);

            total_price_per_day   = (price_per_day) * (total_days);
            total_price_per_hour  = (price_per_hour) * (total_hours);
            total_price_per_km    = (price_per_km) * (total_kms);              

            // Do action
            $('#order_total').text(total_price_per_day + total_price_per_hour + total_price_per_km );
            $('.total > span').text(total_price_per_day + total_price_per_hour + total_price_per_km );

            /**
             * Change total amount according to input
             */
            $('input[name="total_days"], input[name="total_hours"], input[name="total_months"], input[name="total_kms"]').each(function() {
                var elem = $(this);

                // Save current value of element
                elem.data('oldVal', elem.val());

                // Look for changes in the value
                elem.bind("propertychange keyup input paste", function(event){
                  // If value has changed...
                  if (elem.data('oldVal') != elem.val()) {

                    // Updated stored value
                   elem.data('oldVal', elem.val());

                   //Grab the latest values
                   total_days      = parseInt($('input[name="total_days"]').val() || 0);
                   
                   total_hours     = parseInt($('input[name="total_hours"]').val() || 0);
                                      
                   total_kms       = parseInt($('input[name="total_kms"]').val() || 0);
                   
                   price_per_day   = parseInt($('#price_per_day').text() || 0);
                   
                   price_per_hour  = parseInt($('#price_per_hour').text() || 0);
                                      
                   price_per_km    = parseInt($('#price_per_km').text() || 0);

                   total_price_per_day   = (price_per_day) * (total_days);
                   total_price_per_hour  = (price_per_hour) * (total_hours);
                   total_price_per_km    = (price_per_km) * (total_kms);              

                    // Do action
                    $('#order_total').text(total_price_per_day + total_price_per_hour + total_price_per_km );
                    $('.total > span').text(total_price_per_day + total_price_per_hour + total_price_per_km );
                 }
               });

            });

        });

    </script>

@stop