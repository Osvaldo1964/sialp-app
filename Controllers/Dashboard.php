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
			$data['grupos'] = $this->model->cantElementosGrupo();
			$anio = date('Y');
			$mes = date('m');
			$data['pqrs'] = $this->model->cantPqrs($anio,$mes);
			$this->views->getView($this,"dashboard",$data);
  		}
	}
?>