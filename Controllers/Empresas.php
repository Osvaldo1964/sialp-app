<?php
class Empresas extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(7);
    }

    public function Empresas()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Empresas";
        $data['page_title'] = "EMPRESAS <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "empresas";
        $data['page_functions_js'] = "functions_empresas.js";
        $this->views->getView($this, "empresas", $data);
    }

    public function setEmpresa()
    {
        if ($_POST) {
            if (empty($_POST['txtnitEmpresa']) || empty($_POST['txtnomEmpresa']) ||
                empty($_POST['txtdirEmpresa']) || empty($_POST['txttelEmpresa']) ||
                empty($_POST['txtemaEmpresa']) || empty($_POST['listestEmpresa']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idEmpresa = intval($_POST['idEmpresa']);
                $strnitEmpresa  = strClean($_POST['txtnitEmpresa']);
                $strnomEmpresa  = ucwords(strClean($_POST['txtnomEmpresa']));
                $strdirEmpresa  = ucwords(strClean($_POST['txtdirEmpresa']));
                $inttelEmpresa  = intval(strClean($_POST['txttelEmpresa']));
                $stremaEmpresa  = strtolower(strClean($_POST['txtemaEmpresa']));
                $intestEmpresa  = intval(strClean($_POST['listestEmpresa']));
                $request_user   = "";
                if ($idEmpresa == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertEmpresa($strnitEmpresa, $strnomEmpresa,
                                                                    $strdirEmpresa, $inttelEmpresa,
                                                                    $stremaEmpresa, $intestEmpresa);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateEmpresa($idEmpresa, $strnitEmpresa,
                                                                    $strnomEmpresa, $strdirEmpresa,
                                                                    $inttelEmpresa, $stremaEmpresa,
                                                                    $intestEmpresa);
                    }
                }
                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_user == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el email o la identificación ya existen, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getEmpresas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectEmpresas();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estEmpresa'] == 1) {
                    $arrData[$i]['estEmpresa'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estEmpresa'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idEmpresa'] . ')" title="Ver Empresa"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idEmpresa'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idEmpresa'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getEmpresa($idempresa)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idempresa = intval($idempresa);
            if ($idempresa > 0) {
                $arrData = $this->model->selectEmpresa($idempresa);
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

    public function delEmpresa()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidEmpresa = intval($_POST['idEmpresa']);
                $requestDelete = $this->model->deleteEmpresa($intidEmpresa);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Empresa.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Empresa.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
?>