<?php
session_start();
if(isset($_SESSION['codigo']))
{
    $codigo = $_SESSION['codigo'];
    if(json_decode($_GET['tipo']) != null)
    {
        $tipox = json_decode($_GET['tipo']);
        UpdateSql($tipox);
    }
    
    function UpdateSql($tipo)
    {
        require('php/config.php');
        //$result = mysqli_query($con, "update config set trans_ecf = '$tipo' where codigo = '$codigo' limit 1;");
        
        if(mysqli_query($con, "update config set trans_ecf = '$tipo' where codigo = '$codigo' limit 1;"))
        {
            echo "<script>alert('Configurado com sucesso!')</script>";
        }
        else
        {
            echo "<script>alert('Erro ao configurar!')</script>";
        }
    }
}
else
{
    header("Location: index.php?msg=codigo");
}
?>
<html>
    <head>
        <meta charset="utf-8" lang="pt-br">
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Configurações</title>
		<script type="text/javascript">
            $(document).ready(function(){
                $("#transmissao").click(function(){
                    if($(this).is(':checked')){
                        ChamadaUpdate('1');
                    }else{
                        ChamadaUpdate('0');
                    }
                });
                
                function ChamadaUpdate($tipo){
                    $.ajax({
                        url : $(this).url,
                        data : {'tipo': $tipo},
                        type : 'GET',
                        success : function(resp)
                        {
                            //$("#conteudo").html(resp);
                            alert("Sucesso!");
                        },
                        error : function(resp)
                        {
                            alert(JSON.stringify(resp));
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
        <input type="checkbox" id="transmissao">Transmitir arquivo ECF
    </body>
</html>