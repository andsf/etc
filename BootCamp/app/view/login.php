<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- <link rel="stylesheet" type="text/css" href="app/public/css/login.css"> -->
</head>
<body>
  <div class="login-box">
    <div class="login-inner-box">
      <form method="post" action="/Auth/login">
      <?php if(isset($errMsg)): ?>
      <div><?= $errMsg ?></div>
      <?php endif; ?>
      <table>
        <tr>
          <th>メールアドレス</th>
          <th><input type="text" name="mailaddress"></th>
        </tr>
        <tr>
          <td>パスワード</td>
          <td><input type="password" name="password"></td>
        </tr>
      </table>
      <input type="submit" class="submit-btn">
      </form>
    </div>
  </div>
  </html>
</body>
