<?php

	$id = $_GET['id'];
	
	if($id == ''){
		header('Location:index.php');
		exit();
	}
	
	$dsn = 'mysql:host=localhost;dbname=gwbbs;charset=utf8';
	$user = 'bbsuser01';
	$password = 'pass';
	
	try{
		$db = new PDO($dsn,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$stmt = $db->prepare(
		"UPDATE bbs SET flag = 1 WHERE id=:id"
		);
		
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->execute();
	}catch (PDOExeption $e){
		echo "error".$e->getMessage();
	}
	header('Location:index.php');
	exit();
	
	
	