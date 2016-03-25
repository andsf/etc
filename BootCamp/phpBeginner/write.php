<?php
//ファイル読み込み
require_once './model/sql.php';
require_once './model/session.php';
require_once './model/cookie.php';

//インスタンス作成
$sql     = new Sql();
$cookie  = new Cookie();
$session = new Session();

//ゲットアクセスを禁止する
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!$cookie->has('loginUser')) {
        //バリデーション対応
        return header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
    }
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
}

//postデータを取得
$data = $_POST;

//ユーザーデータ取得
$userData = $session->get($cookie->get('loginUser'));
//テキストがあるか確認、ない場合はnullを入れる
$text = isset($date['text']) ? $data['text'] : null;
//insert文　実行
$ret = $sql->insert($userData['id'], $data['title'], $text);

//判定
if ($ret) {
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
} else {
    //TODO エラー処理
}
