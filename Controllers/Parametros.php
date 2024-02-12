<?php
class Parametros extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MGENERALES);
    }

    public function parametros()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Parametros";
        $data['page_title'] = "PARAMETROS <small> SALP - APP </small>";
        $data['page_name']  = "parametros";
        $data['parametros'] = $this->model->getParametro();
        $data['page_functions_js'] = "functions_parametros.js";
        $this->views->getView($this, "parametros", $data);
    }

    public function setParametros()
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
}
?>