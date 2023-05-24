<?php

class AffiliateController extends AuthorizedController {
    

	public function getIndex() {
            
            return View::make('backend.affiliate.index');
            
        }

}
