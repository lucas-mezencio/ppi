<?php

class RequestResponse {
  public $success;
  public $destination;

  function __construct($success, $destination) {
    $this->success = $success;
    $this->destination = $destination;
  }
}

function login($pdo, $email, $password) {
  $sql = <<<SQL
  select password from user_login
  where email = ?
SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if(!$row) {
      return false;
    }
    return password_verify($password, $row['password']);
  } catch (Exception $e) {
    exit ('Erro: ' . $e->getMessage());
  }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require "../db-connection.php";
  $pdo = mysqlConnect();

  $loginEmail = $_POST["email"] ?? "";
  $loginPassword = $_POST["password"] ?? "";

  if (login($pdo, $loginEmail, $loginPassword)) {
    $response = new RequestResponse(true, 'userHome.html');
  } else {
    $response = new RequestResponse(false, '');
  }
  header('Content-type: application/json');
  echo json_encode($response);
}



