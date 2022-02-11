<?php
require "../ex2/db-connection.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
  select email, password from user_login
SQL;

  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit('Erro: ' . $e->getMessage());
}

?>


<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
  />
  <title>Usuários</title>

  <style>
    nav {
        width: 100vw;
        height: 32px;
        padding: 8px 16px;
    }
    a {
        text-decoration: none;
    }
  </style>
</head>
<body>
<nav>
  <a href="index.html">&lt;&lt; voltar</a>
</nav>
<div class="container">
  <table class="table table-striped table-hover">
    <thead>
    <tr>
      <th scope="col">Email</th>
      <th scope="col">Senha</th>
    </tr>
    </thead>

    <tbody>
    <?php

    while ($row = $stmt->fetch()) {
      $email = htmlspecialchars($row['email']);
      $password = htmlspecialchars($row['password']);


      echo <<<HTML
            <tr>
              <td>$email</td>
              <td>$password</td>
            </tr>

          HTML;

    }

    ?>
    </tbody>

  </table>
</div>

  <script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"
  ></script>
</body>
