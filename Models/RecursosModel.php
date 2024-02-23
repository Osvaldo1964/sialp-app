<?php
class RecursosModel extends Mysql
{
    private $intidRecurso;
    private $strdesRecurso;
    private $intestRecurso;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertRecurso(string $nombre, int $estado)
    {
        $this->strdesRecurso = $nombre;
        $this->intestRecurso = $estado;
        $query_insert = "INSERT INTO recursos (desRecurso, estRecurso) VALUES (?,?)";
        $arrData = array($this->strdesRecurso, $this->intestRecurso);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectRecursos()
    {
        $sql = "SELECT * FROM recursos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRecurso(int $idRecurso)
    {
        $this->intidRecurso = $idRecurso;
        $sql = "SELECT idRecurso, desRecurso, estRecurso FROM recursos WHERE idRecurso = $this->intidRecurso";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateRecurso(int $idRecurso, string $nombre, int $estado)
    {
        $this->intidRecurso  = $idRecurso;
        $this->strdesRecurso = $nombre;
        $this->intestRecurso = $estado;
        $sql = "UPDATE recursos SET desRecurso = ?, estRecurso = ? WHERE idRecurso = $this->intidRecurso";
        $arrData = array($this->strdesRecurso, $this->intestRecurso);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteRecurso(int $idRecurso)
    {
        $this->intidRecurso = $idRecurso;
        $sql = "DELETE recursos WHERE idRecurso = $this->intidRecurso";
        $request = $this->delete($sql);
        return $request;
    }
}
