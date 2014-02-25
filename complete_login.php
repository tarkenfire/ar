<?php 
	
	/*
	* Michael Mancuso (tarkenfire@tarkenfire.com) http://tarkenfire.com
	*
	* Twitter login script.
	*/

	require ("serverscripts/twitteroauth.php");
	session_start();

	//Check for needed info from POST. If not found, return to login script.
	if (!empty($_GET['oauth_verifier']) && !empty($_GET['oauth_token']) && !empty($_GET['oauth_token_secret'])){
		//TODO: Key/Secret
		$oauthsession = new TwitterOAuth('', '', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
		$_SESSION['access_token'] = $access_token;
	}
	else{
		header('Location: login.php');
	}

?>