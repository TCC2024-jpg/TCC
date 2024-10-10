<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
</head>
<body>
    <div class="page">
        <form method="POST" class="formLogin" action="login.php">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            
       
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" placeholder="Digite seu CPF" autofocus="true" />
            <label for="password">Senha</label>
            
            <input type="password" name="s"/>
            
            <input type="submit" value="Acessar" class="btn"/>
            
            <?php
            // Verifica se foi preenchido usuario e senha para fazer o login
            if(isset($_POST['cpf']) && isset($_POST['s'])){
                //Importa o crud.php
                include_once("crud.php");
                //Executa a função de login
                login($_POST['cpf'],$_POST['s']);
            }
            //Verifica se ocorreu erro
            if(isset($_GET['erro'])){
                echo $_GET['erro'];
            }
        ?>
        <p style="text-align: center;">
         <a href="cadastrarusuarios.php">Cadastre-se </a>
        </p>
           
        </form>
        
    </div>
    
</body>
</html>