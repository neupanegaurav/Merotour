<?php

class LedgerTransactionController extends BaseController {
    
    public function getIndex() {
    	
        $entries_raw = GeneralVoucher::all();
        $user_list_raw = User::all();

        $userprovider = Sentry::getUserProvider();
    		$group = Sentry::getGroupProvider(); 
				$agent = $group->findById(3);
        $distributor = $group->findById(6);
        $branch_office = $group->findById(8);

	      if(Request::is(Session::get('account_type') . '/agent-ledger-transaction'))
		    {
		    	$type = 'Agent';
        		$name= 'Agent Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $agent)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($agent)) 
				        {
			            	return true;
			        	}
			   	});	
		    	
        		$entries = $entries_raw->filter(function($user) use($userprovider, $agent)
			    { 
			        $current_user = $userprovider->findById($user->user_id);

			        if ($current_user->inGroup($agent)) 
				        {
			            	return true;
			        	}
			   	});	

		   		/*$entryChunks = $entries->chunk(10);
					$correctChunk = $entryChunks(Input::get('page'));
					$entries = Paginator::make($correctChunk, count($entries_raw), 10);	*/	 

		    }

		    elseif(Request::is(Session::get('account_type') . '/b-o-ledger-transaction')) 
		    {
		    	$type = 'Branch Office';
        		$name= 'Branch Office Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $branch_office)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($branch_office)) 
				        {
			            	return true;
			        	}
			   	});

		        $entries = $entries_raw->filter(function($user) use($userprovider, $branch_office)
			    { 			    	
			        $current_user = $userprovider->findById($user->user_id);

			        if ($current_user->inGroup($branch_office)) 
				        {
			            	return true;
			        	}
			   	});	
		    }
		    
		    elseif(Request::is(Session::get('account_type') . '/db-ledger-transaction')) 
		    {
		    	$type = 'Distributor';
        		$name= 'Distributor Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $distributor)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($distributor)) 
				        {
			            	return true;
			        	}
			   	});

		        $entries = $entries_raw->filter(function($user) use($userprovider, $distributor)
			    { 
			        $current_user = $userprovider->findById($user->user_id);

			        if ($current_user->inGroup($distributor)) 
				        {
			            	return true;
			        	}
			   	});	
		    }

		     else 
		    {
		    	$type= 'User';
        		$name= 'Ledger Transaction Summary';
		    	$entries = GeneralVoucher::all();
		    	$user_list = $user_list_raw;
		    }
	        
        return View::make('backend.ledger_transaction.index', compact('type', 'name', 'user_list', 'entries'));
    
    }

    public function postIndex()
	{
		$user_list_raw = User::all();


        $userprovider = Sentry::getUserProvider();
    	$group = Sentry::getGroupProvider(); 
		$agent = $group->findById(3);
        $distributor = $group->findById(6);
        $branch_office = $group->findById(8);

	        if(Request::is(Session::get('account_type') . '/agent-ledger-transaction'))
		    {
		    	$type = 'Agent';
        		$name= 'Agent Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $agent)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($agent)) 
				        {
			            	return true;
			        	}
			   	});	
		    	
        			        
		    }

		    elseif(Request::is(Session::get('account_type') . '/b-o-ledger-transaction')) 
		    {
		    	$type = 'Branch Office';
        		$name= 'Branch Office Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $branch_office)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($branch_office)) 
				        {
			            	return true;
			        	}
			   	});

		      
		    }
		    
		    elseif(Request::is(Session::get('account_type') . '/db-ledger-transaction')) 
		    {
		    	$type = 'Distributor';
        		$name= 'Distributor Ledger Transaction';

        		$user_list = $user_list_raw->filter(function($user) use($userprovider, $distributor)
			    { 
			        $current_user = $userprovider->findById($user->id);

			        if ($current_user->inGroup($distributor)) 
				        {
			            	return true;
			        	}
			   	});

	       
		    }

		     else 
		    {
		    	$type= 'User';
        		$name= 'Ledger Transaction Summary';
		    	$user_list = $user_list_raw;
		    }


		$user_id = Input::get('user_id');
		$from = Input::get('from_date');
		$to = Input::get('to_date');
	

		$generalq = GeneralVoucher::query();

		if(!empty($user_id))
		{
			$generalq->where('user_id', $user_id);

		}
		if(!empty($from) and !empty($to))
		{
			$generalq->whereBetween('created_at', array($from, $to));
		}


		$entries = $generalq->orderBy('created_at', 'DESC')->paginate(10);


		// Show the page
		return View::make('backend.ledger_transaction.index', compact('type', 'name','user_list' ,'entries'));

	}
          
    public function getCreate()
	{
		// Show the page
		return View::make('backend.ledger_transaction.create');
	}
  
    public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'currency'   => 'required',
			'iso_code' => 'required',
			'symbol' => 'required',
			'exchange_rate' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new category
		$post = new LedgerTransaction;

		// Update the blog post data
		$post->currency            = e(Input::get('currency'));
		$post->iso_code     = e(Input::get('iso_code'));
		$post->symbol     = e(Input::get('symbol'));
		$post->exchange_rate     = e(Input::get('exchange_rate'));

		// Was the blog post created?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "LedgerTransaction has been created");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "LedgerTransaction coudn't be created");
	}
        
    public function getEdit($id)
	{
		if (is_null($entry = LedgerTransaction::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}

		// Show the page
		return View::make('backend.ledger_transaction.edit', compact('entry'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id)
	{
		// Declare the rules for the form validation
		$rules = array(
			'currency'   => 'required',
			'iso_code' => 'required',
			'symbol' => 'required',
			'exchange_rate' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
                
                if (is_null($post = LedgerTransaction::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected category.");
		}


		// Update the blog post data
		$post->currency            = e(Input::get('currency'));
		$post->iso_code     = e(Input::get('iso_code'));
		$post->symbol     = e(Input::get('symbol'));
		$post->exchange_rate     = e(Input::get('exchange_rate'));


		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "LedgerTransaction updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Couldn't update category.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = LedgerTransaction::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "LedgerTransaction deleted successfully");
	}
      
}
