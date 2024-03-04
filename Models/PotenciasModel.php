<?php
class PotenciasModel extends Mysql
{
    public $intidPotencia;
    public $strdesPotencia;
    public $intestPotencia;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertPotencia(string $descripcion, int $estado) {
        $return = 0;
        $this->strdesPotencia  = $descripcion;
        $this->intestPotencia  = $estado;

        $sql = "SELECT * FROM potencias WHERE desPotencia = '{$this->strdesPotencia}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO potencias (desPotencia, estPotencia) VALUES (?,?)";
            $arrData = array($this->strdesPotencia, $this->intestPotencia);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectPotencias()
    {
        $sql = "SELECT * FROM potencias WHERE estPotencia != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPotencia(int $idPotencia)
    {
        $this->intidPotencia = $idPotencia;
        $sql = "SELECT * FROM potencias WHERE idPotencia = $this->intidPotencia";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updatePotencia(int $idPotencia, string $descripcion, int $estado)
    {
        $this->intidPotencia   = $idPotencia;
        $this->strdesPotencia  = $descripcion;
        $this->intestPotencia  = $estado;

        $sql = "SELECT * FROM potencias WHERE desPotencia = '{$this->strdesPotencia}' AND idPotencia != $this->intidPotencia";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE potencias SET desPotencia = ?, estPotencia = ? WHERE idPotencia = $this->intidPotencia";
            $arrData = array($this->strdesPotencia, $this->intestPotencia);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deletePotencia(int $idPotencia)
    {
        $this->intidPotencia = $idPotencia;
        $sql = "SELECT * FROM elementos WHERE potElemento = $this->intidPotencia";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE potencias SET estPotencia = ? WHERE idPotencia = $this->intidPotencia";
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