<?php
  session_start();
  require 'classes/user.php';
  require 'classes/Database.php';
  require 'includes/auth.php';

  $db = new Database();
  $conn = $db->getConn();

  User::updateActivity($conn, $_SESSION['id'], time());

  $user = new User();
  $user->setID($_SESSION['id']);
  $score = $user->getScore($conn);
  $user->updateScore($conn, $score+1);
 ?>
