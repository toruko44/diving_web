<?php 
session_start();
require('dbconnect.php');

if (!isset($_SESSION['create'])) {
    header('Location: create.php');
    exit();
    }else{
    $maintitle = $_SESSION['create']['main-title'];
    for ($i=0; $i < 4; $i++) { 
      $title[$i] = $_SESSION['create']["title-$i"];
      $url[$i] = $_SESSION['create']["img-$i"] ;
      $season[$i] = $_SESSION['create']["season-$i"];
      $text[$i] = $_SESSION['create']["text-$i"];
    }
    unset($_SESSION['create']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="create.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>diving_web</title>
</head>
<body>
<div class="contents">
<h1><?php echo "$maintitle"?></h1>
    <?php
    for ($i=0; $i < 4; $i++) { 
        echo "<div class=\"content\">";
        echo "<h2>$title[$i]</h2>";
        echo "<h2>$season[$i]</h2>";
        if ($season[$i] == "spring") {
            echo "<p class=\"season\">春</p>";
        }elseif ($season[$i] == "summer") {
            echo "<p class=\"season\">夏</p>";
        }elseif ($season[$i] == "autumn") {
            echo "<p class=\"season\">秋</p>";
        }elseif ($season[$i] == "winter") {
            echo "<p class=\"season\">冬</p>";
        }else{
            echo "<p class=\"season\">？</p>"; 
        }
        echo "<img src=\"diving_picture/$url[$i]\" width=\"80%\" height=\"400\" alt=\"$text[$i]\">";
        echo "<p>$text[$i]</p>";
        echo "</div>";
    } 
    ?>
<form class="" action="pre_exhibition.php" method="post">
    <input type="hidden" name="main-title" value="<?php echo "$maintitle"?>">
    <?php 
    for ($i=0; $i <4; $i++) { 
        echo "<input type=\"hidden\" name=\"title-$i\" value=\"$title[$i]\">";
        echo "<input type=\"hidden\" name=\"url-$i\" value=\"$url[$i]\">";
        echo "<input type=\"hidden\" name=\"text-$i\" value=\"$text[$i]\">";
        echo "<input type=\"hidden\" name=\"season-$i\" value=\"$season[$i]\">";
    }
    ?>
    <input type="submit" value="これでOK">
</form>
</div>
</body>
</html>