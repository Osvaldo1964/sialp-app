<?php
    class ProductosModel extends Mysql
    {
        private $intidProducto;
        private $intidCategoria;
        private $strcodProducto;
        private $strnomProducto;
        private $strdesProducto;
        private $intstoProducto;
        private $intvtaProducto;
        private $intestProducto;
        private $strrutProducto;
        private $strImagen;

        public function __construct()
        {
            parent::__construct();
        }

        public function insertProducto(string $nombre, string $descripcion, string $codigo, int $categoria,
                                        int $precio, int $stock, string $ruta, int $estado) {
            $return = 0;
            $this->strnomProducto   = $nombre;
            $this->strdesProducto   = $descripcion;
            $this->strcodProducto   = $codigo;
            $this->intidCategoria   = $categoria;
            $this->intvtaProducto   = $precio;
            $this->intstoProducto   = $stock;
            $this->strrutProducto   = $ruta;
            $this->intestProducto   = $estado;

            $sql = "SELECT * FROM productos WHERE codProducto = '{$this->strcodProducto}'";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query_insert = "INSERT INTO productos (nomProducto, desProducto, codProducto, idCategoria, vtaProducto,
                                stoProducto, rutProducto, estProducto)
                                VALUES (?,?,?,?,?,?,?,?)";
                $arrData = array($this->strnomProducto, $this->strdesProducto, $this->strcodProducto, $this->intidCategoria,
                                    $this->intvtaProducto, $this->intstoProducto, $this->strrutProducto, $this->intestProducto);
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = 'exist';
            }
            return $return;
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

        public function selectProducto(int $idProducto)
        {
            $this->intidProducto = $idProducto;
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                    p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                    p.stoProducto, p.rutProducto, p.estProducto
                    FROM productos p
                    INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                    WHERE idProducto = $this->intidProducto";
            $request = $this->select_all($sql);
            return $request;
        }

        public function updateProducto(int $idProducto, string $nombre, string $descripcion, string $codigo, int $categoria,
                                        int $precio, int $stock, string $ruta, int $estado)
        {
            $this->intidProducto    = $idProducto;
            $this->strnomProducto   = $nombre;
            $this->strdesProducto   = $descripcion;
            $this->strcodProducto   = $codigo;
            $this->intidCategoria   = $categoria;
            $this->intvtaProducto   = $precio;
            $this->intstoProducto   = $stock;
            $this->strrutProducto   = $ruta;
            $this->intestProducto   = $estado;
            $return = 0;
            $sql = "SELECT * FROM productos WHERE codProducto = '{$this->strcodProducto}' AND idProducto != $this->intidProducto";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $sql = "UPDATE productos SET nomProducto = ?, desProducto = ?, codProducto = ?, idCategoria = ?, 
                        vtaProducto = ?, stoProducto = ?, rutProducto = ?, estProducto = ?
                        WHERE idProducto = $this->intidProducto";
                $arrData = array($this->strnomProducto, $this->strdesProducto, $this->strcodProducto, $this->intidCategoria,
                                $this->intvtaProducto, $this->intstoProducto, $this->strrutProducto, $this->intestProducto);
                $request = $this->update($sql, $arrData);
                $return = $request;
            } else {
                $return = "exist";
            }
            return $return;
        }

        public function deleteProducto(int $idProducto)
        {
            $this->intidProducto = $idProducto;
            $sql = "UPDATE productos SET estProducto = ? WHERE idProducto = $this->intidProducto";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            return $request;
        }

        public function insertImage(int $idProducto, string $imagen){
            $this->intidProducto = $idProducto;
            $this->strImagen = $imagen;
            $query_insert = "INSERT INTO imagenes (idProducto, nomImagen) VALUES (?,?)";
            $arrData = array($this->intidProducto, $this->strImagen);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function selectImages(int $idProducto){
            $this->intidProducto = $idProducto;
            $sql = "SELECT idProducto, nomImagen FROM imagenes WHERE idProducto = $this->intidProducto";
            $request = $this->select_all($sql);
            return $request;
        }

        public function deleteImage(int $idProducto, string $imagen){
            $this->intidProducto = $idProducto;
            $this->strImagen = $imagen;
            $query = "DELETE FROM imagenes WHERE idProducto = $this->intidProducto AND nomImagen = '{$this->strImagen}'";
            $request_delete = $this->delete($query);
            return $request_delete;
        }
    }
