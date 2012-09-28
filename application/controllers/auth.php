<?php

class Auth_Controller extends Base_Controller {

	public function action_register()
	{
		$validation = Validator::make(Input::all(), array(
			'username' 				=> 'required|unique:users,username',
			'password' 				=> 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6',
			'email' 				=> 'required|email|unique:users,email',
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
			// display registration form
			$view = View::make('templates.base_header');
			$view.= View::make('auth.register', $data);
			$view.= View::make('templates.base_footer');
			
			return $view;
		}
		else {
			// process registration form
			// store to users table
			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->email 	= Input::get('email');
			$user->save();
			// store to user_meta table
			$meta = new UserMeta();
			$meta->user_id = $user->id;
			$meta->save();
			
			return Redirect::home();
		}
	}
	
	public function action_login()
	{
		$validation = Validator::make(Input::all(), array(
			'username' => 'required',
			'password' => 'required',
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
			// display login form
			$view = View::make('templates.base_header');
			$view.= View::make('auth.login', $data);
			$view.= View::make('templates.base_footer');
			
			return $view;
		}
		else {
			$credentials = array(
				'username' => Input::get('username'), 
				'password' => Input::get('password')
			);
			// log user in
			if (Auth::attempt($credentials)) {
				 return Redirect::home();
			}
			else {
				return Redirect::to('/auth/login');
			}
		}
	}
	
	public function action_logout()
	{
		// log user out
		Auth::logout();
		
		return Redirect::home();
	}
}
