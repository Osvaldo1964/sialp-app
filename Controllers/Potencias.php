<?php
class Potencias extends Controllers
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

    public function potencias()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Potencias UCAPs";
        $data['page_title'] = "POTENCIAS UCAPs <small> SALP APP </small>";
        $data['page_name']  = "potencias";
        $data['page_functions_js'] = "functions_potencias.js";
        $this->views->getView($this, "potencias", $data);
    }

    public function setPotencias()
    {
        if ($_POST) {
            if (empty($_POST['txtdesClase']) || empty($_POST['listestClase']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idClase = intval($_POST['idClase']);
                $strdesClase  = strClean($_POST['txtdesClase']);
                $intestClase  = intval($_POST['listestClase']);
                if ($idClase == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_clase = $this->model->insertClase($strdesClase, $intestClase);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_clase = $this->model->updateClase($idClase, $strdesClase, $intestClase);
                    }
                }
                if ($request_clase > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_clase == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Clase ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPotencias()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectClases();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estClase'] == 1) {
                    $arrData[$i]['estClase'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estClase'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idClase'] . ')" title="Ver Clase"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idClase'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idClase'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPotencia($idclase)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idclase = intval($idclase);
            if ($idclase > 0) {
                $arrData = $this->model->selectClase($idclase);
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

    public function delPotencia()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidGruposalp = intval($_POST['idGruposalp']);
                $requestDelete = $this->model->deleteClase($intidClase);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Clase.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Clase con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Clase.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectPotencias(){
        $htmlOptions = "";
        $arrData = $this->model->selectPotencias();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estPotencia'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idPotencia'] . '">' .
                                    $arrData[$i]['desPotencia'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>