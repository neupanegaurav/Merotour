<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/themes/minimal/all.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/modalbox.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/select.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/datepicker.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/jquery-ui-1.10.4.custom.min.css')}}" />

<!--<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/datepicker-theme/datepicker.css')}}"  /> -->

<link href="{{asset('assets/frontend/css/webwidget_slideshow_dot.css')}}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">

<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap-modal.css') }}">

<script type="text/javascript" src="{{asset('assets/frontend/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/jquery.icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/jquery.mousewheel.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/jquery.select.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/jScrollPane.js')}}"></script>
<!--start carasoul_slider_script -->
<script type="text/javascript" language="javascript" src="{{asset('assets/frontend/js/jcarousellite.js')}}"></script>
<script type="text/javascript" language="javascript" src="{{asset('assets/frontend/js/javafunction.js')}}"></script>
<!--end carasoul_script -->
<!--slider -->

<!-- <title>Blackeye Journeys</title> -->
<title>Socheko Journeys</title>
</head>
<script type="text/javascript">
    $(window).load(function() {
        $("#background").fullBg();
    });
</script>
<body>

<div class="page-container">

<script type="text/javascript">
    var bodyTag = document.getElementsByTagName("body")[0];
    bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>

  <script type="text/javascript" src="{{asset('assets/frontend/js/webwidget_slideshow_dot.js')}}"></script>
  <script language="javascript" type="text/javascript">

    $(document).ready(function(){
        $("#demo1").webwidget_slideshow_dot({
            slideshow_time_interval: '5000',
            slideshow_window_width: '300',
            slideshow_window_height: '422',
            slideshow_title_color: '#17CCCC',
            soldeshow_foreColor: '#000',
            directory: 'assets/frontend/images/'
        });     
    });
        </script>

<style type="text/css">
            #dropped {padding: 2px;}
            #dropped li {float: left; list-style: none; margin-right: 10px; }
            #dropped li:nth-child(3) { margin-right: 0px;}
            #dropped li a {font-size: 12px;}
            #dropped li a:hover { background: #dddddd; border-radius: 4px; }
            
            .alert-block {
                position: relative !important;
                width: 1001px;
                margin: auto;
            }
            </style>        

