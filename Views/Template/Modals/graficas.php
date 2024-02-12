<?php 
	if($grafica = "tipoPagoMes"){
		$pagosMes = $data;
 ?>
<script>
	Highcharts.chart('pagosMesAnio', {
	      chart: {
	          plotBackgroundColor: null,
	          plotBorderWidth: null,
	          plotShadow: false,
	          type: 'pie'
	      },
	      title: {
	          text: 'Ventas por tipo pago, <?= $pagosMes['mes'].' '.$pagosMes['anio'] ?>'
	      },
	      tooltip: {
	          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	      },
	      accessibility: {
	          point: {
	              valueSuffix: '%'
	          }
	      },
	      plotOptions: {
	          pie: {
	              allowPointSelect: true,
	              cursor: 'pointer',
	              dataLabels: {
	                  enabled: true,
	                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
	              }
	          }
	      },
	      series: [{
	          name: 'Brands',
	          colorByPoint: true,
	          data: [
	          <?php 
	            foreach ($pagosMes['tipospago'] as $pagos) {
	              echo "{name:'".$pagos['desTipopago']."',y:".$pagos['total']."},";
	            }
	           ?>
	          ]
	      }]
	});
</script>
<?php } ?>

