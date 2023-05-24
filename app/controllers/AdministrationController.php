<?php

class AdministrationController extends BaseController {
    
    
    
    
    public function getIndex() {
        
       
        
        return View::make('backend.administration.index');
        
       
    }
    
    public function getSlider() {
        
        $entries = Slider::paginate(10);
        
        return View::make('backend.slider.index', compact('entries'));
        
        
    }
    
    public function getSliderAdd() {

    	$entries = Slider::all()->count();

    		if ($entries == 5)
		{
			// Ooops.. something went wrong
			return Redirect::back()->with('error', 'Sorry, you cannot add more than 5 slides. Please delete one of the current slides to add a new one.');
		}
        
        
          return View::make('backend.slider.create');
    }
    
    public function postSliderAdd() {
        
        // Declare the rules for the form validation
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
                
                
                
                $post = new Slider;
                
                    //Picture upload
                
                $picture = Input::file('uploaded_picture');
                
                if( isset($picture)) {
                
                
                $picturename = time() . '-' . Str::random(20);
    
                $picturemove = $picture->move('assets/img/uploads/slider/',  ($picturename . '.' . $picture->getClientOriginalExtension()));
                
                $post->big     = e($picturename . '.' . $picture->getClientOriginalExtension());
                
                $img = Image::make('assets/img/uploads/slider/'. $picturename . '.' . $picture->getClientOriginalExtension())->resize(97, 74);
                $img->save('assets/img/uploads/slider/'. $picturename . '_t' . '.' . $picture->getClientOriginalExtension(), 100);
                
                $post->thumbnail = e($picturename . '_t' . '.' . $picture->getClientOriginalExtension());
                
                
                }
                else {
                    
                    $post->big     = e("default.jpg");
                    $post->thumbnail = e("default.jpg");
                    
                }
                
                
              
                

		// Update the blog post data
		$post->description     = e(Input::get('description'));              
    $post->country     = e(Input::get('country'));
       
                
               		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/slider/create")->with('success', "Slider has been added");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/slider/create')->with('error', "Slider coudn't be added");
                
        
        
    
    
        
        
        
        
    }
    
      public function getSliderEdit($id) {
          
          if (is_null($entry = Slider::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/slider')->with('error', "Couldn't find the selected slider.");
		}
        
        
          return View::make('backend.slider.edit', compact('entry'));
    }
    
    public function postSliderEdit($id) {
          
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
	                	                             
	    if (is_null($post = Slider::find($id)))
			{
				// Redirect to the blogs management page
				return Redirect::to('admin/admin/slider/edit')->with('error', "Couldn't find the selected slider.");
			}
	               
	                
	                   //Picture upload
	                
	                $picture = Input::file('uploaded_picture');
	                
	                if( isset($picture)) {
	                	                
		                $picturename = time() . '-' . Str::random(20);
		    
		                $picturemove = $picture->move('assets/img/uploads/slider',  $picturename . '.' . $picture->getClientOriginalExtension());
		                	                
		                if($post->big != "default.png") {
		                
		                File::delete('assets/img/uploads/slider/'. $post->big);
		                } else{}
		      
		                
		                $post->big     = e($picturename . '.' . $picture->getClientOriginalExtension());
		                
										$img = Image::make('assets/img/uploads/slider/'. $picturename . '.' . $picture->getClientOriginalExtension())->resize(97, 74);
	                	$img->save('assets/img/uploads/slider/'. $picturename . '_t' . '.' . $picture->getClientOriginalExtension(), 100);
	                	                
		                $post->thumbnail = e($picturename . '_t' . '.' . $picture->getClientOriginalExtension());		                	                
	                }
	                else {
	                    
	                   
	                    
	                }
	                
	                
	                // Update the blog post data
			$post->description     = e(Input::get('description'));              
	                $post->country     = e(Input::get('country'));
	       
	                
	               		

			// Was the blog post created?
			if($post->save())
			{
				// Redirect to the new blog post page
				return Redirect::back()->with('success', "Slider has been edited");
			}

			// Redirect to the blog post create page
			return Redirect::back()->with('error', "Slider coudn't be edited");            
    }
    
     public function getSliderDelete($id)
	{
        
      
        
		// Check if the blog post exists
		if (is_null($entry = Slider::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/slider')->with('error', "Couldn't delete slider.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/slider')->with('success', "Slider deleted successfully");
                
                 
               
                
	}
    
    
    
   
    
    
    
    
    
}
