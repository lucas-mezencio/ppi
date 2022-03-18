<?php

require "../../db-connection.php";
require "../../authentication.php";
session_start();
$pdo = mysqlConnect();
redirectIfNotLogin($pdo, "../../");

try {
  $sql = <<<SQL
    select * from tb_pessoa tp 
    inner join tb_funcionario tf on tf.id = tp.id
SQL;
  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit("Error: " . $e->getMessage());
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
  <title>Lista de Funcionarios</title>
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
      <th scope="col">Nome</th>
      <th scope="col">Sexo</th>
      <th scope="col">Email</th>
      <th scope="col">Telefone</th>
      <th scope="col">CEP</th>
      <th scope="col">Logradouro</th>
      <th scope="col">Cidade</th>
      <th scope="col">Estado</th>
      <th scope="col">Data contrato</th>
      <th scope="col">Salário</th>
    </tr>
    </thead>
    <tbody>
    <?php
      while ($row = $stmt->fetch()) {
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $cep = htmlspecialchars($row['cep']);
        $logradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
        $dataContrato = date("d-m-Y", strtotime($row["data_contrato"]));
        $salario = htmlspecialchars($row['salario']);
        echo <<<HTML
          <tr>
            <td>$nome</td>
            <td>$sexo</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$cidade</td>
            <td>$estado</td>
            <td>$dataContrato</td>
            <td>R$ $salario</td>
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
