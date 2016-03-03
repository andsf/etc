<HTML>
<HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <script type="text/javascript"></script>
  <TITLE>入力フォーム</TITLE>
</HEAD>
<BODY>
<?php

	$pdo = new PDO("mysql:dbname=gwbbs","bbsuser01","pass");
	$stmt = $pdo->prepare("SELECT * FROM bbs WHERE id=?");
    $stmt->execute(array($_GET['id']));
	$row = $stmt->fetch();
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars($row['body']);
    $id = $_GET['id'];
?>

<form action="bbs_update2.php" method="post">
  タイトル：<br>
  <input type="text" name="title" value="<?php echo $title ?>"><br>
  内容：<br>
  <input type="text" name="body" value="<?php echo $body ?>"><br>
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit">
</form>

</BODY>
</HTML>
