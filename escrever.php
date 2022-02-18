<?php include_once 'header.php' ?>

<section class = "diarioForm">
    <h2>Meu Diario</h2>
    <form action="Includes/escrever.inc.php" method="post">
        <textarea rows = 20 cols = 50 name="texto" placeholder="Digite seus pensamentos aqui..."></textarea> <br>
        <input type="text" name="categoria" placeholder="Categoria..."> <br>
        <button type="submit" name="enviar">Salvar</button>
    </form>

    <?php
    /*Tratamento de erros*/
    if(isset($_GET["error"])) 
    {
        if($_GET["error"] == "emptyText") {
            echo "<p>Todos os campos não foram preenchidos</p>";
        } 
    }
    ?>
</section>

<?php include_once 'footer.php' ?>