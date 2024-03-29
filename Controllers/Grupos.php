<?php
class Grupos extends Controllers
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

    public function grupos()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Grupos";
        $data['page_title'] = "GRUPOS <small> SIALP - APP </small>";
        $data['page_name']  = "grupos";
        $data['page_functions_js'] = "functions_grupos.js";
        $this->views->getView($this, "grupos", $data);
    }

    public function setGrupo()
    {
        if ($_POST) {
            if (empty($_POST['listCapitulo']) || empty($_POST['txtdesGrupo']) || empty($_POST['listestGrupo']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idGrupo = intval($_POST['idGrupo']);
                $intcapGrupo  = strClean($_POST['listCapitulo']);
                $strdesGrupo  = ucwords(strClean($_POST['txtdesGrupo']));
                $intestGrupo  = intval(strClean($_POST['listestGrupo']));
                $request_user   = "";
                if ($idGrupo == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertGrupo($intcapGrupo, $strdesGrupo, $intestGrupo);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateGrupo($idGrupo, $intcapGrupo, $strdesGrupo, $intestGrupo);
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

    public function getGrupos()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectGrupos();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estGrupo'] == 1) {
                    $arrData[$i]['estGrupo'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estGrupo'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idGrupo'] . ')" title="Ver Grupo"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idGrupo'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idGrupo'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getGrupo($idgrupo)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idgrupo = intval($idgrupo);
            if ($idgrupo > 0) {
                $arrData = $this->model->selectGrupo($idgrupo);
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

    public function delGrupo()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidItem = intval($_POST['idItem']);
                $requestDelete = $this->model->deleteItem($intidItem);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Item.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Item.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
?>