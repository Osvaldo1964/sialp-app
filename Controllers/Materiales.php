<?php
class Materiales extends Controllers
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

    public function materiales()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "materials UCAPs";
        $data['page_title'] = "MATERIALES UCAPs <small> SALP APP </small>";
        $data['page_name']  = "materiales";
        $data['page_functions_js'] = "functions_materiales.js";
        $this->views->getView($this, "materiales", $data);
    }

    public function setMaterial()
    {
        if ($_POST) {
            if (empty($_POST['txtdesMaterial']) || empty($_POST['listestMaterial']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idMaterial = intval($_POST['idMaterial']);
                $strdesMaterial  = strClean($_POST['txtdesMaterial']);
                $intestMaterial  = intval($_POST['listestMaterial']);
                if ($idMaterial == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Material = $this->model->insertMaterial($strdesMaterial, $intestMaterial);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Material = $this->model->updateMaterial($idMaterial, $strdesMaterial, $intestMaterial);
                    }
                }
                if ($request_Material > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_Material == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el Material ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMateriales()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectMateriales();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estMaterial'] == 1) {
                    $arrData[$i]['estMaterial'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estMaterial'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idMaterial'] . ')" title="Ver Material"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idMaterial'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idMaterial'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMaterial($idMaterial)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idMaterial = intval($idMaterial);
            if ($idMaterial > 0) {
                $arrData = $this->model->selectMaterial($idMaterial);
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

    public function delMaterial()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidMaterial = intval($_POST['idMaterial']);
                $requestDelete = $this->model->deleteMaterial($intidMaterial);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Material.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Material con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Material.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectMateriales(){
        $htmlOptions = "";
        $arrData = $this->model->selectMateriales();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estMaterial'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idMaterial'] . '">' .
                                    $arrData[$i]['desMaterial'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>