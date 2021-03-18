<?php 
session_start();
require('dbconnect.php');

if (!isset($_POST)) {
  header('Location: create.php');
  exit();
}else{
  /*$maintitle = $_POST['main-title'];
  for ($i=0; $i < 4; $i++) { 
    $title[$i] = $_POST["title-$i"];
    $url[$i] = $_POST["url-$i"] ;
    $season[$i] = $_POST["season-$i"];
    $text[$i] = $_POST["text-$i"];
  }*/
  $statement = $db->prepare('INSERT INTO museums SET maintitle=?,
  subtitle1=?, url1=?, season1=?, text1=?,
  subtitle2=?, url2=?, season2=?, text2=?,
  subtitle3=?, url3=?, season3=?, text3=?,
  subtitle4=?, url4=?, season4=?, text4=?,
  userid=?');
  $statement->execute(array(
    $_POST['main-title'],
    $_POST['title-0'],$_POST['url-0'],$_POST['season-0'],$_POST['text-0'],
    $_POST['title-1'],$_POST['url-1'],$_POST['season-1'],$_POST['text-1'],
    $_POST['title-2'],$_POST['url-2'],$_POST['season-2'],$_POST['text-2'],
    $_POST['title-3'],$_POST['url-3'],$_POST['season-3'],$_POST['text-3'],
    0
  ));
  header('Location:index.html');
  exit();
}
?>