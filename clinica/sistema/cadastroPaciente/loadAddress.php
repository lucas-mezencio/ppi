<?php
class RequestResponse {
  public $success;
  public $logradouro;
  public $cidade;
  public $estado;

  function __construct($success, $logradouro, $cidade, $estado) {
    $this->success = $success;
    $this->logradouro = $logradouro;
    $this->cidade = $cidade;
    $this->estado = $estado;
  }
}

require "../../db-connection.php";
$pdo = mysqlConnect();
$cep = $_GET['cep'] ?? '';

try {
  $sql = <<<SQL
  select logradouro, cidade, estado 
  from tb_endereco
  where cep = ?
SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);
} catch (Exception $e) {
  exit('Erro: ' . $e->getMessage());
}

if ($endereco = $stmt->fetch()) {
  $response = new RequestResponse(
    true,
    $endereco['logradouro'],
    $endereco['cidade'],
    $endereco['estado']
  );
} else {
  $response = new RequestResponse(false, '', '', '');
}

header('Content-type: application/json');
echo json_encode($response);