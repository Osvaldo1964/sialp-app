<script>
Highcharts.chart('cantPqrs', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'PQRs POR CONCEPTOS'
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
        foreach ($data['pqrs'] as $pagos) {
          $nombre = '';
          $nombre = $pagos['estPqrs'] == 1 ? 'Pendiente' : $nombre;
          $nombre = $pagos['estPqrs'] == 2 ? 'Asignada' : $nombre;
          $nombre = $pagos['estPqrs'] == 3 ? 'Resuelta' : $nombre;
          echo "{name:'" . $nombre . "',y:" . $pagos['total'] . "},";
        }
        ?>
      ]
    }]
  });
</script>