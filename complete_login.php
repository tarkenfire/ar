<?php 
	
	/*
	* Michael Mancuso (tarkenfire@tarkenfire.com) http://tarkenfire.com
	*
	* Twitter login script.
	*/

	require ("serverscripts/twitteroauth.php");
	session_start();

	
	
	//Check for needed info from POST. If not found, return to login script.
	if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
		//TODO: Key/Secret
		$oauthsession = new TwitterOAuth('yTVZYx9fp9pMfLK6sle5w', 'wWjKMz7DUUy3scH3BJChlpdza0zQuJhLMWvKscKro', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		$access_token = $oauthsession->getAccessToken($_GET['oauth_verifier']);
		$_SESSION['access_token'] = $access_token;
		
		//test to see if all is well.
		$user_info = $oauthsession->get('account/verify_credentials');
		print_r($user_info);
	}
	else{
		header('Location: login.php');

		
	}

?>