<?php
class InversionesModel extends Mysql
{
    private $intidItem;
    private $intgruItem;
    private $strdesItem;
    private $intcsmItem;
    private $intestItem;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertItem(int $grupo, string $nombre, int $consumo, int $estado) {
        $this->intgruItem = $grupo;
        $this->strdesItem = $nombre;
        $this->intcsmItem = $consumo;
        $this->intestItem = $estado;
        $return = 0;
        $query_insert = "INSERT INTO itemsalp (gruItem, desItem, csmItem, estItem) VALUES (?,?,?,?)";
        $arrData = array($this->intgruItem, $this->strdesItem, $this->intcsmItem, $this->intestItem);
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function selectItems()
    {
        $sql = "SELECT i.idItem, i.gruItem, g.desGruposalp as desGruposalp, i.desItem,  i.csmItem, i.estItem
                FROM itemsalp i 
                INNER JOIN gruposalp g ON i.gruItem = g.idGruposalp
                WHERE i.estItem != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectItem(int $idItem)
    {
        $this->intidItem = $idItem;
        $sql = "SELECT i.idItem, i.gruItem, g.desGruposalp as desGruposalp, i.desItem,  i.csmItem, i.estItem
                FROM itemsalp i
                INNER JOIN gruposalp g ON i.gruItem = g.idGruposalp
                WHERE idItem = $this->intidItem";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateItem(int $idItem, int $grupo, string $nombre, int $consumo, int $estado)
    {
        $this->intidItem  = $idItem;
        $this->intgruItem = $grupo;
        $this->strdesItem = $nombre;
        $this->intcsmItem = $consumo;
        $this->intestItem = $estado;
        $sql = "UPDATE itemsalp SET gruItem = ?, desItem = ?, csmItem = ?, estItem = ?
                WHERE idItem = $this->intidItem";
        $arrData = array($this->intgruItem, $this->strdesItem, $this->intcsmItem, $this->intestItem);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteItem(int $idItem)
    {
        $this->intidItem = $idItem;
        $sql = "UPDATE itemsalp SET estItem = ? WHERE idItem = $this->intidItem ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
