<?php
class Recursos extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MESTRUCTURA);
    }

    public function recursos()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Recursos";
        $data['page_title'] = "RECURSOS <small> SALP - APP </small>";
        $data['page_name']  = "recursos";
        $data['page_functions_js'] = "functions_recursos.js";
        $this->views->getView($this, "recursos", $data);
    }

    public function setRecurso()
    {
        if ($_POST) {
            if (empty($_POST['txtnomCapitulo']) || empty($_POST['listtipCapitulo'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idCapitulo = intval($_POST['idCapitulo']);
                $strnomCapitulo  = strClean($_POST['txtnomCapitulo']);
                $inttipCapitulo  = intval($_POST['listtipCapitulo']);

                if ($idCapitulo == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_capitulo = $this->model->insertCapitulo($strnomCapitulo, $inttipCapitulo);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_capitulo = $this->model->updateCapitulo($idCapitulo, $strnomCapitulo, $inttipCapitulo);
                    }
                }
                if ($request_capitulo > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_capitulo == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el Capítulo ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getRecursos()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectRecursos();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estRecurso'] == 1) {
                    $arrData[$i]['estRecurso'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estRecurso'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idRecurso'] . ')" title="Ver Capitulo"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idRecurso'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idRecurso'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getRecurso($idcapitulo)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idcapitulo = intval($idcapitulo);
            if ($idcapitulo > 0) {
                $arrData = $this->model->selectCapitulo($idcapitulo);
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

    public function delRecurso()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCapitulo = intval($_POST['idCapitulo']);
                $requestDelete = $this->model->deleteCapitulo($intidCapitulo);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Capítulo.');
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

    public function getSelectRecursos()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectRecursos();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['idRecurso'] . '">' .
                                $arrData[$i]['desRecurso'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
}
