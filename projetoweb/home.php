<?php
session_start();
if(!isset($_SESSION['usuario']))
{
    header("Location: index.php?msg=usuario");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>XML Digital | Painel</title>
    <!-- AREA DE SCRIPTS -->
    <link href="css/homestyle.css" rel="stylesheet">
    <link rel="stylesheet" href="css/w3css.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900" rel="stylesheet">
     <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>
        function carregaDiv(pagina)
        {
            $("#conteudo").load(pagina);
        }
    </script>

</head>
<body onload="carregaDiv('propaganda/propaganda.html');"> 
    <script rel="stylesheet">
       ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }
    </script>
    <script type="text/javascript">
        function w3_open() {
            document.getElementById("conteudo").style.width = "80%";
            document.getElementById("main").style.marginLeft = "20%";
            document.getElementById("mySidebar").style.width = "20%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = "none";

        }
        function w3_close() {
            document.getElementById("conteudo").style.width = "100%";
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "block";
        }
        
        $(document).ready(function()
        {
            var codigox = "<?php print($_SESSION['codigo']); ?>";
            $("#ecfver").click(function()
            {    
                $.ajax({
                    url : 'php/mostratabela_ecf.php',
                    data : {},
                    type : 'GET',
                    success : function(resp)
                    {
                        if(resp == null){
                            alert('vazio');
                        }else{
                            $("#conteudo").html(resp);    
                        }
                        
                    },
                    error : function(resp)
                    {
                        alert(JSON.stringify(resp));
                    }
                });
            });
        
            $('.nomeusuario').text("<?php print ($_SESSION['nomebreve']); ?>");
            
            $("#logotipomenu").click(function()
            {
                $("#conteudo").load('propaganda/propaganda.html');
            });
            
            $( "#notificationbutton" ).click(function() {
                $( "#notificationbar" ).slideToggle( "slow", function() {
                    // Animation complete.
                });
            });
        });
        
    </script>
    
    <div id="header">
        <div id="logotipomenu"><p><b>XML</b>ONE</p></div>
        <div id="menubutton"><button id="openNav" type="button" onclick="w3_open()">&#9776;</button></div>
        <div id="envolvesubmenu">    
            <ul>
                <a id="notificationbutton"><li>notificação</li></a>
                <a href="php/logout.php" id="btnsair"><li>Sair</li></a>
                <li>Bem vindo, <span class="nomeusuario"></span></li>
            </ul>
        </div>
    </div>
    
    <div class="notificationbar" id="effect">
        <p>
            <a href="#">
                <i class="fa fa-users text-aqua"></i> 10 novas notas de entrada este mês
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fa fa-warning text-yellow"></i> Algumas notas do mês 03 estão zeradas
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fa fa-users text-red"></i> 5 novas notas de saida neste mês
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fa fa-shopping-cart text-green"></i> 25 novas vendas
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fa fa-user text-red"></i> Você assinou com a XML Digital
            </a>
        </p>
    </div>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div id="perfil">
            <div id="fotoperfil"></div>
            <div id="informacoesperfil">
                <span class="nomeusuario" id="nomeusuariostyle"></span>
                <p id="cnpjcliente">CNPJ 17.748.267/0001-64</p>
            </div>
        </div>
        <p id="pmenu">MENU DE NAVEGAÇÃO</p>
        <a href="#" class="buttonmenu" id="ecfver">ECF</a>
        <a href="#" class="buttonmenu">NFE</a>
        <a href="#" class="buttonmenu">SAT</a>
        <a href="#" class="buttonmenu">NFC-e</a>
        <a href="#" class="buttonmenu">NFS-e</a>
        <button class="buttonx hvr-sweep-to-right" onclick="w3_close()">&times;</button>
    </div>

    <div id="main">
        
        <div class="w3-container" id="conteudo"></div>
        
    </div>
</body>
</html>
