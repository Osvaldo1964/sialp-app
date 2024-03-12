<?php
headerAdmin($data);
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap&libraries=places&v=weekly&solution_channel=GMP_CCS_autocomplete_v1" defer></script>


<script src="<?= media() ?>/js/functions_map.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">

		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Registre su PQR</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Contact us</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<form id="frmPqrs">
			<div class="card">
				<div class="card-body row">
					<div class="col-4 text-center d-flex align-items-center justify-content-center">
						<div class="">
							<h3>SALP - <strong>PLATO</strong></h3>
							<p class="lead mb-5">Dirección<br>
								Teléfono: +57 303 123 4567
							</p>
						</div>
					</div>

					<div class="col-8">
						<div class="row">
							<div class="form-group col-6">
								<label for="nombrePqr">Nombres y Apellidos</label>
								<input type="text" id="nombrePqr" name="nombrePqr" class="form-control" />
							</div>
							<div class="form-group col-6">
								<label for="emailPqr">E-Mail</label>
								<input type="email" id="emailPqr" name="emailPqr" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label for="direccionPqr">Dirección </label>
							<input type="text" id="direccionPqr" name="direccionPqr" class="form-control" />
						</div>
						<div class="form-group">
							<label for="mensajePqr">Detalle de la PQR</label>
							<textarea id="mensajePqr" name="mensajePqr" class="form-control" rows="4"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Enviar">
						</div>
					</div>

				</div>
			</div>
		</form>
		<div class="card" style="height: 300px;">
			<div class="card-body row">
				<div class="col-7 alingn-self-center">
					<div style="height: 100%; width: 100%; position: relative" id="map" class="map"></div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php footerAdmin($data); ?>