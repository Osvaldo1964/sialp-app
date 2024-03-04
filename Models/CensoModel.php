<?php
class CensoModel extends Mysql
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

    public function selectCenso()
    {
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
        WHERE estElemento != 0 ORDER BY e.claElemento, e.codElemento";
        $request = $this->select_all($sql);
        return $request;
    }



}