<?php
    // Verifica se o usuário já está logado
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;
    
    // Logout
    if ( isset($_GET['logout']) AND $_GET['logout'] == 1){
        session_unset(); 
        session_destroy();
        header('Location: /recuperação_final');
    }
?>