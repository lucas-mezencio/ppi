<?php

  require_once "db-connection.php";
  $pdo = mysqlConnect();

  $sql = <<<SQL 
    insert into teste(nome) values (?)
  SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["teste"]);

  } catch (Exception $e) {
    exit ('falha inesperada');
  } finally {
    echo "deu certo";
  }


