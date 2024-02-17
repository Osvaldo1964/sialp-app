<?php
class ValorvrsalpModel extends Mysql
{
    private $intidGrupo;
    private $intcapGrupo;
    private $strdesGrupo;
    private $intestGrupo;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertValorvar( int $capGrupo, string $nombre, int $estado) {
        $this->intcapGrupo = $capGrupo;
        $this->strdesGrupo = $nombre;
        $this->intestGrupo = $estado;
        $return = 0;
        $query_insert = "INSERT INTO grupos (capGrupo, desGrupo, estGrupo) VALUES (?,?,?)";
        $arrData = array($this->intcapGrupo, $this->strdesGrupo, $this->intestGrupo);
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function selectValorvar()
    {
        $sql = "SELECT a.idValorvar, a.codValorvar, a.varValorvar, v.desVarsalp as desVarsalp, a.iniValorvar, a.finValorvar, a.tipValorvar,
                a.valValorvar, a.estValorvar
                FROM valorvariablesalp a
                INNER JOIN varsalp v ON a.varValorvar = v.codVarsalp
                WHERE a.estValorvar != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectValor(int $idGrupo)
    {
        $this->intidGrupo = $idGrupo;
        $sql = "SELECT idGrupo, capGrupo, desGrupo, estEmpresa, DATE_FORMAT(creGrupo, '%Y-%m-%d') as creGrupo
                            FROM grupos WHERE idGrupo = $this->intidGrupo";
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
