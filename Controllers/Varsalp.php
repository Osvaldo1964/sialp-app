<?php
class Varsalp extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MESTRUCTURA);
    }

    public function varsalp()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Variables de Salud";
        $data['page_title'] = "VARIABLES <small> SIALP - APP </small>";
        $data['page_name']  = "variables";
        $data['page_functions_js'] = "functions_varsalp.js";
        $this->views->getView($this, "varsalp", $data);
    }

    public function setVarsalp()
    {
        if ($_POST) {
            if (empty($_POST['txtcodVarsalp']) || empty($_POST['txtdesVarsalp']) || empty($_POST['listestVarsalp']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idVarsalp = intval($_POST['idVarsalp']);
                $strcodVarsalp  = strClean($_POST['txtcodVarsalp']);
                $strdesVarsalp  = ucwords(strClean($_POST['txtdesVarsalp']));
                $intestVarsalp  = intval(strClean($_POST['listestVarsalp']));
                $request_user   = "";
                if ($idVarsalp == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertVarsalp($strcodVarsalp, $strdesVarsalp, $intestVarsalp);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateVarsalp($idVarsalp, $strcodVarsalp, $strdesVarsalp, $intestVarsalp);
                    }
                }
                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_user == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el grupo ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getVarsalps()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectVarsalps();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estVarsalp'] == 1) {
                    $arrData[$i]['estVarsalp'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estVarsalp'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idVarsalp'] . ')" title="Ver Grupo"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idVarsalp'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idVarsalp'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getVarsalp($idvarsalp)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idvarsalp = intval($idvarsalp);
            if ($idvarsalp > 0) {
                $arrData = $this->model->selectVarsalp($idvarsalp);
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

    public function delVarsalp()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $strcodVarsalp = intval($_POST['idVarsalp']);
                $requestDelete = $this->model->deleteVarsalp($strcodVarsalp);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Grupo.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Grupo.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectVarsalp()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectVarsalps();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['idVarsalp'] . '">' .
                                $arrData[$i]['desVarsalp'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>