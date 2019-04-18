<?php
require_once 'dao.php';
class userDao extends dao {
  function createUser($name, $username, $password) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (:name, :username, :password);");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

    $stmt->execute();
    return $conn->lastInsertId();
  }

  function getUser($username){
    $conn = $this->getConnection();

    $stmt = $conn->prepare("SELECT * FROM users where username = :username;");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}