<?php
	$_SESSION['UsuarioID'] = null;
	// empty($null_variable) is true but isset($null_variable) is also true so using unset too as a safeguard for further codes
	unset($_SESSION['UsuarioID']);
	// Note that the script continues running since it may be a part of an ajax request and the rest handled in the client side.
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login

	header("Location: index.php");
	exit;
?>