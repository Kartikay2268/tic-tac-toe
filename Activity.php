<?php
session_start();
require 'classes/user.php';
require 'classes/Database.php';

$db = new Database();
$conn = $db->getConn();
var_dump(User::updateActivity($conn, $_SESSION['id'], time()));

function destroyActivity() {
  $db = new Database();
  $conn = $db->getConn();
  var_dump(User::updateActivity($conn, $_SESSION['id'], 0));
}
