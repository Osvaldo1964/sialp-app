<?php
class Tecnologias extends Controllers
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

    public function tecnologias()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Tecnologias UCAPs";
        $data['page_title'] = "TECNOLOGIAS UCAPs <small> SALP APP </small>";
        $data['page_name']  = "tecnologias";
        $data['page_functions_js'] = "functions_tecnologias.js";
        $this->views->getView($this, "tecnologias", $data);
    }

    public function setTecnologia()
    {
        if ($_POST) {
            if (empty($_POST['txtdesTecno']) || empty($_POST['listestTecno']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idTecno = intval($_POST['idTecno']);
                $strdesTecno  = strClean($_POST['txtdesTecno']);
                $intestTecno  = intval($_POST['listestTecno']);
                if ($idTecno == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_tecno = $this->model->insertTecnologia($strdesTecno, $intestTecno);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_tecno = $this->model->updateTecnologia($idTecno, $strdesTecno, $intestTecno);
                    }
                }
                if ($request_tecno > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_tecno == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Tecnologia ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getTecnologias()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectTecnologias();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estTecno'] == 1) {
                    $arrData[$i]['estTecno'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estTecno'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idTecno'] . ')" title="Ver Clase"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idTecno'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idTecno'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getTecnologia($idtecno)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idtecno = intval($idtecno);
            if ($idtecno > 0) {
                $arrData = $this->model->selectTecnologia($idtecno);
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

    public function delTecnologia()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidTecno = intval($_POST['idTecno']);
                $requestDelete = $this->model->deleteTecnologia($intidTecno);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Tecnologia.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Tecnologia con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Clase.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectTecnologias(){
        $htmlOptions = "";
        $arrData = $this->model->selectTecnologias();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estTecno'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idTecno'] . '">' .
                                    $arrData[$i]['desTecno'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>