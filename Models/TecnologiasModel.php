<?php
class TecnologiasModel extends Mysql
{
    public $intidTecno;
    public $strdesTecno;
    public $intestTecno;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertTecnologia(string $descripcion, int $estado) {
        $return = 0;
        $this->strdesTecno  = $descripcion;
        $this->intestTecno  = $estado;
        $sql = "SELECT * FROM tecnologias WHERE desTecno = '{$this->strdesTecno}'";
        $request = $this->select_all($sql);
        if (empty($request)) { 
            $query_insert = "INSERT INTO tecnologias (destecno, estTecno) VALUES (?,?)";
            $arrData = array($this->strdesTecno, $this->intestTecno);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectTecnologias()
    {
        $sql = "SELECT * FROM tecnologias WHERE estTecno != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectTecnologia(int $idTecno)
    {
        $this->intidTecno = $idTecno;
        $sql = "SELECT * FROM tecnologias WHERE idTecno = $this->intidTecno";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateTecnologia(int $idTecno, string $descripcion, int $estado)
    {
        $this->intidTecno   = $idTecno;
        $this->strdesTecno  = $descripcion;
        $this->intestTecno  = $estado;
        $sql = "SELECT * FROM tecnologias WHERE desTecno = '{$this->strdesTecno}' AND idTecno != $this->intidTecno";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE tecnologias SET destecno = ?, estTecno = ? WHERE idTecno    = $this->intidTecno";
            $arrData = array($this->strdesTecno, $this->intestTecno);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteTecnologia(int $idTecno)
    {
        $this->intidTecno = $idTecno;
        $sql = "SELECT * FROM elementos WHERE tecElemento = $this->intidTecno";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE tecnologias SET estTecno = ? WHERE idTecno = $this->intidTecno";
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