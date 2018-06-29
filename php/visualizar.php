<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
{
    require_once 'config.php';
    
    $sql = "SELECT * FROM noticias WHERE id = ?";
    
    if($stmt = mysqli_prepare($conexao, $sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) == 1)
            {
                $tabela = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $titulo = $tabela['titulo'];
                $slug = $tabela['slug'];
                $descricao = $tabela['descricao'];
                $palavras_chave = $tabela['palavras_chave'];
                $conteudo = $tabela['conteudo'];
            }
            else
            {
                header("location: erro.php");
                exit();
            }
        }
        else
        {
            echo "Oops! Algo deu errado. Tente novamente mais tarde.";
        }
    }
    mysqli_close($conexao);
}
else
{
    header("location: erro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Visualizar</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 500px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>Visualizar</h1>
                        </div>
                        <div class="form-group">
                            <label>Título</label>
                            <p class="form-control-static"><?php echo $tabela["titulo"]; ?></p> 
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <p class="form-control-static"><?php echo $tabela["slug"]; ?></p> 
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <p class="form-control-static"><?php echo $tabela["descricao"]; ?></p> 
                        </div>
                        <div class="form-group">
                            <label>Palavras-chave</label>
                            <p class="form-control-static"><?php echo $tabela["palavras_chave"]; ?></p> 
                        </div>
                        <div class="form-group">
                            <label>Conteúdo</label>
                            <p class="form-control-static"><?php echo $tabela["conteudo"]; ?></p> 
                        </div>
                        <p><a href="../index.php" class="btn btn-primary">Voltar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>