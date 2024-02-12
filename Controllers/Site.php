<?php
	require_once("Models/TCategoria.php");
	require_once("Models/TProducto.php");
	require_once("Models/TCliente.php");
	require_once("Models/LoginModel.php");

class Site extends Controllers
{
    use TCategoria, TProducto, TCliente;
    public $login;
    public function __construct()
    {
        session_start();
        $this->login = new LoginModel();
        parent::__construct();
    }

    public function site()
    {
        $data['page_tag']   = NOMBRE_EMPRESA;
        $data['page_title'] = NOMBRE_EMPRESA;
        $data['page_name']  = "sialp";
        $data['page_content']  = "Loremsaslaslaslasl";
        $this->views->getView($this, "site", $data);
    }

    public function categoria($params)
    {
        if (empty($params)) {
            header("Location:" . base_url());
        } else {
            $arrParams = explode(",", $params);
			//dep($arrParams);exit;
            $idCategoria = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
			$pagina = 1;
			if(count($arrParams) > 2 AND is_numeric($arrParams[2])){
				$pagina = $arrParams[2];
			}
			$cantProductos = $this->cantProductos($idCategoria);
			$total_registro = $cantProductos['total_registro'];
			$desde = ($pagina-1) * PROCATEGORIA;
			$total_paginas = ceil($total_registro / PROCATEGORIA);
            $infoCategoria = $this->getProductosCategoriaT($idCategoria, $ruta, $desde, PROCATEGORIA);
            $categoria = strClean($params);
            $data['page_tag']   = NOMBRE_EMPRESA .  " | " . $infoCategoria['nomCategoria'];
            $data['page_title'] = $infoCategoria['nomCategoria'];
            $data['page_name']  = "categoria";
            $data['page_content']  = "Loremsaslaslaslasl";
            $data['productos'] = $infoCategoria['productos'];
			$data['infoCategoria'] = $infoCategoria;
			$data['pagina'] = $pagina;
			$data['total_paginas'] = $total_paginas;
			$data['categorias'] = $this->getCategorias();
            $this->views->getView($this, "categoria", $data);
        }
    }

		public function suscripcion(){
			if($_POST){
				$nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));
				$email  = strtolower(strClean($_POST['email']));
				$suscripcion = $this->setSuscripcion($nombre,$email);
				if($suscripcion > 0){
					$arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción.");
					//Enviar correo
					$dataUsuario = array('asunto' => "Nueva suscripción",
										'emailSender' => EMAIL_SUSCRIPCION,
										'nombreSuscriptor' => $nombre,
										'email' => $email );
					sendMailLocal($dataUsuario,"email_suscripcion");
				}else{
					$arrResponse = array('status' => false, 'msg' => "El email ya fue registrado.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
}
