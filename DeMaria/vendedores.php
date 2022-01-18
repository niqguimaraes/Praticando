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
	if(isset($_POST['vendedor'])){ // Aqui faz a busca
		$nomevendedor = $_POST['vendedor'];
	    $resultado = consultaVendedor($nomevendedor);
	}else{
		if(isset($_POST['nomevendedor']) && isset($_POST['usuariologin']) && isset($_POST['senhalogin'])){ // Aqui faz o cadastro
			cadastroVendedor($_POST['nomevendedor'], $_POST['usuariologin'], $_POST['senhalogin']);
			geraLog($_SESSION['UsuarioID'], 'Cadastrar vendedor', $_POST['nomevendedor']);
			echo "<script>window.alert('Vendedor cadastrado!'); history.back(-2);</script>";
		}
		$resultado = consultaTabela('*', 'funcionarios', 'nomefuncionario');
	}

	//Deleta o registro da linha selecionada
	if (isset($_POST['deleta']) && ($_POST['deleta'] == "deleta")) {
		if ($_SESSION['UsuarioID'] == $_POST['idfuncionario']) {
			echo "<script>javascript:alert('Não é possível excluir o usuário logado!');</script>";
		}else{
			geraLog($_SESSION['UsuarioID'], 'Excluir vendedor', $_POST['usuario']);
			excluirDados('funcionarios', 'idfuncionario', $_POST['idfuncionario']);
			echo "<script>javascript:alert('".trim($_POST['usuario'])." excluído com sucesso!'); </script> </script>";
		}
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

	<!-- Section: Vendedores -->
	<section id="cadastro-vendedores">
		<div class="d-flex justify-content-center align-items-center container bg-secondary mt-3 mb-3 rounded">
			<form class="container row pt-3" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group col-4">
					<input type="text" class="form-control" placeholder="Nome do vendedor" name="nomevendedor" value="">
				</div>
				<div class="form-group col-3">
					<input type="text" class="form-control" placeholder="Usuário de login" maxlength="20" name="usuariologin" value="">
				</div>
				<div class="form-group col-3">
					<input type="password" class="form-control" placeholder="Senha de login" maxlength="12" name="senhalogin" value="">
				</div>
				<button type="submit" class="btn btn-success form-group ml-1" name="cadastrar">Cadastrar</button>
				<button type="reset" class="btn btn-warning form-group ml-1">Limpar</button>
			</form>
		</div>
	</section>

	<!-- Quadro de vendedores cadastrados -->
	<section id="lista-vendedores">
		<div class="container justify-content-center shadow rounded">
			<div class="mb-3 d-flex">
				<div class="display-4">Vendedores cadastrados</div>
				<form class="form-inline ml-auto" method="POST" id="consulta_vendedor" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="input-group">
						<input class="form-control" type="search" placeholder="Buscar vendedor" name="vendedor">
						<div class="input-group-append">
							<button class="btn btn-primary" type="submit" name="buscar">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="bg-primary p-2 mb-0 border row text-light">
				<div class="col-6 lead">Nome</div>
				<div class="col lead">Usuário</div>
				<div class="col-1 lead">Excluir</div>
			</div>
			<div class="p-2 mt-0">
	    		<?php 
	    			while ($row = pg_fetch_row($resultado)) {?>
	    				<form id="deleta" name="form_deleta" method="POST" action="">
		    				<div class="border-bottom bg-white row">
			    				<?php 
				    				echo "<div class='col-6 p-2 pl-4 mb-1 lead' style='height: auto;'>$row[1]</div>";
				    				echo "<div class='col p-2 pl-4 mb-1 lead' style='height: auto;'>$row[3]</div>";
				    				echo "<button class='col-1 btn btn-outline-danger btn-sm m-1' type='submit' name='deleta'><i class='fas fa-trash'></i></button>";
				    				echo "<input name='idfuncionario' type='hidden' value='$row[0]' />";
			    					echo "<input name='usuario' type='hidden' value='$row[1]' />";
				    			?>
			    				<input type="hidden" name="deleta" value="deleta">
		    				</div>
		    			</form>
		    		<?php }    					
	    		?>
			</div>
		</div>
	</section>
	<!-- Section: Vendedores -->

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