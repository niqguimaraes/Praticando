<?php
	//Chamando o arquivo de funcões
	require_once('funcoes.php');

	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID'])) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: index.php");
		exit;
	}

	// Verifica se os campos quais variáveis estão preenchidas e faz a busca ou o cadastro
	if(isset($_POST['busca_produto']) && ($_POST['busca_produto'] == "busca_produto")){ // Aqui faz a busca
		$nomeproduto = $_POST['produto'];
	    $resultado = consultaProdutos($nomeproduto);
	}else{
		if(isset($_POST['nomeproduto']) && isset($_POST['precocompra']) && isset($_POST['precovenda'])){ 
			// Aqui faz o cadastro
			cadastroProdutos($_POST['nomeproduto'], $_POST['precocompra'], $_POST['precovenda']);
			geraLog($_SESSION['UsuarioID'], 'Cadastrar produto', $_POST['nomeproduto']);
			echo "<script>window.alert('Produto cadastrado!');</script>";
		}
		$resultado = consultaTabela('*', 'produtos', 'nomeproduto');
	}

	//Deleta o registro da linha selecionada
	if (isset($_POST['deleta']) && ($_POST['deleta'] == "deleta")) {
		excluirDados('produtos', 'idproduto', $_POST['idproduto']);
		geraLog($_SESSION['UsuarioID'], 'Excluir produto', trim($_POST['descricao_produto']));
		echo "<script>javascript:alert('".trim($_POST['descricao_produto'])." excluído com sucesso!');</script>";
		$resultado = consultaTabela('*', 'produtos', 'nomeproduto');
	}
	//Fim do delete

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vendas</title>
  </head>
  <body class="bg-light">
    <!-- Section: NavBar -->
  	<?php
  		require_once('menu.html');
  	?>
	<!-- Section: NavBar -->

	<!-- Section: Produtos -->
	<section id="cadastro-produtos">
		<div class="d-flex justify-content-center align-items-center container bg-secondary mt-3 mb-3 rounded">
			<form class="container row pt-3" method="POST" action="">
				<div class="form-group col-4">
					<input type="text" class="form-control" placeholder="Nome do produto" name="nomeproduto" value="">
				</div>
				<div class="form-group col-3">
					<input type="number" class="form-control" placeholder="Preço de compra R$" name="precocompra" value="" step="0.01" name="quantity" min="0.01">
				</div>
				<div class="form-group col-3">
					<input type="number" class="form-control" placeholder="Preço de venda R$" name="precovenda" value="" step="0.01" name="quantity" min="0.01">
				</div>
				<button type="submit" class="btn btn-success form-group ml-1" name="cadastrar">Cadastrar</button>
				<button type="reset" class="btn btn-warning form-group ml-1">Limpar</button>
			</form>
		</div>
	</section>

	<!-- Quadro de produtos cadastrados -->
	<section id="lista-produtos">
		<div class="container justify-content-center shadow rounded">
			<div class="mb-3 d-flex">
				<div class="display-4">Produtos cadastrados</div>
				<form class="form-inline ml-auto" method="POST" id="consulta_produto" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="input-group">
						<input class="form-control" type="search" placeholder="Buscar produto" name="produto">
						<div class="input-group-append">
							<button class="btn btn-primary" type="submit" name="buscar">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="busca_produto" value="busca_produto">
				</form>
			</div>
			<div class="bg-primary p-2 mb-0 border row text-light">
				<div class="col-6 lead">Produto</div>
				<div class="col lead">Preço de compra</div>
				<div class="col lead">Preço de venda</div>
				<div class="col-1 lead">Excluir</div>
			</div>
			<div class="p-2 mt-0">
	    		<?php 
	    			while ($row = pg_fetch_row($resultado)) {?>
	    				<form id="deleta" name="form_deleta" method="POST" action="">
		    				<div class="border-bottom bg-white row">
			    				<?php 
			    					echo "<div class='col-6 p-2 pl-4 mb-1 lead' style='height: auto;'>$row[1]</div>";
			    					echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>R$ ".number_format($row[2],2,",",".")."</div>";
			    					echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>R$ ".number_format($row[3],2,",",".")."</div>";
			    					echo "<button class='col-1 btn btn-outline-danger btn-sm m-1' type='submit' name='deleta'><i class='fas fa-trash'></i></button>";
			    					echo "<input name='idproduto' type='hidden' value='$row[0]' />";
			    					echo "<input name='descricao_produto' type='hidden' value='$row[1]' />";
			    				?>
			    				<input type="hidden" name="deleta" value="deleta">
		    				</div>
		    			</form>
		    		<?php }    					
	    		?>
			</div>
		</div>
	</section>
	<!-- Section: Produtos -->

	<!-- Section: Footer -->
	<?php
  		require_once('rodape.html');
  	?>
	<!-- Section: Footer -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>