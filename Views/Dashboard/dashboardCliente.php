<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][9]['reaPermiso'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/pedidos" class="linkw">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $data['pedidos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
     	<?php } ?>
      </div>
		
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][9]['reaPermiso'])){ ?>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Últimos Pedidos</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th class="text-right">Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($data['lastOrders']) > 0 ){
                      foreach ($data['lastOrders'] as $pedido) {
                 ?>
                <tr>
                  <td><?= $pedido['idPedido'] ?></td>
                  <td><?= $pedido['nombre'] ?></td>
                  <td><?= $pedido['estPedido'] ?></td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($pedido['valPedido']) ?></td>
                  <td><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idPedido'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>

		<div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Últimos Productos</h3>
              <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($data['productosTen']) > 0 ){
                      foreach ($data['productosTen'] as $producto) {
                 ?>
                <tr>
                  <td><?= $producto['idProducto'] ?></td>
                  <td><?= $producto['nomProducto'] ?></td>
                  <td><?= SMONEY. formatMoney($producto['vtaProducto']) ?></td>
                  <td><a href="<?= base_url() ?>/tienda/producto/<?= $producto['idProducto'].'/'.$producto['rutProducto'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por mes</h3>
              <div class="dflex">
                <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaMes"></div>
          </div>
        </div>
       </div>
    </main>
<?php footerAdmin($data); ?>

<script>

  Highcharts.chart('graficaMes', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Ventas de <?= $data['ventasMDia']['mes'].' del '.$data['ventasMDia']['anio'] ?>'
      },
      subtitle: {
          text: 'Total Ventas <?= SMONEY.'. '.formatMoney($data['ventasMDia']['total']) ?> '
      },
      xAxis: {
          categories: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['dia'].",";
                }
            ?>
          ]
      },
      yAxis: {
          title: {
              text: ''
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: [{
          name: 'Dato',
          data: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['total'].",";
                }
            ?>
          ]
      }]
  });

</script>
    