<?php
	include_once('functions.php');
	
	$id_user = $_POST['id_user'];
	$id_reward = $_POST['id_reward'];
	
	$myPDO = bddPdo();
	$myPDO->query('INSERT INTO users_rewards VALUES (' . $id_user . ', ' . $id_reward . ')');
