<?php
  session_start();
  require 'classes/user.php';
  require 'classes/Database.php';

  $db = new Database();
  $conn = $db->getConn();

  $user = new User();
  $user->setID($_SESSION['id']);

 require 'includes/header.php'; ?>

<div class="flex-container">

  <div class="home-container">

    <h4 class="db-name">Hi, <?= $user->getName($conn); ?>!</h4>
    <div>
      <p>Play a new game </p>
      <button id="play-button">PLAY</button>
    </div> <br>
    <div>
      <p>Check the High Scores </p>
      <button id="scoreboard-button">SCOREBOARD</button>
    </div>

  </div>

  <div class="online">

    <p id="players-online">Players Online: </p>
    <table class="table table-light" id="table-status">
      <tr>
        <th>Name</th>
        <th>Status</th>
      </tr>
    </table>
  </div>

</div>

<br>
<br>
<script type="text/javascript">
document.querySelector("#scoreboard-button").onclick = () => {
  location.href="/tictactoe/scoreboard.php";
};

document.querySelector("#play-button").onclick = () => {
  location.href="/tictactoe/game.php";
};
</script>
<script src="js/online.js"></script>
<script src="js/activity.js"></script>

<?php require 'includes/footer.php'; ?>
