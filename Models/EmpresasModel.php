<?php
class EmpresasModel extends Mysql
{
    private $intidEmpresa;
    private $strnitEmpresa;
    private $strnomEmpresa;
    private $strdirEmpresa;
    private $inttelEmpresa;
    private $stremaEmpresa;
    private $intestEmpresa;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertEmpresa(
        int $nit,
        string $nombre,
        string $direccion,
        int $telefono,
        string $email,
        int $estado
    ) {
        $this->strnitEmpresa    = $nit;
        $this->strnomEmpresa    = $nombre;
        $this->strdirEmpresa    = $direccion;
        $this->inttelEmpresa    = $telefono;
        $this->stremaEmpresa    = $email;
        $this->intestEmpresa    = $estado;
        $return = 0;

        $sql = "SELECT * FROM empresas WHERE emaEmpresa = '{$this->stremaEmpresa}' OR nitEmpresa =
                    '$this->strnitEmpresa'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO empresas (nitEmpresa, nomEmpresa, dirEmpresa, telEmpresa,
                                emaEmpresa, estEmpresa) VALUES (?,?,?,?,?,?)";
            $arrData = array(
                $this->strnitEmpresa, $this->strnomEmpresa, $this->strdirEmpresa,
                $this->inttelEmpresa, $this->stremaEmpresa, $this->intestEmpresa
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectEmpresas()
    {
        $sql = "SELECT idEmpresa, nitEmpresa, nomEmpresa, dirEmpresa, telEmpresa, emaEmpresa,
                estEmpresa FROM empresas WHERE estEmpresa != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectEmpresa(int $idEmpresa)
    {
        $this->intidEmpresa = $idEmpresa;
        $sql = "SELECT idEmpresa, nitEmpresa, nomEmpresa, dirEmpresa, telEmpresa,
                            emaEmpresa, estEmpresa, DATE_FORMAT(regEmpresa, '%Y-%m-%d') as regEmpresa
                            FROM empresas
                            WHERE idEmpresa = $this->intidEmpresa";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateEmpresa(int $idEmpresa, string $nit, string $nombre,
                                string $direccion, int $telefono, string $email, int $estado)
    {
        $this->intidEmpresa     = $idEmpresa;
        $this->strnitEmpresa    = $nit;
        $this->strnomEmpresa    = $nombre;
        $this->strdirEmpresa    = $direccion;
        $this->inttelEmpresa    = $telefono;
        $this->stremaEmpresa    = $email;
        $this->intestEmpresa    = $estado;

        $sql = "SELECT * FROM empresas WHERE (emaEmpresa = '{$this->stremaEmpresa}' AND idEmpresa != '{$this->intidEmpresa}')
            OR (nitEmpresa = '{$this->strnitEmpresa}' AND idEmpresa != '{$this->intidEmpresa}')";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE empresas SET nitEmpresa = ?, nomEmpresa = ?, dirEmpresa = ?, telEmpresa = ?,
                    emaEmpresa = ?, estEmpresa = ?
                    WHERE idEmpresa = $this->intidEmpresa";
            $arrData = array(
                $this->strnitEmpresa, $this->strnomEmpresa, $this->strdirEmpresa,
                $this->inttelEmpresa, $this->stremaEmpresa, $this->intestEmpresa
            );
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteEmpresa(int $idEmpresa)
    {
        $this->intidEmpresa = $idEmpresa;
        $sql = "UPDATE empresas SET estEmpresa = ? WHERE idEmpresa = $this->intidEmpresa ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
