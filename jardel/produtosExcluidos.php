<!DOCTYPE html>
<?php
include_once "acao.php";
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
 ?>
 <html>
 <head>
     <meta charset="UTF-8">
     <title></title>
     <script>
         function excluirRegistro(url) {
             if (confirm("Confirmar Restauração?"))
                 location.href = url;
         }
     </script>
 </head>
 <body>
  <h1>Excluídos</h1>
<table border="1">
  <tr>
    <td>codigo</td>
    <td>Descrição</td>
    <td>valor Unitário</td>
    <td>Estoque</td>
    <td>Restaurar</td>
  </tr>
  <?php
  $pdo = Conexao::getInstance();
  $consulta = $pdo->query("SELECT * FROM produto
                           WHERE exclui = 0;");

      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
          echo "<td>{$linha['codigo']}</td>";
          echo "<td>{$linha['descricao']}</td>";
          echo "<td>{$linha['valorUnitario']}</td>";
          echo "<td>{$linha['estoque']}</td>";
          echo "<td><center><button><a href='javascript:excluirRegistro(`acao.php?acao=excluir&codigo={$linha['codigo']}`)'>*</a></button></center></td>";
        echo "</tr>";
      }
    //}


   ?>
</table>
<hr>
<a href="index.php"><button>Página principal</button></a>
</body>
</html>
