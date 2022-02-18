<?php

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro; 
    $this->cidade = $cidade;
  }
}

require "../db-connection.php";
$pdo = mysqlConnect();

$cep = $_GET['cep'] ?? '';

try {
  $sql = <<<SQL
  select rua, bairro, cidade from endereco_ex7
  where cep = (?)
  limit 1
SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);
} catch (Exception $e) {
  exit('Erro inesperado: ' . $e->getMessage());
}

if ($result = $stmt->fetch() != null) {
  $endereco = new Endereco(
    $result['rua'],
    $result['bairro'],
    $result['cidade']
  );
} else {
  $endereco = new Endereco('', '', '');
}
echo json_encode($endereco);