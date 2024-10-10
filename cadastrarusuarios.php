<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo1.css">
    <title>Cadastrar</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />

</head>
<body>
<div class="page">
        <form method="POST" class="formLogin" action="cadastrarusuarios.php">
            <h1>Cadastro</h1>
            <p>Digite os dados abaixo para fazer o cadastro.</p>
            <div>
            <label for="cpf" ></label>
            <input type="text" name="cpf"  autofocus="true" placeholder="Digite seu CPF"/>

            <label for="nome"></label>
            <input type="text" name="nome" placeholder="Digite seu nome" width="50%" />
            
            </div>
            
            <label for="email"></label>
            <input type="email" name="email" placeholder="Digite seu email"  />
            
            <div>
            <label for="data_nascimento"></label>
            <input type="text" name="data_nascimento" placeholder="Data de Nascimento"  />
            <label for="telefone"></label>
            <input type="text" name="telefone" placeholder="Digite seu telefone"  />
            </div>
            <div>
            <label for="password"></label>
            <input type="password" name="s" id="s" placeholder="Digite sua senha"/>
            <label for="password"></label>
            <input type="password" name="s1" id="s1" onblur="validarSenha();" placeholder="Confirme a senha"/>
            </div>
            
            <input type="submit" value="Cadastrar" class="btn"/>
            
           
       
           
        </form>
<?php
if(isset($_POST['cpf']) && isset($_POST['s'])){
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $s = $_POST['s'];

    $campos = [
        "cpf" => "'$cpf'",
        "email" => "'$email'",
        "data_nascimento" => "'$data_nascimento'",
        "nome" => "'$nome'",
        "telefone" => "'$telefone'",
        "senha" => "'$s'",
        "perfil"=> "'U'"
    ];
    include_once("crud.php");
    cadastraruser("usuarios", $campos);
}
?>
</div> 
<script src="script.js"></script>
</body>
</html>                  