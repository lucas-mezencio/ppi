<?php

require "../../db-connection.php";
require "../../authentication.php";
session_start();
$pdo = mysqlConnect();
redirectIfNotLogin($pdo, "../../");

$name = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipoSang = $_POST["tipoSang"] ?? "";


$sqlPerson = <<<SQL
  insert into tb_pessoa 
    (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    values (?, ?, ?, ?, ?, ?, ?, ?)
SQL;
$sqlPat = <<<SQL
  insert into tb_paciente 
    values (?, ?, ?, ?)
SQL;



try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sqlPerson);
  if (!$stmt->execute([
    $name, $sexo, $email, $telefone,
    $cep, $logradouro, $cidade, $estado,
  ])) {
    throw new Exception("Falha no registro de pessoa.");
  }
  $personId = $pdo->lastInsertId();
  $stmt = $pdo->prepare($sqlPat);
  if (!$stmt->execute([$personId, $peso, $altura, $tipoSang])) {
    throw new Exception("Falha no registro de paciente.");
  }

  $pdo->commit();

  header("Location: index.php");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit("Erro: " . $e->getMessage());
}

