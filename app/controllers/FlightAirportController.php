<?php

class FlightAirportController extends BaseController {
    
    
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() {
        
        $entries = FlightAirport::join("countries","countries.id","=","flight_airports.country_id") ->paginate(10); 
        
        //$entries = FlightAirport::paginate(10);
        
        $this->layout->content=View::make('backend.flight.flight_airport.index', compact('entries'));
        
       
    }
          
    
    public function getCreate()
	{

		// Show the page
		//return View::make('backend.package_tours.create');
        $countries = Country::all();
        return View::make('backend.flight.flight_airport.create', compact('countries'));
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'airport_name'   => 'required',
            'country_id'    =>'required',
            'state_id'      =>'required',
            'city_id'       =>'required',
            'icao_code'     =>'required',
            'iata_code'     =>'required',    
					);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                
                
                $post = new FlightAirport;

                /*
                
                $file = Input::file('uploaded_file');
                
                if( isset($file)) {
                
                
                $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();
    
                $filemove = $file->move('assets/img/uploads',  $filename);
                
                $post->photo     = e($filename);
                }
                else {
                    
                    $post->photo     = e("default.png");
                    
                }
                
                // Update the blog post data
                
                $popular = Input::get('popular');
                $featured = Input::get('featured');
                $special = Input::get('special');
                
                if($popular != 1) { $popular = 0; }
                if($featured != 1) { $featured = 0;}
                if($special != 1) {$special = 0;}

                */
                

		// Update the blog post data
		        $post->airport_name            = e(Input::get('airport_name'));
		        $post->country_id     = e(Input::get('country_id'));              
                $post->state_id    = e(Input::get('state_id'));
                $post->city_id     = e(Input::get('city_id'));
                $post->icao_code     = e(Input::get('icao_code'));
                $post->iata_code     = e(Input::get('iata_code'));
                
                
		// Was the blog post created?
 

		// Was the blog post createdportif($post->save())
  if($post->save())
		{
			// Redirect to the new blog post page
			//return Redirect::to("admin/package_tours/create")->with('success', "Package has been created");
		      return Redirect::back()->with('success','Airport has been created');
        }

		// Redirect to the blog post create page
		//return Redirect::to('admin/package_tours/create')->with('error', "Package coudn't be created");
         
         else {
          return Redirect::back()->with('error','Airport cannot be created');      
      }
		

		
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = FlightAirport::find($id)))
		{
			// Redirect to the blogs management page
			//return Redirect::to('admin/categories')->with('error', "Couldn't find the selected category.");
		  return Redirect::back()->with('error', "Couldn't find the selected category.");
        }

		// Show the page

        // $entries = FlightAirport::join("countries","countries.id","=","flight_airports.country_id") ->paginate(10); 
		return View::make('backend.flight.flight_airport.edit', compact('entry'));
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
            'airport_name'=> 'required',
            'country_id'=> 'required',
            'state_id'=> 'required',
            'city_id'=> 'required',
            'icao_code'=> 'required',
            'iata_code'=> 'required',
            
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }
                
    if (is_null($post = FlightAirport::find($id)))
        {
            // Redirect to the blogs management page
            return Redirect::back()->with('error', "Couldn't find the selected category.");
        }                
          
          /*      
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
    */
                                 
        // Update the blog post data
        $post->airport_name            = e(Input::get('airport_name'));
        $post->country_id     = e(Input::get('country_id'));              
    $post->state_id    = e(Input::get('state_id'));
    $post->city_id     = e(Input::get('city_id'));
    $post->icao_code     = e(Input::get('icao_code'));
    $post->iata_code     = e(Input::get('iata_code'));    
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
		if (is_null($entry = FlightAirport::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::route('flight_airport')->with('error', "Couldn't delete airport.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::route('flight_airport')->with('success', "Airport deleted successfully");
	}
    
    
    
    
}
