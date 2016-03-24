<?php
//ファイル読み込み
require_once './sql.php';
require_once './session.php';

//各ファイルのインスタンス作成
$sql = new Sql();
$session = new Session();

//loginフォームからデータ取得
$data = $_POST;

//フォーム入力がない場合はリダイレクト
if (empty($data)) {
	return header('Location: http://'.$_SERVER['HTTP_HOST'].'/bootcamp/phpBeginner/index.php');
}

//login確認（DBの値を参照）
$result = $sql->checkLogin($data['mailaddress'], $data['password']);

if (!empty($result)) {
	$addData = ['mailaddress' => $result[0]['mail_address'], 'name' => $result[0]['user_name']];
	$session->add($addData);
} else {
	return header('Location: http://'.$_SERVER['HTTP_HOST'].'/bootcamp/phpBeginner/login.php');
}

?>

<HTML>
<HEAD>
<script type="text/javascript">
<!--
		function check(){
		  if(window.confirm('本当にいいんですね？')){
			return true;
		  }else{
		    return false;
		  }
	    }
-->
</script>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
  <TITLE>掲示板</TITLE>

</HEAD>
<BODY>
<h1>簡易掲示板</h1>

<p><a href="bbs.php"><input type="submit" value="新規登録"></a></p>

<table class="table table-striped table-bordered table-condensed">
<table border="2" cellpadding="3">
	<thead style="background-color:#87cefa;">
<tr><th>タイトル</th><th>編集</th><th>削除</th><th>論理削除</th></tr>
</thead>

<?php
	$pdo = new PDO("mysql:dbname=gwbbs","bbsuser01","pass");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$stmt = $pdo->query("SELECT * FROM bbs WHERE flag = 0 ");
	while ($row = $stmt->fetch()){
	  $id =  $row['id'];
	  $title = htmlspecialchars($row['title']);
	  $body = htmlspecialchars($row['body']);
?>
	  <tr>
	  <td><?php echo $title ?></td>
	  <td><a href="bbs_update.php?id=<?php echo $id ?>">編集</a></td>
	  <td><a href='delete.php?id=<?php echo $id ?>' onClick='return check();'>削除</a></td>
	  <td><a href='deleteflg.php?id=<?php echo $id ?>'>論理削除</a></td>
	  </tr>
<?php
	}
?>
</table>
</BODY>
</HTML>
