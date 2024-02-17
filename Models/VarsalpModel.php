<?php
class VarsalpModel extends Mysql
{
    public $intidVarsalp;
    public $strcodVarsalp;
    public $strdesVarsalp;
    public $intestVarsalp;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertVarsalp(string $codigo, string $descripcion, int $estado) {
        $return = 0;
        $this->strcodVarsalp  = $codigo;
        $this->strdesVarsalp  = $descripcion;
        $this->intestVarsalp  = $estado;

        $sql = "SELECT * FROM varsalp WHERE codVarsalp = '{$this->strcodVarsalp}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO varsalp (codVarsalp, desVarsalp, estVarsalp) VALUES (?,?,?)";
            $arrData = array($this->strcodVarsalp, $this->strdesVarsalp, $this->intestVarsalp);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectVarsalps()
    {
        $sql = "SELECT * FROM varsalp WHERE estVarsalp != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectVarsalp(int $idVarsalp)
    {
        $this->intidVarsalp = $idVarsalp;
        $sql = "SELECT * FROM varsalp WHERE idVarsalp = $this->intidVarsalp";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateVarsalp(int $idVarsalp, string $codigo, string $descripcion, int $estado)
    {
        $this->intidVarsalp   = $idVarsalp;
        $this->strcodVarsalp  = $codigo;
        $this->strdesVarsalp  = $descripcion;
        $this->intestVarsalp  = $estado;

        $sql = "SELECT * FROM varsalp WHERE codVarsalp = '{$this->strcodVarsalp}' AND idVarsalp != $this->intidVarsalp";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE varsalp SET codVarsalp = ?, desVarsalp = ?, estVarsalp = ?
                    WHERE idVarsalp = $this->intidVarsalp";
            $arrData = array($this->strcodVarsalp, $this->strdesVarsalp, $this->intestVarsalp);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteVarsalp(int $idVarsalp)
    {
        $this->intidVarsalp = $idVarsalp;
        $sql = "SELECT * FROM valorvariablesalp WHERE varValorvar = $this->intidVarsalp";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE varsalp SET estVarsalp = ? WHERE idVarsalp = $this->intidVarsalp";
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