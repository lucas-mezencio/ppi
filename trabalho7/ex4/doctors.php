<?php

class RequestResponse {
  public $success;
  public $doctors;

  function __construct($success, $doctors) {
    $this->success = $success;
    $this->doctors = $doctors;
  }
}

class Doctor {
  public $nome;
  public $telefone;

  function __construct($nome, $telefone) {
    $this->nome = $nome;
    $this->telefone = $telefone;
  }
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  require "../db-connection.php";
  $pdo = mysqlConnect();

  $especialidade = $_GET['especialidade'] ?? '';

  try {
    $sql = <<<SQL
  select nome, telefone from medico
  where especialidade = (?)
SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }

  $doctorsResponse = array();
  while ($doctor = $stmt->fetch()) {
    $doctorsResponse[] = new Doctor(
      $doctor['nome'],
      $doctor['telefone']
    );
  }

  if (count($doctorsResponse) != 0) {
    $response = new RequestResponse(true, $doctorsResponse);
  } else {
    $response = new RequestResponse(false, null);
  }

  header('Content-type: application/json');
  echo json_encode($response);
}