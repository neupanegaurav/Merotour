<?php

class ApplicationSettingController extends BaseController {
    
    
    public function getIndex() {       
        $entries = ApplicationSetting::take(4)->get();
        $logo = ApplicationSetting::find(6);
        $phone = ApplicationSetting::find(7);
        $address = ApplicationSetting::find(8);
        $default_currency = ApplicationSetting::find(5);

        
        return View::make('backend.application_setting.index', compact('entries', 'logo', 'phone', 'address', 'default_currency'));          
    }
        
	
	public function postEdit()
	{
		$id = 1;
		// Declare the rules for the form validation
		$rules = array(
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        if (
        is_null($post1 = ApplicationSetting::find(1)) or
        is_null($post2 = ApplicationSetting::find(2)) or
        is_null($post3 = ApplicationSetting::find(3)) or
        is_null($post4 = ApplicationSetting::find(4)) or
        is_null($post5 = ApplicationSetting::find(5)) or
        is_null($post6 = ApplicationSetting::find(6)) or
        is_null($post7 = ApplicationSetting::find(7)) or
        is_null($post8 = ApplicationSetting::find(8)) 
        )

		{
			return Redirect::back()->with('error', "Couldn't find the selected Application Setting.");
		}

		$post1->value  				= e(Input::get('offline_processing'));
		$post2->value  				= e(Input::get('site_maintenance'));
		$post3->value  				= e(Input::get('b2b'));
		$post4->value  				= e(Input::get('b2c'));
		$post5->default_currency	= e(Input::get('default_currency'));
	    $post7->phone_number       	= e(Input::get('phone_number'));
	    $post8->address       		= e(Input::get('address'));

		
		 //Picture upload
                
        $image = Input::file('uploaded_picture');
        
        if( isset($image)) {
                       
            
            File::delete('assets/frontend/images/'. $post6->image);
        
        
        $imagename = 'logo.' . $image->getClientOriginalExtension();

        $imagemove = $image->move('assets/frontend/images/',  $imagename);
        
        $post6->image     = e($imagename);

        }
        // /Picture Upload

		
		

		// Was the blog post updated?
		if(
			$post1->save() and 
			$post2->save() and 
			$post3->save() and 
			$post4->save() and
		    $post5->save() and
		    $post6->save() and
		    $post7->save() and
		    $post8->save() 

			)
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Application Settings updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update Application Setting.");
	
	}
   
    
   
    
    
    
    
}
