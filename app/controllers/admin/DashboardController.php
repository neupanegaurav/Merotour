<?php namespace Controllers\Admin;

use AdminController;
use View;
use Post;
use Banners;

class DashboardController extends AdminController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	 protected $layout = 'backend.layouts.default';
    
    public function getIndex() {


    	//Grab all the banners

		$banners = Banners::all();

    	// Get all the blog posts
		$posts = Post::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate();
        
        
        $this->layout->content = View::make('backend.dashboard', compact('posts', 'banners'));
        
       
    }
    

}
