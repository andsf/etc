<?php
//ファイル読み込み
require_once './model/sql.php';
require_once './model/session.php';
require_once './model/cookie.php';

//各ファイルのインスタンス作成
$sql     = new Sql();
$session = new Session();
$cookie  = new Cookie();

//loginフォームからデータ取得
$data = $_POST;

//ログイン情報確認
if (!$cookie->has('loginUser') && empty($data)) {
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}

//ユーザー情報を取得
if (!$cookie->has('loginUser')) {
    //login確認（DBの値を参照）
    $userData = $sql->checkLogin($data['mailaddress'], $data['password']);

    //loginできなかったら、loginページにリダイレクト
    if (empty($userData)) {
        //TODO エラーメッセージ出力
    	return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
    }
    //loginできたら、sessionにログイン情報を保持させる
    $addData = [
        //TODO 'cookiekey'は乱数にしたい
        'cookiekey' => ['mail_address' => $userData['mail_address'], 'user_name' => $userData['user_name'], 'id' => $userData['id']]
    ];

    //セッションにデータをログイン情報を格納
	$session->add($addData);
    //クッキーにセッションキーを格納
    $cookie->setLoginCookie('cookiekey');
} else {
    //セッションからユーザー情報を取得
    $userData = $session->get($cookie->get('loginUser'));
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
<p><a href="bbs.php"><input type="button" value="新規登録"></a></p>
<table>
  <tr>
    <th>投稿日</th>
    <th>タイトル</th>
    <th>投稿者</th>
    <th>操作</th>
    <th>削除</th>
  </tr>
<?php foreach ($bbsData as $data): ?>
  <tr>
    <td><?= htmlspecialchars($data['created_at']) ?></td>
    <td><?= htmlspecialchars($data['user_name']) ?></td>
    <td><?= htmlspecialchars($data['title']) ?></td>
    <?php if ($data['id'] == $userData['id']): ?>
    <td><a href="bbs_update.php?id=<?= $data['id'] ?>">編集</a></td>
    <td><a href='delete.php?id=<?= $data['id'] ?>' onClick='return check();'>削除</a></td>
    <?php else: ?>
    <td><a href="#?id=<?= $data['id'] ?>">投稿閲覧</a></td>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
</table>
</body>
</html>
