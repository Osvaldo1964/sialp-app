<?php
class Invinicial extends Controllers
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

    public function invinicial()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Invinicial";
        $data['page_title'] = "INV. INICIAL <small> SALP - APP</small>";
        $data['page_name']  = "invinicial";
        $data['page_functions_js'] = "functions_invinicial.js";
        $this->views->getView($this, "invinicial", $data);
    }

    public function setActa()
    {
        if ($_POST) {
            if (empty($_POST['txtnumActa']) || empty($_POST['txtfecActa']) || empty($_POST['listItems']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idActa     = intval($_POST['idActa']);
                $inttipActa = ACTINICIAL;
                $intiteActa = intval($_POST['listItems']);
                $strnumActa = strClean($_POST['txtnumActa']);
                $strfecActa = strClean($_POST['txtfecActa']);
                $intrecActa = intval($_POST['listRecursos']);
                $fltvalActa = 0;
                $intestActa = 1;
                $request_Acta = "";

                if ($idActa == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['wriPermiso']) {
                        $request_Acta = $this->model->insertActa($inttipActa, $intiteActa, $strnumActa, $strfecActa,
                                                                $intrecActa, $fltvalActa, $intestActa);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $request_Acta = $this->model->updateActa($idActa, $inttipActa, $intiteActa, $strnumActa,
                                                                $strfecActa, $intrecActa, $fltvalActa, $intestActa);
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
            $arrData = $this->model->selectActas(ACTINICIAL);
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                $btnAdd = '';
                $btnPrint = '';
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
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnAdd = '<button class="btn btn-secondary btn-sm" onClick="fntAddElemento(this,' . $arrData[$i]['idActa'] . ')" title="Agregar Elemento"><i class="fas fa-location"></i></button>';
                }
                if ($_SESSION['permisosMod']['updPermiso']) {
                    $btnPrint = '<a title="Imprimir Acta" href="'. base_url() . '/actas/imprimir/' . $arrData[$i]['idActa'] . '" target="_blank"
                                class="btn btn-warning btn-sm"> <i class="fas fa-file-pdf"></i></a> ';
                }               
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idActa'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnAdd  . ' ' .  $btnPrint . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //'<button class="btn btn-primary btn-sm" onClick="fntPrintActa(' . $arrData[$i]['idActa'] . ')" title="Imprimir Acta"><i class="fas fa-print"></i></button>';

    public function getActa($idActa)
    {
        if ($_SESSION['permisosMod']['reaPermiso']) {
            $idActa = intval($idActa);
            if ($idActa > 0) {
                $arrData = $this->model->selectActa($idActa);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrImg = $this->model->selectPdf($idActa);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }
                    $arrData['pdfs'] = $arrImg;
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        die();
    }
    
    public function imprimir($idacta) {
        if (!is_numeric($idacta)){
            header("Location:" . base_url() . '/actas');
        }
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Actas - Salp - App";
        $data['page_title'] = "IMPRIMIR ACTAS <small> SALP - APP </small>";
        $data['page_name']  = "acta";
        $data['arrPedido'] = $this->model->selectActaimp($idacta);
        $this->views->getView($this, "actapdf", $data);
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
            if (empty($_POST['actImagen'])) {
                $arrResponse = array('status' => false, 'msg' => 'dfdfError de datos.');
            } else {
                $idActa = intval($_POST['actImagen']);
                $foto = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('Y-m-d H:m:s')) . '.pdf';
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
            if (empty($_POST['actImagen']) || empty($_POST['file'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                //Eliminar el registro de la tabla imagenes
                $idActa = intval($_POST['actImagen']);
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

    
    public function setPdfacta()
    {
        if ($_POST) {
            if (empty($_POST['actImagen'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
            } else {
                $idActa = intval($_POST['actImagen']);
                $foto = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('Y-m-d H:m:s')) . '.pdf';
                $request_image = $this->model->insertPdf($idActa, $imgNombre);
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

    public function delPdfacta()
    {
        if ($_POST) {
            if (empty($_POST['actImagen']) || empty($_POST['file'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                //Eliminar el registro de la tabla imagenes
                $idActa = intval($_POST['actImagen']);
                $imgNombre = strClean($_POST['file']);
                $request_image = $this->model->deletePdf($idActa, $imgNombre);
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
