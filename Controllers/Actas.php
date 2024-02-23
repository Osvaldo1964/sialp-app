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

    public function setElemento()
    {
        if ($_POST) {
            if (empty($_POST['txtdirElemento']) || empty($_POST['txtcodElemento']) || empty($_POST['listGrupos']) 
            || empty($_POST['listestElemento']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idElemento     = intval($_POST['idElemento']);
                $intgruElemento = intval($_POST['listGrupos']);
                $intiteElemento = intval($_POST['listItems']);
                $strcodElemento = strClean($_POST['txtcodElemento']);
                $intrecElemento = intval($_POST['listRecursos']);
                $intusoElemento = intval($_POST['listUsos']);
                $strdesElemento = strClean($_POST['txtdesElemento']);
                $strdirElemento = strClean($_POST['txtdirElemento']);
                $fltlatElemento = $_POST['fltlatElemento'];
                $fltlonElemento = $_POST['fltlonElemento'];
                $strainElemento = strClean($_POST['txtainElemento']);
                $strfinElemento = strClean($_POST['txtfinElemento']);
                $strabaElemento = strClean($_POST['txtabaElemento']);
                $strfbaElemento = strClean($_POST['txtfbaElemento']);
                $intestElemento = intval($_POST['listestElemento']);
                $request_Elemento = "";

                $ruta = strtolower(clear_cadena($strcodElemento));
                $ruta = str_replace(" ", "-", $ruta);

                if ($idElemento == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Elemento = $this->model->insertElemento(
                            $intgruElemento, $intiteElemento, $strcodElemento, $intrecElemento, $intusoElemento,
                            $strdesElemento, $strdirElemento, $fltlatElemento, $fltlonElemento, $ruta, $strainElemento,
                            $strfinElemento, $intestElemento);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Elemento = $this->model->updateElemento(
                            $idElemento, $intgruElemento, $intiteElemento, $strcodElemento, $intrecElemento, $intusoElemento,
                            $strdesElemento, $strdirElemento, $fltlatElemento, $fltlonElemento, $ruta, $strainElemento,
                            $strfinElemento, $strabaElemento, $strfbaElemento, $intestElemento);
                    }
                }
                if($request_Elemento == 1 || $request_Elemento != 'exist')
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idElemento' => $request_Elemento, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idElemento' => $idElemento, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_Elemento == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un Elemento con el Código Ingresado.');		
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
/*                     $arrImg = $this->model->selectImages($idElemento);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }
                    $arrData['images'] = $arrImg; */
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
            if (empty($_POST['idElemento'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
            } else {
                $idElemento = intval($_POST['idElemento']);
                $foto = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('Y-m-d H:m:s')) . '.jpg';
                $request_image = $this->model->insertImage($idElemento, $imgNombre);
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
            if (empty($_POST['idElemento']) || empty($_POST['file'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                //Eliminar el registro de la tabla imagenes
                $idElemento = intval($_POST['idElemento']);
                $imgNombre = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idElemento, $imgNombre);
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
