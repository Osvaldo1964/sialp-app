<?php
class Controlpqr extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(5);
    }

    public function controlpqr()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Control PQRs";
        $data['page_title'] = "CONTROL PQRs <small> SALP APP</small>";
        $data['page_name']  = "controlpqr";
        $data['page_functions_js'] = "functions_controlpqr.js";
        $this->views->getView($this, "controlpqr", $data);
    }

    public function setPqrs()
    {
        if ($_POST) {
            if (
                empty($_POST['txtfsoPqrs']) || empty($_POST['txtdsoPqrs']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idPqrs = intval($_POST['idPqrs']);
                $strfsoPqrs  = $_POST['txtfsoPqrs'];
                $strdsoPqrs  = strClean($_POST['txtdsoPqrs']);
                //$intestPqrs  = intval($_POST['listestPqrs']);

                if ($idPqrs == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_categoria = $this->model->insertCategoria($strnomCategoria, $strdesCategoria, $por_foto, $ruta, $intestCategoria);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_pqrs = $this->model->updatePqrs($idPqrs, $strfsoPqrs, $strdsoPqrs);
                    }
                }
                if ($request_pqrs > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_pqrs == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Categoría ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setCuadrilla($idPqrs)
    {
        if ($_POST) {
            if (empty($_POST['txtasiPqrs']) || empty($_POST['listCuadrillas'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idPqrs     = $idPqrs;
                $intucaPqrs = intval($_POST['listUcapsCuadrilla']);
                $strasiPqrs = $_POST['txtasiPqrs'];
                $intcuaPqrs = intval($_POST['listCuadrillas']);
                $intestPqrs = 2;

                if ($_SESSION['permisosMod']['updPermiso']) {
                    $request_cuadrilla = $this->model->updateCuapqr($idPqrs, $intucaPqrs, $strasiPqrs, $intcuaPqrs, $intestPqrs);
                }
                if ($request_cuadrilla > 0) {
                    $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function getPqrs()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectPqrs();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnCuadrilla = '';
                $btnEdit = '';
                $btnDelete = '';
                switch ($arrData[$i]['estPqrs']) {
                    case 0:
                        $arrData[$i]['estPqrs'] = '<span class="badge badge-danger">Anulada</span>';
                        break;
                    case 1:
                        $arrData[$i]['estPqrs'] = '<span class="badge badge-primary">Pendiente</span>';
                        break;
                    case 2:
                        $arrData[$i]['estPqrs'] = '<span class="badge badge-warning">Asignada</span>';
                        break;
                    case 3:
                        $arrData[$i]['estPqrs'] = '<span class="badge badge-success">Resuelta</span>';
                        break;
                    default:
                        echo "Error";
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idPqrs'] . ')" title="Ver PQR"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idPqrs'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    $btnCuadrilla = '<button class="btn btn-warning btn-sm" onClick="fntCuadrilla(this,' . $arrData[$i]['idPqrs'] . ')" title="Asignar"><i class="fa fa-users"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idPqrs'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnCuadrilla . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPqr($idpqrs)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idpqrs = intval($idpqrs);
            if ($idpqrs > 0) {
                $arrData = $this->model->selectPqr($idpqrs);
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

    public function delPqr()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidPqr = intval($_POST['idPqr']);
                $requestDelete = $this->model->deletePqr($intidPqr);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Categoría.');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Categoría con Productos asociados.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Categoría.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function impAsignacion($idPqrs) {
        $idPqrs = intval($idPqrs);
        if (!is_numeric($idPqrs)){
            header("Location:" . base_url() . '/controlpqr');
        }
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Asignar Pqrs - Salp - App";
        $data['page_title'] = "IMPRIMIR ASIGNACION <small> SALP - APP </small>";
        $data['page_name']  = "imprasignacion";
        $data['pqrs'] = $this->model->selectPqrCuadrilla($idPqrs);
        $this->views->getView($this, "imprasignacionpdf", $data);
    }
}
