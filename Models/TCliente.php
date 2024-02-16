<?php

require_once("Libraries/Core/Mysql.php");
trait TCliente
{
    private $con;
    private $intidUsuario;
    private $strnomUsuario;
    private $strapeUsuario;
    private $inttelUsuario;
    private $stremaUsuario;
    private $strpasUsuario;
    private $strtokUsuario;
    private $introlUsuario;
    private $intidTransaccion;

    public function insertCliente(string $nombre, string $apellido, int $telefono,
                                    string $email, string $contraseña, int $rol) {
        $this->con = new Mysql();
        $this->strnomUsuario    = $nombre;
        $this->strapeUsuario    = $apellido;
        $this->inttelUsuario    = $telefono;
        $this->stremaUsuario    = $email;
        $this->strpasUsuario    = $contraseña;
        $this->introlUsuario    = $rol;
        $return = 0;

        $sql = "SELECT * FROM usuarios WHERE emaUsuario = '{$this->stremaUsuario}'";
        $request = $this->con->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO usuarios (nomUsuario, apeUsuario, telUsuario, emaUsuario, pasUsuario,
                            rolUsuario) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->strnomUsuario, $this->strapeUsuario, $this->inttelUsuario, $this->stremaUsuario,
                            $this->strpasUsuario, $this->introlUsuario);
            $request_insert = $this->con->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = false;
        }
        return $return;
    }

    public function insertPedido(string $idtranspaypal = NULL, string $datospaypal = NULL, int $idcliente,
                                    $total, int $tipopago, string $direnvio, $costo_envio, string $status){
        $this->con = new Mysql();
        $query_insert = "INSERT INTO pedidohead (traPedido, datPedido, cliPedido, valPedido, frmPedido,
                            envPedido, domPedido, estPedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $arrData = array($idtranspaypal, $datospaypal, $idcliente, $total, $tipopago, $direnvio, $costo_envio, $status);
        $request_insert = $this->con->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function insertDetalle(int $idpedido, int $productoid, float $total, float $cantidad){
        $this->con = new Mysql();
        $query_insert = "INSERT INTO pedidobody (idPedido, idProducto, cstBody, vtaBody, desBody, canBody)
                        VALUES (?, ?, ?, ?, ?, ?)";
        $arrData = array($idpedido, $productoid, 0.00, $total, 0.00, $cantidad);
        $request_insert = $this->con->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }
	
    public function insertDetalleTemp(array $pedido){
        $this->intidUsuario = $pedido['idCliente'];
        $this->intidTransaccion = $pedido['idTransaccion'];
        $productos = $pedido['productos'];

        $this->con = new Mysql();
        $sql = "SELECT * FROM detalletemp WHERE traTemporal = '{$this->intidTransaccion}' AND 
                cliTemporal = $this->intidUsuario";
        $request = $this->con->select_all($sql);
        if (!empty($request)){
            $sqlDel = "DELETE FROM detalletemp WHERE traTemporal = '{$this->intidTransaccion}' AND 
            cliTemporal = $this->intidUsuario";
            $request = $this->con->delete($sqlDel);
        }
        foreach ($productos as $producto){
            $query_insert = "INSERT INTO detalletemp (cliTemporal, proTemporal, valTemporal, canTemporal, traTemporal) VALUES
                            (?, ?, ?, ?, ?)";
            $arrData = array($this->intidUsuario, $producto['idProducto'],
                            $producto['precio'], $producto['cantidad'],
                            $this->intidTransaccion);
            $request_insert = $this->con->insert($query_insert, $arrData);
        }
    }

    public function getPedido($idpedido){
        $this->con = new Mysql();
        $request = array();
        $sql = "SELECT p.idPedido, p.refPedido, p.traPedido, cliPedido, p.fecPedido, p.valPedido,
                        p.frmPedido, t.desTipopago, p.envPedido, p.domPedido, p.estPedido
                        FROM pedidohead as p
                        INNER JOIN tipopago as t
                        ON p.frmPedido = t.idTipopago
                        WHERE p.idPedido = $idpedido";
        $requestPedido = $this->con->select($sql);
        if (count($requestPedido) > 0){
            $sql_detalle = "SELECT p.idProducto, p.nomProducto, d.vtaBody, d.canBody
                            FROM pedidobody as d
                            INNER JOIN productos as p
                            ON d.idProducto = p.idProducto
                            WHERE d.idPedido = $idpedido";
            $requestProductos = $this->con->select_all($sql_detalle);
            $request = array('orden' => $requestPedido,
                            'detalle' => $requestProductos);
        }
        return $request;
    }

    public function getClientesT()
    {
        $this->con = new Mysql();
        $request = array();
        $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario, telUsuario, emaUsuario,
                tipUsuario, razUsuario, actUsuario, repUsuario, efaUsuario
                FROM usuarios WHERE rolUsuario = 5 and estUsuario != 0";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getClienteT(int $idCliente)
    {
        $this->intidUsuario = $idCliente;
        $this->con = new Mysql();
        $request = array();
        $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario, telUsuario,
                       emaUsuario, tipUsuario, razUsuario, actUsuario, repUsuario, efaUsuario
                       FROM usuarios
                       WHERE idUsuario = $this->intidUsuario AND rolUsuario = 5";
        $request = $this->con->select($sql);
        return $request;
    }

    public function setSuscripcion(string $nombre, string $email){
		$this->con = new Mysql();
		$sql = 	"SELECT * FROM suscripciones WHERE emaSuscripcion = '{$email}'";
		$request = $this->con->select_all($sql);
		if(empty($request)){
			$query_insert  = "INSERT INTO suscripciones (nomSuscripcion, emaSuscripcion) VALUES(?,?)";
			$arrData = array($nombre, $email);
			$request_insert = $this->con->insert($query_insert, $arrData);
			$return = $request_insert;
		}else{
			$return = false;
		}
		return $return;
	}

    public function setContacto(string $nombre, string $email, string $mensaje, string $ip, string $dispositivo, string $useragent){
		$this->con = new Mysql();
		$nombre  	 = $nombre != "" ? $nombre : ""; 
		$email 		 = $email != "" ? $email : ""; 
		$mensaje	 = $mensaje != "" ? $mensaje : ""; 
		$ip 		 = $ip != "" ? $ip : ""; 
		$dispositivo = $dispositivo != "" ? $dispositivo : ""; 
		$useragent 	 = $useragent != "" ? $useragent : ""; 
		$query_insert  = "INSERT INTO contacto(nomContacto, emaContacto, msgContacto, ipdContacto, disContacto, ageContacto) 
						  VALUES(?,?,?,?,?,?)";
		$arrData = array($nombre,$email,$mensaje,$ip,$dispositivo,$useragent);
		$request_insert = $this->con->insert($query_insert,$arrData);
		return $request_insert;
	}

    public function setPqr(string $nombre, string $email, string $direccion, string $mensaje){
		$this->con = new Mysql();
		$nombre  	 = $nombre != "" ? $nombre : ""; 
		$email 		 = $email != "" ? $email : ""; 
        $direccion 	 = $direccion != "" ? $direccion : ""; 
		$mensaje	 = $mensaje != "" ? $mensaje : ""; 
		$query_insert  = "INSERT INTO pqrs (nomPqrs, emaPqrs, dirPqrs, msgPqrs) 
						  VALUES(?,?,?,?)";
		$arrData = array($nombre, $email, $direccion, $mensaje);
		$request_insert = $this->con->insert($query_insert,$arrData);
		return $request_insert;
	}
}
?>