<?php

class QuotationController extends BaseController {
    
  public function postNewsletter()
	{
              
              // Declare the rules for the form validation
		$rules = array(
			'title'   => 'required',
			'body' => 'required', 
                        'from' => 'required|email',
                        'to' => 'required|email'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                $title = Input::get('title');
                $from = Input::get('from');
                $to = Input::get('to');
                
                
			

			// Data to be used on the email view
			$data = array(		
				'body' => Input::get('body'),
			);

			// Send the activation code through email
			Mail::send('emails.newsletter', $data, function($m) use ($user)
			{       $m->from('support@travelnepalguide.com', 'Travel Nepal Guide');
				$m->to($user->email, $user->name);
				$m->subject('Welcome ' . $user->first_name);
			});
                
                              
                
                
 
		// Redirect to the blog post create page
		return Redirect::to('admin/newsletter/send-newsletter')->with('success', "Email has been sent to everyone.");
	
	
		
	}
    
    
    
}
