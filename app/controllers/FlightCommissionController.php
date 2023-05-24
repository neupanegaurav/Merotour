<?php

class FlightCommissionController extends BaseController 
{
    
    
    public function getIndex() {     
        $agent_buddha	= AgentFCDomesticBuddha::all();
        $agent_yeti 	= AgentFCDomesticYeti::all();
        $agent_tara 	= AgentFCDomesticTara::all();
        $agent_simrik 	= AgentFCDomesticSimrik::all();

        $distributor_buddha	= DistributorFCDomesticBuddha::all();
        $distributor_yeti 	= DistributorFCDomesticYeti::all();
        $distributor_tara 	= DistributorFCDomesticTara::all();
        $distributor_simrik = DistributorFCDomesticSimrik::all();
        

        return View::make('backend.commission.domestic', 
        	compact('agent_buddha', 'agent_yeti', 'agent_tara', 'agent_simrik', 'distributor_buddha', 'distributor_yeti', 'distributor_tara', 'distributor_simrik'));            
    }
          
        
    public function getEdit($id)
	{
		if (is_null($entry = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
		}

		// Show the page
		return View::make('backend.dealsetup.airline.edit', compact('entry'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit()
	{
		// Declare the rules for the form validation
		$rules = array(
			'agent_buddha_bdp_y'  		=> 'integer',

		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$buddha = array(
			'1' => 'bdp',
			'2' => 'bhr',
			'3' => 'bir',
			'4' => 'dhi',
			'5' => 'jkr',
			'6' => 'kep',
			'7' => 'pkr',
			'8' => 'sif',
			'9' => 'bwa',
			'10' => 'tmi',
			'11' => 'bir_tmi',
			'12' => 'mtn',
			);

		$yeti = array(
			'1' => 'ktm_mtn',
			'2' => 'ktm_pkr',
			'3' => 'ktm_bwa',
			'4' => 'ktm_bir',
			'5' => 'ktm_bdp',
			'6' => 'ktm_bhr',
			'7' => 'bhr_ktm',
			'8' => 'ktm_jkr',
			'9' => 'jkr_ktm',
			'10' => 'ktm_kep',
			'11' => 'ktm_dhi',
			'12' => 'dhi_ktm',
			'13' => 'ktm_tmi',
			'14' => 'tmi_ktm',
			);

		$tara = array(
			'1' => 'nepalgunj_simikot',
			'2' => 'nepalgunj_dolpa',
			'3' => 'nepalgunj_jumla',
			'4' => 'nepalgunj_rara',
			'5' => 'nepalgunj_bajura',
			'6' => 'surkhet_simikot',
			'7' => 'surkhet_dolpa',
			'8' => 'surkhet_jumla',
			'9' => 'surkhet_rara',
			'10' => 'surkhet_bajura',
			'11' => 'kathmandu_lukla',
			'12' => 'kathmandu_phaplu',
			'13' => 'kathmandu_rumjhatar',
			'14' => 'kathmandu_lamidanda',
			'15' => 'kathmandu_khanidada',
			'16' => 'kathmandu_ramechhap',
			'17' => 'kathmandu_kangel',
			'18' => 'kathmandu_bhojpur',
			'19' => 'kathmandu_taplejung',
			'20' => 'pkr_ngx',
			'21' => 'pkr_jom',
			);

		$simrik = array(
			'1' => 'ktm_mtn',
			'2' => 'ktm_pkr',
			'3' => 'pkr_ktm',
			'4' => 'ktm_bwa',
			'5' => 'bwa_ktm',
			'6' => 'ktm_sif',
			'7' => 'sif_ktm',
			'8' => 'ktm_lua',
			'9' => 'lua_ktm'
			);

		foreach ($buddha as $key => $val) {

			if (is_null($post = AgentFCDomesticBuddha::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->y  		= e(Input::get('agent_buddha_'.$val.'_y'));
				
				//return $post->y;

				$post->a  		= e(Input::get('agent_buddha_'.$val.'_a'));
				$post->b  		= e(Input::get('agent_buddha_'.$val.'_b'));
				$post->d  		= e(Input::get('agent_buddha_'.$val.'_d'));
				$post->c  		= e(Input::get('agent_buddha_'.$val.'_c'));
				$post->e  		= e(Input::get('agent_buddha_'.$val.'_e'));
				
				$post->save();

		}
		foreach ($yeti as $key => $val) {
			if (is_null($post = AgentFCDomesticYeti::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->n  		= e(Input::get('agent_yeti_'.$val.'_n'));
				$post->n_usd  	= e(Input::get('agent_yeti_'.$val.'_n_usd'));
				$post->y  		= e(Input::get('agent_yeti_'.$val.'_y'));
				$post->g  		= e(Input::get('agent_yeti_'.$val.'_g'));
				$post->f  		= e(Input::get('agent_yeti_'.$val.'_f'));
				$post->s  		= e(Input::get('agent_yeti_'.$val.'_s'));
				$post->h  		= e(Input::get('agent_yeti_'.$val.'_h'));
				$post->e  		= e(Input::get('agent_yeti_'.$val.'_e'));
				$post->o  		= e(Input::get('agent_yeti_'.$val.'_o'));
				$post->v  		= e(Input::get('agent_yeti_'.$val.'_v'));
				
				$post->save();

		}    
		foreach ($tara as $key => $val) {
				
			if (is_null($post = AgentFCDomesticTara::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->npr 		= e(Input::get('agent_tara_'.$val.'_npr'));
				$post->usd  	= e(Input::get('agent_tara_'.$val.'_usd'));
				$post->inr  	= e(Input::get('agent_tara_'.$val.'_inr'));
			
				$post->save();

		}
		foreach ($simrik as $key => $val) {
			if (is_null($post = AgentFCDomesticSimrik::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->y  		= e(Input::get('agent_simrik_'.$val.'_y'));
				$post->y_usd  	= e(Input::get('agent_simrik_'.$val.'_y_usd'));
				$post->a  		= e(Input::get('agent_simrik_'.$val.'_a'));
				$post->b  		= e(Input::get('agent_simrik_'.$val.'_b'));
				$post->c  		= e(Input::get('agent_simrik_'.$val.'_c'));
				$post->d  		= e(Input::get('agent_simrik_'.$val.'_d'));
				$post->e  		= e(Input::get('agent_simrik_'.$val.'_e'));
				
				$post->save();
		}  

		foreach ($buddha as $key => $val) {

			if (is_null($post = DistributorFCDomesticBuddha::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->y  		= e(Input::get('distributor_buddha_'.$val.'_y'));
				$post->a  		= e(Input::get('distributor_buddha_'.$val.'_a'));
				$post->b  		= e(Input::get('distributor_buddha_'.$val.'_b'));
				$post->d  		= e(Input::get('distributor_buddha_'.$val.'_d'));
				$post->c  		= e(Input::get('distributor_buddha_'.$val.'_c'));
				$post->e  		= e(Input::get('distributor_buddha_'.$val.'_e'));
				
				$post->save();

		}
		foreach ($yeti as $key => $val) {
			if (is_null($post = DistributorFCDomesticYeti::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->n  		= e(Input::get('distributor_yeti_'.$val.'_n'));
				$post->n_usd  	= e(Input::get('distributor_yeti_'.$val.'_n_usd'));
				$post->y  		= e(Input::get('distributor_yeti_'.$val.'_y'));
				$post->g  		= e(Input::get('distributor_yeti_'.$val.'_g'));
				$post->f  		= e(Input::get('distributor_yeti_'.$val.'_f'));
				$post->s  		= e(Input::get('distributor_yeti_'.$val.'_s'));
				$post->h  		= e(Input::get('distributor_yeti_'.$val.'_h'));
				$post->e  		= e(Input::get('distributor_yeti_'.$val.'_e'));
				$post->o  		= e(Input::get('distributor_yeti_'.$val.'_o'));
				$post->v  		= e(Input::get('distributor_yeti_'.$val.'_v'));
				
				$post->save();

		}    
		foreach ($tara as $key => $val) {
				
			if (is_null($post = DistributorFCDomesticTara::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->npr 		= e(Input::get('distributor_tara_'.$val.'_npr'));
				$post->usd  	= e(Input::get('distributor_tara_'.$val.'_usd'));
				$post->inr  	= e(Input::get('distributor_tara_'.$val.'_inr'));
			
				$post->save();

		}
		foreach ($simrik as $key => $val) {
			if (is_null($post = DistributorFCDomesticSimrik::find($key)))
			{
				// Redirect to the blogs management page
				return Redirect::back()->with('error', "Couldn't find the selected Deal Setup.");
			}

				// Update the blog post data
				$post->y  		= e(Input::get('distributor_simrik_'.$val.'_y'));
				$post->y_usd  	= e(Input::get('distributor_simrik_'.$val.'_y_usd'));
				$post->a  		= e(Input::get('distributor_simrik_'.$val.'_a'));
				$post->b  		= e(Input::get('distributor_simrik_'.$val.'_b'));
				$post->c  		= e(Input::get('distributor_simrik_'.$val.'_c'));
				$post->d  		= e(Input::get('distributor_simrik_'.$val.'_d'));
				$post->e  		= e(Input::get('distributor_simrik_'.$val.'_e'));
				
				$post->save();
		} 
		
		// Was the blog post updated?
		if($post->save())
		{
			// Redirect to the new blog post page
			return Redirect::back()->with('success', "Flight Commission updated");
		}

		// Redirect to the blog post create page
		return Redirect::back()->with('error', "Flight Commission could not be updated.");
	
	}
   
    
    public function getDelete($id)
	{
		// Check if the blog post exists
		if (is_null($entry = DealSetupAirline::find($id)))
		{
			// Redirect to the blogs management page
			return Redirect::back()->with('error', "Couldn't delete post.");
		}

		// Delete the blog post
		$entry->delete();

		// Redirect to the blog posts management page
		return Redirect::back()->with('success', "Deal Setup deleted successfully");
	}    
    
}
