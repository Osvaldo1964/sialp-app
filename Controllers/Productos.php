<?php
class Productos extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(6);
    }

    public function Productos()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Productos";
        $data['page_title'] = "PRODUCTOS <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "productos";
        $data['page_functions_js'] = "functions_productos.js";
        $this->views->getView($this, "productos", $data);
    }

    public function setProducto()
    {
        if ($_POST) {
            if (
                empty($_POST['txtnomProducto']) || empty($_POST['txtcodProducto']) || empty($_POST['listidCategoria']) ||
                empty($_POST['txtvtaProducto']) || empty($_POST['listestProducto'])
            ) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idProducto     = intval($_POST['idProducto']);
                $strnomProducto = strClean($_POST['txtnomProducto']);
                $strdesProducto = strClean($_POST['txtdesProducto']);
                $strcodProducto = strClean($_POST['txtcodProducto']);
                $intidcategoria = intval($_POST['listidCategoria']);
                $intvtaProducto = intval($_POST['txtvtaProducto']);
                $intstoProducto = intval($_POST['txtstoProducto']);
                $intestProducto = intval($_POST['listestProducto']);
                $request_producto = "";

                $ruta = strtolower(clear_cadena($strnomProducto));
                $ruta = str_replace(" ", "-", $ruta);

                if ($idProducto == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_producto = $this->model->insertProducto(
                            $strnomProducto,
                            $strdesProducto,
                            $strcodProducto,
                            $intidcategoria,
                            $intvtaProducto,
                            $intstoProducto,
                            $ruta,
                            $intestProducto
                        );
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_producto = $this->model->updateProducto(
                            $idProducto,
                            $strnomProducto,
                            $strdesProducto,
                            $strcodProducto,
                            $intidcategoria,
                            $intvtaProducto,
                            $intstoProducto,
                            $ruta,
                            $intestProducto
                        );
                    }
                }
                if($request_producto == 1 || $request_producto != 'exist')
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_producto == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
        }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProductos()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectProductos();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estProducto'] == 1) {
                    $arrData[$i]['estProducto'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estProducto'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                $arrData[$i]['vtaProducto'] = SMONEY . ' ' . formatMoney($arrData[$i]['vtaProducto']);
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idProducto'] . ')" title="Ver Producto"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idProducto'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idProducto'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProducto($idProducto)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idProducto = intval($idProducto);
            if ($idProducto > 0) {
                $arrData = $this->model->selectProducto($idProducto);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrImg = $this->model->selectImages($idProducto);
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

    public function delProducto()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidProducto = intval($_POST['idProducto']);
                $requestDelete = $this->model->deleteProducto($intidProducto);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Producto.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Producto.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function setImage()
    {
        if ($_POST) {
            if (empty($_POST['idProducto'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
            } else {
                $idProducto = intval($_POST['idProducto']);
                $foto = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('Y-m-d H:m:s')) . '.jpg';
                $request_image = $this->model->insertImage($idProducto, $imgNombre);
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
            if (empty($_POST['idProducto']) || empty($_POST['file'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                //Eliminar el registro de la tabla imagenes
                $idProducto = intval($_POST['idProducto']);
                $imgNombre = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idProducto, $imgNombre);
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
