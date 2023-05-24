<?php

class DealSetupAirlineController extends BaseController {
    
    
    public function getIndex() {
        
        $entries = DealSetupAirline::paginate(10);
        
        return View::make('backend.dealsetup.airline.index', compact('entries'));            
    }
          
    
    public function getCreate()
	{

		// Show the page
		return View::make('backend.dealsetup.airline.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'setup_from'  		=> 'required',
			'setup_to' 			=> 'required',
			'airline' 			=> 'required',
			'class' 			=> 'required',
			'departure_time' 	=> 'required',
			'arrival_time' 		=> 'required',
			'flight_number' 	=> 'required|integer',
			'base_fare' 		=> 'required|integer',
			'currency' 			=> 'required',
			'tax_name_1' 		=> 'required',
			'tax_amount_1' 		=> 'required|integer',
			'tax_name_2' 		=> 'required',
			'tax_amount_2' 		=> 'required|integer',
			'tax_name_3' 		=> 'required',
			'tax_amount_3' 		=> 'required|integer',
			'effective_from' 	=> 'required',
			'expire_on' 		=> 'required',
			'total_seat_quota' 	=> 'required',
			'status' 			=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new Deal Setup
		$post = new DealSetupAirline;

		// Update the blog post data
			$post->setup_from  		= e(Input::get('setup_from'));
			$post->setup_to    		= e(Input::get('setup_to'));
			$post->airline 			= e(Input::get('airline'));
			$post->class 			= e(Input::get('class'));
			$post->departure_time 	= e(Input::get('departure_time'));
			$post->arrival_time 	= e(Input::get('arrival_time'));
			$post->flight_number 	= e(Input::get('flight_number'));
			$post->base_fare 		= e(Input::get('base_fare'));
			$post->currency 		= e(Input::get('currency'));
			$post->tax_name_1 		= e(Input::get('tax_name_1'));
			$post->tax_amount_1 	= e(Input::get('tax_amount_1'));
			$post->tax_name_2 		= e(Input::get('tax_name_2'));
			$post->tax_amount_2 	= e(Input::get('tax_amount_2'));
			$post->tax_name_3 		= e(Input::get('tax_name_3'));
			$post->tax_amount_3 	= e(Input::get('tax_amount_3'));
			$post->fare_rules 		= e(Input::get('fare_rules'));
			$post->effective_from 	= e(Input::get('effective_from'));
			$post->expire_on 		= e(Input::get('expire_on'));
			$post->total_seat_quota = e(Input::get('total_seat_quota'));
			$post->status 			= e(Input::get('status'));
			$post->note 			= e(Input::get('note'));

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Deal Setup has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Deal Setup coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
		}

		// Show the page
		return View::make('backend.dealsetup.airline.edit', compact('entry'));
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
			'setup_from'  		=> 'required',
			'setup_to' 			=> 'required',
			'airline' 			=> 'required',
			'class' 			=> 'required',
			'departure_time' 	=> 'required',
			'arrival_time' 		=> 'required',
			'flight_number' 	=> 'required|integer',
			'base_fare' 		=> 'required|integer',
			'currency' 			=> 'required',
			'tax_name_1' 		=> 'required',
			'tax_amount_1' 		=> 'required|integer',
			'tax_name_2' 		=> 'required',
			'tax_amount_2' 		=> 'required|integer',
			'tax_name_3' 		=> 'required',
			'tax_amount_3' 		=> 'required|integer',
			'effective_from' 	=> 'required',
			'expire_on' 		=> 'required',
			'total_seat_quota' 	=> 'required',
			'status' 			=> 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
		}

			// Update the blog post data
			$post->setup_from  		= e(Input::get('setup_from'));
			$post->setup_to    		= e(Input::get('setup_to'));
			$post->airline 			= e(Input::get('airline'));
			$post->class 			= e(Input::get('class'));
			$post->departure_time 	= e(Input::get('departure_time'));
			$post->arrival_time 	= e(Input::get('arrival_time'));
			$post->flight_number 	= e(Input::get('flight_number'));
			$post->base_fare 		= e(Input::get('base_fare'));
			$post->currency 		= e(Input::get('currency'));
			$post->tax_name_1 		= e(Input::get('tax_name_1'));
			$post->tax_amount_1 	= e(Input::get('tax_amount_1'));
			$post->tax_name_2 		= e(Input::get('tax_name_2'));
			$post->tax_amount_2 	= e(Input::get('tax_amount_2'));
			$post->tax_name_3 		= e(Input::get('tax_name_3'));
			$post->tax_amount_3 	= e(Input::get('tax_amount_3'));
			$post->fare_rules 		= e(Input::get('fare_rules'));
			$post->effective_from 	= e(Input::get('effective_from'));
			$post->expire_on 		= e(Input::get('expire_on'));
			$post->total_seat_quota = e(Input::get('total_seat_quota'));
			$post->status 			= e(Input::get('status'));
			$post->note 			= e(Input::get('note'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Deal Setup updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update Deal Setup.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Deal Setup deleted successfully");
	}
    
    
    
    
}
