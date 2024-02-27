<?php
class Elementos extends Controllers
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

    public function elementos()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Elementos";
        $data['page_title'] = "ELEMENTOS <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "elementos";
        $data['page_functions_js'] = "functions_elementos.js";
        $this->views->getView($this, "elementos", $data);
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
                $strdetElemento = strClean($_POST['txtdetElemento']);
                $strdirElemento = strClean($_POST['txtdirElemento']);
                $fltlatElemento = $_POST['fltlatElemento'];
                $fltlonElemento = $_POST['fltlonElemento'];
                $strainElemento = strClean($_POST['txtainElemento']);
                $strabaElemento = strClean($_POST['txtabaElemento']);
                $intestElemento = intval($_POST['listestElemento']);
                $request_Elemento = "";

                $ruta = strtolower(clear_cadena($strcodElemento));
                $ruta = str_replace(" ", "-", $ruta);

                if ($idElemento == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Elemento = $this->model->insertElemento(
                            $intgruElemento, $intiteElemento, $strcodElemento, $intrecElemento, $intusoElemento,
                            $strdesElemento, $strdetElemento, $strdirElemento, $fltlatElemento, $fltlonElemento, $ruta, $strainElemento,
                            $strdetElemento, $intestElemento);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Elemento = $this->model->updateElemento(
                            $idElemento, $intgruElemento, $intiteElemento, $strcodElemento, $intrecElemento, $intusoElemento,
                            $strdesElemento, $strdetElemento, $strdirElemento, $fltlatElemento, $fltlonElemento, $ruta, $strainElemento,
                            $strabaElemento, $intestElemento);
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

    public function setElementoadd()
    {
        if ($_POST) {
            if (empty($_POST['txtdirElemento']) || empty($_POST['txtcodElemento']) || empty($_POST['listGrupos']) 
            || empty($_POST['listestElemento']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intgruElemento = intval($_POST['listGrupos']);
                $intiteElemento = intval($_POST['listItems']);
                $strcodElemento = strClean($_POST['txtcodElemento']);
                $intrecElemento = intval($_POST['listRecursosadd']);
                $intusoElemento = intval($_POST['listUsos']);
                $strdesElemento = '';
                $strdetElemento = strClean($_POST['txtdetElemento']);
                $strdirElemento = strClean($_POST['txtdirElemento']);
                $fltlatElemento = $_POST['fltlatElemento'];
                $fltlonElemento = $_POST['fltlonElemento'];
                $strainElemento = strClean($_POST['eleactActa']);
                $fltvalElemento = strClean($_POST['fltvalElemento']);
                $intestElemento = intval($_POST['listestElemento']);
                $request_Elemento = "";

                $ruta = strtolower(clear_cadena($strcodElemento));
                $ruta = str_replace(" ", "-", $ruta);

                $request_Elemento = $this->model->insertElemento($intgruElemento, $intiteElemento, $strcodElemento, $intrecElemento, $intusoElemento,
                                                                $strdesElemento, $strdetElemento, $strdirElemento, $fltlatElemento, $fltlonElemento,
                                                                $ruta, $strainElemento, $fltvalElemento,$intestElemento);

                if($request_Elemento == 1 || $request_Elemento != 'exist')
                {
                        $arrResponse = array('status' => true, 'idElemento' => $request_Elemento, 'msg' => 'Datos guardados correctamente.');

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

    public function getElementos()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectElementos();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estElemento'] == 1) {
                    $arrData[$i]['estElemento'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estElemento'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idElemento'] . ')" title="Ver Elemento"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idElemento'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idElemento'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getElemento($idElemento)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idElemento = intval($idElemento);
            if ($idElemento > 0) {
                $arrData = $this->model->selectElemento($idElemento);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrImg = $this->model->selectImages($idElemento);
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

    public function delElemento()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidElemento = intval($_POST['idElemento']);
                $requestDelete = $this->model->deleteElemento($intidElemento);
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
