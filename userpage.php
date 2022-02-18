<?php
    require 'classes.php';
    session_start();

    $conexao = mysqli_connect("localhost", "root", "", "MeuQueridoDiario");

    
    $reqType = $_SERVER["REQUEST_METHOD"];
    if($reqType == 'POST'){
        if (!empty($_POST["login"]) && !empty($_POST["senha"])){ //Login
            $resultado = mysqli_query($conexao, "SELECT usuarios.id, usuarios.nome, usuarios.login FROM usuarios WHERE login = \"".$_POST["login"]."\" AND senha = \"".$_POST["senha"]."\" ");
            $row = mysqli_fetch_array($resultado);
            if ($resultado == FALSE || $row == NULL) {echo "Dados de login incorretos.";}
            else {$_SESSION["UID"] = new User($row["id"],$row["nome"],$row["login"]);}
        }
        else if (!empty($_POST["content"])){ //Post
            $content = $_POST["content"];
            $category = $_POST["category"];
            $uid = $_SESSION["UID"]->getId();
            $res_insert = mysqli_query($conexao, "INSERT INTO pensamentos (pensamento,criado_em,categorias_id,usuarios_id) VALUES (\"$content\",CURRENT_TIMESTAMP(),$category,$uid)");
        }
        header('location: userpage.php');
    }

    //Selecao
    if (isset($_SESSION["UID"])){
        $resultado = mysqli_query($conexao, "SELECT pensamentos.pensamento, pensamentos.criado_em, categorias.nome FROM pensamentos JOIN categorias ON pensamentos.categorias_id = categorias.id WHERE pensamentos.usuarios_id = ".$_SESSION["UID"]->getId(). " ORDER BY pensamentos.criado_em DESC");
        $num = mysqli_num_rows($resultado);

        $categorias = mysqli_query($conexao, "SELECT categorias.nome, categorias.id FROM categorias");
        $cat_num = mysqli_num_rows($categorias);
    }
    else {$resultado = null;}

    mysqli_close($conexao);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Userpage|Meu Querido Diário</title>
</head>
<body>
    <?php require 'header.inc'; ?>

    <div class='container'>
        <?php
            if (!isset($_SESSION["UID"])){
                ?>
                    <p>Timeout: Sessão encerrada.</p>
                    <a href="./home.php" class='btn_red_small'>Retornar a página inicial.</a>
                <?php
            } else {
                ?>
                    <h2>Diário de <?php echo $_SESSION["UID"]->getName()  ?></h2>

                    <form action='userpage.php' method='post' id='form-pensamento'>
                        <textarea name='content' placeholder='O que você está pensando?' autocomplete="off" id='userpage_textbox' rows="5"></textarea>
                        <select name='category'>
                            <?php
                                for ($i = 0; $i < $cat_num; $i ++){
                                    $row = mysqli_fetch_array($categorias);
                                    echo "<option value = \"".$row["id"]."\" selected>".$row["nome"]."</option>";
                                }
                            ?>
                        </select>
                        <input type='submit' name='post' value='Postar' class='btn_green_big'>
                    </form>

                    <?php
                        for ($i = 0; $i < $num; $i ++){
                            $row = mysqli_fetch_array($resultado);
                            $pensamento = new Pensamento($row["pensamento"], $row["criado_em"], $row["nome"]);
                            $pensamento->echoPensamento();
                        }
                    ?>
                <?php
            }
        ?>
    </div>
</body>
</html>