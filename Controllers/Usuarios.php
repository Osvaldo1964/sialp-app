<?php
    class Usuarios extends Controllers
    {
        public function __construct()
        {
            sessionStart();
            parent::__construct();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('location: ' . base_url() . '/login');
            }
            getPermisos(2);
        }

        public function usuarios()
        {
            if (empty($_SESSION['permisosMod']['reaPermiso'])) {
                header("Location:" . base_url() . '/dashboard');
            }
            $data['page_tag']   = "Usuarios";
            $data['page_title'] = "USUARIOS <small> SALP - APP </small>";
            $data['page_name']  = "usuarios";
            $data['page_functions_js'] = "functions_usuarios.js";
            $this->views->getView($this, "usuarios", $data);
        }

        public function setUsuario()
        {
            if ($_POST) {
                if (empty($_POST['txtdocUsuario']) || empty($_POST['txtnomUsuario']) || empty($_POST['txtapeUsuario']) ||
                    empty($_POST['txttelUsuario']) || empty($_POST['txtemaUsuario']) || empty($_POST['listidRol']) ||
                    empty($_POST['listestUsuario']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $idUsuario = intval($_POST['idUsuario']);
                    $strdocUsuario  = strClean($_POST['txtdocUsuario']);
                    $strnomUsuario  = ucwords(strClean($_POST['txtnomUsuario']));
                    $strapeUsuario  = ucwords(strClean($_POST['txtapeUsuario']));
                    $inttelUsuario  = intval(strClean($_POST['txttelUsuario']));
                    $stremaUsuario  = strtolower(strClean($_POST['txtemaUsuario']));
                    $intIdRol       = intval(strClean($_POST['listidRol']));
                    $intestUsuario  = intval(strClean($_POST['listestUsuario']));
                    $request_user   = "";
                    if ($idUsuario == 0) {
                        $option = 1;
                        $strpasUsuario  = empty($_POST['txtpasUsuario']) ? hash("SHA256", passGenerator()) :
                            hash("SHA256", $_POST['txtpasUsuario']);
                        if ($_SESSION['permisosMod']['wriPermiso']) {
                            $request_user = $this->model->insertUsuario($strdocUsuario, $strnomUsuario, $strapeUsuario,
                                                                        $inttelUsuario, $stremaUsuario, $strpasUsuario,
                                                                        $intIdRol, $intestUsuario);
                        }
                    } else {
                        $option = 2;
                        $strpasUsuario  = empty($_POST['txtpasUsuario']) ? "" : hash("SHA256", $_POST['txtpasUsuario']);
                        if ($_SESSION['permisosMod']['updPermiso']) {
                            $request_user = $this->model->updateUsuario($idUsuario, $strdocUsuario, $strnomUsuario,
                                                                        $strapeUsuario, $inttelUsuario, $stremaUsuario,
                                                                        $strpasUsuario, $intIdRol, $intestUsuario);
                        }
                    }
                    if ($request_user == 1) {
                        if ($option == 1) {
                            $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                        } else {
                            $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                        }
                    } else if ($request_user == 'exist') {
                        $arrResponse = array("status" => false, "msg" => '¡Atención! el email o la identificación ya existen, ingrese otro.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getUsuarios()
        {
            if ($_SESSION['permisosMod']['reaPermiso']) {
                $arrData = $this->model->selectUsuarios();
                for ($i = 0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
                    if ($arrData[$i]['estUsuario'] == 1) {
                        $arrData[$i]['estUsuario'] = '<span class="badge badge-success">Activo</span>';
                    } else {
                        $arrData[$i]['estUsuario'] = '<span class="badge badge-danger">Inactivo</span>';
                    }
                    if ($_SESSION['permisosMod']['reaPermiso']) {
                        $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario(' . $arrData[$i]['idUsuario'] . ')" title="Ver Usuario"><i class="far fa-eye"></i></button>';
                    }
                    if ($_SESSION['permisosMod']['updPermiso']) {
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idRol'] == 1) ||
                            ($_SESSION['userData']['idRol'] == 1 and $arrData[$i]['idRol'] != 1)
                        ) {
                            $btnEdit = '<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario(this,' . $arrData[$i]['idUsuario'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                        } else {
                            $btnEdit = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-pencil-alt"> </i></button>';
                        }
                    }
                    if ($_SESSION['permisosMod']['delPermiso']) {
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idRol'] == 1) ||
                            ($_SESSION['userData']['idRol'] == 1 and $arrData[$i]['idRol'] != 1) and
                            ($_SESSION['userData']['idUsuario'] != $arrData[$i]['idUsuario'])
                        ) {
                            $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario(' . $arrData[$i]['idUsuario'] . ')" title="Eliminar Usuario"><i class="far fa-trash-alt"></i></button>';
                        } else {
                            $btnDelete = '<button class="btn btn-secondary btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                        }
                    }
                    $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
                }
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getUsuario($idpersona)
        {
            if ($_SESSION['permisosMod']['reaPermiso']) {
                $idusuario = intval($idpersona);
                if ($idusuario > 0) {
                    $arrData = $this->model->selectUsuario($idusuario);
                    if (empty($arrData)) {
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    } else {
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function getSelectusuarios(){
            $htmlOptions = "";
            $arrData = $this->model->selectUsuarios();
            if (count($arrData) > 0){
                for ($i=0; $i < count($arrData); $i++){
                    if ($arrData[$i]['estUsuario'] == 1 AND $arrData[$i]['idRol'] != 5){
                        $htmlOptions .= '<option value="' . $arrData[$i]['idUsuario'] . '">' .
                                        $arrData[$i]['nomUsuario'] . '</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }
    
        public function delUsuario()
        {
            if ($_POST) {
                if ($_SESSION['permisosMod']['delPermiso']) {
                    $intidUsuario = intval($_POST['idUsuario']);
                    $requestDelete = $this->model->deleteUsuario($intidUsuario);
                    if ($requestDelete) {
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Usuario.');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Usuario.');
                    }
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function perfil()
        {
            $data['page_tag']   = "Perfil";
            $data['page_title'] = "Perfil de Usuario";
            $data['page_name']  = "perfil";
            $data['page_functions_js'] = "functions_usuarios.js";
            $this->views->getView($this, "perfil", $data);
        }

        public function putPerfil()
        {
            if ($_POST) {
                if (
                    empty($_POST['txtdocUsuario']) || empty($_POST['txtnomUsuario']) || empty($_POST['txtapeUsuario']) ||
                    empty($_POST['txttelUsuario'])
                ) {
                    $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos.');
                } else {
                    $idUsuario = $_SESSION['idUser'];
                    $strIdentificacion = strClean($_POST['txtdocUsuario']);
                    $strNombre = strClean($_POST['txtnomUsuario']);
                    $strApellido = strClean($_POST['txtapeUsuario']);
                    $intTelefono = intval(strClean($_POST['txttelUsuario']));
                    $strPassword = "";
                    if (!empty($_POST['txtPasUsuario'])) {
                        $strPassword = hash("SHA256", $_POST['txtPasUsuario']);
                    }
                    $request_user = $this->model->updatePerfil($idUsuario, $strIdentificacion, $strNombre,
                                                                $strApellido, $intTelefono, $strPassword);
                    if ($request_user) {
                        sessionUser($_SESSION['idUser']);
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function putComercial()
        {
            if ($_POST){
                if (empty($_POST['listipUsuario']) || empty($_POST['txtrazUsuario']) || empty($_POST['txtactUsuario']) ||
                    empty($_POST['txtrepUsuario']) || empty($_POST['txtdirUsuario']) || empty($_POST['txtefaUsuario']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos.');
                } else {
                    $idUsuario = $_SESSION['idUser'];
                    $listipUsuario = intval(strClean($_POST['listipUsuario']));
                    $strrazUsuario = strClean($_POST['txtrazUsuario']);
                    $stractUsuario = strClean($_POST['txtactUsuario']);
                    $strrepUsuario = strClean($_POST['txtrepUsuario']);
                    $strdirUsuario = strClean($_POST['txtdirUsuario']);
                    $strefaUsuario = strClean($_POST['txtefaUsuario']);
                    $request_comercial = $this->model->updateComercial($idUsuario, $listipUsuario, $strrazUsuario,
                                                                        $stractUsuario, $strrepUsuario, $strdirUsuario, $strefaUsuario);
                    if ($request_comercial) {
                        sessionUser($_SESSION['idUser']);
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
