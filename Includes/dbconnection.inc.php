<?php
/*Criação de uma conexão com o banco de dados*/
$DBhost = "localhost";
$DBlogin = "root";
$DBsenha = "";
$database = "diarioDATA";

$conn = mysqli_connect($DBhost, $DBlogin, $DBsenha, $database);

/*Tratamento de erros*/
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}