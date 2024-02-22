<?php
class Grupossalp extends Controllers
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

    public function grupossalp()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Grupos Salp";
        $data['page_title'] = "GRUPOS SALP <small> SALP APP </small>";
        $data['page_name']  = "grupossalp";
        $data['page_functions_js'] = "functions_grupos_salp.js";
        $this->views->getView($this, "grupossalp", $data);
    }

    public function setGruposalp()
    {
        if ($_POST) {
            if (empty($_POST['txtcodGruposalp']) || empty($_POST['txtdesGruposalp']) ||
                empty($_POST['fltvidGruposalp']) || empty($_POST['listestGruposalp']) || empty($_POST['listtipGruposalp']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idGruposalp = intval($_POST['idGruposalp']);
                $strcodGruposalp  = strClean($_POST['txtcodGruposalp']);
                $strdesGruposalp  = strClean($_POST['txtdesGruposalp']);
                $fltvidGruposalp  = strClean($_POST['fltvidGruposalp']);
                $inttipGruposalp  = intval($_POST['listtipGruposalp']);
                $intestGruposalp  = intval($_POST['listestGruposalp']);
                if ($idGruposalp == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_gruposalp = $this->model->insertGruposalp($strcodGruposalp, $strdesGruposalp,
                        $inttipGruposalp, $fltvidGruposalp, $intestGruposalp);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_gruposalp = $this->model->updateGruposalp($idGruposalp, $strcodGruposalp, $strdesGruposalp,
                        $fltvidGruposalp, $inttipGruposalp, $intestGruposalp);
                    }
                }
                if ($request_gruposalp > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_gruposalp == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el Grupo ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getGrupossalp()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectGrupossalp();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['tipGruposalp'] == 1) {
                    $arrData[$i]['tipGruposalp'] = '<span class="badge badge-success">Eléctrico</span>';
                } else {
                    $arrData[$i]['tipGruposalp'] = '<span class="badge badge-danger">No Eléctrico</span>';
                }
                if ($arrData[$i]['estGruposalp'] == 1) {
                    $arrData[$i]['estGruposalp'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estGruposalp'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idGruposalp'] . ')" title="Ver Grupo"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idGruposalp'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idGruposalp'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getGruposalp($idgruposalp)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idgruposalp = intval($idgruposalp);
            if ($idgruposalp > 0) {
                $arrData = $this->model->selectGruposalp($idgruposalp);
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

    public function delGruposalp()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidGruposalp = intval($_POST['idGruposalp']);
                $requestDelete = $this->model->deleteGruposalp($intidGruposalp);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Grupo.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Grupo con Elementos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Grupo.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectGrupossalp(){
        $htmlOptions = "";
        $arrData = $this->model->selectGrupossalp();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estGruposalp'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idGruposalp'] . '">' .
                                    $arrData[$i]['desGruposalp'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>