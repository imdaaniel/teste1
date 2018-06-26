<?php
require('config.php');
session_start();

if(isset($_POST['usuario']))
{
    $codigo = $_POST['codigo'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $query = "SELECT ap.codigo, ap.usuario, ap.senha, ap.nivel, cd.breve, cd.email FROM clientes_dados as cd JOIN acesso_portal as ap ON cd.codigo = ap.codigo WHERE ap.codigo = '$codigo' and ap.usuario = '$usuario' and ap.senha = '$senha';";
    $resultado = mysqli_query($con, $query) or die(mysqli_errno());
    //header("Location: ../index.php?c='$codigo'&u='$usuario'&s='$senha'");
    $numcolunas = mysqli_num_rows($resultado);
    $resultadostring = mysql_real_escape_string($resultado);
    if($numcolunas == 1)
    {
        $coluna = mysqli_fetch_assoc($resultado);
        $_SESSION['codigo'] = $coluna['codigo'];
        $_SESSION['usuario'] = $coluna['usuario'];
        $_SESSION['senha'] = $coluna['senha'];
        $_SESSION['nivel'] = $coluna['nivel'];
        $_SESSION['nomebreve'] = $coluna['breve'];
        $_SESSION['email'] = $coluna['email'];
        header("Location: ../home.php");
    }
    else
    {
        header("Location: ../index.php?msg=failed");
    }
}
else
{
    header("Location: ../index.php?msg=form");
}
?>
