<?php 

class BannerController extends BaseController {

	/**
	 * Show a list of all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the blog posts
		$entries = Banners::paginate(10);

		// Show the page
		return View::make('backend.banners.index', compact('entries'));
	}
    
    public function getCreate() {

    	$entries = Banners::all()->count();

    		if ($entries >= 5)
		{
			// Ooops.. something went wrong
			return Redirect::back()->with('error', 'Sorry, you cannot add more than 5 banners. Please delete one of the current slides to add a new one.');
		}
        
        
          return View::make('backend.banners.create');
    }
    
    public function postCreate() {
        
        // Declare the rules for the form validation
		$rules = array(
			'banner_name'   => 'required',
			'uploaded_picture'   => 'required|image',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                
                
                $post = new Banners;
                
                    //Picture upload
                
                 $file = Input::file('uploaded_picture');

                
                if( isset($file)) 
                {                
                    
                $filenamepart = time() . '-' . Str::random(20); 

                $image_name = $filenamepart . '.' . $file->getClientOriginalExtension();

                $big_filemove = $file->move('assets/img/uploads/banners',  $image_name);
              
                $image = Image::make('assets/img/uploads/banners/'. $image_name )->resize(700, null, function ($constraint) {
												    $constraint->aspectRatio();
												});

                $image->save('assets/img/uploads/banners/'. $image_name, 100);

                $icon = Image::make('assets/img/uploads/banners/'. $image_name)->resize(97, 74);
                $icon->save('assets/img/uploads/banners/'. $filenamepart. '_icon' . '.' . $file->getClientOriginalExtension(), 100);
            

                $post->image =  $image_name;

                $post->icon  =  $filenamepart. '_icon' . '.' . $file->getClientOriginalExtension();                
                
                }

                else 
                {
                	$post->image    = 'default.png';
              
                    $post->icon     = "default.png";
                    
                }
                            

		// Update the blog post data
		$post->name     = e(Input::get('description'));              
       
                           		
		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/banner/create")->with('success', "Banner has been added");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/banner/create')->with('error', "Banner coudn't be added");
                     
    }
    
      public function getEdit($id) {
          
          if (is_null($entry = Banners::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/banner')->with('error', "Couldn't find the selected banners.");
		}
        
        
          return View::make('backend.banners.edit', compact('entry'));
    }
    
       public function postEdit($id) {
          
          $rules = array(
			'country'   => 'required',
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
                
                
                
             
                if (is_null($post = Banners::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/admin/banner/edit')->with('error', "Couldn't find the selected banners.");
		}
               
                
                   //Picture upload
                
                $picture = Input::file('uploaded_picture');
                
                if( isset($picture)) {
                
                
                $picturename = time() . '-' . Str::random(20);
    
                $picturemove = $picture->move('assets/img/uploads/banner',  $picturename . '.' . $picture->getClientOriginalExtension());
                
                
                if($post->big != "default.png") {
                
                File::delete('assets/img/uploads/banner/'. $post->big);
                } else{}
                
                
                $post->big     = e($picturename . '.' . $picture->getClientOriginalExtension());
                
               // $thumbnail = Image::make($picture->getRealPath())->resize(300, null, true)->save($picturename . '_t' . '.' . $picture->getClientOriginalExtension());
                
                $post->thumbnail = e($picturename . '_t' . '.' . $picture->getClientOriginalExtension());
                
                
                
                
                }
                else {
                    
                   
                    
                }
                
                
                // Update the blog post data
				$post->description     = e(Input::get('description'));              
       
                
               		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/banner/edit")->with('success', "Banner has been edited");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/banner/edit')->with('error', "Banner coudn't be edited");
                
                
                
                
                
    }
    
     public function getDelete($id)
	{
        
      
        
		// Check if the blog post exists
		if (is_null($entry = Banners::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/banner')->with('error', "Couldn't delete banners.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/banner')->with('success', "Banner deleted successfully");
                
                 
               
                
	}

}
