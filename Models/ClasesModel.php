<?php
class ClasesModel extends Mysql
{
    public $intidClase;
    public $strdesClase;
    public $intestClase;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertClase(string $descripcion, int $estado) {
        $return = 0;
        $this->strdesClase  = $descripcion;
        $this->intestClase  = $estado;

        $sql = "SELECT * FROM clases WHERE desClase = '{$this->strdesClase}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO clases (desGruposalp, estGruposalp)
                            VALUES (?,?)";
            $arrData = array($this->strdesClase, $this->intestClase);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectClases()
    {
        $sql = "SELECT * FROM clases WHERE estClase != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectClase(int $idClase)
    {
        $this->intidClase = $idClase;
        $sql = "SELECT * FROM clases WHERE idClase = $this->intidClase";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateClase(int $idClase, string $descripcion, int $estado)
    {
        $this->intidClase   = $idClase;
        $this->strdesClase  = $descripcion;
        $this->intestClase  = $estado;

        $sql = "SELECT * FROM clases WHERE desClase = '{$this->strdesClase}' AND idClase != $this->intidClase";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE clases SET desGruposalp = ?, estClase = ? WHERE idClase    = $this->intidClase";
            $arrData = array($this->strdesClase, $this->intestClase);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteClase(int $idClase)
    {
        $this->intidClase = $idClase;
        $sql = "SELECT * FROM elementos WHERE claElemento = $this->intidClase";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE clases SET estClase = ? WHERE idClase = $this->intidClase";
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