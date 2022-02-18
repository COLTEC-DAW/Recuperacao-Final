<?php include_once 'header.php' 
    /*ATIVIDADE DE RECUPERAÇÃO - Meu Querido Diário
        Nome: Heitor Amorim Guimarães Silva
        Matricula: 2019952178
        Turma: 3º Ano
    */
?>

<body>
    <h1> Meu Querido Diário </h1>

    <?php
        /*Apresenta o nome do usuario caso esteja conectado a uma sessão*/
        if (isset($_SESSION["loginUsuario"])) {
            echo "<h2>Bom Dia: " . $_SESSION["loginUsuario"] . "</h2>";
        }
    ?>

    <?php include_once 'navigation.php';?>
</body>