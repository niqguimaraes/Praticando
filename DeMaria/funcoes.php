<?php
	//Chamando o arquivo de conexão
	require_once('conexao.php');


	// Função para consulta no banco de dados
	function consultaTabela($campo, $tabela, $ordem){
		$consulta = "select " .$campo. " from " .$tabela. " order by " .$ordem. "";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaTabelaId($tabela, $id, $campo_id){
		$consulta = "select * from " .$tabela." where " +$id. " = " .$campo_id. "";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaVendasFuncionario($funcionario){
		$consulta = "select nomefuncionario, sum(valortotal) as total from detalhe_vendas, produtos, funcionarios where detalhe_vendas.idfuncionario = ".$funcionario." and detalhe_vendas.idproduto = produtos.idproduto and detalhe_vendas.idfuncionario = funcionarios.idfuncionario group by detalhe_vendas.idfuncionario, funcionarios.nomefuncionario order by total desc";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaVendasMes(){
		$consulta = "select sum(valortotal) as total from detalhe_vendas where date_part('month',data_venda) = date_part('month',now())";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function produtosMaisVendidos(){
		$consulta = "select nomeproduto, sum(quantidade) as totalProduto, precovenda from detalhe_vendas, produtos where detalhe_vendas.idproduto = produtos.idproduto group by detalhe_vendas.idproduto, nomeproduto, precovenda order by totalProduto desc limit 10";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaProdutos($produto){
		$consulta = "select * from produtos where nomeproduto like '".$produto."%'";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaVendedor($vendedor){
		$consulta = "select * from funcionarios where nomefuncionario like '".$vendedor."%'";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;	
	}

	function consultaVendas(){
		$consulta = "select data_venda, sum(quantidade), sum(valortotal), count(idvenda) as totalvendas from detalhe_vendas group by data_venda order by data_venda desc";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro na consulta.<br>";
			exit;
		} 
		return $query;
	}

	function cadastroProdutos($nomeproduto, $precocompra, $precovenda){
		$query = "insert into produtos (nomeproduto, precocompra, precovenda) values ('$nomeproduto','$precocompra', '$precovenda')";
	    $insert = pg_query($query);
	}

	function cadastroVendedor($nomevendedor, $usuario, $senha){
		$query = "insert into funcionarios (nomefuncionario, datacadastro, usuario, senha) values ('$nomevendedor', now(), '$usuario', md5('$senha'))";
	    $insert = pg_query($query);
	}

	function cadastroVenda($produto, $funcionario, $valortotal, $quantidade){
		$query = "insert into detalhe_vendas (idproduto, idfuncionario, valortotal, data_venda, quantidade) values ('$produto', '$funcionario', '$valortotal', now(), '$quantidade')";
	    $insert = pg_query($query);
	}

	function excluirDados($tabela, $id, $campo_id){
		$consulta = "delete from $tabela where $id = $campo_id";
		$query = pg_query($consulta);
		if (!$query) {
			echo "Erro ao excluir os dados.<br>";
			exit;
		} 
		return $query;
	}

	function geraLog($id_funcionario, $acao_log, $desc_log){
		$query = "insert into log (id_funcionario, acao_log, data_log, descricao_log) values ('$id_funcionario', '$acao_log', now(), '$desc_log')";
		$insert = pg_query($query);
	}
?>