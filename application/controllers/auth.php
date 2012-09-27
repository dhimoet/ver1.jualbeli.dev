<?php

class Auth_Controller extends Base_Controller {

	public function action_register()
	{
		$view = View::make('templates.base_header');
		$view.= View::make('auth.register');
		$view.= View::make('templates.base_footer');
		
		return $view;
	}

	public function post_register()
	{
		
	}
}