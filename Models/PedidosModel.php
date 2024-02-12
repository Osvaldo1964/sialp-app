<?php
    class PedidosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectPedidos($idpersona = null ){
            $where = "";
            if ($idpersona != null){
                $where = " WHERE p.cliPedido = " . $idpersona;
            }
            $sql = "SELECT p.idPedido, p.refPedido, p.traPedido, p.cliPedido, u.nomUsuario, u.apeUsuario,
                    DATE_FORMAT(p.fecPedido, '%Y-%m-%d') as fecPedido, p.valPedido, tp.desTipopago,
                    tp.idTipopago, p.estPedido
                    FROM pedidohead p
                    INNER JOIN usuarios u ON p.cliPedido = u.idUsuario
                    INNER JOIN tipopago tp ON p.frmPedido = tp.idTipopago $where";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPedido(int $idpedido, $idpersona = null){
            $busqueda = "";
            if ($idpersona != null){
                $busqueda = " AND p.cliPedido = " . $idpersona;
            }
            $request = array();
            $sql = "SELECT p.idPedido, p.refPedido, p.traPedido, p.cliPedido, u.nomUsuario, u.apeUsuario,
                    DATE_FORMAT(p.fecPedido, '%Y-%m-%d') as fecPedido, p.valPedido, tp.desTipopago,
                    tp.idTipopago, p.estPedido
                    FROM pedidohead p
                    INNER JOIN usuarios u ON p.cliPedido = u.idUsuario
                    INNER JOIN tipopago tp ON p.frmPedido = tp.idTipopago
                    WHERE p.idPedido = $idpedido" . $busqueda;
            $requestPedido = $this->select($sql);
            if (!empty($requestPedido)){
                $idpersona = $requestPedido['cliPedido'];
                $sql_cliente = "SELECT idUsuario, nomUsuario, apeUsuario, telUsuario, emaUsuario, dirUsuario
                                FROM usuarios
                                WHERE idUsuario = $idpersona";
                $requestCliente = $this->select($sql_cliente);
                $sql_detalle = "SELECT p.idProducto, p.nomProducto, d.vtaBody, d.canBody
                            FROM pedidobody as d
                            INNER JOIN productos as p
                            ON d.idProducto = p.idProducto
                            WHERE d.idPedido = $idpedido";
                $requestProductos = $this->select_all($sql_detalle);
                $request = array('cliente' => $requestCliente,
                                'orden' => $requestPedido,
                                'detalle' => $requestProductos);
            }
            return $request;
        }   

        public function selectTansPaypal(string $idtransaccion, $idpersona = NULL){
            $busqueda = "";
            if ($idpersona != null){
                $busqueda = " AND cliPedido = " . $idpersona;
            }
            $objTransaccion = array();
            $sql = "SELECT datPedido FROM pedidohead  WHERE traPedido = '{$idtransaccion}' " . $busqueda;
            $requestData = $this->select($sql);
            if (!empty($requestData)){
                $objData = json_decode($requestData['datPedido']);
                //dep($objData);exit;
                //$urlOrden = $objData->purchase_units[0]->payments->captures[0]-links[0]->href;
                $urlOrden = $objData->links[0]->href;
                $objTransaccion = CurlConnectionGet($urlOrden,"application/json",getTokenPaypal());
            }
            return $objTransaccion;
        }

        public function reembolsoPaypal(string $idtransaccion, string $observacion){
			$response = false;
			$sql = "SELECT idPedido, datPedido FROM pedidohead WHERE traPedido = '{$idtransaccion}' ";
			$requestData = $this->select($sql);
			if(!empty($requestData)){
				$objData = json_decode($requestData['datPedido']);
                dep($objData);exit;
				$urlReembolso = $objData->links[0]->href;
				$objTransaccion = CurlConnectionPost($urlReembolso,"application/json",getTokenPaypal());
                dep($objTransaccion);exit;
				if(isset($objTransaccion->status) and  $objTransaccion->status == "COMPLETED"){
					$idpedido = $requestData['idPedido'];
					$idtrasaccion = $objTransaccion->id;
					$status = $objTransaccion->status;
					$jsonData = json_encode($objTransaccion);
					$observacion = $observacion;
					$query_insert  = "INSERT INTO reembolsos (idPedido, traReembolso, datReembolso, obsReembolso, estReembolso) 
								  	VALUES(?,?,?,?,?)";
					$arrData = array($idpedido, $idtrasaccion, $jsonData, $observacion, $status);
					$request_insert = $this->insert($query_insert,$arrData);
                    //dep($request_insert);exit;
					if($request_insert > 0){
	        			$updatePedido  = "UPDATE pedidohead SET estPedido = ? WHERE idPedido = $idpedido";
			        	$arrPedido = array("Reembolsado");
			        	$request = $this->update($updatePedido,$arrPedido);
			        	$response = true;
	        		}
				}
				return $response;
			}
		}

        public function updatePedido(int $idpedido, string $transaccion = NULL, string $idtipopago = NULL, string $estado){
            if ($transaccion == null){
                $query_insert = "UPDATE pedidohead SET estPedido = ? WHERE idPedido = $idpedido";
                $arrData = array($estado);
            }else{
                $query_insert = "UPDATE pedidohead SET refPedido = ?, frmPedido = ?, estPedido = ? WHERE idPedido = $idpedido";
                $arrData = array($transaccion, $idtipopago, $estado);
            }
            $request_insert = $this->update($query_insert, $arrData);
            return $request_insert;
        }

        public function insertFactura(int $idcliente, int $pedido, float $total ){
            $factura = intval($_SESSION['parametros']['facParam'] + 1);
            $fecha = date("Y-m-d");
            $this->con = new Mysql();
            $query_insert = "INSERT INTO facturas (cliFactura, numFactura, fecFactura, valFactura) VALUES (?, ?, ?, ?)";
            $arrData = array($idcliente, $factura, $fecha, $total);
            $request_insert = $this->con->insert($query_insert, $arrData);
            $return = $request_insert;
            return $return;
        }

    }
?>