<?php 
    //conexao com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "login_procedural";

    /*
        MYSQLI é compativel com OO e Procedural.
    */
    $connect = mysqli_connect($servername,$username,$password,$db_name);

    if(mysqli_connect_error())
    {
        echo "FALHA NA CONEXÃO: ".mysqli_connect_error();
    }
?>