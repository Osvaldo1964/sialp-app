<?php
class ActasModel extends Mysql
{
    public $intidActa;
    public $inttipacta;
    public $intiteActa;
    public $strnumActa;
    public $strfecActa;
    public $strimgActa;
    public $intrecActa;
    public $intestActa;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertACta(string $nombre, string $descripcion, string $imagen, string $ruta, int $estado) {
        $return = 0;
        $this->strnomCategoria  = $nombre;
        $this->strdesCategoria  = $descripcion;
        $this->strimgCategoria  = $imagen;
        $this->strrutCategoria  = $ruta;
        $this->intestCategoria  = $estado;

        $sql = "SELECT * FROM categorias WHERE nomCategoria = '{$this->strnomCategoria}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO categorias (nomCategoria, desCategoria, imgCategoria, rutCategoria, estCategoria) VALUES (?,?,?,?,?)";
            $arrData = array($this->strnomCategoria, $this->strdesCategoria, $this->strimgCategoria, $this->strrutCategoria, $this->intestCategoria);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectActas()
    {
        $sql = "SELECT a.idActa, a.tipActa, a.iteActa, a.numActa, a.fecActa, a.recActa, a.estActa,
                t.desTipoacta as desTipoacta, i.desItemacta as desItemacta, r.desRecurso as desRecurso
                FROM actas a
                INNER JOIN tipoactas t ON t.idTipoacta = 2
                INNER JOIN itemsacta i ON a.iteActa = i.idItemacta
                INNER JOIN recursos r ON a.recActa = r.idRecurso
                 WHERE estActa != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectActa(int $idActa)
    {
        $this->intidActa = $idActa;
        $sql = "SELECT a.idActa, a.tipActa, a.iteActa, a.numActa, a.fecActa, a.recActa, a.estActa,
                t.desTipoacta as desTipoacta, i.desItemacta as desItemacta, r.desRecurso as desRecurso 
                FROM actas a
                INNER JOIN tipoactas t ON t.idTipoacta = 2
                INNER JOIN itemsacta i ON a.iteActa = i.idItemacta
                INNER JOIN recursos r ON a.recActa = r.idRecurso
                WHERE idActa = $this->intidActa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateActa(int $idCategoria, string $nombre, string $descripcion, string $portada, string $ruta, int $estado)
    {
        $this->intidCategoria   = $idCategoria;
        $this->strnomCategoria  = $nombre;
        $this->strdesCategoria  = $descripcion;
        $this->strimgCategoria  = $portada;
        $this->strrutCategoria  = $ruta;
        $this->intestCategoria  = $estado;

        $sql = "SELECT * FROM categorias WHERE nomCategoria = '{$this->strnomCategoria}' AND idCategoria != $this->intidCategoria";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE categorias SET nomCategoria = ?, desCategoria = ?, imgCategoria = ?, rutCategoria = ?, estCategoria = ?
                    WHERE idCategoria = $this->intidCategoria";
            $arrData = array($this->strnomCategoria, $this->strdesCategoria, $this->strimgCategoria, $this->strrutCategoria, $this->intestCategoria);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteacta(int $idCategoria)
    {
        $this->intidCategoria = $idCategoria;
        $sql = "SELECT * FROM productos WHERE idCategoria = $this->intidCategoria";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE categorias SET estCategoria = ? WHERE idCategoria = $this->intidCategoria";
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