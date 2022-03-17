<?php

require "../ex2/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pdo = mysqlConnect();
  $email = $_POST["email"] ?? "";
  $password = $_POST["password"] ?? "";
  $password = password_hash($password, PASSWORD_DEFAULT);

  try {
    $sql = <<<SQL
      insert into user_login (email, password)
      values (?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);

    header("location: index.html");
    exit();
  } catch (Exception $e) {
    if ($e->errorInfo[1] === 1062) {
      exit('Usuário já cadastrado: ' . $e->getMessage());
    } else {
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
  }

}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Registrar</title>

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
        <button>Registrar</button>
      </form>
    </main>
  </body>
</html>
