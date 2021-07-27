<?php 
     require_once 'db_connect.php';

      //sessoes
      session_start();
     //verificacao
     if(!$_SESSION['logado'])
    {        
        header('Location: index.php');
     
    }    

     //dados
     $id = $_SESSION['id_usuario'];
     $sql = "SELECT * FROM usuarios WHERE id='$id'";
     $r = mysqli_query($connect, $sql);
     $dados = mysqli_fetch_array($r);
     mysqli_close($connect); //fechar conexao
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .user{
            position: absolute;
            left: 5px;
            top: 0;
        }
        a{
            position: absolute;
            right: 15px;
            top: 20px;
        }
    </style>
</head>
<body>
    <p class="user"><b>Usuário: </b><?php echo $dados['nome'];?></p>
    <a href="logout.php">Sair</a>
    <br>
    <h2>Usuários: </h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Login</th>               
            </tr>
        </thead>
        <tbody>
            <?php 
                if(isset($dados))
                {
                  
            ?>
            <tr>
                <td><?php echo $dados['id']."<br>";?></td>
                <td><?php echo $dados['nome']."<br>";?></td>
                <td><?php echo $dados['login']."<br>";?></td>
            </tr>
            <?php 
                }                
            ?>
        </tbody>
    </table>
</body>
</html>