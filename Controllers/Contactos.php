<?php 

	class Contactos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDCONTACTOS);
		}

		public function Contactos()
		{
			if(empty($_SESSION['permisosMod']['reaPermiso'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Contactos";
			$data['page_title'] = "CONTACTOS <small>SALP APP</small>";
			$data['page_name'] = "contactos";
			$data['page_functions_js'] = "functions_contactos.js";
			$this->views->getView($this,"contactos",$data);
		}

		public function getContactos(){
			if($_SESSION['permisosMod']['reaPermiso']){
				$arrData = $this->model->selectContactos();
				for ($i=0; $i < count($arrData) ; $i++) { 
					$btnView = '';
					if($_SESSION['permisosMod']['reaPermiso']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idContacto'].')" title="Ver mensaje"><i class="far fa-eye"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getMensaje($idmensaje){
			if($_SESSION['permisosMod']['reaPermiso']){
				$idmensaje = intval($idmensaje);
				if($idmensaje > 0){
					$arrData = $this->model->selectMensaje($idmensaje);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
?>