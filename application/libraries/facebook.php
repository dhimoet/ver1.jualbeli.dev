<?php
require_once "application/libraries/facebook/facebook.php";

class Facebook {
	
	protected static $facebook = array();
    
    public static function initialize() 
    {
		static::$facebook = new Fb(array(
			'appId'  => FACEBOOK_APP_ID,
			'secret' => FACEBOOK_SECRET,
			'cookie' => true
		));
    }
	
	public static function get_user_id()
	{
		// Get User ID
		$user = static::$facebook->getUser();
		// Proceed knowing you have a logged in user who's authenticated.
		if ($user) {
			try {
				$user_profile = static::$facebook->api('/me');
			} 
			catch (FacebookApiException $e) {
				error_log($e);
				$user = 0;
			}
		}
		
		return $user;
	}
	
	public static function get_login_url()
	{
		// Specify permissions
		$params = array(
			'scope' => 'user_status,user_photos,publish_actions,publish_stream'
		);
		$loginUrl = static::$facebook->getLoginUrl($params);
		
		return $loginUrl;
	}
	
	public static function get_logout_url()
	{
		$logoutUrl = static::$facebook->getLogoutUrl();
		
		return $logoutUrl;
	}
	
	public static function getAccessToken()
	{
		$token = static::$facebook->getAccessToken();
		
		return $token;
	}
	
	public static function api($args)
	{
		$response = static::$facebook->api($args);
		//print_rf($response); die;
		return $response;
	}
}
