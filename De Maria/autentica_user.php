<?php

	$login = $_POST['login'];
	$senha = md5($_POST['senha']);

	// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
	/*if (!empty($_POST) AND (empty($login) OR empty($senha))) {
		echo "Erro";
		header("Location: index.php");
		exit;
	}*/

	//Chamando o arquivo de conexão
	require_once('conexao.php');

	// Validação do usuário/senha digitados
	$sql = "select idfuncionario, usuario, senha, nomefuncionario from funcionarios where usuario = '$login' and senha = '$senha' limit 1";
	$query = pg_query($sql);

	if (pg_num_rows($query) != 1) {
		// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
		echo "<script>window.alert('Login inválido!'); history.back(-2);</script>";
		exit;
	} else {
		// Salva os dados encontados na variável $resultado
		$resultado = pg_fetch_assoc($query);
	}

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['idfuncionario'];
	$_SESSION['UsuarioNome'] = $resultado['nomefuncionario'];

	// Redireciona o visitante
	header("Location: principal.php");
?>
