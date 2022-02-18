<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="Style/signin.css" rel="stylesheet">

<body class="text-center">
    
  <main class="form-signin">
    <form method="post" action="library/dados_login.php">
      <h1 class="h3 mb-3 fw-normal">Login</h1>

      <?php 
        $_SESSION['erro_login'] = $_SESSION['erro_login'] ?? null;
        if ($_SESSION['erro_login']) {
      ?>
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <p class="card-text">Usuário ou senha incorreto</p>
        </div>
      </div>
      <?php 
        unset($_SESSION['erro_login']);
        } 
      ?>

      <?php 
        $_SESSION['registro_sucesso'] = $_SESSION['registro_sucesso'] ?? null;
        if ($_SESSION['registro_sucesso']) {
      ?>
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <p class="card-text">Registro efetuado com sucesso!</p>
        </div>
      </div>
      <?php 
        unset($_SESSION['registro_sucesso']);
        } 
      ?>


      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="NomeDeUsuario" name="l_usuario" autocomplete="off">
        <label for="floatingInput">Usuario</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="l_senha">
        <label for="floatingPassword">Senha</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
    </form>
    <form action="form_registro.php">   
         <button class="w-100 btn btn-lg btn-secondary" type="submit">Criar conta</button>
     </form> 
</main>
</body>

