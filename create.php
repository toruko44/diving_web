  <?php 
  session_start();
  require('dbconnect.php');

  if(!empty($_POST)){
    if ($_POST['main-title'] == "") {
      $error['main-title'] = 0;
    }
    for ($i=0; $i < 4; $i++) { 
      if($_POST["title-$i"] == ""){
        $error["title-$i"] = 0;
      }
    }
    if (empty($error)) {
      $_SESSION['create'] = $_POST;
      for ($i=0; $i < 4; $i++) { 
        $image = date('YmdHis') . $_FILES["img-$i"]['name'];
        move_uploaded_file($_FILES["img-$i"]['tmp_name'], 'diving_picture/' .$image);
        $_SESSION['create']["img-$i"] = $image;
        if (!isset($_SESSION['create']["img-$i"])) {
          exit();
        }
      }
      header('Location: pre_show.php');
      exit();
    }else{
      $error["img"] = 0;
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="ja" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>展覧会の作成</title>
    <link rel="stylesheet" href="create.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    </head>
    <body>
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
        <div class="contents">
          <form class="" action="create.php" method="post" enctype="multipart/form-data">
            <input type="text" name="main-title" placeholder="展覧会のタイトル" value="<?php
              if (isset($_POST['main-title'])) {
                echo htmlspecialchars($_POST['main-title'], ENT_QUOTES);
              }?>">
            <?php 
            if (isset($error["main-title"])) {
              if ($error["main-title"] == 0) {
                echo "<p class=\"error\">* 展覧会の名前を記入してください</p>";
              }
            }
            ?>
            <?php 
              for ($i=0; $i < 4; $i++) { 
                echo "<div class=\"content\">";
                echo "<input type=\"text\" name=\"title-$i\" placeholder=\"写真のタイトル\" size=\"50px\"";
                echo "value=\"";
                if (isset($_POST["title-$i"])) {
                  echo htmlspecialchars($_POST["title-$i"], ENT_QUOTES);
                }
                echo "\"";
                echo ">";
                if (isset($error["title-$i"])) {
                  if ($error["title-$i"] == 0) {
                    echo "<p class=\"error\">* タイトルを記入してください</p>";
                  }
                }
                echo "<input type=\"file\" name=\"img-$i\" accept=\".png,.jpg,.jpeg\" /*required*/>";
                if (isset($error["img"])) {
                  if ($error["img"] == 0) {
                    echo "<p class=\"error\">* 申し訳ありませんが再度ファイルを選択してください</p>";
                  }
                }
                echo "<select name=\"season-$i\">";
                echo "<option value=\"spring\">春</option>";
                echo "<option value=\"summer\">夏</option>";
                echo "<option value=\"autumn\">秋</option>";
                echo "<option value=\"winter\">冬</option>";
                echo "<option value=\"question\">？</option>";
                echo "</select>";
                echo "<textarea  name=\"text-$i\" rows=\"1\" cols=\"40\" placeholder=\"展示した写真の生物の名前を書いてください\"";
                echo "value=\"";
                if (isset($_POST["text-$i"])) {
                  echo htmlspecialchars($_POST["text-$i"], ENT_QUOTES);
                }
                echo "\"";
                echo "></textarea>";
                echo "</div>";
            }
            ?>
            <input type="submit" value="展示する">
          </form>
        </div>
    </body>
  </html>