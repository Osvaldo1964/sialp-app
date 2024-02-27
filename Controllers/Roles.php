<?php

class Roles extends Controllers
{
	public function __construct()
	{
		sessionStart();
		parent::__construct();
		//session_start();
		//session_regenerate_id(true);
		if (empty($_SESSION['login'])) {
			header('location: ' . base_url() . '/login');
		}
		getPermisos(2);
	}

	public function Roles()
	{
		if (empty($_SESSION['permisosMod']['reaPermiso'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_id'] = 3;
		$data['page_tag'] = "Roles Usuario";
		$data['page_title'] = "Roles Usuario <small> SALP - APP </small>";
		$data['page_name'] = "rol_usuario";
		$data['page_functions_js'] = "functions_roles.js";
		$this->views->getView($this, "roles", $data);
	}

	public function getRoles()
	{
		if ($_SESSION['permisosMod']['reaPermiso']) {
			$arrData = $this->model->selectRoles();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				if ($arrData[$i]['estRol'] == 1) {
					$arrData[$i]['estRol'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['estRol'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				if ($_SESSION['permisosMod']['updPermiso']) {
					$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos(' . $arrData[$i]['idRol'] . ')" title="Permisos"><i class="fas fa-key"></i></button>';
					$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol(' . $arrData[$i]['idRol'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['delPermiso']) {
					$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol(' . $arrData[$i]['idRol'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getSelectRoles()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estRol'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idRol'] . '">' . $arrData[$i]['nomRol'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function getRol(int $idRol)
	{
		if ($_SESSION['permisosMod']['reaPermiso']) {
			$intidRol = intval(strClean($idRol));
			if ($intidRol > 0) {
				$arrData = $this->model->selectRol($intidRol);
				if (empty($arrData)) {
					$arrResponse = array('estRol' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrResponse = array('estRol' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function setRol()
	{
		if ($_SESSION['permisosMod']['wriPermiso']) {
			$intidRol = intval($_POST['idRol']);
			$strRol =  strClean($_POST['txtNombre']);
			$strDescipcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

			if ($intidRol == 0) {
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
				$option = 1;
			} else {
				//Actualizar
				$request_rol = $this->model->updateRol($intidRol, $strRol, $strDescipcion, $intStatus);
				$option = 2;
			}

			if ($request_rol > 0) {
				if ($option == 1) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				} else {
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			} else if ($request_rol == 'exist') {

				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
			} else {
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delRol()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['delPermiso']) {
				$intidRol = intval($_POST['idRol']);
				$requestDelete = $this->model->deleteRol($intidRol);
				if ($requestDelete == 'ok') {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				} else if ($requestDelete == 'exist') {
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
}
