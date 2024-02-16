<?php
	require_once("Models/TCliente.php");
	require_once("Models/LoginModel.php");

class Site extends Controllers
{
	use TCliente;
    public $login;
    public function __construct()
    {
        session_start();
        $this->login = new LoginModel();
        parent::__construct();
    }

    public function site()
    {
        $data['page_tag']   = NOMBRE_EMPRESA;
        $data['page_title'] = NOMBRE_EMPRESA;
        $data['page_name']  = "sialp";
        $data['page_content']  = "Loremsaslaslaslasl";
        $this->views->getView($this, "site", $data);
    }

		public function suscripcion(){
			if($_POST){
				$nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));
				$email  = strtolower(strClean($_POST['email']));
				$suscripcion = $this->setSuscripcion($nombre,$email);
				if($suscripcion > 0){
					$arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción.");
					//Enviar correo
					$dataUsuario = array('asunto' => "Nueva suscripción",
										'emailSender' => EMAIL_SUSCRIPCION,
										'nombreSuscriptor' => $nombre,
										'email' => $email );
					sendMailLocal($dataUsuario,"email_suscripcion");
				}else{
					$arrResponse = array('status' => false, 'msg' => "El email ya fue registrado.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function contacto(){
			if($_POST){
				$nombre = ucwords(strtolower(strClean($_POST['nombreContacto'])));
				$email  = strtolower(strClean($_POST['emailContacto']));
				$mensaje  = strClean($_POST['mensaje']);
				$useragent = $_SERVER['HTTP_USER_AGENT'];
				$ip        = $_SERVER['REMOTE_ADDR'];
				$dispositivo= "PC";

				if(preg_match("/mobile/i",$useragent)){
					$dispositivo = "Movil";
				}else if(preg_match("/tablet/i",$useragent)){
					$dispositivo = "Tablet";
				}else if(preg_match("/iPhone/i",$useragent)){
					$dispositivo = "iPhone";
				}else if(preg_match("/iPad/i",$useragent)){
					$dispositivo = "iPad";
				}

				$userContact = $this->setContacto($nombre,$email,$mensaje,$ip,$dispositivo,$useragent);
				if($userContact > 0){
					$arrResponse = array('status' => true, 'msg' => "Su mensaje fue enviado correctamente.");
					//Enviar correo
					$dataUsuario = array('asunto' => "Nueva Usuario en contacto",
										'nombreContacto' => $nombre,
										'email' => $email,
										'mensaje' => $mensaje );
					sendMailLocal($dataUsuario,"email_contacto");
				}else{
					$arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

			}
			die();
		}

		public function pqrs(){
			if($_POST){
 				$nombre = ucwords(strtolower(strClean($_POST['nombrePqr'])));
				$email  = strtolower(strClean($_POST['emailPqr']));
				$direccion  = strtolower(strClean($_POST['direccionPqr']));				
				$mensaje  = strClean($_POST['mensajePqr']);
				$coordenadas = $this->getGeocodeData($direccion);
				$latitud = $coordenadas[0];
				$longitud = $coordenadas[1];
				$newdireccion = $coordenadas[2];
				//dep($coordenadas);exit;
				?>
				<!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCSCrHOuiMHc2IXhjopcMni6uVPmC2rAKo"></script>  -->
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSCrHOuiMHc2IXhjopcMni6uVPmC2rAKo&callback=initMap"
						type="text/javascript">
				</script>
				<script type="text/javascript">
					let santamarta = { lat: <?php echo $latitud; ?>, lng: <?php echo $longitud; ?> };
					alert(santamarta);
					var options = {
						zoom: 14,
						center: new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map($("#map")[0], options);
					//map = new google.maps.Map(document.getElementById("map"), options);
					marker = new google.maps.Marker({
						map: map,
						position: new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>)
					});
					infowindow = new google.maps.InfoWindow({ content: "<?php echo $newdireccion; ?>" });
					marker.setMap(map);
					google.maps.event.addListener(marker, "click", function () { infowindow.open(map, marker); });
				</script>
			<?php
				$userContact = $this->setPqr($nombre,$email,$direccion, $mensaje);
 				if($userContact > 0){
					$arrResponse = array('status' => true, 'msg' => "Su mensaje fue enviado correctamente.");
				}else{
					$arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
 			}
			die();
		}

		function getGeocodeData($address) {
			$address = urlencode($address);
			$googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCSCrHOuiMHc2IXhjopcMni6uVPmC2rAKo";
			$geocodeResponseData = file_get_contents($googleMapUrl);
			$responseData = json_decode($geocodeResponseData, true);
			if($responseData['status']=='OK') {
			$latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
			$longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
			$formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
			if($latitude && $longitude && $formattedAddress) {
			$geocodeData = array();
			array_push(
			$geocodeData,
			$latitude,
			$longitude,
			$formattedAddress
			);
			return $geocodeData;
			} else {
			return false;
			}
			} else {
			echo "ERROR: {$responseData['status']}";
			return false;
			}
			}
}
