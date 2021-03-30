<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }elseif ($acao == "estrela"){
      $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
      estrela($codigo);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO produto (descricao,valorUnitario,estoque) VALUES(:descricao,:valorUnitario,:estoque);');
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':valorUnitario', $valorUnitario, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
        $descricao = $dados['descricao'];
        $valorUnitario = $dados['valorUnitario'];
        $estoque = $dados['estoque'];
        $stmt->execute();
        header("location:cadastrar.php");
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE produto SET descricao = :descricao, valorUnitario = :valorUnitario, estoque = :estoque WHERE codigo = :codigo');
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->bindParam(':valorUnitario', $valorUnitario, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
        $descricao = $dados['descricao'];
        $codigo = $dados['codigo'];
        $valorUnitario = $dados['valorUnitario'];
        $estoque = $dados['estoque'];
        $stmt->execute();
        header("location:index.php");
    }
    /*function volta($codigo){
      $pdo = Conexao::getInstance();
      $consulta = $pdo->query("SELECT exclui FROM produto WHERE codigo = $codigo;");
      $volta = $consulta->fetch(PDO::FETCH_ASSOC);
      if($volta['exclui']==1)
      $stmt = $pdo->prepare('UPDATE produto SET exclui = 0 WHERE codigo = :codigo;');
      else
      $stmt = $pdo->prepare('UPDATE produto SET exclui = 1 WHERE codigo = :codigo;');
      $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
      $codigoD = $codigo;
      $stmt->execute();
      header("location:index.php");
    }*/

    function excluir($codigo){
      $pdo = Conexao::getInstance();
      $consulta = $pdo->query("SELECT exclui FROM produto WHERE codigo = $codigo;");
      $volta = $consulta->fetch(PDO::FETCH_ASSOC);
      if($volta['exclui']==1)
      $stmt = $pdo->prepare('UPDATE produto SET exclui = 0 WHERE codigo = :codigo;');
      else
      $stmt = $pdo->prepare('UPDATE produto SET exclui = 1 WHERE codigo = :codigo;');
      $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
      $codigoD = $codigo;
      $stmt->execute();
      header("location:index.php");
    }

    // Busca um item pelo código no BD
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM produto WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['descricao'] = $linha['descricao'];
            $dados['valorUnitario'] = $linha['valorUnitario'];
            $dados['estoque'] = $linha['estoque'];

        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['descricao'] = $_POST['descricao'];
        $dados['valorUnitario'] = $_POST['valorUnitario'];
        $dados['estoque'] = $_POST['estoque'];
        return $dados;
    }

?>
