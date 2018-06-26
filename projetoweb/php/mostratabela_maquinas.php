<?php
require('config.php');
$codigo = json_decode($_GET['codigo']);
$maquina = json_decode($_GET['maquina']);

$consulta = mysqli_query($con, "select sum(qtd_cfs) from ecf where maquina = '$maquina' and cod_cliente = '$codigo';")
    
echo 
    "<table>
        <tr>
            <th>Apelido máquina</th>
            <th>Nome Máquina</th>
            <th>Qtd. Cupons</th>
            <th>Valor Bruto</th>
            <th>Status</th>
        </tr>
    </table>";

while($row = mysqli_fetch_array($consulta))
{
    echo
        "
        "
}
?>