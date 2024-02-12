<?php
class Cajas extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(11);
    }

    public function Cajas()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Cajas";
        $data['page_title'] = "CAJAS <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "CAJAS";
        $data['page_functions_js'] = "functions_CAJAS.js";
        $this->views->getView($this, "cajas", $data);
    }

    public function setCaja()
    {
        if ($_POST) {
            if (empty($_POST['txtdesCaja']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idCaja = intval($_POST['idCaja']);
                $strdesCaja = strClean($_POST['txtdesCaja']);
                /* $intidUsuario = intval($_POST['listidUsuario']); */
                $request_caja   = "";
                if ($idCaja == 0) {
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_caja = $this->model->insertCaja($strdesCaja);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_caja = $this->model->updateCaja($idCaja, $strdesCaja);
                    }
                }
                if ($request_caja > 0) {
                   $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                }else if ($request_caja == false) {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCajas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectCajas();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estCaja'] == 1) {
                    $arrData[$i]['estCaja'] = '<span class="badge badge-success">Abierta</span>';
                } else {
                    $arrData[$i]['estCaja'] = '<span class="badge badge-danger">Cerrada</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idCaja'] . ')" title="Ver Caja"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idCaja'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idCaja'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCaja($idCaja)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idCaja = intval($idCaja);
            if ($idCaja > 0) {
                $arrData = $this->model->selectCaja($idCaja);
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

    public function delCaja()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCaja = intval($_POST['idCaja']);
                $requestDelete = $this->model->deleteCliente($intidCaja);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Caja.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Caja.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
?>