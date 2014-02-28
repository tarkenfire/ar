<?php 

	/*
	* Michael Mancuso (tarkenfire@tarkenfire.com) http://tarkenfire.com
	*
	* Twitter login script, makes auth/login call, then call completion script.
	*/

	//import lib, start session
	require ("serverscripts/twitteroauth.php");
	session_start();
	
	//TODO: Add key secret.
	$oauthsession = new TwitterOAuth("yTVZYx9fp9pMfLK6sle5w", "wWjKMz7DUUy3scH3BJChlpdza0zQuJhLMWvKscKro");
	$request_token = $oauthsession->getRequestToken("http://www.tarkenfire.com/personal/AR/ar/complete_login.php"); //TODO: URL.
	
	//save token and secret to session
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	
	//handle response
	if($oauthsession->http_code == 200){
		$url = $oauthsession->getAuthorizeURL($request_token['oauth_token']);
		header('Location: '. $url);
	}
	else {
		//TODO: This is not an elegant way to handle the error.
		die("OHNOIDIED.");
	}


?>