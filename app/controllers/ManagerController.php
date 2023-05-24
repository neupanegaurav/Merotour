<?php

class ManagerController extends AuthorizedController {
    

	public function getIndex() {
            
            return View::make('backend.manager.index');
            
        }

}
