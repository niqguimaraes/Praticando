<?php
	//Chamando o arquivo de funcões
	require_once('funcoes.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   	<!-- Bootstrap CSS -->
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Estilo próprio -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

	
    <title>Vendas</title>
  </head>
  <body class="bg-light">
    <div class="d-flex h-100 justify-content-center align-items-center p-4">
		<form action="autentica_user.php" method="POST">
			<div class="m-4 text-center">
				<img src="img/perfil.png">
			</div>
			<div class="form-group">
				<div class="input-group mb-1">
			    	<div class="input-group-prepend">
			        	<div class="input-group-text"><img src="img/icone-usuario.png"></div>
			        </div>
			        <input type="text" name="login" class="form-control" placeholder="Digite seu login">
			    </div>
				<div class="input-group mb-1">
			    	<div class="input-group-prepend">
			        	<div class="input-group-text"><img src="img/icone-cadeado.png"></div>
			        </div>
			        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha">
			    </div>
			</div>
			<input type="submit" class="btn btn-primary btn-lg w-100" value="Login">
		</form>
	</div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>
