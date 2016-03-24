<?php
//ファイル読み込み
require_once './model/sql.php';
require_once './model/session.php';

//各ファイルのインスタンス作成
$sql = new Sql();
$session = new Session();

//loginフォームからデータ取得
$data = $_POST;

//フォーム入力がない場合はリダイレクト
if (empty($data)) {
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}

//login確認（DBの値を参照）
$result = $sql->checkLogin($data['mailaddress'], $data['password']);
if (!empty($result)) {
    //loginできたら、sessionにログイン情報を保持させる
	$addData = ['mailaddress' => $result[0]['mail_address'], 'name' => $result[0]['user_name']];
	$session->add($addData);
} else {
    //loginできなかったら、loginページにリダイレクト
    //TODO エラーメッセージ出力
	return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}

//掲示板データ取得
$bbsData = $sql->getBbsData();
?>

<html>
<head>
  <script type="text/javascript" src="./javascript/common.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <title>掲示板</title>
</head>
<body>
<h1>簡易掲示板</h1>
<p><a href="bbs.php"><input type="submit" value="新規登録"></a></p>
<table>
  <tr>
    <th>タイトル</th>
    <th>名前</th>
    <th>編集</th>
    <th>削除</th>
    <th>論理削除</th>
  </tr>
<?php foreach ($bbsData as $data): ?>
  <tr>
    <td><?= htmlspecialchars($data['title']) ?></td>
    <td><?= htmlspecialchars($data['user_name']) ?></td>
    <td><a href="bbs_update.php?id=<?= $data['id'] ?>">編集</a></td>
    <td><a href='delete.php?id=<?= $data['id'] ?>' onClick='return check();'>削除</a></td>
    <td><a href='deleteflg.php?id=<?= $data['id'] ?>'>論理削除</a></td>
  </tr>
<?php endforeach; ?>
</table>
</body>
</html>
