<?php
session_start();
require('dbconnect.php');
if (!empty($_POST)) {
  if ($_POST['username'] == '') {
  $error['username'] = 0;
}if ($_POST['mail'] == '') {
  $error['mail'] = 0;
}if ($_POST['pass'] == '') {
  $error['pass'] = 0;
}elseif (strlen($_POST['pass']) < 6) {
  $error['pass'] = 1;
}
if (empty($error)) {
  $member = $db->prepare('SELECT COUNT(*) AS cnt FROM user WHERE	mail=?');
  $member->execute(array($_POST['mail']));
  $record = $member->fetch();
  if ($record['cnt'] > 0) {
    $error['mail'] = 1;
  }
}
if (empty($error)) {
  $_SESSION['join'] = $_POST;
  header('Location: check.php');
	exit();
}
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
        <form class="" action="" method="post" enctype="multipart/form-data">
          <dl>
            <dt>ユーザー名<span class="required">必須</span></dt>
            <dd><input type="text" name="username" size="35" maxlength="255" value="<?php
            if (isset($_POST['username'])) {
              echo htmlspecialchars($_POST['username'], ENT_QUOTES);
            }?>">
            <?php
            if (isset($error['username'])) {
              if ($error['username'] == 0){
                echo "<p class=\"error\">* ユーザー名を入力してください</p>";
              }
            }
            ?>
            </dd>
            <dt>メールアドレス<span class="required">必須</span></dt>
            <dd><input type="text" name="mail" size="35" maxlength="255" value="<?php
            if (isset($_POST['mail'])) {
              echo htmlspecialchars($_POST['mail'], ENT_QUOTES);
            }?>">
            <?php
            if (isset($error['mail'])) {
              if ($error['mail'] == 0){
                echo "<p class=\"error\">* メールアドレスを入力してください</p>";
              }else if($error['mail'] == 1){
                echo "<p class=\"error\">* 指定されたメールアドレスはすでに登録されています</p>";
              }
            }
            ?>
            </dd>
            <dt>パスワード<span class="required">必須</span></dt>
            <dd><input type="password" name="pass" size="10" maxlength="20" value="<?php
            if (isset($_POST['pass'])) {
              echo htmlspecialchars($_POST['pass'], ENT_QUOTES);
            }?>">
            <?php
            if (isset($error['pass'])) {
              if ($error['pass'] == 0) {
                echo "<p class=\"error\">* パスワードを入力してください</p>";
              }elseif ($error['pass'] == 1) {
                echo "<p class=\"error\">* パスワードは6文字以上で入力してください</p>";
              }
            }
            ?>
            </dd>
          </dl>
          <div class="submit"><input type="submit" value="入力内容を確認する"></div>
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
