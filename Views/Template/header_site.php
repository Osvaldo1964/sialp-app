<?php
	$tituloPreguntas = !empty(getInfoPage(PPREGUNTAS)) ? getInfoPage(PPREGUNTAS)['titulo'] : "";
	$infoPreguntas = !empty(getInfoPage(PPREGUNTAS)) ? getInfoPage(PPREGUNTAS)['contenido'] : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title><?= $data['page_tag'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= media() ?>/tienda/images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">
	<!-- Modal -->
	<div class="modal fade" id="modalAyuda" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?= $tituloPreguntas; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="page-content">
						<?= $infoPreguntas; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="divLoading">
		<div>
			<img src="<?= media(); ?>/images/loading.svg" alt="Loading">
		</div>
	</div>

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<?php if (isset($_SESSION['login'])) { ?>
							Bienvenido : <?= $_SESSION['userData']['nomUsuario'] . ' ' . $_SESSION['userData']['nomUsuario'] ?>
						<?php } ?>
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#modalAyuda">
							Ayuda y Preguntas frecuentes FAQs
						</a>

						<?php if (isset($_SESSION['login'])) { ?>
							<a href="<?= base_url() ?>/dashboard" class="flex-c-m trans-04 p-lr-25">
								Mi Cuenta
							</a>
						<?php } ?>

						<?php if (isset($_SESSION['login'])) { ?>
							<a href="<?= base_url() ?>/logout" class="flex-c-m trans-04 p-lr-25">
								Salir
							</a>
						<?php } else { ?>
							<a href="<?= base_url() ?>/login" class="flex-c-m trans-04 p-lr-25">
								Iniciar Sesión
							</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="<?= base_url() ?>" class="logo">
						<img src="<?= media() ?>/images/uploads/logo_icaruscol.jpg" alt="Icaruscol">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="<?= base_url() ?>">Inicio</a>
							</li>

							<li>
								<a href="<?= base_url() ?>/nosotros">Nosotros</a>
							</li>

							<li>
								<a href="<?= base_url() ?>/pqrs">Registro PQRs</a>
							</li>

							<li>
								<a href="<?= base_url() ?>/contacto">Contacto</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="<?= base_url() ?>"><img src="<?= media() ?>/images/uploads/logo_icaruscol.jpg" alt="Icaruscol"></a>
			</div>


			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<?php if (isset($_SESSION['login'])) { ?>
						Bienvenido : <?= $_SESSION['userData']['nomUsuario'] . ' ' . $_SESSION['userData']['nomUsuario'] ?>
					<?php } ?>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04" data-toggle="modal" data-target="#modalAyuda">
							Ayuda y Preguntas frecuentes FAQs
						</a>

						<?php if (isset($_SESSION['login'])) { ?>
							<a href="<?= base_url() ?>/dashboard" class="flex-c-m p-lr-10 trans-04">
								Mi Cuenta
							</a>
						<?php } ?>

						<?php if (isset($_SESSION['login'])) { ?>
							<a href="<?= base_url() ?>/logout" class="flex-c-m p-lr-10 trans-04">
								Salir
							</a>
						<?php } else { ?>
							<a href="<?= base_url() ?>/login" class="flex-c-m p-lr-10 trans-04">
								Iniciar Sesión
							</a>
						<?php } ?>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="<?= base_url() ?>">Inicio</a>
				</li>

				<li>
					<a href="<?= base_url() ?>/nosotros">Nosotros</a>
				</li>

				<li>
					<a href="<?= base_url() ?>/pqrs">Registro PQRs</a>
				</li>

				<li>
					<a href="<?= base_url() ?>/contacto">Contacto</a>
				</li>
			</ul>
		</div>
	</header>
