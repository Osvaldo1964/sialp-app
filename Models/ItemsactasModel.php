<?php
class ItemsactasModel extends Mysql
{
    private $intidItemacta;
    private $strcodItemacta;
    private $strdesItemacta;
    private $inttipItemacta;
    private $intestItemacta;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertItemsacta(string $nombre, int $estado)
    {
        $this->strdesRecurso = $nombre;
        $this->intestRecurso = $estado;
        $query_insert = "INSERT INTO recursos (desRecurso, estRecurso) VALUES (?,?)";
        $arrData = array($this->strdesRecurso, $this->intestRecurso);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectItemsactas()
    {
        $sql = "SELECT * FROM Itemsacta WHERE tipItemacta = 2";
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
