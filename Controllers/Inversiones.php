<?php
class Inversiones extends Controllers
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

    public function items()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "inversiones";
        $data['page_title'] = "INVERSIONES <small> SALP - APP </small>";
        $data['page_name']  = "inversiones";
        $data['page_functions_js'] = "functions_inversiones.js";
        $this->views->getView($this, "inversiones", $data);
    }

    public function setItem()
    {
        if ($_POST) {
            if (empty($_POST['listGrupos']) || empty($_POST['txtdesItem']) ||
                empty($_POST['intcsmItem']) || empty($_POST['listestItem']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idItem = intval($_POST['idItem']);
                $intgruItem  = strClean($_POST['listGrupos']);
                $strdesItem  = ucwords(strClean($_POST['txtdesItem']));
                $intcsmItem  = intval(strClean($_POST['intcsmItem']));
                $intestItem  = intval(strClean($_POST['listestItem']));
                $request_user   = "";
                if ($idItem == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_user = $this->model->insertItem($intgruItem, $strdesItem,
                                                                $intcsmItem, $intestItem);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_user = $this->model->updateItem($idItem,$intgruItem, $strdesItem,
                                                                $intcsmItem, $intestItem);
                    }
                }
                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                }else if ($request_user == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el item ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getItems()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectItems();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estItem'] == 1) {
                    $arrData[$i]['estItem'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estItem'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idItem'] . ')" title="Ver Item"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idItem'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idItem'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getItem($iditem)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $iditem = intval($iditem);
            if ($iditem > 0) {
                $arrData = $this->model->selectItem($iditem);
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

    public function delItem()
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

    public function getSelectItems()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectItems();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['idItem'] . '">' .
                                $arrData[$i]['desItem'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
}
?>