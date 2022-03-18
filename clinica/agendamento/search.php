<?php

class RequestResponse {
  public $success;
  public $nomes;

  public function __construct($success, $nomes)
  {
    $this->success = $success;
    $this->nomes = $nomes;
  }
}

require "../db-connection.php";
$pdo = mysqlConnect();

$especialidade = $_GET['especialidade'] ?? '';

try {
  $sql = <<<SQL
    select nome from tb_pessoa tp 
    where id in (select id 
            from tb_medico tm 
            where especialidade = ?
);
SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$especialidade]);
} catch (Exception $e) {
  exit('Erro: ' . $e->getMessage());
}

$namesArr = array();
while ($name = $stmt->fetch()) {
  $namesArr[] = htmlspecialchars($name['nome']);
}

if (count($namesArr) != 0) {
  $response = new RequestResponse(true, $namesArr);
} else {
  $response = new RequestResponse(false, null);
}

header('Content-type: application/json');
echo json_encode($response);