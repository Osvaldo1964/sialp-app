<?php
class CstenergiaModel extends Mysql
{
    private $intidCosto;
    private $intperCosto;
    private $intcsmCosto;
    private $intvlrCosto;
    private $inttotCosto;
    private $intestCosto;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCosto(int $periodo, int $consumo, int $valor, int $total)
    {
        $this->intperCosto = $periodo;
        $this->intcsmCosto = $consumo;
        $this->intvlrCosto = $valor;
        $this->inttotCosto = $total;
        $query_insert = "INSERT INTO costoconsumo (perCosto, csmCosto, vlrCosto, totCosto) VALUES (?,?,?,?)";
        $arrData = array($this->intperCosto, $this->intcsmCosto, $this->intvlrCosto, $this->inttotCosto);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectCostos()
    {
        $sql = "SELECT * FROM costoconsumo";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCosto(int $idCosto)
    {
        $this->intidCosto = $idCosto;
        $sql = "SELECT idCosto, perCosto, csmCosto, vlrCosto, totCosto, estCosto FROM costoconsumo
                WHERE idCosto = $this->intidCosto";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCosto(int $idCosto, int $periodo, int $consumo, int $valor, int $total, int $estado)
    {
        $this->intidCosto  = $idCosto;
        $this->intperCosto = $periodo;
        $this->intcsmCosto = $consumo;
        $this->intvlrCosto = $valor;
        $this->inttotCosto = $total;
        $this->intestCosto = $estado;
        $sql = "UPDATE costoconsumo SET perCosto = ?, csmCosto = ?, vlrCosto = ?, totCosto = ?, estCosto = ?
                WHERE idCosto = $this->intidCosto";
        $arrData = array($this->intperCosto, $this->intcsmCosto, $this->intvlrCosto, $this->inttotCosto,
                        $this->intestCosto);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteCosto(int $idCosto)
    {
        $this->intidCosto = $idCosto;
        $sql = "DELETE costoconsumo WHERE idCosto = $this->intidCosto";
        $request = $this->delete($sql);
        return $request;
    }
}
