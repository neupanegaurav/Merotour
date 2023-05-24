<?php

class LoginHistoryController extends BaseController {

	public function getIndex() {

		$entries = LoginHistory::orderBy('created_at', 'DESC')->paginate(50);
		return View::make('backend.login_history.index', compact('entries'));
		
	}
}