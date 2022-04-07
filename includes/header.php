<?php 
require 'includes/auth.php';
require 'includes/url.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TicTacToe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <link rel="stylesheet" href="/tictactoe/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    <header>
      <div>

          <h2>Tic-Tac-Toe</h2>

        <?php if(isLoggedIn()): ?>

          <div class="flex-header">

            <div>
              <button class = "flex-button" id="button-home">Home</button>
            </div>

            <div>
              <button class="flex-button" id="button-edit"> Edit Profile </button>
            </div>

            <div>
              <button class="flex-button" id="button-logout">Log Out</button>
            </div>

          </div>

        <?php else: ?>
          <?php redirect('/tictactoe/invalid.php'); ?>
        <?php endif; ?>
      </div>

      <br>
    </header>
    <script type="text/javascript">
    document.querySelector("#button-home").onclick = () => {
      location.href="/tictactoe/home.php";
    };

    document.querySelector("#button-logout").onclick = () => {
      location.href="/tictactoe/logout.php";
    };

    document.querySelector("#button-edit").onclick = () => {
      location.href="/tictactoe/editprofile.php";
    };
    </script>
