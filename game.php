<?php
  session_start();
  //require 'includes/auth.php';

  //if(!isLoggedIn()){
    //die ("Acess Unauthourised!"); }x
  require 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TicTacToe</title>
    <link rel="stylesheet" href="/tictactoe/css/stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    
    <div class="header">
      <!-- <h3 style="text-align: center"><a href="home.php">Home</a></h3> -->
    </div>
    <div class="container">
      <h3>Your Score: </h3>
      <h3 id="score"></h3>
      <div class="game">
        <div id="block_0" class="block"></div>
        <div id="block_1" class="block"></div>
        <div id="block_2" class="block"></div>
        <div id="block_3" class="block"></div>
        <div id="block_4" class="block"></div>
        <div id="block_5" class="block"></div>
        <div id="block_6" class="block"></div>
        <div id="block_7" class="block"></div>
        <div id="block_8" class="block"></div>
      </div>
      <h3 id="winner"></h3>
      <button class = "button-newgame" onclick="new_game()"><h3>New Game<h3></button>
    </div>
    <script src="/tictactoe/js/game.js"></script>
    <script src="js/activity.js"></script>
  </body>
</html>
