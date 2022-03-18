<?php

require "../db-connection.php";
$pdo = mysqlConnect();

$especialidade = $_POST['especialidade'] ?? '';
$medico = $_POST['medico'] ?? '';
$date = date("Y-m-d", strtotime($_POST['date']));
$hour = $_POST['hour'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$sexo = $_POST['sexo'] ?? '';

try {
  $sql = <<<SQL
    insert into tb_agenda 
      (data_, horario, nome, sexo, email, medico_id) 
      values (?, ?, ?, ?, ?, ?);
SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $date, $hour, $name, $sexo, $email, $medico
  ]);
  header("Location: ../index.html");
  exit();
} catch (Exception $e) {
  exit("Error: " . $e->getMessage());
}