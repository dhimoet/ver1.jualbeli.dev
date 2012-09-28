<?php

class Account_Controller extends Base_Controller {

	public function action_index()
	{
		return $this->action_profile();
	}
	
	public function action_profile()
	{
		$user = User::find(Auth::user()->id);
		$meta = UserMeta::where('user_id', '=', Auth::user()->id)->first();
		// Facebook library must be initialize first every time
		Facebook::initialize();
		$fb = Facebook::api('/100004311189329');
		
		$data = array(
			'user' 	=> $user,
			'meta' 	=> $meta,
			'fb'	=> $fb,
		);
		// display profile
		$view = View::make('templates.base_header');
		$view.= View::make('account.profile', $data);
		$view.= View::make('templates.base_footer');
		
		return $view;
	}
	
	public function action_edit_account()
	{
		$validation = Validator::make(Input::all(), array(
			'username'	=> 'required|unique:users,username,' . Auth::user()->id,
			'email'		=> 'required|email|unique:users,email,' . Auth::user()->id,
		));
		// check validation
		if ($validation->fails()) {
			// set error messages
			if(!empty($validation->attributes)) {
				$data = $validation->errors->messages;
			}
			else {
				$data = array();
			}
			$user = User::find(Auth::user()->id);
			$data['user'] = $user;
			// display account edit form
			$view = View::make('templates.base_header');
			$view.= View::make('account.edit_account', $data);
			$view.= View::make('templates.base_footer');
			
			return $view;
		}
		else {
			// process registration form
			// store to users table
			$user = User::find(Auth::user()->id);
			$user->username = Input::get('username');
			$user->email 	= Input::get('email');
			$user->save();
			
			return Redirect::to('/account');
		}	
	}
	
	public function action_edit_profile()
	{
		$validation = Validator::make(Input::all(), array(
			'display_name'	=> 'required',
		));
		// check validation
		if ($validation->fails()) {
			// set error messages
			if(!empty($validation->attributes)) {
				$data = $validation->errors->messages;
			}
			else {
				$data = array();
			}
			$meta = UserMeta::where('user_id', '=', Auth::user()->id)->first();
			$data['meta'] = $meta;
			// display account edit form
			$view = View::make('templates.base_header');
			$view.= View::make('account.edit_profile', $data);
			$view.= View::make('templates.base_footer');
			
			return $view;
		}
		else {
			// process registration form
			// store to users table
			$meta = UserMeta::where('user_id', '=', Auth::user()->id)->first();
			$meta->display_name = Input::get('display_name');
			$meta->save();
			
			return Redirect::to('/account');
		}
	}
	
	public function action_facebook_connect()
	{
		// Facebook library must be initialize first every time
		Facebook::initialize();
		if(!Facebook::get_user_id()) {
			return Redirect::to(Facebook::get_login_url());
		}
		else {
			// Store Facebook uid if not stored in database
			$user = User::find(Auth::user()->id);
			if(empty($user->facebook_uid)) {
				$user->facebook_uid = Facebook::get_user_id();
				$user->save();
			}
			else {
				// Match the user id from Facebook and from database
				if($user->facebook_uid != Facebook::get_user_id()) {
					// What to do here?
				}
			}
			return Redirect::to('/account');
		}
	}
}
