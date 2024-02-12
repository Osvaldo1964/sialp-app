<?php

    class Login extends Controllers{

        public function __construct()
        {
			session_start();
			//session_regenerate_id(true);
            if (isset($_SESSION['login']))
            {
                header('location: ' . base_url() . '/dashboard');
				die();
            }
            parent::__construct();
        }

        public function login()
        {
            $data['page_tag'] = "Ingreso - CMR pos facturación";
            $data['page_title'] = "<small> CMR Pos Facturación</small> - Acceso";
            $data['page_name'] = "login";
            $data['page_functions_js'] = "functions_login.js";
            $this->views->getView($this, "login", $data);
        }

        public function loginUsuario(){
            if ($_POST){
                if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                }else{
                    $strUsuario = strtolower(strClean($_POST['txtEmail']));
                    $strPassword = hash("SHA256", $_POST['txtPassword']);
                    $requestUsuario = $this->model->loginUsuario($strUsuario, $strPassword);
                    if (empty($requestUsuario)){
                        $arrResponse = array('status' => false, 'msg' => 'El Usuario o la Contraseña son incorrectos.');
                    }else{
                        $arrData = $requestUsuario;
                        if ($arrData['estUsuario'] == 1){
                            $_SESSION['idUser'] = $arrData['idUsuario'];
                            $_SESSION['login'] = true;
                            $_SESSION['timeout'] = true;
                            $_SESSION['inicio'] = time();
                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            $arrData = $this->model->getParametros();
                            sessionUser($_SESSION['idUser']);
                            $arrResponse = array('status' => true, 'msg' => 'Ok.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo.');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function resetPass(){
            if ($_POST){
                if (empty($_POST['txtEmailReset'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $token = token();
                    $strEmail = strtolower(strClean($_POST['txtEmailReset']));
                    $arrData = $this->model->getUserEmail($strEmail);
                    if (empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'Usuario No existente.');
                    }else{
                        $idpersona = $arrData['idUsuario'];
                        $nombreUsuario = $arrData['nomUsuario'] . ' ' . $arrData['apeUsuario'];
                        $url_recovery = base_url() . '/login/confirmUser/' . $strEmail . '/' . $token;
                        $requestUpdate = $this->model->setTokenUser($idpersona, $token);

                        $url_recovery = base_url() . '/login/confirmUser/' . $strEmail . '/' . $token;
                        $dataUsuario = array('nombreUsuario' => $nombreUsuario, 'email' => $strEmail,
                                            'asunto' => 'Recuperar Cuenta  - ' . NOMBRE_REMITENTE,
                                            'url_recovery' => $url_recovery);
                        if ($requestUpdate){
                            $sendEmail = sendMail($dataUsuario, 'email_cambioPassword');
                            if ($sendEmail){
                                $arrResponse = array('status' => true, 'msg' => 'Se ha enviado un correo para realizar
                                                    el cambio de contraseña.');
                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso,
                                                    intenta mas tarde.');
                            }
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso,
                                                                            intenta mas tarde.');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function confirmUser(string $params){

            if (empty($params)){
                header('Location:' . base_url());
            }else{
                $arrParams = explode(',', $params);
                $strEmail = strClean($arrParams[0]);
                $strToken = strClean($arrParams[1]);

                $arrResponse = $this->model->getUsuario($strEmail, $strToken);
                if (empty($arrResponse)){
                    header("Location: " . base_url());
                }else{
                    $data['page_tag'] = "Cambiar contraseña";
                    $data['page_name'] = "cambiar_contraseña";
                    $data['page_title'] = "Cambiar Contraseña";
                    $data['email'] = $strEmail;
                    $data['token'] = $strToken;
                    $data['idpersona'] = $arrResponse['idUsuario'];
                    $data['page_functions_js'] = "functions_login.js";
                    $this->views->getView($this,"cambiar_password", $data);
                }
            }
            die();
        }

        public function setPassword(){
            if (empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) ||
            empty($_POST['txtEmail']) || empty($_POST['txtToken'])){
                $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            }else{
                $intidPersona = intval($_POST['idUsuario']);
                $strPassword = $_POST['txtPassword'];
                $strEmail = strClean($_POST['txtEmail']);
                $strToken = strClean($_POST['txtToken']);
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];

                if ($strPassword != $strPasswordConfirm){
                    $arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales.');
                }else{
                    $arrResponseUser = $this->model->getUsuario($strEmail, $strToken);
                    if (empty($arrResponseUser)){
                        $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                    }else{
                        $strPassword = hash("SHA256", $strPassword);
                        $requestPass  = $this->model->insertPassword($intidPersona, $strPassword);

                        if ($requestPass){
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con exito.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso,
                                                intente mas tarde.');
                        }
                    }
                }
            }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        }
    }
?>