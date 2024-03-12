<?php
headerSite($data);
$banner = $data['page']['portada'];
$idpagina = $data['page']['idpost'];
?>
<script>
	document.querySelector('header').classList.add('header-v4');
</script>
<!-- Title page -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap"
		type="text/javascript">
</script>
 -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap&libraries=places&v=weekly&solution_channel=GMP_CCS_autocomplete_v1" defer></script>

<script src="<?= media() ?>/js/functions_map.js"></script>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
	<h2 class="ltext-105 cl0 txt-center">
		<?= $data['page']['titulo'] ?>
	</h2>
</section>
<!-- Content page -->

<!-- Content page -->
<section class="bg0 p-t-90 p-b-116">
	<div class="container">
		<div class="flex-w flex-tr">
			<div class="row">
				<div class="size-210 bor8 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form id="frmPqrs">
						<div class="card">
							<div class="card-body row">
								<div class="col-5 text-center d-flex align-items-center justify-content-center">
									<div class="">
										<h2>MUNICIPIO DE <strong>PLATO</strong></h2>
										<p class="lead mb-5">Dirección del Municipio<br>
											Telefono: +57 302 3023895
										</p>
									</div>
								</div>
								<div class="col-7">
									<div class="form-group">
										<label for="nombrePqr">Nombres:</label>
										<input type="text" id="nombrePqr" name="nombrePqr" class="form-control" />
									</div>
									<div class="form-group">
										<label for="emailPqr">E-Mail</label>
										<input type="email" id="emailPqr" name="emailPqr" class="form-control" />
									</div>
									<div class="form-group">
										<label for="direccionPqr">Dirección</label>
										<input type="text" id="direccionPqr" name="direccionPqr" class="form-control" />
									</div>
									<div class="form-group">
										<label for="mensajePqr">Detalle del Reporte</label>
										<textarea id="mensajePqr" name="mensajePqr" class="form-control" rows="4"></textarea>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Enviar">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div id="map"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
footerSite($data);
?>