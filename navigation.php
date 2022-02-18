<nav class="navigation">
    <?php
    /*Muda a aparencia da pagina caso o usuario esteja conectado a uma sessão ou não*/
    if (isset($_SESSION["idUsuario"])) {
        echo "<a href='diario.php'>Meu Diário </a> <br>";
        echo "<a href='escrever.php'>Escrever Pensamento </a> <br>";
        echo "<a href='includes/logout.inc.php'>Log Out </a>";
    } else {
        echo "<a href='login.php'>LogIn </a> <br>";
        echo "<a href='signup.php'>SignUp </a>";
    }
    ?>
</nav>