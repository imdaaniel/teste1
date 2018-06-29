<?php
$conexao = mysqli_connect('localhost', 'root', '', 'testepratico');

if($conexao === false)
{
    die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}
?>