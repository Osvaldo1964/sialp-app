<?php
class MaterialesModel extends Mysql
{
    public $intidMaterial;
    public $strdesMaterial;
    public $intestMaterial;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertMaterial(string $descripcion, int $estado) {
        $return = 0;
        $this->strdesMaterial  = $descripcion;
        $this->intestMaterial  = $estado;

        $sql = "SELECT * FROM mteriales WHERE desMaterial = '{$this->strdesMaterial}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO materiales (desMaterial, estMaterial) VALUES (?,?)";
            $arrData = array($this->strdesMaterial, $this->intestMaterial);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectMateriales()
    {
        $sql = "SELECT * FROM materiales WHERE estMaterial != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectMaterial(int $idMaterial)
    {
        $this->intidMaterial = $idMaterial;
        $sql = "SELECT * FROM materiales WHERE idMaterial = $this->intidMaterial";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateMaterial(int $idMaterial, string $descripcion, int $estado)
    {
        $this->intidMaterial   = $idMaterial;
        $this->strdesMaterial  = $descripcion;
        $this->intestMaterial  = $estado;

        $sql = "SELECT * FROM materiales WHERE desMaterial = '{$this->strdesMaterial}' AND idMaterial != $this->intidMaterial";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE materiales SET desMaterial = ?, estMaterial = ? WHERE idMaterial = $this->intidMaterial";
            $arrData = array($this->strdesMaterial, $this->intestMaterial);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteMaterial(int $idMaterial)
    {
        $this->intidMaterial = $idMaterial;
        $sql = "SELECT * FROM elementos WHERE matElemento = $this->intidMaterial";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE materiales SET estMaterial = ? WHERE idMaterial = $this->intidMaterial";
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