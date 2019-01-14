<?php
    require_once("connection/connection.php");

    //iniciar sessão
    session_start();

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP FUNDAMENTAL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <div id="header_central">
                <?php include_once("_incluir/topo.php"); ?>
            </div>
        </header>
        
        <main>
            <div id="janela_formulario">
                <form action="inserir_transportadora" method="POST">
                    <input type = "text" name = "nometransportadora" placeholder = "Nome da Transportadora">
                    <input type = "text" name = "endereco" placeholder = "Endereço">
                    <input type = "text" name = "telefone" placeholder = "Telefone">
                    <input type = "text" name = "cidade" placeholder = "Cidade">
                    <select name="estado">
                        <option></option>
                    </select>
                    <input type = "text" name = "cep" placeholder = "CEP">
                    <input type = "text" name = "cnpj" placeholder = "CNPJ">
                    <input type = "submit" value="inserir">
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