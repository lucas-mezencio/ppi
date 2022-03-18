<?php

require "../../db-connection.php";
require "../../authentication.php";
session_start();
$pdo = mysqlConnect();
redirectIfNotLogin($pdo, "../../");

if (getIsMedic($pdo)) {
  try {
    $sql = <<<SQL
    select ta.data_, ta.horario, ta.nome as paciente, ta.sexo, ta.email
      from tb_agenda ta 
      where medico_id = ?;
SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([getUserId($pdo)]);
  } catch (Exception $e) {
    exit("Error: " . $e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../main.css" />
  <link rel="stylesheet" href="style.css" />
  <title>Meus agendamentos</title>
</head>
<body class="bg-black">
<header>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="../../assets/icons/hospital.svg" alt="logo" width="32" />
        Clínica
      </a>
      <a href="../" class="navbar-text"> Voltar </a>
    </div>
  </nav>
</header>

<main class="container bg-dark">
  <table class="table table-striped table-dark">
    <thead>
    <tr>
      <th scope="col">Data</th>
      <th scope="col">Horário</th>
      <th scope="col">Paciente</th>
      <th scope="col">Sexo</th>
      <th scope="col">Email</th>
      <th scope="col">Especialidade</th>
      <th scope="col">Medico</th>
    </tr>
    </thead>
    <tbody>
    <?php
      while ($row = $stmt->fetch()) {
        $data = date("d-m-Y", strtotime($row["data_"]));
        $horario = htmlspecialchars($row['horario']);
        $paciente = htmlspecialchars($row['paciente']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);


        echo <<<HTML
          <tr>
            <td>$data</td>
            <td>$horario</td>
            <td>$paciente</td>
            <td>$sexo</td>
            <td>$email</td>
          </tr>
        HTML;
      }
    ?>
    </tbody>
  </table>
</main>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
  crossorigin="anonymous"
></script>
</body>
</html>
