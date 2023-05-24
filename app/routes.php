<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/
if (!Session::has('currency')) {  

    $default_currency = ApplicationSetting::find(5);

    if (isset($default_currency->default_currency)) {
        Session::put('currency', Str::lower($default_currency->default_currency));
    } else {
        Session::put('currency', 'usd');
    }
}

if(Sentry::check()) {
    $user = Sentry::getUser();
    $group = Sentry::getGroupProvider(); 
    $admin = $group->findById(1);
    $nuser = $group->findById(2);  
    $agent = $group->findById(3); 
    $affiliate = $group->findById(4);
    $manager = $group->findById(5); 
    $distributor = $group->findById(6);
    $corporate = $group->findById(7);

    if($user->inGroup($admin)) {
        $prefix = 'admin';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($nuser)) {
        $prefix = 'user';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($agent)) {
        $prefix = 'agent';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($manager)) {
        $prefix = 'manager';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($affiliate)) {
        $prefix = 'affiliate';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($distributor)) {
        $prefix = 'distributor';
        Session::put('account_type', $prefix);
    } elseif ($user->inGroup($corporate)) {
        $prefix = 'corporate';
        Session::put('account_type', $prefix);
    } else {
        $prefix = 'user';
        Session::put('account_type', $prefix);
    }


    /**
     *  Check for user role and show 403 error for roles other than the current user role
     */
    if ($prefix != 'admin') {
        Route::get('admin', function() {return View::make('error.403');});
        Route::get('admin/{all}', function() {return View::make('error.403');});
        Route::get('admin/{all}/{any}', function() {return View::make('error.403');});
        Route::get('admin/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'agent') {
        Route::get('agent', function() {return View::make('error.403');});
        Route::get('agent/{all}', function() {return View::make('error.403');});
        Route::get('agent/{all}/{any}', function() {return View::make('error.403');});
        Route::get('agent/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'user') {
        Route::get('user', function() {return View::make('error.403');});
        Route::get('user/{all}', function() {return View::make('error.403');});
        Route::get('user/{all}/{any}', function() {return View::make('error.403');});
        Route::get('user/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'manager') {
        Route::get('manager', function() {return View::make('error.403');});
        Route::get('manager/{all}', function() {return View::make('error.403');});
        Route::get('manager/{all}/{any}', function() {return View::make('error.403');});
        Route::get('manager/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'affilate') {
        Route::get('affilate', function() {return View::make('error.403');});
        Route::get('affilate/{all}', function() {return View::make('error.403');});
        Route::get('affilate/{all}/{any}', function() {return View::make('error.403');});
        Route::get('affilate/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'distributor') {
        Route::get('distributor', function() {return View::make('error.403');});
        Route::get('distributor/{all}', function() {return View::make('error.403');});
        Route::get('distributor/{all}/{any}', function() {return View::make('error.403');});
        Route::get('distributor/{all}/{any}/{many}', function() {return View::make('error.403');});
    }

    if ($prefix != 'corporate') {
        Route::get('corporate', function() {return View::make('error.403');});
        Route::get('corporate/{all}', function() {return View::make('error.403');});
        Route::get('corporate/{all}/{any}', function() {return View::make('error.403');});
        Route::get('corporate/{all}/{any}/{many}', function() {return View::make('error.403');});
    }


    /**
     * Current User backend routes
     */
    Route::group(array('prefix' => $prefix), function() use ($prefix)
    {

        # Dashboard
        Route::get('/', array('as' => 'dashboard', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));                                       
        
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

        # Banner Management
        Route::group(array('prefix' => 'banner'), function()
        {
                Route::get('/', array('as' => 'banner', 'uses' => 'BannerController@getIndex'));
                Route::get('create', array('as' => 'create/banner', 'uses' => 'BannerController@getCreate'));
                Route::post('create', 'BannerController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/banner', 'uses' => 'BannerController@getEdit'));
                Route::post('edit/{id}', 'BannerController@postEdit');
                Route::get('delete/{id}', array('as' => 'delete/banner', 'uses' => 'BannerController@getDelete'));
        });


        # User Management
        Route::group(array('prefix' => 'users'), function()
        {
                Route::get('/', array('as' => 'users', 'before' => 'hasAccess:user-management.view', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
                Route::post('/', 'Controllers\Admin\UsersController@postIndex');
                Route::get('create', array('as' => 'create/user', 'before' => 'hasAccess:user-management.create', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
                Route::post('create', 'Controllers\Admin\UsersController@postCreate');
                Route::get('{userId}/edit', array('as' => 'update/user', 'before' => 'hasAccess:user-management.edit', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
                Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
                Route::get('{userId}/delete', array('as' => 'delete/user', 'before' => 'hasAccess:user-management.delete', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
                Route::get('{userId}/restore', array('as' => 'restore/user', 'before' => 'hasAccess:user-management.delete', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
        });

        # Group Management
        Route::group(array('prefix' => 'groups'), function()
        {
                Route::get('/', array('as' => 'groups', 'before' => 'hasAccess:role-management.view', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
                Route::get('create', array('as' => 'create/group', 'before' => 'hasAccess:role-management.create', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
                Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
                Route::get('{groupId}/edit', array('as' => 'update/group', 'before' => 'hasAccess:role-management.edit', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
                Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
                Route::get('{groupId}/delete', array('as' => 'delete/group', 'before' => 'hasAccess:role-management.delete', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
                Route::get('{groupId}/restore', array('as' => 'restore/group', 'before' => 'hasAccess:role-management.delete', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
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
        
        #Orders Management
        Route::group(array('prefix' => 'orders'), function()
        {
                Route::get('/', array('as' => 'orders', 'before' => 'hasAccess:orders.view', 'uses' => 'OrdersController@getIndex'));
                Route::get('edit/{id}', array('as' => 'edit_order', 'before' => 'hasAccess:orders.edit', 'uses' => 'OrdersController@getEdit'));       
                Route::post('edit/{id}', 'OrdersController@postEdit');

                Route::get('details/{id}', array('as' => 'details_order', 'before' => 'hasAccess:orders.edit', 'uses' => 'OrdersController@getDetails'));       

                Route::get('issue-order/{id}', array('as' => 'details_order', 'before' => 'hasAccess:orders.edit', 'uses' => 'OrdersController@getDetails'));       

                Route::get('status-change/{id}', array('as' => 'status-change', 'before' => 'hasAccess:orders.edit', 'uses' => 'OrdersController@getEdit'));          
                Route::post('status-change/{id}', 'OrdersController@StatusChange');   

                Route::get('create', array('as' => 'create_order', 'before' => 'hasAccess:orders.create', 'uses' => 'OrdersController@getCreate'));
                Route::post('create', 'OrdersController@postCreate');

                Route::get('approve/{id}', array('as' => 'approve_order', 'uses' => 'OrdersController@approveCancelled'));
                Route::post('unapprove', array('as' => 'unapprove_order', 'uses' => 'OrdersController@unapproveCancelled'));

                Route::get('delete/{id}', array('as' => 'delete_order', 'before' => 'hasAccess:orders.delete', 'uses' => 'OrdersController@getDelete'));
        });
        
        #Flight Management
        Route::group(array('prefix' => 'flight'), function()
        {
            Route::get('/', array('as' => 'flight', 'uses' => 'FlightController@getIndex'));

                       Route::group(array('prefix' => 'airlines'), function()
                            {
                                    Route::get('/', array('as' => 'flight_airlines', 'before' => 'hasAccess:airlines-list.view', 'uses' => 'FlightAirlinesController@getIndex'));
                                    Route::get('edit/{id}', array('as' => 'edit_airline', 'before' => 'hasAccess:airlines-list.edit', 'uses' => 'FlightAirlinesController@getEdit'));       
                                    Route::post('edit/{id}', 'FlightAirlinesController@postEdit');   

                                    Route::get('create', array('as' => 'create_airline', 'before' => 'hasAccess:airlines-list.create', 'uses' => 'FlightAirlinesController@getCreate'));
                                    Route::post('create', 'FlightAirlinesController@postCreate');

                                    Route::get('delete/{id}', array('as' => 'delete_airline', 'before' => 'hasAccess:airlines-list.delete', 'uses' => 'FlightAirlinesController@getDelete'));

                            });


                        Route::group(array('prefix' => 'airports'), function()
                            {
                                   Route::get('/', array('as' => 'flight_airport', 'before' => 'hasAccess:airports-list.view', 'uses' => 'FlightAirportController@getIndex'));
                                   Route::get('edit/{id}', array('as' => 'edit_airport', 'before' => 'hasAccess:airports-list.edit', 'uses' => 'FlightAirportController@getEdit'));       
                                   Route::post('edit/{id}', 'FlightAirportController@postEdit');   

                                   Route::get('create', array('as' => 'create_airport', 'before' => 'hasAccess:airports-list.create', 'uses' => 'FlightAirportController@getCreate'));
                                   Route::post('create', 'FlightAirportController@postCreate');

                                   Route::get('delete/{id}', array('as' => 'delete_airport', 'before' => 'hasAccess:airports-list.delete', 'uses' => 'FlightAirportController@getDelete'));

                           });

                #Airlines

                Route::get('searchflights', array('as' => 'searchflights', 'uses' => 'AdminController@SearchFlights'));
                
                Route::post('flightavail', 'AdminController@getFlightAvailability');

                Route::post('reservation', 'AdminController@Reservation');                                    
        });
                
        #Administration
        Route::group(array('prefix' => 'administration'), function()
        {
            Route::get('/', array('as' => 'administration', 'uses' => 'AdministrationController@getIndex'));
        }); 
              
        #Slider
        Route::group(array('prefix' => 'slider'), function()
        {
            Route::get('/', array('as' => 'slider', 'before' => 'hasAccess:gs-slider-management.view', 'uses' => 'AdministrationController@getSlider'));
   
            Route::get('edit/{id}', array('as' => 'edit_slider', 'before' => 'hasAccess:gs-slider-management.edit', 'uses' => 'AdministrationController@getSliderEdit'));       
            Route::post('edit/{id}', 'AdministrationController@postSliderEdit');   

            Route::get('create', array('as' => 'add_slider', 'before' => 'hasAccess:gs-slider-management.create', 'uses' => 'AdministrationController@getSliderAdd'));
            Route::post('create', 'AdministrationController@postSliderAdd');

            Route::get('delete/{id}', array('as' => 'delete_slider', 'before' => 'hasAccess:gs-slider-management.delete', 'uses' => 'AdministrationController@getSliderDelete'));
        });

        #Cities Management
        Route::group(array('prefix' => 'cities-management'), function()
        {
            Route::get('/', array('as' => 'cities-management', 'before' => 'hasAccess:packagetours_view',  'uses' => 'CitiesController@getIndex'));

            Route::get('edit/{id}', array('as' => 'cities-management/edit', 'before' => 'hasAccess:packagetours_edit', 'uses' => 'CitiesController@getEdit'));       
            Route::post('edit/{id}', 'CitiesController@postEdit');   

            Route::get('create', array('as' => 'cities-management/create', 'uses' => 'CitiesController@getCreate'));
            Route::post('create', 'CitiesController@postCreate');

            Route::get('delete/{id}', array('as' => 'cities-management/delete', 'uses' => 'CitiesController@getDelete'));
        });

        #Package Tours Management
        Route::group(array('prefix' => 'package_tours'), function()
        {
            Route::get('/', array('as' => 'package_tours', 'before' => 'hasAccess:packagetours_view',  'uses' => 'PackageToursController@getIndex'));

            Route::get('edit/{id}', array('as' => 'edit_package_tour', 'before' => 'hasAccess:packagetours_edit', 'uses' => 'PackageToursController@getEdit'));       
            Route::post('edit/{id}', 'PackageToursController@postEdit');   

            Route::get('create', array('as' => 'create_package_tour', 'uses' => 'PackageToursController@getCreate'));
            Route::post('create', 'PackageToursController@postCreate');

            Route::get('orders', array('as' => 'orders_package_tour', 'uses' => 'OrdersController@getIndex'));
            Route::post('orders', 'OrdersController@postIndex');

            Route::get('cancelled-orders', array('as' => 'cancelled_orders_package_tour', 'uses' => 'OrdersController@getIndex'));

            Route::get('delete/{id}', array('as' => 'delete_package_tour', 'uses' => 'PackageToursController@getDelete'));
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

                Route::get('cancelled-orders', array('as' => 'cancelled_orders_hotel', 'uses' => 'OrdersController@getIndex'));

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

                Route::get('cancelled-orders', array('as' => 'cancelled_orders_vacation_rentals', 'uses' => 'OrdersController@getIndex'));

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

                Route::get('cancelled-orders', array('as' => 'cancelled_orders_vehicle_rentals', 'uses' => 'OrdersController@getIndex'));

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
            Route::get('/', array('as' => 'mailinglist', 'before' => 'hasAccess:gs-slider-management.view', 'uses' => 'NewsletterController@getIndex'));
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
            Route::get('/', array('as' => 'agent-management', 'before' => 'hasAccess:agent-management.view', 'uses' => 'AgentManagementController@getIndex'));
            Route::post('/', 'AgentManagementController@postIndex');
            Route::get('edit/{id}', array('as' => 'edit/agent', 'before' => 'hasAccess:agent-management.edit', 'uses' => 'AgentManagementController@getEdit'));       
            Route::post('edit/{id}', 'AgentManagementController@postEdit');                               
            Route::get('create', array('as' => 'create/agent', 'before' => 'hasAccess:agent-management.create', 'uses' => 'AgentManagementController@getCreate'));
            Route::post('create', 'AgentManagementController@postCreate');
            Route::get('delete/{id}', array('as' => 'delete/agent', 'before' => 'hasAccess:agent-management.delete', 'uses' => 'AgentManagementController@getDelete'));

            Route::get('class', array('as' => 'class/agent', 'uses' => 'AgentManagementController@getClass'));       
            Route::post('class', 'AgentManagementController@postClass');                    
        });

        #Manager Management

        Route::group(array('prefix' => 'manager-management'), function()
        {
            Route::get('/', array('as' => 'manager-management', 'before' => 'hasAccess:manager-management.view', 'uses' => 'ManagerManagementController@getIndex'));
            Route::post('/', 'ManagerManagementController@postIndex');
            Route::get('edit/{id}', array('as' => 'edit/manager', 'before' => 'hasAccess:manager-management.edit', 'uses' => 'ManagerManagementController@getEdit'));       
            Route::post('edit/{id}', 'ManagerManagementController@postEdit');                               
            Route::get('create', array('as' => 'create/manager', 'before' => 'hasAccess:manager-management.create', 'uses' => 'ManagerManagementController@getCreate'));
            Route::post('create', 'ManagerManagementController@postCreate');
            Route::get('delete/{id}', array('as' => 'delete/manager', 'before' => 'hasAccess:manager-management.delete', 'uses' => 'ManagerManagementController@getDelete'));
            Route::get('class', array('as' => 'class/manager', 'uses' => 'ManagerManagementController@getClass'));       
            Route::post('class', 'ManagerManagementController@postClass');                    
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

                Route::get('/', array('as' => 'payment-verify', 'before' => 'hasAccess:payment-verify.view', 'uses' => 'AccMgmtPaymentVerifyController@getIndex'));
                Route::get('create', array('as' => 'create/payment-verify', 'before' => 'hasAccess:payment-verify.create', 'uses' => 'AccMgmtPaymentVerifyController@getCreate'));
                Route::post('create', 'AccMgmtPaymentVerifyController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/payment-verify', 'before' => 'hasAccess:payment-verify.edit', 'uses' => 'AccMgmtPaymentVerifyController@getEdit'));       
                Route::post('edit/{id}', 'AccMgmtPaymentVerifyController@postEdit');                              
                Route::get('delete/{id}', array('as' => 'delete/payment-verify', 'before' => 'hasAccess:payment-verify.delete', 'uses' => 'AccMgmtPaymentVerifyController@getDelete'));
                Route::get('approve/{id}', array('as' => 'approve/payment-verify', 'before' => 'hasAccess:payment-verify.edit', 'uses' => 'AccMgmtPaymentVerifyController@getApprove'));
                Route::get('unapprove/{id}', array('as' => 'unapprove/payment-verify', 'before' => 'hasAccess:payment-verify.edit', 'uses' => 'AccMgmtPaymentVerifyController@getUnapprove'));
                
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
                Route::get('/', array('as' => 'general-voucher', 'before' => 'hasAccess:general-voucher.view', 'uses' => 'AccMgmtGeneralVoucherController@getIndex'));
                Route::post('/', array('before' => 'hasAccess:general-voucher.view', 'uses' => 'AccMgmtGeneralVoucherController@postIndex'));                           
                Route::get('create', array('as' => 'create/general-voucher', 'before' => 'hasAccess:general-voucher.create', 'uses' => 'AccMgmtGeneralVoucherController@getCreate'));
                Route::post('create', 'AccMgmtGeneralVoucherController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/general-voucher', 'before' => 'hasAccess:general-voucher.edit', 'uses' => 'AccMgmtGeneralVoucherController@getEdit'));       
                Route::post('edit/{id}', 'AccMgmtGeneralVoucherController@postEdit');                              
                Route::get('delete/{id}', array('as' => 'delete/general-voucher', 'before' => 'hasAccess:general-voucher.delete', 'uses' => 'AccMgmtGeneralVoucherController@getDelete'));                          
            });

            Route::group(array('prefix' => 'unapprove-voucher'), function()
            {

                Route::get('/', array('as' => 'unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getIndex'));
                Route::post('/', array('before' => 'hasAccess:unapprove-voucher.view', 'uses' => 'AccMgmtUnapproveVoucherController@postIndex'));                           
                Route::get('create', array('as' => 'create/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getCreate'));
                Route::post('create', 'AccMgmtUnapproveVoucherController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getEdit'));       
                Route::post('edit/{id}', 'AccMgmtUnapproveVoucherController@postEdit');                              
                Route::get('delete/{id}', array('as' => 'delete/unapprove-voucher', 'uses' => 'AccMgmtUnapproveVoucherController@getDelete'));                          
              
            });

            Route::group(array('prefix' => 'credit-limit-management'), function()
            {
                Route::get('/', array('as' => 'credit-limit-management', 'uses' => 'CreditLimitManagementController@getIndex'));
                Route::post('/', array('uses' => 'CreditLimitManagementController@postIndex'));                           
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
                Route::get('/', array('as' => 'credit-limit-management-bo', 'uses' => 'CreditLimitManagementController@getIndex'));
                Route::post('/', array('uses' => 'CreditLimitManagementController@postIndex'));                           
                Route::get('create', array('as' => 'create/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getCreate'));
                Route::post('create', 'CreditLimitManagementController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getEdit'));       
                Route::post('edit/{id}', 'CreditLimitManagementController@postEdit');                              
                Route::get('delete/{id}', array('as' => 'delete/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getDelete')); 
                Route::get('approve/{id}', array('as' => 'approve/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getApprove'));
                Route::get('unapprove/{id}', array('as' => 'unapprove/c-l-m-bo', 'uses' => 'CreditLimitManagementController@getUnapprove'));
           
            });
            
            Route::group(array('prefix' => 'credit-limit-management-db'), function()
            {
                Route::get('/', array('as' => 'credit-limit-management-db', 'uses' => 'CreditLimitManagementController@getIndex'));
                Route::post('/', array('uses' => 'CreditLimitManagementController@postIndex'));                           
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
                Route::get('/', array('as' => 'service-provider-setting', 'uses' => 'ServiceProviderSettingController@getIndex'));  

                Route::post('travel-port', array('as' => 'travel-port-setting', 'uses' => 'ServiceProviderSettingController@postTravelPort'));
                
                Route::post('united-solutions', array('as' => 'united-solution-setting', 'uses' => 'ServiceProviderSettingController@postUnitedSolutions'));
            });
        }); // Account Management
   

        #Deal Setup

        Route::group(array('prefix' => 'deal-setup'), function()
        {
            Route::get('/', array('as' => 'deal-setup', 'before' => 'hasAccess:airlines-deal-setup.view', 'uses' => 'DealSetupAirlineController@getIndex'));
            Route::get('create', array('as' => 'create/deal-setup', 'before' => 'hasAccess:airlines-deal-setup.create', 'uses' => 'DealSetupAirlineController@getCreate'));
            Route::post('create', 'DealSetupAirlineController@postCreate');
            Route::get('edit/{id}', array('as' => 'edit/deal-setup', 'before' => 'hasAccess:airlines-deal-setup.edit', 'uses' => 'DealSetupAirlineController@getEdit'));       
            Route::post('edit/{id}', 'DealSetupAirlineController@postEdit');                              
            Route::get('delete/{id}', array('as' => 'delete/deal-setup', 'before' => 'hasAccess:airlines-deal-setup.delete', 'uses' => 'DealSetupAirlineController@getDelete'));                          
          
        });

        #Paper Fare
        Route::group(array('prefix' => 'paper-fare'), function()
        {
            Route::get('/', array('as' => 'paper-fare', 'before' => 'hasAccess:airlines-paper-fare.view', 'uses' => 'PaperFareController@getIndex'));
            Route::get('create', array('as' => 'create/paper-fare', 'before' => 'hasAccess:airlines-paper-fare.create', 'uses' => 'PaperFareController@getCreate'));
            Route::post('create', 'PaperFareController@postCreate');
            Route::get('edit/{id}', array('as' => 'edit/paper-fare', 'before' => 'hasAccess:airlines-paper-fare.edit', 'uses' => 'PaperFareController@getEdit'));       
            Route::post('edit/{id}', 'PaperFareController@postEdit');                              
            Route::get('delete/{id}', array('as' => 'delete/paper-fare', 'before' => 'hasAccess:airlines-paper-fare.delete', 'uses' => 'PaperFareController@getDelete'));                          
        });

        #Reserved Tickets
        Route::group(array('prefix' => 'reserved-tickets'), function()
        {
            Route::get('/', array('as' => 'reserved-tickets', 'uses' => 'ReservedTicketsController@getIndex'));
            
            Route::get('edit/{id}', array('as' => 'edit/reserved-tickets', 'before' => 'hasAccess:airlines.edit', 'uses' => 'ReservedTicketsController@getEdit'));
            Route::post('edit/{id}', 'ReservedTicketsController@postEdit');

            Route::get('details/{id}', array('as' => 'details/reserved-tickets', 'uses' => 'ReservedTicketsController@getDetails'));       
            
            Route::post('details/{id}', 'ReservedTicketsController@issueTicket');

            Route::get('delete/{id}', array('as' => 'delete/reserved-tickets', 'before' => 'hasAccess:airlines.delete', 'uses' => 'ReservedTicketsController@getDelete'));                                              
        
        });

        #Issued Tickets
        Route::group(array('prefix' => 'issued-tickets'), function()
        {
            Route::get('/', array('as' => 'issued-tickets', 'before' => 'hasAccess:airlines.view', 'uses' => 'BookingController@getIndex'));
            
            Route::get('create', array('as' => 'create/issued-tickets', 'before' => 'hasAccess:airlines.create', 'uses' => 'BookingController@getCreate'));
            Route::post('create', 'BookingController@postCreate');

            Route::get('edit/{id}', array('as' => 'edit/issued-tickets', 'before' => 'hasAccess:airlines.edit', 'uses' => 'BookingController@getEdit'));
            Route::post('edit/{id}', 'BookingController@postEdit');
            
            Route::get('status-change/{id}', array('as' => 'status-change/issued-tickets', 'before' => 'hasAccess:airlines.view', 'uses' => 'BookingController@getEdit'));          
            Route::post('status-change/{id}', 'BookingController@StatusChange');   

            Route::get('details/{id}', array('as' => 'details/issued-tickets', 'before' => 'hasAccess:airlines.view', 'uses' => 'BookingController@getDetails'));       
            Route::get('delete/{id}', array('as' => 'delete/issued-tickets', 'before' => 'hasAccess:airlines.delete', 'uses' => 'BookingController@getDelete'));                                              
        });

        Route::group(array('prefix' => 'cancelled-tickets'), function()
        {
            Route::get('/', array('as' => 'cancelled-tickets', 'before' => 'hasAccess:airlines.view', 'uses' => 'BookingController@getIndex'));
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
                Route::get('/', array('as' => 'payment-gateways', 'uses' => 'MyBankAccountController@getIndex'));
                Route::post('/', 'MyBankAccountController@postIndex');
                Route::get('create', array('as' => 'create/payment-gateways', 'uses' => 'MyBankAccountController@getCreate'));
                Route::post('create', 'MyBankAccountController@postCreate');
                Route::get('edit/{id}', array('as' => 'edit/payment-gateways', 'uses' => 'MyBankAccountController@getEdit'));       
                Route::post('edit/{id}', 'MyBankAccountController@postEdit');                              
                Route::get('delete/{id}', array('as' => 'delete/payment-gateways', 'uses' => 'MyBankAccountController@getDelete'));                                                            
        });
        
        #Flight Search frontend
        Route::group(array('prefix' => 'flight-search'), function()
        {
            Route::get('/', array('as' => 'flight-search', 'uses' => 'FlightController@getBackendIndex'));                            
        });

        #Hotel Search
        Route::group(array('prefix' => 'hotel-search'), function()
        {
            Route::get('/', array('as' => 'hotel-search', 'uses' => 'SearchController@backendHotelIndex'));                    
        });

        #Package Tours Search
        Route::group(array('prefix' => 'package-tours-search'), function()
        {
            Route::get('/', array('as' => 'package-tours-search', 'uses' => 'SearchController@backendPackageToursIndex'));
            //Route::get('/{$id}', array('as' => 'package-tours/show', 'uses' => 'SearchController@backendPackageToursShow'));                                                                                                                                        
        });

        #Vacation Rental Search
        Route::group(array('prefix' => 'vacation-rental-search'), function()
        {
            Route::get('/', array('as' => 'vacation-rental-search', 'uses' => 'SearchController@backendVacationRentalIndex'));                                     
        });

        #Vehicle Rental Search
        Route::group(array('prefix' => 'vehicle-rental-search'), function()
        {
            Route::get('/', array('as' => 'vehicle-rental-search', 'uses' => 'SearchController@backendVehicleRentalIndex'));                                     
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
        Route::get('b2c/userslist', array('as' => 'b2c-userslist', 'before' => 'hasAccess:user-management.view', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
        Route::post('b2c/userslist', 'Controllers\Admin\UsersController@postIndex');

        #Login History
        Route::get('login-history', array('as'=>'login-history', 'uses'=> 'LoginHistoryController@getIndex'));

        #Ledger Transaction Summary
        Route::group(array('prefix' => 'ledger-transaction-summary'), function()
        {
            Route::get('/', array('as' => 'ledger-transaction-summary', 'uses' => 'LedgerTransactionController@getIndex'));
            Route::post('/', 'LedgerTransactionController@postIndex');
        });

        #Branch Office Ledger Transaction
        Route::group(array('prefix' => 'b-o-ledger-transaction'), function()
        {
            Route::get('/', array('as' => 'b-o-ledger-transaction', 'uses' => 'LedgerTransactionController@getIndex'));

        });

        #Distributor Ledger Transaction
        Route::group(array('prefix' => 'db-ledger-transaction'), function()
        {
            Route::get('/', array('as' => 'db-ledger-transaction', 'uses' => 'LedgerTransactionController@getIndex'));
            
        });

        #Credit Limit Transaction
        Route::group(array('prefix' => 'credit-limit-transaction'), function()
        {
            Route::get('/', array('as' => 'credit-limit-transaction', 'uses' => 'CreditLimitTransactionController@getIndex'));
            Route::post('/', 'CreditLimitTransactionController@postIndex');
        });

        #Agent Ledger Transaction
        Route::group(array('prefix' => 'agent-ledger-transaction'), function()
        {
            Route::get('/', array('as' => 'agent-ledger-transaction', 'uses' => 'LedgerTransactionController@getIndex'));
            Route::post('/', 'LedgerTransactionController@postIndex');
        });

        #Agent Balance
        Route::get('agent-balance', array('as' => 'agent-balance', function()
        {
            // Paginate the users
            $users = User::paginate(10);

            // Show the page
            return View::make('backend.agent_balance.index', compact('users'));
        })); 

        if($prefix == 'agent' or $prefix == 'user') 
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
                      
            #Agent Logo
            Route::get('agent-logo', array('as' => 'agent-logo', 'uses' => 'AgentController@getAgentLogo'));
            Route::post('agent-logo', 'AgentController@postAgentLogo');
                       
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
            
            #Credit Transaction History
            Route::get('credit-transaction-history', array('as' => 'credit-transaction-history', 'uses' => 'CreditTransactionHistoryController@getIndex'));
            
            #Issued Tickets
            Route::group(array('prefix' => 'issued-tickets'), function()
            {
                Route::get('/', array('as' => 'issued-tickets', 'uses' => 'BookingController@getAgentIndex'));
                Route::get('details/{id}', array('as' => 'details/issued-tickets', 'uses' => 'BookingController@getAgentDetails'));       
                
            });

            #Retrive PNR
            Route::group(array('prefix' => 'retrive-pnr'), function()
            {
                Route::get('/', array('as' => 'retrive-pnr', 'uses' => 'BookingController@RetrivePNRAgentIndex'));
                Route::post('/{id}', array('as' => 'post/retrive-pnr', 'uses' => 'FlightController@getPNR'));                            
            });

            #Cancel Request
            Route::group(array('prefix' => 'cancel-request'), function()
            {
                Route::get('/', array('as' => 'cancel-request', 'uses' => 'BookingController@getCancelRequestIndex'));
                Route::get('cancel/{id}', array('as' => 'cancel/cancel-request', 'uses' => 'BookingController@CancelRequest'));       
                
            });

            #Cancelled Request
            Route::group(array('prefix' => 'cancelled-request'), function()
            {
                Route::get('/', array('as' => 'cancelled-request', 'uses' => 'BookingController@getCancelRequestIndex'));
                Route::get('cancel/{id}', array('as' => 'cancel/cancelled-request', 'uses' => 'BookingController@CancelRequest'));       
                
            });
        } // Agent
    }); // Route group admin
                                
} else {

    Route::get('admin', function() {return Redirect::route('signin');});
    Route::get('admin/{all}', function() {return Redirect::route('signin');});
    Route::get('admin/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('admin/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('agent', function() {return Redirect::route('signin');});
    Route::get('agent/{all}', function() {return Redirect::route('signin');});
    Route::get('agent/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('agent/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('user', function() {return Redirect::route('signin');});
    Route::get('user/{all}', function() {return Redirect::route('signin');});
    Route::get('user/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('user/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('manager', function() {return Redirect::route('signin');});
    Route::get('manager/{all}', function() {return Redirect::route('signin');});
    Route::get('manager/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('manager/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('affilate', function() {return Redirect::route('signin');});
    Route::get('affilate/{all}', function() {return Redirect::route('signin');});
    Route::get('affilate/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('affilate/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('distributor', function() {return Redirect::route('signin');});
    Route::get('distributor/{all}', function() {return Redirect::route('signin');});
    Route::get('distributor/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('distributor/{all}/{any}/{many}', function() {return Redirect::route('signin');});

    Route::get('corporate', function() {return Redirect::route('signin');});
    Route::get('corporate/{all}', function() {return Redirect::route('signin');});
    Route::get('corporate/{all}/{any}', function() {return Redirect::route('signin');});
    Route::get('corporate/{all}/{any}/{many}', function() {return Redirect::route('signin');});     
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

if(ApplicationSetting::find(2)->value == 1) {

    Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getMaintenance'));


} else {
    
            Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getIndex'));
            Route::get('sctnpay', array('as' => 'sctnpay', 'uses' =>  'SctnpayController@getIndex'));
            Route::get('sctnpay-dlr', array('as' => 'sctnpay-dlr', 'uses' =>  'SctnpayController@sctnpayDlr'));

            /**
             * Package Tours Frontend Routes
             */
            Route::group(array('prefix' => 'package-tours'), function()
            {
                Route::get('/', array('as' => 'package-tours-index', 'uses' => 'PackageToursController@getFrontpage'));

                Route::get('/sortby/{query}',array('as' => 'package-search', 'uses' =>  'PackageToursController@getSort'));

                Route::get('{id}', array('as' => 'package-tours-show', 'uses' => 'PackageToursController@getPackageView'));

                Route::post('{id}', array('as' => 'package-tours-comment', 'before' => 'auth', 'uses' => 'ProductCommentsController@postCreate'));
                
                Route::get('order/{id}', array('as' => 'package-tours-order', 'before' => 'auth', 'uses' => 'PackageToursController@getPackageOrder'));
                
                Route::post('order/{id}', 'PackageToursController@postPackageOrder');
            });

            /**
             * Hotels Frontend Routes
             */
            Route::group(array('prefix' => 'hotels'), function()
            {
                Route::get('/', array('as' => 'hotel-index', 'uses' => 'HotelController@getFrontpage'));
                Route::get('{id}', array('as' => 'hotel-show', 'uses' => 'HotelController@getHotelView'));
                Route::get('e/{id}', array('as' => 'hotel-show-expedia', 'uses' => 'HotelController@getHotelViewExpedia'));
                Route::get('order/{id}', array('as' => 'hotel-order', 'uses' => 'HotelController@getHotelOrder'));
                Route::post('order/{id}', 'HotelController@postHotelOrder');
            });

            /**
             * Vacation Rentals Frontend Routes
             */
            Route::group(array('prefix' => 'vacation-rentals'), function()
            {
                Route::get('/', array('as' => 'vacation-index', 'uses' => 'VacationRentalController@getFrontpage'));

                Route::get('{id}', array('as' => 'vacation-show', 'uses' => 'VacationRentalController@getVacationView'));

                Route::get('order/{id}', array('as' => 'vacation-order', 'uses' => 'VacationRentalController@getVacationOrder'));
                Route::post('order/{id}', 'VacationRentalController@postVacationOrder');
            });

            /**
             * Vehicle Rentals Frontend Routes
             */
            Route::group(array('prefix' => 'vehicle-rentals'), function()
            {
                Route::get('/', array('as' => 'vehicle-index', 'uses' => 'VehicleRentalController@getFrontpage'));

                Route::get('{id}', array('as' => 'vehicle-show', 'uses' => 'VehicleRentalController@getVehicleView'));

                Route::get('order/{id}', array('as' => 'vehicle-order', 'uses' => 'VehicleRentalController@getVehicleOrder'));
                Route::post('order/{id}', 'VehicleRentalController@postVehicleOrder');  
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
            Route::post('searchbox4',array('as' => 'searchbox4', 'uses' =>  'SearchController@postSearchBox4'));

            Route::post('airline-search',array('as' => 'airline-search', 'uses' =>  'FlightAirlinesController@postAirlineSearch'));

            Route::post('airport-search',array('as' => 'airport-search', 'uses' =>  'FlightAirlinesController@postAirportSearch'));

            Route::post('issued-tickets-search',array('as' => 'issued-tickets-search', 'uses' =>  'BookingController@searchAgentIndex'));

            Route::post('flight-results',  array('as' => 'flight-results', 'uses' =>  'FlightController@getFlightAvailability'));

            Route::post('searching-flights', array('as' => 'flightsearch', 'uses' =>  'FlightController@searchingFlights'));

            Route::post('reservation', array('as' => 'reservation', 'uses' =>  'FlightController@reservation'));

            Route::get('reservation', array('as' => 'getreservation', 'uses' =>  'FlightController@reservation'));

            Route::post('issueticket', array('as' => 'issueticket', 'uses' =>  'FlightController@issueTicket'));

            Route::post('payment', array('as' => 'payment', 'before'=>'auth', 'uses' =>  'FlightController@payment'));

            Route::get('payment', array('as' => 'getpayment', 'before'=>'auth', 'uses' =>  'FlightController@payment'));

            Route::post('payment-process', array('as' => 'payment-process', 'uses' =>  'PaymentController@postRequest'));

            Route::post('paypal-redirect', array('as' => 'paypal-redirect', 'uses' =>  'PaypalRedirectController@postRequest'));

            Route::get('flightsearchintl',array('as' => 'flightsearchintl', 'uses' =>  'AbacusApiController@getFlightAvailability'));
            Route::post('flightsearchintl', 'AbacusApiController@getFlightAvailability');

            Route::get('hotelsearchintl',array('as' => 'hotelsearchintl', 'uses' =>  'AbacusApiController@getHotelAvailability'));

            Route::get('vehiclesearchintl',array('as' => 'vehiclesearchintl', 'uses' =>  'AbacusApiController@getVehicleAvailability'));

            Route::get('abacus_session_create/{null}',array('as' => 'abacus_session_create', 'uses' =>  'AbacusApiController@sessionCreate'));

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

            //API
            Route::group(array('prefix' => 'api'), function()
            {
                Route::group(array('prefix' => 'v1'), function()
                {
                    Route::group(array('prefix' => 'flight'), function()
                    {
                        Route::post('/', 'FlightApiController@postIndex'); 

                        Route::post('post-pnr', 'FlightApiController@postPnr'); 

                        Route::post('get-reserved-tickets', 'FlightApiController@getReservedTickets'); 

                        Route::post('get-issued-tickets', 'FlightApiController@getIssuedTickets'); 

                    });

                    Route::group(array('prefix' => 'login'), function()
                    {
                        Route::post('/', 'AuthApiController@postSignin'); 
                    });

                    Route::group(array('prefix' => 'signup'), function()
                    {
                        Route::post('/', 'AuthApiController@postSignup'); 
                    });

                    Route::group(array('prefix' => 'get-user-profile'), function()
                    {
                        Route::post('/', 'AuthApiController@getUserProfile'); 
                    });

                    Route::group(array('prefix' => 'get-user-balance'), function()
                    {
                        Route::post('/', 'AuthApiController@getUserBalance'); 
                    }); 

                    Route::group(array('prefix' => 'package-tours'), function()
                    {
                        Route::post('/', 'DatabaseApiController@getAllPackageTours');

                        Route::post('/{id}', 'DatabaseApiController@getSinglePackageTour'); 

                        Route::post('order/{id}', 'DatabaseApiController@postPackageOrder'); 

                    });

                    Route::group(array('prefix' => 'hotels'), function()
                    {
                        Route::post('/', 'DatabaseApiController@getAllHotels');

                        Route::post('/{id}', 'DatabaseApiController@getSingleHotel'); 

                        Route::post('order/{id}', 'DatabaseApiController@postHotelOrder'); 
                    });

                    Route::group(array('prefix' => 'vacation-rentals'), function()
                    {
                        Route::post('/', 'DatabaseApiController@getAllVacationRentals');

                        Route::post('/{id}', 'DatabaseApiController@getSingleVacationRental'); 

                        Route::post('order/{id}', 'DatabaseApiController@postVacationOrder');

                    });

                    Route::group(array('prefix' => 'vehicle-rentals'), function()
                    {
                        Route::post('/', 'DatabaseApiController@getAllVehicleRentals');

                        Route::post('/{id}', 'DatabaseApiController@getSingleVehicleRental'); 

                        Route::post('order/{id}', 'DatabaseApiController@postVehicleOrder');

                    });
                });
            });
            // /API

            //API
            Route::group(array('prefix' => 'country'), function()
            {
                Route::get('/{country}', function($country = null) 
                {
                    $countries = Location::where('country', $country)->get();

                    return $countries;

                });
            });

            //API
            Route::group(array('prefix' => 'developer-portal'), function()
            {
                Route::get('/' ,array('as' => 'developer-portal', 'uses' =>  'DeveloperAuthController@index'));

                Route::post('/signin' ,array('as' => 'developer-signin', 'uses' =>  'DeveloperAuthController@postSignin'));

                Route::post('/signup' ,array('as' => 'developer-signup', 'uses' =>  'DeveloperAuthController@postSignup'));

            });



            /* Route::get('post_iata', function()
                {
                    if (($handle = fopen("iata_icao.csv", "r")) !== FALSE) {
                      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $icao = $data[1];
                        $iata = $data[0];

                        $post = FlightAirlines::where('airlines_code', $icao)->first();

                        if (isset($post)) {
                            $post->airlines_shortcode = $iata;
                            if (!$post->save()) {
                                echo 'Could not save post data';
                                exit();
                            }
                            echo 'Data posted. ICAO:'. $icao . '-> IATA:'. $iata . '<br>' ;
                        }
                      }
                      fclose($handle);
                    }                        
                });*/



        }





