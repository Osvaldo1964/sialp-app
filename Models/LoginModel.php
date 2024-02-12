<?php
    class LoginModel extends Mysql
    {
        private $intidUsuario;
        private $strUsuario;
        private $strPassword;
        private $strToken;

        public function __construct()
        {
            parent::__construct();
        }

        public function loginUsuario(string $usuario, $password)
        {
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
            $sql = "SELECT idUsuario, estUsuario FROM usuarios WHERE emaUsuario = '$this->strUsuario'
                    AND pasUsuario = '$this->strPassword' AND estUsuario != 0";
            $request = $this->select($sql);
            return $request;
        }

        public function sessionLogin(int $idUsuario){
            $this->intidUsuario = $idUsuario;
            $sql = "SELECT p.idUsuario, p.tdoUsuario, p.docUsuario, p.nomUsuario, p.apeUsuario, p.telUsuario,
                            p.dirUsuario, p.emaUsuario, r.idRol, r.nomRol, p.estUsuario, p.razUsuario, p.actUsuario,
                            p.repUsuario, p.efaUsuario
                            FROM usuarios p
                            INNER JOIN roles r ON p.rolUsuario = r.idRol
                            WHERE p.idUsuario = $this->intidUsuario";
            $request = $this->select($sql);
            $_SESSION['userData'] = $request;
            return $request;
        }

        public function getUserEmail(string $email){
            $this->strUsuario = $email;
            $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, estUsuario
                            FROM usuarios 
                            WHERE emaUsuario = '$this->strUsuario' AND estUsuario = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function setTokenUser(int $idpersona, string $token){
            $this->intidUsuario = $idpersona;
            $this->strToken = $token;
            $sql ="UPDATE usuarios SET tokUsuario = ? WHERE idUsuario = $this->intidUsuario";
            $arrData = array($this->strToken);
            $request = $this->update($sql, $arrData);
            return $request;
        }

        public function getUsuario(string $email, string $token){
            $this->strUsuario = $email;
            $this->strToken = $token;
            $sql = "SELECT idUsuario FROM usuarios WHERE emaUsuario = '$this->strUsuario' AND 
                    tokUsuario = '$this->strToken' AND estUsuario = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function insertPassword(int $idpersona, string $password){
            $this->intidUsuario = $idpersona;
            $this->strPassword = $password;
            $sql = "UPDATE usuarios SET pasUsuario = ?, tokUsuario = ? WHERE idUsuario = $this->intidUsuario";
            $arrData = array($this->strPassword, "");
            $request = $this->update($sql, $arrData);
            return $request;

        }

        public function getParametros(){
            $sql = "SELECT empParam, dirParam, nitParam FROM parametros LIMIT 1";
            $request = $this->select($sql);
            $_SESSION['parametros'] = $request;
            return $request;
        }
    }
