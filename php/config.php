<?php
$conexao = mysqli_connect('localhost', 'root', '', 'testepratico');

if($conexao === false)
{
    die("ERRO: Não foi possível conectar ao banco de dados. " . mysqli_connect_error());
}
?>