<?php

require "db-connection.php";
require "authentication.php";

class RequestResponse {
  public $success;
  public $detail;

  function __construct($success, $detail) {
    $this->success = $success;
    $this->detail = $detail;
  }
}

$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';

$pdo = mysqlConnect();
if ($hashPassword = getPasswordIfLogin($pdo, $email, $password)) {
  session_start();
  $_SESSION['email'] = $email;
  $_SESSION['loginString'] = hash('sha512', $hashPassword . $_SERVER['HTTP_USER_AGENT']);
  $response = new RequestResponse(true, 'sistema/index.php');
  $_SESSION['name'] = getEmployeeName($pdo);
  $_SESSION['isMedic'] = getIsMedic($pdo);
} else {
  $response = new RequestResponse(false, '');
}

echo json_encode($response);