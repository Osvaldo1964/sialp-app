<?php
    class FacturaModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
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
    }
?>