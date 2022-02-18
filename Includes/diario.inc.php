<?php
    require_once 'dbconnection.inc.php';
    require_once 'functions.inc.php';

    echo "<h2>Diario de " . $_SESSION["loginUsuario"] . "</h2>";

    $diarioLista = selecionaDiario($conn);
    $numPensamentos = mysqli_num_rows($diarioLista);

    /*Tratamento de erros*/
    if($numPensamentos == 0){
        echo "<h3>Diario Vazio</h3>";
        echo "<p><a href='./escrever.php'>Escrever Pensamento</a><p> <br>";
        exit();
    } 
    else
    {
        for($i = 0; $i < $numPensamentos; $i++) {
            $row = mysqli_fetch_array($diarioLista);

            echo "<p>" . $row['categorias_id'] . "</p>";
            echo "<p>" . $row['criado_em'] . "</p>";
            echo "<textarea rows = 20 cols = 50 name='pensamento'>" .$row['pensamento']. "</textarea> <br>";
        }
    }


?>