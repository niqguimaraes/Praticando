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
	if(isset($_POST['comboProdutos']) && isset($_POST['quantidade']) ){ 
		// Aqui faz o cadastro
		$desc_venda = "Total de R$ " . $_POST['valorfinal'];
		cadastroVenda($_POST['produto'], $_SESSION['UsuarioID'], $_POST['valorfinal'], $_POST['quantidade']);
		geraLog($_SESSION['UsuarioID'], 'Efetuar venda', $desc_venda);
		echo "<script>window.alert('Venda realizada!')</script>";
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript">
    	
    </script>

    <title>Vendas</title>
  </head>
  <body class="bg-light" onload="soma()">
    <!-- Section: NavBar -->
  	<?php
  		require_once('menu.html');
  	?>
	<!-- Section: NavBar -->

	<!-- Section: Vendas -->
	<section id="cadastro-vendas" class="container">
		<div class="bg-secondary mt-3 rounded">
			<!-- Section: Form Vendas -->
			<form class="row pt-3 m-2" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group col-12">
					<select class="form-control" id="comboProdutos" name="comboProdutos">
						<option>Selecione um produto</option>
						<?php
							$lista_produtos = consultaTabela('*', 'produtos', 'nomeproduto');
							while ($row = pg_fetch_row($lista_produtos)) {
			    				echo "<option value='$row[3]' data-valor='$row[0]'>$row[0] - $row[1] - R$ ".number_format($row[3],2,",",".")."</option>";
							}
						?>
					</select>
    				<input type="hidden" id="produto" value="" name="produto">
				</div>
				<div class="form-group col-3">
					<input type="number" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade" max="99" min="0" value="">
				</div>
				<div class="form-group col-5 row">
					<h5 class="col-5 font-weight-bold text-uppercase text-white d-flex align-items-center">Valor total</h4>
					<input type="hidden" id="valorfinal" name="valorfinal" value="">
					<h3 id="valortotal" class="col-6 font-weight-bold text-uppercase text-warning d-flex align-items-center">R$ 0,00</h3>
				</div>
				<div class="form-group col d-flex justify-content-end">
					<button type="submit" class="btn btn-success form-group ml-1"><i class="fas fa-check"></i> Efetuar venda</button>
					<button type="reset" class="btn btn-warning form-group ml-1">Limpar</button>
				</div>
			</form>
		</div>
	</section>
	<!-- Section: Form Vendas -->

	<!-- Section: Lista Vendas -->
	<section class="container">
		<div class="mb-3">
			<?php
				require_once('vendas_totais.php');
			?>
		</div>
		<div class="container justify-content-center shadow rounded">
			<div class="display-4 mb-2">Total de vendas por dia</div>
			<div class="bg-primary p-2 mb-0 border row text-light">
				<div class="col-3 lead">Data da venda</div>
				<div class="col lead">Vendas no dia</div>
				<div class="col lead">Nº de produtos vendidos</div>
				<div class="col lead">Valor total das vendas</div>
			</div>
			<div class="p-2 mt-0">
	    		<?php 
	    			$lista_vendas = consultaVendas();
	    			while ($row = pg_fetch_row($lista_vendas)) {
	    				echo "<div class='border-bottom bg-white row'>";
	    				echo "<div class='col-3 p-2 pl-4 mb-1 lead' style='height: auto;'>".date('d/m/Y',strtotime($row[0]))."</div>";
	    				echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>$row[3]</div>";
	    				echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>$row[1]</div>";
	    				echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>R$ ".number_format($row[2],2,",",".")."</div>";
	    				echo "</div>";
					}    					
	    		?>
			</div>
		</div>
	</section>
	<!-- Section: Lista Vendas -->	

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