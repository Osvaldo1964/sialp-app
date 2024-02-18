<?php
class Valorvrsalp extends Controllers
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

    public function valorvrsalp()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Valores Variables";
        $data['page_title'] = "VALORES <small> SALP APP </small>";
        $data['page_name']  = "valorvrsalp";
        $data['page_functions_js'] = "functions_valor_vrsalp.js";
        $this->views->getView($this, "valorvrsalp", $data);
    }

    public function setValorvar()
    {
        if ($_POST) {
            if (empty($_POST['txtiniValorvar']) || empty($_POST['txtfinValorvar']) || empty($_POST['listVariable']) 
            || empty($_POST['listestValorvar']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idValorvar     = intval($_POST['idValorvar']);
                //$strcodValorvar = strClean($_POST['txtcodValorvar']);
                $intvarValorvar = intval($_POST['listVariable']);
                $striniValorvar = strClean($_POST['txtiniValorvar']);
                $strfinValorvar = strClean($_POST['txtfinValorvar']);
                $strtipValorvar = strClean($_POST['txttipValorvar']);
                $fltvalValorvar = floatval($_POST['fltvalValorvar']);
                $intestValorvar = intval($_POST['listestValorvar']);
                $request_Valorvar = "";

                if ($idValorvar == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Valorvar = $this->model->insertValorvar($intvarValorvar, $striniValorvar, $strfinValorvar,
                            $strtipValorvar, $fltvalValorvar, $intestValorvar);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Valorvar = $this->model->updateValorvar($idValorvar, $intvarValorvar, $striniValorvar, $strfinValorvar,
                        $strtipValorvar, $fltvalValorvar, $intestValorvar);
                    }
                }
                if($request_Valorvar == 1 || $request_Valorvar != 'exist')
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idValorvar' => $request_Valorvar, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idValorvar' => $idValorvar, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_Valorvar == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un Registro con el Código Ingresado.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
        }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getValores()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectValorvars();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estValorvar'] == 1) {
                    $arrData[$i]['estValorvar'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estValorvar'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idValorvar'] . ')" title="Ver Elemento"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idValorvar'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idValorvar'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getValorvar($idValorvar)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idValorvar = intval($idValorvar);
            if ($idValorvar > 0) {
                $arrData = $this->model->selectValorvar($idValorvar);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        die();
    }

    public function delValorvar()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidValorvar = intval($_POST['idValorvar']);
                $requestDelete = $this->model->deleteValorvar($intidValorvar);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Elemento.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Elemento.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
