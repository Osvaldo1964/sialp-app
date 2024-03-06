<?php
headerAdmin($data);
//dep($data);exit;
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
    </ul>
  </div>
  <div class="row">
    <?php if (!empty($_SESSION['permisos'][2]['reaPermiso'])) { ?>
      <div class="col-md-6 col-lg-3">
        <a href="<?= base_url() ?>/usuarios" class="linkw">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Usuarios</h4>
              <p><b><?= $data['usuarios'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>

    <?php if (!empty($_SESSION['permisos'][6]['reaPermiso'])) { ?>
      <div class="col-md-6 col-lg-3">
        <a href="<?= base_url() ?>/elementos" class="linkw">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
            <div class="info">
              <h4>ELEMENTOS UCAPs</h4>
              <p><b><?= $data['elementos'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <div class="container-title">
          <h3 class="tile-title">PQRS por Estado</h3>
          <div class="dflex">
            <input class="date-picker pagoMes" name="pqrsMes" placeholder="Mes y Año" autocomplete="off">
            <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPqrs()"> <i class="fas fa-search"></i> </button>
          </div>
        </div>
        <div id="cantPqrs"></div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="tile">
        <div class="container-title">
          <h3 class="tile-title">UCAPs por Grupo</h3>
          <!--               <div class="dflex">
                <input class="date-picker pagoMes" name="pagoMes" placeholder="Mes y Año" autocomplete="off">
                <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"> <i class="fas fa-search"></i> </button>
              </div> -->
        </div>
        <div id="ucapsGrupo"></div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>

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
        foreach ($data['pqrs']['pqrs'] as $pagos) {
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

  Highcharts.chart('ucapsGrupo', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'PQRs por Estado'
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
        foreach ($data['clases'] as $pagos) {
          echo "{name:'" . $pagos['desClase'] . "',y:" . $pagos['total'] . "},";
        }
        ?>
      ]
    }]
  });
</script>