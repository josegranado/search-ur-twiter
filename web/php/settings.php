<?php 
	function settings(){
		$settings = array(
		'oauth_access_token' => "433036766-3OY7WDdxhdAFSuhvYGw59RSBWXQ11a3EnL7Jmxjx",
		'oauth_access_token_secret' => "uUSlPZWdro3CMRqhPaGyp86iUVqEPbgUybVXzJQHxvSHE",
		'consumer_key' => "zDTz3l3z8FuqH2grUwOLDxSmA",
		'consumer_secret' => "lT1ZDHJUZMdSrJLbi03XQoWEOYpieCwmplnR1mLXGAAgYZMxWm"
		);
		return $settings;
	}

	function createGetField($username){
		$getfield = "?screen_name=".$username;
		return $getfield;
	}
	function createUrl(){
		$url = 'https://api.twitter.com/1.1/users/show.json';
		return $url;
	}
	function createRequestMethod(){
		$requestMethod = 'GET';
		return $requestMethod;
	}
?>