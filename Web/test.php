<?php
	include_once('functions.php');
	
	$myPDO = bddPdo();
	$myPDO->query('INSERT INTO users_rewards VALUES (1, 1)');
