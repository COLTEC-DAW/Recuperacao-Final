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
    <title>Novo Pensamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <h1>Novo Pensamento: </h1>
            <form class="form-label" action="index.php" method="post">
                <div class="row">
                    <div class="col-2">
                        <label for="pensamento">Pensamento:</label> <br>
                        <textarea class="form-control mb-1" maxlength="1000" required name="pensamento" id="" cols="24" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <select class="form-select" name="categoria" required>
                            <option value="" hidden selected>Escolha a Categoria</option>
                            <?php
                                foreach($categorias as $categoria){
                                    $categoriaID = $categoria->get_id();
                                    $categoriaNome = $categoria->get_nome();
                            ?>
                                <option value="<?=$categoriaID?>"><?=$categoriaNome?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>     
                <input type="hidden" name="pensamento-action" value="pensamento-action">
                <input type="submit" class="btn btn-primary btn-sm mt-1" value="Cadastrar">
            </form>
            <p><a href="index.php">Voltar</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>