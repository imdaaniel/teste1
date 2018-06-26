<?php
session_start();
if(!isset($_SESSION['codigo']))
{
    header("Location: index.php?msg=codigo");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--    <script type="text/javascript" src="../js/funcoes.js"></script>-->
    <style type="text/css">
    @charset utf-8
 #container{
            width: 900px;
            height: 300px;
            background-color: aquamarine;
            font-family: 'Roboto', sans-serif;
            
        }


        h1{
            font-size: 30px;
            color: #000;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
        }
        table{
            width:100%;
            min-width: 70%;
            max-width: 100%;
            table-layout: fixed;
        }
        .tbl-header{
            background-color: #547A82;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 3px 3px 0 0;
         }
        .tbl-content{
            height:300px;
            overflow-x:auto;
            margin-top: 0px;
            background-color: #D7DAE0;
            border-radius: 0 0 3px 3px;
        }
        .tbl-headerpop{
            background-color: #547A82;
            border-radius: 0 0 0 0;
            border-top: 1px solid rgb(255, 255, 255, 0.5);
         }
        .tbl-contentpop{
            height:300px;
            overflow-x:auto;
            margin-top: 0px;
            background-color: #D7DAE0;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 0 0 3px 3px;
        }

        th{
            padding: 20px ;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
            
        }
        td{
            padding: 15px;
            text-align: left;
            vertical-align:middle;
            font-weight: 300;
            font-size: 12px;
            color: #000;
            border-bottom: solid 2px rgba(255,255,255,0.1);
            white-space: normal;
        }
        .clienteestilo:hover{
            background-color: #D0D0D0;
            transition: 0.25s;
            cursor: pointer;
        }
        /*-----------------TABELA 1-------------- */
        #tabela1{
            margin-top: 80px;
        }
        
        .tdcliente{
            width: 70%;
        }
        .thcliente{
            width: 70%;
        }
        #tdvalor{
            width: 30%;
        }
        #thvalor{
            width: 30%;
        }
        
        .icoecfstatus{
            width: 15px;
            height: 15px;
            background-color: red;
        }
        /*-----------------TABELA 3-------------- */
        #tdcodigo{
            width: 12%;
            
        }
        #thcodigo{
            width: 12%;
            
        }
        #tdtrans{
            width: 12.5%;
            
        }
        #thtrans{
            width: 12.5%;
            
        }
        #tdgrav{
            width: 12.5%;
            
        }
        #thgrav{
            width: 12.5%;
            
        }
        #tdstatusico{
            width: 7%;
            
        }
        #thstatusico{
            width: 7.5%;
        }
        #tdempresa{
            width: 14.28%;
        }
        #thempresa{
            width: 14.28%;
        }
        #tdprotocolo{
            width: 15.5%;
            
        }
        #thprotocolo{
            width: 15.5%;
            
        }
        #tdarq{
            width: 8%;
            
        }
        #tharq{
            width: 8%;
            
        }
        
        #tdalertas{
            width: 14.28%;
        }
        #thalertas{
            width: 14.28%;
        }
        #tdstatus{
            width: 14.28%;
            
        }
        #thstatus{
            width: 14.28%;
            
        }
        #tdlote{
            width: 11%;
            
        }
        #thlote{
            width: 11%;
            
        }
        #okimg{
            width: 15px;
            height: 15px;
            background-image:url("../img/ecf/ok.png");
        }
        #alertaimg{
            width: 15px;
            height: 15px;
            background-image:url("../img/ecf/alerta.png");
        }
        #erroimg{
            width: 15px;
            height: 15px;
            background-image:url("../img/ecf/erro.png");
        }
        
        .sumir{
            display: none;
        }
        .maquinaestilo:hover{
            background-color: #A2A2A2;
            transition: 0.25s;
        }
        
        .style-maquina{
            padding: 20px ;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
            background-color: #0F3E83;
        }
        .style-colunamaquina{
            background-color: #CACACA;
            color: #000000;
            cursor: pointer;
            
        }
        
        .style-colunamaquina1:hover{
            cursor: pointer;
            background: -webkit-linear-gradient(left, #A2A2A2, #CACACA);
            transition: 0.5s;
        }
        
        #fundopoptabela{
            display:none;
            position: absolute;
            background-color: rgb(0,0,0,0.5);
            width: 100%;
            height:100%;
        }
        #poptabela{
            display:none;
            position:absolute;
            top:50%;
            left:50%;
            margin-left:-450px;
            margin-top:-200px;
            padding:10px;
            width:900px;
            height:500px;
          
        }
        
        #menupoptabela{
            width: 100%;
            height: 28px;
            background-color: #547A82;
            border-radius: 5px 5px 0 0;
            
            
        }
        
        a{
            text-decoration: none;
        }
        
        #x{
            float: right;
            padding-top: 5px;
            padding-right: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 17px;
            color: #FFFFFF;
            cursor: pointer;
            
        }
        
        .nomemenupop {
            font-family: 'Roboto', sans-serif;
            color: white;
            font-size: 15px;
            margin: 0;
            margin-left: 5px;
            padding: 5px;
            position: absolute;
            
        }
        
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{

          background: -webkit-linear-gradient(left, #031023, #08254F);
          background: linear-gradient(to right, #031023, #08254F);
          font-family: 'Roboto', sans-serif;
        }
        section{
            margin-top: 9%;
            width: 100%;
        }



        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }
        
        
        .window{
            display:none;
            width:80%;
            height:500px;
            position:absolute;
            left:0;
            top:0;
            z-index:9900;
            padding:10px;
            border-radius:10px;
        }
 
        #mascara{
            display:none;
            position:absolute;
            left:0;
            top:0;
            z-index:9000;
            background-color:#000;
        }

        .fechar{display:block; text-align:right;}
        
    </style>
    <script type="text/javascript">   
        $(document).ready(function()
        {
            CapturaPeriodo();
            var datasValidas = false;
            $("#botaofiltrar").click(function()
            {
                //alert('clicou filtrar');
                var datainicial = $("#datainicial").val();
                var datafinal = $("#datafinal").val();
                
                if ((VerificaData(datainicial) == true) && (VerificaData(datafinal) == true)){
                    datasValidas = true;
                }
                //alert(datainicial + " | " + datafinal);
                if(datasValidas == true){
                    var diai = datainicial.substring(0, 2);               
                    var mesi = datainicial.substring(3, 5);
                    var anoi = datainicial.substring(6, 10);
                    
                    var diaf = datafinal.substring(0, 2);  
                    var mesf = datafinal.substring(3, 5);
                    var anof = datafinal.substring(6, 10);
                    
                    var datainicialformatada = anoi + "-" + mesi + "-" + diai;
                    var datafinalformatada = anof + "-" + mesf + "-" + diaf;
//                  alert(datainicialformatada + " | " + datafinalformatada);
                    $.ajax({
                        type : 'GET',
                        url : 'php/mostratabela_ecf.php',
                        data : {'dtinicial': datainicialformatada, 'dtfinal': datafinalformatada},
                        success : function(resp)
                        {
                            if(resp == null){
                                 alert('erro');
                            }else{
//                                alert('sucesso');
                                $("#conteudo").html(resp);    
                            }
                        },
                        error : function(resp)
                        {
                            alert(JSON.stringify(resp));
                        }
                    });
                }else{
                    alert("Data inválida!");
                }
            });    
        });
    </script>
