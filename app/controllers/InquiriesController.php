<?php

class InquiriesController extends BaseController {
    
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() {
        
        $entries = Inquiry::paginate(10);
        
        $this->layout->content = View::make('backend.inquiries.index', compact('entries'));
        
       
    }
    
    public function markViewed($id) {
        
        if (is_null($entry = Inquiry::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/inquiries')->with('error', "Couldn't find inquiry.");
		}
        
        $entry->viewed = 1;
        
        if($entry->save())
		{
            
             return Redirect::to("admin/inquiries")->with('success', 'Marked as viewed.');
            
                }
           else{     
             return Redirect::to('admin/inquiries')->with('error', "Couldn't save inquiry.");
           }
                
        }
        
       
        
       
    
    
    
    public function show($id)
    {
        try {
            $entry = Inquiry::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return App::abort(404);

        }
        
        $this->layout->content = View::make("backend.inquiries.show", compact('entry'));
        
    }
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = Inquiry::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/inquiries')->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/inquiries')->with('success', "Post deleted successfuly");
	}
    
    
    
    
}
