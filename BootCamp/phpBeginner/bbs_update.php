<?php
//ファイル読み込み
require_once './model/sql.php';
require_once './model/session.php';
require_once './model/cookie.php';

//インスタンス作成
$sql     = new Sql();
$cookie  = new Cookie();
$session = new Session();

//ログイン情報確認
if (!$cookie->has('loginUser')) {
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}
$eid = $_GET['eid'];
$data = $sql->getBbsDataByEntryId($eid);

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <script type="text/javascript"></script>
  <title>入力フォーム</title>
</head>
<body>
<form action="write.php" method="post">
  <P>タイトル：</p><br>
  <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>"><br>
  <p>内容：</p><br>
  <textarea name="text"><?= htmlspecialchars($data['text']) ?></textarea>
  <input type="hidden" name="eid" value="<?= $eid ?>">
  <input type="submit">
</form>
</body>
</html>
