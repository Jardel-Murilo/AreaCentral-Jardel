<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produto</title>
</head>
<body>
<br>
<a href="index.php"><button>Listar produtos</button></a>
<a href="cadastrar.php"><button>Novo produto</button></a>
<br><br>
<form action="acao.php" method="post">
    <input readonly  type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>"><br>
    <input required=true   type="text" name="descricao" id="descricao" value="<?php if ($acao == "editar") echo $dados['descricao']; ?>" placeholder="Descrição"><br>
    <input required=true   type="text" name="valorUnitario" id="valorUnitario" value="<?php if ($acao == "editar") echo $dados['valorUnitario']; ?>" placeholder="Valor Unitário"><br>
    <input required=true   type="text" name="estoque" id="estoque" value="<?php if ($acao == "editar") echo $dados['estoque']; ?>" placeholder="estoque"><br>
    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
    <?php
    //var_dump($dados);
     ?>
</form>
</body>
</html>
