<?php
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
header('Location: index.php');
exit();
}else{
$username = $_SEESION['join']['username'];
$mail = $_SEESION['join']['mail'];
}
if (!empty($_POST)) {
	$statement = $db->prepare('INSERT INTO user SET username=?, email=?,	pass=?, created=NOW()');
		echo $ret = $statement->execute(array(
			$_SESSION['join']['username'],
			$_SESSION['join']['email'],
			sha1($_SESSION['join']['password']),
		));
		unset($_SESSION['join']);
		header('Location: thanks.php');
		exit();
	}
 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="new_login.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>ダイビングWEBサービス</title>
  </head>
  <body>
    <div id="wrapper" >
      <header>
        <div class="header-logo">
          <h4>logo</h4>
          <ul>
            <li><a href="new_login.php">新規作成</a></li>
            <li><a href="login.php">ログイン</a></li>
            <li><a href="create.php">展覧会を開く</a></li>
            <li><i class="fas fa-search" id="open_nav"></i></li>
          </ul>
        </div>
      </header>
      <div class="register">
        <p>次のフォームに必要事項をご記入ください</p>
        <form class="" action="check.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="action" value="submit" />
          <dl>
            <dt>ユーザー名</dt>
            <dd><?php  if (isset($username)) {
              echo "$username";
            } ?></dd>
            <dt>メールアドレス</dt>
            <dd><?php  if (isset($mail)) {
              echo "$mail";
            } ?></dd>
            <dt>パスワード</dt>
            <dd>表示されません</dd>
          </dl>
          <div><a href="new_login.php?action=rewrite">書き直す</a></div>
          <div class="submit"><input type="submit" value="登録する"></div>
        </form>
      </div>
      <nav id="nav">
        <h3>検索一覧</h3>
        <form class="search" action="" method="get">
        <input id="sbox1" type="text" name="s" id="s" placeholder="キーワードを入力">
        <input id="sbtn1" type="submit" value="検索">
        </form>
      </nav>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
  </body>
</html>
