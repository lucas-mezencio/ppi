<?php

require "../db-connection.php";
require "../authentication.php";
session_start();
$pdo = mysqlConnect();
redirectIfNotLogin($pdo, "../");
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
    <title>Sistema Clínica</title>
  </head>
  <body class="bg-black">
    <header>
      <nav class="navbar navbar-dark bg-primary">
        <div class="container">
          <a href="#" class="navbar-brand">
            <img src="../assets/icons/hospital.svg" alt="logo" width="32" />
            Clínica
          </a>

          <a href="logout.php" class="navbar-text">
            <img
              src="../assets/icons/logout.svg"
              alt="logout"
              class="d-inline-block align-text-top"
              width="32"
            />
            Sair
          </a>
        </div>
      </nav>
    </header>

    <main class="container bg-dark">
      <h1 class="pt-4 ml-5">
        <?php echo "Olá, " . htmlspecialchars($_SESSION['name']); ?>
      </h1>
      <div class="row p-5">
        <div class="col-md-4 g-4">
          <a href="cadastroPaciente" class="col-12 btn btn-primary mb-4">
            Cadastar Paciente
          </a>
          <a href="cadastroFuncionario" class="col-12 btn btn-primary mb-4" >
            Cadastar Funcionário
          </a>
        </div>
        <div class="col-md-4 g-4">
          <a href="listarPacientes" class="col-12 btn btn-primary mb-4">Listar Pacientes</a>
          <a href="listarFuncionarios" class="col-12 btn btn-primary mb-4">Listar Funcionários</a>
        </div>
        <div class="col-md-4 g-4">
          <a id="sessao-medico" class="col-12 btn btn-primary mb-4">
            Meus agendamentos
          </a>
          <a class="col-12 btn btn-primary mb-4">Todos os agendamentos </a>
          <a class="col-12 btn btn-primary mb-4">Listar endereços</a>
        </div>
      </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>
  </body>
</html>
