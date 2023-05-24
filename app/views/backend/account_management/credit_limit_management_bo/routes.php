<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/
if (Session::has('currency'))
{   
}
else {
    Session::put('currency', 'usd');        

}



if(Sentry::check()) 
    {

    $user = Sentry::getUser(); 
    $group = Sentry::getGroupProvider(); 
    $admin = $group->findById(1);
    $nuser = $group->findById(2);  
    $agent = $group->findById(3); 
    $affiliate = $group->findById(4);
    $manager = $group->findById(5); 
    $distributor = $group->findById(6);
    $corporate = $group->findById(7);

    if($user->inGroup($admin)) 
    {

        $prefix = 'admin';
        Session::put('account_type', $prefix);

    }
    elseif ($user->inGroup($nuser)) {
        $prefix = 'user';
        Session::put('account_type', $prefix);
    }

    elseif ($user->inGroup($agent)) {
        $prefix = 'agent';
        Session::put('account_type', $prefix);
    }

    elseif ($user->inGroup($manager)) {
        $prefix = 'manager';
        Session::put('account_type', $prefix);
    }

    elseif ($user->inGroup($affiliate)) {
        $prefix = 'affiliate';
        Session::put('account_type', $prefix);
    }

    elseif ($user->inGroup($distributor)) {
        $prefix = 'distributor';
        Session::put('account_type', $prefix);
    }

    elseif ($user->inGroup($corporate)) {
        $prefix = 'corporate';
        Session::put('account_type', $prefix);
    }

    else{

        $prefix = 'admin';
        Session::put('account_type', $prefix);

    }
    
                                                   
                Route::group(array('prefix' => $prefix), function() use ($prefix)
                {

                    # Dashboard
                    switch ($prefix) {
                        case 'admin':
                            Route::get('/', array('as' => 'dashboard', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));                           
                            break;

                        case 'agent':
                            Route::get('/', array('as' => 'dashboard', 'uses' => 'AgentController@getIndex'));
                            break;
                        
                        default:
                             Route::get('/', array('as' => 'dashboard', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));                           
                            break;
                    }
                    
                    # Blog Management
                    Route::group(array('prefix' => 'news'), function()
                    {
                            Route::get('/', array('as' => 'blogs', 'uses' => 'Controllers\Admin\BlogsController@getIndex'));
                            Route::get('create', array('as' => 'create/blog', 'uses' => 'Controllers\Admin\BlogsController@getCreate'));
                            Route::post('create', 'Controllers\Admin\BlogsController@postCreate');
                            Route::get('{blogId}/edit', array('as' => 'update/blog', 'uses' => 'Controllers\Admin\BlogsController@getEdit'));
                            Route::post('{blogId}/edit', 'Controllers\Admin\BlogsController@postEdit');
                            Route::get('{blogId}/delete', array('as' => 'delete/blog', 'uses' => 'Controllers\Admin\BlogsController@getDelete'));
                            Route::get('{blogId}/restore', array('as' => 'restore/blog', 'uses' => 'Controllers\Admin\BlogsController@getRestore'));
                    });

                    # User Management
                    Route::group(array('prefix' => 'users'), function()
                    {
                            Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
                            Route::post('/', 'Controllers\Admin\UsersController@postIndex');
                            Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
                            Route::post('create', 'Controllers\Admin\UsersController@postCreate');
                            Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
                            Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
                            Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
                            Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
                    });

                    # Group Management
                    Route::group(array('prefix' => 'groups'), function()
                    {
                            Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
                            Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
                            Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
                            Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
                            Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
                            Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
                            Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
                    });
                    
                    
                    # Inquiries Management
                    Route::group(array('prefix' => 'inquiries'), function()
                    {
                            Route::get('/', array('as' => 'inquiries', 'uses' => 'InquiriesController@getIndex'));
                            Route::get('viewed/{id}', array('as' => 'viewinquiry', 'uses' => 'InquiriesController@markViewed'));
                           Route::get('show/{id}', array('as' => 'showinquiry', 'uses' => 'InquiriesController@show'));
                           Route::get('delete/{id}', array('as' => 'deleteinquiry', 'uses' => 'InquiriesController@getDelete'));

                    });

                    # Categories Management
                      Route::group(array('prefix' => 'categories'), function()
                    {
                            Route::get('/', array('as' => 'categories', 'uses' => 'CategoriesController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_category', 'uses' => 'CategoriesController@getEdit'));       
                            Route::post('edit/{id}', 'CategoriesController@postEdit');   

                            Route::get('create', array('as' => 'create_category', 'uses' => 'CategoriesController@getCreate'));
                            Route::post('create', 'CategoriesController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_category', 'uses' => 'CategoriesController@getDelete'));

                    });
                    
                    # Package Tours Management

                        Route::group(array('prefix' => 'package_tours'), function()
                    {
                            Route::get('/', array('as' => 'package_tours', 'uses' => 'PackageToursController@getIndex'));
                            
                            Route::get('edit/{id}', array('as' => 'edit_package_tour', 'uses' => 'PackageToursController@getEdit'));       
                            Route::post('edit/{id}', 'PackageToursController@postEdit');   

                            Route::get('create', array('as' => 'create_package_tour', 'uses' => 'PackageToursController@getCreate'));
                            Route::post('create', 'PackageToursController@postCreate');

                            Route::get('orders', array('as' => 'orders_package_tour', 'uses' => 'OrdersController@getIndex'));
                            Route::post('orders', 'OrdersController@postIndex');

                            Route::get('dealsetup', array('as' => 'dealsetup_package_tour', 'uses' => 'PackageToursController@getCreate'));
                            Route::post('dealsetup', 'PackageToursController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_package_tour', 'uses' => 'PackageToursController@getDelete'));

                    });

                    
                    #Orders Management
                    Route::group(array('prefix' => 'orders'), function()
                    {
                            Route::get('/', array('as' => 'orders', 'uses' => 'OrdersController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_order', 'uses' => 'OrdersController@getEdit'));       
                            Route::post('edit/{id}', 'OrdersController@postEdit');   
                            Route::get('status-change/{id}', array('as' => 'status-change', 'uses' => 'OrdersController@getEdit'));          
                            Route::post('status-change/{id}', 'OrdersController@StatusChange');   

                            Route::get('create', array('as' => 'create_order', 'uses' => 'OrdersController@getCreate'));
                            Route::post('create', 'OrdersController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_order', 'uses' => 'OrdersController@getDelete'));

                    });
                    
                    #Flight Management

                    Route::group(array('prefix' => 'flight'), function()
                    {

                         Route::get('/', array('as' => 'flight', 'uses' => 'FlightController@getIndex'));



                                   Route::group(array('prefix' => 'airlines'), function()
                                        {
                                                Route::get('/', array('as' => 'flight_airlines', 'uses' => 'FlightAirlinesController@getIndex'));
                                                Route::get('edit/{id}', array('as' => 'edit_airline', 'uses' => 'FlightAirlinesController@getEdit'));       
                                                Route::post('edit/{id}', 'FlightAirlinesController@postEdit');   

                                                Route::get('create', array('as' => 'create_airline', 'uses' => 'FlightAirlinesController@getCreate'));
                                                Route::post('create', 'FlightAirlinesController@postCreate');

                                                Route::get('delete/{id}', array('as' => 'delete_airline', 'uses' => 'FlightAirlinesController@getDelete'));

                                        });


                                    Route::group(array('prefix' => 'airports'), function()
                                        {
                                               Route::get('/', array('as' => 'flight_airport', 'uses' => 'FlightAirportController@getIndex'));
                                               Route::get('edit/{id}', array('as' => 'edit_airport', 'uses' => 'FlightAirportController@getEdit'));       
                                               Route::post('edit/{id}', 'FlightAirportController@postEdit');   

                                               Route::get('create', array('as' => 'create_airport', 'uses' => 'FlightAirportController@getCreate'));
                                               Route::post('create', 'FlightAirportController@postCreate');

                                               Route::get('delete/{id}', array('as' => 'delete_airport', 'uses' => 'FlightAirportController@getDelete'));

                                       });

                            #Airlines

                            Route::get('searchflights', array('as' => 'searchflights', 'uses' => 'AdminController@SearchFlights'));
                            
                            Route::post('flightavail', 'AdminController@getFlightAvailability');

                            Route::post('reservation', 'AdminController@Reservation');
                                                                

                    });
                            
                     # Administration

                    Route::group(array('prefix' => 'administration'), function()
                    {
                            Route::get('/', array('as' => 'administration', 'uses' => 'AdministrationController@getIndex'));
                    }); 
                    
                    
                    
                    #Slider
                    
                       Route::group(array('prefix' => 'slider'), function()
                    {
                            Route::get('/', array('as' => 'slider', 'uses' => 'AdministrationController@getSlider'));
                   
                            Route::get('edit/{id}', array('as' => 'edit_slider', 'uses' => 'AdministrationController@getSliderEdit'));       
                            Route::post('edit/{id}', 'HotelController@postSliderEdit');   

                            Route::get('create', array('as' => 'add_slider', 'uses' => 'AdministrationController@getSliderAdd'));
                            Route::post('create', 'AdministrationController@postSliderAdd');

                            Route::get('delete/{id}', array('as' => 'delete_slider', 'uses' => 'AdministrationController@getSliderDelete'));

                    });
                    
                    
                    #Hotels

                    Route::group(array('prefix' => 'hotels'), function()
                    {
                            Route::get('/', array('as' => 'hotels', 'uses' => 'HotelController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_hotel', 'uses' => 'HotelController@getEdit'));       
                            Route::post('edit/{id}', 'HotelController@postEdit');   

                            Route::get('create', array('as' => 'create_hotel', 'uses' => 'HotelController@getCreate'));
                            Route::post('create', 'HotelController@postCreate');

                            Route::get('orders', array('as' => 'orders_hotel', 'uses' => 'OrdersController@getIndex'));

                            Route::get('dealsetup', array('as' => 'dealsetup_hotel', 'uses' => 'PackageToursController@getCreate'));
                            Route::post('dealsetup', 'PackageToursController@postCreate');
                            
                            Route::get('delete/{id}', array('as' => 'delete_hotel', 'uses' => 'HotelController@getDelete'));

                    });
                    
                    #Vacation Rentals

                    Route::group(array('prefix' => 'vacation_rentals'), function()
                    {
                            Route::get('/', array('as' => 'vacation_rentals', 'uses' => 'VacationRentalController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_vacation_rentals', 'uses' => 'VacationRentalController@getEdit'));       
                            Route::post('edit/{id}', 'VacationRentalController@postEdit');   

                            Route::get('create', array('as' => 'create_vacation_rentals', 'uses' => 'VacationRentalController@getCreate'));
                            Route::post('create', 'VacationRentalController@postCreate');
                            
                            Route::get('orders', array('as' => 'orders_vacation_rentals', 'uses' => 'OrdersController@getIndex'));

                            Route::get('dealsetup', array('as' => 'dealsetup_vacation_rentals', 'uses' => 'VacationRentalController@getCreate'));
                            Route::post('dealsetup', 'VacationRentalController@postCreate');
                            Route::get('delete/{id}', array('as' => 'delete_vacation_rentals', 'uses' => 'VacationRentalController@getDelete'));

                    });
                    
                    
                    #Vehicle Rentals


                   Route::group(array('prefix' => 'vehicle_rentals'), function()
                    {
                            Route::get('/', array('as' => 'vehicle_rentals', 'uses' => 'VehicleRentalController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_vehicle_rentals', 'uses' => 'VehicleRentalController@getEdit'));       
                            Route::post('edit/{id}', 'VehicleRentalController@postEdit');   

                            Route::get('create', array('as' => 'create_vehicle_rentals', 'uses' => 'VehicleRentalController@getCreate'));
                            Route::post('create', 'VehicleRentalController@postCreate');
                            
                            Route::get('orders', array('as' => 'orders_vehicle_rentals', 'uses' => 'OrdersController@getIndex'));

                            Route::get('dealsetup', array('as' => 'dealsetup_vehicle_rentals', 'uses' => 'VehicleRentalController@getCreate'));
                            Route::post('dealsetup', 'VehicleRentalController@postCreate');
                            Route::get('delete/{id}', array('as' => 'delete_vehicle_rentals', 'uses' => 'VehicleRentalController@getDelete'));

                    });
                    
                    
                    #Coupons
                    
                    Route::group(array('prefix' => 'coupons'), function()
                    {
                            Route::get('/', array('as' => 'coupons', 'uses' => 'CouponController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_coupon', 'uses' => 'CouponController@getEdit'));       
                            Route::post('edit/{id}', 'CouponController@postEdit');   

                            Route::get('create', array('as' => 'create_coupon', 'uses' => 'CouponController@getCreate'));
                            Route::post('create', 'CouponController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_coupon', 'uses' => 'CouponController@getDelete'));

                    });
                    
                    #Newsletter
                    
                    Route::group(array('prefix' => 'newsletter'), function()
                      {
                              Route::get('/', array('as' => 'mailinglist', 'uses' => 'NewsletterController@getIndex'));
                              Route::get('edit/{id}', array('as' => 'edit_newsletter', 'uses' => 'NewsletterController@getEdit'));       
                              Route::post('edit/{id}', 'NewsletterController@postEdit');  

                              Route::get('send-newsletter', array('as' => 'send-newsletter', 'uses' => 'NewsletterController@getNewsletter')); 
                              Route::post('send-newsletter', 'NewsletterController@postNewsletter');  

                               Route::get('delete/{id}', array('as' => 'delete_newsletter', 'uses' => 'NewsletterController@getDelete'));




                      });
                      
                    #Pages
                    Route::group(array('prefix' => 'pages'), function()
                    {
                            Route::get('/', array('as' => 'pages', 'uses' => 'PagesController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_page', 'uses' => 'PagesController@getEdit'));       
                            Route::post('edit/{id}', 'PagesController@postEdit');   
                            Route::get('create', array('as' => 'create_page', 'uses' => 'PagesController@getCreate'));
                            Route::post('create', 'PagesController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_page', 'uses' => 'PagesController@getDelete'));


                    });
                        
                        
                    #Menu
                     Route::group(array('prefix' => 'menu'), function()
                    {

                            Route::get('/', array('as' => 'menu', 'uses' => 'MenuController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_menu', 'uses' => 'MenuController@getEdit'));       
                            Route::post('edit/{id}', 'MenuController@postEdit');   
                            Route::get('create', array('as' => 'create_menu', 'uses' => 'MenuController@getCreate'));
                            Route::post('create', 'MenuController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_menu', 'uses' => 'MenuController@getDelete'));
                            Route::get('enable/{id}', array('as' => 'enable_menu', 'uses' => 'MenuController@getEnable'));
                            Route::get('disable/{id}', array('as' => 'disable_menu', 'uses' => 'MenuController@getDisable'));     
                    });
                        
                    #Product Comments
                     Route::group(array('prefix' => 'product-comments'), function()
                    {
                            Route::get('/', array('as' => 'product-comments', 'uses' => 'ProductCommentsController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit_pcomment', 'uses' => 'ProductCommentsController@getEdit'));       
                            Route::post('edit/{id}', 'ProductCommentsController@postEdit');   
                            Route::get('create', array('as' => 'create_pcomment', 'uses' => 'ProductCommentsController@getCreate'));
                            Route::post('create', 'ProductCommentsController@postCreate');

                            Route::get('delete/{id}', array('as' => 'delete_pcomment', 'uses' => 'ProductCommentsController@getDelete'));
                           


                    });

                    #Agent Management

                     Route::group(array('prefix' => 'agent-management'), function()
                    {
                            Route::get('/', array('as' => 'agent-management', 'uses' => 'AgentManagementController@getIndex'));
                            Route::post('/', 'AgentManagementController@postIndex');
                            Route::get('edit/{id}', array('as' => 'edit/agent', 'uses' => 'AgentManagementController@getEdit'));       
                            Route::post('edit/{id}', 'AgentManagementController@postEdit');                               
                            Route::get('create', array('as' => 'create/agent', 'uses' => 'AgentManagementController@getCreate'));
                            Route::post('create', 'AgentManagementController@postCreate');
                            Route::get('delete/{id}', array('as' => 'delete/agent', 'uses' => 'AgentManagementController@getDelete'));

                            Route::get('class', array('as' => 'class/agent', 'uses' => 'AgentManagementController@getClass'));       
                            Route::post('class', 'AgentManagementController@postClass');   
                            
                           
                    });

                    #Branch Office Management

                     Route::group(array('prefix' => 'branch-offices'), function()
                    {
                            Route::get('/', array('as' => 'branch-offices', 'uses' => 'BranchOfficesController@getIndex'));
                            Route::post('/', 'BranchOfficesController@postIndex');
                            Route::get('edit/{id}', array('as' => 'edit/office', 'uses' => 'BranchOfficesController@getEdit'));       
                            Route::post('edit/{id}', 'BranchOfficesController@postEdit');   
                            
                            Route::get('create', array('as' => 'create/office', 'uses' => 'BranchOfficesController@getCreate'));
                            Route::post('create', 'BranchOfficesController@postCreate');
                        


                            Route::get('delete/{id}', array('as' => 'delete/office', 'uses' => 'BranchOfficesController@getDelete'));
                           
                    });

                    #FX Rate

                    Route::group(array('prefix' => 'fx-rate'), function()
                    {
                            Route::get('/', array('as' => 'fx-rate', 'uses' => 'FXRateController@getIndex'));
                            Route::get('edit/{id}', array('as' => 'edit/fxrate', 'uses' => 'FXRateController@getEdit'));       
                            Route::post('edit/{id}', 'FXRateController@postEdit');                              
                            Route::get('create', array('as' => 'create/fxrate', 'uses' => 'FXRateController@getCreate'));
                            Route::post('create', 'FXRateController@postCreate');
                            Route::get('delete/{id}', array('as' => 'delete/fxrate', 'uses' => 'FXRateController@getDelete'));
                           
                    });


                    #Account Management

                    Route::group(array('prefix' => 'account-management'), function()
                    {


                        Route::group(array('prefix' => 'payment-verify'), function()
                        {

                            Route::get('/', array('as' => 'payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getIndex'));
                            Route::get('create', array('as' => 'create/payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getCreate'));
                            Route::post('create', 'AccMgmtPaymentVerifyController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getEdit'));       
                            Route::post('edit/{id}', 'AccMgmtPaymentVerifyController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getDelete'));
                            Route::get('approve/{id}', array('as' => 'approve/payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getApprove'));
                            Route::get('unapprove/{id}', array('as' => 'unapprove/payment-verify', 'uses' => 'AccMgmtPaymentVerifyController@getUnapprove'));
                            
                        });

                        Route::group(array('prefix' => 'ledger-master'), function()
                        {
                            Route::get('/', array('as' => 'ledger-master', 'uses' => 'AccMgmtLedgerMasterController@getIndex'));
                            Route::get('create', array('as' => 'create/ledger', 'uses' => 'AccMgmtLedgerMasterController@getCreate'));
                            Route::post('create', 'AccMgmtLedgerMasterController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/ledger', 'uses' => 'AccMgmtLedgerMasterController@getEdit'));       
                            Route::post('edit/{id}', 'AccMgmtLedgerMasterController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/ledger', 'uses' => 'AccMgmtLedgerMasterController@getDelete'));
                           
                        });

                        Route::group(array('prefix' => 'configure-account'), function()
                        {

                            Route::get('/', array('as' => 'configure-account', 'uses' => 'AccMgmtConfigureAccountController@getIndex'));
                            Route::get('create', array('as' => 'create/configure-account', 'uses' => 'AccMgmtConfigureAccountController@getCreate'));
                            Route::post('create', 'AccMgmtConfigureAccountController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/configure-account', 'uses' => 'AccMgmtConfigureAccountController@getEdit'));       
                            Route::post('edit/{id}', 'AccMgmtConfigureAccountController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/configure-account', 'uses' => 'AccMgmtConfigureAccountController@getDelete'));
                            
                        });

                        Route::group(array('prefix' => 'general-voucher'), function()
                        {
                            Route::get('/', array('as' => 'general-voucher', 'uses' => 'AccMgmtGeneralVoucherController@getIndex'));
                            Route::get('create', array('as' => 'create/general-voucher', 'uses' => 'AccMgmtGeneralVoucherController@getCreate'));
                            Route::post('create', 'AccMgmtGeneralVoucherController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/general-voucher', 'uses' => 'AccMgmtGeneralVoucherController@getEdit'));       
                            Route::post('edit/{id}', 'AccMgmtGeneralVoucherController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/general-voucher', 'uses' => 'AccMgmtGeneralVoucherController@getDelete'));                          
                        });

                        Route::group(array('prefix' => 'unapprove-voucher'), function()
                        {

                            Route::get('/', array('as' => 'unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getIndex'));
                            Route::get('create', array('as' => 'create/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getCreate'));
                            Route::post('create', 'AccMgmtUnapproveVoucherController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getEdit'));       
                            Route::post('edit/{id}', 'AccMgmtUnapproveVoucherController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getDelete'));                          
                          
                        });

                        Route::group(array('prefix' => 'credit-limit-management'), function()
                        {
                            Route::get('/', array('as' => 'credit-limit-management', 'uses' => 'CreditLimitManagementController@getIndex'));
                            Route::get('create', array('as' => 'create/c-l-m', 'uses' => 'CreditLimitManagementController@getCreate'));
                            Route::post('create', 'CreditLimitManagementController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/c-l-m', 'uses' => 'CreditLimitManagementController@getEdit'));       
                            Route::post('edit/{id}', 'CreditLimitManagementController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/c-l-m', 'uses' => 'CreditLimitManagementController@getDelete')); 
                            Route::get('approve/{id}', array('as' => 'approve/c-l-m', 'uses' => 'CreditLimitManagementController@getApprove'));
                            Route::get('unapprove/{id}', array('as' => 'unapprove/c-l-m', 'uses' => 'CreditLimitManagementController@getUnapprove'));
                        });

                        Route::group(array('prefix' => 'credit-limit-management-bo'), function()
                        {

                            Route::get('/', array('as' => 'c-l-m-bo-bo', 'uses' => 'CreditLimitManagementController@getIndex'));
                            Route::get('create', array('as' => 'create/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getCreate'));
                            Route::post('create', 'CreditLimitManagementController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getEdit'));       
                            Route::post('edit/{id}', 'CreditLimitManagementController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getDelete')); 
                            Route::get('approve/{id}', array('as' => 'approve/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getApprove'));
                            Route::get('unapprove/{id}', array('as' => 'unapprove/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getUnapprove'));
                       
                        });

                        Route::group(array('prefix' => 'deposit-update'), function()
                        {

                            Route::get('/', array('as' => 'deposit-update', function()
                            {

                                return View::make('backend.account_management.deposit_update.index');
                            
                            }));  
                        });

                        Route::group(array('prefix' => 'bank-management'), function()
                        {

                            Route::get('/', array('as' => 'bank-management', function()
                            {

                                return View::make('backend.account_management.bank_management.index');
                            
                            }));  
                        });

                        Route::group(array('prefix' => 'bank-branch-management'), function()
                        {

                            Route::get('/', array('as' => 'bank-branch-management', function()
                            {

                                return View::make('backend.account_management.bank_branch_management.index');
                            
                            }));  
                        });

                        Route::group(array('prefix' => 'my-bank-account'), function()
                        {

                            Route::get('/', array('as' => 'my-bank-account', 'uses' => 'MyBankAccountController@getIndex'));
                            Route::get('create', array('as' => 'create/my-bank-account', 'uses' => 'MyBankAccountController@getCreate'));
                            Route::post('create', 'MyBankAccountController@postCreate');
                            Route::get('edit/{id}', array('as' => 'edit/my-bank-account', 'uses' => 'MyBankAccountController@getEdit'));       
                            Route::post('edit/{id}', 'MyBankAccountController@postEdit');                              
                            Route::get('delete/{id}', array('as' => 'delete/my-bank-account', 'uses' => 'MyBankAccountController@getDelete'));                            
                        });


                        Route::group(array('prefix' => 'indian-lcc-balance'), function()
                        {

                            Route::get('/', array('as' => 'indian-lcc-balance', function()
                            {

                                return View::make('backend.account_management.indian_lcc_balance.index');
                            
                            }));  
                        });

                           Route::group(array('prefix' => 'service-provider-setting'), function()
                        {

                            Route::get('/', array('as' => 'service-provider-setting', function()
                            {

                                return View::make('backend.account_management.service_provider_setting.index');
                            
                            }));  
                        });



                    }); // Account Management
               

                #Deal Setup

                    Route::group(array('prefix' => 'deal-setup'), function()
                    {
                        Route::get('/', array('as' => 'deal-setup', 'uses' => 'DealSetupAirlineController@getIndex'));
                        Route::get('create', array('as' => 'create/deal-setup', 'uses' => 'DealSetupAirlineController@getCreate'));
                        Route::post('create', 'DealSetupAirlineController@postCreate');
                        Route::get('edit/{id}', array('as' => 'edit/deal-setup', 'uses' => 'DealSetupAirlineController@getEdit'));       
                        Route::post('edit/{id}', 'DealSetupAirlineController@postEdit');                              
                        Route::get('delete/{id}', array('as' => 'delete/deal-setup', 'uses' => 'DealSetupAirlineController@getDelete'));                          
                      
                    });

                #Paper Fare

                    Route::group(array('prefix' => 'paper-fare'), function()
                    {
                        Route::get('/', array('as' => 'paper-fare', 'uses' => 'PaperFareController@getIndex'));
                        Route::get('create', array('as' => 'create/paper-fare', 'uses' => 'PaperFareController@getCreate'));
                        Route::post('create', 'PaperFareController@postCreate');
                        Route::get('edit/{id}', array('as' => 'edit/paper-fare', 'uses' => 'PaperFareController@getEdit'));       
                        Route::post('edit/{id}', 'PaperFareController@postEdit');                              
                        Route::get('delete/{id}', array('as' => 'delete/paper-fare', 'uses' => 'PaperFareController@getDelete'));                          
                      
                    });


                # Flight Booking

                    Route::group(array('prefix' => 'booking'), function()
                    {
                        Route::get('/', array('as' => 'booking', 'uses' => 'BookingController@getIndex'));
                        Route::get('create', array('as' => 'create/booking', 'uses' => 'BookingController@getCreate'));
                        Route::post('create', 'BookingController@postCreate');
                        Route::get('details/{id}', array('as' => 'details/booking', 'uses' => 'BookingController@getDetails'));       
                        Route::get('delete/{id}', array('as' => 'delete/booking', 'uses' => 'BookingController@getDelete'));                          
                      
                    });

                #Application Setting

                    Route::group(array('prefix' => 'application-setting'), function()
                    {
                        Route::get('/', array('as' => 'application-setting', 'uses' => 'ApplicationSettingController@getIndex'));
                        Route::post('/', 'ApplicationSettingController@postEdit');
                       
                    });

                #Payment Gateways

                    Route::group(array('prefix' => 'payment-gateways'), function()
                    {
                        Route::get('paypal', function()
                                    {
                                             $entries = MyBankAccount::all();
                                            return View::make('backend.payment_gateways.paypal', compact('entries'));                                      
                                    });                      
                    });
                    
                #Flight Search

                    Route::group(array('prefix' => 'flight-search'), function()
                    {
                        Route::get('/', array('as' => 'flight-search', 'uses' => 'FlightSearchController@getIndex'));
                                                 
                      
                    });

                #Hotel Search

                    Route::group(array('prefix' => 'hotel-search'), function()
                    {
                        Route::get('/', array('as' => 'hotel-search', 'uses' => 'SearchController@backendHotelindex'));
                        Route::get('e/{id}', array('as' => 'hotel-show-expedia-backend', 'uses' => 'HotelController@getPackageViewExpediaBackend'));
                                               
                    });

                #Package Tours Search

                    Route::group(array('prefix' => 'package-tours-search'), function()
                    {
                        Route::get('/', array('as' => 'package-tours-search', 'uses' => 'SearchController@backendPackageToursindex'));
                                                            
                    });

                #Vacation Rental Search

                    Route::group(array('prefix' => 'vacation-rental-search'), function()
                    {
                        Route::get('/', array('as' => 'vacation-rental-search', 'uses' => 'SearchController@backendVacationRentalindex'));
                                                            
                    });

                #Vehicle Rental Search

                    Route::group(array('prefix' => 'vehicle-rental-search'), function()
                    {
                        Route::get('/', array('as' => 'vehicle-rental-search', 'uses' => 'SearchController@backendVehicleRentalindex'));
                                                            
                    });

                #Flight Commission

                    Route::group(array('prefix' => 'flight-commission'), function()
                    {
                        Route::get('/', array('as' => 'flight-commission', 'uses' => 'FlightCommissionController@getIndex'));
                        Route::get('create', array('as' => 'create/flight-commission', 'uses' => 'FlightCommissionController@getCreate'));
                        Route::post('create', 'FlightCommissionController@postCreate');
                        Route::get('edit/{id}', array('as' => 'edit/flight-commission', 'uses' => 'FlightCommissionController@getEdit'));       
                        Route::post('/', 'FlightCommissionController@postEdit');                              
                        Route::get('delete/{id}', array('as' => 'delete/flight-commission', 'uses' => 'FlightCommissionController@getDelete'));                          
                      
                    });

                #B2C
                    Route::get('b2c/userslist', array('as' => 'b2c-userslist', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
                    Route::post('b2c/userslist', 'Controllers\Admin\UsersController@postIndex');

                    
                    if($prefix == 'agent') 
                    {

                        # Profile
                        Route::get('profile', array('as' => 'agent-profile', 'uses' => 'Controllers\Account\ProfileController@getIndexAgent'));
                        Route::post('profile', 'Controllers\Account\ProfileController@postIndex');


                        # Change Password
                        Route::get('change-password', array('as' => 'change-password-agent', 'uses' => 'Controllers\Account\ChangePasswordController@getIndexAgent'));
                        Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

                        # Change Email
                        Route::get('change-email', array('as' => 'change-email-agent', 'uses' => 'Controllers\Account\ChangeEmailController@getIndexAgent'));
                        Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');
                        
                        
                        # Client Signup
                        Route::get('signup', array('as' => 'signup_agent', 'uses' => 'AuthController@getSignupAgent'));
                        Route::post('signup', 'AuthController@postSignup');
                        
                        #List of clients
                        
                        Route::get('listallclients', array('as' => 'listallclients', 'uses' => 'AgentController@ListAllClients'));
                        
                        Route::get('{userId}/edit', array('as' => 'update/user/agent', 'uses' => 'AgentController@clientgetEdit'));
                        Route::post('{userId}/edit', 'AgentController@clientpostEdit');
                        Route::get('{userId}/delete', array('as' => 'delete/user/agent', 'uses' => 'AgentController@clientgetDelete'));
                                       
                        #Airlines

                        Route::get('searchflights', array('as' => 'searchflights', 'uses' => 'AgentController@SearchFlights'));
                        
                        Route::post('flightavail', 'AgentController@getFlightAvailability');

                        Route::post('reservation', 'AgentController@Reservation');
                        
                        
                        #Inquiry
                        Route::get('quotations', function()
                                {                                       
                                    return View::make('backend.agent.quotation');
                                });
                                
                        Route::post('quotations', 'InquiryController@postSignup');
                        
                        Route::get('send-quotations', function()
                               {

                                    return View::make('backend.agent.clientquotation');
                               });


                        #Make Payment

                            Route::group(array('prefix' => 'make-payment'), function()
                            {
                                Route::get('/', array('as' => 'make-payment', 'uses' => 'MakePaymentController@getIndex'));
                                Route::post('cash', array('as' => 'make-payment/cash', 'uses' => 'MakePaymentController@postCash'));
                                Route::post('bank-transfer', array('as' => 'make-payment/bank-transfer', 'uses' => 'MakePaymentController@postBankTransfer'));
                                Route::post('credit-request', array('as' => 'make-payment/credit-request', 'uses' => 'MakePaymentController@postCreditRequest'));
                            });
                        
                        #Transaction History
                        
                        Route::get('transactions', array('as' => 'transactions', 'uses' => 'TransactionController@getIndex'));
                        
                        Route::get('{userId}/edit', array('as' => 'update/user/agent', 'uses' => 'AgentController@clientgetEdit'));
                        Route::post('{userId}/edit', 'AgentController@clientpostEdit');
                        Route::get('{userId}/delete', array('as' => 'delete/user/agent', 'uses' => 'AgentController@clientgetDelete'));
                                   
                        Route::group(array('prefix' => 'package_tours'), function()
                            {
                                    Route::get('/', array('as' => 'package_tours', 'uses' => 'PackageToursController@getIndex'));
                                    Route::get('edit/{id}', array('as' => 'edit_package_tour', 'uses' => 'PackageToursController@getEdit'));       
                                    Route::post('edit/{id}', 'PackageToursController@postEdit');   

                                    Route::get('create', array('as' => 'create_package_tour', 'uses' => 'PackageToursController@getCreate'));
                                    Route::post('create', 'PackageToursController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_package_tour', 'uses' => 'PackageToursController@getDelete'));

                            });


                        Route::group(array('prefix' => 'orders'), function()
                            {
                                    Route::get('/', array('as' => 'orders', 'uses' => 'OrdersController@getIndex'));
                                    Route::post('/', 'OrdersController@postIndex');

                                    Route::get('edit/{id}', array('as' => 'edit_order', 'uses' => 'OrdersController@getEdit'));       
                                    Route::post('edit/{id}', 'PackageToursController@postEdit');   

                                    Route::get('create', array('as' => 'create_order', 'uses' => 'OrdersController@getCreate'));
                                    Route::post('create', 'PackageToursController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_order', 'uses' => 'OrdersController@getDelete'));

                            });

                        Route::group(array('prefix' => 'flight'), function()
                            {

                                 Route::get('/', array('as' => 'flight', 'uses' => 'FlightController@getIndex'));



                                           Route::group(array('prefix' => 'airlines'), function()
                                                {
                                                        Route::get('/', array('as' => 'flight_airlines', 'uses' => 'FlightAirlinesController@getIndex'));
                                                        Route::post('/', array('as' => 'search-airlines', 'uses' => 'FlightAirlinesController@postAirlineSearch'));
                                                        Route::get('edit/{id}', array('as' => 'edit_airline', 'uses' => 'FlightAirlinesController@getEdit'));       
                                                        Route::post('edit/{id}', 'FlightAirlinesController@postEdit');   

                                                        Route::get('create', array('as' => 'create_airline', 'uses' => 'FlightAirlinesController@getCreate'));
                                                        Route::post('create', 'FlightAirlinesController@postCreate');

                                                        Route::get('delete/{id}', array('as' => 'delete_airline', 'uses' => 'FlightAirlinesController@getDelete'));

                                                });


                                            Route::group(array('prefix' => 'airports'), function()
                                                {
                                                       Route::get('/', array('as' => 'flight_airport', 'uses' => 'FlightAirportController@getIndex'));
                                                       Route::get('edit/{id}', array('as' => 'edit_airport', 'uses' => 'FlightAirportController@getEdit'));       
                                                       Route::post('edit/{id}', 'FlightAirportController@postEdit');   

                                                       Route::get('create', array('as' => 'create_airport', 'uses' => 'FlightAirportController@getCreate'));
                                                       Route::post('create', 'FlightAirportController@postCreate');

                                                       Route::get('delete/{id}', array('as' => 'delete_airport', 'uses' => 'FlightAirportController@getDelete'));

                                               });



                                    });




                            Route::group(array('prefix' => 'hotels'), function()
                            {
                                    Route::get('/', array('as' => 'hotels', 'uses' => 'HotelController@getIndex'));
                                    Route::get('edit/{id}', array('as' => 'edit_hotel', 'uses' => 'HotelController@getEdit'));       
                                    Route::post('edit/{id}', 'HotelController@postEdit');   

                                    Route::get('create', array('as' => 'create_hotel', 'uses' => 'HotelController@getCreate'));
                                    Route::post('create', 'HotelController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_hotel', 'uses' => 'HotelController@getDelete'));

                            });

                              Route::group(array('prefix' => 'vacation_rentals'), function()
                            {
                                    Route::get('/', array('as' => 'vacation_rentals', 'uses' => 'VacationRentalController@getIndex'));
                                    Route::get('edit/{id}', array('as' => 'edit_vacation_rentals', 'uses' => 'VacationRentalController@getEdit'));       
                                    Route::post('edit/{id}', 'VacationRentalController@postEdit');   

                                    Route::get('create', array('as' => 'create_vacation_rentals', 'uses' => 'VacationRentalController@getCreate'));
                                    Route::post('create', 'VacationRentalController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_vacation_rentals', 'uses' => 'VacationRentalController@getDelete'));

                            });


                                   Route::group(array('prefix' => 'vehicle_rentals'), function()
                            {
                                    Route::get('/', array('as' => 'vehicle_rentals', 'uses' => 'VehicleRentalController@getIndex'));
                                    Route::get('edit/{id}', array('as' => 'edit_vehicle_rentals', 'uses' => 'PackageToursController@getEdit'));       
                                    Route::post('edit/{id}', 'PackageToursController@postEdit');   

                                    Route::get('create', array('as' => 'create_vehicle_rentals', 'uses' => 'PackageToursController@getCreate'));
                                    Route::post('create', 'PackageToursController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_vehicle_rentals', 'uses' => 'PackageToursController@getDelete'));

                            });

                        #Issued Tickets
                        Route::group(array('prefix' => 'issued-tickets'), function()
                        {
                            Route::get('/', array('as' => 'issued-tickets', 'uses' => 'BookingController@getAgentIndex'));
                            Route::get('details/{id}', array('as' => 'details/issued-tickets', 'uses' => 'BookingController@getAgentDetails'));       
                            
                        });

                        #Reserved Tickets
                        Route::group(array('prefix' => 'reserved-tickets'), function()
                        {
                            Route::get('/', array('as' => 'reserved-tickets', 'uses' => 'ReservedTicketsController@getAgentIndex'));
                            Route::get('details/{id}', array('as' => 'details/reserved-tickets', 'uses' => 'ReservedTicketsController@getAgentDetails'));       
                            
                        });

                        #Retrive PNR
                        Route::group(array('prefix' => 'retrive-pnr'), function()
                        {
                            Route::get('/', array('as' => 'retrive-pnr', 'uses' => 'BookingController@RetrivePNRAgentIndex'));
                            Route::get('details/{id}', array('as' => 'details/retrive-pnr', 'uses' => 'ReservedTicketsController@getAgentDetails'));       
                            
                        });




                    } // Agent

                

                   


                }); // Route group admin
                                
    }

