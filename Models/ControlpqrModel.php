<?php
class ControlpqrModel extends Mysql
{
    public $intidPqrs;
    public $strnomPqrs;
    public $stremaPqrs;
    public $strdirPqrs;
    public $strmsgPqrs;
    public $strfrePqrs;
    public $strfsoPqrs;
    public $strdsoPqrs;
    public $intestPqrs;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCategoria(string $nombre, string $descripcion, string $imagen, string $ruta, int $estado) {
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

    public function selectPqrs()
    {
        $sql = "SELECT * FROM pqrs WHERE estPqrs != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPqr(int $idPqrs)
    {
        $this->intidPqrs = $idPqrs;
        $sql = "SELECT * FROM pqrs WHERE idPqrs = $this->intidPqrs";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCategoria(int $idCategoria, string $nombre, string $descripcion, string $portada, string $ruta, int $estado)
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

    public function deleteCategoria(int $idCategoria)
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