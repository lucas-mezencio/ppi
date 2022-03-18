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


function checkLogin($pdo) {
  if (!isset($_SESSION['email'], $_SESSION['loginString'])) {
    return false;
  }
  $email = $_SESSION['email'];
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

    $pageLoginString = hash('sha512', $hashPassword . $_SERVER['HTTP_USER_AGENT']);
    if (!hash_equals($pageLoginString, $_SESSION['loginString'])) {
      return false;
    }
    return true;
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }
}

function getEmployeeName($pdo) {
  try {
    $sql = <<<SQL
    select nome from tb_pessoa where email = ?
SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['email']]);
    $name = $stmt->fetchColumn();
    return $name;
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }
}

function getIsMedic($pdo) {
  $id = getUserId($pdo);
  try {
    $sql = <<<SQL
      select tm.id 
	      from tb_medico tm 
	      where tm.id = ?;
SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->fetchColumn()) {
      return true;
    }
    return false;
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }
}

function getUserId($pdo) {
  try {
    $sql = <<<SQL
      select id from tb_pessoa where email = ?
SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['email']]);
    $id = $stmt->fetchColumn();
    echo ($id);
    return $id;
  } catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
  }
}

function redirectIfNotLogin($pdo, $location) {
  if (!checkLogin($pdo)) {
    header("Location: " . $location);
    exit();
  }
}