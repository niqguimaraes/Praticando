<div class="row justify-content-center d-none d-sm-block shadow">
    <div class="p-3 mt-sm-5 bg-dark col-12 rounded">
    	<h5 class="font-weight-bold text-uppercase text-white">Produtos mais vendidos</h5>
    	<hr>
    	<div class="container bg-primary text-light mb-1">
			<div class="row">
				<div class="col-sm p-3 lead">
					Produto
				</div>
				<div class="col-sm p-3 lead">
					Quantidade
				</div>
				<div class="col-sm p-3 lead">
					Valor unitário
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
	    		<?php 
	    			$resultado = produtosMaisVendidos();
	    			while ($row = pg_fetch_row($resultado)) {
	    				echo "<div class='col-sm-4 p-3 mb-1 lead bg-light' style='height: auto;'>$row[0]</div>";
	    				echo "<div class='col-sm-4 p-3 mb-1 lead bg-light' style='height: auto;'>$row[1]</div>";
	    				echo "<div class='col-sm-4 p-3 mb-1 lead bg-light' style='height: auto;'>R$ ".number_format($row[2],2,",",".")."</div>";
					}
    					
	    		?>
    		</div>
    	</div>
    </div>
</div>