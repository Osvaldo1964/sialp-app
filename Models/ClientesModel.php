<?php
class ClientesModel extends Mysql
{
    private $intidUsuario;
    private $inttdoUsuario;
    private $strdocUsuario;
    private $strnomUsuario;
    private $strapeUsuario;
    private $strdirUsuario;
    private $inttelUsuario;
    private $stremaUsuario;
    private $strpasUsuario;
    private $strtokUsuario;
    private $introlUsuario;
    private $intestUsuario;
    private $inttipUsuario;
    private $strrazUsuario;
    private $stractUsuario;
    private $strrepUsuario;
    private $strefaUsuario;

    //private $strpasUsuario;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCliente(
        int $tipodoc,
        string $documento,
        string $nombre,
        string $apellido,
        string $direccion,
        int $telefono,
        string $email,
        $contraseña,
        int $rol,
        $clase,
        $razon,
        $actividad,
        $replegal,
        $emafac
    ) {
        $this->inttdoUsuario    = $tipodoc;
        $this->strdocUsuario    = $documento;
        $this->strnomUsuario    = $nombre;
        $this->strapeUsuario    = $apellido;
        $this->strdirUsuario    = $direccion;
        $this->inttelUsuario    = $telefono;
        $this->stremaUsuario    = $email;
        $this->strpasUsuario    = $contraseña;
        $this->introlUsuario    = $rol;
        $this->inttipUsuario    = $clase;
        $this->strrazUsuario    = $razon;
        $this->stractUsuario    = $actividad;
        $this->strrepUsuario    = $replegal;
        $this->strefaUsuario    = $emafac;
        $return = 0;

        $sql = "SELECT * FROM usuarios WHERE emaUsuario = '{$this->stremaUsuario}' OR docUsuario =
                    '$this->strdocUsuario'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO usuarios (tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario,
                                        telUsuario, emaUsuario, pasUsuario, rolUsuario, tipUsuario, razUsuario, actUsuario,
                                        repUsuario, efaUsuario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->inttdoUsuario, $this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                $this->strdirUsuario, $this->inttelUsuario, $this->stremaUsuario, $this->strpasUsuario,
                $this->introlUsuario, $this->inttipUsuario, $this->strrazUsuario, $this->stractUsuario,
                $this->strrepUsuario, $this->strefaUsuario
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = false;
        }
        return $return;
    }

    public function selectClientes()
    {
        $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario, telUsuario, emaUsuario,
                tipUsuario, razUsuario, actUsuario, repUsuario, efaUsuario
                FROM usuarios WHERE rolUsuario = 5 and estUsuario != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCliente(int $idCliente)
    {
        $this->intidUsuario = $idCliente;
        $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario, telUsuario,
                            emaUsuario, DATE_FORMAT(regUSuario, '%Y-%m-%d') as regUsuario, tipUsuario,
                            razUsuario, actUsuario, repUsuario, efaUsuario
                            FROM usuarios
                            WHERE idUsuario = $this->intidUsuario AND rolUsuario = 5";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateCliente(
        int $idCliente,
        int $tipo,
        string $documento,
        string $nombre,
        string $apellido,
        string $direccion,
        int $telefono,
        string $email,
        string $contraseña,
        int $clase,
        string $razon,
        string $actividad,
        string $replegal,
        string $emafac
    ) {
        $this->intidUsuario     = $idCliente;
        $this->inttdoUsuario    = $tipo;
        $this->strdocUsuario    = $documento;
        $this->strnomUsuario    = $nombre;
        $this->strapeUsuario    = $apellido;
        $this->strdirUsuario    = $direccion;
        $this->inttelUsuario    = $telefono;
        $this->stremaUsuario    = $email;
        $this->strpasUsuario    = $contraseña;
        $this->inttipUsuario    = $clase;
        $this->strrazUsuario    = $razon;
        $this->stractUsuario    = $actividad;
        $this->strrepUsuario    = $replegal;
        $this->strefaUsuario    = $emafac;

        $sql = "SELECT * FROM usuarios WHERE (emaUsuario = '{$this->stremaUsuario}' AND idUsuario != '{$this->intidUsuario}')
            OR (docUsuario = '{$this->strdocUsuario}' AND idUsuario != '{$this->intidUsuario}')";
        $request = $this->select_all($sql);
        if (empty($request)) {
            if ($this->strpasUsuario != "") {
                $sql = "UPDATE usuarios SET tdoUsuario = ?, docUsuario = ?, nomUsuario = ?, apeUsuario = ?, dirUsuario = ?, telUsuario = ?,
                            emaUsuario = ?, pasUsuario = ?, tipUsuario = ?, razUsuario = ?, actUsuario = ?, repUsuario = ?, efaUsuario = ?
                    WHERE idUsuario = $this->intidUsuario";
                $arrData = array(
                    $this->inttdoUsuario, $this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                    $this->strdirUsuario, $this->inttelUsuario, $this->stremaUsuario, $this->strpasUsuario, $this->inttipUsuario,
                    $this->strrazUsuario, $this->stractUsuario, $this->strrepUsuario, $this->strefaUsuario
                );
            }else{
                $sql = "UPDATE usuarios SET tdoUsuario = ?, docUsuario = ?, nomUsuario = ?, apeUsuario = ?, dirUsuario = ?, telUsuario = ?,
                            emaUsuario = ?, tipUsuario = ?, razUsuario = ?, actUsuario = ?, repUsuario = ?, efaUsuario = ?
                    WHERE idUsuario = $this->intidUsuario";
                $arrData = array(
                    $this->inttdoUsuario, $this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                    $this->strdirUsuario, $this->inttelUsuario, $this->stremaUsuario, $this->inttipUsuario,
                    $this->strrazUsuario, $this->stractUsuario, $this->strrepUsuario, $this->strefaUsuario
                );
            }
            $request = $this->update($sql, $arrData);
        } else {
            $request = false;
        }
        return $request;
    }

    public function deleteCliente(int $idCliente)
    {
        $this->intidUsuario = $idCliente;
        $sql = "UPDATE usuarios SET estUsuario = ? WHERE idUsuario = $this->intidUsuario ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
