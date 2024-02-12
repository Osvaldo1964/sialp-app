<?php
	require_once("Models/TCategoria.php");
	require_once("Models/TProducto.php");
	require_once("Models/TCliente.php");
	require_once("Models/LoginModel.php");

class Tienda extends Controllers
{
    use TCategoria, TProducto, TCliente;
    public $login;
    public function __construct()
    {
        session_start();
        $this->login = new LoginModel();
        parent::__construct();
    }

    public function tienda()
    {
        $data['page_tag']   = NOMBRE_EMPRESA;
        $data['page_title'] = NOMBRE_EMPRESA;
        $data['page_name']  = "tienda";
        $data['page_content']  = "Loremsaslaslaslasl";
		$pagina = 1;
		$cantProductos = $this->cantProductos();
		$total_registro = $cantProductos['total_registro'];
		$desde = ($pagina-1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);
		$data['productos'] = $this->getProductosPage($desde, PROPORPAGINA);
		$data['pagina'] = $pagina;
		$data['total_paginas'] = $total_paginas;
		$data['categorias'] = $this->getCategorias();
        $this->views->getView($this, "tienda", $data);
    }

    public function categoria($params)
    {
        if (empty($params)) {
            header("Location:" . base_url());
        } else {
            $arrParams = explode(",", $params);
			//dep($arrParams);exit;
            $idCategoria = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
			$pagina = 1;
			if(count($arrParams) > 2 AND is_numeric($arrParams[2])){
				$pagina = $arrParams[2];
			}
			$cantProductos = $this->cantProductos($idCategoria);
			$total_registro = $cantProductos['total_registro'];
			$desde = ($pagina-1) * PROCATEGORIA;
			$total_paginas = ceil($total_registro / PROCATEGORIA);
            $infoCategoria = $this->getProductosCategoriaT($idCategoria, $ruta, $desde, PROCATEGORIA);
            $categoria = strClean($params);
            $data['page_tag']   = NOMBRE_EMPRESA .  " | " . $infoCategoria['nomCategoria'];
            $data['page_title'] = $infoCategoria['nomCategoria'];
            $data['page_name']  = "categoria";
            $data['page_content']  = "Loremsaslaslaslasl";
            $data['productos'] = $infoCategoria['productos'];
			$data['infoCategoria'] = $infoCategoria;
			$data['pagina'] = $pagina;
			$data['total_paginas'] = $total_paginas;
			$data['categorias'] = $this->getCategorias();
            $this->views->getView($this, "categoria", $data);
        }
    }

