<?php
    
    //DBに接続
    $dsn = 'mysql:host=localhost;dbname=gwbbs;charset=utf8';
    $user = 'bbsuser01';
    $password = 'pass';
    
    try{
      $db = new PDO($dsn,$user,$password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch(PDOException $e){
    echo "エラー：" . $e->getMessage();
  }
?>

<HTML>
<HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <TITLE>入力フォーム</TITLE>
</HEAD>
<BODY>
  <h1>簡易掲示板</h1>
  <p><a href="index.php">TOPページへ戻る</a><p>
  
  <form action="write.php" method="post" name="b1">
    <p>タイトル</br><input type="text" name="title"></p>
    <p>内容</br><textarea name="body"></textarea></p>
    <p><input type="submit" value="登録" name="b1"></a></p>
  </form>

</BODY>
</HTML>
