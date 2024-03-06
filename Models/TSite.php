<?php

require_once("Libraries/Core/Mysql.php");
trait TSite
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

    public function setPqr(string $nombre, string $email, string $direccion, string $mensaje,
                            float $latitud, float $longitud, string $newdireccion){
		$this->con = new Mysql();
		$nombre  	 = $nombre != "" ? $nombre : ""; 
		$email 		 = $email != "" ? $email : ""; 
        $direccion 	 = $direccion != "" ? $direccion : ""; 
		$mensaje	 = $mensaje != "" ? $mensaje : ""; 
        $query_insert  = "INSERT INTO pqrs (nomPqrs, emaPqrs, dirPqrs, msgPqrs, latPqrs, lonPqrs, ndiPqrs) 
                          VALUES(?,?,?,?,?,?,?)";
        $arrData = array($nombre, $email, $direccion, $mensaje, $latitud, $longitud, $newdireccion);
		$request_insert = $this->con->insert($query_insert,$arrData);
		return $request_insert;
	}
}
?>