else 
    {
    
        # Dashboard
    
   
           Route::get('admin', array('as' => 'admin', 'uses' => 'AuthController@getSignin'));
           
           Route::get('agent', array('as' => 'agent', 'uses' => 'AuthController@getSignin'));
           
           Route::get('manager', array('as' => 'manager', 'uses' => 'AuthController@getSignin'));
           
           Route::get('affiliate', array('as' => 'affiliate', 'uses' => 'AuthController@getSignin'));
        
           Route::get('distributor', array('as' => 'distributor', 'uses' => 'AuthController@getSignin'));
           
           Route::get('corporate', array('as' => 'corporate', 'uses' => 'AuthController@getSignin'));
         
    }
       



/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function()
{

	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

         
                

/*Route::group(array('prefix' => 'affiliate'), function()
{

	# Login
	Route::get('/', array('as' => 'affiliate', 'uses' => 'AffiliateController@getIndex'));
	


});


Route::group(array('prefix' => 'manager'), function()
{

	# Login
	Route::get('/', array('as' => 'manager', 'uses' => 'ManagerController@getIndex'));
	


});*/






/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'account'), function()
{

	# Account Dashboard
	Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

	# Profile
	Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
	Route::post('profile', 'Controllers\Account\ProfileController@postIndex');
        
    # View Orders
    Route::get('view-orders', array('as' => 'view-orders', 'uses' => 'ViewOrdersController@getIndex'));
	

	# Change Password
	Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
	Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

	# Change Email
	Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
	Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');
        
        

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

if(ApplicationSetting::find(2)->value == 1) 
{

    Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getMaintenance'));


}

else
{
    
        Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getIndex'));


        Route::group(array('prefix' => 'package-tours'), function()
        {
            Route::get('/', array('as' => 'package-tours-index', 'uses' => 'PackageToursController@getFrontpage'));

            Route::get('/sortby/{query}',array('as' => 'package-search', 'uses' =>  'PackageToursController@getSort'));

            Route::get('{id}', array('as' => 'package-tours-show', 'uses' => 'PackageToursController@getPackageView'));

            Route::get('order/{id}', array('as' => 'package-tours-order', 'uses' => 'PackageToursController@getPackageOrder'));
            Route::post('order/{id}', 'PackageToursController@postPackageOrder');

        });


    Route::group(array('prefix' => 'hotels'), function()
    {
    Route::get('/', array('as' => 'hotel-index', 'uses' => 'HotelController@getFrontpage'));

    Route::get('{id}', array('as' => 'hotel-show', 'uses' => 'HotelController@getPackageView'));
    Route::get('e/{id}', array('as' => 'hotel-show-expedia', 'uses' => 'HotelController@getPackageViewExpedia'));

    Route::get('order/{id}', array('as' => 'hotel-order', 'uses' => 'HotelController@getPackageOrder'));
    Route::post('order/{id}', 'PackageToursController@postPackageOrder');

    });

    Route::group(array('prefix' => 'vacation-rentals'), function()
    {
    Route::get('/', array('as' => 'vacation-index', 'uses' => 'VacationRentalController@getFrontpage'));

    Route::get('{id}', array('as' => 'vacation-show', 'uses' => 'VacationRentalController@getPackageView'));

    Route::get('order/{id}', array('as' => 'vacation-order', 'uses' => 'VacationRentalController@getPackageOrder'));
    Route::post('order/{id}', 'VacationRentalController@postPackageOrder');

    });

    Route::get('pdf', array('as' => 'pdf-generator', 'uses' => 'PDFController@Post'));

    Route::post('pdf', 'PDFController@Post');

    Route::get('order-pdf', array('as' => 'order-pdf', 'uses' => 'PDFController@Order'));

    Route::post('order-pdf', 'PDFController@Order');



    Route::get('flights', function()
    {
    	//
    	return View::make('frontend/flights');
    });




    Route::get('vehicle-rentals', function()
    {
    	//
    	return View::make('frontend.vehicle_rentals.index');
    });

    Route::get('booking', function()
    {
    	//
    	return View::make('frontend.booking');
    });

    Route::post('booking', function()
    {
        
    	
    	return View::make('frontend.booking');
    });


    Route::post('signinpost', function()
    {
        
        return Redirect::back()->with('error', "Please sign in or signup to book the selected package.");
    	
    	
    });



    Route::get('news', function()
    {
    	// Get all the blog posts
    		$posts = Post::with(array(
    			'author' => function($query)
    			{
    				$query->withTrashed();
    			},
    		))->orderBy('created_at', 'DESC')->paginate();

    		// Show the page
    		return View::make('frontend/news', compact('posts'));
    	
    });


    Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
    Route::post('contact-us', 'ContactUsController@postIndex');

    Route::post('search',array('as' => 'search', 'uses' =>  'SearchController@postSearch'));
    Route::post('searchbox1',array('as' => 'searchbox1', 'uses' =>  'SearchController@postSearchBox1'));
    Route::post('searchbox2',array('as' => 'searchbox2', 'uses' =>  'SearchController@postSearchBox2'));
    Route::post('searchbox3',array('as' => 'searchbox3', 'uses' =>  'SearchController@postSearchBox3'));


    Route::post('airline-search',array('as' => 'airline-search', 'uses' =>  'FlightAirlinesController@postAirlineSearch'));

    Route::post('airport-search',array('as' => 'airport-search', 'uses' =>  'FlightAirlinesController@postAirportSearch'));

    Route::post('issued-tickets-search',array('as' => 'issued-tickets-search', 'uses' =>  'BookingController@searchAgentIndex'));


    Route::post('flightsearch',array('as' => 'flightsearch', 'uses' =>  'FlightController@getFlightAvailability'));

    Route::post('reservation', array('as' => 'reservation', 'uses' =>  'FlightController@Reservation'));

    Route::post('issueticket', array('as' => 'issueticket', 'uses' =>  'FlightController@IssueTicket'));


    Route::post('flightsearchintl',array('as' => 'flightsearchintl', 'uses' =>  'FlightController@getFlightAvailabilityIntl'));



    Route::post('newsletter',array('as' => 'newsletter', 'uses' =>  'NewsletterController@postSus'));

    Route::post('pcomment',array('as' => 'pcomment', 'uses' =>  'ProductCommentsController@postCreate'));

    Route::post('currency-change',array('as' => 'currency-change', 'uses' =>  'CurrencyController@postChange'));



    Route::get('inquiry', array('as' => 'inquiry', 'uses' => 'InquiryController@getIndex'));
    Route::post('inquiry', 'InquiryController@postIndex');

    Route::get('blog/{postSlug}', array('as' => 'view-post', 'uses' => 'BlogController@getView'));
    Route::post('blog/{postSlug}', 'BlogController@postView');

    Route::get('domestic', array('as' => 'domestic', 'uses' => 'BlogController@getIndex'));

    Route::get('international', array('as' => 'international', 'uses' => 'BlogController@getIndex'));


    Route::get('view-eticket/{id}', function()
                {
                        
                        return View::make('frontend/e_ticket', compact('entry'));


                });

    $pages = Page::all();

    foreach ($pages as $page) {
        
        
                    Route::get($page->slug, function() use ($page)
                {


                        $entry = $page;
                        return View::make('frontend/page', compact('entry'));


                });

    }


    $menus = Menu::where('editable', '=', 1)->get();

    foreach ($menus as $menu) {
        
        
                    Route::get($menu->slug, function() use ($menu)
                {

                        $entry = $menu;
                        
                        return View::make('frontend/page', compact('entry'));


                });

    }

}
