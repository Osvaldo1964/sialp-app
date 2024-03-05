<?php
class ComercialesModel extends Mysql
{
    public $intidComercial;
    public $strnomComercial;
    public $strcntComercial;
    public $fltvalComercial;
    public $intestComercial;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertComercial(string $nombre, string $contrato, float $valor, int $estado) {
        $return = 0;
        $this->strnomComercial  = $nombre;
        $this->strcntComercial  = $contrato;
        $this->fltvalComercial  = $valor;
        $this->intestComercial  = $estado;

        $sql = "SELECT * FROM comerciales WHERE nomComercial = '{$this->strnomComercial}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO comerciales (nomComercial, cntComercial, valComercial, estComercial)
                            VALUES (?,?,?,?)";
            $arrData = array($this->strnomComercial, $this->strcntComercial, $this->fltvalComercial,
                            $this->intestComercial);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectComerciales()
    {
        $sql = "SELECT * FROM comerciales WHERE estComercial != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectComercial(int $idComercial)
    {
        $this->intidComercial = $idComercial;
        $sql = "SELECT * FROM comerciales WHERE idComercial = $this->intidComercial";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateComercial(int $idComercial, string $nombre, string $contrato, float $valor, int $estado)
    {
        $this->intidComercial   = $idComercial;
        $this->strnomComercial  = $nombre;
        $this->strcntComercial  = $contrato;
        $this->fltvalComercial  = $valor;
        $this->intestComercial  = $estado;

        $sql = "SELECT * FROM comerciales WHERE nomComercial = '{$this->strnomComercial}' AND idComercial != $this->intidComercial";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE comerciales SET nomComercial = ?, cntComercial = ?, valComercial = ?, estComercial = ?
                    WHERE idComercial = $this->intidComercial";
            $arrData = array($this->strnomComercial, $this->strcntComercial, $this->fltvalComercial,
                            $this->intestComercial);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteComercial(int $idComercial)
    {
        $this->intidComercial = $idComercial;
        $sql = "SELECT * FROM costoconsumo WHERE entCosto = $this->intidComercial";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE comerciales SET estComercial = ? WHERE idComercial = $this->intidComercial";
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