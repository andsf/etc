<?php
    try{
		$pdo = new PDO("mysql:dbname=gwbbs","bbsuser01","pass");
		$stmt = $pdo->prepare("UPDATE bbs SET title=?,body=? WHERE id=?");
		$stmt->execute(array($_POST['title'],$_POST['body'],$_POST['id']));
  } catch(PDOException $e){
    echo "エラー：" . $e->getMessage();
  }
//  var_dump($_POST['title'],$_POST['body'],$_POST['id']);


?>

<a href="index.php">TOP</a>
	