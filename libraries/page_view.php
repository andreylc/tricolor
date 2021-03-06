<?php

function load_page($db, $block1, $block2, $block3, $block4){
  if(!$db) {
  exit ("ERROR DB CONNECT");
  } else {
    if(file_exists("template/header.php") && file_exists("template/content.php") && file_exists("template/aside.php") && file_exists("template/footer.php")){
      include "template/".$block1.".php";
      include "template/".$block2.".php";
      include "template/".$block3.".php";
      include "template/".$block4.".php";
    } else {  
        exit("ERROR RENDER PAGE");
      };
   };
};

function load_feed($db){
  $query = "SELECT * FROM `posts` ORDER BY `post_date` DESC";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  do
    {
      include "template/feed.php";
   }
  while($row = mysqli_fetch_array($result));
  mysqli_close($db);
};

function load_post_body($db) {
  $query = "SELECT * FROM `posts` WHERE `id` = ".$_GET['id'];
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  if(file_exists("template/post_content.php")){
    require_once "template/post_content.php";
    mysqli_close($db);
  };
};

function load_single_page(){
  switch($_GET['page']){
        case 'instruction':
             include 'includes/instruction.php';
              break;
        case 'reciever': 
             include 'includes/reciever.php';
              break;
        case 'activation': 
             include 'includes/activation.php';
              break;
        case 'disqus': 
             include 'includes/disqus.php';
              break;
        case 'help': 
             include 'includes/help.php';
              break;
        case 'feedback': 
             include 'includes/feedback.php';
              break;
        case 'about': 
             include 'includes/about.php';
              break;                             
        default: include '/';
  };
};

function counter($db){
  if($_COOKIE['count'] != $_GET['id']) {
    setcookie('count', $_GET['id'], time() + 86400, '/');
    $query = "UPDATE `posts` SET `post_views` = `post_views` + 1 WHERE id=".$_GET['id'];
    $result = mysqli_query($db, $query);
  }
}