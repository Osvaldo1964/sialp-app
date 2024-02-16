<?php 
	class Pqrs extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			getPermisos(MDPAGINAS);
		}

		public function pqrs()
		{
			$pageContent = getPageRout('pqrs');
			if(empty($pageContent)){
				header("Location: ".base_url());
			}else{
				$data['page_tag'] = NOMBRE_EMPRESA;
				$data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
				$data['page_name'] = $pageContent['titulo'];
				$data['page'] = $pageContent;
				$data['page_functions_js'] = "functions_map.js";
				$this->views->getView($this,"pqrs",$data);  
			}
		}

	}
?>