<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        die("Você não tem permissão para acessar essa página porque não está logado. <p><a href=\"login.php\">Login</a></p>");
    }
?>