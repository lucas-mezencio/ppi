<?php

require "db-connection.php";
$pdo = mysqlConnect();

// cep, logradouro, bairro, cidade, estado(uf)

$postalCode = $_POST["postalCode"] ?? "";
$address = $_POST["address"] ?? "";
$district = $_POST["district"] ?? "";
$city = $_POST["city"] ?? "";
$state = $_POST["UF"] ?? "";

try {
  $sql = <<<SQL
  insert into endereco (cep, endereco, bairro, cidade, uf)
  values (?, ?, ?, ?, ?)
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$postalCode, $address, $district, $city, $state]);

  header("location: trabalho6/index.html");
  exit();
} catch (Exception $e) {
  exit('Falha ao cadastrar o endereco: ' . $e->getMessage());
}