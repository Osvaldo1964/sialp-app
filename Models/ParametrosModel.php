<?php
    class ParametrosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getParametro(){
            $sql = "SELECT *  FROM parametros";
            $requestParametros = $this->select($sql);
            return $requestParametros;
        }  
    }
?>