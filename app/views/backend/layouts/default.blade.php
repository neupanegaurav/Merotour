<!DOCTYPE html>
<!--
  Product:        Social - Premium Responsive Admin Template
  Version:        v1.5.1
  Copyright:      2013 CesarLab.com
  License:        http://themeforest.net/licenses
  Live Preview:   http://go.cesarlab.com/SocialAdminTemplate
  Purchase:       http://go.cesarlab.com/PurchaseSocial
-->
<html>
  
  <head>
    <meta charset="utf-8">
    <!-- <title>
      Blackeye Journeys - Admin Dashboard
    </title> -->
    <title>
      Mero Tour - Admin Dashboard
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{asset('assets/backend/img/favicon.ico')}}" />
    <link rel="icon" type="image/gif" href="{{asset('assets/backend/img/favicon.gif')}}">

    <!-- BEGIN STYLE CODES -->
    
    <link href="{{asset('assets/backend/css/twitter-bootstrap/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/social-jquery-ui-1.10.0.custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/social.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/social.plugins.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/social-coloredicons-buttons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap-modal.css') }}">
  
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="/templates/social/assets/backend/css/social-jquery.ui.1.10.0.ie.css')}}"/>
    <![endif]-->

    <link href="{{asset('assets/backend/css/demo.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/plugins/jquery.uipro/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/plugins/jquery.simplecolorpicker/jquery.simplecolorpicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/themes/social.theme-blue.css')}}" rel="stylesheet" id="theme">
    <link href="{{asset('assets/backend/css/twitter-bootstrap/bootstrap-responsive.css')}}" rel="stylesheet">
    
    <style>
      .wraper #main{
        margin-top: 40px;
      }
    </style>
    <!-- END STYLE CODES -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{asset('assets/backend/plugins/html5shiv.js')}}"></script>
    <![endif]-->
  </head>
  <body>
            <!-- BEGIN WRAPER -->
    <div class="wraper sidebar-full">
      <!-- BEGIN SIDEBAR -->
      <aside class="social-sidebar sidebar-full">
    <!-- BEGIN USER SETTINGS -->
    <div class="user-settings">
        <div class="arrow"></div>
        <h3 class="user-settings-title">Settings shortcuts</h3>
        <div class="user-settings-content">
            <a href="pages/basic-user-profile.html">
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
                <div class="title">My Profile</div>
                <div class="content">View your profile</div>
            </a>
            <a href="pages/chat-inbox.html">
                <div class="icon">
                    <i class="icon-envelope"></i>
                </div>
                <div class="title">View Messages</div>
                <div class="content">You have <strong>17</strong> new messages</div>
            </a>
            <a href="#view-pending-tasks">
                <div class="icon">
                    <i class="icon-tasks"></i>
                </div>

                <div class="title">View Tasks</div>
                <div class="content">You have <strong>8</strong> pending tasks</div>
            </a>
        </div>
        <div class="user-settings-footer">
            <a href="#more-settings">See more settings</a>
        </div>
    </div>
    <!-- END USER SETTINGS -->

    <div class="social-sidebar-content">
        <div class="scrollable">
            <!-- BEGIN USER INFO SECTION -->
            <div class="user">
              <img class="avatar" width="25" height="25" src="{{ asset('assets/backend/img/avatar-30.png') }}">
              <span>{{ Sentry::getUser()->first_name . " " . Sentry::getUser()->last_name }}</span>
             </div>
            <!-- END USER INFO SECTION -->
            
            
            <!-- BEGIN MENU SECTION -->
            <section class="menu">
                <!-- BEGIN ACCORDION SECTION -->
                <div class="accordion" id="accordion2">
                                                                                                                                                                            
                 

                  <!-- BEGIN ACCORDION GROUP -->
                  <div class="accordion-group active">
                    <!-- BEGIN ACCORDION HEADING -->
                    <div class="accordion-heading">

                  <?php

                    $user = Sentry::getUser();
                    $group = Sentry::getGroupProvider();
                    $admin = $group->findById(1); 
                    $nuser = $group->findById(2);  
                    $agent = $group->findById(3); 
                    $affiliate = $group->findById(4);
                    $manager = $group->findById(5); 
                    $distributor = $group->findById(6);
                    $corporate = $group->findById(7);

                  ?>


                  <a class="accordion-toggle 

                  @if(Request::is('admin') or Request::is('agent'))
                  opened
                  @endif
                  " 
                  href="{{route('dashboard')}}">
                      
                                              <img src="{{ asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/home.png') }}" alt="Dashboard">
                      

                    <span>Dashboard </span><span class="badge">9</span>
                        </a>
                    </div>
                    <!-- END ACCORDION HEADING -->
                                      </div>
                  <!-- END ACCORDION GROUP -->

            @if($user->inGroup($admin) or $user->inGroup($manager)) 
                  
                      <!-- BEGIN ACCORDION GROUP -->
                      <div class="accordion-group ">
                        <!-- BEGIN ACCORDION HEADING -->
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse-account">
                                                             
                        <span>Account Management </span>
                            </a>
                        </div>

                      
                        <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-account" class="accordion-body nav nav-list collapse ">
                                                              <li><a href="{{route('payment-verify')}}">Payment Verify</a></li>
                                                              <!--<li><a href="{{route('ledger-master')}}">Ledger Master</a></li>
                                                              <li><a href="{{route('configure-account')}}">Configure Account</a></li>-->
                                                              <li><a href="{{route('general-voucher')}}">General Voucher</a></li>
                                                              <li><a href="{{route('unapprove-voucher')}}">Unapproved Voucher</a></li>
                                                              <li><a href="{{route('credit-limit-management')}}">Credit Limit Management(Agent)</a></li>
                                                              <li><a href="{{route('credit-limit-management-bo')}}">Credit Limit Management(Branch Office)</a></li>
                                                              <li><a href="{{route('credit-limit-management-db')}}">Credit Limit Management(Distributor)</a></li>                                                              <li><a href="{{route('service-provider-setting')}}">Service Provider Setting</a></li>
                                                      </ul>
                          <!-- END MENU LIST ITEMS -->
                                        </div>
                    <!-- END ACCORDION GROUP -->
                                                                                                                                                                              
                   <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-files-media">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/photography.png')}}" alt="Files &amp; Media">
                        
                      
                      <span>Reports </span>
                          </a>
                      </div>
                      

                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-files-media" class="accordion-body nav nav-list collapse ">
                            <li><a href="{{route('b-o-ledger-transaction')}}">Branch Office Ledger Transaction</a></li>
                            <li><a href="{{route('db-ledger-transaction')}}">Distributor Ledger Transaction</a></li>
                            <li><a href="{{route('agent-ledger-transaction')}}">Agent Ledger Transaction</a></li>
                            <li><a href="{{route('credit-limit-transaction')}}">Credit Limit Transaction</a></li>                            
                            <li><a href="{{route('agent-balance')}}">Agent Available Balance</a></li>
                            <li><a href="{{route('login-history')}}">Login History</a></li>
                            <!--<li><a href="#">Sales Report</a></li>-->  
                            <li><a href="{{route('ledger-transaction-summary')}}">Ledger Transaction Summary</a></li>
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                                        </div>
                    <!-- END ACCORDION GROUP -->
                                                   
                   

                                                        

                  <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-form-stuff">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/sitemap.png')}}" alt="Form Stuff">
                        

                      <span> System Setup </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                                                      <ul id="collapse-form-stuff" class="accordion-body nav nav-list collapse">
                                                              <li><a href="{{ route('application-setting')}}">Application Setting</a></li>
                                                              <li><a href="{{ route('fx-rate') }}">FX Rate Setting</a></li> 
                                                              <li><a href="{{route('branch-offices')}}">Branch Office Management</a></li>
                                                      </ul>
                          <!-- END MENU LIST ITEMS -->
                                        </div
                    <!-- END ACCORDION GROUP -->
                                                                                                                                                                              
                    <!-- BEGIN MULTI LEVEL ACCORDION GROUP -->
                                        <!-- END MULTI LEVEL ACCORDION GROUP -->


                      <!-- BEGIN MULTI LEVEL ACCORDION GROUP -->
                                              <div class="accordion-group">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse-multi-level">
                              <i class="icon-sitemap icon-2"></i>
                              <span>User Management </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <!-- You need to add the class .sub-menu whe you want more than 2 levels -->
                      <ul id="collapse-multi-level" class="accordion-body nav nav-list collapse sub-menu">
                        <li>
                            <!-- Those sub-multi-level trigers must have the
                                  property data-toggle="sub-menu-collapse"
                                  and the property data-target with a selector
                                  the refers the element that this collapses
                            -->
                            <a href="{{ route('create/user') }}" data-toggle="sub-menu-collapse" data-target="#collapse-2-level">
                                <span>Back Office User Registeration</span>
                                
                            </a>
                        </li>
                        <!-- BEGIN 3-LEVEL -->
                        <!-- The class .collapse is important -->
                        <ul id="collapse-2-level" class="nav nav-list collapse">
                            <li>
                                <!-- Those sub-multi-level trigers must have the
                                    property data-toggle="sub-menu-collapse" and
                                    the property data-target with a selector the
                                    refers the element that this collapses
                                -->
                                <a href="#" data-toggle="sub-menu-collapse" data-target="#collapse-3-level">
                                  <span>Sub Element 1</span>
                                  
                                </a>
                            </li>
                            <!-- BEGIN 4-LEVEL -->
                            <!-- The class .collapse is important -->
                            <ul id="collapse-3-level" class="nav nav-list collapse">
                                <li><a href="#">Element 1</a></li>
                                <li><a href="#">Element 2</a></li>
                                <li><a href="#">Element 3</a></li>
                            </ul>
                            <!-- END 4-LEVEL -->
                            <li><a href="#">Sub Element 2</a></li>
                            <li><a href="#">Sub Element 3</a></li>
                            <li><a href="#">Sub Element 4</a></li>
                        </ul>
                        <!-- END 3-LEVEL -->
                        <li>
                          <!-- Those sub-multi-level trigers must have the
                              property data-toggle="sub-menu-collapse" and
                              the property data-target with a selector the
                              refers the element that this collapses
                          -->
                          <a href="{{ route('users') }}" data-toggle="sub-menu-collapse" data-target="#collapse-2-level2">
                            <span>Manage Users</span>
                            
                          </a>
                        </li>
                        <!-- BEGIN 3-LEVEL -->
                        <!-- The class .collapse is important -->
                        <ul id="collapse-2-level2" class="nav nav-list collapse">
                            <li>
                                <a href="#">
                                <span>Sub Element 1</span>
                            </a>
                            </li>
                            <li><a href="#">Sub Element 2</a></li>
                        </ul>
                        <!-- END 3-LEVEL -->
                        <li><a href="{{ route('groups') }}">Manage Roles</a></li>
                       </ul>
                    <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END MULTI LEVEL ACCORDION GROUP -->
                   
                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-ui-elements">

                        <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/database.png')}}" alt="UI Elements">
          
                      <span>Agent Management </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                        <!-- BEGIN MENU LIST ITEMS -->
                        <ul id="collapse-ui-elements" class="accordion-body nav nav-list collapse ">
                          <li><a href="{{ route('agent-management')}}">Agents</a></li>
                          <li><a href="{{route('create/agent')}}">Agent Signup</a></li>
                        </ul>
                        <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->                                                                                                                                                             

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-manager-management">
                          <span>Manager Management </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <ul id="collapse-manager-management" class="accordion-body nav nav-list collapse ">
                        <li><a href="{{ route('manager-management')}}">Managers</a></li>
                        <li><a href="{{route('create/manager')}}">Manager Signup</a></li>              
                      </ul>
                      <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->  
                
                   <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-b2c">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        

                      <span>B2C </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                                                      <ul id="collapse-b2c" class="accordion-body nav nav-list collapse ">
                                                              <li><a href="{{ route('b2c-userslist') }}">Users List</a></li>
                                                         
                                                      </ul>
                          <!-- END MENU LIST ITEMS -->
                                        </div>
                    <!-- END ACCORDION GROUP -->


                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-generalsettings">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        

                      <span>General Settings </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-generalsettings" class="accordion-body nav nav-list collapse ">
                                                              <li><a href="{{route('slider')}}">Slider Management</a></li>
                                                              <li><a href="{{route('banner')}}">Banner Management</a></li>
                                                              <li><a href="{{route('blogs')}}">News Management</a></li>
                                                              <li><a href="{{route('mailinglist')}}">Newsletter Management</a></li>
                                                              <li><a href="{{route('menu')}}">Menu Management</a></li>
                                                              <li><a href="{{route('product-comments')}}">Comments Management</a></li>
                                                             
                                                      </ul>
                          <!-- END MENU LIST ITEMS -->
                                        </div>
                    <!-- END ACCORDION GROUP -->


                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-airlines">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        
                        <span>Airlines </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-airlines" class="accordion-body nav nav-list collapse">
                              <li><a href="{{route('create/issued-tickets')}}">New Booking</a></li>
                              <li><a href="{{route('reserved-tickets')}}">Reserved Tickets</a></li>
                              <li><a href="{{route('issued-tickets')}}">Issued Tickets</a></li>
                              <li><a href="{{route('cancelled-tickets')}}">Cancelled Tickets</a></li>
                              <li><a href="{{route('flight_airlines')}}" >Flight Airlines</a></li> 
                              <li><a href="{{route('flight_airport')}}" >Flight Airports</a></li>
                              <li><a href="{{route('paper-fare')}}" >Paper Fare</a></li>
                              <li><a href="{{route('deal-setup')}}">Deal Setup</a></li>
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group">
                        <!-- BEGIN ACCORDION HEADING -->
                        <div class="accordion-heading">
                            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-cities-management">
                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">             
                                <span>Cities Management </span>
                            </a>
                        </div>
                        <!-- END ACCORDION HEADING -->
                        <!-- BEGIN MENU LIST ITEMS -->
                        <ul id="collapse-cities-management" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('cities-management') }}">Cities List</a></li>
                              <li><a href="{{route('cities-management/create')}}">Create New City</a></li>         
                        </ul>
                        <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group">
                        <!-- BEGIN ACCORDION HEADING -->
                        <div class="accordion-heading">
                            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-packagetours">
                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">             
                                <span>Package Tours </span>
                            </a>
                        </div>
                        <!-- END ACCORDION HEADING -->
                        <!-- BEGIN MENU LIST ITEMS -->
                        <ul id="collapse-packagetours" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('package_tours') }}">Package Tours List</a></li>
                              <li><a href="{{route('create_package_tour')}}">Create New Package</a></li>
                              <li><a href="{{route('orders_package_tour')}}" >Orders</b></a></li>
                              <li><a href="{{route('cancelled_orders_package_tour')}}" >Cancelled Orders</b></a></li>           
                        </ul>
                        <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-hotels">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        

                      <span>Hotels </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-hotels" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('hotels')}}">Hotels List</a></li>
                              <li><a href="{{route('create_hotel')}}">Create New Hotel</a></li> 
                              <li><a href="{{route('orders_hotel')}}" >Orders</b></a></li>
                              <li><a href="{{route('cancelled_orders_hotel')}}" >Cancelled Orders</b></a></li>                       
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-vacationrentals">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        

                      <span>Vacation Rentals </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-vacationrentals" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('vacation_rentals')}}">Vacation Rentals List</a></li>
                              <li><a href="{{route('create_vacation_rentals')}}">Create Vacation Rental</a></li>            
                              <li><a href="{{route('orders_vacation_rentals')}}" >Orders</b></a></li>  
                              <li><a href="{{route('cancelled_orders_vacation_rentals')}}" >Cancelled Orders</b></a></li>                               
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-vehiclerentals">
  
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">                      

                      <span>Vehicle Rentals </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-vehiclerentals" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('vehicle_rentals')}}">Vehicle Rentals List</a></li>
                              <li><a href="{{route('create_vehicle_rentals')}}">Create Vehicle Rental</a></li>                                   
                              <li><a href="{{route('orders_vehicle_rentals')}}" >Orders</b></a></li>  
                              <li><a href="{{route('cancelled_orders_vehicle_rentals')}}" >Cancelled Orders</b></a></li>                               
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->


                     <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-paymentgateways">
                        
                            <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        
                            <span> Payment Gateways </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-paymentgateways" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('payment-gateways')}}">Settings</a></li>
                              
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-commission">
    
                            <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        
                            <span> Commission </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                        <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-commission" class="accordion-body nav nav-list collapse">
                              <li><a href="{{ route('flight-commission')}}">Domestic Commission</a></li>
                              <li><a href="#">International Commission</a></li>
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->
              @endif

              @if($user->inGroup($nuser) or $user->inGroup($agent))
                <!-- BEGIN ACCORDION GROUP -->
                <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-my-info">
                          <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/sitemap.png')}}" alt="Form Stuff">
                          <span> My Info </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <ul id="collapse-my-info" class="accordion-body nav nav-list collapse">
                        <li><a href="{{ route('agent-profile') }}"> My Profile</a></li>
                        <li><a href="{{ route('change-password-agent') }}">Change password</a></li>
                        <li><a href="{{ route('change-email-agent') }}">Change email</a></li>
                        <li><a href="{{ route('agent-logo') }}">Agent Logo</a></li>
                        </ul>
                      <!-- END MENU LIST ITEMS -->
                </div>
                <!-- END ACCORDION GROUP -->

                <!-- BEGIN ACCORDION GROUP -->
                <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-my-clients">
                          <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/sitemap.png')}}" alt="Form Stuff">
                          <span> My Clients </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <ul id="collapse-my-clients" class="accordion-body nav nav-list collapse">
                        <li><a href="{{ route('signup_agent') }}"> Register a Client</a></li>
                        <li><a href="{{ route('listallclients') }}"> List all clients</a></li>
                          </ul>
                      <!-- END MENU LIST ITEMS -->
                </div>
                <!-- END ACCORDION GROUP -->

                <!-- BEGIN ACCORDION GROUP -->
                <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-account">
                          <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/sitemap.png')}}" alt="Form Stuff">
                          <span> Account </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <ul id="collapse-account" class="accordion-body nav nav-list collapse">
                        <li><a href="{{ route('transactions') }}">Account Transactions</a></li>
                        <li><a href="{{ route('credit-transaction-history') }}">Credit Transaction History</a></li>
                        <li><a href="{{ route('make-payment') }}">Make Payment</a></li>
                      </ul>
                      <!-- END MENU LIST ITEMS -->
                </div>
                <!-- END ACCORDION GROUP -->

                <!-- BEGIN ACCORDION GROUP -->
                <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                        <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-airlines">
                          <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/sitemap.png')}}" alt="Form Stuff">
                          <span> Airlines </span>
                        </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                      <!-- BEGIN MENU LIST ITEMS -->
                      <ul id="collapse-airlines" class="accordion-body nav nav-list collapse">
                        <li><a href="{{ route('reserved-tickets') }}">Reserved Tickets</a></li>
                        <li><a href="{{ route('issued-tickets') }}">Issued Tickets</a></li>                   
                        <li><a href="{{ route('cancel-request') }}">Cancel Request</a></li>
                        <li><a href="{{ route('cancel-request') }}">Cancelled/Void Tickets</a></li>                      
                      </ul>
                      <!-- END MENU LIST ITEMS -->
                </div>
                <!-- END ACCORDION GROUP -->

                 <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-packagetours">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        
                        <span>Package Tours </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-packagetours" class="accordion-body nav nav-list collapse">
                              <li><a href="{{route('orders_package_tour')}}" >Orders</b></a></li>                
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->


                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-hotels">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                        

                      <span>Hotels </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-hotels" class="accordion-body nav nav-list collapse">
                             <li><a href="{{route('orders_hotel')}}" >Orders</b></a></li>            
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-vacationrentals">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">
                      <span>Vacation Rentals </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-vacationrentals" class="accordion-body nav nav-list collapse">
                             <li><a href="{{route('orders_vacation_rentals')}}" >Orders</b></a></li>  
                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->


                    <!-- BEGIN ACCORDION GROUP -->
                    <div class="accordion-group ">
                      <!-- BEGIN ACCORDION HEADING -->
                      <div class="accordion-heading">
                                                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse-vehiclerentals">
                        
                                                <img src="{{asset('assets/backend/img/icons/stuttgart-icon-pack/32x32/world.png')}}" alt="Maps">                      

                      <span>Vehicle Rentals </span>
                          </a>
                      </div>
                      <!-- END ACCORDION HEADING -->
                                              <!-- BEGIN MENU LIST ITEMS -->
                          <ul id="collapse-vehiclerentals" class="accordion-body nav nav-list collapse">
                              <li><a href="{{route('orders_vehicle_rentals')}}" >Orders</b></a></li>  

                          </ul>
                          <!-- END MENU LIST ITEMS -->
                    </div>
                    <!-- END ACCORDION GROUP -->

                  @endif
                      
                    </div>
                    <!-- END ACCORDION SECTION -->
                                </section>
                <!-- END MENU SECTION -->

            </div>
          
            </div>

          </aside>
      <!-- END SIDEBAR -->
      <header>
        <!-- BEGIN NAVBAR -->
        <nav class="navbar navbar-fixed-top social-navbar social-sm">
   <div class="navbar-inner">
     <div class="container-fluid">
       <!-- BEGIN SIDEBAR COLLAPSER -->
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".social-sidebar">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <!-- END SIDEBAR COLLAPSER -->
       <!-- BEGIN BRAND LINK -->
       <!-- <a class="brand">
                 Blackeye Journeys
       </a> -->
       <a class="brand">
                 Mero Tour
       </a>
       <!-- END BRAND LINK -->
        <ul class="nav visible-desktop">
        <!--  -->
      <li class="dropdown visible-desktop ">
      <a href="{{route('flight-search')}}">Flight Search</b></a> 
        
      </li>   

      <li class="dropdown visible-desktop ">
        <a href="{{route('hotel-search')}}">Hotel Search</b></a> 
      </li>

      <li class="dropdown visible-desktop ">
        <a href="{{route('package-tours-search')}}" >Package Tour Search</b></a> 
      </li>

      <li class="dropdown visible-desktop ">
        <a href="{{route('vacation-rental-search')}}" >Vacation Rental Search</b></a> 
      </li>

      <li class="dropdown visible-desktop ">
        <a href="{{route('vehicle-rental-search')}}" >Vehicle Rental Search</b></a> 
        </li>

        <li class="dropdown visible-desktop ">

        </li>

        <!--<li class="dropdown visible-desktop ">
          <a href="{{route('orders')}}" >Orders</b></a> 
        </li>-->

        </ul>

          <!-- BEGIN NAVBAR INDICATORS -->
           <ul class="nav pull-right nav-indicators">           
              <!-- BEGIN EXTRA DROPDOWN -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-caret-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::to('account/profile') }}"><i class="icon-user"></i> My Profile</a></li>
                  <li><a href="{{ URL::to('/') }}" target="_blank"><i class="icon-cogs"></i> Go to website</a></li>
                  <li><a href="{{ route('logout') }}"><i class="icon-off"></i> Log Out</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-info-sign"></i> Help</a></li>
                </ul>
              </li>
              <!-- END EXTRA DROPDOWN -->
           </ul>
          <!-- END NAVBAR INDICATORS -->
          <!-- BEGIN PANEL TEMPLATE SETTINGS TRIGGER -->
            <ul class="nav pull-right hidden-phone">
              
            </ul>
            <!-- END PANEL TEMPLATE SETTINGS TRIGGER -->
         </div>
       </div>
     </nav>
          <!-- END NAVBAR -->
        </header>
      <!-- BEGIN MAIN CONTAINER -->
      <div id="main">

        <!-- Notifications -->
        <!-- BEGIN CONTENT CONTANER -->
        <div class="container-fluid">
            @include('frontend/notifications')

            <!-- Content -->
            @yield('content')
        </div>
        <!-- END CONTENT CONTAINER -->

        <!-- BEGIN PAGE FOOTER -->
        <footer id="footer">
          <div class="container-fluid">
            <!-- <p>© 2014 <a href="#">Black Eye Travels</a>. All rights reserved</p> -->
            <p>© 2014 <a href="#">Mero Tour</a>. All rights reserved</p>
          </div>
        </footer>
        <!-- END PAGE FOOTER -->
      </div>
      <!-- END MAIN CONTAINER -->
    </div>
    <!-- END WRAPER -->
        
    <!-- BEGIN SIDEBAR PANEL -->
    <div style="display: none;">
      <ul class="rightPanel">
        <li>
          <a href="pages/basic-user-profile.html">
            <i class="icon-user"></i><span>My Profile</span>
          </a>
        </li>
        <li>
          <a href="pages/chat-inbox.html">
            <i class="icon-envelope"></i><span>Messages</span>
      </a>
        </li>
        <li>
          <a href="#">
        <i class="icon-tasks"></i><span>Taks</span>
      </a>
    </li>
      </ul>
    </div>
    <!-- END SIDEBAR PANEL -->

    <!-- BEGIN JAVASCRIPT CODES -->
    <!-- BEGIN GENERAL JAVASCRIPT CODE -->
    <script src="{{asset('assets/backend/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/twitter-bootstrap/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-modalmanager.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-modal.js') }}"></script>   
    <!-- END GENERAL JAVASCRIPT CODE -->
    
        @yield('currentpagejs')
   
    <!-- END JAVASCRIPT CODES -->
  </body>

</html>