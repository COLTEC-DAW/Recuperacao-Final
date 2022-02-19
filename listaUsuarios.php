<?php 
    include "conexao.php";
    include "usuarioDAO.php";
    include "protect.php";

    $conexao = new Conexao();
    $usuarioDAO = new UsuarioDAO($conexao->get_connection());


    $users = $usuarioDAO->get_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <h1>Usuarios: </h1>
    <table>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user->get_id() ?></td>
                <td><?= $user->get_nome() ?></td>
                <td><?= $user->get_login() ?></td>
                <td><?= $user->get_senha() ?></td>
            </tr>
        <?php } ?>
    </table>
    <p><a href="index.php">Página Inicial</a></p>
</body>
</html>

