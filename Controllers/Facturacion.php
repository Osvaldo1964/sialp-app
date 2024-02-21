<?php
class Facturacion extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MCOMPONENTES);
    }

    public function facturacion()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Facturacion";
        $data['page_title'] = "FACTURACION <small> SALP - APP </small>";
        $data['page_name']  = "facturacion";
        $data['page_functions_js'] = "functions_facturacion.js";
        $this->views->getView($this, "facturacion", $data);
    }

    public function setFactura()
    {
        if ($_POST) {
            if (empty($_POST['intperFactura']) || empty($_POST['listEstrato']) || empty($_POST['intcanFactura']) || 
            empty($_POST['intfacFactura']) || empty($_POST['intrecFactura']) || empty($_POST['listestFactura']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idFactura = intval($_POST['idFactura']);
                $intperFactura = intval(strClean($_POST['intperFactura'])); 
                $intrelFactura = strClean($_POST['listEstrato']);
                $intcanFactura = strClean($_POST['intcanFactura']);
                $intfacFactura = strClean($_POST['intfacFactura']);
                $intrecFactura = strClean($_POST['intrecFactura']);
                $intestFactura = intval(strClean($_POST['listestFactura']));
                $request_user   = "";
                if ($idFactura == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertFactura($intperFactura, $intrelFactura, $intcanFactura, $intfacFactura, $intrecFactura, $intestFactura);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateFactura($idFactura, $intperFactura, $intrelFactura, $intcanFactura, $intfacFactura, $intrecFactura, $intestFactura);
                    }
                }
                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_user == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el Registro ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getFacturas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectFacturas();
            dep($arrData);exit;
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estFactura'] == 1) {
                    $arrData[$i]['estFactura'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estFactura'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idFactura'] . ')" title="Ver Registro"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idFactura'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idFactura'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getFactura($idfactura)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idfactura = intval($idfactura);
            if ($idfactura > 0) {
                $arrData = $this->model->selectFactura($idfactura);
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

    public function delFactura()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidFactura = intval($_POST['idFactura']);
                $requestDelete = $this->model->deleteFactura($intidFactura);
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
}
?>