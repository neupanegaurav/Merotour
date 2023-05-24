<?php

class GlobalSettingsController extends BaseController {
    
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() {
        
        $global_settings = GlobalSettings::paginate(10);
        
        $this->layout->content = View::make('backend.dashboard', compact('global_settings'));
        
       
    }
    
   
    
    
    
    
}
