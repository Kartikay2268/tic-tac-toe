<?php
require 'includes/url.php';
session_start();
require 'register-model.php';
$name = "";
$username = "";
$password = "";
$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($name)){
        $errors[] = "Please enter a name";
        $name = "";
      }
      if (empty($username) || !filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid username";
        $username = "";
      }
      if (empty($password) || strlen($password) < 8) {
        $errors[] = "Password should have atleast 8 characters";
        $password = "";
      }

    if (empty($errors)){
        if (registerUser($name, $username, $password)) {
            unset($_SESSION['errors']);
            redirect('/tictactoe/home.php');
        } else {
            $errors[] = "Username already exist";
            $_SESSION['errors'] = $errors;
            redirect('/tictactoe/register-view.php');
            
        }
    } else {
        $_SESSION['errors'] = $errors;
        redirect('/tictactoe/register-view.php');
    }
}