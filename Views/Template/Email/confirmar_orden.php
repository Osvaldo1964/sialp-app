<?php
    $orden = $data['pedido']['orden'];
    $detalle = $data['pedido']['detalle'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Orden</title>
	<style type="text/css">
		p{
			font-family: arial;letter-spacing: 1px;color: #7f7f7f;font-size: 12px;
		}
		hr{border:0; border-top: 1px solid #CCC;}
		h4{font-family: arial; margin: 0;}
		table{width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #CCC; border-spacing: 0;}
		table tr td, table tr th{padding: 5px 10px;font-family: arial; font-size: 12px;}
		#detalleOrden tr td{border: 1px solid #CCC;}
		.table-active{background-color: #CCC;}
		.text-center{text-align: center;}
		.text-right{text-align: right;}

		@media screen and (max-width: 470px) {
			.logo{width: 90px;}
			p, table tr td, table tr th{font-size: 9px;}
		}
	</style>
</head>
<body>
	<div>
		<br>
		<p class="text-center">Se ha generado una orden, a continuación encontrarás los datos.</p>
		<br>
		<hr>
		<br>
		<table>
			<tr>
				<td width="33.33%">
					<img class="logo" src="<?= media(); ?>/tienda/images/icons/logo-01.png" alt="Logo">
				</td>
				<td width="33.33%">
					<div class="text-center">
						<h4><strong><?= NOMBRE_EMPRESA ?></strong></h4>
						<p>
                            <?= DIRECCION ?> <br>
							Teléfono: <?= TELEMPRESA ?> <br>
							Email: <?= EMAIL_EMPRESA ?>
						</p>
					</div>
				</td>
				<td width="33.33%">
					<div class="text-right">
						<p>
							No. Orden: <strong><?= $orden['idPedido'] ?></strong><br>
                            Fecha: <?= $orden['fecPedido'] ?> <br>
                            <?php
                                if ($orden['frmPedido'] == 1){
                            ?>
									Método Pago: <?= $orden['frmPago'] ?> <br>
									Transacción: <?= $orden['traPedido'] ?>
                            <?php }else{ ?>
									Método Pago: Pago contra entrega <br>
									Transacción: <?= $orden['frmPedido'] ?>
                            <?php } ?>
						</p>
					</div>
				</td>				
			</tr>
		</table>
		<table>
			<tr>
		    	<td width="140">Nombre:</td>
		    	<td><?= $_SESSION['userData']['nomUsuario'] . ' ' . $_SESSION['userData']['apeUsuario'] ?></td>
		    </tr>
		    <tr>
		    	<td>Teléfono</td>
		    	<td><?= $_SESSION['userData']['telUsuario'] ?></td>
		    </tr>
		    <tr>
		    	<td>Dirección de envío:</td>
		    	<td><?= $_SESSION['orden']['envPedido'] ?></td>
		    </tr>
		</table>
		<table>
		  <thead class="table-active">
		    <tr>
		      <th>Descripción</th>
		      <th class="text-right">Precio</th>
		      <th class="text-center">Cantidad</th>
		      <th class="text-right">Importe</th>
		    </tr>
		  </thead>
		  <tbody id="detalleOrden">
			<?php
				if (count($detalle) > 0){
					$subtotal = 0;
					foreach ($detalle as $producto){
			?>
		    <tr>
		      <td>Teclado USB</td>
		      <td class="text-right">100</td>
		      <td class="text-center">2</td>
		      <td class="text-right">200</td>
		    </tr>
			<?php }
				} ?>
		  </tbody>
		  <tfoot>
		  		<tr>
		  			<th colspan="3" class="text-right">Subtotal:</th>
		  			<td class="text-right">200</td>
		  		</tr>
		  		<tr>
		  			<th colspan="3" class="text-right">Envío:</th>
		  			<td class="text-right">10</td>
		  		</tr>
		  		<tr>
		  			<th colspan="3" class="text-right">Total:</th>
		  			<td class="text-right">200</td>
		  		</tr>
		  </tfoot>
		</table>
		<div class="text-center">
			<p>Si tienes preguntas sobre tu pedido, <br>pongase en contacto con nombre, teléfono y Email</p>
			<h4>¡Gracias por tu compra!</h4>			
		</div>
	</div>									
</body>
</html>