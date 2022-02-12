<?php
require "../ex2/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pdo = mysqlConnect();
  $name = $_POST["name"] ?? "";
  $email = $_POST["email"] ?? "";
  $phone = $_POST["phone"] ?? "";
  $sex = $_POST["sex"] ?? "";
  $weight = $_POST["weight"] ?? "";
  $height = $_POST["height"] ?? "";
  $bloodType = $_POST["bloodType"] ?? "";
  $postalCode = $_POST["postalCode"] ?? "";
  $address = $_POST["address"] ?? "";
  $city = $_POST["city"] ?? "";
  $uf = $_POST["UF"] ?? "";

}




?>

<!DOCTYPE html>
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
  <link rel="stylesheet" href="../main.css">
  <link rel="stylesheet" href="register.css">
  <title>Cadastro de Paciente</title>
</head>
<body>
<div class="container">
  <main>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
      <div class="row">
        <div class="col-sm-12 mb-3">
          <label for="name" class="form-label">Nome </label>
          <input
            type="text"
            id="name"
            name="name"
            required
            class="form-control" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5 mb-3">
          <label for="email" class="form-label">Email </label>
          <input
            type="email"
            id="email"
            name="email"
            required
            class="form-control" />
        </div>
        <div class="col-sm-5 mb-3">
          <label for="phone" class="form-label">Telefone </label>
          <input
            type="tel"
            id="phone"
            name="phone"
            required
            class="form-control" />
        </div>
        <div class="col-sm-2 mb-3">
          <label for="sex" class="form-label">Sexo </label>
          <select class="form-select" name="sex" id="sex">
            <option selected value="">Sel.</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Outro</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 mb-5">
          <label for="weight" class="form-label">Peso </label>
          <input
            type="number"
            id="weight"
            name="weight"
            class="form-control" />
        </div>
        <div class="col-sm-4 mb-5">
          <label for="height" class="form-label">Altura </label>
          <input
            type="number"
            id="height"
            name="height"
            class="form-control" />
        </div>
        <div class="col-sm-4 mb-5">
          <label for="bloodType" class="form-label">Tipo Sanguineo </label>
          <input
            type="text"
            id="bloodType"
            name="bloodType"
            class="form-control" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3 form-floating mb-3">
          <input
            type="text"
            name="postalCode"
            id="postalCode"
            class="form-control"
            placeholder="CEP"
          />
          <label for="postalCode" class="form-label px-4">CEP</label>
        </div>
        <div class="col-sm-9 form-floating mb-3">
          <input
            type="text"
            name="address"
            id="address"
            class="form-control"
            placeholder="Endereço"
          />
          <label for="address" class="form-label px-4">Endereço</label>
        </div>
      </div>
      <div class="row">

        <div class="col-sm-10 form-floating mb-3">
          <input
            type="text"
            name="city"
            id="city"
            class="form-control"
            placeholder="Cidade"
          />
          <label for="city" class="form-label px-4">Cidade</label>
        </div>
        <div class="col-sm-2 form-floating mb-3">
          <select class="form-select" name="UF" id="UF">
            <option selected value="">Sel.</option>
            <option value="mg">MG</option>
            <option value="go">GO</option>
            <option value="sp">SP</option>
          </select>
          <label for="UF" class="form-label px-4">Estado</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
    </form>
  </main>
</div>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"
></script>
</body>
</html>
