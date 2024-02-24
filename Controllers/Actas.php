<?php
class Actas extends Controllers
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

    public function actas()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Actas";
        $data['page_title'] = "ACTAS <small> SALP - APP</small>";
        $data['page_name']  = "actas";
        $data['page_functions_js'] = "functions_actas.js";
        $this->views->getView($this, "actas", $data);
    }

    public function setActa()
    {
        if ($_POST) {
            if (empty($_POST['txtnumActa']) || empty($_POST['txtfecActa']) || empty($_POST['listClases']) 
            || empty($_POST['listestActa']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idActa     = intval($_POST['idActa']);
                $inttipActa = 2;
                $intiteActa = intval($_POST['listClases']);
                $strnumActa = strClean($_POST['txtnumActa']);
                $strfecActa = strClean($_POST['txtfecActa']);
                $intrecActa = intval($_POST['listRecursos']);
                $intestActa = intval($_POST['listestActa']);
                $request_Acta = "";

                if ($idActa == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Acta = $this->model->insertActa($inttipActa, $intiteActa, $strnumActa, $strfecActa, $intrecActa, $intestActa);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Acta = $this->model->updateActa($idActa, $inttipActa, $intiteActa, $strnumActa, $strfecActa, $intrecActa, $intestActa);
                    }
                }
                if($request_Acta == 1 || $request_Acta != 'exist')
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idActa' => $request_Acta, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idActa' => $idActa, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_Acta == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un Acta con el Número Ingresado.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
        }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getActas()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectActas();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estActa'] == 1) {
                    $arrData[$i]['estActa'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estActa'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idActa'] . ')" title="Ver Acta"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idActa'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idActa'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getActa($idActa)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idActa = intval($idActa);
            if ($idActa > 0) {
                $arrData = $this->model->selectActa($idACta);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                     $arrImg = $this->model->selectImages($idActa);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }
                    $arrData['images'] = $arrImg;
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        die();
    }

    public function delActa()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidActa = intval($_POST['idActa']);
                $requestDelete = $this->model->deleteActa($intidActa);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Acta.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Acta.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function setImage()
    {
        if ($_POST) {
            if (empty($_POST['idActa'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
            } else {
                $idActa = intval($_POST['idActa']);
                $foto = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('Y-m-d H:m:s')) . '.jpg';
                $request_image = $this->model->insertImage($idActa, $imgNombre);
                if ($request_image) {
                    $uploadImage = uploadImage($foto, $imgNombre);
                    $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delFile()
    {
        if ($_POST) {
            if (empty($_POST['idActa']) || empty($_POST['file'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                //Eliminar el registro de la tabla imagenes
                $idActa = intval($_POST['idActa']);
                $imgNombre = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idActa, $imgNombre);
                if ($request_image) {
                    $deleteFile = deleteFile($imgNombre);
                    $arrResponse = array('status' => true, 'msg' => 'Archivo eliminado.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No se pudo eliminar el archivo.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
