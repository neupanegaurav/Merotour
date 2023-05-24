<?php

class FundsController extends BaseController {
    
    
    protected $layout = 'backend.layouts.default';
    

    
    public function addFunds() {
        
        
        // Declare the rules for the form validation
		$rules = array(
			'amount'   => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        
            $user = Sentry::getUser();
                            
            $id = $user->id;
                
         
            
              if (is_null($post =  Funds::where('user_id', $id)->first()))
		{
			// Redirect to the blogs management page
			return Redirect::to('agent/add-funds')->with('error', "Couldn't find the user balance.");
		}


                $currentbal = $post->balance;
                
		// Update data
		$post->balance         = e( ($currentbal + Input::get('amount')));

		// Was the blog post updated?
		if($post->save())
		{
                    
                    $post_tr = new Transaction;
                    
                    $post_tr->transaction_type = "add_funds";
                    $post_tr->message = "Funds added";
                    $post_tr->amount = Input::get('amount');
                    $post_tr->user_id = $id;
                    
                    
                    if($post_tr->save()) {
                        
                        // Redirect to the new blog post page
			return Redirect::to("agent/add-funds")->with('success', "Funds added");
                        
                        
                    }
                                           
                        
		}

		// Redirect to the blog post create page
		return Redirect::to('agent/add-funds')->with('error', "Couldn't add funds.");

        
        
       
    }
    
      public function withdrawFunds() {
        
        
        // Declare the rules for the form validation
		$rules = array(
			'amount'   => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
        
            $user = Sentry::getUser();
                            
            $id = $user->id;
                
         
            
              if (is_null($post =  Funds::where('user_id', $id)->first()))
		{
			// Redirect to the blogs management page
			return Redirect::to('agent/withdraw-funds')->with('error', "Couldn't find the user balance.");
		}


                $currentbal = $post->balance;
                
		// Update data
		$post->balance         = e( ($currentbal - Input::get('amount')));

		// Was the blog post updated?
		if($post->save())
		{
                    
                    $post_tr = new Transaction;
                    
                    $post_tr->transaction_type = "withdraw_funds";
                    $post_tr->message = "Funds withdrawn";
                    $post_tr->amount = Input::get('amount');
                    $post_tr->user_id = $id;
                    
                    
                    if($post_tr->save()) {
                        
                        // Redirect to the new blog post page
			return Redirect::to("agent/withdraw-funds")->with('success', "Funds withdrawn");
                        
                        
                    }
                                           
                        
		}

		// Redirect to the blog post create page
		return Redirect::to('agent/withdraw-funds')->with('error', "Couldn't withdraw funds.");

        
        
       
    }
    

    
    
    
}
