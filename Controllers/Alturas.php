<?php
class Alturas extends Controllers
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

    public function alturas()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Alturas UCAPs";
        $data['page_title'] = "ALTURAS UCAPs <small> SALP APP </small>";
        $data['page_name']  = "alturas";
        $data['page_functions_js'] = "functions_alturas.js";
        $this->views->getView($this, "alturas", $data);
    }

    public function setAlturas()
    {
        if ($_POST) {
            if (empty($_POST['txtdesAltura']) || empty($_POST['listestAltura']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idAltura = intval($_POST['idAltura']);
                $strdesAltura  = strClean($_POST['txtdesAltura']);
                $intestAltura  = intval($_POST['listestAltura']);
                if ($idAltura == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_altura = $this->model->insertAltura($strdesAltura, $intestAltura);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_altura = $this->model->updateClase($idAltura, $strdesAltura, $intestAltura);
                    }
                }
                if ($request_altura > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_altura == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Clase ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getAlturas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectAlturas();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estAltura'] == 1) {
                    $arrData[$i]['estAltura'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estAltura'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idAltura'] . ')" title="Ver Altura"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idAltura'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idAltura'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getAltura($idaltura)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idaltura = intval($idaltura);
            if ($idaltura > 0) {
                $arrData = $this->model->selecAltura($idaltura);
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

    public function delAltura()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidAltura = intval($_POST['idAltura']);
                $requestDelete = $this->model->deleteAltura($intidAltura);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Altura.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Altura con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Altura.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectAlturas(){
        $htmlOptions = "";
        $arrData = $this->model->selectAlturas();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estAltura'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idAltura'] . '">' .
                                    $arrData[$i]['desAltura'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>