<?php

// Configurações de conexão
$servidor = "localhost"; // ou o endereço do seu servidor
$usuario = "root"; // seu nome de usuário do banco de dados
$senha = ""; // sua senha do banco de dados
$nomeBanco = "bdestoque"; // nome do seu banco de dados

// Criar a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $nomeBanco);

// Verificar a conexão
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}





?>
