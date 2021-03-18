<?php
require('dbconnect.php');
session_start();

if (isset($_COOKIE['mail'])) {
  if ($_COOKIE['mail'] != '') {
    $_POST['mail'] = $_COOKIE['mail'];
    $mail = $_COOKIE['mail'];
    $_POST['pass'] = $_COOKIE['pass'];
    $pass = $_COOKIE['password'];
    $_POST['save'] = 'on';
    $userid = $db->query('SELECT userid FROM user WHERE mail=\"$mail\" pass=\"$pass\"');
    $_POST['userid'] = $userid;
    }
}
if (!empty($_POST)) {
	if ($_POST['mail'] != '' && $_POST['pass'] != '') {
		$login = $db->prepare('SELECT * FROM user WHERE email=? AND
			pass=?');
			$login->execute(array(
				$_POST['mail'],
				sha1($_POST['password'])
			));
			$member = $login->fetch();
			if ($member) {
				$_SESSION['id'] = $member['id'];
				$_SESSION['time'] = time();
				if ($_POST['save'] == 'on') {
				setcookie('mail', $_POST['mail'], time()+60*60*24*14);
				setcookie('pass', $_POST['pass'], time()+60*60*24*14);
				}

				header('Location: index.php'); exit();
			} else {
				$error['login'] = 'failed';
			}
		} else {
			$error['login'] = 'blank';
		}
	}
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
      <div id="wrapper">
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
        <div id="content">
          <div id="lead">
            <p>メールアドレスとパスワードを記入してログインしてください。</p>
            <p>入会手続きがまだの方はこちらからどうぞ。</p>
            <p>&raquo;<a href="new_login.php">新規作成を行う</a></p>
          </div>
          <form action="login.php" method="post">
            <dl>
              <dt>メールアドレス</dt>
              <dd>
                <input type="text" name="mail" size="35" maxlength="255" value="<?php
                if (isset($_POST['mail'])) {
                  echo htmlspecialchars($_POST['mail'], ENT_QUOTES); 
                }
                ?>"/>
                 <?php if (isset($error['login'])) {
                  if ($error['login'] == 'failed'){
                    echo "<p class=\"error\">* メールアドレスとパスワードをご記入ください</p>";
                  }
                } ?>
                  
                <?php if (isset($error['login'])) {
                  if ($error['login'] == 'failed'){
                    echo "<p class=\"error\">* ログインに失敗しました。正しくご記入ください。</p>";
                  }
                } ?>
              </dd>
              <dt>パスワード</dt>
              <dd>
                <input type="password" name="pass" size="35" maxlength="255" value="<?php
                if (isset($_POST['pass'])) {
                  echo htmlspecialchars($_POST['pass'], ENT_QUOTES); 
                }
                ?>"/>
              </dd>
              <dt>ログイン情報の記録</dt>
              <dd>
                <input id="save" type="checkbox" name="save" value="on">
                <label for="save">次回からは自動的にログインする</label>
              </dd>
            </dl>
            <div><input type="submit" value="ログインする"></div>
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