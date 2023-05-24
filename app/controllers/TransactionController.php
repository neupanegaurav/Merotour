<?php

class TransactionController extends BaseController {
 
    public function getIndex() {
        
        $entries = GeneralVoucher::paginate(10);
        
        return View::make('backend.transactions.index', compact('entries'));
        
       
    }
          
    
    public function getCreate()
	{

		// Show the page
		return View::make('backend.categories.create');
	}

        
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required',
			'description' => 'required',
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
		$post = new Categories;

		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->description     = e(Input::get('description'));
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/categories/create")->with('success', "Category has been created");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/categories/create')->with('error', "Category coudn't be created");
	}
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Categories::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/categories')->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.categories.edit', compact('entry'));
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
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = Categories::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/categories/create')->with('error', "Couldn't find the selected category.");
		}


		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->description     = e(Input::get('description'));
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/categories/edit/$id")->with('success', "Category updated");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/categories/edit/$id')->with('error', "Couldn't update category.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Categories::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/categories')->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/categories')->with('success', "Category deleted successfully");
	}
    
    
    
    
}
