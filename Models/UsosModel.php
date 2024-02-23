<?php
class UsosModel extends Mysql
{
    private $intidUso;
    private $strclaUso;
    private $strdesUso;
    private $inttipUso;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertUso(string $clase, string $nombre, int $estado)
    {
        $this->strclaUso = $clase;
        $this->strdesUso = $nombre;
        $this->inttipUso = $estado;
        $query_insert = "INSERT INTO tiposuso (claUso, desUso, tipUso) VALUES (?,?,?)";
        $arrData = array($this->strclaUso, $this->strdesUso, $this->inttipUso);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectUsos()
    {
        $sql = "SELECT * FROM tiposuso";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectUso(int $idUso)
    {
        $this->intidUso = $idUso;
        $sql = "SELECT idUso, claUso, desUso, tipUso FROM tiposuso WHERE idUso = $this->intidUso";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateUso(int $idUso, string $clase, string $nombre, int $estado)
    {
        $this->intidUso  = $idUso;
        $this->strclaUso = $clase;
        $this->strdesUso = $nombre;
        $this->inttipUso = $estado;
        $sql = "UPDATE tiposuso SET nomUso = ?, tipUso = ? WHERE idUso = $this->intidUso";
        $arrData = array($this->strclaUso, $this->strdesUso, $this->inttipUso);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteUso(int $idUso)
    {
        $this->intidUso = $idUso;
        $sql = "DELETE tiposuso WHERE idUso = $this->intidUso";
        $request = $this->delete($sql);
        return $request;
    }
}
