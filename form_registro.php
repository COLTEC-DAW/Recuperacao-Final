<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="Style/signin.css" rel="stylesheet">

<body class="text-center">
    
  <main class="form-signin">
    <form method="post" action="library/dados_registro.php">
      <h1 class="h3 mb-3 fw-normal">Registro</h1>
      
      <?php 
      session_start();
      $_SESSION['usuario_existe'] = $_SESSION['usuario_existe'] ?? null;
      if ($_SESSION['usuario_existe']) {
      ?>
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <p class="card-text">Nome de usuário existente, favor escolher outro</p>
        </div>
      </div>
      <?php 
      }
      unset($_SESSION['usuario_existe']);
      ?>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="Nome" name="r_nome" autocomplete="off">
        <label for="floatingInput">Nome</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="NomeDeUsuario" name="r_usuario" autocomplete="off">
        <label for="floatingInput">Usuario</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="r_senha">
        <label for="floatingPassword">Senha</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>
    </form>
    
    
</main>
</body>