    public function producto($params)
    {
        if (empty($params)) {
            header("Location:" . base_url());
        } else {
            $arrParams = explode(",", $params);
            $idProducto = intval($arrParams[0]);
            $rutProducto = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idProducto, $rutProducto);
            if (empty($infoProducto)) {
                header("Location:" . base_url());
            }
            //dep($infoProducto);exit;
            $data['page_tag']   = NOMBRE_EMPRESA .  " | " . $infoProducto['nomProducto'];
            $data['page_title'] = $infoProducto['nomProducto'];
            $data['page_name']  = "producto";
            $data['page_content']  = "Loremsaslaslaslasl";
            $data['producto']  = $infoProducto;
            //dep($data['producto']);exit;
            $data['productos'] = $this->getProductosRandom($infoProducto['idCategoria'], 8, "r");
            $this->views->getView($this, "producto", $data);
        }
    }

    public function addCarrito()
    {
        if ($_POST) {
            //unset($_SESSION['arrCarrito']); exit;
            $arrCarrito = array();
            $cantCarrito = 0;
            $idProducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $cantidad = $_POST['cant'];
            if (is_numeric($idProducto) and is_numeric($cantidad)) {
                $arrInfoProducto = $this->getProductoIDT($idProducto);
                if (!empty($arrInfoProducto)) {
                    $arrProducto = array(
                        'idProducto' => $idProducto,
                        'producto' => $arrInfoProducto['nomProducto'],
                        'cantidad' => $cantidad,
                        'precio' => $arrInfoProducto['vtaProducto'],
                        'imagen' => $arrInfoProducto['imagenes'][0]['url_imagen']
                    );
                    if (isset($_SESSION['arrCarrito'])) {
                        $on = true;
                        $arrCarrito = $_SESSION['arrCarrito'];
                        for ($pr = 0; $pr < count($arrCarrito); $pr++) {
                            if ($arrCarrito[$pr]['idProducto'] == $idProducto) {
                                $arrCarrito[$pr]['cantidad'] += $cantidad;
                                $on = false;
                            }
                        }
                        if ($on) {
                            array_push($arrCarrito, $arrProducto);
                        }
                        $_SESSION['arrCarrito'] = $arrCarrito;
                    } else {
                        array_push($arrCarrito, $arrProducto);
                        $_SESSION['arrCarrito'] = $arrCarrito;
                    }
                    foreach ($_SESSION['arrCarrito'] as $pro) {
                        $cantCarrito += $pro['cantidad'];
                    }
                    $htmlCarrito = "";
                    $htmlCarrito = getFile('Template/Modals/modalCarrito', $_SESSION['arrCarrito']);
                    $arrResponse = array(
                        "status" => true, "msg" => 'Se agrego al carrito!',
                        "cantCarrito" => $cantCarrito,
                        "htmlCarrito" => $htmlCarrito
                    );
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Producto no existente.');
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delCarrito()
    {
        if ($_POST) {
            $arrCarrito = array();
            $cantCarrito = 0.00;
            $subtotal = 0.00;
            $idProducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $option = $_POST['option'];
            if (is_numeric($idProducto) and ($option == 1 or $option == 2)) {
                $arrCarrito = $_SESSION['arrCarrito'];
                for ($pr = 0; $pr < count($arrCarrito); $pr++) {
                    if ($arrCarrito[$pr]['idProducto'] == $idProducto) {
                        unset($arrCarrito[$pr]);
                    }
                }

                sort($arrCarrito);
                $_SESSION['arrCarrito'] = $arrCarrito;
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $cantCarrito += $pro['cantidad'];
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $htmlCarrito = "";
                if ($option == 1) {
                    $htmlCarrito = getFile('Template/Modals/modalCarrito', $_SESSION['arrCarrito']);
                }
                $arrResponse = array(
                    "status" => true, "msg" => 'Producto eliminado!',
                    "cantCarrito" => $cantCarrito,
                    "htmlCarrito" => $htmlCarrito,
                    "subtotal" => SMONEY . formatMoney($subtotal),
                    "total" => SMONEY . formatMoney($subtotal + COSTOENVIO)
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function updCarrito()
    {
        if ($_POST) {
            $arrCarrito = array();
            $totalProducto = 0.00;
            $subtotal = 0.00;
            $total = 0.00;
            $idProducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $cantidad = intval($_POST['cantidad']);
            if (is_numeric($idProducto) and $cantidad > 0) {
                $arrCarrito = $_SESSION['arrCarrito'];
                for ($p = 0; $p < count($arrCarrito); $p++) {
                    if ($arrCarrito[$p]['idProducto'] == $idProducto) {
                        $arrCarrito[$p]['cantidad'] = $cantidad;
                        $totalProducto = $arrCarrito[$p]['precio'] * $cantidad;
                        break;
                    }
                }
                $_SESSION['arrCarrito'] = $arrCarrito;
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $arrResponse = array(
                    "status" => true, "msg" => 'Producto actualizado!',
                    "totalProducto" => SMONEY . formatMoney($totalProducto),
                    "subtotal" => SMONEY . formatMoney($subtotal),
                    "total" => SMONEY . formatMoney($subtotal + COSTOENVIO),
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function registro()
    {
        if ($_POST) {
            if (
                empty($_POST['txtnomCliente']) || empty($_POST['txtapeCliente']) || empty($_POST['txttelCliente']) ||
                empty($_POST['txtemaCliente'])
            ) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $strnomCliente  = ucwords(strClean($_POST['txtnomCliente']));
                $strapeCliente  = ucwords(strClean($_POST['txtapeCliente']));
                $inttelCliente  = intval(strClean($_POST['txttelCliente']));
                $stremaCliente  = strtolower(strClean($_POST['txtemaCliente']));
                $introlCliente = 5;
                $request_user   = "";
                $strpasCliente = passGenerator();
                $strpasEncript = hash("SHA256", $strpasCliente);
                $request_user = $this->insertCliente(
                    $strnomCliente,
                    $strapeCliente,
                    $inttelCliente,
                    $stremaCliente,
                    $strpasEncript,
                    $introlCliente
                );

                if ($request_user > 0) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
                    $nombreUsuario = $strnomCliente . ' ' . $strapeCliente;
                    $dataUsuario = array(
                        'nombreUsuario' => $nombreUsuario,
                        'emailSuscriptor' => $stremaCliente,
                        'password' => $strpasCliente,
                        'asunto' => 'Bienvenido a tu tienda en línea'
                    );
                    $_SESSION['idUser'] = $request_user;
                    $_SESSION['login'] = true;
                    $_SESSION['timeout'] = true;
                    $_SESSION['inicio'] = time();
                    $this->login->sessionLogin($request_user);
                    sendMailLocal($dataUsuario, 'email_bienvenida');
                } else if ($request_user == false) {
                    $arrResponse = array("status" => false, "msg" => '¡Atención! el email ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function procesarVenta()
    {
        if ($_POST) {
            $idtranspaypal = null;
            $datospaypal = null;
            $idcliente = $_SESSION['idUser'];
            $total = 0;
            $tipopago = intval($_POST['inttipopago']);
            $direnvio = strClean($_POST['direccion']) . ', ' . strClean($_POST['ciudad']);
            $status = "Pendiente";
            $subtotal = 0;
            $costo_envio = COSTOENVIO;

            if (!empty($_SESSION['arrCarrito'])) {
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $total = formatMoney($subtotal + COSTOENVIO);
                if (empty($_POST['datapay'])) {
                    //Crear Pedido
                    $idtranspaypal = "";
                    $datospaypal = "";
                    $request_pedido = $this->insertPedido($idtranspaypal, $datospaypal, $idcliente,
                                                        $total, $tipopago, $direnvio, $costo_envio, $status);
					if ($request_pedido > 0) {
                        //Insertamos detalle
                        foreach ($_SESSION['arrCarrito'] as $producto) {
                            $productoid = $producto['idProducto'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];
                            $this->insertDetalle($request_pedido, $productoid, $precio, $cantidad);
                        }
                        $infoOrden = $this->getPedido($request_pedido);
                        $dataEmailOrden = array(
                            'asunto' => "Se ha creado la orden No." . $request_pedido,
                            'email' => $_SESSION['userData']['emaUsuario'],
                            'emailCopia' => EMAIL_PEDIDOS,
                            'pedido' => $infoOrden
                        );
                        sendMailLocal($dataEmailOrden,"email_notificacion_orden");
                        $orden = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
                        $transaccion = openssl_encrypt($idtranspaypal, METHODENCRIPT, KEY);
                        $arrResponse = array(
                            "status" => true,
                            "orden" => $orden,
                            "transaccion" => $transaccion,
                            "msg" => 'Pedido realizado'
                        );
                        $_SESSION['dataorden'] = $arrResponse;
                        unset($_SESSION['arrCarrito']);
                        session_regenerate_id(true);
                    }
                } else {
                    $jsonPaypal = $_POST['datapay'];
                    $objPaypal = json_decode($jsonPaypal);
                    $status = "Aprobado";
                    if (is_object($objPaypal)) {
                        $datospaypal = $jsonPaypal;
                        $idtranspaypal = $objPaypal->purchase_units[0]->payments->captures[0]->id;
                        if ($objPaypal->status == "COMPLETED") {
                            $totalPaypal = formatMoney($objPaypal->purchase_units[0]->amount->value);
                            if ($total == $totalPaypal) {
                                $status = "Completo";
                            }
                            //Crear Pedido
                            $request_pedido = $this->insertPedido(
                                $idtranspaypal, $datospaypal, $idcliente, $total,
                                $tipopago, $direnvio, $costo_envio, $status);
                            if ($request_pedido > 0) {
                                //Insertamos detalle
                                foreach ($_SESSION['arrCarrito'] as $producto) {
                                    $productoid = $producto['idProducto'];
                                    $precio = $producto['precio'];
                                    $cantidad = $producto['cantidad'];
                                    $this->insertDetalle($request_pedido, $productoid, $precio, $cantidad);
                                }
                                $infoOrden = $this->getPedido($request_pedido);
                                $dataEmailOrden = array(
                                    'asunto' => "Se ha creado la orden No." . $request_pedido,
                                    'email' => $_SESSION['userData']['emaUsuario'],
                                    'emailCopia' => EMAIL_PEDIDOS,
                                    'pedido' => $infoOrden
                                );
                                sendMailLocal($dataEmailOrden,"email_notificacion_orden");
                                $orden = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
                                $transaccion = openssl_encrypt($idtranspaypal, METHODENCRIPT, KEY);
                                $arrResponse = array(
                                    "status" => true,
                                    "orden" => $orden,
                                    "transaccion" => $transaccion,
                                    "msg" => 'Pedido realizado'
                                );
                                $_SESSION['dataorden'] = $arrResponse;
                                unset($_SESSION['arrCarrito']);
                                session_regenerate_id(true);
                            } else {
                                $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
                            }
                        } else {
                            $arrResponse = array("status" => false, "msg" => 'No fue posible completar el pago en Paypal.');
                        }
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'Hubo un error en la transacción.');
                    }
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
            }
        } else {
            $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function confirmarpedido()
    {
        if (empty($_SESSION['dataorden'])) {
            header("Location: " . base_url());
        } else {
            $dataorden = $_SESSION['dataorden'];
            $idpedido = openssl_decrypt($dataorden['orden'], METHODENCRIPT, KEY);
            $transaccion = openssl_decrypt($dataorden['transaccion'], METHODENCRIPT, KEY);
            $data['page_tag']   = "Confirmar Pedido";
            $data['page_title'] = "Confirmar Pedido";
            $data['page_name']  = "confirmarpedido";
            $data['page_content']  = "Loremsaslaslaslasl";
            $data['orden'] = $idpedido;
            $data['transaccion'] = $transaccion;
            $this->views->getView($this, "confirmarpedido", $data);
        }
    }
	
		public function page($pagina = null){
			$pagina = is_numeric($pagina) ? $pagina : 1;
			$cantProductos = $this->cantProductos();
			$total_registro = $cantProductos['total_registro'];
			$desde = ($pagina-1) * PROPORPAGINA;
			$total_paginas = ceil($total_registro / PROPORPAGINA);
			$data['productos'] = $this->getProductosPage($desde,PROPORPAGINA);
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = NOMBRE_EMPRESA;
			$data['page_name'] = "tienda";
			$data['pagina'] = $pagina;
			$data['total_paginas'] = $total_paginas;
			$data['categorias'] = $this->getCategorias();
			$this->views->getView($this,"tienda",$data);
		}

		public function search(){
			$pagina = is_numeric($_REQUEST['p']) ? $_REQUEST['p'] : 1;
			if(empty($_REQUEST['s'])){
				header("Location: ".base_url());
			}else{
				$busqueda = strClean($_REQUEST['s']);
			}
			$cantProductos = $this->cantProdSearch($busqueda);
			$total_registro = $cantProductos['total_registro'];
			$desde = ($pagina-1) * PROBUSCAR;
			$total_paginas = ceil($total_registro / PROBUSCAR);
			$data['productos'] = $this->getProdSearch($busqueda, $desde, PROBUSCAR);
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = "Resultado de: " . $busqueda;
			$data['page_name'] = "tienda";
			$data['pagina'] = $pagina;
			$data['total_paginas'] = $total_paginas;
			$data['busqueda'] = $busqueda;
			$data['categorias'] = $this->getCategorias();
			$this->views->getView($this, "search", $data);
		}

		public function suscripcion(){
			if($_POST){
				$nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));
				$email  = strtolower(strClean($_POST['email']));
				$suscripcion = $this->setSuscripcion($nombre,$email);
				if($suscripcion > 0){
					$arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción.");
					//Enviar correo
					$dataUsuario = array('asunto' => "Nueva suscripción",
										'emailSender' => EMAIL_SUSCRIPCION,
										'nombreSuscriptor' => $nombre,
										'email' => $email );
					sendMailLocal($dataUsuario,"email_suscripcion");
				}else{
					$arrResponse = array('status' => false, 'msg' => "El email ya fue registrado.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
}
