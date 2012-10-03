<?php

class Account_Controller extends Base_Controller {

	public function __construct() {
		parent::__construct();
		// check login status
		$this->filter('before', 'auth');
	}
	
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
		// login user to Facebook if not logged in
		if(!Facebook::get_user_id()) {
			return Redirect::to(Facebook::get_login_url());
		}
		else {
			$user = User::find(Auth::user()->id);
			// store Facebook uid if not stored in database
			if(empty($user->facebook_uid)) {
				$user->facebook_uid = Facebook::get_user_id();
				$user->save();
			}
			else {
				// match the user id from Facebook and from database
				if($user->facebook_uid != Facebook::get_user_id()) {
					// what to do here?
				}
			}
			$uft = UserFacebookToekn::where('user_id', '=', Auth::user()->id);
			// store Facebook token if not stored in database or if existing token is expired
			if( empty($uft) || strtotime($uft->expires_at) < time() ) {
				$uft->user_id = Auth::user()->id;
				$uft->access_token = Facebook::getAccessToken();
				$uft->expires_at = (time() + 60*60*24*30*2);
				$uft->save();
			}
			return Redirect::to('/account');
		}
	}
}
