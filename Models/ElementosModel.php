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
    private $strdetElemento;
    private $strdirElemento;
    private $fltlatElemento;
    private $fltlonElemento;
    private $strrutElemento;
    private $strainElemento;
    private $strabaElemento;
    private $fltvalElemento;
    private $intestElemento;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertElemento(int $grupo, int $item, string $codigo, int $recurso, int $uso, string $descripcion,
                                   string $detalle, string $direccion, float $latitud, float $longitud, string $ruta,
                                   string $actaini, float $valor, int $estado)
    {
        $return = 0;
        $this->intgruElemento = $grupo;
        $this->intiteElemento = $item;
        $this->strcodElemento = $codigo;
        $this->intrecElemento = $recurso;
        $this->intusoElemento = $uso;
        $this->strdesElemento = $descripcion;
        $this->strdetElemento = $detalle;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->strainElemento = $actaini;
        $this->strainElemento = $actaini;
        $this->fltvalElemento = $valor;
        $this->intestElemento = $estado;

        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}'";
        $this->select_all($sql);
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO elementos (gruElemento, iteElemento, codElemento, recElemento, usoElemento,
                            desElemento, detElemento, dirElemento, latElemento, lonElemento, rutElemento, ainElemento, valElemento, estElemento)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->intgruElemento, $this->intiteElemento, $this->strcodElemento, $this->intrecElemento, $this->intusoElemento,
                $this->strdesElemento, $this->strdirElemento, $this->strdetElemento, $this->fltlatElemento, $this->fltlonElemento,
                $this->strrutElemento, $this->strainElemento, $this->fltvalElemento, $this->intestElemento
            );
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
                g.desGruposalp as desGrupo, i.desItem as desItem, e.dirElemento, e.detElemento, e.latElemento, e.lonElemento,
                e.ainElemento, e.abaElemento, e.valElemento, e.estElemento, a.numActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa
                FROM elementos e
                INNER JOIN actas a ON e.ainElemento = a.idActa
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
                g.desGruposalp as desGrupo, i.desItem as desItem, e.dirElemento, e.detElemento, e.latElemento, e.lonElemento, e.ainElemento, 
                e.abaElemento, e.valElemento, e.estElemento, r.desRecurso as desRecurso, u.desTipouso, a.numActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa
                FROM elementos e
                INNER JOIN actas a ON e.ainElemento = a.idActa
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                INNER JOIN itemsalp i ON e.iteElemento = i.idItem
                INNER JOIN recursos r ON e.recElemento = r.idRecurso
                INNER JOIN tiposuso u ON e.usoElemento = u.idTipouso
                WHERE idElemento = $this->intidElemento";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateElemento(int $idElemento, int $grupo, int $item, string $codigo, int $recurso, int $uso,
                                    string $descripcion, string $detalle, string $direccion, float $latitud, float $longitud, string $ruta,
                                    string $actaini, string $factaini, string $actafin, string $factaffi, float $valor, int $estado)
    {
        $this->intidElemento  = $idElemento;
        $this->intgruElemento = $grupo;
        $this->intiteElemento = $item;
        $this->strcodElemento = $codigo;
        $this->intrecElemento = $recurso;
        $this->intusoElemento = $uso;
        $this->strdesElemento = $descripcion;
        $this->strdetElemento = $detalle;
        $this->strdirElemento = $direccion;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->strainElemento = $actaini;
        $this->strabaElemento = $actafin;
        $this->fltvalElemento = $valor;
        $this->intestElemento = $estado;
        $return = 0;
        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}' AND idElemento != $this->intidElemento";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE elementos SET gruElemento = ?, iteElemento = ?, codElemento = ?, recElemento = ?, usoElemento = ?,
                    desElemento = ?, detElemento = ?, dirElemento = ?, latElemento = ?, lonElemento = ?, rutElemento = ?, ainElemento = ?,
                    finElemento = abaElemento = ?,  valElemento = ?, estElemento = ?
                    WHERE idElemento = $this->intidElemento";
            $arrData = array(
                $this->intgruElemento, $this->intiteElemento, $this->strcodElemento, $this->intrecElemento, $this->intusoElemento,
                $this->strdesElemento, $this->strdetElemento, $this->strdirElemento, $this->fltlatElemento, $this->fltlonElemento,
                $this->strrutElemento, $this->strainElemento, $this->strabaElemento, $this->fltvalElemento, $this->intestElemento
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
