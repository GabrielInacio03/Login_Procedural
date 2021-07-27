<?php 
    require_once 'db_connect.php';

    //sessoes
    session_start();

    if(isset($_POST['cadastrar']))
    {    
        $erros = array();
        //filtrando       
        $login = mysqli_escape_string($connect, $_POST['login']);    
        $senha = mysqli_escape_string($connect, $_POST['senha']);
        
        //validando
        if(empty($login) || empty($senha))
        {
            $erros[] = "Campos precisam ser preenchidos";
        }else{
            //SQL Injection
            /**
             * 105 ORD 1=1
             * 1; DROP Table teste
             */
            //saber se existe login
            $sql = "SELECT login FROM usuarios WHERE login='$login'";
            $resultado = mysqli_query($connect, $sql);
            
            //se o n de linhas é maior que 0
            if(mysqli_num_rows($resultado) > 0)
            {                
                $sql = "SELECT * FROM usuarios WHERE  login='$login' AND senha='$senha'";
                $resultado = mysqli_query($connect, $sql);
                if(mysqli_num_rows($resultado) == 1)
                {
                    $senha = md5($senha);
                    //converter para array
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($connect); //fechar conexao
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];

                    header('Location: home.php');
                    
                } else
                {
                    $erros[]= "Usuário e Senha não cadastrados";
                }
            } else
            {
                $erros[] = "Usuário inexistente";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php 
        if(!empty($erros))
        {
            foreach($erros as $erro)
            {
                echo $erro;
            }
        }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">       
        <input type="text" name="login" placeholder="login">
        <br>
        <input type="password" name="senha">

        <br>
        <input type="submit" value="Enviar" name="cadastrar">
    </form>
</body>
</html>