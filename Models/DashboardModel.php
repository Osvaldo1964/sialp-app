<?php 
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function cantUsuarios(){
			$sql = "SELECT COUNT(*) as total FROM usuarios WHERE estUsuario != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantClientes(){
			$sql = "SELECT COUNT(*) as total FROM usuarios WHERE estUsuario != 0 AND rolUsuario = ".RCLIENTES;
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantElementos(){
			$sql = "SELECT COUNT(*) as total
			FROM elementos 
			WHERE estElemento != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantElementosClase(){
			$sql = "SELECT e.claElemento, c.desClase, COUNT(e.claElemento) as total
			FROM elementos e
			INNER JOIN clases c ON e.claElemento = c.idClase
			WHERE estElemento != 0 GROUP BY e.claElemento, c.desClase";
			$ucaps = $this->select_all($sql);
			//$arrData = array('grafica' => 'ucapsGrupo', 'grupos' => $ucaps);
			return $ucaps;
		}
		public function cantPqrs(int $anio, int $mes){
			$sql = "SELECT estPqrs, COUNT(estPqrs) as total 
					FROM pqrs 
					WHERE MONTH(frePqrs) = $mes AND YEAR(frePqrs) = $anio GROUP BY estPqrs";
			$cantpqrs = $this->select_all($sql);
			$meses = Meses();
			$arrData = array('grafica' => 'tipoPagoMes', 'anio' => $anio, 'mes' => $meses[intval($mes-1)], 'pqrs' => $cantpqrs );
			return $arrData;
		}
		public function productosTen(){
			$sql = "SELECT * FROM productos WHERE estProducto = 1 ORDER BY idProducto DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>