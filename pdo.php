<?php
	//to connect to database
	//ps. check the port number in the xampp app the MySql one don't follow the lab guide one
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=project', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>