<?php
    require_once ("Models/TTipoPago.php");
    class Pedidos extends Controllers
    {
        use TTipoPago;
        public function __construct()
        {
            parent::__construct();
            sessionStart();
            session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('location: ' . base_url() . '/login');
                die();
            }
            getPermisos(MPEDIDOS);
        }

        public function Pedidos()
        {
            if (empty($_SESSION['permisosMod']['reaPermiso'])) {
                header("Location:" . base_url() . '/dashboard');
            }
            $data['page_tag']   = "Pedidos";
            $data['page_title'] = "PEDIDOS <small> Cmr Pos Facturación </small>";
            $data['page_name']  = "pedidos";
            $data['page_functions_js'] = "functions_pedidos.js";
            $this->views->getView($this, "pedidos", $data);
        }

        public function getPedidos(){
            //dep($_SESSION);die();
            if ($_SESSION['permisosMod']['reaPermiso']) {
                $idpersona = "";
                if ($_SESSION['userData']['idRol'] == RCLIENTES){
                    $idpersona = $_SESSION['userData']['idUsuario'];
                }
                $arrData = $this->model->selectPedidos($idpersona);
                //dep($arrData);
                for ($i = 0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
                    $arrData[$i]['refPedido'] = $arrData[$i]['refPedido'];
                    if ($arrData[$i]['traPedido'] != ""){
                        $arrData[$i]['refPedido'] = $arrData[$i]['traPedido'];
                    }
                    $arrData[$i]['nomUsuario'] = $arrData[$i]['nomUsuario'] . " " . $arrData[$i]['apeUsuario'];
                    $arrData[$i]['valPedido'] = SMONEY . ' ' . formatMoney($arrData[$i]['valPedido']);

                    if ($_SESSION['permisosMod']['reaPermiso']) {
                        $btnView .= '<a title="Ver detalle" href="'. base_url() . '/pedidos/orden/' . $arrData[$i]['idPedido'] . '" target="_blanck"
                                    class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>                        

                                    <a title="Generar PDF" href="'. base_url() . '/factura/generarFactura/' . $arrData[$i]['idPedido'] . '" target="_blanck"
                                    class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i></a> ';
                        if ($arrData[$i]['idTipopago'] == 1){
                            $btnView .= '<a title="Ver Transacción" href="'. base_url() . '/pedidos/transaccion/' . $arrData[$i]['traPedido'] . '" target="_blanck"
                            class="btn btn-info btn-sm"> <i class="fa fa-paypal"></i></a>';
                        }else{
                            $btnView .= '<button class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal" aria-hidden="true">
                                        </i></button>';
                        }
                    }
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this, ' . $arrData[$i]['idPedido'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    }
/*                     if ($_SESSION['permisosMod']['delPermiso']) {
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idPedido'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                    } */
                    $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
                }
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function orden($idpedido) {
            if (!is_numeric($idpedido)){
                header("Location:" . base_url() . '/pedidos');
            }
            if (empty($_SESSION['permisosMod']['reaPermiso'])) {
                header("Location:" . base_url() . '/dashboard');
            }
            $idpersona = "";
            if ($_SESSION['userData']['idRol'] == RCLIENTES){
                $idpersona = $_SESSION['userData']['idUsuario'];
            }
            $data['page_tag']   = "Pedido - Tienda Virtual";
            $data['page_title'] = "PEDIDO <small> Tienda Virtual </small>";
            $data['page_name']  = "pedido";
            $data['arrPedido'] = $this->model->selectPedido($idpedido, $idpersona);
            $this->views->getView($this, "orden", $data);
        }

        public function transaccion($transaccion) {
            if (empty($_SESSION['permisosMod']['reaPermiso'])) {
                header("Location:" . base_url() . '/dashboard');
            }
            $idpersona = "";
            if ($_SESSION['userData']['idRol'] == RCLIENTES){
                $idpersona = $_SESSION['userData']['idUsuario'];
            }
            $requestTransaccion = $this->model->selectTansPaypal($transaccion, $idpersona);
            //dep($requestTransaccion);exit;
            $data['page_tag']   = "Detalles de la Transacción - Tienda Virtual";
            $data['page_title'] = "Detalles de la Transacción";
            $data['page_name']  = "detalle_transaccion";
            $data['page_functions_js']  = "functions_pedidos.js";
            $data['objTransaccion'] = $requestTransaccion;
            $this->views->getView($this, "transaccion", $data);
        }

        public function getTransaccion(string $transaccion){
            if($_SESSION['permisosMod']['reaPermiso'] and $_SESSION['userData']['idRol'] != RCLIENTES){
                if($transaccion == ""){
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $transaccion = strClean($transaccion);
                    $requestTransaccion = $this->model->selectTansPaypal($transaccion);
                    if(empty($requestTransaccion)){
                        $arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
                    }else{
                        $htmlModal = getFile("Template/Modals/modalReembolso",$requestTransaccion);
                        $arrResponse = array("status" => true, "html" => $htmlModal);
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    
        public function setReembolso(){
            if($_POST){
                if($_SESSION['permisosMod']['updPermiso'] and $_SESSION['userData']['idRol'] != RCLIENTES){
                    //dep($_POST);
                    $transaccion = strClean($_POST['idtransaccion']);
                    $observacion = strClean($_POST['observacion']);
                    $requestTransaccion = $this->model->reembolsoPaypal($transaccion,$observacion);
                    if($requestTransaccion){
                        $arrResponse = array("status" => true, "msg" => "El reembolso se ha procesado.");
                    }else{
                        $arrResponse = array("status" => false, "msg" => "No es posible procesar el reembolso.");
                    }
                }else{
                    $arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, consulte al administrador.");
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    
        public function getPedido(string $pedido){
            if($_SESSION['permisosMod']['updPermiso'] and $_SESSION['userData']['idRol'] != RCLIENTES){
                if($pedido == ""){
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $requestPedido = $this->model->selectPedido($pedido,"");
                    if(empty($requestPedido)){
                        $arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
                    }else{
                        $requestPedido['tipospago'] = $this->getTiposPagoT();
                        $htmlModal = getFile("Template/Modals/modalPedido",$requestPedido);
                        $arrResponse = array("status" => true, "html" => $htmlModal);
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    
        public function setPedido(){
            if($_POST){
                if($_SESSION['permisosMod']['updPermiso'] and $_SESSION['userData']['idRol'] != RCLIENTES){
                    $idpedido = !empty($_POST['idpedido']) ? intval($_POST['idpedido']) : "";
                    $estado = !empty($_POST['listEstado']) ? strClean($_POST['listEstado']) : "";
                    $idtipopago =  !empty($_POST['listTipopago']) ? intval($_POST['listTipopago']) : "";
                    $transaccion = !empty($_POST['txtTransaccion']) ? strClean($_POST['txtTransaccion']) : "";
                    $idcliente = $_POST['idcliente'];
                    $total = $_POST['totalpedido'];
                    $factura = '';
                    if($idpedido == ""){
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    }else{
                        if($idtipopago == ""){
                            if($estado == ""){
                                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                            }else{
                                $requestPedido = $this->model->updatePedido($idpedido, "", "", $estado);
                                if($requestPedido){
                                    $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
                                }else{
                                    $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                                }
                            }
                        }else{
                            if($transaccion == "" or $idtipopago =="" or $estado == ""){
                                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                            }else{
                                if ($idtipopago == 5){
                                    $requestFactura = $this->model->insertFactura($idcliente, $idpedido, $total);
                                    if ($requestFactura){
                                        $transaccion = $requestFactura;
                                    }
                                }
                                $requestPedido = $this->model->updatePedido($idpedido, $transaccion, $idtipopago, $estado);
                                if($requestPedido){
                                    $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente"); 
                                }else{
                                    $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                                }
                            }
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function insertFactura(){
            if($_POST){
                $idcliente = $_POST['cliente']; 
                $pedido = $_POST['pedido']; 
                $total = $_POST['total'];
                $requestFactura = $this->model->insertFactura($idcliente, $pedido, $total);
                if($requestFactura){
                    $arrResponse = array("status" => true, 'factura' => $requestFactura , "msg" => "Consecutivo de Factura obtenido.");
                }else{
                    $arrResponse = array("status" => false, "msg" => "No es posible obtener el consecutivo.");
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
