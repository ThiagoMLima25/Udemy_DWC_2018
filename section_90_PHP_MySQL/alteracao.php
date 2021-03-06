<?php
    require_once("connection/connection.php");
    
    //iniciar sessão
    session_start();

    if(isset($_POST["nometransportadora"])){
        $nome = $_POST["nometransportadora"];
        $endereco = $_POST["endereco"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $cep = $_POST["cep"];
        $cnpj = $_POST["cnpj"];
        $telefone = $_POST["telefone"];
        $trID = $_POST["transportadoraID"];

        $update = "UPDATE transportadoras SET nometransportadora = '{$nome}', endereco = '{$endereco}', cidade = '{$cidade}', estadoID = {$estado}, cep = '{$cep}', cnpj = '{$cnpj}', telefone = '{$telefone}' WHERE transportadoraID = {$trID}";
        $operacaoUpdate = mysqli_query($con, $update);

        if(!$operacaoUpdate){
            die("Erro ao atualizar ao banco");
        }
    }

    //Consulta a tabela de transportadora
    $tr = "SELECT * FROM transportadoras ";
    
    if(isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $tr .= "WHERE transportadoraID = {$id}";
    }else{
        header("location:listagem.php");
    }

    $con_tr = mysqli_query($con, $tr);

    if(!$con_tr){
        die("Falha na busca ao banco");
    }

    $info_tr = mysqli_fetch_assoc($con_tr);
    
    //Consulta aos estados
    $estados = "SELECT * FROM estados";
    $listEstados =  mysqli_query($con, $estados);

    if(!$listEstados){
        die("Falha na busca ao banco");
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP FUNDAMENTAL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <div id="header_central">
                <?php include_once("_incluir/topo.php"); ?>
            </div>
        </header>
        
        <main>
           <div id="janela_formulario">
                <form action="alteracao.php" method="POST">
                    <h2>Alteração de Transportador</h2>
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" name="nometransportadora" id="nometransportadora" value="<?=utf8_encode($info_tr["nometransportadora"]) ?>">
                    <label for="endereco">Endereço</label>
                    <input type = "text" name = "endereco" placeholder = "Endereço" value="<?=utf8_encode($info_tr["endereco"]) ?>">
                    <label for="telefone">Telefone</label>
                    <input type = "text" name = "telefone" placeholder = "Telefone" value="<?=utf8_encode($info_tr["telefone"]) ?>">
                    <label for="cidade">Cidade</label>
                    <input type = "text" name = "cidade" placeholder = "Cidade" value="<?=utf8_encode($info_tr["cidade"]) ?>">
                    <label for="estado">Estado</label>
                    <select name="estado">
                        <?php
                            $meuEstado = utf8_encode($info_tr["estadoID"]);
                            
                            while($linha = mysqli_fetch_assoc($listEstados)){
                                $estadoDb = $linha["estadoID"];

                                if($meuEstado == $estadoDb){
                                    echo "<option value=". $linha["estadoID"] ." selected>". utf8_encode($linha["nome"]) ."</option>";
                                }else{
                                    echo "<option value=". $linha["estadoID"] .">". utf8_encode($linha["nome"]) ."</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="cep">CEP</label>
                    <input type = "text" name = "cep" placeholder = "CEP" value="<?=utf8_encode($info_tr["cep"]) ?>">
                    <label for="cnpj">CNPJ</label>
                    <input type = "text" name = "cnpj" placeholder = "CNPJ" value="<?=utf8_encode($info_tr["cnpj"]) ?>">
                    <input type = "hidden" name = "transportadoraID" value="<?=utf8_encode($info_tr["transportadoraID"]) ?>">

                    <input type = "submit" value="Atualizar">
                </form>
           </div>
        </main>

        <footer id="footer_central">
            <?php include_once("_incluir/rodape.php"); ?>
        </footer>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($con);
?>