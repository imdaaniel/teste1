<?php
session_start();
if(isset($_SESSION['usuario'])){
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Login XML</title>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' />
  <link rel="stylesheet" href="css/style.css">

    

    <script>
      
        $(document).ready(function()
        {
            $('#errodiv').hide(); //hide
            
            var url = window.location.href;
            if(url.includes("failed"))
            {
                var arguments = url.split('?')[1].split('=');
                arguments.shift();
                if(arguments[0].includes("failed"))
                {   
                    $('#errodiv').fadeIn(300);
                    $('#x').on('click', function(){
                        $('#errodiv').hide(200);
                    });
                    
                    $('input').css({
                        'color': 'red',
                    });
                    setTimeout(function() {
                        $('#errodiv').fadeOut('slow');
                    }, 5000);
                }
            }
            
            $("#recuperarsenha").click(function()
            {
                //ajax aqui
                var pegacodigo = $("#codrecuperarsenha").val();
                $.ajax({
                    url : 'php/capturaemail.php',
                    data : {'codigo': pegacodigo},
                    type : 'GET',
                    success : function(resp)
                    {
                        //AQUI APARECE CAIXA
                        $("#mostraemail").html(resp);
                    },
                    error : function(resp)
                    {
                        alert(JSON.stringify(resp));
                    }
                });
            });
        });
    </script>

</head>

<body>
    <script>verificaconteudo();</script>
<div class="container">
  <div class="info">
  </div>
</div>
    <div id="errodiv">
        <div id="x">x</div>
        <p id="perro">Certifique-se de que os campos foram preenchidos corretamente e tente novamente</p>
      
    </div>
    
    
<div class="form">
    <div class="thumbnail"><!--<img src="img/XMLONELOGO.png"/>--></div>
    <div class="register-form formsumir">
        <input type="text" name="codigo" id="codrecuperarsenha" class="inputstyle" placeholder="Código" required/>
<!--
        <div id="msgforgot">
            <p id="msgforgotp">As informações de login foram enviadas para o email <span id="mostraemail">xxxxxxx@xmldigital.combr</span><br></p>
        </div>
-->
        <button id="recuperarsenha">Enviar informações para o meu e-mail</button>
        <p class="mensagem">Lembrou da senha? <a href="#">Entre</a></p>
    </div>
    <form class="login-form formsumir" action="php/login.php" method="post">
        <input type="text" placeholder="Código" name="codigo" class="inputstyle" required/>
        <input type="text" placeholder="Usuário" name="usuario" class="inputstyle" required/>
        <input type="password" placeholder="Senha" name="senha" class="inputstyle" required/>
        <button>Entrar</button>
        <p class="mensagem">Não lembra da senha? <a href="#">Clique aqui</a></p>
    </form>
</div>
    <div id="mandouemail">
        <div id="okemail">
            <div id="imgemail"><img src="img/envolopemail.png" style="width: 104px; height: 104px;"></div>    
        </div>
        <div id="msgokemail">
            <p id="titlemsgforgotp">E-mail enviado!</p>
            <p id="msgforgotp">As informações de login foram enviadas para o email <span id="mostraemail">xxxxxxx@xmldigital.com.br</span><br></p>
            <button id="btnmostraemail" class="hvr-float-shadow" value="Recarregar pagina" onClick="document.location.reload(true)"><p> FECHAR</p></button>

        </div>
    </div>

   

    <script src="js/index.js"></script>

</body>
</html>
