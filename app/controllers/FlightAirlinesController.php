<?php

class FlightAirlinesController extends BaseController {
    
    public function getAirlineOrder($id){
	    if (is_null($entry = AirlineTours::find($id)))
			{
				// Redirect to the blogs management page
				return Redirect::to('airline-tours/$id')->with('error', "Couldn't find the selected airline tours.");
			}
	        
	    return View::make('frontend.airline-tours-order', compact('entry'));    
    }
    
    public function postAirlineOrder(){
        
      $id = Input::get('id');
       
        // Declare the rules for the form validation
			$rules = array(
	      'airline_name'  => 'required',
				'date'   				=> 'required',
				'group_size' 		=> 'required|Integer',
			);

			// Create a new validator instance from our validation rules
			$validator = Validator::make(Input::all(), $rules);

			// If validation fails, we'll exit the operation now.
			if ($validator->fails())
			{
				// Ooops.. something went wrong
				return Redirect::back()->withInput()->withErrors($validator);
			}

			// Create a new category
			$post = new Orders;
	                
	    $userdetails 				 = Sentry::getUser();

			// Update the blog post data
	    $post->category_name = e(Input::get('category_name'));
			$post->airline_name  = e(Input::get('airline_name'));              
	    $post->user_id       = e($userdetails->id);
			$post->date        	 = e(Input::get('date'));
	    $post->group_size    = e(Input::get('group_size'));
			

			// Was the blog post created?
			if($post->save())
			{
				// Redirect to the new blog post page
				return Redirect::to("airline-tours/order/$id")->with('success', "Your order has been created");
			}

			// Redirect to the blog post create page
			return Redirect::to("airline-tours/order/$id")->with('error', "Order coudn't be created");    
    }
        
    
    
    
    public function getAirlineView($id){
        
        
        if (is_null($entry = AirlineTours::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('airline-tours')->with('error', "Couldn't find the selected airline tours.");
		}

		// Show the page
		return View::make('frontend.airline-tours-show', compact('entry'));
        
    }
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() {
        
        
        $entries = FlightAirlines::paginate(10);
        
        $this->layout->content = View::make('backend.flight.flight_airlines.index', compact('entries'));
          
    }

    public function postAirlineSearch() 
    {


        // Declare the rules for the form validation
		$rules = array(
            'query'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$query = e(Input::get('query'));
        
        $entries = FlightAirlines::where('airlines_name', $query)->paginate(10);

        
        $this->layout->content = View::make('backend.flight.flight_airlines.index', compact('entries', 'query'));
       
       
    }

     public function postAirportSearch() 
    {


        // Declare the rules for the form validation
		$rules = array(
            'query'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$query = e(Input::get('query'));
        
        $entries = FlightAirport::where('airport_name', $query)->paginate(10);

        
        $this->layout->content = View::make('backend.flight.flight_airport.index', compact('entries', 'query'));
            
    }        
    
    public function getCreate()
	{
		// Show the page
		return View::make('backend.flight.flight_airlines.create');
	}
        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'airlines_name'=> 'required',
			'airlines_hub'=> 'required',
			'airlines_hub_city'=> 'required',
			'airlines_shortcode'=> 'required',
			'airlines_code'=> 'required',
			'airlines_short_desc'=> 'required',
			'airlines_date'=> 'required',

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}    

    $post = new FlightAirlines;
    
    $file = Input::file('primary_image');
    
    if( isset($file)) {                             
    $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();

    $filemove = $file->move('assets/img/airlines/',  $filename);
    
    $post->primary_image     = e($filename);
    $post->airlines_logo     = e($filename);
    } else {                 
        $post->primary_image     = e("default.png");
        $post->airlines_logo     = e("default.png");                   
    }
                
                
               
            
		// Update the blog post data
				$post->airlines_name            = e(Input::get('airlines_name'));
				$post->airlines_hub     = e(Input::get('airlines_hub'));              
                $post->airlines_hub_city    = e(Input::get('airlines_hub_city'));
                $post->airlines_shortcode     = e(Input::get('airlines_shortcode'));
                $post->airlines_code     = e(Input::get('airlines_code'));
                $post->airlines_short_desc     = e(Input::get('airlines_short_desc'));
                $post->airlines_date     = e(Input::get('airlines_date'));
                $post->entry_by     = e(Sentry::getUser()->id);              
                
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Airline has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Airline coudn't be created");
          		
	}
        
        
  public function getEdit($id)
	{
		if (is_null($entry = FlightAirlines::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.flight.flight_airlines.edit', compact('entry'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id)
	{
		// Declare the rules for the form validation
		$rules = array(
			'airlines_name'=> 'required',
			'airlines_hub'=> 'required',
			'airlines_hub_city'=> 'required',
			'airlines_shortcode'=> 'required',
			'airlines_code'=> 'required',
			'airlines_short_desc'=> 'required',
			'airlines_date'=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
    if (is_null($post = FlightAirlines::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}                
                
    $file = Input::file('primary_image');
    
    if( isset($file)) {                             
    $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();

    $filemove = $file->move('assets/img/airlines/',  $filename);
    
    $post->primary_image     = e($filename);
    $post->airlines_logo     = e($filename);
    } else {                 
        $post->primary_image     = e("default.png");
        $post->airlines_logo     = e("default.png");                   
    }
                                 
		// Update the blog post data
		$post->airlines_name            = e(Input::get('airlines_name'));
		$post->airlines_hub     = e(Input::get('airlines_hub'));              
    $post->airlines_hub_city    = e(Input::get('airlines_hub_city'));
    $post->airlines_shortcode     = e(Input::get('airlines_shortcode'));
    $post->airlines_code     = e(Input::get('airlines_code'));
    $post->airlines_short_desc     = e(Input::get('airlines_short_desc'));
    $post->airlines_date     = e(Input::get('airlines_date'));
    $post->entry_by     = e(Sentry::getUser()->id);              		
		
		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Airline updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update airline.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = AirlineTours::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::route('flight_airlines')->with('error', "Couldn't delete airline.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::route('flight_airlines')->with('success', "Airline deleted successfully");
	}
    
    
    
    
}
