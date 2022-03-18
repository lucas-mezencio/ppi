<?php
require "../db-connection.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    select distinct especialidade from tb_medico
SQL;
  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit ('Erro: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Agendamento de consultas na Clínica" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Agendamento</title>
  </head>
  <body>
    <header>
      <div class="container">
        <nav>
          <div class="clinica-logo">
            <img src="../assets/icons/hospital.svg" alt="" />
            <h1>Clínica</h1>
          </div>

          <div class="agenda-title">
            <span>Agendamento</span>
          </div>

          <div class="clinica-home">
            <a href="../index.html">
              <img src="../assets/icons/return.svg" alt="" />
              Voltar
            </a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <div class="container">
        <form action="createSchedule.php" method="post" class="m-5">
          <div class="row">
            <div class="col-sm-6 form-floating mb-3">
              <select
                name="especialidade"
                id="especialidade"
                class="form-select"
                required
              >
                <option value="" selected>Selecione</option>
                <?php
                    while($row = $stmt->fetch()) {
                      $value = htmlspecialchars($row['especialidade']);
                      echo "<option value='$value'>$value</option>";
                    }
                ?>
              </select>
              <label for="especialidade" class="form-label px-4">
                Especialidade
              </label>
            </div>
            <div class="col-sm-6 form-floating mb-3">
              <select name="medico" id="medico" class="form-select" required>
              </select>
              <label for="medico" class="form-label px-4">Médico</label>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 form-floating mb-5">
              <input
                type="date"
                class="form-control"
                name="date"
                id="date"
                placeholder="Data"
                required
              />
              <label for="date" class="form-label px-4">Data</label>
            </div>
            <div class="col-sm-6 form-floating mb-5">
              <select name="hour" id="hour" class="form-select" required>

              </select>
              <label for="hour" class="form-label px-4">Horário</label>
            </div>
          </div>

          <div class="row">
            <div class="col-12 form-floating mb-3">
              <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                placeholder="Nome completo"
                required
              />
              <label for="name" class="form-label px-4">Nome completo</label>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-8 form-floating mb-5">
              <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                placeholder="Email"
                required
              />
              <label for="email" class="form-label px-4">Email</label>
            </div>
            <div class="col-sm-4 form-floating mb-5">
              <select name="sexo" id="sexo" class="form-select" required>
                <option selected>Sel. o sexo</option>
                <option value="f">Feminino</option>
                <option value="m">Masculino</option>
              </select>
              <label for="sexo" class="form-label px-4">Sexo</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <button>Agendar</button>
            </div>
          </div>
        </form>
      </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>
  </body>
</html>
