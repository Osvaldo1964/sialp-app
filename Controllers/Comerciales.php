<?php
class Comerciales extends Controllers
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

    public function comerciales()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Comerciales";
        $data['page_title'] = "PRESTADORES <small> SALP APP </small>";
        $data['page_name']  = "Comerciales";
        $data['page_functions_js'] = "functions_comerciales.js";
        $this->views->getView($this, "comerciales", $data);
    }

    public function setComercial()
    {
        if ($_POST) {
            if (empty($_POST['txtnomComercial']) || empty($_POST['txtcntComercial']) ||
                empty($_POST['fltvalComercial']) || empty($_POST['listestComercial']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idComercial = intval($_POST['idComercial']);
                $strnomComercial  = strClean($_POST['txtnomComercial']);
                $strcntComercial  = strClean($_POST['txtcntComercial']);
                $fltvalComercial  = strClean($_POST['fltvalComercial']);
                $intestComercial  = intval($_POST['listestComercial']);
                if ($idComercial == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_comercial = $this->model->insertComercial($strnomComercial, $strcntComercial,
                        $fltvalComercial, $intestComercial);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_comercial = $this->model->updateComercial($idComercial, $strnomComercial, $strcntComercial,
                        $fltvalComercial, $intestComercial);
                    }
                }
                if ($request_comercial > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_comercial == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Entidad ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getComerciales()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectComerciales();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estComercial'] == 1) {
                    $arrData[$i]['estComercial'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estComercial'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idComercial'] . ')" title="Ver Entidades"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idComercial'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idComercial'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getComercial($idComercial)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idComercial = intval($idComercial);
            if ($idComercial > 0) {
                $arrData = $this->model->selectComercial($idComercial);
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

    public function delComercial()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidComercial = intval($_POST['idComercial']);
                $requestDelete = $this->model->deleteComercial($intidComercial);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Entidad.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Comerciales con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Grupo.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectComerciales(){
        $htmlOptions = "";
        $arrData = $this->model->selectComerciales();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estComercial'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idComercial'] . '">' .
                                    $arrData[$i]['nomComercial'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>