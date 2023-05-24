<?php

class NewsletterController extends BaseController {
    
    
    
    
    public function postSus() {
      
        
        // Declare the rules for the form validation
		$rules = array(
			'email' => 'email',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

    
    
        
        $post = new Newsletter;
        
        $post->email = e(Input::get('email'));
        
        if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("/")->with('success', "You have successfully signed up for our mailing list.");
		}

		// Redirect to the blog post create page
		return Redirect::to('/')->with('error', "Sorry, there was some error while trying to suscribe you to the mailing list");
        
       
        
        
        
       
    }
    
     public function getIndex() {
        
        $entries = Newsletter::paginate(11);
        
        return View::make('backend.newsletter.index', compact('entries'));
        
       
    }
    
  
        
        
    public function getEdit($id)
	{
		if (is_null($entry = Newsletter::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/pages')->with('error', "Couldn't find the selected page");
		}
                
              

		// Show the page
		return View::make('backend.newsletter.edit', compact('entry'));
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
			'email' => 'email',                
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = Newsletter::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/newsletter/edit/$id')->with('error', "Couldn't find the selected radio.");
		}
                
                

		// Update the blog post data
		$post->name        = e(Input::get('name'));
		$post->email     = e(Input::get('email'));

		// Was the blog post updated?
		if($post->save())
		{
                    
                   
                    
                    
			// Redirect to the new blog post page
			return Redirect::to("admin/newsletter/edit/$id")->with('success', "Subscription updated");
		}
                
                
                

		// Redirect to the blog post create page
		return Redirect::to('admin/newsletter/edit/$id')->with('error', "Couldn't update subscription.");
	
	}
        
         public function getNewsletter()
	{
		// Show the page
		return View::make('backend.newsletter.create');
	}
        
          public function postNewsletter()
	{
              
              // Declare the rules for the form validation
		$rules = array(
			'title'   => 'required',
			'body' => 'required',                
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                $list = Newsletter::all();
                
                foreach ($list as $user) {
      
                // Register the user
			

			// Data to be used on the email view
			$data = array(
				'user'          => $user,
				'body' => Input::get('body'),
			);

			// Send the activation code through email
			Mail::send('emails.newsletter', $data, function($m) use ($user)
			{       $m->from('support@travelnepalguide.com', 'Travel Nepal Guide');
				$m->to($user->email, $user->name);
				$m->subject('Welcome ' . $user->first_name);
			});
                
                              
                }
                
 
		// Redirect to the blog post create page
		return Redirect::to('admin/newsletter/send-newsletter')->with('success', "Email has been sent to everyone.");
	
	
		
	}
        
          public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Newsletter::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/newsletter')->with('error', "Couldn't delete newsletter subscription.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/newsletter')->with('success', "Newsletter subscription deleted successfully");
	}
   

        
    
   
    
    
    
}
