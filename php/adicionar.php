<?php
session_start();
function criaslug($string)
{
    // substitui o que nao for letra ou digito por -
    $string = preg_replace('~[^\pL\d]+~u', '-', $string);

    // converte pra utf8
    $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

    // remove caracteres estranhos
    $string = preg_replace('~[^-\w]+~', '', $string);

    // trim (remove espaços em branco no inicio e no fim)
    $string = trim($string, '-');

    // remove - duplicados
    $string = preg_replace('~-+~', '-', $string);

    // deixa tudo minúsculo
    $string = strtolower($string);

    if (empty($string)) {
      return 'sem slug';
    }

    return $string;
}

require_once 'config.php';

$titulo = $descricao = $palavras_chave = $conteudo = "";
$titulo_erro = $slug_erro = $descricao_erro = $palavras_chave_erro = $conteudo_erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //Valida Título
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo))
    {
        $titulo_erro = "Por favor, insira um título válido.";
    }
    else
    {
        $titulo = $input_titulo;
    }
    
    //Cria Slug
    $slug = criaslug($titulo);
    
    //Valida Descrição
    $input_descricao = trim($_POST["descricao"]);
    if(empty($input_descricao))
    {
        $descricao_erro = "Por favor, insira uma descrição válida.";
    }
    else
    {
        $descricao = $input_descricao;
    }
    
    //Valida Palavras-chave
    $input_palavras_chave = trim($_POST["palavraschave"]);
    if(empty($input_palavras_chave))
    {
        $palavras_chave_erro = "Por favor, insira palavras-chave válidas.";
    }
    else
    {
        $palavras_chave = $input_palavras_chave;
        //$palavras_chave = preg_replace(" ", ";", $palavras_chave);
    }
    
    //Valida Conteúdo
    $input_conteudo = trim($_POST["conteudo"]);
    if(empty($input_conteudo))
    {
        $conteudo_erro = "Por favor, insira um conteúdo válido.";
    }
    else
    {
        $conteudo = $input_conteudo;
    }
    
    //Verifica tudo antes de inserir no banco de dados
    //STMT evita Injeção SQL, reduz o tempo de análise e reduz também a largura de banda para o servidor (transferencia menor)
    if(empty($titulo_erro) && empty($slug_erro) && empty($descricao_erro) && empty($palavras_chave_erro) && empty($conteudo_erro))
    {
        $sql = "INSERT INTO noticias (titulo, slug, descricao, palavras_chave, conteudo) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($conexao, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssss", $param_titulo, $param_slug, $param_descricao, $param_palavras_chave, $param_conteudo);
            
            $param_titulo = $titulo;
            $param_slug = $slug;
            $param_descricao = $descricao;
            $param_palavras_chave = $palavras_chave;
            $param_conteudo = $conteudo;
            
            if(mysqli_stmt_execute($stmt))
            {
                //Gravado com sucesso
                header("location: ../index.php");
                exit();
            }
            else
            {
                echo "Algo deu errado. Tente novamente mais tarde.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Adicionar Notícia</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 500px;
                margin: 0 auto;
            }
        </style>
        <script type="text/javascript">
		function ContaRestantes(id, span, qtd){
			var campotexto=document.getElementById(id);
			var caracteresRestantes=document.getElementById(span);
			caracteresRestantes.innerHTML=(qtd-campotexto.value.length);
		}
		</script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Adicionar notícia</h2>
                        </div>
                        <p>Preencha os campos e clique em Adicionar para salvar sua notícia.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($titulo_erro)) ? 'has-error' : ''; ?>">
                                <label>Título</label>
                                <input type="text" name="titulo" id="txttitulo" class="form-control" maxlength="128" onkeydown="ContaRestantes(this.id, 'spantitulo', 128);" value="<?php echo $titulo; ?>" required>
								<br>
								Caracteres restantes: <span id="spantitulo"></span>
								<br>
                                <span class="help-block"><?php echo $titulo_erro; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($descricao_erro)) ? 'has-error' : ''; ?>">
                                <label>Descrição</label>
                                <textarea name="descricao" id="txtdescricao" class="form-control" maxlength="256" onkeydown="ContaRestantes(this.id, 'spandescricao', 256);" style="resize: none; height: 180px;" value="<?php echo $descricao; ?>" required></textarea>
                                <br>
								Caracteres restantes: <span id="spandescricao"></span>
								<br>
                                <span class="help-block"><?php echo $descricao_erro; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($palavras_chave_erro)) ? 'has-error' : ''; ?>">
                                <label>Palavras-chave (separadas por ;)</label>
                                <input type="text" name="palavraschave" id="txtpalavraschave" class="form-control" maxlength="256" onkeydown="ContaRestantes(this.id, 'spanpalavraschave', 256);" value="<?php echo $palavras_chave; ?>" required>
                                <br>
								Caracteres restantes: <span id="spanpalavraschave"></span>
								<br>
                                <span class="help-block"><?php echo $palavras_chave_erro; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($conteudo_erro)) ? 'has-error' : ''; ?>">
                                <label>Conteúdo</label>
                                <textarea name="conteudo" id="txtconteudo" class="form-control" maxlength="4096" onkeydown="ContaRestantes(this.id, 'spanconteudo', 4096);" style="resize: none; height: 300px;" value="<?php echo $conteudo; ?>" required></textarea>
                                <br>
								Caracteres restantes: <span id="spanconteudo"></span>
								<br>
                                <span class="help-block"><?php echo $conteudo_erro; ?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Adicionar">
                            <a href="../index.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>