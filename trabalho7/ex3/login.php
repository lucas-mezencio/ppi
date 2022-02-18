<?php

function login($pdo, $email, $password) {
  $sql = <<<SQL
  select password from user_login
  where email = ?
SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if(!$row) {
      return false;
    }
    return password_verify($password, $row['password']);
  } catch (Exception $e) {
    exit ('Erro: ' + $e->getMessage());
  }

}

$showAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require "../db-connection.php";
  $pdo = mysqlConnect();

  $loginEmail = $_POST["email"] ?? "";
  $loginPassword = $_POST["password"] ?? "";

  if (login($pdo, $loginEmail, $loginPassword)) {
    header("location: userHome.html");
    exit();
  } else {
    $showAlert = true;
  }

}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Registrar</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
  />

  <link rel="stylesheet" href="userForm.css" />
  <link rel="stylesheet" href="../main.css" />
</head>
<body>
<main>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
      <label for="email">Email: </label>
      <input type="text" id="email" name="email" required />
    </div>
    <div>
      <label for="password">Senha: </label>
      <input type="password" id="password" name="password" required />
    </div>
    <button>Login</button>
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $showAlert) {
      $location = htmlspecialchars($_SERVER["PHP_SELF"]);
      echo <<<HTML
        <div class="alert alert-danger" role="alert">
         Dados invalidos
        </div>
      HTML;
    }
  ?>
</main>
</body>
</html>