<div id="wrapper">
    <div class="clearfix">
        
        <div class="logo" style="float:left; margin:-5px; height: 80px;">

            <?php

                $logo = ApplicationSetting::find(6)->image;

            ?>

            @if(isset($logo))
            <a href="{{ route('home') }}">

                <img style="width:280px; height:auto;" src="{{ asset('assets/frontend/images/'. $logo) }}" alt="Logo">
            
            </a>
            @endif
        
        </div>
        <!-- <div class="contact pull-left" style="float: left !important; margin-top:10px;margin-left:100px;">
                                        <p style="color:#000; margin-top: 16px;"><img src="assets/frontend/images/whatsapp-logo.png"> <strong>999999999</strong><img src="assets/frontend/images/viber.png"></p>
                                    </div> -->

        <div class="wrapper_contact">
       <!--  <div class="live_icon">               
            <div class="live_messenger">
                <a href="#"><img src="{{asset('assets/frontend/images/live-chat.png')}}" alt=""  /></a>
            </div>
        </div> -->
        
        <div class="live_icon">

                <div  style="float:right; margin-bottom: 20px; ">
                    <p>Call Us: {{ ApplicationSetting::find(7)->phone_number }}</p>

                     @if(ApplicationSetting::find(2)->value == 1) 
                                    

                                @else

                                <div class="lan" style="padding-left:50px; margin-bottom: 4px;">
                                    
                                    <form class="serch" method="post" action="{{URL::route('currency-change')}}">
                                     <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <input type="hidden" name="currency" value="usd">
                                    <button style="float:left;" type="submit">USD</button>
                                    </form>
                                    
                                    <span style="float:left; color:white;"> &nbsp;</span>
                                    <form class="serch" method="post" action="{{URL::route('currency-change')}}">
                                     <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <input type="hidden" name="currency" value="npr">
                                    <button style="float:left;" type="submit">NPR</button>
                                    </form>
                                    <br clear="all">
                                    

                                
                                </div>

                                @endif


                    @if (!Sentry::check())
                    
                    <div style="margin-bottom:4px;">
                        <button class="btn btn-primary" data-toggle="modal" href="#agency_login">Agency Login</button>
                        <button class="btn btn-success" data-toggle="modal" href="#agency_signup">Agency Signup</button>
                    </div>
                    <div>
                        <button class="btn" data-toggle="modal" href="#customer_login">Customer Login</button>
                        <button class="btn btn-info" data-toggle="modal" href="#customer_signup">Customer Signup</button>
                    </div>
                   
                    @endif
            </div> <!-- /contact -->
            
            @if (Sentry::check())
            <ul class="nav pull-right" style="background: #ffffff; border:1px solid #dddddd; border-radius:4px; padding-left:0px; margin-top: 0px;" >
            

            <?php
                $user = Sentry::getUser(); 
                $group = Sentry::getGroupProvider(); 
                $admin = $group->findById(1);
                $agent = $group->findById(3);        
            ?>

            <li style="text-align:center; color: #000000;">

                    Welcome, {{ Sentry::getUser()->first_name }}
                                                
                <ul id="dropped">
                    
                    <li><a href="{{ route('dashboard') }}"><i class="icon-cog"></i> Dashboard</a></li>
                    <li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i> Your profile</a></li>
                    <li><a href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>

                    <br clear="all">
                </ul>
            </li>
           
        </ul>
         @endif

        </div>      
        </div>
    </div><!--end header -->

     </div><!--end wrapper -->

    @if(Request::is('/')) 
 
             <div class="banner">
        <!-- <img src="{{asset('assets/frontend/images/bg.png')}}" alt="" id="background" />-->
        <div class="banner-wrapper">
        
            <div class="reservation">

                <div style="">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab"><div class="flights"></div>Flights</a></li>
                    <li class=""><a href="#two" data-toggle="tab"><div class="booking"></div>Package Tours</a></li>
                    <li class=""><a href="#three" data-toggle="tab"><div class="hotels"></div>Hotels</a></li>
                    <li class=""><a href="#four" data-toggle="tab"><div class="deals"></div>Vacation Rentals</a></li>
                    <li class=""><a href="#five" data-toggle="tab"><div class="bus"></div>Vehicle Rentals</a></li>
                  </ul>

                  <div class="tabbable">

                    <form id="flight_form"  action="{{route('flightsearch')}}" method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                        <input type="hidden" name="dom_int" value="domestic" /> 
                                    
                    <div class="tab-content">
                      <div class="tab-pane active" id="one">

                        <div class="left">
                            <h1 style="margin:6px;">BOOK DOMESTIC &amp; INTERNATIONAL FLIGHT TICKET</h1>
                            <div class="booking-button">
                                <ul class="booking-button-nav">
                                    <li id="domestic_active" class="active">Domestic</li>
                                    <li id="international_active">International</li>
                                </ul>

                                <div style="float:left; margin-top:24px; margin-left:70px;">

                                    <div class="radiobtn">
                                        <input class="darkblue" type="radio" name="trip_type" value="O" id="oneway" checked="checked"> One way 
                                        <input class="darkblue" type="radio" name="trip_type" value="R" id="returnn"> Return
                                        <input class="darkblue" type="radio" name="trip_type" value="M" id="returnn"> Multi City
                                    </div> 
                                   
                                </div>
                            </div>

                            <div class="girl"></div>

                            <div class="clr"></div>


                            <div class="box">
                           
                            <table class="sbox">
                                <tbody><tr>
                                    <td><span class="textd">From</span></td>
                                    <td colspan="2"><span class="textd">To</span></td>
                                </tr>
                                <tr>
                                    <td>                                        
                                        <select  id="sector_from" name="sectorFrom">
                                                <option value="KTM" SELECTED>KATHMANDU</option> 

                                                <option value="BDP">BHADRAPUR</option>

                                                <option value="BWA">BHAIRAHAWA</option>

                                                <option value="BHR">BHARATPUR</option>

                                                <option value="BIR">BIRATNAGAR</option>

                                                <option value="DHI">DHANGADI</option>

                                                <option value="JKR">JANAKPUR</option>

                                                <option value="KTM">KATHMANDU</option>

                                                <option value="MTN">MOUNTAIN</option>

                                                <option value="KEP">NEPALGUNJ</option>

                                                <option value="PKR">POKHARA</option>

                                                <option value="SIF">SIMARA</option>
                                        </select>

                                        <input id="int_origin" type="text" name="origin" style="display:none; width:206px;">

                                    </td>                              
                                
                                    <td>
                                        <div class="going">
                                        <select id="sector_to" name="sectorTo">
                                                <option value="PKR"  SELECTED>POKHARA</option>

                                                <option value="BDP">BHADRAPUR</option>

                                                <option value="BWA">BHAIRAHAWA</option>

                                                <option value="BHR">BHARATPUR</option>

                                                <option value="BIR">BIRATNAGAR</option>

                                                <option value="DHI">DHANGADI</option>

                                                <option value="JKR">JANAKPUR</option>

                                                <option value="KTM">KATHMANDU</option>

                                                <option value="MTN">MOUNTAIN</option>

                                                <option value="KEP">NEPALGUNJ</option>

                                                <option value="PKR">POKHARA</option>

                                                <option value="SIF">SIMARA</option>
                                        </select>

                                        <input id="int_destination" type="text" name="destination" style="display:none; width:206px;" >

                                    </td>
                                    <td>                                   
                                    </td>
                                </tr>
                                <tr>
                                    <td id="divp" colspan="3">
                                        <div>
                                            <p>Departure</p>
                                            <input type="text" style="font-size:10px; width:56px;" class="flight_date" name="flight_date" value="<?php echo date('d-m-Y');?>" id="datepicker1">
                                            <input style="display:none; font-size:10px; width:56px;" type="text" class="flight_date_intl" name="flight_date_intl" value="<?php echo date('Y-m-d');?>" id="datepicker1_intl">                                        
                                        </div>
                                        <div id="returndiv" style="visibility:hidden;">
                                            <p>Return</p>
                                            <input type="text" style="font-size:10px; width:56px;" class="return_date" name="return_date" value="<?php echo date('d-m-Y');?>" id="datepicker2">
                                            <input style="display:none; font-size:10px; width:56px;" type="text" class="return_date_intl" name="return_date_intl" value="<?php echo date('Y-m-d');?>" id="datepicker2_intl">
                                        </div>  

                                        <div>
                                            <p>Adult <span class="subtextd">(12+ yrs)</span></p>
                                             <select name="adults">
                                                <option value="0">0</option>
                                                <option value="1" selected="">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>                                             
                                            </select>
                                        </div>    
                                        
                                        <div>
                                            <p>Children <span class="subtextd">(2-12 yrs)</span></p>
                                            <select name="children">
                                                <option value="0" selected="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>   
                                        
                                        <div style="display:none;">
                                            <p>Infant <span class="subtextd">(0-2 yrs)</span></p>
                                            <select name="infants">
                                                <option value="0" selected="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>   

                                        <div>
                                                <p>Nationality</p>
                                            <select name="nationality">
                                                <option value="NP">Nepalese</option>
                                                <option value="IN">Indian</option>
                                                <option value="US">Others</option>
                                            </select>
                                        </div> 

                                        <div>
                                                <p>Class</p>
                                                  <select name="class">
                                                        <option value="Economy">Economy</option>
                                                        <option value="Business">Business</option>
                                                    </select>
                                        </div>                                     
                                    </td>
                                </tr>
                           
                            </tbody>
                            </table>
                            <div class="searchdiv"><input type="submit" name="sflight" class="sflight" value="Search For Flights"></div>
                            </div>

                        </div>

                        </form>

                      </div> <!-- / tab-pane one -->

                      <div class="tab-pane" id="two" style="width: 468px; padding-left: 100px;">
                        <h1> SEARCH PACKAGE TOURS</h1>
                        <form action="{{URL::route('searchbox1')}}" method="post">
                                 
                                    <div class="trip" style="display:block; height:20px;">
                                        
                                    </div>
                                    
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label>Country</label>
                                            <select name="package_country" id="package_country" style="width:453px;" >
                                            <option>Select Country...</option>

                                            @foreach($countries as $country)                                            
                                                <option value="{{ $country->id }}">{{ $country->value }}</option>                                           
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  
 
                                    <div class="location clearfix">

                                        <div class="pull-left">
                                           
                                            <label style="background:none;">State</label>

                                            <select name="package_state">
                                                <option>Select State..</option>
                                            </select>                                       
                                            
                                        </div>
                                        <div class="pull-left">
                                            <div class="personss">
                                                <div class="ad">
                                                    <label>Area</label>
                                                    <select name="package_area_city">
                                                        <option>Select Area..</option>
                                                    </select>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="search">
                                        <input type="submit" name="search" value="SEARCH" >
                                    </div>
                        </form>
                      </div>

                      <div class="tab-pane" id="three">
                        <form action="{{URL::route('searchbox2')}}" method="post">
                                 
                                    <div class="trip" style="display:block; height:20px; margin-bottom:12px;">
                                        <h1> Search  Hotels</h1>
                                    </div>
                                    
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                                    <div class="location clearfix">
                                       <div class="pull-left" style="min-width:100px;">
                                            <label>Country</label>
                                            <select name="hotel_country" id="country_id_T" style="width:200px;" >
                                                <option>Select Country...</option>
                                            @foreach($countries as $country)                                            
                                                <option value="{{ $country->id }}">{{ $country->value }}</option>                                           
                                            @endforeach
                                            </select>
                                        </div> 

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Check In</label>
                                            <input type="text" style="width:150px;" name="check_in" value="" id="checkin_picker">
                                        </div>

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Check Out</label>
                                            <input type="text" style="width:150px;" name="check_out" value="" id="checkout_picker">
                                        </div>
                                    </div> 

                                    <div class="location clearfix">     
                                         <div class="pull-left">
                                            <label class="dst">Location : (e.g New York, Toronto, London, etc) </label>

                                            <select style="width:453px;" name="hotel_location"> 
                                                <option>Select Hotel Location...</option>
                                            </select>
                                        </div>                                
                                    </div> 

                                    <!--
                                    <div class="location clearfix">

                                        <div class="pull-left" style="min-width:100px;">
                                            <label>Class Ratings</label>
                                            <select name="class_ratings" style="width:200px;" >
                                                <option value="1">Select Class Ratings..</option>  
                                            </select>
                                        </div>

                                        <div class="pull-left" style="min-width:100px;">
                                            <label>Bed Type</label>
                                            <select name="bed_type" style="width:200px;" >
                                                <option value="double">Double Bed</option>  
                                                <option value="single">Single Bed</option>  
                                            </select>
                                        </div>

                                    </div>
                                    -->

                                    <div class="search">
                                        <input type="submit" name="search" value="SEARCH" >
                                    </div>
                                </form>
                      </div>
                      <div class="tab-pane" id="four">
                        <form action="{{URL::route('searchbox3')}}" method="post">
                                 
                                    <div class="trip" style="display:block; height:20px; margin-bottom:12px;">
                                        <h1> Search  Vacation Rentals</h1>
                                    </div>
                                    
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label class="dst">Group</label>
                                            <select name="group">
                                                <option>Any</option>
                                                <option>Vacation Rentals</option>
                                                <option>Beach Houses</option>
                                                <option>Timeshare Rentals</option>
                                            </select>
                                        </div>
                                        <div class="pull-left">
                                            <label>Postcode:</label>
                                            <input type="text" name="post_code">
                                        </div>                                    
                                    </div>                                   
 
                                    <div class="location clearfix">

                                        <div class="pull-left">
                                            <label>Country</label>
                                            <select name="vacation_country" id="country_id_T" class="medium">
                                                <option>Select Country...</option>
                                            @foreach($countries as $country)                                            
                                                <option value="{{ $country->id }}">{{ $country->value }}</option>                                           
                                            @endforeach
                                            </select>
                                        </div> 

                                        <div class="pull-left">
                                            <div class="personss">
                                                <div class="ad">
                                                    <label>State</label>
                                                    <select name="vacation_state">
                                                        <option>Select state..</option>
                                                    </select>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label>Area</label>
                                            <select name="vacation_area" class="medium">
                                                <option>Select Area..</option>
                                            </select>
                                        </div> 

                                        <div class="pull-left">
                                            <div class="personss">
                                                <div class="ad">
                                                    <label>Rental Type</label>
                                                    <select name="vacation_rental_type">
                                                        <option>Select Type..</option>
                                                        <option>Villa</option>
                                                        <option>House</option>
                                                        <option>Condo</option>
                                                        <option>Apartment</option>
                                                        <option>Boat</option>
                                                        <option>Cabin</option>
                                                    </select>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="pull-left" style="width:600px;">
                                            <div class="personss">
                                                <div class="ad pull-left">
                                                    <label>Bedroom</label>
                                                    <select name="vacation_bedroom">
                                                        <option>Any</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                    </select>
                                                </div>

                                                <div class="pull-left" style="min-width:150px;">
                                                    <label class="dst">Check In</label>
                                                    <input type="text" style="width:150px;" name="check_in" value="" id="checkin_picker2">
                                                </div>

                                                <div class="pull-left" style="min-width:150px;">
                                                    <label class="dst">Check Out</label>
                                                    <input type="text" style="width:150px;" name="check_out" value="" id="checkout_picker2">
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="search">
                                        <input type="submit" name="search" value="SEARCH" >
                                    </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="five">
                        <form action="{{URL::route('searchbox4')}}" method="post">
                                 
                                    <div class="trip" style="display:block; height:20px;">
                                        
                                    </div>
                                    
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                                    <div class="pull-left" style="min-width:100px;">
                                            <label>Country</label>
                                            <select name="vehicle_country" id="country_id_T" style="width:200px;" >
                                                <option>Select Country...</option>
                                            @foreach($countries as $country)                                            
                                                <option value="{{ $country->id }}">{{ $country->value }}</option>                                           
                                            @endforeach
                                            </select>
                                    </div> 

                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label>From</label>
                                            <select type="text" name="vehicle_from" style="width:400px;">
                                                <option>Please select a country first...</option>
                                            </select>
                                        </div>                            
                                    </div>
                                    
                                    <div class="location clearfix">
                                        <div class="pull-left">
                                            <label style="background:none;">To</label>
                                            <select type="text" name="vehicle_to" style="width:400px;">
                                                <option>Please select a country first...</option>
                                            </select>                                                                             
                                        </div>
                                    </div>



                                    <div class="location clearfix">
                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Pickup Date &amp; Time: </label>
                                            <input type="text" style="width:150px;" name="pickup_date" value="<?php echo date('Y-m-d');?>" id="pickup_date">
                                        </div>

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Return Date &amp; Time: </label>
                                            <input type="text" style="width:150px;" name="return_date" value="<?php echo date('Y-m-d');?>" id="return_date">
                                        </div>

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Car Rental Type: </label>
                                            <select name="car_rental_type" id="car_rental_type" class="form-control">
                                                <option value="">Select...........</option>
                                                <option value="1">Car</option>
                                                <option value="2">Van</option>
                                                <option value="3">Toyota Hiace</option>
                                                <option value="3">Minibus</option>
                                                <option value="3">Coaster</option>
                                                <option value="3">Satlajj Bus</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="location clearfix">
                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Type of Service: </label>
                                            <select name="service_type" id="service_type">
                                                <option value="" selected="selected">--Select Service--</option>
                                                <option value="Ride TO the airport">Ride TO the airport</option>
                                                <option value="Ride FROM the airport">Ride FROM the airport</option>
                                                <option value="Hourly Service">Hourly Service</option>
                                                <option value="Door to Door Service">Door to Door Service</option>
                                                <option value="Long Distance Service">Long Distance Service</option>
                                            </select>
                                        </div>

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Passengers: </label>
                                            <select name="vehicle_passengers" style="width: 200px;"  id="vehicle_passengers" class="form-control">
                                                <option value="">Select...........</option>
                                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>                                    
                                            </select>
                                        </div>

                                        <div class="pull-left" style="min-width:150px;">
                                            <label class="dst">Luggage: </label>
                                            <select name="luggage" id="luggage" style="width: 200px;" class="form-control">
                                                <option value="">Select...........</option>
                                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>                                    
                                            </select>
                                        </div>

                                    </div>

                                    <div class="search">
                                        <input type="submit" name="search" value="SEARCH" >
                                    </div>
                        </form>
                      </div>
                    </div>

                    </form>

                  </div> <!-- /tabbable -->

                </div> <!-- /div style -->
           
            </div><!--end reservation -->
        
        <div class="main-slider">
            <div id="demo1" class="webwidget_slideshow_dot">
                <ul>
                    <li><a href="link1" title="Lord Shiva"><img src="{{asset('assets/frontend/images/slider_1.jpg')}}" width="407" height="555" alt="slideshow_large"/></a></li>
                    <li><a href="link2" title="Lord Buddha"><img src="{{asset('assets/frontend/images/slider_2.jpg')}}" width="407" height="555" alt="slideshow_large"/></a></li>
                    <li><a href="link3" title="Lord Shiva"><img src="{{asset('assets/frontend/images/slider_1.jpg')}}" width="407" height="555" alt="slideshow_large"/></a></li>
                    <li><a href="link4" title="Lord Buddha"><img src="{{asset('assets/frontend/images/slider_2.jpg')}}" width="407" height="555" alt="slideshow_large"/></a></li>
                </ul>
            </div>
        </div><!--end main-slider -->
    
    @else

    <style type="text/css">

    .nav-tabs a {
        color: #ffffff !important;
    }

    </style>

             <div class="banner" style="background: none;">
        <div class="banner-wrapper">
        
            <div class="reservation" style="
                    width: 100%;
                    background: none;
                    border: none;
                    height: auto;
                    margin-top: -10px;
                        ">

                <div style="background: #002D4E; width:100%; height:45px;">
                  <ul class="nav nav-tabs" style="margin: 0px; float:left;">
                    
                    <?php $menus = Menu::where('enable', '=', 1)->orderBy('id', 'ASC')->get(); $count_menu = Menu::count(); $menucount = 0; ?>
                                        
                    @foreach ($menus as $menu)
                    
                    <?php $menucount++; ?>
                    
                    <li><a style="background:none !important;" href="{{ URL::to($menu->slug) }}" {{ ($count_menu == $menucount ? ' class="last"' : '') }} > {{$menu->title}} </a> </li>
                                            
                    @endforeach   
                  </ul> 

                  <div style="float:right; margin-top: 7px; margin-right: 12px;">

                  <form class="serch" method="post" action="{{URL::route('search')}}">
                                     <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <input type="text" name="query" placeholder="Search"/>
                                </form>

                  </div>

                </div> <!-- /div style -->
           
            </div><!--end reservation -->
    

        @endif
        

