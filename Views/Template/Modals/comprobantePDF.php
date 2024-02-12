<?php 
	$cliente = $data['cliente'];
	$orden = $data['orden'];
	$detalle = $data['detalle'];

	$nombreImagen =  media() . '/tienda/images/logo3.png';
	$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
 ?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		table{
			width: 100%;
		}
		table td, table th{
			font-size: 12px;
		}
		h4{
			margin-bottom: 0px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		.wd33{
			width: 33.33%;
		}
		.tbl-cliente{
			border: 1px solid #CCC;
			border-radius: 10px;
			padding: 5px;
		}
		.wd10{
			width: 10%;
		}
		.wd15{
			width: 15%;
		}
		.wd40{
			width: 40%;
		}
		.wd55{
			width: 55%;
		}
		.tbl-detalle{
			border-collapse: collapse;
		}
		.tbl-detalle thead th{
			padding: 5px;
			background-color: #009688;
			color: #FFF;
		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 5px;
		}
		.tbl-detalle tfoot td{
			padding: 5px;
		}
	</style>
</head>
<body>
	<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd33">
					<img src="<?php echo $imagenBase64 ?>" alt="Logo">
				</td>
				<td class="text-center wd33">
					<h4><strong><?= NOMBRE_EMPRESA ?></strong></h4>
					<p><?= DIRECCION ?> <br>
					Teléfono: <?= TELEMPRESA ?> <br>
					Email: <?= EMAIL_EMPRESA  ?></p>
				</td>
				<td class="text-right wd33">
					<p>No. Orden <strong><?= $orden['idPedido'] ?></strong><br>
						Fecha: <?= $orden['fecPedido'] ?>  <br>
						<?php 
							if($orden['idTipopago'] == 1){
						 ?>
						Método Pago: <?= $orden['desTipopago'] ?> <br>
						Transacción: <?= $orden['traPedido'] ?>
						<?php }else{ ?>
						Método Pago: Pago contra entrega <br>
						Tipo Pago: <?= $orden['desTipopago'] ?>
						<?php } ?>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tbl-cliente">
		<tbody>
			<tr>
				<td class="wd10">NIT:</td>
				<td class="wd40"><?= $cliente['idUsuario'] ?></td>
				<td class="wd10">Teléfono:</td>
				<td class="wd40"><?= $cliente['telUsuario'] ?></td>
			</tr>
			<tr>
				<td>Nombre:</td>
				<td><?= $cliente['nomUsuario'].' '.$cliente['apeUsuario'] ?></td>
				<td>Dirección:</td>
				<td><?= $cliente['dirUsuario'] ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tbl-detalle">
		<thead>
			<tr>
				<th class="wd55">Descripción</th>
				<th class="wd15 text-right">Precio</th>
				<th class="wd15 text-center">Cantidad</th>
				<th class="wd15 text-right">Importe</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				foreach ($detalle as $producto) {
					$importe = $producto['vtaBody'] * $producto['canBody'];
					$subtotal = $subtotal + $importe;
			 ?>
			<tr>
				<td><?= $producto['nomProducto'] ?></td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($producto['vtaBody']) ?></td>
				<td class="text-center"><?= $producto['canBody'] ?></td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($importe) ?></td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" class="text-right">Subtotal:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($subtotal) ?></td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Envío:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney(COSTOENVIO); ?></td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Total:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($orden['valPedido']); ?></td>
			</tr>
		</tfoot>
	</table>
	<div class="text-center">
		<p>Si tienes preguntas sobre tu pedido, <br> pongase en contacto con nombre, teléfono y Email</p>
		<h4>¡Gracias por tu compra!</h4>
	</div>
</body>
</html>