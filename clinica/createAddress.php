<?php

require "db-connection.php";
$pdo = mysqlConnect();

$address = $_POST["address"] ?? "";
$cep = $_POST["cep"] ?? "";
$city = $_POST["city"] ?? "";
$uf = $_POST["uf"] ?? "";

try {
  $sql = <<<SQL
  insert into tb_endereco (cep, logradouro, cidade, estado) 
  values (?, ?, ?, ?)
SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep, $address, $city, $uf,]);

  header("location: index.html");
  exit();
} catch (Exception $e) {
  exit("Falha ao cadastrar: " . $e->getMessage());
}