<div class="clr"></div>


    </div><!--end banner --> 
      </div><!--end banner-wrapper --> 
<div class="clr">
    <div class="simple-ss" id="simple-ss"></div>
</div>
<div class="clr"></div>

<div class="mid_content">
                               
		  @include('frontend/notifications')

            <div style="width: 1045px; margin:auto;">

    			<!-- Content -->
    			@yield('content')

            </div>

 </div><!--end mid_content -->   

 <?php
        $package_tours = PackageTours::paginate(10);

        $hotels = Hotel::paginate(10);

        $vacation_rentals = VacationRental::paginate(10);

        $vehicle_rentals  = VehicleRental::paginate(10);
 ?>
  
<div class="clr"></div>
<div class="fotter12">
    <div class="fotter_wrapper">
        <div class="pacakages">
            <h1>Pacakage Offers</h1>
                <ul>
                @foreach($package_tours as $package)
                    <li><a href="{{ route('package-tours-show', $package->id) }}"> {{ $package->name }}</a></li>
                @endforeach
                </ul>
        </div><!--end pacakages -->
        <div class="pacakages">
            <h1>Hotel Offers</h1>
                 <ul>
                @foreach($hotels as $hotel)
                    <li><a href="{{ route('hotel-show', $hotel->id) }}"> {{ $hotel->name }}</a></li>
                @endforeach
                </ul>
        </div><!--end pacakages -->
                <div class="pacakages">
            <h1>Vacation Rental Offers</h1>
                <ul>
                @foreach($vacation_rentals as $vacation_rental)
                    <li><a href="{{ route('vacation-show', $vacation_rental->id) }}"> {{ $vacation_rental->name }}</a></li>
                @endforeach
                </ul>
        </div><!--end pacakages -->
        <div class="pacakages">
            <h1>Vehicle Rental Offers</h1>
               <ul>
                @foreach($vehicle_rentals as $vehicle_rental)
                    <li><a href="{{ route('vehicle-show', $vehicle_rental->id) }}"> {{ $vehicle_rental->name }}</a></li>
                @endforeach
                </ul>
        </div><!--end pacakages -->
        </div><!--end pacakages -->
         <div class="clr"></div>
    </div><!--end fotter_wrapper -->
   
    <div class="partner">
        <div class="partner_logo">
            <h1>We Accept</h1>
                <span><a href="#"><img src="{{asset('assets/frontend/images/partner/master-card.png')}}"  /></a></span>
                <span><a href="#"><img src="{{asset('assets/frontend/images/partner/paypal.png')}}" /></a></span>
                <span><a href="#"><img src="{{asset('assets/frontend/images/partner/internet-banking.png')}}" /></a></span>
        </div><!--end partner_logo -->
        <div class="partner_logo">
            <h1>Reward By</h1>
                <span><a href="#"><img src="{{asset('assets/frontend/images/partner/reward-by.png')}}"/></a></span>
                <span><a href="#"><img src="{{asset('assets/frontend/images/partner/trustwave.png')}}" /></a></span>
        </div><!--end partner_logo -->
        <div class="partner_logo">
            <h1>Secured</h1>
            <span><a href="#"><img src="{{asset('assets/frontend/images/partner/secured.png')}}" /></a></span>
        </div><!--end partner_logo -->
        <div class="partner_logo">
            <h1>Abacus</h1>
                <a href="#"><img src="{{asset('assets/frontend/images/partner/abacus.jpg')}}"  /></a>
        </div><!--end partner_logo -->
    </div><!--end partner -->
    <div class="clr"></div>
    <div class="sub-fotter12">
        <div class="fotter_wrapper">
        <div class="fotter_left1">
            <ul>
                <?php $menus = Menu::where('enable', '=', 1)->orderBy('id', 'ASC')->get(); $count_menu = Menu::count(); $menucount = 0; ?>
                                        
                @foreach ($menus as $menu)
                
                <?php $menucount++; ?>
                
                <li><a href="{{ URL::to($menu->slug) }}" {{ ($count_menu == $menucount ? ' class="last"' : '') }} >{{$menu->title}} </a> </li>
                                        
                @endforeach    

            </ul>
        </div><!--end fotter _left -->
        <div class="fotter_right">
            <p class="media">Copyright &copy; 2014 Black Eye Travel All Rights Reserved.</p>
        </div><!--end fotter_right --> 
        
        </div><!--end sub-fotter -->
    </div><!--end fotter-wrapper -->
