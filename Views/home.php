<?php
	headerSite($data);
	//$arrSlider = $data['slider'];
	//$arrBanner = $data['banner'];
	//$arrProductos = $data['productos'];
	$contentPage = "";
	if (!empty($data['page'])) {
		$contentPage = $data['page']['contenido'];
	}
?>
<!-- Slider -->
<section class="section-slide">
	<div class="wrap-slick1">
		<div class="slick1">
		</div>
	</div>
</section>

<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
	<div class="container">
		<div class="row">
		</div>
	</div>
</div>

<div class="container text-center p-t-80">
	<hr>
	<?= $contentPage ?>
</div>
</section>
<?php
footerSite($data);
?>