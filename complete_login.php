<?php 
	
	/*
	* Michael Mancuso (tarkenfire@tarkenfire.com) http://tarkenfire.com
	*
	* Twitter login script.
	*/

	//Check for needed info from POST. If not found, return to login script.
	if (!empty($_GET['oauth_verifier']) && !empty($_GET['oauth_token']) && !empty($_GET['oauth_token_secret'])){
		//TODO logic.
	}
	else{
		header('Location: login.php');
	}

?>