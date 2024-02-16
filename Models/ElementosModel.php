<?php
class ElementosModel extends Mysql
{
    private $intidElemento;
    private $intgruElemento;
    private $strcodElemento;
    private $strnomElemento;
    private $strdesElemento;
    private $strdirElemento;
    private $fltlatElemento;
    private $fltlonElemento;
    private $strrutElemento;
    private $intestElemento;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertElemento(int $grupo, string $codigo, string $nombre, string $descripcion, string $direccion, float $latitud, float $longitud, string $ruta, int $estado)
    {
        $return = 0;
        $this->intgruElemento = $grupo;
        $this->strcodElemento = $codigo;
        $this->strnomElemento = $nombre;
        $this->strdesElemento = $descripcion;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->intestElemento = $estado;

        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}'";
        $this->select_all($sql);
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO elementos (gruElemento, codElemento, nomElemento, desElemento, dirElemento, latElemento, lonElemento,
                                rutElemento, estElemento)
                                VALUES (?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->intgruElemento, $this->strcodElemento, $this->strnomElemento, $this->strdesElemento,
                $this->strdirElemento, $this->fltlatElemento, $this->fltlonElemento, $this->strrutElemento, $this->intestElemento
            );
            $this->insert($query_insert, $arrData); 
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectElementos()
    {
        $sql = "SELECT e.idElemento, e.gruElemento, e.codElemento, e.nomElemento, e.desElemento,
                g.desGruposalp as desGrupo, e.dirElemento, e.latElemento, e.lonElemento, e.estElemento
                FROM elementos e
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                WHERE estElemento != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectElemento(int $idElemento)
    {
        $this->intidElemento = $idElemento;
        $sql = "SELECT e.idElemento, e.gruElemento, e.codElemento, e.nomElemento, e.desElemento,
                g.desGruposalp as desGrupo, e.dirElemento, e.latElemento, e.lonElemento, e.estElemento
                FROM elementos e
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                WHERE idElemento = $this->intidElemento";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateElemento(int $idElemento, int $grupo, string $codigo, string $nombre, string $descripcion, string $direccion,
                                 float $latitud, float $longitud, string $ruta, int $estado)
    {
        $this->intidElemento  = $idElemento;
        $this->intgruElemento = $grupo;
        $this->strcodElemento = $codigo;
        $this->strnomElemento = $nombre;
        $this->strdesElemento = $descripcion;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->intestElemento = $estado;
        $return = 0;
        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}' AND idElemento != $this->intidElemento";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE elementos SET gruElemento = ?, codElemento = ?, nomElemento = ?, desElemento = ?, 
                        dirElemento = ?, latElemento = ?, lonElemento = ?, rutElemento = ?, estElemento = ?
                        WHERE idElemento = $this->intidElemento";
            $arrData = array(
                $this->intgruElemento, $this->strcodElemento, $this->strnomElemento, $this->strdesElemento,
                $this->strdirElemento, $this->fltlatElemento, $this->fltlonElemento, $this->strrutElemento, $this->intestElemento
            );
            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function deleteElemento(int $idElemento)
    {
        $this->intidElemento = $idElemento;
        $sql = "UPDATE elementos SET estElemento = ? WHERE idElemento = $this->intidElemento";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function insertImage(int $idElemento, string $imagen)
    {
        $this->intidElemento = $idElemento;
        $this->strImagen = $imagen;
        $query_insert = "INSERT INTO imagenes (idElemento, nomImagen) VALUES (?,?)";
        $arrData = array($this->intidElemento, $this->strImagen);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectImages(int $idElemento)
    {
        $this->intidElemento = $idElemento;
        $sql = "SELECT idElemento, nomImagen FROM imagenes WHERE idElemento = $this->intidElemento";
        $request = $this->select_all($sql);
        return $request;
    }

    public function deleteImage(int $idElemento, string $imagen)
    {
        $this->intidElemento = $idElemento;
        $this->strImagen = $imagen;
        $query = "DELETE FROM imagenes WHERE idElemento = $this->intidElemento AND nomImagen = '{$this->strImagen}'";
        $request_delete = $this->delete($query);
        return $request_delete;
    }
}
