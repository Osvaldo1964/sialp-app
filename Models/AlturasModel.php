<?php
class AlturasModel extends Mysql
{
    public $intidAltura;
    public $strdesAltura;
    public $intestAltura;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertAltura(string $descripcion, int $estado) {
        $return = 0;
        $this->strdesAltura  = $descripcion;
        $this->intestAltura  = $estado;

        $sql = "SELECT * FROM alturas WHERE desAltura = '{$this->strdesAltura}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO alturas (desAltura, estAltura) VALUES (?,?)";
            $arrData = array($this->strdesAltura, $this->intestAltura);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectAlturas()
    {
        $sql = "SELECT * FROM alturas WHERE estAltura != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectAltura(int $idAltura)
    {
        $this->intidAltura = $idAltura;
        $sql = "SELECT * FROM alturas WHERE idAltura = $this->intidAltura";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateAltura(int $idAltura, string $descripcion, int $estado)
    {
        $this->intidAltura   = $idAltura;
        $this->strdesAltura  = $descripcion;
        $this->intestAltura  = $estado;

        $sql = "SELECT * FROM alturas WHERE desAltura = '{$this->strdesAltura}' AND idAltura != $this->intidAltura";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE alturas SET desAltura = ?, estAltura = ? WHERE idAltura = $this->intidAltura";
            $arrData = array($this->strdesAltura, $this->intestAltura);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteAltura(int $idAltura)
    {
        $this->intidAltura = $idAltura;
        $sql = "SELECT * FROM elementos WHERE altElemento = $this->intidAltura";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE alturas SET estAltura = ? WHERE idAltura = $this->intidAltura";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if($request){
                $request = 'ok';
            }else{
                $request = 'error';
            }
        }else{
            $request = 'exist';
        }
        return $request;
    }
}