<?php
class ElementosModel extends Mysql
{
    private $intidElemento;
    private $intclaElemento;
    private $strcodElemento;
    private $strdetElemento;
    private $strdesElemento;
    private $strdirElemento;
    private $intrecElemento;
    private $intusoElemento;
    private $inttecElemento;
    private $intpotElemento;
    private $intmatElemento;
    private $intaltElemento;
    private $fltlatElemento;
    private $fltlonElemento;
    private $strrutElemento;
    private $intainElemento;
    private $strabaElemento;
    private $fltvalElemento;
    private $intestElemento;
    private $fltvalActa;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertElemento(
        int $clase,
        string $codigo,
        string $detalle,
        string $descripcion,
        string $direccion,
        int $recurso,
        int $uso,
        int $tecnologia,
        int $potencia,
        int $material,
        int $altura,
        float $latitud,
        float $longitud,
        string $ruta,
        string $actaini,
        float $valor,
        int $estado
    ) {
        $return = 0;
        $this->intclaElemento = $clase;
        $this->strcodElemento = $codigo;
        $this->strdetElemento = $detalle;
        $this->strdesElemento = $descripcion;
        $this->strdirElemento = $direccion;
        $this->intrecElemento = $recurso;
        $this->intusoElemento = $uso;
        $this->inttecElemento = $tecnologia == '' ? 0 : $tecnologia;
        $this->intpotElemento = $potencia == '' ? 0 : $potencia;
        $this->intmatElemento = $material == '' ? 0 : $material;
        $this->intaltElemento = $altura == '' ? 0 : $altura;
        $this->fltlatElemento = $latitud;
        $this->fltlonElemento = $longitud;
        $this->strrutElemento = $ruta;
        $this->intainElemento = $actaini;
        $this->fltvalElemento = $valor;
        $this->intestElemento = $estado;

        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}'";
        $this->select_all($sql);
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO elementos (claElemento, codElemento, detElemento, desElemento, dirElemento,
                            recElemento, usoElemento, tecElemento, potElemento, matElemento, altElemento, latElemento,
                            lonElemento, rutElemento, ainElemento, valElemento, estElemento)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->intclaElemento, $this->strcodElemento, $this->strdetElemento, $this->strdesElemento,
                $this->strdirElemento, $this->intrecElemento, $this->intusoElemento, $this->inttecElemento,
                $this->intpotElemento, $this->intmatElemento, $this->intaltElemento, $this->fltlatElemento,
                $this->fltlonElemento, $this->strrutElemento, $this->intainElemento, $this->fltvalElemento,
                $this->intestElemento
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
            // Actualizo valor acta
            $query_selActa = "SELECT idActa, valActa FROM actas WHERE idActa = $this->intainElemento";
            $request_selActa = $this->select_all($query_selActa);
            //dep($request_selActa);exit;
            $this->fltvalActa = $request_selActa[0]['valActa'] + $this->fltvalElemento;
            $query_valActa = "UPDATE actas SET valActa = ? WHERE idActa = $this->intainElemento";
            $arrData = array($this->fltvalActa);
            $this->insert($query_valActa, $arrData);
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectElementos()
    {
        $sql = "SELECT e.idElemento, e.claElemento, e.codElemento, e.detElemento, e.desElemento, e.dirElemento,
                e.recElemento, r.desRecurso as desRecurso, e.usoElemento, u.desTipouso as desTipouso, 
                c.desClase as desClase, e.tecElemento, t.desTecno as desTecno, e.matElemento, e.potElemento,
                p.desPotencia as desPotencia, m.desMaterial as desMaterial, e.altElemento, l.desAltura as desAltura, 
                e.latElemento, e.lonElemento, e.ainElemento, e.abaElemento, e.valElemento, e.estElemento,
                a.numActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa
                FROM elementos e
                INNER JOIN actas a ON e.ainElemento = a.idActa
                INNER JOIN clases c ON e.claElemento = c.idClase
                LEFT JOIN tecnologias t ON e.tecElemento = t.idTecno
                LEFT JOIN potencias p ON e.potElemento = p.idPotencia
                LEFT JOIN materiales m ON e.matElemento = m.idMaterial
                LEFT JOIN alturas l ON e.altElemento = l.idAltura
                LEFT JOIN recursos r ON e.recElemento = r.idRecurso
                LEFT JOIN tiposuso u ON e.usoElemento = u.idTipouso
                WHERE estElemento != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectElemento(int $idElemento)
    {
        $this->intidElemento = $idElemento;
        $sql = "SELECT e.idElemento, e.claElemento, e.codElemento, e.detElemento, e.desElemento, e.dirElemento,
                e.recElemento, r.desRecurso as desRecurso, e.usoElemento, u.desTipouso as desTipouso,
                c.desClase as desClase, e.tecElemento, t.desTecno as desTecno, e.potElemento, p.desPotencia as desPotencia, 
                e.matElemento, m.desMaterial as desMaterial, e.altElemento, l.desAltura as desAltura, 
                e.latElemento, e.lonElemento, e.ainElemento, e.abaElemento, e.valElemento, e.estElemento, a.numActa,
                DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa
                FROM elementos e
                INNER JOIN actas a ON e.ainElemento = a.idActa
                INNER JOIN clases c ON e.claElemento = c.idClase
                LEFT JOIN tecnologias t ON e.tecElemento = t.idTecno
                LEFT JOIN potencias p ON e.potElemento = p.idPotencia
                LEFT JOIN materiales m ON e.matElemento = m.idMaterial
                LEFT JOIN alturas l ON e.altElemento = l.idAltura
                LEFT JOIN recursos r ON e.recElemento = r.idRecurso
                LEFT JOIN tiposuso u ON e.usoElemento = u.idTipouso
                WHERE idElemento = $this->intidElemento";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateElemento(int $idElemento, string $descripcion, int $estado)
    {
        $this->intidElemento  = $idElemento;
        $this->strdesElemento = $descripcion;
        $this->intestElemento = $estado;
        $return = 0;
        $sql = "SELECT * FROM elementos WHERE codElemento = '{$this->strcodElemento}' AND
                idElemento != $this->intidElemento";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE elementos SET desElemento = ?, estElemento = ?
                    WHERE idElemento = $this->intidElemento";
            $arrData = array($this->strdesElemento, $this->intestElemento);
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
