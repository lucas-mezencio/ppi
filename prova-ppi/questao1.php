<?php

require "conexaoMysql.php";

$pdo = mysqlConnect();

$nome = $_POST["segurado_nome"] ?? "";
$cpf = $_POST["segurado_cpf"] ?? "";
$email = $_POST["segurado_email"] ?? "";
$premio = $_POST["segurado_premio"] ?? "";

$dependente = $_POST["dependente_nome"] ?? "";
$relacao = $_POST["dependente_relacao"] ?? "";
$nascimento = $_POST["dependente_nascimento"] ?? "";

try {
  $sql1 = <<<SQL1
  insert into segurado (nome_seg, cpf, email, premio) 
  values (?, ?, ?, ?)
SQL1;
  $stmt1 = $pdo->prepare($sql1);
  $stmt1->execute([
    $nome, $cpf, $email, $premio,
  ]);

  $idSegurado = $pdo->lastInsertId();

  $sql2 = <<<SQL2
  insert into dependente (nome_dep, relacao, data_nascimento, id_segurado)
  values(?, ?, ?, ?)
SQL2;

  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute([
    $dependente, $relacao, $nascimento, $idSegurado,
  ]);

  header("location: questao1.html");
  exit();
} catch (Exception $e) {
  exit('Erro: (confira se nao é um dados cadastrado' . $e->getMessage());
}

SELECT nome_dep, relacao, data_nascimento, nome_seg, cpf, email, premio
  FROM dependente, segurado
  WHERE segurado.id = dependente.id_segurado