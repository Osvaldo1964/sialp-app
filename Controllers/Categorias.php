<?php
class Categorias extends Controllers
{
    public function __construct()
    {
		sessionStart();
        parent::__construct();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(5);
    }

    public function Categorias()
    {
		echo 'estoy en categorias';
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Categorias";
        $data['page_title'] = "CATEGORIAS <small> Cmr Pos Facturación </small>";
        $data['page_name']  = "categorias";
        $data['page_functions_js'] = "functions_categorias.js";
        $this->views->getView($this, "categorias", $data);
    }

    public function setCategoria()
    {
        if ($_POST) {
            if (empty($_POST['txtnomCategoria']) || empty($_POST['txtdesCategoria']) ||
                empty($_POST['listestCategoria']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idCategoria = intval($_POST['idCategoria']);
                $strnomCategoria  = strClean($_POST['txtnomCategoria']);
                $strdesCategoria  = strClean($_POST['txtdesCategoria']);
                $intestCategoria  = intval($_POST['listestCategoria']);

                $ruta = strtolower(clear_cadena($strnomCategoria));
                $ruta = str_replace(" ", "-", $ruta);

                //DATOS IMAGEN
                $img_foto   =   $_FILES['foto'];
                $nom_foto   =   $img_foto['name'];
                $tip_foto   =   $img_foto['type'];
                $url_foto   =   $img_foto['tmp_name'];
                $por_foto   =   'portada_categoria.jpg';

                if ($nom_foto != '') {
                    $por_foto = 'img_' . md5(date('Y-m-d H:m:s')) . '.jpg';
                }
                if ($idCategoria == 0) {
                    //CREAR
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_categoria = $this->model->insertCategoria($strnomCategoria, $strdesCategoria, $por_foto, $ruta, $intestCategoria);
                    }
                } else {
                    //ACTUALIZAR
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        if ($nom_foto == ''){
                            if ($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0){
                                $por_foto = $_POST['foto_actual'];
                            }
                        }
                        $request_categoria = $this->model->updateCategoria($idCategoria, $strnomCategoria, $strdesCategoria, $por_foto,  $ruta, $intestCategoria);
                    }
                }
                if ($request_categoria > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                        if($nom_foto != ''){ uploadImage($img_foto, $por_foto); }
                    }else{
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                        if($nom_foto != ''){ uploadImage($img_foto, $por_foto); }
                        if (($nom_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png') ||
                            ($nom_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){
                            deleteFile($_POST['foto_actual']);
                        }
                    }
                }else if ($request_categoria == 'exist') {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! la Categoría ya existe, ingrese otro.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCategorias()
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $arrData = $this->model->selectCategorias();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($arrData[$i]['estCategoria'] == 1) {
                    $arrData[$i]['estCategoria'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['estCategoria'] = '<span class="badge badge-danger">Inactivo</span>';
                }
                if ($_SESSION['permisosMod']['reaPermiso']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idCategoria'] . ')" title="Ver Categoria"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idCategoria'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idCategoria'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCategoria($idcategoria)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idcategoria = intval($idcategoria);
            if ($idcategoria > 0) {
                $arrData = $this->model->selectCategoria($idcategoria);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrData['url_portada'] = media() . '/images/uploads/' . $arrData[0]['imgCategoria'];
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delCategoria()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['delPermiso']) {
                $intidCategoria = intval($_POST['idCategoria']);
                $requestDelete = $this->model->deleteCategoria($intidCategoria);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Categoría.');
                } else if ($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una Categoría con Productos asociados.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Categoría.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectCategorias(){
        $htmlOptions = "";
        $arrData = $this->model->selectCategorias();
        if (count($arrData) > 0){
            for ($i=0; $i < count($arrData); $i++){
                if ($arrData[$i]['estCategoria'] == 1){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idCategoria'] . '">' .
                                    $arrData[$i]['nomCategoria'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();

    }
}
?>