<?php

class BranchOfficesController extends BaseController {
    
    
    public function getIndex() {
        
        $entries = BranchOffices::paginate(10);
        
        return View::make('backend.branch_offices.index', compact('entries'));
             
    }

    public function postIndex() {

    	// Declare the rules for the form validation
		$rules = array(
			'branch_name'   => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$branch_name = Input::get('branch_name');

		$entries = BranchOffices::
		whereRaw("MATCH(name,location) AGAINST(? IN BOOLEAN MODE)", array($branch_name))
		->paginate(10);
                
        return View::make('backend.branch_offices.index', compact('entries'));
             
    }
          
    
    public function getCreate()
	{
		// Show the page
		return View::make('backend.branch_offices.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required',
			'location' => 'required',
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
		$post = new BranchOffices;

		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->location     = e(Input::get('location'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Office has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Office coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = BranchOffices::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.branch_offices.edit', compact('entry'));
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
			'name'   => 'required',
			'location' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = BranchOffices::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}


		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->location    = e(Input::get('location'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Office updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update category.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = BranchOffices::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Office deleted successfully");
	}
    
    
    
    
}
