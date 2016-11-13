<?php
	session_start();
	include_once('functions.php');
	$function_name = $_POST['function_name'];

	switch ($function_name) {
		case "insert_users_rewards":
			$id_user = $_POST['id_user'];
			$id_reward = $_POST['id_reward'];

			$myPDO = bddPdo();
			$myPDO->query('INSERT INTO users_rewards VALUES (' . $id_user . ', ' . $id_reward . ')');
			break;
		case "check_login":
			$user_name = $_POST['user_name'];
			$user_pwd = $_POST['user_pwd'];

			//$_SESSION['id_user'] = sqlSelectPwdByUsername($user_name)['id_user'];
			//echo '{ "ReturnCode": "OK", "Message": "' . sqlSelectUserByUsername($user_name)['username'] . '"}';
			if(sqlSelectUserByUsername($user_name)['password'] == $user_pwd){
				$_SESSION['id_user'] = sqlSelectUserByUsername($user_name)['id_user'];
				echo '{ "ReturnCode": "OK", "Message": "Valid ID"}';
			}
			else{
				echo '{ "ReturnCode": "ERROR", "Message": "Non-Valid ID"}';
			}
			break;
		case "logout":
			session_destroy();
			break;
		}