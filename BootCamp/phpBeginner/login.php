<?php
require_once './model/cookie.php';

$cookie = new Cookie();

//ログイン情報確認
if ($cookie->has('loginUser')) {
    //バリデーション対応
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
}
?>
 <html>
   <head>
   <title>login</title>
   </head>
   <body>
      <h1>login</h1>
      <form method="post" action="/index.php">
      <table>
        <tr>
          <td>メールアドレス</td>
          <th><input type="text" name="mailaddress"></th>
        </tr>
        <tr>
          <td>パスワード</td>
          <td><input type="password" name="password"></td>
        </tr>
      </table>
      <input type="submit" class="submit-btn">
      </form>
   </body>
 </html>
