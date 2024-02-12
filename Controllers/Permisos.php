<?php 
	class Permisos extends Controllers{
		public function __construct()
		{
			sessionStart();
			parent::__construct();
			//session_start();
			//session_regenerate_id(true);
            if (empty($_SESSION['login']))
            {
                header('location: ' . base_url() . '/login');
            }
		}

		public function getPermisosRol(int $idRol)
		{
			$idRol = intval($idRol);
			if($idRol > 0)
			{
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($idRol);
				$arrRol = $this->model->getRol($idRol); 
				$arrPermisos = array('reaPermiso' => 0, 'wriPermiso' => 0, 'updPermiso' => 0, 'delPermiso' => 0);
				$arrPermisoRol = array('idRol' => $idRol, 'rol' => $arrRol['nomRol'] );
				if(empty($arrPermisosRol))
				{
					for ($i=0; $i < count($arrModulos) ; $i++) { 
						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}else{
					for ($i=0; $i < count($arrModulos); $i++) {
						$arrPermisos = array('reaPermiso' => 0, 'wriPermiso' => 0, 'updPermiso' => 0, 'delPermiso' => 0);
						if (isset($arrPermisosRol[$i])){
						$arrPermisos = array('reaPermiso' => $arrPermisosRol[$i]['reaPermiso'], 
											 'wriPermiso' => $arrPermisosRol[$i]['wriPermiso'], 
											 'updPermiso' => $arrPermisosRol[$i]['updPermiso'], 
											 'delPermiso' => $arrPermisosRol[$i]['delPermiso'] 
											);
						}
						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}
				$arrPermisoRol['modulos'] = $arrModulos;
				$html = getModal("modalPermisos", $arrPermisoRol);
			}
			die();
		}

		public function setPermisos()
		{
			if($_POST)
			{
				$intidRol = intval($_POST['idRol']);
				$modulos = $_POST['modulos'];
				$this->model->deletePermisos($intidRol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idModulo'];
					$reaPermiso = empty($modulo['reaPermiso']) ? 0 : 1;
					$wriPermiso = empty($modulo['wriPermiso']) ? 0 : 1;
					$updPermiso = empty($modulo['updPermiso']) ? 0 : 1;
					$delPermiso = empty($modulo['delPermiso']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intidRol, $idModulo, $reaPermiso, $wriPermiso, $updPermiso, $delPermiso);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
 ?>