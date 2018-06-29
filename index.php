<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Notícias</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .page-header h2{
                margin-top: 0;
            }
            table tr td:last-child a{
                margin-right: 15px;
            }
        </style>
        <script type="text/javascript">
            window.onload = function(){
                document.getElementsByClassName('data-toggle="tooltip"').tooltip();
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Últimas Notícias</h2>
                            <a href="php/adicionar.php" class="btn btn-success pull-right">Adicionar</a>
                        </div>
                        <?php
                        //error_reporting(E_ERROR | E_PARSE);
                        
						function InsereTabelaBody($idx, $titulox, $slugx, $descricaox, $palavras_chavex)
						{
							echo "<tr>";
                                echo "<td>" . $idx . "</td>";
                                echo "<td>" . $titulox . "</td>";
                                echo "<td>" . $slugx . "</td>";
                                echo "<td>" . $descricaox . "</td>";
                                echo "<td>" . $palavras_chavex . "</td>";
                                echo "<td>";
									echo "<a href='php/visualizar.php?id=". $idx ."' title='Visualizar'><span class='glyphicon glyphicon-eye-open'></span></a>";
									echo "<a href='php/editar.php?id=". $idx ."' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>";
									echo "<a href='php/deletar.php?id=". $idx ."' title='Deletar'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                            echo "</tr>";
						}
                        
                        function Converter_utf8($array)
                        {
                            array_walk_recursive($array, function(&$item, $key){
                                if(!mb_detect_encoding($item, 'utf-8', true)){
                                    $item = utf8_encode($item);
                                }
                            });
                            return $array;
                        }

						ExecutaSQL1('0');
                        function ExecutaSQL1($id)
                        {
                            //Primeira execução
                            require 'php/config.php';

                            $contador = $qtdlinhas = 0;
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Título</th>";
                            echo "<th>Slug</th>";
                            echo "<th>Descrição</th>";
                            echo "<th>Palavras-chave</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            $query = "SELECT * FROM noticias where id > '$id' order by id";
                            if($result = mysqli_query($conexao, $query))
                            {
                                $qtdlinhas = mysqli_num_rows($result);
                                if($qtdlinhas == 0)
                                {
                                    echo "<p class='lead'><em>Nenhum registro encontrado.</em></p>";
                                    mysqli_free_result($result);
                                    mysqli_close($conexao);
                                }
                                else if($qtdlinhas > 0)
                                {
                                    $tabela = mysqli_fetch_array($result);
                                    $tabela = Converter_utf8($tabela);
                                    $id = $tabela['id'];
                                    InsereTabelaBody($id, $tabela['titulo'], $tabela['slug'], $tabela['descricao'], $tabela['palavras_chave']);
                                    $contador++;
                                    mysqli_free_result($result);
                                    mysqli_close($conexao);
                                    return ExecutaSQL2($id, $contador, $qtdlinhas);
                                }

                            }
                            else
                            {
                                echo "ERRO: Não foi possível executar ".$query.". " . mysqli_error($conexao);
                                mysqli_free_result($result);
                                mysqli_close($conexao);
                            }
                        }
                        function ExecutaSQL2($ultimoid, $contagem, $qtdlinhasx)
                        {
                            //2 (base para todas sucessivas)
                            require 'php/config.php';

                            $query = "SELECT * FROM noticias where id > '$ultimoid' order by id";
                            if($result = mysqli_query($conexao, $query))
                            {
                                if($contagem < $qtdlinhasx)
                                {
                                    $tabela1 = mysqli_fetch_assoc($result);
                                    $tabela1 = Converter_utf8($tabela1);
                                    $ultimoid = $tabela1['id'];
                                    InsereTabelaBody($ultimoid, $tabela1['titulo'], $tabela1['slug'], $tabela1['descricao'], $tabela1['palavras_chave']);
                                    $contagem++;
                                    mysqli_free_result($result);
                                    mysqli_close($conexao);
                                    return ExecutaSQL2($ultimoid, $contagem, $qtdlinhasx);
                                }
                            }
                            else
                            {
                                echo "ERRO: Não foi possível executar ".$query.". " . mysqli_error($conexao);
                                mysqli_free_result($result);
                                mysqli_close($conexao);
                            }
                        }
                        echo "</tbody>";
						echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>      
    </body>
</html>