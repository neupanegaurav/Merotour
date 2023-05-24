@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Developer Portal ::
@parent
@stop

{{-- Page content --}}
@section('content')

   <!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
                                <div class="top" style="padding:10px;">

                                <h2>Developer Portal</h2>                                                                    
                                                
                                </div> <!-- /Top -->

                                <div class="bottom clearfix well pull-left" style="width: 300px; padding:10px;">
                                    
                                    <legend>Menu</legend>

                                    <style type="text/css">
                                        table.menu td {cursor:pointer;}
                                    </style>
                                        
                                    <table class="menu table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr><th>Package Tours</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="menu_item" value="get_all_package_tours">Get All Package Tours</td></tr>
                                            <tr><td class="menu_item" value="get_single_package_tour">Get Single Package Tour</td></tr>
                                            <tr><td class="menu_item" value="order_package_tour">Order Package Tour</td></tr>
                                         </tbody>  
                                    </table>   

                                    <table class="menu table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr><th>Hotels</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="menu_item" value="get_all_hotels">Get All Hotels</td></tr>
                                            <tr><td class="menu_item" value="get_single_hotel">Get Single Hotel</td></tr>
                                            <tr><td class="menu_item" value="order_hotel">Order Hotel</td></tr>
                                        </tbody>  
                                    </table>  

                                    <table class="menu table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr><th>Vacation Rentals</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="menu_item" value="get_all_vacation_rentals">Get All Vacation Rentals</td></tr>
                                            <tr><td class="menu_item" value="get_single_vacation_rental">Get Single Vacation Rental</td></tr>
                                            <tr><td class="menu_item" value="order_vacation_rental">Order Vacation Rental</td></tr>
                                        </tbody>  
                                    </table>  

                                    <table class="menu table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr><th>Vehicle Rentals</th></tr>
                                        </thead>
                                        <tbody>       
                                            <tr><td class="menu_item" value="get_all_vehicle_rentals">Get All Vehicle Rentals</td></tr>
                                            <tr><td class="menu_item" value="get_single_vehicle_rental">Get Single Vehicle Rental</td></tr>    
                                            <tr><td class="menu_item" value="order_vehicle_rental">Order Vehicle Rental</td></tr>
                                        </tbody>  
                                    </table>
                                   
                                </div> <!-- /Bottom -->

                                <div class="pull-right">

                                    <div class="bottom clearfix well" style="width: 670px; padding:10px;">
                                    
                                        <legend>Info</legend>

                                        <table id="info" class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr><td>Name</td> <td id="request_name"></td></tr>
                                                <tr><td>URL</td> <td id="request_url"></td></tr>
                                                <tr><td>Request Header</td> <td id="request_header">Content-Type: application/json; charset=utf-8</td>

                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                            
                                    </div> <!-- /Bottom -->
                                    
                                    <div class="bottom clearfix well" style="width: 670px; padding:10px;">
                                    
                                        <legend>Request</legend>

                                            <textarea id="request" style="width:97%;"></textarea>


                                            <button class="btn btn-small btn-success" id="send_request" value="">Send Request</button>
                                            
                                    </div> <!-- /Bottom -->

                                    <div class="bottom clearfix well" style="width: 670px; padding:10px;">
                                        
                                        <legend>Response</legend>


                                            <textarea id="response" style="width:97%; height:400px;"></textarea>
                                                                                   
                                    </div> <!-- /Bottom -->
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                </div>                             
                       

@stop


