<?php
class ValorvrsalpModel extends Mysql
{
    private $intidValorvar;
    private $intvarValorvar;
    private $striniValorvar;
    private $strfinValorvar;
    private $strtipValorvar;
    private $fltvalValorvar;
    private $intestValorvar;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertValorvar(int $varValorvar,   string $iniValorvar, string $finValorvar,
                                 string $tipValorvar, float $valValorvar)
    {
        $this->intvarValorvar = $varValorvar;
        $this->striniValorvar = $iniValorvar;
        $this->strfinValorvar = $finValorvar;
        $this->strtipValorvar = $tipValorvar;
        $this->fltvalValorvar = $valValorvar;
        //$this->intestValorvar = $estValorvar;
        $return= 0;
        $query_insert = "INSERT INTO valorvariablesalp (varValorvar, iniValorvar, finValorvar, tipValorvar, valValorvar) VALUES (?,?,?,?,?)";
        $arrData = array($this->intvarValorvar, $this->striniValorvar, $this->strfinValorvar, 
                        $this->strtipValorvar, $this->fltvalValorvar);
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function selectValorvars()
    {
        $sql = "SELECT a.idValorvar, a.varValorvar, v.desVarsalp as desVarsalp,
                a.iniValorvar, a.finValorvar, a.tipValorvar, a.valValorvar, a.estValorvar
                FROM valorvariablesalp a
                INNER JOIN varsalp v ON a.varValorvar = v.codVarsalp
                WHERE a.estValorvar != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectValorvar(int $idValorvar)
    {
        $this->intidValorvar = $idValorvar;
        $sql = "SELECT a.idValorvar, a.varValorvar, v.desVarsalp as desVarsalp,
                a.iniValorvar, a.finValorvar, a.tipValorvar, a.valValorvar, a.estValorvar
                FROM valorvariablesalp a
                INNER JOIN varsalp v ON a.varValorvar = v.codVarsalp
                WHERE idValorvar = $this->intidValorvar";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateValorvar(int $idValorvar, string $varValorvar, string $iniValorvar, string $finValorvar, string $tipValorvar, string $valValorvar, int $estValorvar)
    {
        $this->intidValorvar  = $idValorvar;
        $this->intvarValorvar = $varValorvar;
        $this->striniValorvar = $iniValorvar;
        $this->strfinValorvar = $finValorvar;
        $this->strtipValorvar = $tipValorvar;
        $this->fltvalValorvar = $valValorvar;
        $this->intestValorvar = $estValorvar;
        $sql = "UPDATE valorvariablesalp SET varValorvar = ?, iniValorvar = ?, finValorvar = ?, tipValorvar = ?, valValorvar = ?, estValorvar = ?
                WHERE idValorvar = $this->intidValorvar";
        $arrData = array($this->intvarValorvar, $this->striniValorvar, $this->strfinValorvar, $this->strtipValorvar,
                        $this->fltvalValorvar, $this->intestValorvar);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteValorvar(int $idValorvar)
    {
        $this->intidValorvar = $idValorvar;
        $sql = "UPDATE valorvariablesalp SET estValorvar = ? WHERE idValorvar = $this->intidValorvar ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
