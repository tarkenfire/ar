<?php 
	
	/*
	* Michael Mancuso (tarkenfire@tarkenfire.com) http://tarkenfire.com
	*
	* Twitter login script.
	*/

	require ("serverscripts/twitteroauth.php");
	include 'serverscripts/DatabaseManager.php';
	session_start();
	
	$database = new DatabaseManager();
	
	//Check for needed info from POST. If not found, return to login script.
	if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
		//TODO: Key/Secret
		$oauthsession = new TwitterOAuth('yTVZYx9fp9pMfLK6sle5w', 'wWjKMz7DUUy3scH3BJChlpdza0zQuJhLMWvKscKro', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		$access_token = $oauthsession->getAccessToken($_GET['oauth_verifier']);
		$_SESSION['access_token'] = $access_token;
		
		$user_info = $oauthsession->get('account/verify_credentials');
		
		
		if (isset($user_info->error)){
			header('Location: login.php');
		}
		else{
			//TODO: These are unfiltered queries, they can be subject to SQL injection attacks. Fix it.
			//$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $user_info->id);
			//$result = mysql_fetch_array($query);
			
			$database->setQuery("SELECT * FROM users WHERE oauth_provider='twitter' AND oauth_uid = :uid");
			$database->bind(":uid", $user_info->id);
			
			$result = $database->resultSet();
			
			if(empty($result)){
				//$query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, avatar_url, oauth_token, oauth_secret) VALUES ('twitter', {$user_info->id}, '{$user_info->screen_name}', '{$user_info->profile_image_url}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");
				
				$database->setQuery("INSERT INTO users (oauth_provider, oauth_uid, username, avatar_url, oauth_token, oauth_secret) VALUES ('twitter', :uid. :username, :avatar, :oToken, :oSecret)");
				
				$database->bind(":uid", $user_info->id);
				$database->bind(":username", $user_info->screen_name);
				$database->bind(":avatar", $user_info->profile_image_url);
				$database->bind(":oToken", $access_token['oauth_token']);
				$database->bind(":oSecret", $access_token['oauth_token_secret']);
				
				$database->execute();
				
				$database->setQuery("SELECT * FROM users WHERE id = :lastid");
				$database->bind("lastId", $database->lastInsertId);
				
				$result = $database->resultSet();
				
				//$query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());
				//$result = mysql_fetch_array($query);
			} else {
				// Update the tokens
				$database->setQuery("UPDATE users SET oauth_token = :oToken, oauth_secret = :oSecret");
				
				$database->bind(":oToken", $access_token['oauth_token']);
				$database->bind(":oSecret", $access_token['oauth_token_secret']);
				
				$database->execute();
				
				//$query = mysql_query("UPDATE users SET oauth_token = '{$access_token['oauth_token']}', oauth_secret = '{$access_token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$user_info->id}");
			}
			
			$_SESSION['id'] = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['oauth_uid'] = $result['oauth_uid'];
			$_SESSION['avatar_url'] = $result['avatar_url'];
			$_SESSION['oauth_provider'] = $result['oauth_provider'];
			$_SESSION['oauth_token'] = $result['oauth_token'];
			$_SESSION['oauth_secret'] = $result['oauth_secret'];
			
			header('Location: index.php');
		}

	}
	else{
		header('Location: login.php');	
	}

?>