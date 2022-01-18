<?php
	// Conexão com o banco de dados Postgree

	$host = 'localhost';
	$port = '5432';
	$dbname = 'DeMariaVendas';
	$user = 'postgres';
	$password = 'admin';

	$con = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

	if(!$con){
			echo "<h3>Erro no banco de dados, por favor contate o administrador.</h3>";
			exit;
		}
?>