<?php
class UsuariosModel extends Mysql
{
    private $intidUsuario;
    private $strtdoUsuario;
    private $strdocUsuario;
    private $strnomUsuario;
    private $strapeUsuario;
    private $strdirUsuario;
    private $inttelUsuario;
    private $stremaUsuario;
    private $strpasUsuario;
    private $strtokUsuario;
    private $introlUsuario;
    private $inttipUsuario;
    private $strrazUsuario;
    private $stractUsuario;
    private $strrepUsuario;
    private $strefaUsuario;
    private $intestUsuario;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertUsuario(string $documento, string $nombre, string $apellido, int $telefono,
                                    string $email, string $password, int $idRol, int $estado)
    {
        $this->strtdoUsuario    = 1;
        $this->strdocUsuario    = $documento;
        $this->strnomUsuario    = $nombre;
        $this->strapeUsuario    = $apellido;
        $this->strdirUsuario    = '';
        $this->inttelUsuario    = $telefono;
        $this->stremaUsuario    = $email;
        $this->strpasUsuario    = $password;
        $this->introlUsuario    = $idRol;
        $this->inttipUsuario    = 0;
        $this->stractUsuario    = '';
        $this->strrepUsuario    = '';
        $this->strefaUsuario    = '';
        $this->intestUsuario    = $estado;
        $return = 0;

        $sql = "SELECT * FROM usuarios WHERE emaUsuario = '{$this->stremaUsuario}' OR docUsuario =
                    '$this->strdocUsuario'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO usuarios (tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario,
                                telUsuario, emaUsuario, pasUsuario, rolUsuario, tipUsuario, actUsuario, repUsuario,
                                efaUsuario, estUsuario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strtdoUsuario, $this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                $this->strdirUsuario, $this->inttelUsuario, $this->stremaUsuario, $this->strpasUsuario,
                $this->introlUsuario, $this->inttipUsuario, $this->stractUsuario, $this->strrepUsuario,
                $this->strefaUsuario, $this->intestUsuario
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectUsuarios()
    {
        $whereAdmin = "";
        if ($_SESSION['idUser'] != 1){
            $whereAdmin = " AND p.idUsuario != 1";
        }
        $sql = "SELECT p.idUsuario, p.docUsuario, p.nomUsuario, p.apeUsuario, p.telUsuario,
                    p.emaUsuario, p.estUsuario, r.idRol, r.nomRol
                    FROM usuarios p
                    INNER JOIN roles r ON p.rolUsuario = r.idRol
                    WHERE p.estUsuario != 0" . $whereAdmin;
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectUsuario(int $idUsuario)
    {
        $this->intidUsuario = $idUsuario;
        $sql = "SELECT p.idUsuario, p.docUsuario, p.nomUsuario, p.apeUsuario, p.telUsuario,
                            p.emaUsuario, r.idRol, r.nomRol, p.estUsuario, DATE_FORMAT(p.regUsuario, '%Y-%m-%d') as regUsuario
                            FROM usuarios p
                            INNER JOIN roles r ON p.rolUsuario = r.idRol
                            WHERE p.idUsuario = $this->intidUsuario";
        $request = $this->select_all($sql);
        return $request;
    }

    public function updateUsuario(int $idUsuario, string $documento, string $nombre, string $apellido,
        int $telefono, string $email, string $password, int $idRol, int $estado)
    {
        $this->intidUsuario     = $idUsuario;
        $this->strdocUsuario    = $documento;
        $this->strnomUsuario    = $nombre;
        $this->strapeUsuario    = $apellido;
        $this->inttelUsuario    = $telefono;
        $this->stremaUsuario    = $email;
        $this->strpasUsuario    = $password;
        $this->introlUsuario    = $idRol;
        $this->intestUsuario    = $estado;
        
        $sql = "SELECT * FROM usuarios WHERE (emaUsuario = '{$this->stremaUsuario}' AND idUsuario != '{$this->intidUsuario}')
                OR (docUsuario = '{$this->strdocUsuario}' AND idUsuario != '{$this->intidUsuario}')";
        $request = $this->select_all($sql);
        if (empty($request))
        {
            if ($this->strpasUsuario = ""){
                $sql = "UPDATE usuarios SET docUsuario = ?, nomUsuario = ?, apeUsuario = ?, 
                        telUsuario = ?, emaUsuario = ?, pasUsuario = ?, rolUsuario = ?, 
                        estUsuario = ?
                        WHERE idUsuario = $this->intidUsuario";
                $arrData = array($this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                            $this->inttelUsuario, $this->stremaUsuario, $this->strpasUsuario,
                            $this->introlUsuario, $this->intestUsuario);
            }else{
                $sql = "UPDATE usuarios SET docUsuario = ?, nomUsuario = ?, apeUsuario = ?, 
                        telUsuario = ?, emaUsuario = ?, rolUsuario = ?, estUsuario = ?
                        WHERE idUsuario = $this->intidUsuario";
                $arrData = array($this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario,
                            $this->inttelUsuario, $this->stremaUsuario, $this->introlUsuario,
                            $this->intestUsuario);
            }
            $request = $this->update($sql, $arrData);
        }else{
            $request = "exist";
        }
        //dep('esto devuelve el model'.$request);exit;
        return $request;
    }

    public function deleteUsuario(int $idUsuario)
		{
			$this->intidUsuario = $idUsuario;
            $sql = "UPDATE usuarios SET estUsuario = ? WHERE idUsuario = $this->intidUsuario ";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            return $request;
		}

    public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido,
                                int $telefono, string $password){
        $this->intidUsuario = $idUsuario;
        $this->strdocUsuario = $identificacion;
        $this->strnomUsuario = $nombre;
        $this->strapeUsuario = $apellido;
        $this->inttelUsuario = $telefono;
        $this->strpasUsuario = $password;

        if ($this->strpasUsuario != "")
        {
            $sql = "UPDATE usuarios SET docUsuario = ?, nomUsuario = ?, apeUsuario = ?, telUsuario = ?,
                    pasUsuario = ? WHERE idUsuario = $this->intidUsuario";
            $arrData = array($this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario, 
            $this->inttelUsuario, $this->strpasUsuario);
        }else{
            $sql = "UPDATE usuarios SET docUsuario = ?, nomUsuario = ?, apeUsuario = ?, telUsuario = ?
                    WHERE idUsuario = $this->intidUsuario";
            $arrData = array($this->strdocUsuario, $this->strnomUsuario, $this->strapeUsuario, 
            $this->inttelUsuario);
        }
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updateComercial(int $idUsuario, int $tipo, string $razon, string $actividad,
                                    string $replegal, string $direccion, string $emafac){
        $this->intidUsuario = $idUsuario;
        $this->inttipUsuario = $tipo;
        $this->strrazUsuario = $razon;
        $this->stractUsuario = $actividad;
        $this->strrepUsuario = $replegal;
        $this->strdirUsuario = $direccion;
        $this->strefaUsuario = $emafac;
        $sql = "UPDATE usuarios SET tipUsuario = ?, razUsuario = ?, actUsuario = ?, repUsuario = ?, dirUsuario = ?, efaUsuario = ?
                WHERE idUsuario = $this->intidUsuario";
        $arrData = array($this->inttipUsuario, $this->strrazUsuario, $this->stractUsuario, 
                        $this->strrepUsuario, $this->strdirUsuario, $this->strefaUsuario);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
