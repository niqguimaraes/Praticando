<!-- Valor de vendas do mês -->
<div class="p-3 mt-sm-3 bg-success shadow text-white col rounded">
	<h5 class="font-weight-bold text-uppercase">Valor de vendas no mês</h5>
	<hr>
	<?php
	    $resultado = consultaVendasMes();
		$row = pg_fetch_row($resultado);
		echo "<h3 class='display-3'>R$ ".number_format($row[0],2,",",".")."</h3>";					
    ?>
    <div class="text-right">
    	<a class="btn btn-outline-light btn-sm" href="vendas.php">Ver todas as vendas</a>
    </div>
</div>