<?php
headerAdmin($data);
?>
<!-- Content Wrapper. Contains page content -->
<br>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<script src="<?= media() ?>/js/functions_map.js"></script>
	<div class="app-title">
		<div>
			<h2 style="padding-left: .5cm;"><i class="fa-solid fa-people-group"></i> <?= $data['page_title'] ?>
				<?php if ($_SESSION['permisosMod']['wriPermiso']) { ?>
					<button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus"></i> Nueva Cuadrilla</button>
				<?php } ?>
			</h2>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>/cuadrillas"><?php echo $data['page_title'] ?></a></li>
		</ul>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap&libraries=places&v=weekly&solution_channel=GMP_CCS_autocomplete_v1" defer></script>

			

			<!-- Content page -->
			<section class="bg0 p-t-90 p-b-116">
				<div class="container">
					<div class="flex-w flex-tr">
						<div class="size-210 bor8 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
							<form id="frmPqrs">
								<h4 class="mtext-105 cl2 txt-center p-b-30">
									Registro de PQR
								</h4>
								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="nombrePqr" name="nombrePqr" placeholder="Nombre completo">
									<img class="how-pos4 pointer-none" src="<?= media() ?>/site/images/icons/icon-name.png" alt="ICON" style="width: 28px;">
								</div>

								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="emailPqr" name="emailPqr" placeholder="Correo electrónico">
									<img class="how-pos4 pointer-none" src="<?= media() ?>/site/images/icons/icon-email.png" alt="ICON">
								</div>

								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="direccionPqr" name="direccionPqr" placeholder="Dirección de Reporte">
									<img class="how-pos4 pointer-none" src="<?= media() ?>/site/images/icons/icon-email.png" alt="ICON">
								</div>

								<div class="bor8 m-b-30">
									<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" id="mensajePqr" name="mensajePqr" placeholder="Registre una breve descripción del problema"></textarea>
								</div>

								<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
									Enviar
								</button>
							</form>
						</div>

						<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
							<div id="map"></div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footerAdmin($data); ?>