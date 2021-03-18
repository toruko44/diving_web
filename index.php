<?php
session_start();
require('dbconnect.php');
if (isset($_POST['userid'])) {
  $userid = $_POST['userid'];
}
$records = $db->query('SELECT maintitle FROM museums WHERE userid=0');
$record = $records->fetch();
?>
<!DOCTYPE html>
<html lang=ja>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>ダイビングWEBサービス</title>
  </head>
  <body>
    <div id="wrapper" >
      <header>
        <div class="header-logo">
          <h4>logo</h4>
          <ul>
            <li>ユーザID:<?echo "$userid"; ?></li>
            <li><a href="new_login.php">新規作成</a></li>
            <li><a href="login.php">ログイン</a></li>
            <li><a href="create.php">展覧会を開く</a></li>
            <li><i class="fas fa-search" id="open_nav"></i></li>
          </ul>
        </div>
      </header>
      <div class="contents">
        <div class="content">
        <div class="flex">
        <a href="#"><h4><?php echo "$record[0]"?></h4></a>
        </div>
        </div>
        <div class="content">
          <h3>今週のおすすめ</h3>
          <div class="flex">
        <a href="#"><h4><?php echo "$record[0]"?></h4></a>
        </div>
        </div>
        <div class="content">
          <h3>期待の新作</h3>
        </div>
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
