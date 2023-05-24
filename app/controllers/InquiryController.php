<?php

class InquiryController extends BaseController {

	/**
	 * Contact us page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		return View::make('frontend/inquiry');
	}

	/**
	 * Contact us form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
                    'noofperson' => 'Min:1|Max:32',
                    'interested_in' => 'Max:32',
                    'name' => 'required|Min:3|Max:80',
                    'email' => 'required|email|Max:40',			
                    'address' => 'required|Max:32',          
                    'country' => 'required|Max:64',
                    'telephone' => 'Integer',
                    'description' => 'Max:120',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			return Redirect::route('inquiry')->withErrors($validator);
		}

		# TODO !
                
                // Create a new blog post
		$post = new Inquiry;

		// Update the blog post data
               
                $post->interested_in          = e(Input::get('interested_in'));
                 $post->no_of_person         = e(Input::get('noofperson'));
		$post->name            = e(Input::get('name'));		
		$post->email          = e(Input::get('email'));
                $post->address          = e(Input::get('address'));
                $post->country          = e(Input::get('country'));
                $post->telephone          = e(Input::get('telephone'));
                
		$post->description       = e(Input::get('description'));

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::to("inquiry")->with('message', "Your inquiry has been sent. Thank you!");
		}

		// Redirect to the blog post create page
		return Redirect::to('inquiry')->with('message', "Sorry, there was a problem sending the inquiry. Please try again.");
	
                
	}

}
