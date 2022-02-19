<?php 
    include "conexao.php";
    include "categoriaDAO.php";
    include "protect.php";

    $conexao = new Conexao();
    $categoriaDAO = new CategoriaDAO($conexao->get_connection());


    $categorias = $categoriaDAO->get_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1>Categorias : </h1>
    <table>
        <?php foreach ($categorias as $categoria) { ?>
            <tr>
                <td><?= $categoria->get_id() ?></td>
                <td><?= $categoria->get_nome() ?></td>
            </tr>
        <?php } ?>
    </table>
    <p><a href="index.php">Página Inicial</a></p>
</body>
</html>