</div><!--end footer -->


<!--responsive bootstrap modal -->

<div id="agency_login" class="modal hide fade" tabindex="-1" data-width="760">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Agent Login</h3>
  </div>
  <div class="modal-body">
     @if(ApplicationSetting::find(4)->value == 0)

                                    Login Disabled Temporarily. Please check back later.

                                 @else 

                                    <div class="row">
                                        <form method="post" action="{{ route('signin') }}" class="form-horizontal">
                                            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                            <!-- Email -->
                                            <div class="control-group{{ $errors->first('email', ' error') }}">
                                                <label class="control-label" for="email">Email</label>
                                                <div class="controls">
                                                    <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                                                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="control-group{{ $errors->first('password', ' error') }}">
                                                <label class="control-label" for="password">Password</label>
                                                <div class="controls">
                                                    <input type="password" name="password" id="password" value="" />
                                                    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                                </div>
                                            </div>

                                            <!-- Remember me -->
                                            <div class="control-group">
                                                <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
                                                </label>
                                                </div>
                                            </div>

                                            

                                            <!-- Form actions -->
                                            <div class="control-group">
                                                <div class="controls">
                                                    

                                                    <button type="submit" class="btn">Sign in</button>

                                                    <a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
    
  </div>
</div> <!-- /agency_login-->

