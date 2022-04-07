<?php
session_start();
require 'includes/url.php';
require 'classes/Database.php';
require 'classes/user.php';

$errors = [];
$username = "";
$password = "";

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
  redirect('/tictactoe/home.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $db = new Database();
  $conn = $db->getConn();

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (User::authenticate($conn, $username, $password)){

      session_regenerate_id(true);

      $_SESSION['is_logged_in'] = true;
      $_SESSION['id'] = User::getID($conn,$username);

      redirect('/tictactoe/home.php');
  } else {
    $errors = ['Incorrect Login Details, please try again!'];
  }
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TicTacToe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <link rel="stylesheet" href="/tictactoe/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    <main>

      <?php foreach ($errors as $error): ?>
        <p><?= $error; ?></p>
      <?php endforeach; ?>

      <div class="main">
        <p class="heading">TicTacToe Game</p>

        <form class="form-signin" method="post">

          <input class="cred" type="email" name="username" placeholder="Username">
          <br>
          <input class="cred" type="password" name="password" placeholder="Password">
          <br>
          <button class="submit" align="center">Login</button>
          <br>
          <br>
        </form>
        <div class="newregister">
          <button class="submit" align="center" id="registerButton">Register</button>
        </div>
      </div>

      <script type="text/javascript">
        document.querySelector("#registerButton").onclick = () => {
          location.href="register.php";
        };
      </script>

<?php require 'includes/footer.php'; ?>
