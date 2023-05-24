<?php 

class ViewOrdersController extends BaseController {

	/**
	 * User profile page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get the user information
		$user = Sentry::getUser();
                $user_id = $user->id;
                
                $entries = Orders::join("users","orders.user_id","=","users.id")->where("users.id", $user_id)->get(); 
       

		// Show the page
		return View::make('frontend/account/orders', compact('entries'));
                
                    
                
	}

	

}
