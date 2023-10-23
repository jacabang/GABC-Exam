<?php

	$dsn = 'mysql:host=localhost;dbname=gabc';

	$username = "root";
	$password = "";

	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		$error = "Database Error: ";
		$error .= $e->getMessage();
		include('view/error.php');
		exit();
	}