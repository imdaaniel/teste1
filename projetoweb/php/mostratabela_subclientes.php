<?php
session_start();
if(!isset($_SESSION['codigo']))
{
    header("Location: index.php?msg=codigo");
}

$codigo = $_SESSION['codigo'];

require('config.php');

$result = mysqli_query($con, "select sub from subclientes where codigo = '$codigo';");

echo
    "<table>
        <tr>
            <th id='thnomesub'>Cliente</th>
            <th id='thqtdarquivos'>Qtd. Arquivos</th>
            <th id='thqtdcupons'>Qtd. Cupons</th>                    
            <th id='thqtdmaquinas'>Qtd. Máq</th>
            <th id='thtotalmaquinas'>Total Máq.</th>
            <th id='thvalorliquido'>R$ Líquido</th>
        </tr>
    </table>";
    
while($tabelaresult = mysqli_fetch_array($result))
{
    $subcodigo = $tabelaresult['sub'];
    
    $resultmaq = mysqli_query($con, "select count(nome) as qtdmaq from maquinas_ecf where codigo = '$subcodigo';");
    $tabelamaq = mysqli_fetch_array($resultmaq);
    $qtdmaquinas = $tabelamaq['qtdmaq'];
    
    $resultsub = mysqli_query($con, "select cd.razao_social, count(ecf.cod_cliente) as qtdarquivos, sum(ecf.qtd_cfs) as qtdcfs, count(distinct ecf.maquina) as qtdmaq, sum(ecf.valor_lote) as valortotal from clientes_dados as cd join ecf on cd.codigo = ecf.cod_cliente where cd.codigo = '$subcodigo';");
    $tabelasub = mysqli_fetch_array($resultsub);
    
    echo
    "<tr>
        <td id='tdnomesub'>".       $tabelasub['razao_social']  ."</td>
        <td id='tdqtdarquivos'>".   $tabelasub['qtdarquivos']   ."</td>
        <td id='tdqtdcupons'>".     $tabelasub['qtdcfs']        ."</td>
        <td id='tdqtdmaquinas'>".   $tabelasub['qtdmaq']        ."</td>
        <td id='tdtotalmaquinas'>". $qtdmaquinas                ."</td>
        <td id='tdvalorliquido'>".  $tabelasub['valortotal']    ."</td>
    </tr>";
}
?>