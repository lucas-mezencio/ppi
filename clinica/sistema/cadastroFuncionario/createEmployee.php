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

$senha = $_POST["senha"] ?? "";
$senha = password_hash($senha, PASSWORD_DEFAULT);
$dataContrato =  date("Y-m-d", strtotime($_POST["data-contrato"]) ?? "");
$salario = $_POST["salario"] ?? "";

$isMedico = $_POST["isMedico"] ?? "";
$crm = $_POST["crm"] ?? "";
$especialidade = $_POST["especialidade"] ?? "";

$sqlPerson = <<<SQL
  insert into tb_pessoa 
    (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    values (?, ?, ?, ?, ?, ?, ?, ?)
SQL;
$sqlEmp = <<<SQL
  insert into tb_funcionario 
    values (?, ?, ?, ?)
SQL;

$sqlMed = <<<SQL
  insert into tb_medico
    values (?, ?, ?);
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
  $stmt = $pdo->prepare($sqlEmp);
  if (!$stmt->execute([$personId, $dataContrato, $salario, $senha])) {
    throw new Exception("Falha no registro de funcionário");
  }

  if ($isMedico) {
    $stmt = $pdo->prepare($sqlMed);
    if (!$stmt->execute([$personId, $especialidade, $crm])) {
      throw new Exception("Falha no registro de funcionário");
    }
  }

  $pdo->commit();

  header("Location: index.php");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit("Erro: " . $e->getMessage());
}

