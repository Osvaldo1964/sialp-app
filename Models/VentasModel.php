<?php
    class VentasModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectProductos()
        {
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                    p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                    p.stoProducto, p.estProducto
                    FROM productos p
                    INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                    WHERE estProducto != 0";
            $request = $this->select_all($sql);
            return $request;
        }
    }


?>