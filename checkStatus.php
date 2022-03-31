<?php
session_start();
require 'classes/user.php';
require 'classes/Database.php';

$status = [];


$db = new Database();
$conn = $db->getConn();

$user = new User();
$user->setID($_SESSION['id']);
$name = $user->getName($conn);

$sql = "SELECT name, activity
        FROM users";

$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
$stmt->execute();

$times = $stmt->fetchAll();

unset($times[$name]);
//$times["Name"] = "Status";

foreach ($times as $name => $time) {
  if((time() - $time) < 480){
    $status[$name] = "Online";
  } else {
    $status[$name] = "Offline";
  }
}
echo json_encode($status);
