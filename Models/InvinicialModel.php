<?php
class InvinicialModel extends Mysql
{
    public $intidActa;
    public $inttipActa;
    public $intiteActa;
    public $strnumActa;
    public $strfecActa;
    public $strpdfActa;
    public $intrecActa;
    public $fltvalActa;
    public $intestActa;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertActa($tipo, $clase, $numero, $fecha, $recurso, $valor, $estado) {
        $return = 0;
        $this->inttipActa  = $tipo;
        $this->intiteActa  = $clase;
        $this->strnumActa  = $numero;
        $this->strfecActa  = $fecha;
        $this->intrecActa  = $recurso;
        $this->fltvalActa  = $valor;
        $this->intestActa  = $estado;

        $sql = "SELECT * FROM actas WHERE numActa = '{$this->strnumActa}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO actas (tipActa, iteActa, numActa, fecActa, recActa, valActa, estActa)
                            VALUES (?,?,?,?,?,?,?)";
            $arrData = array($this->inttipActa, $this->intiteActa, $this->strnumActa, $this->strfecActa,
                                    $this->intrecActa, $this->fltvalActa, $this->intestActa);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectActas(int $tipActa)
    {
        $this->inttipActa = $tipActa;
        $sql = "SELECT a.idActa, a.tipActa, a.iteActa, a.numActa, DATE_FORMAT(fecActa, '%Y-%m-%d') as fecActa,
                a.recActa, a.valActa, a.estActa,
                t.desTipoacta as desTipoacta, i.desItemacta as desItemacta, r.desRecurso as desRecurso
                FROM actas a
                INNER JOIN tipoactas t ON a.tipActa = t.idTipoacta 
                INNER JOIN itemsacta i ON a.iteActa = i.idItemacta
                INNER JOIN recursos r ON a.recActa = r.idRecurso
                WHERE estActa != 0 AND a.tipActa = $this->inttipActa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectActa(int $idActa)
    {
        $this->intidActa = $idActa;
        $sql = "SELECT a.idActa, a.tipActa, a.iteActa, a.numActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa, a.recActa, a.valActa, a.estActa,
                t.desTipoacta as desTipoacta, i.desItemacta as desItemacta, r.desRecurso as desRecurso 
                FROM actas a
                INNER JOIN tipoactas t ON t.idTipoacta = 2
                INNER JOIN itemsacta i ON a.iteActa = i.idItemacta
                INNER JOIN recursos r ON a.recActa = r.idRecurso
                WHERE idActa = $this->intidActa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectActaimp(int $idActa)
    {
        $this->intidActa = $idActa;
        $sql = "SELECT e.idElemento, e.claElemento, e.codElemento, e.detElemento, e.desElemento, e.dirElemento,
        e.recElemento, r.desRecurso as desRecurso, e.usoElemento, u.desTipouso as desTipouso, 
        c.desClase as desClase, e.tecElemento, t.desTecno as desTecno, e.matElemento, e.potElemento,
        p.desPotencia as desPotencia, m.desMaterial as desMaterial, e.altElemento, l.desAltura as desAltura, 
        e.latElemento, e.lonElemento, e.ainElemento, e.abaElemento, e.valElemento, e.estElemento,
        a.numActa, a.estActa, a.valActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa
        FROM elementos e
        INNER JOIN actas a ON e.ainElemento = a.idActa
        INNER JOIN clases c ON e.claElemento = c.idClase
        LEFT JOIN tecnologias t ON e.tecElemento = t.idTecno
        LEFT JOIN potencias p ON e.potElemento = p.idPotencia
        LEFT JOIN materiales m ON e.matElemento = m.idMaterial
        LEFT JOIN alturas l ON e.altElemento = l.idAltura
        LEFT JOIN recursos r ON e.recElemento = r.idRecurso
        LEFT JOIN tiposuso u ON e.usoElemento = u.idTipouso
        WHERE estElemento != 0 AND a.idActa = $this->intidActa ORDER BY e.claElemento, e.codElemento";
        $request = $this->select_all($sql);
        return $request;
    }


    public function updateActa(int $idActa, $tipo, $clase, $numero, $fecha, $recurso, $valor, $estado)
    {
        $this->intidActa   = $idActa;
        $this->inttipActa  = $tipo;
        $this->intiteActa  = $clase;
        $this->strnumActa  = $numero;
        $this->strfecActa  = $fecha;
        $this->intrecActa  = $recurso;
        $this->fltvalActa  = $valor;
        $this->intestActa  = $estado;

        $sql = "SELECT * FROM actas WHERE numActa = '{$this->strnumActa}' AND idActa != $this->intidActa";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE actas SET tipActa = ?, iteActa = ?, numActa = ?, fecActa = ?, recActa = ?, valActa = ?,
                    estActa = ?
                    WHERE idActa = $this->intidActa";
            $arrData = array($this->inttipActa, $this->intiteActa, $this->strnumActa, $this->strfecActa,
                            $this->intrecActa, $this->fltvalActa, $this->intestActa);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteActa(int $idActa)
    {
        $this->intidActa = $idActa;
        $sql = "SELECT * FROM elementos WHERE numActa = $this->intidActa";
        $request = $this->select_all($sql);
        if (empty($request)){
            $sql = "UPDATE actas SET estActa = ? WHERE idActa = $this->intidActa";
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

    public function insertPdf(int $idActa, string $pdf){
        $this->intidActa = $idActa;
        $this->strpdfActa = $pdf;
        $query_insert = "INSERT INTO docuactas (actImagen, nomImagen) VALUES (?,?)";
        $arrData = array($this->intidActa, $this->strpdfActa);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectPdf(int $idActa){
        $this->intidActa = $idActa;
        $sql = "SELECT actImagen, nomImagen FROM docuactas WHERE actImagen = $this->intidActa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function deletePdf(int $idActa, string $pdf){
        $this->intidActa = $idActa;
        $this->strpdfActa = $pdf;
        $query = "DELETE FROM docuactas WHERE idImagen = $this->intidActa AND nomImagen = '{$this->strpdfActa}'";
        $request_delete = $this->delete($query);
        return $request_delete;
    }

    public function insertImage(int $idActa, string $imagen){
        $this->intidActa = $idActa;
        $this->strImagen = $imagen;
        $query_insert = "INSERT INTO imagenes (idElemento, nomImagen) VALUES (?,?)";
        $arrData = array($this->intidActa, $this->strImagen);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    public function selectImages(int $idActa){
        $this->intidActa = $idActa;
        $sql = "SELECT actImagen, nomImagen FROM docuactas WHERE actImagen = $this->intidActa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function deleteImage(int $idActa, string $imagen){
        $this->intidActa = $idActa;
        $this->strImagen = $imagen;
        $query = "DELETE FROM docuactas WHERE idImagen = $this->intidActa AND nomImagen = '{$this->strImagen}'";
        $request_delete = $this->delete($query);
        return $request_delete;
    }
}