@section('customjs')

    <script type="text/javascript">
        $(document).ready(function() {

            // Get State/Cities
            $('.menu_item, #send_request').click(function() {

                $('#response').val('').text('');

                type = $(this).attr("value");

                url = "<?php echo route('home'); ?>";

                if ($(this).attr("id") == 'send_request') {
                    req_button = true;                  
                } else {
                    req_button = false;
                }


                if (type == 'get_all_package_tours') {

                        endpoint = 'package-tours';

                        $('#request_name').text('Get All Package Tours');
                        $('#request_url').text(url + 'api/v1/package-tours');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }
                       

                        $('#send_request').attr('value', type);

                } else if (type == 'get_single_package_tour') {

                        endpoint = 'package-tours/1';

                        $('#request_name').text('Get Single Package Tour');
                        $('#request_url').text(url + 'api/v1/package-tours/1');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }
                       

                        $('#send_request').attr('value', type);

                } else if (type == 'order_package_tour') {

                        endpoint = 'package-tours/order/1';

                        $('#request_name').text('Order Package Tour');
                        $('#request_url').text(url + 'api/v1/package-tours/order/1');

                        if (req_button) {
                            send_request = $('#request').val();                            
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"},"user_info":{"email":"sameernyaupane@outlook.com","password":"test"},"order":{"check_in":"2014-10-14","check_out":"2014-10-14","total_adults":1,"total_children":2,"total_infants":3,"payment_options":"account_balance"}}';
                            $('#request').val(send_request);
                        }

                        $('#send_request').attr('value', type);

                } else if (type == 'get_all_hotels') {

                        endpoint = 'hotels';

                        $('#request_name').text('Get All Hotels');
                        $('#request_url').text(url + 'api/v1/hotels');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }

                        $('#send_request').attr('value', type);

                } else if (type == 'get_single_hotel') {

                        endpoint = 'hotels/3';

                        $('#request_name').text('Get Single Hotel');
                        $('#request_url').text(url + 'api/v1/hotels/3');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }
                       

                        $('#send_request').attr('value', type);

                } else if (type == 'order_hotel') {

                        endpoint = 'hotels/order/11';

                        $('#request_name').text('Order Hotel');
                        $('#request_url').text(url + 'api/v1/hotels/order/11');

                        if (req_button) {
                            send_request = $('#request').val();                            
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"},"user_info":{"email":"sameernyaupane@outlook.com","password":"test"},"order":{"check_in":"2014-10-14","check_out":"2014-10-14","total_adults":1,"total_children":2,"total_infants":3,"payment_options":"account_balance"}}';
                            $('#request').val(send_request);
                        }

                        $('#send_request').attr('value', type);

                } else if (type == 'get_all_vacation_rentals') {

                        endpoint = 'vacation-rentals';

                        $('#request_name').text('Get All Vacation Rentals');
                        $('#request_url').text(url + 'api/v1/vacation-rentals');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }

                        $('#send_request').attr('value', type);

                } else if (type == 'get_single_vacation_rental') {

                        endpoint = 'vacation-rentals/1';

                        $('#request_name').text('Get Single Vacation Rental');
                        $('#request_url').text(url + 'api/v1/vacation-rentals/1');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }
                       

                        $('#send_request').attr('value', type);

                } else if (type == 'get_all_vehicle_rentals') {

                        endpoint = 'vehicle-rentals';

                        $('#request_name').text('Get All Vehicle Rentals');
                        $('#request_url').text(url + 'api/v1/vehicle-rentals');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }

                        $('#send_request').attr('value', type);

                } else if (type == 'get_single_vehicle_rental') {

                        endpoint = 'vehicle-rentals/7';

                        $('#request_name').text('Get Single Vehicle Rental');
                        $('#request_url').text(url + 'api/v1/vehicle-rentals/7');

                        if (req_button) {
                            send_request = $('#request').val();
                             
                        } else {
                            send_request = '{"auth":{"api_key":"53fdab101c770"}}';
                            $('#request').val(send_request);
                        }
                       

                        $('#send_request').attr('value', type);

                }

                $.ajax({
                    url: url + "api/v1/" + endpoint,
                    type: "POST",
                    data: send_request,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data){

                        response = JSON.stringify(data);

                        $('#response').val(response);
                    }
                });

            }); 
            // End of Get Cities        
                 
         }); //Onload
    </script>           
@stop