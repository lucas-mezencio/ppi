<?php

require "db-connection.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
  select cep, endereco, bairro, cidade, uf from endereco
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
  <title>Endereços</title>
</head>
<body>
  <div class="container">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">CEP</th>
          <th scope="col">Logradouro</th>
          <th scope="col">Bairro</th>
          <th scope="col">Cidade</th>
          <th scope="col">UF</th>
        </tr>
      </thead>

      <tbody>
      <?php

        while ($row = $stmt->fetch()) {
          $postalCode = htmlspecialchars($row['cep']);
          $address = htmlspecialchars($row['endereco']);
          $district = htmlspecialchars($row['bairro']);
          $city = htmlspecialchars($row['cidade']);
          $state = strtoupper(htmlspecialchars($row['uf']));

          echo <<<HTML
            <tr>
              <td>$postalCode</td>
              <td>$address</td>
              <td>$district</td>
              <td>$city</td>
              <td>$state</td>
            </tr>

          HTML;

        }

      ?>
      </tbody>

    </table>
  </div>
</body>
</html>
