<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
  SELECT nome_dep, relacao, data_nascimento, nome_seg, cpf, email, premio
  FROM dependente, segurado
  WHERE segurado.id = dependente.id_segurado
SQL;
  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit("Erro: " . $e->getMessage());
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Questao 2</title>
</head>
<body>
  <table >
    <thead>
      <tr>
        <th>Dependente</th>
        <th>Relação</th>
        <th>Data Nascimento</th>
        <th>Segurado</th>
        <th>CPF Segurado</th>
        <th>Premio</th>
      </tr>
    </thead>
    <tbody>
    <?php
      while ($row = $stmt->fetch()) {
        $dependente = htmlspecialchars($row['nome_dep']);
        $relacao = htmlspecialchars($row['relacao']);
        $segurado = htmlspecialchars($row['nome_seg']);
        $cpf = htmlspecialchars($row['cpf']);
        $premio = htmlspecialchars($row['premio']);
        $dataNasc = htmlspecialchars($row['data_nascimento']);

        echo <<<ROW
          <tr>
            <td>$dependente</td> 
            <td>$relacao</td>
            <td>$dataNasc</td>
            <td>$segurado</td>
            <td>$cpf</td>
            <td>$premio</td>
          </tr>
        ROW;
      }

    ?>
    </tbody>
  </table>
</body>
</html>

