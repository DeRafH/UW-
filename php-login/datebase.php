<?php
	$server= 'localhost';
	$username= 'root';
	$password= '';
	$datebase= 'php_login_datebase';

	try{
		$conn= new PDO("mysql:host=$server;dbname=$datebase;",$username, $password);
	}catch(PDOException $e){
		die('Connection failed: '.$e->getMassage());
	}
?>