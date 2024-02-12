<?php
    class Dashboard extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
			session_regenerate_id(true);
            if (empty($_SESSION['login']))
            {
                header('location: ' . base_url() . '/login');
            }
            getPermisos(1);
        }

        public function dashboard()
        {
            $data['page_id']    = 2;
            $data['page_tag']   = "Dashboard - Cmr Pos Inventario Cartera";
            $data['page_title'] = "Dashboard - Cmr Pos Inventario Cartera";
            $data['page_name']  = "dashboard";
            $data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->cantUsuarios();
			/*
			$data['clientes'] = $this->model->cantClientes();
			$data['productos'] = $this->model->cantProductos();
			$data['pedidos'] = $this->model->cantPedidos();
			$data['lastOrders'] = $this->model->lastOrders();
			$data['productosTen'] = $this->model->productosTen();
			
			//dep($data['productosTen']);
			//exit;
			
			$anio = date('Y');
			$mes = date('m');
			$data['pagosMes'] = $this->model->selectPagosMes($anio,$mes);
			//dep($data['pagosMes']);
			$data['ventasMDia'] = $this->model->selectVentasMes($anio,$mes);
			//dep($data['ventasMDia']);exit;
			$data['ventasAnio'] = $this->model->selectVentasAnio($anio);
			//dep($data['ventasAnio']);exit;
*/
			if( $_SESSION['userData']['idRol'] == RCLIENTES ){
				$this->views->getView($this,"dashboardCliente",$data);
			}else{
				$this->views->getView($this,"dashboard",$data);
			}
		}
		/*
		public function tipoPagoMes(){
			if($_POST){
				$grafica = "tipoPagoMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectPagosMes($anio,$mes);
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}
		public function ventasMes(){
			if($_POST){
				$grafica = "ventasMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectVentasMes($anio,$mes);
				$script = getFile("Template/Modals/graficas1",$pagos);
				echo $script;
				die();
			}
		}
		public function ventasAnio(){
			if($_POST){
				$grafica = "ventasAnio";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->selectVentasAnio($anio);
				$script = getFile("Template/Modals/graficas2",$pagos);
				echo $script;
				die();
			}
		}
		*/
    }
?>