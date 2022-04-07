<?php
session_start();
require "classes/user.php";
require "classes/Database.php";
require "includes/header.php";
require "includes/url.php";

$name = '';
$email = '';
$password = '';
$errors = [];
$success_messages = [];

$db = new Database();
$conn = $db->getConn();

$user = new User();
$user->setID($_SESSION['id']);

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(!isLoggedIn()) {
    redirect('/tictactoe/invalid.php');
  }

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (empty($name) && empty($email) && empty($password)){
    $errors[] = "Please enter a value";
  }

  if(!empty($password)) {
    if (strlen($password) < 8) {
      $errors[] = "Password should have atleast 8 characters.";
    } else {
      $user->updatePassword($conn, password_hash($password, PASSWORD_DEFAULT));
      $password= "";
      $success_messages[] = "Password Updated Successfully.";
    }
  }

  if(!empty($name)) {
    $user->updateName($conn, $name);
    $name = "";
    $success_messages[] = "Name Updated Successfully.";
  }
  if(!empty($email)){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Please enter a valid email.";
    } else {
      $user->updateUsername($conn, $email);
      $email = "";
      $success_messages[] = "Username Updated Successfully.";
    }
  }
}

?>

<div class="profile-container">

  <?php if(!empty($errors)): ?>
    <?php foreach ($errors as $error):?>
    <ul>
      <li><?= $error ?></li>
    </ul>
    <?php endforeach; ?>
  <?php endif; ?>

<form class="update-form" method="post">
  <div class="flex-details">
    <input class="details" type="text" name="rname" value="<?php echo ($user->getName($conn)); ?>" readonly="readonly">
    <input class="details" type="text" name="name" placeholder="Enter new Name" value="<?= htmlspecialchars($name) ?>">
  </div>
  <br>
  <div class="flex-details">
    <input class="details" type="email" name="rusername" value="<?php echo ($user->getUsername($conn)); ?>" readonly="readonly">
    <input class="details" type="email" name="email" placeholder="Enter new Username" value="<?= htmlspecialchars($email) ?>">
  </div>
  <br>
  <div class="flex-details">
    <input class="details" type="password" name="rpassword" value="password" readonly="readonly">
    <input class="details" type="password" name="password" placeholder="Enter new Password" value="<?= htmlspecialchars($password) ?>">
  </div>
  <br>
  <button class="submit">Update</button>
  <br>

  <?php if(!empty($success_messages)): ?>
    <?php foreach ($success_messages as $success_message):?>
    <ul>
      <li><?= $success_message ?></li>
    </ul>
    <?php endforeach; ?>
  <?php endif; ?>

</form>

</div>
