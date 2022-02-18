<?php include_once 'header.php'?>

<section class = "signupForm">
    <h2>Sign Up</h2>
    <form action="Includes/signup.inc.php" method="post">
        <input type="text" name="nome" placeholder="Nome...">
        <input type="text" name="usuario" placeholder="Usuario...">
        <input type="password" name="senha" placeholder="Senha...">
        <input type="password" name="confirmaSenha" placeholder="Confirmar Senha...">
        <button type="submit" name="enviar">Sign Up</button>
    </form>

    <?php
    /*Tratamento de erros*/
    if(isset($_GET["error"])) 
    {
        if($_GET["error"] == "emptyField") {
            echo "<p>Todos os campos não foram preenchidos</p>";
        } 
        else if($_GET["error"] == "invalidNome") {
            echo "<p>Nome invalido</p>";
        } 
        else if($_GET["error"] == "senhasNaoConferem") {
            echo "<p>Senhas não conferem</p>";
        } 
        else if($_GET["error"] == "usuarioJaExiste") {
            echo "<p>O nome de usuario já existe</p>";
        }
        else if($_GET["error"] == "stmtFail") {
            echo "<p>Algum erro aconteceu</p>";
        }
        else if($_GET["error"] == "errorNulo") {
            echo "<p>Conta Criada com Sucesso</p>";
        }
    } 
    ?>
</section>

<?php include_once 'footer.php'?>