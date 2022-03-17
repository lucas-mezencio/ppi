<?php

function getPasswordIfLogin($pdo, $email, $password) {
  try {
    $sqlPerson = <<<SQL
    select id from tb_pessoa where email = ?
SQL;
    $stmt1 = $pdo->prepare($sqlPerson);
    $stmt1->execute([$email]);
    $personId = $stmt1->fetchColumn();

    $sqlEmp = <<<SQL
    select senha_hash from tb_funcionario
    where id = ?
SQL;
    $stmt2 = $pdo->prepare($sqlEmp);
    $stmt2->execute([$personId]);
    $hashPassword = $stmt2->fetchColumn();


    if ((!$hashPassword) || (!password_verify($password, $hashPassword))) {
      return false;
    }
    return $hashPassword;
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }
}