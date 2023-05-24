<?php

class CitiesController extends BaseController {
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() 
    {      //modes
        $entries = Location::paginate(20);
        
        $this->layout->content = View::make('backend.cities.index', compact('entries'));
    }     
    
    public function getCreate()
	{
        //Countries list
        $countries = Country::all();

		// Show the page
		$this->layout->content = View::make('backend.cities.create', compact('countries'));
	}
        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
            'country'   => 'required',
            'city'      => 'required',                      
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}    

        $post = new Location;
                     
		// Update the blog post data
        $post->country   = e(Input::get('country'));
        $post->city      = e(Input::get('city'));              
        $post->latitude  = e(Input::get('latitude'));
        $post->longitude = e(Input::get('longitude'));
        $post->altitude  = e(Input::get('altitude'));

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "City has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "City coudn't be created");
          		
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Location::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected city.");
		}

        //Countries list
        $countries = Country::all();

		// Show the page
		$this->layout->content = View::make('backend.cities.edit', compact('entry', 'countries'));
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
			'country'   => 'required',
            'city'      => 'required',  
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        if (is_null($post = Location::find($id))) {
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected city.");
		}                              
                                 
		// Update the blog post data
		$post->country   = e(Input::get('country'));
        $post->city      = e(Input::get('city'));              
        $post->latitude  = e(Input::get('latitude'));
        $post->longitude = e(Input::get('longitude'));
        $post->altitude  = e(Input::get('altitude'));            		
    		
		// Was the blog post updated?
		if($post->save()) {
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "City updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update city.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Location::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete city.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "City deleted successfully");
	}
    
    
    
    
}
