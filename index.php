<?php 
    $servidor = "localhost";
    $usuario = "root";
    $senha = "admin";
    $banco = "prefeitura";
    $conecta = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno()){
        die("Conexao Falhou ".mysqli_connect_errno());
    }
?>

<?php

    $nome=$_POST["NOME"];
    if(isset($_POST["NOME"])){
        $concluir="UPDATE teste SET status='SIM' WHERE NOME='$nome'";
        $operacao_concluir = mysqli_query($conecta,$concluir);

    }
    $palavra = trim($_POST['palavra']);

  
    $script="SELECT LOCALIDADE, NOME, NASCIMENTO, CPF, IDENTIDADE, LOG, ENDERECO, NUMERO, COMPLEMENTO, CEP, DATA, HORARIO, STATUS FROM teste ";
    $script.="WHERE NOME like '%".$palavra."%'";
    $listar = mysqli_query($conecta,$script);
    if(!$listar){
        die("Não foi possivel realizar listagem");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        tr td {
            width: 1%;
            white-space: nowrap;
        }
    </style>
    <title>Prefeitura</title>
</head>

<body class="bg-light">
    <div class="container">

        <div class="py-5 text-center">
            <h2>Formulário de Recebimento das Cestas</h2>
            <p class="lead">Aperte CRTL + L para localizar o beneficiário, não esqueça de sempre atualizar a pagina(F5)
                para atualizar as informações </p>

            <form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar">
                <div class="form-group">
                    <label for="localize">Localize</label>
                    <input type="text" class="form-control" id="localize" name="palavra">

                    <small id="localize" class="form-text text-muted">digite qualquer parte do nome para filtrar a
                        busca</small>
                </div>
                <input type="submit" class="btn btn-primary" value="Buscar" />
            </form>
        </div>


        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">LOCALIDADE</th>
                            <th scope="col">NOME</th>
                            <th scope="col">NASCIMENTO</th>
                            <th scope="col">CPF</th>
                            <th scope="col">IDENTIDADE</th>
                            <th scope="col">LOG</th>
                            <th scope="col">ENDERECO</th>
                            <th scope="col">NUMERO</th>
                            <th scope="col">COMPLEMENTO</th>
                            <th scope="col">CEP</th>
                            <th scope="col">DATA</th>
                            <th scope="col">HORARIO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($linha=mysqli_fetch_assoc($listar)){ ?>
                        <tr <?php if ($linha["STATUS"]=='SIM'){ echo 'class="table-danger"';} ?>> 
                            <td>
                                <?php echo $linha["LOCALIDADE"]?>
                            </td>
                            <td>
                                <?php echo $linha["NOME"]?>
                            </td>
                            <td>
                                <?php echo $linha["NASCIMENTO"]?>
                            </td>
                            <td>
                                <?php echo $linha["CPF"]?>
                            </td>
                            <td>
                                <?php echo $linha["IDENTIDADE"]?>
                            </td>
                            <td>
                                <?php echo $linha["LOG"]?>
                            </td>
                            <td>
                                <?php echo $linha["ENDERECO"]?>
                            </td>
                            <td>
                                <?php echo $linha["NUMERO"]?>
                            </td>
                            <td>
                                <?php echo $linha["COMPLEMENTO"]?>
                            </td>
                            <td>
                                <?php echo $linha["CEP"]?>
                            </td>
                            <td>
                                <?php echo $linha["DATA"]?>
                            </td>
                            <td>
                                <?php echo $linha["HORARIO"]?>
                            </td>
                            <td>
                                <?php echo $linha["STATUS"]?>
                            </td>
                            <td>
                                <form name="SIM" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=SIM">
                                    <input type='hidden' name='NOME' value='<?php echo $linha["NOME"] ?>'>
                                    <button d type="submit" name="SIM" value="SIM" class="btn btn-success" ><i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="SIM"></i>
                                </form>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>


</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

</html>