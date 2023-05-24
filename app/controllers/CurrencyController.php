<?php

class CurrencyController extends BaseController {
    
   
    public function postChange() {
        
		$currency = Input::get('currency');
		
		Session::forget('currency');
 
		Session::put('currency', $currency);        
        
		return Redirect::back()->with('success', "Currency has been changed");
             
    }
          
    
    public function getCreate()
	{

		// Show the page
		return View::make('backend.fx_rate.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'currency'   => 'required',
			'iso_code' => 'required',
			'symbol' => 'required',
			'exchange_rate' => 'required'
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
		$post = new FXRate;

		// Update the blog post data
		$post->currency            = e(Input::get('currency'));
		$post->iso_code     = e(Input::get('iso_code'));
		$post->symbol     = e(Input::get('symbol'));
		$post->exchange_rate     = e(Input::get('exchange_rate'));

		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "FXRate has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "FXRate coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = FXRate::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.fx_rate.edit', compact('entry'));
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
			'currency'   => 'required',
			'iso_code' => 'required',
			'symbol' => 'required',
			'exchange_rate' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = FXRate::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}


		// Update the blog post data
		$post->currency            = e(Input::get('currency'));
		$post->iso_code     = e(Input::get('iso_code'));
		$post->symbol     = e(Input::get('symbol'));
		$post->exchange_rate     = e(Input::get('exchange_rate'));


		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "FXRate updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update category.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = FXRate::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "FXRate deleted successfully");
	}
    
    
    
    
}
