<div class="row justify-content-center">
    <div class="p-3 mt-sm-5 bg-white shadow col-12 rounded">
        <h5 class="font-weight-bold text-uppercase">Desempenho de vendas por vendedor</h5>
        <hr>
            <?php 
                $num_rows = pg_num_rows(consultaTabela('*', 'funcionarios', 'nomefuncionario'));
                for ($i=1; $i <= $num_rows; $i++) {
                    $resultado = pg_fetch_row(consultaVendasFuncionario($i));
                    $porc = $resultado[1] / 5;
                    if($resultado[1] > 0){
                        echo '<div class="graficos-barras mb-2 p-2 text-white rounded lead" style="height: auto; max-width: 100%; width:'.$porc.'%;">'.$resultado[0].' - R$ '.number_format($resultado[1],2,",",".").'</div>';
                    }
                }
            ?>
    </div>
</div>