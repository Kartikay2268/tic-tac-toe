<?php
require 'classes/Database.php';
require 'includes/url.php';

session_start();

$db = new Database();
$conn = $db->getConn();

$name = '';
$username = '';
$password = '';
$errors = [];
$correctDetails = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name = trim($_POST['name']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  if(empty($name)){
    $errors[] = "Please enter a name";
    $correctDetails = false;
    $name = "";
  }
  if (empty($username) || !filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid username";
    $username = "";
    $correctDetails = false;
  }
  if (empty($password) || strlen($password) < 8) {
    $errors[] = "Password should have atleast 8 characters";
    $password = "";
    $correctDetails = false;
  }

  if($correctDetails) {

    $sql = 'INSERT INTO users (name, username, password)
            VALUES (:name, :username, :password)';

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);

    if($stmt->execute()){
      $_SESSION['is_logged_in'] = true;
      $_SESSION['id'] = $conn->lastInsertId();
      redirect('/tictactoe/home.php');
    }
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TicTacToe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/tictactoe/css/login.css">
  </head>
  <body>
    <div class="main">
  <?php if(!empty($errors)): ?>
    <?php foreach ($errors as $error):?>
      <ul>
        <li><?= $error ?></li>
      </ul>
    <?php endforeach; ?>
  <?php endif; ?>

      <p class="heading">Registration</p>
      <form class="form-signin" method="post">

          <input class="cred" type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($name)?>">
          <br>
          <input class="cred" type="email" name="username" placeholder="Email ID" value="<?= htmlspecialchars($username) ?>">
          <br>
          <input class="cred" type="password" name="password" placeholder="Password" value="<?= htmlspecialchars($password) ?>">
          <br>
        <button class="submit">Register</button>

      </form>
    </div>

  <?php require 'includes/footer.php'; ?>
