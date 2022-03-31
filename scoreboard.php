<?php
  session_start();
  require 'includes/header.php';
  require 'classes/Database.php';
  require 'classes/user.php';

  $db = new Database();
  $conn = $db->getConn();

  User::updateActivity($conn, $_SESSION['id'], time());

  $sql = "SELECT name, score
          FROM users";
  $stmt = $conn->prepare($sql);
  $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
  $stmt->execute();
  $scores = $stmt->fetchAll();
  arsort($scores, SORT_NUMERIC);
 ?>

  <table class="table table-light">
    <tr class="table-active">
      <th>Name</th>
      <th>Score</th>
    </tr>
    <?php foreach ($scores as $name => $score): ?>
      <tr>
        <td><?= $name; ?></td>
        <td><?= $score; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>


<?php require 'includes/footer.php' ?>
