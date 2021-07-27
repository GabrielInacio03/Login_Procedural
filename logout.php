<?php 
    //encerrando sessão
    session_start(); // iniciando sessão
    session_unset(); //limpar sessão
    session_destroy(); //destruindo sessão

    header('Location: index.php');
?>