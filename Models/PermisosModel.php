<?php 

	class PermisosModel extends Mysql
	{
		public $intidPermiso;
		public $intidRol;
		public $intidModulo;
		public $reaPermiso;
		public $wriPermiso;
		public $updPermiso;
		public $delPermiso;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectModulos()
		{
			$sql = "SELECT * FROM modulos WHERE estModulo != 0";
			$request = $this->select_all($sql);
			return $request;
		}	

		public function selectPermisosRol(int $idRol)
		{
			$this->intidRol = $idRol;
			$sql = "SELECT * FROM permisos WHERE idRol = $this->intidRol";
			$request = $this->select_all($sql);
			//var_dump($request);die();
			return $request;
		}

		public function deletePermisos(int $idRol)
		{
			$this->intidRol = $idRol;
			$sql = "DELETE FROM permisos WHERE idRol = $this->intidRol";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertPermisos(int $idRol, int $idModulo, int $reaPermiso, int $wriPermiso, int $updPermiso, int $delPermiso){
			$this->intidRol = $idRol;
			$this->intidModulo = $idModulo;
			$this->reaPermiso = $reaPermiso;
			$this->wriPermiso = $wriPermiso;
			$this->updPermiso = $updPermiso;
			$this->delPermiso = $delPermiso;
			$query_insert  = "INSERT INTO permisos (idRol, idModulo, reaPermiso, wriPermiso, updPermiso, delPermiso) VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->intidRol, $this->intidModulo, $this->reaPermiso, $this->wriPermiso, $this->updPermiso, $this->delPermiso);
        	$request_insert = $this->insert($query_insert, $arrData);		
	        return $request_insert;
		}

		public function permisosModulo(int $idRol){
			$this->intidRol = $idRol;
			$sql = "SELECT idRol, p.idModulo, titModulo as modulo, reaPermiso, wriPermiso, updPermiso,
					delPermiso FROM permisos p
					INNER JOIN modulos m ON p.idModulo = m.idModulo
					WHERE idRol = $this->intidRol" ;
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++){
				$arrPermisos[$request[$i]['idModulo']] = $request[$i];
			}
			return $arrPermisos;
		}

		public function getRol(int $idRol){
			$this->intidRol = $idRol;
			$sql = "SELECT * FROM roles WHERE idRol = $this->intidRol";
			$request = $this->select($sql);
			return $request;
		}
	}
 ?>