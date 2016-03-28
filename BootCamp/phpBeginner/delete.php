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

//削除対象のentryidを取得
$eid = $_GET['eid'];

$ret = $sql->delete($eid);

//判定
if ($ret) {
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
} else {
    //TODO エラー処理
}
