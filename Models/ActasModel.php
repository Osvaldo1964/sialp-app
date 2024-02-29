<?php
class ActasModel extends Mysql
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

    public function selectActas()
    {
        $sql = "SELECT a.idActa, a.tipActa, a.iteActa, a.numActa, DATE_FORMAT(fecActa, '%Y-%m-%d') as fecActa,
                a.recActa, a.valActa, a.estActa,
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
        $sql = "SELECT e.idElemento, e.gruElemento, e.iteElemento,  e.codElemento, e.recElemento, e.usoElemento, e.desElemento,
                e.detElemento, g.desGruposalp as desGrupo, i.desItem as desItem, e.dirElemento, e.latElemento, e.lonElemento, e.ainElemento, 
                e.abaElemento, e.valElemento, e.estElemento, r.desRecurso as desRecurso, u.desTipouso, a.numActa, DATE_FORMAT(a.fecActa, '%Y-%m-%d') as fecActa,
                a.valActa, a.estActa
                FROM elementos e
                INNER JOIN actas a ON e.ainElemento = a.idActa
                INNER JOIN gruposalp g ON e.gruElemento = g.idGruposalp
                INNER JOIN itemsalp i ON e.iteElemento = i.idItem
                INNER JOIN recursos r ON e.recElemento = r.idRecurso
                INNER JOIN tiposuso u ON e.usoElemento = u.idTipouso
                WHERE idActa = $this->intidActa";
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

    public function insertImage(int $idImagen, string $imagen){
        $this->intidImagen = $idImagen;
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