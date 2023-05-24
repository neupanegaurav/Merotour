<?php

class MenuController extends BaseController {
    
      public function getIndex() {
        
        $entries = Menu::orderBy('id', 'ASC')->paginate(11);
        
        return View::make('backend.menu.index', compact('entries'));
        
       
    }
    
  
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Menu::find($id)))
		{
			// Redirect to the blogs management menu
			return Redirect::to('admin/menu')->with('error', "Couldn't find the selected menu");
		}
                
              

		// Show the menu
		return View::make('backend.menu.edit', compact('entry'));
	}

	/**
	 * Group update form processing menu.
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
                
                if (is_null($post = Menu::find($id)))
		{
			// Redirect to the blogs management menu
			return Redirect::to('admin/menu/edit/$id')->with('error', "Couldn't find the selected radio.");
		}
                
                

		// Update the blog post data
		$post->title        = e(Input::get('title'));
		$post->slug        = e(Input::get('slug'));
		$post->content     = e(Input::get('content'));

                
                

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post menu
			return Redirect::to("admin/menu/edit/$id")->with('success', "Menu updated");
		}
                
                
                

		// Redirect to the blog post create menu
		return Redirect::to('admin/menu/edit/$id')->with('error', "Couldn't update menu.");
	
	}
        
         public function getCreate()
	{
	
		// Show the menu
		return View::make('backend.menu.create');
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
                
                $post = new Menu;
                
                

		// Update the blog post data
		$post->title        = e(Input::get('title'));
		$post->slug        = e(Input::get('slug'));
		$post->content     = e(Input::get('content'));
                $post->editable     = e(1);
		$post->enable     = e(1);

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post menu
			return Redirect::to("admin/menu/create")->with('success', "Menu created");
		}
                
                
                

		// Redirect to the blog post create menu
		return Redirect::to('admin/menu/create')->with('error', "Couldn't create menu.");
	
	}
        
          public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Menu::find($id)))
		{
			// Redirect to the blogs management menu
			return Redirect::to('admin/menu')->with('error', "Couldn't delete menu.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management menu
		return Redirect::to('admin/menu')->with('success', "Menu deleted successfully");
	}
        
          public function getEnable($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Menu::find($id)))
		{
			// Redirect to the blogs management menu
			return Redirect::to('admin/menu')->with('error', "Couldn't enable menu.");
		}

		// Delete the blog post
		$entry->enable = e(1);
                
                if($entry->save()) {
                    
                    
		return Redirect::to('admin/menu')->with('success', "Menu enabled successfully");
                    
                    
                }

		
	}
        
          public function getDisable($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Menu::find($id)))
		{
			// Redirect to the blogs management menu
			return Redirect::to('admin/menu')->with('error', "Couldn't disable menu.");
		}

		// Delete the blog post
		$entry->enable = e(0);
                
                 if($entry->save()) {
                     // Redirect to the blog posts management menu
		return Redirect::to('admin/menu')->with('success', "Menu disabled successfully");
                     
                     
                 }

		
	}
   

        
    
    
    
    
}
