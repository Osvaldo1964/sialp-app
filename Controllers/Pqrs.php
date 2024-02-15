<?php 
	class Pqrs extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			getPermisos(MDPAGINAS);
		}

		public function pqrs()
		{
			$pageContent = getPageRout('pqrs');
			if(empty($pageContent)){
				header("Location: ".base_url());
			}else{
				$data['page_tag'] = NOMBRE_EMPRESA;
				$data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
				$data['page_name'] = $pageContent['titulo'];
				$data['page'] = $pageContent;
				$data['page_functions_js'] = "functions_map.js";
				$this->views->getView($this,"pqrs",$data);  
			}
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
?>