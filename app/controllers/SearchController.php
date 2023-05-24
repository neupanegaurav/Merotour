<?php

class SearchController extends AbacusApiController {
    
    public function postSearch()
    {
    	$q = Input::get('query');

    	$entries = PackageTours::whereRaw("MATCH(name,country) AGAINST(? IN BOOLEAN MODE)", array($q))
                    ->paginate(10);

    	return View::make('frontend.search', compact('q','entries'));
    }

    public function postSearchbox1() 
    {        
        $postcode          = Input::get('postcode');
        $select_group      = Input::get('select_group');
        $package_country   = Input::get('package_country');
        $package_state     = Input::get('package_state');
        $package_area_city = Input::get('package_area_city');

        $entriesq = PackageTours::query();

        if(!empty($postcode)) {
            $entriesq->where('postal_code', $postcode);
        }
        if(!empty($select_group) and $select_group != 'Any' ) {
            $entriesq->where('package_group', $select_group);
        }
        if(!empty($package_country)) {
            $entriesq->where('country', $package_country);
        }
        if(!empty($package_state)) {
            $entriesq->where('state', $package_state);
        }
        if(!empty($package_area_city)) {
            $entriesq->where('area_city', $package_area_city);
        }       

        $entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

        $test = Input::get('backend');

        if(!empty($test)) {
            $slug = 'backend.package_tours_search.search';
        } else {
            $slug = 'frontend.search';
        }

        $q = 'Package Tours';

        return View::make($slug, compact('q' , 'entries'));           
    }

    public function backendHotelIndex() 
    {
        return View::make('backend.hotel_search.index');
    }

    public function backendPackageToursIndex() 
    {
        return View::make('backend.package_tours_search.index');
    }

    public function backendPackageToursShow($id) 
    {
        return View::make('backend.package_tours_search.show');
    }

    public function backendVacationRentalIndex() 
    {
        return View::make('backend.vacation_rental_search.index');
    }

    public function backendVehicleRentalIndex() 
    {
        return View::make('backend.vehicle_rental_search.index');
    }

    public function postSearchbox2() 
    {
        $hotel_country  = Input::get('hotel_country');
        $check_in       = Input::get('check_in');
        $check_out      = Input::get('check_out');
        $hotel_location = Input::get('hotel_location');

        $entriesq = Hotel::query();

        if(!empty($hotel_country))
        {
            $entriesq->where('country', $hotel_country);
        }
        if(!empty($check_in))
        {
            $check_in .= '00:00:00';

            $entriesq->where('effective_from', '<=' , $check_in);
        }
        if(!empty($check_out))
        {
            $check_out .= '00:00:00';

            $entriesq->where('expire_on', '>', $check_out);
        }
        if(!empty($hotel_location))
        {
            $entriesq->where('location_of_hotel', $hotel_location);
        }       

        $entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

        $responses = parent::getHotelAvailability($hotel_location);

        $test = Input::get('backend');

        if(!empty($test)) {
            $slug = 'backend.hotel_search.search';
        } else {
            $slug = 'frontend.search';
        }

        $q = "Hotels"; 
		return View::make($slug, compact('q' , 'entries', 'responses', 'country'));           
    }
    
    public function postSearchbox3() 
    {
        
        $country              = Input::get('vacation_country');
        $vacation_state       = Input::get('vacation_state');
        $vacation_area        = Input::get('vacation_area');
        $vacation_rental_type = Input::get('vacation_rental_type');
        $vacation_bedroom     = Input::get('vacation_bedroom');
        $check_in             = Input::get('check_in');
        $check_out            = Input::get('check_out');

        $entriesq = VacationRental::query();

        //return $country;

        if(!empty($country) and $country != 'Select Country...') {
            $entriesq->where('country', (int)$country);
        }
        if(!empty($vacation_state) and $vacation_state != 'Select state..') {
            $entriesq->where('state', $vacation_state);
        }  
        if(!empty($vacation_area) and $vacation_area != 'Select Area..') {
            $entriesq->where('area_city', $vacation_area);
        }   
        if(!empty($vacation_rental_type) and $vacation_rental_type != 'Select Type..') {
            $entriesq->where('category_tree', $vacation_rental_type);
        }  
        if(!empty($vacation_bedroom) and $vacation_bedroom != 'Any' ) {
            $entriesq->where('number_of_bed_rooms', $vacation_bedroom);
        }

        if(!empty($check_in))
        {
            $check_in .= '00:00:00';

            $entriesq->where('effective_from', '<=' , $check_in);
        }
        if(!empty($check_out))
        {
            $check_out .= '00:00:00';

            $entriesq->where('expire_on', '>', $check_out);
        }

        
        $entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

        $test = Input::get('backend');

        if(!empty($test)) {
            $slug = 'backend.vacation_rental_search.search';
        } else {
            $slug = 'frontend.search';
        }
        
        $q = "Vacation Rentals";

		return View::make($slug, compact('q' , 'entries'));
    }

    public function postSearchbox4() {
        
        $vehicle_country    = Input::get('vehicle_country');
        $vehicle_from       = Input::get('vehicle_from');
        $vehicle_to         = Input::get('vehicle_to');
        $pickup_date        = Input::get('pickup_date');
        $return_date        = Input::get('return_date');
        $car_rental_type    = Input::get('car_rental_type');
        $service_type       = Input::get('service_type');
        $vehicle_passengers = Input::get('vehicle_passengers');
        $luggage            = Input::get('luggage');

        $entriesq = VehicleRental::query();

        if(!empty($vehicle_country)) {
            $entriesq->where('country', $vehicle_country);
        }
        if(!empty($vehicle_from)) {
            $entriesq->where('vehicle_from', $vehicle_from);
        }
        if(!empty($vehicle_to)) {
            $entriesq->where('vehicle_to', $vehicle_to);
        }   
        if(!empty($pickup_date))
        {
            $pickup_date .= '00:00:00';

            $entriesq->where('effective_from', '<=' , $pickup_date);
        }
        if(!empty($car_rental_type)) {
            $entriesq->where('state', $car_rental_type);
        }
        if(!empty($service_type)) {
            $entriesq->where('state', $service_type);
        }
        if(!empty($vehicle_passengers)) {
            $entriesq->where('state', $vehicle_passengers);
        }
        if(!empty($luggage)) {
            $entriesq->where('state', $luggage);
        }

        $entries = $entriesq->orderBy('created_at', 'DESC')->paginate(10);

        //$vehicle_responses = null;

        //$vehicle_responses = parent::getVehicleAvailability($state_code, $postal_code);

        $test = Input::get('backend');

        if(!empty($test)) {
            $slug = 'backend.vehicle_rental_search.search';
        } else {
            $slug = 'frontend.search';
        }
        
        $q = "Vehicle Rentals";

        return View::make($slug, compact('q' , 'entries', 'vehicle_responses'));               
    }
      
    
}

