<?php include_once 'header.php'?>

<section class = "loginForm">
    <h2>Log In</h2>
    <form action="Includes/login.inc.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario...">
        <input type="password" name="senha" placeholder="Senha...">
        <button type="submit" name="enviar">Log In</button>
    </form>

    <?php
    /*Tratamento de erros*/
    if(isset($_GET["error"])) 
    {
        if($_GET["error"] == "emptyField") {
            echo "<p>Todos os campos não foram preenchidos</p>";
        } 
        else if($_GET["error"] == "usuarioIncorreto") {
            echo "<p>Usuario incorreto/não existe</p>";
        } 
        else if($_GET["error"] == "senhaIncorreta") {
            echo "<p>Senha incorreta</p>";
        } 
    } 
    ?>
</section>

<?php include_once 'footer.php'?>