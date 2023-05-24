<?php

class PagesController extends BaseController {
    
      public function getIndex() {
        
        $entries = Page::paginate(11);
        
        return View::make('backend.pages.index', compact('entries'));
        
       
    }
    
  
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Page::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/pages')->with('error', "Couldn't find the selected page");
		}
                
              

		// Show the page
		return View::make('backend.pages.edit', compact('entry'));
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
			'title'   => 'required',
			'slug'   => 'required',
			'content' => 'required',                
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = Page::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/pages/edit/$id')->with('error', "Couldn't find the selected radio.");
		}
                
                

		// Update the blog post data
		$post->title        = e(Input::get('title'));
		$post->slug        = e(Input::get('slug'));
		$post->content     = e(Input::get('content'));

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post page
			return Redirect::to("admin/pages/edit/$id")->with('success', "Page updated");
		}
                
                
                

		// Redirect to the blog post create page
		return Redirect::to('admin/pages/edit/$id')->with('error', "Couldn't update page.");
	
	}
        
         public function getCreate()
	{
	
		// Show the page
		return View::make('backend.pages.create');
	}
        
        public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required',
			'slug'   => 'required',
			'content' => 'required',                
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                $post = new Page;
                
                

		// Update the blog post data
		$post->title        = e(Input::get('title'));
		$post->slug        = e(Input::get('slug'));
		$post->content     = e(Input::get('content'));

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post page
			return Redirect::to("admin/pages/create")->with('success', "Page created");
		}
                
                
                

		// Redirect to the blog post create page
		return Redirect::to('admin/pages/create')->with('error', "Couldn't create page.");
	
	}
        
          public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Page::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/pages')->with('error', "Couldn't delete page.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/pages')->with('success', "Page deleted successfully");
	}
   

        
    
    
    
    
}
