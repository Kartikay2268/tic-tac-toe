<?php
class User
{

  private $id;
  private $name;
  private $score;
  private $username;
  private $password;
  private $activityTime;

  public static function authenticate($conn, $username, $password)
  {
    $sql = "SELECT id, username, password
            FROM users
            WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

    $stmt->execute();

    if($user = $stmt->fetch()){
        return password_verify($password, $user->password);
    }
  }

  public static function updateActivity($conn, $id, $time)
  {
    $sql = "UPDATE users
            SET activity = :activity
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':activity', $time, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

  }

  public static function getID($conn, $username)
  {
    $sql = "SELECT id
            FROM users
            WHERE username = :username";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username',$username, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    if($user = $stmt->fetch()){
      return $user->id;
    } else {
      return 0;
    }
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setID($id)
  {
    $this->id = $id;
  }


  public function updateScore($conn, $score)
  {
    $this->score = $score;

    $sql = "UPDATE users
            SET score = :score
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':score',$score,PDO::PARAM_INT);
    $stmt->bindValue('id',$this->id,PDO::PARAM_INT);
    $stmt->execute();
  }
  public function getScore($conn)
  {
    $sql = "SELECT score
            FROM users
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $this -> id, PDO::PARAM_STR);

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

    $stmt->execute();

    if($user = $stmt->fetch()){
      return $user->score;
    } else {
      return 0;
    }
  }

  public function getName($conn)
  {
    $sql = "SELECT name
            FROM users
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $this -> id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    if($user = $stmt->fetch()){
      return $user->name;
    } else {
      return "NaN";
    }

  }

  public function getUsername($conn)
  {
    $sql = "SELECT username
            FROM users
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $this -> id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    if($user = $stmt->fetch()){
      return $user->username;
    } else {
      return "NaN";
    }

  }

  public function updateUsername($conn, $username) {
    $this->username = $username;

    $sql = "UPDATE users
            SET username = :username
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username',$username,PDO::PARAM_STR);
    $stmt->bindValue('id',$this->id,PDO::PARAM_INT);
    $stmt->execute();
  }

  public function updateName($conn, $name) {
    $this->name = $name;

    $sql = "UPDATE users
            SET name = :name
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->bindValue('id',$this->id,PDO::PARAM_INT);
    $stmt->execute();
  }

  public function updatePassword($conn, $password) {
    $this->password = $password;

    $sql = "UPDATE users
            SET password = :password
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':password',$password,PDO::PARAM_STR);
    $stmt->bindValue('id',$this->id,PDO::PARAM_INT);
    $stmt->execute();
  }

}
