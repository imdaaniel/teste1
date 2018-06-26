<?php
require('config.php');

$codigo = json_decode($_GET['codigo']);
$resultado = mysqli_query($con, "SELECT email FROM clientes_dados WHERE codigo = '$codigo';") or die(mysqli_errno());

$numcolunas = mysqli_num_rows($resultado);
if($numcolunas == 1)
{
    $coluna = mysqli_fetch_assoc($resultado);
    $_SESSION['email'] = $coluna['email'];
    echo $_SESSION['email'];
}
mysqli_close($con);
?>