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
            $data['page_tag']   = "SISTEMA DE REGISTRO Y CONTROL ALUMBRADO PUBLICO - SALP - PLATO";
            $data['page_title'] = "SISTEMA DE REGISTRO Y CONTROL ALUMBRADO PUBLICO - SALP - PLATO";
            $data['page_name']  = "dashboard";
            $data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->cantUsuarios();
			$data['elementos'] = $this->model->cantElementos();
			$data['clases'] = $this->model->cantElementosClase();
			$anio = date('Y');
			$mes = date('m');
			$data['pqrs2'] = $this->model->cantPqrs($anio,$mes);
			$data['pqrs'] = $data['pqrs2']['pqrs'];
			//dep($data);exit;
			$this->views->getView($this,"dashboard",$data);
  		}

          public function pqrsMes(){
			if($_POST){
				$grafica = "pqrMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->cantPqrs($anio,$mes);
				$script = getFile("Template/Modals/grafpqrs",$pagos);
				echo $script;
				die();
			}
		}
	}
?>