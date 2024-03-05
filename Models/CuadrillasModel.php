<?php
class CuadrillasModel extends Mysql
{
    public $intidCuadrilla;
    public $strdesCuadrilla;
    public $strconCuadrilla;
    public $strtecCuadrilla;
    public $strayuCuadrilla;
    public $intestCuadrilla;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCuadrilla(string $descripcion, string $conductor, string $tecnico, string $ayudante, int $estado) {
        $return = 0;
        $this->strdesCuadrilla  = $descripcion;
        $this->strconCuadrilla  = $conductor;
        $this->strtecCuadrilla  = $tecnico;
        $this->strayuCuadrilla  = $ayudante;
        $this->intestCuadrilla  = $estado;

        $sql = "SELECT * FROM cuadrillas WHERE desCuadrilla = '{$this->strdesCuadrilla}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO cuadrillas (desCuadrilla, conCuadrilla, tecCuadrilla, ayuCuadrilla, estCuadrilla)
                            VALUES (?,?,?,?,?)";
            $arrData = array($this->strdesCuadrilla, $this->strconCuadrilla, $this->strtecCuadrilla,
                            $this->strayuCuadrilla, $this->intestCuadrilla);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectCuadrillas()
    {
        $sql = "SELECT * FROM cuadrillas WHERE estCuadrilla != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCuadrilla(int $idCuadrilla)
    {
        $this->intidCuadrilla = $idCuadrilla;
        $sql = "SELECT * FROM cuadrillas WHERE idCuadrilla = $this->intidCuadrilla";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCuadrilla(int $idCuadrilla, string $descripcion, string $conductor, string $tecnico,
                                    string $ayudante, int $estado)
    {
        $this->intidCuadrilla   = $idCuadrilla;
        $this->strdesCuadrilla  = $descripcion;
        $this->strconCuadrilla  = $conductor;
        $this->strtecCuadrilla  = $tecnico;
        $this->strayuCuadrilla  = $ayudante;
        $this->intestCuadrilla  = $estado;

        $sql = "SELECT * FROM cuadrillas WHERE desCuadrilla = '{$this->strdesCuadrilla}' AND idCuadrilla != $this->intidCuadrilla";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE cuadrillas SET desCuadrilla = ?, conCuadrilla = ?, tecCuadrilla = ?, ayuCuadrilla = ?, estCuadrilla = ?
                    WHERE idCuadrilla = $this->intidCuadrilla";
            $arrData = array($this->strdesCuadrilla, $this->strconCuadrilla, $this->strtecCuadrilla,
                            $this->strayuCuadrilla, $this->intestCuadrilla);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteCuadrilla(int $idCuadrilla)
    {
        $this->intidCuadrilla = $idCuadrilla;
        $sql = "SELECT * FROM pqrs WHERE cuaPqrs = $this->intidCuadrilla";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE cuadrillas SET estCuadrilla = ? WHERE idCuadrilla = $this->intidCuadrilla";
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