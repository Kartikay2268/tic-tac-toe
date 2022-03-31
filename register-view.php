<?php 
    session_start(); 
    $errors = [];
    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors;']);
    }
    $name = "";
    $password = "";
    $username = "";
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
    <form class="form-signin" method="post" action="/tictactoe/register-controller.php">

        <input class="cred" type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($name)?>">
        <br>
        <input class="cred" type="email" name="username" placeholder="Email ID" value="<?= htmlspecialchars($username) ?>">
        <br>
        <input class="cred" type="password" name="password" placeholder="Password" value="<?= htmlspecialchars($password) ?>">
        <br>
        <button class="submit">Register</button>

    </form>
</div>
</html>