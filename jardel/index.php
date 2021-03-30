<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$radio = isset($_POST['radio']) ? $_POST['radio'] : 0;
?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</head>
<body style="background:#F0FFF0;">
    <a href="cadastrar.php"><button>Novo produto</button></a>
    <a href="produtosExcluidos.php"><button>Produtos Excluídos</button></a>
    <br><br>
    <form method="post">
    <input type="text" name="consulta" id="consulta" value="<?php echo $consulta; ?>"><br>
    <input type="submit" value="Pesquisar">
    </form>
    <br>
    <table border="1">
      <tr>
        <td><b>Código</b></td>
        <td><b>Descrição</b></td>
        <td><b>Valor Unitário</b></td>
        <td><b>Estoque</b></td>
        <td><b>Alterar</b></td>
        <td><b>Excluir</b></td>
      </tr>
    <?php
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM produto
                             WHERE descricao
                             LIKE '%$consulta%' or valorUnitario LIKE '%$consulta%' or estoque LIKE '%$consulta%';");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
      if ($linha['exclui'] == 1) {
        ?>

        <tr><td><?php echo $linha['codigo'];?></td>
            <td><?php echo $linha['descricao'];?></td>
            <td><?php echo $linha['valorUnitario'];?></td>
            <td><?php echo $linha['estoque'];?></td>
            <td><a href='cadastrar.php?acao=editar&codigo=<?php echo $linha['codigo'];?>'><button>EDITAR</button></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><button>EXCLUIR</button></a></td></tr>
    <?php }
  } ?>
    </table>
</body>
</html>
