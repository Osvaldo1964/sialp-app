<?php
    require_once("Libraries/Core/Mysql.php");
    trait TProducto
    {
        private $con;
        private $strCategoria;
        private $intidCategoria;
        private $intidProducto;
        private $strProducto;
        private $cant;
        private $option;
		private $strRuta;
        private $strrutCategoria;
        private $strrutProducto;

        public function getProductosT()
        {
            $this->con = new Mysql();
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto != 0 ORDER BY p.idProducto DESC LIMIT " . CANTPRODHOME;
            $request = $this->con->select_all($sql);
            if (count($request) > 0) {
                for ($c = 0; $c < count($request); $c++) {
                    $intidProducto = $request[$c]['idProducto'];
                    $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }else{
                        $arrImg[0]['url_imagen'] = media().'/images/uploads/product.png';
                    }
                    $request[$c]['imagenes'] = $arrImg;
                }
            }
            return $request;
        }

		public function getProductosPage($desde, $porpagina)
        {
            $this->con = new Mysql();
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto != 0 ORDER BY p.idProducto DESC LIMIT $desde, $porpagina";
            $request = $this->con->select_all($sql);
            if (count($request) > 0) {
                for ($c = 0; $c < count($request); $c++) {
                    $intidProducto = $request[$c]['idProducto'];
                    $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }else{
                        $arrImg[0]['url_imagen'] = media().'/images/uploads/product.png';
                    }
                    $request[$c]['imagenes'] = $arrImg;
                }
            }
            return $request;
        }

        public function getProductosCategoriaT(int $idCategoria, string $ruta, $desde = null, $porpagina = null){
            $this->intidCategoria = $idCategoria;
            $this->strrutCategoria = $ruta;
			$where = "";
			if (is_numeric($desde) AND is_numeric($porpagina)){
				$where = " LIMIT " . $desde . "," . $porpagina;
			}
            $this->con = new Mysql();
            $sql_cat = "SELECT idCategoria, nomCategoria, rutCategoria FROM categorias WHERE idCategoria = '{$this->intidCategoria}'";
            $request = $this->con->select($sql_cat);
            if (!empty($request)) {
                $this->strnomCategoria = $request['nomCategoria'];
				$this->strrutCategoria = $request['rutCategoria'];
                $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                    p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, p.rutProducto,
                    p.stoProducto
                    FROM productos p
                    INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                    WHERE estProducto != 0 AND p.idCategoria = $this->intidCategoria AND c.rutCategoria = '{$this->strrutCategoria}'
					ORDER BY p.idProducto DESC" . $where;
                $request = $this->con->select_all($sql);
                if (count($request) > 0) {
                    for ($c = 0; $c < count($request); $c++) {
                        $intidProducto = $request[$c]['idProducto'];
                        $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                        $arrImg = $this->con->select_all($sqlImg);
                        if (count($arrImg) > 0) {
                            for ($i = 0; $i < count($arrImg); $i++) {
                                $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                            }
                        }
                        $request[$c]['imagenes'] = $arrImg;
                    }
                }
                $request = array('idCategoria' => $this->intidCategoria,
								 'rutCategoria' => $this->strrutCategoria,
                                'nomCategoria' => $this->strnomCategoria,
                                'productos' => $request);
            }
            return $request;
        }

        public function getProductoT(int $idProducto, string $ruta)
        {
            $this->con = new Mysql();
            $this->intidProducto = $idProducto;
            $this->strrutProducto = $ruta;
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, c.rutCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto != 0 AND p.idProducto = '{$this->intidProducto}' AND p.rutProducto = '{$this->strrutProducto}'";
            $request = $this->con->select($sql);
            if (!empty($request)) {
                $intidProducto = $request['idProducto'];
                $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($i = 0; $i < count($arrImg); $i++) {
                        $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                    }
                }else{
                    $arrImg[0]['url_imagen'] = media().'/images/uploads/product.png';
                }
                $request['imagenes'] = $arrImg;
            }
            return $request;
        }

        public function getProductosRandom(int $idcategoria, int $cant, string $option){
            $this->intIdcategoria = $idcategoria;
            $this->cant = $cant;
            $this->option = $option;
    
            if($option == "r"){
                $this->option = " RAND() ";
            }else if($option == "a"){
                $this->option = " idProducto ASC ";
            }else{
                $this->option = " idProducto DESC ";
            }
    
            $this->con = new Mysql();
            $sql = "SELECT p.idProducto, p.codProducto, p.nomProducto,
                            p.desProducto, p.idCategoria, c.nomCategoria as categoria,
                            p.vtaProducto, p.rutProducto, p.stoProducto
                    FROM productos p INNER JOIN categorias c
                    ON p.idCategoria = c.idCategoria
                    WHERE p.estProducto != 0 AND p.idCategoria = $this->intIdcategoria
                    ORDER BY $this->option LIMIT  $this->cant ";
            $request = $this->con->select_all($sql);
            if(count($request) > 0){
                for ($c=0; $c < count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['idProducto'];
                    $sqlImg = "SELECT nomImagen FROM imagenes
                            WHERE idProducto = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if(count($arrImg) > 0){
                        for ($i=0; $i < count($arrImg); $i++) { 
                            $arrImg[$i]['url_imagen'] = media().'/images/uploads/'.$arrImg[$i]['nomImagen'];
                        }
                    }
                    $request[$c]['imagenes'] = $arrImg;
                }
            }
            return $request;
        }

        public function getProductoIDT(int $idProducto)
        {
            $this->con = new Mysql();
            $this->intidProducto = $idProducto;
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto != 0 AND p.idProducto = '{$this->intidProducto}'";
            $request = $this->con->select($sql);
            if (!empty($request)) {
                $intidProducto = $request['idProducto'];
                $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($i = 0; $i < count($arrImg); $i++) {
                        $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                    }
                }else{
                    $arrImg[0]['url_imagen'] = media().'/images/uploads/product.png';
                }
                $request['imagenes'] = $arrImg;
            }
            return $request;
        }
		
		public function cantProductos($categoria = null){
			$where = "";
			if ($categoria != null){
				$where = " AND idCategoria = " . $categoria;
			}
			$this->con = new Mysql();
			$sql = "SELECT COUNT(*) AS total_registro FROM productos WHERE estProducto = 1" . $where;
			$result_register = $this->con->select($sql);
			$total_registro = $result_register;
			return $total_registro;
		}
		
		public function cantProdSearch($busqueda){
			$this->con = new Mysql();
			$sql = "SELECT COUNT(*) AS total_registro FROM productos WHERE nomProducto LIKE '%$busqueda%' AND estProducto= 1" . $where;
			$result_register = $this->con->select($sql);
			$total_registro = $result_register;
			return $total_registro;

		}

		public function getProdSearch($busqueda, $desde, $porpagina)
        {
            $this->con = new Mysql();
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto = 1 AND p.nomProducto LIKE '%$busqueda%' ORDER BY p.idProducto DESC LIMIT $desde, $porpagina";
            $request = $this->con->select_all($sql);
            if (count($request) > 0) {
                for ($c = 0; $c < count($request); $c++) {
                    $intidProducto = $request[$c]['idProducto'];
                    $sqlImg = "SELECT nomImagen FROM imagenes WHERE idProducto = $intidProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_imagen'] = media() . '/images/uploads/' . $arrImg[$i]['nomImagen'];
                        }
                    }else{
                        $arrImg[0]['url_imagen'] = media().'/images/uploads/product.png';
                    }
                    $request[$c]['imagenes'] = $arrImg;
                }
            }
            return $request;
        }
    }
?>