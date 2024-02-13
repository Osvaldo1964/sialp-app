<?php
class CapitulosModel extends Mysql
{
    private $intidCapitulo;
    private $strnomCapitulo;
    private $inttipCapitulo;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertCapitulo(string $nombre, int $estado)
    {
        $this->strnomCapitulo = $nombre;
        $this->inttipCapitulo = $estado;
        $query_insert = "INSERT INTO capitulos (nomCapitulo, tipCapitulo) VALUES (?,?)";
        $arrData = array($this->strnomCapitulo, $this->inttipCapitulo);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectCapitulos()
    {
        $sql = "SELECT idCapitulo, nomCapitulo, tipCapitulo FROM capitulos ORDER BY idCapitulo DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCapitulo(int $idCapitulo)
    {
        $this->intidCapitulo = $idCapitulo;
        $sql = "SELECT idCapitulo, nomCapitulo, tipCapitulo FROM capitulos WHERE idCapitulo = $this->intidCapitulo";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCapitulo(int $idCapitulo, string $nombre, int $estado)
    {
        $this->intidCapitulo     = $idCapitulo;
        $this->strnomCapitulo    = $nombre;
        $this->inttipCapitulo    = $estado;
        $sql = "UPDATE capitulos SET nomCapitulo = ?, tipCapitulo = ? WHERE idCapitulo = $this->intidCapitulo";
        $arrData = array($this->strnomCapitulo, $this->inttipCapitulo);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteCapitulo(int $idCapitulo)
    {
        $this->intidCapitulo = $idCapitulo;
        $sql = "DELETE capitulos WHERE idCapitulo = $this->intidCapitulo";
        $request = $this->delete($sql);
        return $request;
    }
}
