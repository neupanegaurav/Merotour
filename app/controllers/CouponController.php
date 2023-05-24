<?php

class CouponController extends BaseController {
    
    
    public function getIndex() {
        
         if ( Sentry::getUser()->hasAccess('admin') )
                {
        
        
        $coupons = Coupon::paginate(10);
        
        return View::make('backend.coupons.index', compact('coupons'));
        
          }

                else {

                    $message = "Sorry. You do not have permissions to view this page. Please contact the administrator for more information";

                    return View::make('backend.info', compact('message'));


                }
        
       
    }
          
    
    public function getCreate()
	{
        
         if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_edit')) )
                {
        

		// Show the page
		return View::make('backend.package_tours.create');
                
           
                }

                else {

                    $message = "Sorry. You do not have permissions to view this page. Please contact the administrator for more information";

                    return View::make('backend.info', compact('message'));


                }
                
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
                
                
                
                $post = new VehicleRental;
                
                $file = Input::file('uploaded_file');
                
                if( isset($file)) {
                
                
                $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();
    
                $filemove = $file->move('assets/img/uploads',  $filename);
                
                $post->photo     = e($filename);
                }
                else {
                    
                    $post->photo     = e("default.png");
                    
                }
                
                
                $popular = Input::get('popular');
                $featured = Input::get('featured');
                $special = Input::get('special');
                
                if($popular != 1) { $popular = 0; }
                if($featured != 1) { $featured = 0;}
                if($special != 1) {$special = 0;}
                

		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->description     = e(Input::get('description'));              
                $post->difficulty    = e(Input::get('difficulty'));
                $post->country     = e(Input::get('country'));
                $post->duration     = e(Input::get('duration'));
                $post->activities     = e(Input::get('activities'));
                $post->season     = e(Input::get('season'));
                $post->area     = e(Input::get('area'));
                $post->group_size     = e(Input::get('group_size'));
                $post->cost     = e(Input::get('cost'));
                $post->popular_package     = e($popular);
                $post->featured_package    = e($featured);
                $post->special_package   = e($special);
                $post->special_price   = e(Input::get('special_price'));
                
		

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/package_tours/create")->with('success', "Package has been created");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/package_tours/create')->with('error', "Package coudn't be created");
                
		

		
	}
        
        
    public function getEdit($id)
	{
        
         if ( Sentry::getUser()->hasAnyAccess(['admin', 'vehiclerentals_edit']) )
               {
        
		if (is_null($entry = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/categories')->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.package_tours.edit', compact('entry'));
                
            }

                else {

                    $message = "Sorry. You do not have permissions to view this page. Please contact the administrator for more information";

                    return View::make('backend.info', compact('message'));


                }
                
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
                        'uploaded_file' => 'image'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/package_tours/create')->with('error', "Couldn't find the selected category.");
		}
                
                $file = Input::file('uploaded_file');
                
                if( isset($file)) {
                
                
                $filename = time() . '-' . Str::random(20) . '.' . $file->getClientOriginalExtension();
    
                $filemove = $file->move('assets/img/uploads',  $filename);
                
                $post->photo     = e($filename);
                }
                
                $popular = Input::get('popular');
                $featured = Input::get('featured');
                $special = Input::get('special');
                
                if($popular != 1) { $popular = 0; }
                if($featured != 1) { $featured = 0;}
                if($special != 1) {$special = 0;}
                


		// Update the blog post data
		$post->name            = e(Input::get('name'));
		$post->description     = e(Input::get('description'));              
                $post->difficulty    = e(Input::get('difficulty'));
                $post->country     = e(Input::get('country'));
                $post->duration     = e(Input::get('duration'));
                $post->activities     = e(Input::get('activities'));
                $post->season     = e(Input::get('season'));
                $post->area     = e(Input::get('area'));
                $post->group_size     = e(Input::get('group_size'));
                $post->cost     = e(Input::get('cost'));
                $post->popular_package     = e($popular);
                $post->featured_package    = e($featured);
                $post->special_package   = e($special);
                $post->special_price   = e(Input::get('special_price'));
                
		

		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("admin/package_tours/edit/$id")->with('success', "Package updated");
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/package_tours/edit/$id')->with('error', "Couldn't update package.");
	
	}
   
    
    public function getDelete($id)
	{
        
         if ( Sentry::getUser()->hasAnyAccess(['admin', 'vehiclerentals_delete']) )
                {
		// Check if the blog post exists
		if (is_null($entry = VehicleRental::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/categories')->with('error', "Couldn't delete package.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/package_tours')->with('success', "Package deleted successfully");
                
                
                  }

                else {

                    $message = "Sorry. You do not have permissions to view this page. Please contact the administrator for more information";

                    return View::make('backend.info', compact('message'));


                }
	}
    
    
    
    
}
