<?php
	headerTienda($data);
	//$banner = media()."/tienda/images/bg-01.jpg";
	$banner = $data['page']['portada'];
	$idpagina = $data['page']['idpost'];
?>
<script>
	document.querySelector('header').classList.add('header-v4');
</script>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
	<h2 class="ltext-105 cl0 txt-center">
		<?= $data['page']['titulo'] ?>
	</h2>
</section>
<!-- Content page -->

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Marker</title>
    <!-- The callback parameter is required, so we use console.debug as a noop -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSCrHOuiMHc2IXhjopcMni6uVPmC2rAKo&callback=console.debug&libraries=maps,marker&v=beta">
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      gmp-map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
	<div class="map col-md-6" id="map" style="height: 100px; width: 100px"></div>
		<gmp-map center="11.24604320526123,-74.2092514038086" zoom="14" map-id="DEMO_MAP_ID">
		<gmp-advanced-marker position="11.24604320526123,-74.2092514038086" title="My location"></gmp-advanced-marker>
		</gmp-map>
	</div>
  </body>
 <html>


<?php
	if (viewPage($idpagina)) {
		echo $data['page']['contenido'];
	} else {
?>
	<div>
		<div class="container-fluid py-5 text-center">
			<img src="<?= media() ?>/images/construction.png" alt="En construcción">
			<h3>Estamos trabajando para usted.</h3>
		</div>
	</div>
<?php
	}
	footerSite($data);
?>