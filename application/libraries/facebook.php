<?php
require_once "application/libraries/facebook/facebook.php";

class Facebook {
    
    public static function initialize() 
    {
	$facebook = new Fb(array(
		'appId'  => FACEBOOK_APP_ID,
		'secret' => FACEBOOK_SECRET,
		'cookie' => true
	));
	// Get User ID
	$user = $facebook->getUser();
	if ($user) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		} 
		catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		}
	}
	
	return $facebook;
    }
    
    public static function login_status()
    {
	$facebook = self::initialize();
	// Get User ID
	$user = $facebook->getUser();
	if ($user) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		} 
		catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		}
	}
	
	return $user;
    }
    
    public static function get_login_url()
    {
	if (!self::login_status()) {
		$params = array(
			'scope' => 'email,publish_actions,publish_stream'
		);
		$loginUrl = $facebook->getLoginUrl($params);
	}
	
	return $loginUrl;
    }
    
    public static function get_logout_url()
    {
	    
    }
}
