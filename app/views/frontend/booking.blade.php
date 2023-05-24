@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Package Tours ::
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



		<!-- Crum -->
                <div class="crum-wrapper">
                	<div class="container">
                    	<div class="row">
                        	<div class="span12">
                            	<a href="">Home</a>
                                <span class="crum">Booking</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Crum-->

                
                <!-- Grid page -->
                <div class="content booking_wrap">
                    <div class="container">
                        <div class="row">
                            <div class="span12 booking clearfix">
                                <div class="top">
                                    <h2>Kavin hotel</h2>
                                    <h3>Greece</h3>
                                    <div class="stars">
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#"></a>
                                        <a href="#"></a>
                                    </div>
                                </div>

                                <div class="bottom clearfix">
                                    <div class="span6 booking_form">
                                        <div class="row">
                                            <div class="span5 form">
                                                <h2>Travel Infomation</h2>
                                                <form>
                                                    <h3>Traveller Infomation</h3>
                                                    <div class="clearfix"></div>
                                                    <label>First Name: </label>
                                                    <input type="text"/>
                                                    <label>Last Name: </label>
                                                    <input type="text"/>
                                                    <label>Your Name: </label>
                                                    <input type="text"/>

                                                    <h3>Credit cart infomation</h3>
                                                    <a href="#" class="card"><img src="images/card.png" alt=""/></a>
                                                    <label>Name on Card: </label>
                                                    <input type="text"/>
                                                    <label>Card Number: </label>
                                                    <input type="text"/>
                                                    <label>Your Email: </label>
                                                    <input type="text"/>

                                                    <fieldset>
                                                        <label>Expiration Date: </label>
                                                        <input type="text"/>
                                                        <input type="text"/>
                                                    </fieldset>

                                                    <fieldset>
                                                        <label>Security Code: </label>
                                                        <input type="text"/>
                                                    </fieldset>

                                                    <h3>Credit cart infomation</h3>
                                                    <div class="cards">
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                    </div>
                                                    <label>Country: </label>
                                                    <input type="text"/>
                                                    <label>City: </label>
                                                    <input type="text"/>
                                                    <label>Address: </label>
                                                    <input type="text"/>

                                                    <fieldset>
                                                        <label>State </label>
                                                        <input type="text"/>
                                                    </fieldset>

                                                    <fieldset>
                                                        <label>Zip Code: </label>
                                                        <input type="text"/>
                                                    </fieldset>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span5">
                                        <div class="row">
                                            <div class="span1"></div>
                                            <div class="span4">
                                                <div class="summery">
                                                    <h2>Hotel Summary</h2>
                                                    <div>
                                                        <h3>Summary</h3>
                                                        <ul>
                                                            <li><span>Room:</span>Single Room</li>
                                                            <li><span>Price p night:</span>138$</li>
                                                            <li><span>Check in:</span> 16 / Feb / 2113</li>
                                                            <li><span>Check out:</span>16 / Feb / 2113</li>
                                                        </ul>

                                                        <h3>Charges</h3>
                                                        <ul>
                                                            <li><span>2 Night:</span>Single Room</li>
                                                            <li><span>VAT:</span>138$</li>
                                                            <li><span>Fees:</span>15 / Feb / 2113</li>
                                                            <li><span>Total:</span>16 / Feb / 2113</li>
                                                        </ul>
                                                    </div>
                                                    <h3>Accept and cirm</h3>
                                                    <form>
                                                        <input type="checkbox"/>
                                                        <p>I agree to theconditions.</p>
                                                        <div class="clearfix"></div>
                                                        <label>Grand Total:</label>
                                                        <span>138<small>$</small></span>
                                                        <div class="clearfix"></div>
                                                        <input type="submit" value="book now"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


  
                              
                              
                       

@stop
