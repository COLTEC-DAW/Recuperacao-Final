<?php 
    include "conexao.php";
    include "pensamentoDAO.php";
    include "protect.php";

    $conexao = new Conexao();
    $pensamentoDAO = new pensamentoDAO($conexao->get_connection());


    $pensamentos = $pensamentoDAO->get_pensamentos($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pensamentos</title>
</head>
<body>
    <h1>Pensamentos : </h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Pensamento</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pensamentos as $pensamento) { ?>
                    <tr>
                        <td><?= $pensamento->get_id()?></td>
                        <td><?= $pensamento->get_pensamento() ?></td>
                        <td><?= $pensamentoDAO->get_categoria_nome($pensamento->get_id())['nome']?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <p><a href="index.php">Página Inicial</a></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>