<?php
//ファイル読み込み
require_once './model/cookie.php';

$cookie = new Cookie();

//ログイン情報確認
if (!$cookie->has('loginUser')) {
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <title>入力フォーム</title>
</head>
<body>
  <h1>簡易掲示板</h1>
  <p><a href="/index.php">TOPページへ戻る</a><p>
  <form action="/write.php" method="post" name="b1">
    <p>タイトル</br><input type="text" name="title"></p>
    <p>内容</br><textarea name="text"></textarea></p>
    <p><input type="submit" value="登録" name="b1"></a></p>
  </form>
</body>
</html>