</head>
<body>
    <script type="text/javascript">
        function TransformData(e, o) {
            var keyCode = (e.keyCode ? e.keyCode : (e.which ? e.which : e.charCode));
            
            if (keyCode == 47) { // 47 == /
                return false;
            }
            
            if (keyCode == 13) {
                e.returnValue = false;
                e.cancel = true;
                e.cancelBubble = true;
                return false;
            }
            
            if (keyCode == 37 || keyCode == 8 || keyCode == 36 || keyCode == 46 || keyCode == 16 || keyCode == 9)
                return;
            
            if (keyCode == 111 || keyCode == 191) {
                if (o.value.trim().length == 3 || o.value.trim().length == 6) {
                    return;
                }
                if (o.value.trim().length == 4 || o.value.trim().length == 7) {
                    var newpos = o.value.length - 1;
                    o.value = o.value.substring(0, newpos);
                    return;
                }
            }
            
            if (o.value.trim().length == 2 || o.value.trim().length == 5) {
                o.value = o.value.trim() + "/";
                return;
            }
        }
        
        function CapturaPeriodo(){
            var data = new Date();
            var diafinalatual = null;
            var mesatual = data.getMonth() + 1;
            var anoatual = data.getFullYear();
            
            if(mesatual == 1){ // fevereiro
                if(anoBissexto(anoatual) == true){
                    diafinalatual = 29;
                }else{
                    diafinalatual = 28;
                }
            }
            else if((mesatual == 4) || (mesatual == 6) || (mesatual == 9) || (mesatual == 11)){ 
                diafinalatual = 30; // abril, junho, setembro e novembro
            }
            else{
                diafinalatual = 31;
            }
            
            if(mesatual < 10){
                mesatual = "0" + mesatual;
            }
            
            //$('#spandatainicial').text("01/" + mesatual + "/" + anoatual);
            //$('#spandatafinal').text(diafinalatual + "/" + mesatual + "/" + anoatual);
        }         
        
        function anoBissexto(ano) {
            return new Date(ano, 1, 29).getMonth() == 1
        }
        
        function a(){
            alert("osi");
        }
        
        //VALIDAÇÃO DA DATA#//#####################
        function VerificaData(cData){
            var data = cData;
            var tam = data.length;
            
            if (tam != 10){
                return false;
            }
            
            var dia = data.substr(0,2)
            var mes = data.substr (3,2)
            var ano = data.substr (6,4)
            
            if (ano < 1980){
                return false;
            }
            
            if (ano > 2100){
                return false;
            }
            
            switch (mes){
                case '01':
                    if  (dia <= 31)
                        return (true);
                    break;  
                case '02': 	 
                    if  (dia <= 29) 
                        return (true);
                    break; 
                case '03': 
                    if  (dia <= 31) 
                        return (true);
                    break; 
                case '04': 
                    if  (dia <= 30)  
                        return (true); 	
                    break; 
                case '05': 	
                    if  (dia <= 31)   
                        return (true); 	
                    break; 
                case '06': 
                    if  (dia <= 30)
                        return (true); 
                    break; 
                case '07': 	
                    if  (dia <= 31)  
                        return (true); 	
                    break;  
                case '08': 	
                    if  (dia <= 31)    
                        return (true); 	
                    break;
                case '09': 	
                    if  (dia <= 30)   
                        return (true); 	
                    break; 
                case '10': 
                    if  (dia <= 31)  
                        return (true); 
                    break;  
                case '11': 	
                    if  (dia <= 30)   
                        return (true); 	
                    break; 
                case '12': 	
                    if  (dia <= 31)  
                        return (true); 	
                    break;	
            }	
            {
                return false;	
            }	
            return true; 
        }
    </script>
    <?php
    //echo "<p style='color: white;'>oi</p>";
    
    $codigo = $_SESSION['codigo'];
    
    require('config.php');      
    
    if(isset($_GET['dtinicial']))
    {
        $datainicial = $_GET['dtinicial'];
        $datafinal = $_GET['dtfinal'];
        
        $result = mysqli_query($con, "select nome_arquivo, DATE_FORMAT(data_mvto,'%d/%m/%Y'), data_trans, protocolo, qtd_cfs, valor_lote, status, idstatus from ecf where cod_cliente = '$codigo' and data_mvto >= '$datainicial' and data_mvto <= '$datafinal' order by data_mvto;");
    }  
    else
    {
        $result = mysqli_query($con, "select nome_arquivo, DATE_FORMAT(data_mvto,'%d/%m/%Y'), data_trans, protocolo, qtd_cfs, valor_lote, status, idstatus from ecf where cod_cliente = '$codigo' and data_mvto >= '2018-01-01' and data_mvto <= '2018-12-31' order by data_mvto;");
    }
    
    echo
        "<section>
        <div id='filtro'>
        <p style='color: white'>
        Data Inicial: <span id='spandatainicial'></span>
        <br>
        Data Final: <span id='spandatafinal'></span>
        <p>
        <input type='text' id='datainicial' onkeypress='TransformData(event, this);' maxlength='10' minlength='10' placeholder='Data Inicial'>
        <input type='text' id='datafinal' onkeypress='TransformData(event, this);' maxlength='10' placeholder='Data Final'>
        <button type='submit' id='botaofiltrar'>Filtrar</button>
        </p>
        </div>
        <div class='tbl-header'>
        <table cellpadding='0' cellspacing='0' border='0'>
        <thead>
        <tr>
        <th id='thcodigo'>Nome do Arquivo</th>
        <th id='thtrans'>Data Movimento</th>
        <th id='thgrav'>Data Transmissão</th>
        <th id='thprotocolo'>Protocolo</th>
        <th id='tharq'>Qtd. CFs</th>
        <th id='thlote'>Valor liquido</th>
        <th id='thstatus'>Retorno</th>
        <th id='thstatusico'>Status</th>
        </tr>
        </thead>
        </table>
        </div>
        <div class='tbl-content'>
        <table cellpadding='0' cellspacing='0' border='0'>
        <tbody>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo
            "<tr>
            <td id='tdcodigo'>". $row['nome_arquivo'] ."</td>
            <td id='tdtrans'>". $row["DATE_FORMAT(data_mvto,'%d/%m/%Y')"] ."</td>
            <td id='tdgrav'>". $row['data_trans'] ."</td>
            <td id='tdprotocolo'>". $row['protocolo'] ."</td>
            <td id='tdarq'>". $row['qtd_cfs'] ."</td>
            <td id='tdlote'>". $row['valor_lote'] ."</td>
            <td id='tdstatus'>". $row['status'] ."</td>";
        if($row['idstatus'] == "1")
        {
            echo "<td id='tdstatusico'><div id='okimg'></div></td></tr>";
        }
        else if($row['idstatus'] == "2")
        {
            echo "<td id='tdstatusico'><div id='alertaimg'></div></td></tr>";
        }
        else if($row['idstatus'] == "3")
        {
            echo "<td id='tdstatusico'><div id='erroimg'></div></td></tr>";
        }
        else if($row['idstatus'] == "4")
        {
            echo "<td id='tdstatusico'>TESTE</td></tr>";
        }
        else if($row['idstatus'] == "0")
        {
            echo "<td id='tdstatusico'>FALHA</td></tr>";
        }
        else
        {
            echo "<td id='tdstatusico'>ERRO</td></tr>";
        }
        //<th>Valor do Lote</th>
        //<td>". $row['valor_lote'] ."</td>
    }
    echo
        "</tbody>
        </table>
        </div>
        </section>
        </table>";
    mysqli_close($con);
    ?>
</body>
</html>