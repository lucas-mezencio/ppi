<?php
require "../../db-connection.php";
require "../../authentication.php";
session_start();
$pdo = mysqlConnect();
redirectIfNotLogin($pdo, "../../");
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
    <link rel="stylesheet" href="../../main.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Cadastro de Funcionários</title>
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
      <h1 class="pt-5 pb-4 ps-3">Cadastar funcionário</h1>
      <div><p>usuário cadastrado com sucesso!</p></div>
      <form action="createEmployee.php" method="post" class="px-3" id="emp-form">
        <div class="row g-3">
          <div class="col-sm-7 col-lg-10 form-floating">
            <input
              type="text"
              class="form-control"
              name="nome"
              id="nome"
              placeholder="Nome completo"
              required
            />
            <label class="form-label px-4" for="nome">Nome completo</label>
          </div>

          <div class="col-sm-5 col-lg-2 form-floating">
            <select name="sexo" id="sexo" class="form-select" required>
              <option selected>Selecione</option>
              <option value="f">Feminino</option>
              <option value="m">Masculino</option>
            </select>
            <label for="sexo" class="form-label px-4">Sexo</label>
          </div>

          <div class="col-md-8 form-floating">
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              placeholder="email"
              required
            />
            <label for="email" class="form-label px-4">Email</label>
          </div>

          <div class="col-md-4 form-floating">
            <input
              type="tel"
              name="telefone"
              id="telefone"
              class="form-control"
              placeholder="Telefone"
            />
            <label for="telefone" class="form-label px-4">Telefone</label>
          </div>
          <div class="col-md-4 form-floating">
            <input
              type="text"
              name="cep"
              id="cep"
              class="form-control"
              placeholder="CEP"
              required
            />
            <label for="cep" class="form-label px-4">CEP</label>
          </div>
          <div class="col-md-8 form-floating">
            <input
              type="text"
              name="logradouro"
              id="logradouro"
              class="form-control"
              placeholder="Logradouro"
              required
            />
            <label for="logradouro" class="form-label px-4">Logradouro</label>
          </div>

          <div class="col-md-6 form-floating">
            <input
              type="text"
              name="cidade"
              id="cidade"
              class="form-control"
              placeholder="Cidade"
              required
            />
            <label for="cidade" class="form-label px-4">Cidade</label>
          </div>

          <div class="col-md-6 form-floating">
            <input
              type="text"
              name="estado"
              id="estado"
              class="form-control"
              placeholder="Estado"
              required
            />
            <label for="estado" class="form-label px-4">Estado</label>
          </div>

          <div class="col-md-4 form-floating">
            <input
              type="password"
              name="senha"
              id="senha"
              class="form-control"
              placeholder="Senha"
              required
            />
            <label for="senha" class="form-label px-4">Senha</label>
          </div>

          <div class="col-md-4 form-floating">
            <input
              type="date"
              name="data-contrato"
              id="data-contrato"
              class="form-control"
              placeholder="Data contratação"
              required
            />
            <label for="data-contrato" class="form-label px-4">
              Data contratação
            </label>
          </div>

          <div class="col-md-4 form-floating">
            <input
              type="text"
              name="salario"
              id="salario"
              class="form-control"
              placeholder="Salário"
              required
            />
            <label for="salario" class="form-label px-4">Salário</label>
          </div>

          <hr style="color: white" />

          <div class="form-check mb-3">
            <input
              type="checkbox"
              name="isMedico"
              id="isMedico"
              class="form-check-input ms-1"
            />
            <label
              for="isMedico"
              class="form-check-label ms-2"
              style="color: white"
            >
              O funcionário é medico?
            </label>
          </div>

          <div class="col-sm-6 form-floating cad-medico">
            <input
              type="text"
              name="crm"
              id="crm"
              class="form-control"
              placeholder="CRM"
            />
            <label for="crm" class="form-label px-4">CRM</label>
          </div>
          <div class="col-sm-6 form-floating cad-medico">
            <input
              type="text"
              name="especialidade"
              id="especialidade"
              class="form-control"
              placeholder="Especialidade"
            />
            <label for="especialidade" class="form-label px-4">
              Especialidade
            </label>
          </div>
          <button
            id="btn-cadastro"
            class="col-sm-4 btn btn-lg btn-primary mt-4"
          >
            Cadastrar
          </button>
        </div>
      </form>
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>
  </body>
</html>
