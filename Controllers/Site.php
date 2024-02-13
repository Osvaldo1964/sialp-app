<?php
	require_once("Models/LoginModel.php");

class Site extends Controllers
{
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
