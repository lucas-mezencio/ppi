<?php

class RequestResponse {
  public $success;
  public $medics;

  public function __construct($success, $medics)
  {
    $this->success = $success;
    $this->medics = $medics;
  }
}

class Medic {
  public $name;
  public $id;

  public function __construct($name, $id)
  {
    $this->name = $name;
    $this->id = $id;
  }

}

require "../db-connection.php";
$pdo = mysqlConnect();

$especialidade = $_GET['especialidade'] ?? '';

try {
  $sql = <<<SQL
    select nome, id from tb_pessoa tp 
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

$medicsArr = array();
while ($name = $stmt->fetch()) {
  $medicsArr[] = new Medic(
    htmlspecialchars($name['nome']),
    htmlspecialchars($name['id'])
  );
}

if (count($medicsArr) != 0) {
  $response = new RequestResponse(true, $medicsArr);
} else {
  $response = new RequestResponse(false, null);
}

header('Content-type: application/json');
echo json_encode($response);