<nav>
    <h1><a href="index.php">Meu Querido Diário</a></h1>

    <!--LOGIN Header-->
    <?php
        if (!isset($_SESSION["UID"])){
            ?>
                <form action='userpage.php' method='post' id='form-login'>
                    <input type='text' name='login' placeholder='Login' autocomplete='off' required><br>
                    <input type='password' name='senha' placeholder='Senha' autocomplete='off' required><br>
                    <input type='submit' name='iniciar_sessao' value='Iniciar Sessão' class='btn_blue_small'>
                </form>
            <?php
        } else {
            ?>
                <div>
                    Logado como: <span> <?php echo $_SESSION["UID"]->getLogin(); ?> </span><br>
                    <form action='logout_formhandler.php' method='post' id='form-logout'>
                        <input type='submit' name='encerrar_sessao' value='Encerrar Sessão' class='btn_red_small'>
                    </form>
                </div>
            <?php
        }
    
    ?>
</nav>