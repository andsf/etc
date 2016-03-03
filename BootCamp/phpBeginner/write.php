<?php
  //データの受け取り
  $title = $_POST['title'];
  $body = $_POST['body'];
  
  //必須項目チェック
  if($body == ''){
    header('Location:index.php');  //最初のページ.phpへ移動
    exit();  //終了
  }
  
  //DB接続
  $dsn = 'mysql:host=localhost;dbname=gwbbs;charset=utf8';
  $user = 'bbsuser01';
  $password = 'pass';
  
  
  
//例外処理
  try{
    $db = new PDO($dsn,$user,$password);  //PDO(PHPの拡張機能：抽象化レイヤを作って各DBに対応させる)
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    //プリペアドステートメントを作成（PDOインスタンスのメソッドを実行する）
    $stmt = $db->prepare("
      INSERT INTO bbs (title,body,date)
      VALUES (:title,:body,now())"
    );
    
    //パラメータを割り当て
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':body',$body,PDO::PARAM_STR);
    //クエリの実行
    $stmt->execute();
    
    
    header('Location:index.php');
    exit();
  } catch(PDOException $e){
    die('エラー：' . $e->getMessage());
  }
  