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
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap&libraries=places&v=weekly&solution_channel=GMP_CCS_autocomplete_v1"
      defer
    ></script>

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
<?php 
	footerSite($data);
?>