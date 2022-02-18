<?php 
    include "conexao.php";
    include "pensamentoDAO.php";
    session_start();

    $conexao = new Conexao();
    $pensamentoDAO = new PensamentoDAO($conexao->get_connection());

    $loginAtual = $_SESSION["login"];
    $pensamentos = $pensamentoDAO->get_all_from_user($loginAtual);

    mysqli_close($conexao->get_connection());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pensamentos - Meu Querido Diário</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php include "./menu.inc"; ?>
    <h1>Meus pensamentos</h1>
    
    <!-- Caso existam pensamentos, mostra-os numa tabela -->
    <?php if (!empty($pensamentos)){ ?>
    <table>
        <th>ID &nbsp</th>
        <th>Pensamento &nbsp</th>
        <th>Data de criacao &nbsp</th>
        <th>Categoria &nbsp</th>
        
        <?php
        asort($pensamentos);
        foreach ($pensamentos as $p) {?>
            <tr>
                <td><?= $p->get_id() ?></td>
                <td><?= $p->get_pensamento() ?></td>
                <td><?= $p->get_criado_em() ?></td>
                <td><?= $p->get_categoria() ?></td>
            </tr>
        <?php } ?>

    </table>
    <?php } else echo "Você ainda não publicou nenhum pensamento." ?>
        
    <p>
        <a href="addPensamento.php">Adicionar pensamento</a>
    </p>

    <p>
        <a href="todosOsPensamentos.php">Ver todos os pensamentos já adicionados</a>
    </p>

</body>
</html>