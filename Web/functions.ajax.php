<?php
	session_start();
	include_once('functions.php');
	$function_name = $_POST['function_name'];

	switch ($function_name) {
		case "insert_delete_users_rewards":
			$id_user = $_POST['id_user'];
			$id_reward = $_POST['id_reward'];

			if(isset(sqlSelectIdRewardByIdUserIdReward($id_user, $id_reward)[0])){
				sqlDeleteUserRewardyIdUserIdReward($id_user, $id_reward);
				echo '{ "ReturnCode": "DELETED", "Message": "Data already added"}';
			} else {
				sqlInsertUserReward($id_user, $id_reward);
				echo '{ "ReturnCode": "ADDED", "Message": "Data added"}';
			}

			
			
			break;
		case "check_login":
			$user_name = $_POST['user_name'];
			$user_pwd = sha1($_POST['user_pwd']);

			$bdd_user = sqlSelectUserByUsername($user_name);

			if(isset($bdd_user[0])){
				$bdd_user = $bdd_user[0]['password'];

				if($bdd_user == $user_pwd){
					$_SESSION['id_user'] = sqlSelectUserByUsername($user_name)[0]['id_user'];
					echo '{ "ReturnCode": "OK", "Message": "Valid ID"}';
				}else{
					echo '{ "ReturnCode": "ERROR", "Message": "Non-valid password"}';
				}
			}else{
				echo '{ "ReturnCode": "ERROR", "Message": "Non-valid username"}';
			}

			break;
		case "logout":
			session_destroy();
			break;
		case "register":
			$user_name = $_POST['user_name'];
			$user_pwd = sha1($_POST['user_pwd']);
			$email = $_POST['email'];

			if(empty($user_name) || empty($user_pwd) || empty($email)){
				echo '{ "ReturnCode": "ERROR", "Message": "Fill all the fields"}';
			}else{
				$bdd_user = sqlSelectUserByUsername($user_name);

				if(!isset($bdd_user[0])){
					try{
						sqlInsertUser($user_name, $user_pwd, $email);
						echo '{ "ReturnCode": "OK", "Message": "Account Created"}';
					} catch (Exception $e){
						echo '{ "ReturnCode": "ERROR", "Message": "' . $e . '"}';
					}
				} else{
					echo '{ "ReturnCode": "ERROR", "Message": "Username already taken"}';
				}
			}
			break;
		}