<div id="agency_signup" class="modal hide fade" tabindex="-1" data-width="760">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Agent Signup</h3>
  </div>
  <div class="modal-body">
    @if(ApplicationSetting::find(4)->value == 0)

                                    Signup Disabled Temporarily. Please check back later.

                                     @else 
                                        <div class="row">
                                            <form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
                                                <!-- CSRF Token -->
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                              <input type="hidden" name="isagent" value="true" />


                                                <!-- First Name -->
                                                <div class="control-group{{ $errors->first('first_name', ' error') }}">
                                                <label class="control-label" for="first_name">First Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
                                                        {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Last Name -->
                                                <div class="control-group{{ $errors->first('last_name', ' error') }}">
                                                    <label class="control-label" for="last_name">Last Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
                                                        {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="control-group{{ $errors->first('email', ' error') }}">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                                                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Email Confirm -->
                                                <div class="control-group{{ $errors->first('email_confirm', ' error') }}">
                                                    <label class="control-label" for="email_confirm">Confirm Email</label>
                                                    <div class="controls">
                                                        <input type="text" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" />
                                                        {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="control-group{{ $errors->first('password', ' error') }}">
                                                    <label class="control-label" for="password">Password</label>
                                                    <div class="controls">
                                                        <input type="password" name="password" id="password" value="" />
                                                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Password Confirm -->
                                                <div class="control-group{{ $errors->first('password_confirm', ' error') }}">
                                                    <label class="control-label" for="password_confirm">Confirm Password</label>
                                                    <div class="controls">
                                                        <input type="password" name="password_confirm" id="password_confirm" value="" />
                                                        {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>


                                                <!-- Captcha -->
                                                <div class="control-group{{ $errors->first('captcha', ' error') }}">
                                                    <label class="control-label" >Captcha</label>
                                                    <div class="controls">
                                                        {{ HTML::image(Captcha::img(), 'Captcha image1') }}      
                                                        <br><br>
                                                        {{ Form::text('captcha') }}
                                                        {{ $errors->first('captcha', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Form actions -->
                                                <div class="control-group">
                                                    <div class="controls">
                                                        

                                                        <button type="submit" class="btn">Sign up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
    
  </div>
</div> <!-- /agency_signup-->

<div id="customer_login" class="modal hide fade" tabindex="-1" data-width="760">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Customer Login</h3>
  </div>
  <div class="modal-body">
     @if(ApplicationSetting::find(4)->value == 0)

                                    Login Disabled Temporarily. Please check back later.

                                 @else 

                                    <div class="row">
                                        <form method="post" action="{{ route('signin') }}" class="form-horizontal">
                                            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                            <!-- Email -->
                                            <div class="control-group{{ $errors->first('email', ' error') }}">
                                                <label class="control-label" for="email">Email</label>
                                                <div class="controls">
                                                    <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                                                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="control-group{{ $errors->first('password', ' error') }}">
                                                <label class="control-label" for="password">Password</label>
                                                <div class="controls">
                                                    <input type="password" name="password" id="password" value="" />
                                                    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                                </div>
                                            </div>

                                            <!-- Remember me -->
                                            <div class="control-group">
                                                <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
                                                </label>
                                                </div>
                                            </div>

                                            

                                            <!-- Form actions -->
                                            <div class="control-group">
                                                <div class="controls">
                                                    

                                                    <button type="submit" class="btn">Sign in</button>

                                                    <a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
    
  </div>
</div> <!-- /customer_login-->

<div id="customer_signup" class="modal hide fade" tabindex="-1" data-width="760">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Customer Signup</h3>
  </div>
  <div class="modal-body">
    @if(ApplicationSetting::find(4)->value == 0)

                                    Signup Disabled Temporarily. Please check back later.

                                     @else 
                                        <div class="row">
                                            <form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
                                                <!-- CSRF Token -->
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                <!-- First Name -->
                                                <div class="control-group{{ $errors->first('first_name', ' error') }}">
                                                <label class="control-label" for="first_name">First Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
                                                        {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Last Name -->
                                                <div class="control-group{{ $errors->first('last_name', ' error') }}">
                                                    <label class="control-label" for="last_name">Last Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
                                                        {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="control-group{{ $errors->first('email', ' error') }}">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                                                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Email Confirm -->
                                                <div class="control-group{{ $errors->first('email_confirm', ' error') }}">
                                                    <label class="control-label" for="email_confirm">Confirm Email</label>
                                                    <div class="controls">
                                                        <input type="text" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" />
                                                        {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="control-group{{ $errors->first('password', ' error') }}">
                                                    <label class="control-label" for="password">Password</label>
                                                    <div class="controls">
                                                        <input type="password" name="password" id="password" value="" />
                                                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Password Confirm -->
                                                <div class="control-group{{ $errors->first('password_confirm', ' error') }}">
                                                    <label class="control-label" for="password_confirm">Confirm Password</label>
                                                    <div class="controls">
                                                        <input type="password" name="password_confirm" id="password_confirm" value="" />
                                                        {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>


                                                <!-- Captcha -->
                                                <div class="control-group{{ $errors->first('captcha', ' error') }}">
                                                    <label class="control-label" >Captcha</label>
                                                    <div class="controls">
                                                        {{ HTML::image(Captcha::img(), 'Captcha image2') }}      
                                                        <br><br>
                                                        {{ Form::text('captcha') }}            
                                                        {{ $errors->first('captcha', '<span class="help-block">:message</span>') }}
                                                    </div>
                                                </div>

                                                <!-- Form actions -->
                                                <div class="control-group">
                                                    <div class="controls">
                                                        

                                                        <button type="submit" class="btn">Sign up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
    
  </div>
</div> <!-- /customer_signup-->

<!-- /Responsive Modal box -->


<script type="text/javascript" src="{{asset('assets/frontend/js/classie.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/js/modalEffects.js')}}"></script> 
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap-modalmanager.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap-modal.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        jQuery.fn.visible = function() {
            return this.css('visibility', 'visible');
        };

        jQuery.fn.invisible = function() {
            return this.css('visibility', 'hidden');
        };

        jQuery.fn.visibilityToggle = function() {
            return this.css('visibility', function(i, visibility) {
                return (visibility == 'visible') ? 'hidden' : 'visible';
            });
        };

        $('input[name="trip_type"]').change(function() {
            trip_type = $(this).val();
            if (trip_type == 'O') {
                $('#returndiv').invisible();
            } else {
                $('#returndiv').visible();
            }
        });

        passengers_allowed = 9;

        $('select[name="adults"]').change(function() {

            total_adults = parseInt($(this).val()) || 0;
            total_children = parseInt($('select[name="children"]').val()) || 0;

            remaining = passengers_allowed - (total_adults);

            options = [];

            for (i = remaining; i >= 0; i--) {
                options[options.length] = i;
            };

            options.sort();

            //alert(JSON.stringify(formatted_options));

            formatted_options = '';

            for (index = 0; index < options.length; index++) {

                formatted_options += '<option value="'+index+'">'+index+'</option>';
            };

            if ( options.indexOf(total_children) == -1 ) {
                formatted_options += '<option value="'+total_children+'">'+total_children+'</option>';                
            };

            $('select[name="children"]').html(formatted_options);
           $('select[name="children"] option[value='+total_children+']').prop('selected', true);
           
        });

        $('select[name="children"]').change(function() {

            total_children = parseInt($(this).val()) || 0;
            total_adults = parseInt($('select[name="adults"]').val()) || 0;

            remaining = passengers_allowed - (total_children);

            options = [];

            for (i = remaining; i >= 0; i--) {
                options[options.length] = i;
            };

            options.sort();

            //alert(JSON.stringify(formatted_options));

            formatted_options = '';

            for (index = 0; index < options.length; index++) {
                formatted_options += '<option value="'+index+'">'+index+'</option>';
            };

            if ( options.indexOf(total_adults) == -1 ) {
                formatted_options += '<option value="'+total_adults+'">'+total_adults+'</option>';
            };

            $('select[name="adults"]').html(formatted_options);

             $('select[name="adults"] option[value='+total_adults+']').prop('selected', true);

            //$('select[name="adults"]').val(total_adults).change();
            //$('select[name="adults"] option[value='+total_adults+']').prop('selected', true); 
        });

        $('#domestic_active').click(function() { 
            $('#international_active').removeClass('active');
            $(this).addClass('active');

            $('#int_origin').hide();
            $('#int_destination').hide();

            $('#sector_from').show();
            $('#sector_to').show();

            $('#datepicker1_intl').hide();
            $('#datepicker2_intl').hide();
            
            $('#datepicker1').show();
            $('#datepicker2').show();

            $('form#flight_form input[name="dom_int"]').val('domestic');
        });

        $('#international_active').click(function() { 
            $('#domestic_active').removeClass('active');
            $(this).addClass('active');

            $('#sector_from').hide();
            $('#sector_to').hide();

            $('#int_origin').show();
            $('#int_destination').show();
            
            $('#datepicker1').hide();
            $('#datepicker2').hide();

            $('#datepicker1_intl').show();
            $('#datepicker2_intl').show();

            $('form#flight_form input[name="dom_int"]').val('international');
        });

        $(function() {
            <?php
            include(app_path().'/includes/airports.php');


            echo 'var availableTags = ['. $airports .'];';
            ?>

            
            $( "#int_origin" ).autocomplete({
              source: availableTags,
              minLength: 3
            });

            $( "#int_destination" ).autocomplete({
              source: availableTags,
              minLength: 3
            });

        });

    });
</script>

<?php 

if(Session::has('loginboxerror')) {

Session::forget('loginboxerror');

}

?>



@yield('customjs')

</div> <!-- .page_container -->
</body>
</html>          