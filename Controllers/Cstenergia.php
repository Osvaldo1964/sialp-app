<?php
class Cstenergia extends Controllers
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

    public function cstenergia()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Costos de Energía";
        $data['page_title'] = "COSTOS ENERGÍA <small> SIALP - APP </small>";
        $data['page_name']  = "costos";
        $data['page_functions_js'] = "functions_cstenergia.js";
        $this->views->getView($this, "cstenergia", $data);
    }

    public function setCostos()
    {
        if ($_POST) {
            if (empty($_POST['intperCosto']) ||
                empty($_POST['intcsmCosto']) || empty($_POST['intvlrCosto']) ||
                empty($_POST['inttotCosto']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectosbxcvbxcv.');
            } else {
                $idCosto = intval($_POST['idCosto']);
                $intperCosto  = intval($_POST['intperCosto']);
                $intcsmCosto  = intval($_POST['intcsmCosto']);
                $intvlrCosto  = intval($_POST['intvlrCosto']);
                $inttotCosto  = intval($_POST['inttotCosto']);
                $intestCosto  = intval($_POST['listestCosto']);
                if ($idCosto == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_capitulo = $this->model->insertCosto($intperCosto, $intcsmCosto, $intvlrCosto, $inttotCosto);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_capitulo = $this->model->updateCosto($idCosto, $intperCosto, $intcsmCosto,
                                                                     $intvlrCosto, $inttotCosto, $intestCosto);
                    }
                }
                if ($request_capitulo > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_capitulo == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el Registro ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCostos()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectCostos();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estCosto'] == 1) {
                    $arrData[$i]['estCosto'] = '<span class="badge badge-success">Ingreso</span>';
                } else {
                    $arrData[$i]['estCosto'] = '<span class="badge badge-danger">Gasto</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idCosto'] . ')" title="Ver Registro"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idCosto'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idCosto'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCosto($idcosto)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idcosto = intval($idcosto);
            if ($idcosto > 0) {
                $arrData = $this->model->selectCosto($idcosto);
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

    public function delCosto()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCosto = intval($_POST['idCosto']);
                $requestDelete = $this->model->deleteCapitulo($intidCosto);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Capítulo con Productos asociados.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Capítulo.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}
