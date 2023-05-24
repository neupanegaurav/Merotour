<?php

class ProductCommentsController extends BaseController {
    
    public function getIndex() {
        
        $entries = ProductComment::orderBy('id', 'ASC')->paginate(11);
        
        return View::make('backend.product_comments.index', compact('entries'));
        
    }
         
        
    public function getEdit($id)
	{
		if (is_null($entry = ProductComment::find($id)))
		{
			// Redirect to the blogs management product-comments
			return Redirect::to('admin/product-comments')->with('error', "Couldn't find the selected comment");
		}
                
              

		// Show the product-comments
		return View::make('backend.product_comments.edit', compact('entry'));
	}

	/**
	 * Group update form processing product_comments.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id)
	{
		// Declare the rules for the form validation
		$rules = array(
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
                
                if (is_null($post = ProductComment::find($id)))
		{
			// Redirect to the blogs management product-comments
			return Redirect::to('admin/product-comments/edit/$id')->with('error', "Couldn't find the selected comment.");
		}
                
                

		// Update the blog post data
				
		$post->content     = e(Input::get('content'));

                
                

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post product-comments
			return Redirect::to("admin/product-comments/edit/$id")->with('success', "Comment updated");
		}
                
                
                

		// Redirect to the blog post create product-comments
		return Redirect::to('admin/product-comments/edit/$id')->with('error', "Couldn't update comment.");
	
	}
        
         public function getCreate()
	{
	
		// Show the product-comments
		return View::make('backend.product_comments.create');
	}
        
        public function postCreate()
	{
            
            if(!Sentry::check()) { return Redirect::back()->with('error', "Please login to post comments");}
            
		// Declare the rules for the form validation
		$rules = array(			
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
                
                $post = new ProductComment;
                
                

		// Update the blog post data
		$post->user_id          = e(Sentry::getUser()->id);
		$post->product_type     = e(Input::get('product_type'));
		$post->product_id       = e(Input::get('id'));
		$post->content          = e(Input::get('content'));
		
               	

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post product-comments
			return Redirect::back()->with('success', "Comment created");
		}
                
                
                

		// Redirect to the blog post create product-comments
		return Redirect::to('admin/product-comments/create')->with('error', "Couldn't create product_comments.");
	
	}
        
          public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = ProductComment::find($id)))
		{
			// Redirect to the blogs management product-comments
			return Redirect::to('admin/product-comments')->with('error', "Couldn't delete comment.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management product-comments
		return Redirect::to('admin/product-comments')->with('success', "Comment deleted successfully");
	}
        
          public function getEnable($id)
	{
		// Check if the blog post exists
		if (is_null($entry = ProductComment::find($id)))
		{
			// Redirect to the blogs management product-comments
			return Redirect::to('admin/product-comments')->with('error', "Couldn't enable product_comments.");
		}

		// Delete the blog post
		$entry->enable = e(1);
                
                if($entry->save()) {
                    
                    
		return Redirect::to('admin/product-comments')->with('success', "product-comments enabled successfully");
                    
                    
                }

		
	}
        
          public function getDisable($id)
	{
		// Check if the blog post exists
		if (is_null($entry = ProductComment::find($id)))
		{
			// Redirect to the blogs management product-comments
			return Redirect::to('admin/product-comments')->with('error', "Couldn't disable product_comments.");
		}

		// Delete the blog post
		$entry->enable = e(0);
                
                 if($entry->save()) {
                     // Redirect to the blog posts management product-comments
		return Redirect::to('admin/product-comments')->with('success', "product-comments disabled successfully");
                     
                     
                 }

		
	}
   

        
    
    
    
    
}