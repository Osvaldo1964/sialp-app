<?php
class ValorvrsalpModel extends Mysql
{
    private $intidValorvar;
    private $strcodValorvar;
    private $striniValorvar;
    private $strfinValorvar;
    private $strtipValorvar;
    private $strvalValorvar;
    private $intestValorvar;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertValorvar(int $strcodValorvar,   int $iniValorvar, int $finValorvar,
                                 int $tipValorvar, string $valValorvar, int $estValorvar)
    {
        $this->strcodValorvar = $strcodValorvar;
        $this->striniValorvar = $iniValorvar;
        $this->strfinValorvar = $finValorvar;
        $this->strtipValorvar = $tipValorvar;
        $this->strvalValorvar = $valValorvar;
        $this->intestValorvar = $estValorvar;
        $return= 0;
        $query_insert = "INSERT INTO grupos (codValorvar, iniValorvar, finValorvar, tipValorvar, valValorvar,
                        estValorval) VALUES (?,?,?,?,?,?)";
        $arrData = array($this->strcodValorvar, $this->striniValorvar, $this->strfinValorvar, 
                        $this->strtipValorvar, $this->strvalValorvar, $this->intestValorvar);
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function selectValorvars()
    {
        $sql = "SELECT a.idValorvar, a.codValorvar, v.desVarsalp as desVarsalp,
                a.iniValorvar, a.finValorvar, a.tipValorvar, a.valValorvar, a.estValorvar
                FROM valorvariablesalp a
                INNER JOIN varsalp v ON a.codValorvar = v.codVarsalp
                WHERE a.estValorvar != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectValorvar(int $idValorvar)
    {
        $this->intidValorvar = $idValorvar;
        $sql = "SELECT a.idValorvar, a.codValorvar, v.desVarsalp as desVarsalp,
                a.iniValorvar, a.finValorvar, a.tipValorvar, a.valValorvar, a.estValorvar
                FROM valorvariablesalp a
                INNER JOIN varsalp v ON a.codValorvar = v.codVarsalp
                WHERE idValorvar = $this->intidValorvar";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateGrupo(int $idGrupo, int $capGrupo, string $nombre, int $estado)
    {
        $this->intidGrupo     = $idGrupo;
        $this->intcapGrupo    = $capGrupo;
        $this->strdesGrupo    = $nombre;
        $this->intestGrupo    = $estado;
        $sql = "UPDATE grupos SET capGrupo = ?, desGrupo = ?, estEmpresa = ?
                WHERE idGrupo = $this->intidGrupo";
        $arrData = array(
            $this->intcapGrupo, $this->strdesGrupo, $this->intestGrupo);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteGrupo(int $idGrupo)
    {
        $this->intidGrupo = $idGrupo;
        $sql = "UPDATE grupos SET estGrupo = ? WHERE idGrupo = $this->intidGrupo ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
