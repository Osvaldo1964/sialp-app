<?php
class CajasModel extends Mysql
{
    private $intidCaja;
    private $strdesCaja;
    private $intidUsuario;
    private $intestCaja;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCaja(string $descripcion) //, int $usuario
    {
        $this->strdesCaja    = $descripcion;
        /* $this->intidUsuario    = $usuario; */
        $return = 0;
        $query_insert = "INSERT INTO cajas (desCaja) VALUES (?)";
        $arrData = array($this->strdesCaja); // $this->intidUsuario
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function selectCajas()
    {
        $sql = "SELECT c.idCaja, c.desCaja, u.idUsuario, concat(u.nomUsuario, ' ', u.apeUsuario) as nomUsuario, c.estCaja
                FROM cajas c
                INNER JOIN usuarios u ON c.usuCaja = u.idUsuario
                WHERE estCaja != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCaja(int $idCaja)
    {
        $this->intidCaja = $idCaja;
        $sql = "SELECT c.idCaja, c.desCaja, u.idUsuario, concat(u.nomUsuario, ' ', u.apeUsuario) as nomUsuario, estCaja
                            FROM cajas c
                            INNER JOIN usuarios u ON c.usuCaja = u.idUsuario
                            WHERE idCaja = $this->intidCaja";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCaja(int $idCaja, string $descripcion) //, int $usuario, int $estado)
    {
        $this->intidCaja    = $idCaja;
        $this->strdesCaja   = $descripcion;
/*         $this->intidUsuario = $usuario;
        $this->intestCaja   = $estado; */

        $sql = "UPDATE cajas SET desCaja = ?
                WHERE idCaja = $this->intidCaja";
        $arrData = array($this->strdesCaja); //, $this->intidUsuario, $this->intestCaja
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteCaja(int $idCaja)
    {
        $this->intidCaja = $idCaja;
        $sql = "UPDATE cajas SET estCaja = ? WHERE idCaja = $this->intidCaja ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
