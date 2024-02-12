<?php
class Clientes extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(8);
    }

    public function Clientes()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Clientes";
        $data['page_title'] = "CLIENTES <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "clientes";
        $data['page_functions_js'] = "functions_clientes.js";
        $this->views->getView($this, "clientes", $data);
    }

    public function setCliente()
    {
        if ($_POST) {
            if (empty($_POST['listdoCliente']) || empty($_POST['txtdocCliente']) || empty($_POST['txtnomCliente']) ||
                empty($_POST['txtapeCliente']) || empty($_POST['txtdirCliente']) || empty($_POST['txttelCliente']) ||
                empty($_POST['txtemaCliente']) || empty($_POST['listipCliente']) || empty($_POST['txtrazCliente']) ||
                empty($_POST['txtactCliente']) || empty($_POST['txtrepCliente']) || empty($_POST['txtefaCliente']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idCliente = intval($_POST['idCliente']);
                $inttdoCliente  = intval(strClean($_POST['listdoCliente']));
                $strdocCliente  = strClean($_POST['txtdocCliente']);
                $strnomCliente  = ucwords(strClean($_POST['txtnomCliente']));
                $strapeCliente  = ucwords(strClean($_POST['txtapeCliente']));
                $strdirCliente  = ucwords(strClean($_POST['txtdirCliente']));
                $inttelCliente  = intval(strClean($_POST['txttelCliente']));
                $stremaCliente  = strtolower(strClean($_POST['txtemaCliente']));
                $inttipCliente  = intval($_POST['listipCliente']);
                $strrazCliente  = strClean($_POST['txtrazCliente']);
                $stractCliente  = strClean($_POST['txtactCliente']);
                $strrepCliente  = strClean($_POST['txtrepCliente']);
                $strefaCliente  = strtolower(strClean($_POST['txtefaCliente']));
                $introlCliente = 5;
                $request_user   = "";
                if ($idCliente == 0) {
                    $option = 1;
                    $strpasCliente  = empty($_POST['txtpasCliente']) ? passGenerator() : $_POST['txtpasCliente'];
                    $strpasEncript = hash("SHA256", $strpasCliente);
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertCliente($inttdoCliente, $strdocCliente, $strnomCliente,
                                                                    $strapeCliente, $strdirCliente, $inttelCliente,
                                                                    $stremaCliente, $strpasCliente, $introlCliente,
                                                                    $inttipCliente, $strrazCliente, $stractCliente,
                                                                    $strrepCliente, $strefaCliente);
                    }
                } else {
                    $option = 2;
                    $strpasCliente  = empty($_POST['txtpasCliente']) ? "" : hash("SHA256", $_POST['txtpasCliente']);
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateCliente($idCliente, $inttdoCliente, $strdocCliente,
                                                                    $strnomCliente, $strapeCliente, $strdirCliente,
                                                                    $inttelCliente, $stremaCliente, $strpasCliente,
                                                                    $inttipCliente, $strrazCliente, $stractCliente,
                                                                    $strrepCliente, $strefaCliente);
                    }
                }
                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                        $nombreUsuario = $strnomCliente . ' ' . $strapeCliente;
                        $dataUsuario = array('nombreUsuario' => $nombreUsuario, 'email' => $stremaCliente,
                        'password' => $strpasCliente, 'asunto' => 'Bienvenido a tu tienda en línea');
                        sendMail($dataUsuario, 'email_bienvenida');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_user == false) {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el email o la identificación ya existen, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getClientes()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectClientes();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['tdoUsuario'] == 1){
                    $arrData[$i]['tdoUsuario'] = 'C.C.';
                }elseif ($arrData[$i]['tdoUsuario'] == 2){
                    $arrData[$i]['tdoUsuario'] = 'C.E.';
                }else{
                    $arrData[$i]['tdoUsuario'] = 'Pte';
                }

                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idUsuario'] . ')" title="Ver Cliente"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idUsuario'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idUsuario'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCliente($idpersona)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idusuario = intval($idpersona);
            if ($idusuario > 0) {
                $arrData = $this->model->selectCliente($idusuario);
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

    public function getSelectClientes(){
        $htmlOptions = "";
        $arrData = $this->model->selectClientes();
        if (count($arrData) > 0){
            $htmlOptions .= '<option value="Seleccionar Cliente">Seleccionar Cliente</option>';
            for ($i=0; $i < count($arrData); $i++){
                $htmlOptions .= '<option value="' . $arrData[$i]['docUsuario'] . '">' .
                                $arrData[$i]['nomUsuario'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }

    public function delCliente()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCliente = intval($_POST['idCliente']);
                $requestDelete = $this->model->deleteCliente($intidCliente);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Cliente.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Cliente.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
?>