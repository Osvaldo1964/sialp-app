<?php
class Cuadrillas extends Controllers
{
    public function __construct()
    {
		sessionStart();
        parent::__construct();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MCOMPONENTES);
    }

    public function cuadrillas()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Cuadrillas";
        $data['page_title'] = "CUADRILLAS <small> SALP APP </small>";
        $data['page_name']  = "cuadrillas";
        $data['page_functions_js'] = "functions_cuadrillas.js";
        $this->views->getView($this, "cuadrillas", $data);
    }

    public function setCuadrilla()
    {
        if ($_POST) {
            if (empty($_POST['txtdesCuadrilla']) || empty($_POST['txtconCuadrilla']) ||
                empty($_POST['txttecCuadrilla']) || empty($_POST['txtayuCuadrilla']) || empty($_POST['listestCuadrilla']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idCuadrilla = intval($_POST['idCuadrilla']);
                $strdesCuadrilla  = strClean($_POST['txtdesCuadrilla']);
                $strconCuadrilla  = strClean($_POST['txtconCuadrilla']);
                $strtecCuadrilla  = strClean($_POST['txttecCuadrilla']);
                $strayuCuadrilla  = strClean($_POST['txtayuCuadrilla']);
                $intestCuadrilla  = intval($_POST['listestCuadrilla']);
                if ($idCuadrilla == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_cuadrilla = $this->model->insertCuadrilla($strdesCuadrilla, $strconCuadrilla,
                        $strtecCuadrilla, $strayuCuadrilla, $intestCuadrilla);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_cuadrilla = $this->model->updateCuadrilla($idCuadrilla, $strdesCuadrilla, $strconCuadrilla,
                        $strtecCuadrilla, $strayuCuadrilla, $intestCuadrilla);
                    }
                }
                if ($request_cuadrilla > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_cuadrilla == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Cuadrilla ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCuadrillas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectCuadrillas();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estCuadrilla'] == 1) {
                    $arrData[$i]['estCuadrilla'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estCuadrilla'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idCuadrilla'] . ')" title="Ver Cuadrilla"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idCuadrilla'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idCuadrilla'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCuadrilla($idCuadrilla)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idCuadrilla = intval($idCuadrilla);
            if ($idCuadrilla > 0) {
                $arrData = $this->model->selectCuadrilla($idCuadrilla);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delCuadrilla()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCuadrilla = intval($_POST['idCuadrilla']);
                $requestDelete = $this->model->deleteCuadrilla($intidCuadrilla);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Cuadrilla.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Cuadrilla con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Grupo.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectCuadrilla(){
        $htmlOptions = "";
        $arrData = $this->model->selectCuadrilla();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estCuadrilla'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idCuadrilla'] . '">' .
                                    $arrData[$i]['desCuadrilla'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>