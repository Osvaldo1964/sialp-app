<?php
class GrupossalpModel extends Mysql
{
    public $intidGruposalp;
    public $strcodGruposalp;
    public $strdesGruposalp;
    public $fltvidGruposalp;
    public $inttipGruposalp;
    public $intestGruposalp;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertGruposalp(string $codigo, string $descripcion, float $vidautil, int $tipo,  int $estado) {
        $return = 0;
        $this->strcodGruposalp  = $codigo;
        $this->strdesGruposalp  = $descripcion;
        $this->fltvidGruposalp  = $vidautil;
        $this->inttipGruposalp  = $tipo;
        $this->intestGruposalp  = $estado;

        $sql = "SELECT * FROM gruposalp WHERE codGruposalp = '{$this->strcodGruposalp}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO gruposalp (codGruposalp, desGruposalp, vidGruposalp, tipGruposalp, estGruposalp)
                            VALUES (?,?,?,?,?)";
            $arrData = array($this->strcodGruposalp, $this->strdesGruposalp, $this->fltvidGruposalp,
                            $this->inttipGruposalp, $this->intestGruposalp);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectGrupossalp()
    {
        $sql = "SELECT * FROM gruposalp WHERE estGruposalp != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectGruposalp(int $idGruposalp)
    {
        $this->intidGruposalp = $idGruposalp;
        $sql = "SELECT * FROM gruposalp WHERE idGruposalp = $this->intidGruposalp";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateGruposalp(int $idGruposalp, string $codigo, string $descripcion, float $vidautil, int $tipo, int $estado)
    {
        $this->intidGruposalp   = $idGruposalp;
        $this->strcodGruposalp  = $codigo;
        $this->strdesGruposalp  = $descripcion;
        $this->fltvidGruposalp  = $vidautil;
        $this->inttipGruposalp  = $tipo;
        $this->intestGruposalp  = $estado;

        $sql = "SELECT * FROM gruposalp WHERE codGruposalp = '{$this->strcodGruposalp}' AND idGruposalp != $this->intidGruposalp";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE gruposalp SET codGruposalp = ?, desGruposalp = ?, vidGruposalp = ?, tipGruposalp = ?, estGruposalp = ?
                    WHERE idGruposalp = $this->intidGruposalp";
            $arrData = array($this->strcodGruposalp, $this->strdesGruposalp, $this->fltvidGruposalp,
                            $this->inttipGruposalp, $this->intestGruposalp);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteGruposalp(int $idGruposalp)
    {
        $this->intidGruposalp = $idGruposalp;
        $sql = "SELECT * FROM elementos WHERE gruElemento = $this->intidGruposalp";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE gruposalp SET estGruposalp = ? WHERE idGruposalp = $this->intidGruposalp";
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