<?php
class FacturacionModel extends Mysql
{
    private $intidFactura;
    private $intperFactura;
    private $intrelFactura;
    private $intcanFactura;
    private $intfacFactura;
    private $intrecFactura;
    private $intestFactura;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertFactura(int $periodo, int $estrato, int $cantidad, int $facturado, int $recaudo, int $estado) {
        $this->intperFactura = $periodo;
        $this->intrelFactura = $estrato;
        $this->intcanFactura = $cantidad;
        $this->intfacFactura = $facturado;
        $this->intrecFactura = $recaudo;
        $this->intestFactura = $estado;
        $return = 0;
        $sql = "SELECT * FROM facturacion WHERE idFactura = $this->intrelFactura AND estFactura = 1 AND perFactura = $this->intperFactura";
        $request = $this->select_all($sql);
        if (empty($request)){
            $query_insert = "INSERT INTO facturacion (perFactura, relFactura, canFactura, facFactura, recFactura, estFactura) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->intperFactura, $this->intrelFactura, $this->intcanFactura, $this->intfacFactura, $this->intrecFactura, $this->intestFactura);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectFacturas()
    {
        $sql = "SELECT f.idFactura, f.perFactura, f.relFactura, e.desEstrato as desEstrato, f.canFactura, f.facFactura, f.recFactura, f.estFactura
                FROM facturacion f
                INNER JOIN estratos e ON f.relFactura = e.idEstrato
                WHERE f.estFactura != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectFactura(int $idFactura)
    {
        $this->intidFactura = $idFactura;
        $sql = "SELECT f.idFactura, f.perFactura, f.relFactura, e.desEstrato as desEstrato, f.canFactura, f.facFactura, f.recFactura, f.estFactura
        FROM facturacion f
        INNER JOIN estratos e ON f.relFactura = e.idEstrato
        WHERE idFactura = $this->intidFactura";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateFactura(int $idFactura,int $periodo, int $estrato, int $cantidad, int $facturado, int $recaudo, int $estado)
    {
        $this->intidFactura = $idFactura;
        $this->intperFactura = $periodo;
        $this->intrelFactura = $estrato;
        $this->intcanFactura = $cantidad;
        $this->intfacFactura = $facturado;
        $this->intrecFactura = $recaudo;
        $this->intestFactura = $estado;
        $sql = "UPDATE facturacion SET perFactura = ?, relFactura = ?, canFactura = ?, facFactura = ?, recFactura = ?, estFactura = ?
                WHERE idFactura = $this->intidFactura";
        $arrData = array($this->intperFactura, $this->intrelFactura, $this->intcanFactura, $this->intfacFactura, $this->intrecFactura, $this->intestFactura);
        $request = $this->update($sql, $arrData);

        return $request;
    }

    public function deleteFactura(int $idFactura)
    {
        $this->intidFactura = $idFactura;
        $sql = "UPDATE facturacion SET estFactura = ? WHERE idFactura = $this->intidFactura";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
