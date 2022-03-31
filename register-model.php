<?php
 require 'classes/Database.php';
  

function registerUser($name, $username, $password) {

    $db = new Database();
    $conn = $db->getConn();

    if (checkUsername($username, $conn)) {

        $sql = 'INSERT INTO users(name, username, password)
            VALUES (:name, :username, :password)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);

        if($stmt->execute()){
            $_SESSION['is_logged_in'] = true;
            $_SESSION['id'] = $conn->lastInsertId();
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }
    
  }

function checkUsername($username, $conn){
    $sql = 'SELECT id 
            FROM users
            WHERE username = :username';
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_UNIQUE, 'User');
    $stmt->execute();
    if($num = $stmt->fetch()) {
        return false;
    } else {
        return true;
    }
}