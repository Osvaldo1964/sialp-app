<?php
class ElementosModel extends Mysql
{
    private $intidElemento;
    private $intgruElemento;
    private $intiteElemento;
    private $strcodElemento;
    private $intrecElemento;
    private $intusoElemento;
    private $strdesElemento;
    private $strdirElemento;
    private $fltlatElemento;
    private $fltlonElemento;
    private $strrutElemento;
    private $strainElemento;
    private $strfinElemento;
    private $strabaElemento;
    private $strfbaElemento;
    private $intestElemento;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertElemento(int $grupo, int $item, string $codigo, int $recurso, int $uso, string $descripcion,
                                    string $direccion, float $latitud, float $longitud, string $ruta, string $actaini,
                                    string $factaini, int $estado)
    {
        $return = 0;
        $this->intgruElemento = $grupo;
        $this->intiteElemento = $item;
        $this->strcodElemento = $codigo;
        $this->intrecElemento = $recurso;
        $this->intusoElemento = $uso;
        $this->strdesElemento = $descripcion;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->strainElemento = $actaini;
        $this->strfinElemento = $factaini;
        $this->intestElemento = $estado;

        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}'";
        $this->select_all($sql);
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO elementos (gruElemento, iteElemento, codElemento, recElemento, usoElemento,
                            desElemento, dirElemento, latElemento, lonElemento, rutElemento, ainElemento, finElemento,
                            estElemento)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->intgruElemento, $this->intiteElemento, $this->strcodElemento, $this->intrecElemento, $this->intusoElemento,
                $this->strdesElemento, $this->strdirElemento, $this->fltlatElemento, $this->fltlonElemento, $this->strrutElemento,
                $this->strainElemento, $this->strfinElemento, $this->intestElemento
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
        $sql = "SELECT e.idElemento, e.gruElemento, e.iteElemento, e.codElemento, e.recElemento, e.usoElemento, e.desElemento,
                g.desGruposalp as desGrupo, i.desItem as desItem, e.dirElemento, e.latElemento, e.lonElemento, e.ainElemento,
                e.finElemento, e.abaElemento, e.fbaElemento, e.estElemento
                FROM elementos e
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                INNER JOIN itemsalp i ON e.iteElemento = i.idItem
                WHERE estElemento != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectElemento(int $idElemento)
    {
        $this->intidElemento = $idElemento;
        $sql = "SELECT e.idElemento, e.gruElemento, e.iteElemento,  e.codElemento, e.recElemento, e.usoElemento, e.desElemento,
                g.desGruposalp as desGrupo, i.desItem as desItem, e.dirElemento, e.latElemento, e.lonElemento, e.ainElemento, e.finElemento,
                e.abaElemento, e.fbaElemento, e.estElemento, r.desRecurso as desRecurso, u.desTipouso
                FROM elementos e
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                INNER JOIN itemsalp i ON e.iteElemento = i.idItem
                INNER JOIN recursos r ON e.recElemento = r.idRecurso
                INNER JOIN tiposuso u ON e.usoElemento = u.idTipouso
                WHERE idElemento = $this->intidElemento";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateElemento(int $idElemento, int $grupo, int $item, string $codigo, int $recurso, int $uso,
                                    string $descripcion, string $direccion, float $latitud, float $longitud, string $ruta,
                                    string $actaini, string $factaini, string $actafin, string $factaffi, int $estado)
    {
        $this->intidElemento  = $idElemento;
        $this->intgruElemento = $grupo;
        $this->intiteElemento = $item;
        $this->strcodElemento = $codigo;
        $this->intrecElemento = $recurso;
        $this->intusoElemento = $uso;
        $this->strdesElemento = $descripcion;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->strainElemento = $actaini;
        $this->strfinElemento = $factaini;
        $this->strabaElemento = $actafin;
        $this->strfbaElemento = $factaffi;
        $this->intestElemento = $estado;
        $return = 0;
        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}' AND idElemento != $this->intidElemento";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE elementos SET gruElemento = ?, iteElemento = ?, codElemento = ?, recElemento = ?, usoElemento = ?,
                    desElemento = ?, dirElemento = ?, latElemento = ?, lonElemento = ?, rutElemento = ?, ainElemento = ?,
                    finElemento = ?, abaElemento = ?, fbaElemento = ?, estElemento = ?
                    WHERE idElemento = $this->intidElemento";
            $arrData = array(
                $this->intgruElemento, $this->intiteElemento, $this->strcodElemento, $this->intrecElemento, $this->intusoElemento,
                $this->strdesElemento, $this->strdirElemento, $this->fltlatElemento, $this->fltlonElemento, $this->strrutElemento,
                $this->strainElemento, $this->strfinElemento, $this->strabaElemento, $this->strfbaElemento, $this->intestElemento
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
