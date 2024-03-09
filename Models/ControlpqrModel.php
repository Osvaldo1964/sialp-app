<?php
class ControlpqrModel extends Mysql
{
    public $intidPqrs;
    public $strnomPqrs;
    public $stremaPqrs;
    public $strdirPqrs;
    public $strmsgPqrs;
    public $intucaPqrs;
    public $strasiPqrs;
    public $intcuaPqrs;
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

    public function selectPqrCuadrilla(int $idPqrs)
    {
        $this->intidPqrs = $idPqrs;
        $sql = "SELECT * FROM pqrs p
        LEFT JOIN cuadrillas c ON p.cuaPqrs = c.idCuadrilla
        LEFT JOIN elementos e ON p.ucaPqrs = e.idElemento
        WHERE idPqrs = $this->intidPqrs";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updatePqrs(int $idPqrs, string $fecha, string $descripcion)
    {
        $this->intidPqrs  = $idPqrs;
        $this->strfsoPqrs = $fecha;
        $this->strdsoPqrs = $descripcion;
        $this->intestPqrs = 3;

        $sql = "UPDATE pqrs SET fsoPqrs = ?, dsoPqrs = ?, estPqrs = ? WHERE idPqrs = $this->intidPqrs";
        $arrData = array($this->strfsoPqrs, $this->strdsoPqrs, $this->intestPqrs);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    
    public function updateCuapqr(int $idPqrs, int $ucap, string $fecha, int $cuadrilla, int $estado)
    {
        $this->intidPqrs  = $idPqrs;
        $this->intucaPqrs = $ucap;
        $this->strasiPqrs = $fecha;
        $this->intcuaPqrs = $cuadrilla;
        $this->intestPqrs = $estado;
        $sql = "UPDATE pqrs SET ucaPqrs = ?, asiPqrs = ?, cuaPqrs = ?, estPqrs = ? WHERE idPqrs = $this->intidPqrs";
        $arrData = array($this->intucaPqrs, $this->strasiPqrs, $this->intcuaPqrs, $this->intestPqrs);
        $request = $this->update($sql, $arrData);
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