<?php

require_once("Libraries/Core/Mysql.php");
trait TCategoria
{
    private $con;

    public function getCategoriasT(string $categorias)
    {
        $this->con = new Mysql();
        $sql = "SELECT idCategoria, nomCategoria, desCategoria, imgCategoria, rutCategoria FROM categorias
        WHERE estCategoria != 0 AND idCategoria IN ($categorias)";
        $request = $this->con->select_all($sql);
        if (count($request) > 0) {
            for ($c = 0; $c < count($request); $c++) {
                $request[$c]['imgCategoria'] = BASE_URL . '/Assets/images/uploads/' . $request[$c]['imgCategoria'];
            }
        }
        return $request;
    }
	
    public function getCategorias()
    {
        $this->con = new Mysql();
        $sql = "SELECT c.idCategoria, c.nomCategoria, c.imgCategoria, c.rutCategoria, count(p.idCategoria) AS cantidad
		FROM productos p
		INNER JOIN categorias c
		ON p.idCategoria = c.idCategoria
        WHERE estCategoria = 1
		GROUP BY p.idCategoria, c.idCategoria";
        $request = $this->con->select_all($sql);
        if (count($request) > 0) {
            for ($c = 0; $c < count($request); $c++) {
                $request[$c]['imgCategoria'] = BASE_URL . '/Assets/images/uploads/' . $request[$c]['imgCategoria'];
            }
        }
        return $request;
    }
}

?>