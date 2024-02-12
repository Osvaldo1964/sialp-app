<?php 

	class RolesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectRoles()
		{
			$whereAdmin = "";
			if ($_SESSION['idUser'] != 1){
				$whereAdmin = " AND idRol != 1";
			}
			//EXTRAE ROLES
			$sql = "SELECT * FROM roles WHERE estRol != 0" . $whereAdmin . ' ORDER BY idRol';
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectRol(int $idRol)
		{
			//BUSCAR ROLE
			$this->intIdrol = $idRol;
			$sql = "SELECT * FROM roles WHERE idRol = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
		}

		public function insertRol(string $rol, string $descripcion, int $status){

			$return = "";
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM roles WHERE nomRol = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO roles(nomRol, desRol , estRol) VALUES(?,?,?)";
	        	$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
	        	$request_insert = $this->insert($query_insert, $arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateRol(int $idRol, string $rol, string $descripcion, int $status){
			$this->intIdrol = $idRol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM roles WHERE nomRol = '$this->strRol' AND idRol != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE roles SET nomRol = ?, desRol = ?, estRol = ? WHERE idRol = $this->intIdrol";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteRol(int $idRol)
		{
			$this->intIdrol = $idRol;
			$sql = "SELECT * FROM usuarios WHERE rolUsuario = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE roles SET estRol = ? WHERE idRol = $this->intIdrol ";
				$arrData = array(0);
				$request = $this->update($sql, $arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
 ?>