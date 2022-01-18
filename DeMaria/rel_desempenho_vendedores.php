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

	<!-- Section: Dashboard -->
	<section class="container">

		<!-- Produtos mais vendidos -->
		<?php
	  		require_once('desempenho_vendedores.php');
	  	?>
	  	<!-- Produtos mais vendidos -->
		
	</section>
	<!-- Section: Dashboard -->
	
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