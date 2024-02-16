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

		public function cantElementosGrupo(){
			$sql = "SELECT e.gruElemento, g.desGruposalp, COUNT(e.gruElemento) as total
			FROM elementos e
			INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
			WHERE estElemento != 0 GROUP BY e.gruElemento, g.desGruposalp";
			$ucaps = $this->select_all($sql);
			//$arrData = array('grafica' => 'ucapsGrupo', 'grupos' => $ucaps);
			return $ucaps;
		}

		public function cantProductos(){
			$sql = "SELECT COUNT(*) as total FROM productos WHERE estProducto != 0 ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantPedidos(){
			$rolid = $_SESSION['userData']['idRol'];
			$idUser = $_SESSION['userData']['idUsuario'];
			$where = "";
			if($rolid == RCLIENTES ){
				$where = " WHERE cliPedido = ".$idUser;
			}
			$sql = "SELECT COUNT(*) as total FROM pedidohead ".$where;
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function lastOrders(){
			$rolid = $_SESSION['userData']['idRol'];
			$idUser = $_SESSION['userData']['idUsuario'];
			$where = "";
			if($rolid == RCLIENTES ){
				$where = " WHERE p.cliPedido = ".$idUser;
			}
			$sql = "SELECT p.idPedido, CONCAT(pr.nomUsuario,' ',pr.apeUsuario) as nombre, p.valPedido, p.estPedido 
					FROM pedidohead p
					INNER JOIN usuarios pr
					ON p.cliPedido = pr.idUsuario
					$where
					ORDER BY p.idPedido DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}	
		public function selectPagosMes(int $anio, int $mes){
			$sql = "SELECT p.frmPedido, tp.desTipopago, COUNT(p.frmPedido) as cantidad, SUM(p.valPedido) as total 
					FROM pedidohead p 
					INNER JOIN tipopago tp 
					ON p.frmPedido = tp.idTipopago 
					WHERE MONTH(p.fecPedido) = $mes AND YEAR(p.fecPedido) = $anio GROUP BY frmPedido, tp.desTipopago";
			//dep($sql);exit;
			$pagos = $this->select_all($sql);
			$meses = Meses();
			$arrData = array('grafica' => 'tipoPagoMes', 'anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos );
			return $arrData;
		}
		public function selectVentasMes(int $anio, int $mes){
			$rolid = $_SESSION['userData']['idRol'];
			$idUser = $_SESSION['userData']['idUsuario'];
			$where = "";
			if($rolid == RCLIENTES ){
				$where = " AND cliPedido= ".$idUser;
			}
			$totalVentasMes = 0;
			$arrVentaDias = array();
			$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
			$n_dia = 1;
			for ($i=0; $i < $dias ; $i++) { 
				$date = date_create($anio."-".$mes."-".$n_dia);
				$fechaVenta = date_format($date,"Y-m-d");
				$sql = "SELECT DAY(fecPedido) AS dia, COUNT(idPedido) AS cantidad, SUM(valPedido) AS total 
						FROM pedidohead 
						WHERE DATE(fecPedido) = '$fechaVenta' AND estPedido = 'Completo' ".$where;
				$ventaDia = $this->select($sql);
				$ventaDia['dia'] = $n_dia;
				$ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];
				$totalVentasMes += $ventaDia['total'];
				array_push($arrVentaDias, $ventaDia);
				$n_dia++;
			}
			$meses = Meses();
			$arrData = array('grafica' => 'ventasMes', 'anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes,'ventas' => $arrVentaDias );
			return $arrData;
		}
		public function selectVentasAnio(int $anio){
			$arrMVentas = array();
			$arrMeses = Meses();
			for ($i=1; $i <= 12; $i++) { 
				$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');
				$sql = "SELECT $anio AS anio, $i AS mes, SUM(valPedido) AS venta 
						FROM pedidohead 
						WHERE MONTH(fecPedido)= $i AND YEAR(fecPedido) = $anio AND estPedido = 'Completo' 
						GROUP BY MONTH(fecPedido) ";
				$ventaMes = $this->select($sql);
				$arrData['mes'] = $arrMeses[$i-1];
				if(empty($ventaMes)){
					$arrData['anio'] = $anio;
					$arrData['no_mes'] = $i;
					$arrData['venta'] = 0;
				}else{
					$arrData['anio'] = $ventaMes['anio'];
					$arrData['no_mes'] = $ventaMes['mes'];
					$arrData['venta'] = $ventaMes['venta'];
				}
				array_push($arrMVentas, $arrData);
				# code...
			}
			$arrVentas = array('grafica' => 'ventasAnio', 'anio' => $anio, 'meses' => $arrMVentas);
			return $arrVentas;
		}
		public function productosTen(){
			$sql = "SELECT * FROM productos WHERE estProducto = 1 ORDER BY idProducto DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>