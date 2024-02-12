<?php
    require_once("Libraries/Core/Mysql.php");
    trait TVentas
    {
        private $idCliente;
        private $docCliente;
        private $nomCliente;


        public function getClientesT()
        {
            $sql = "SELECT idUsuario, tdoUsuario, docUsuario, nomUsuario, apeUsuario, dirUsuario, telUsuario, emaUsuario,
                    tipUsuario, razUsuario, actUsuario, repUsuario, efaUsuario
                    FROM usuarios WHERE rolUsuario = 5 and estUsuario != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function getProductosT()
        {
            $this->con = new Mysql();
            $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                        p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, 
                        p.rutProducto, p.stoProducto
                        FROM productos p
                        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                        WHERE estProducto != 0";
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
            dep($request);
            return $request;
        }

        public function getProductosCategoriaT(int $idCategoria, string $ruta){
            $this->intidCategoria = $idCategoria;
            $this->strrutCategoria = $ruta;
            $this->con = new Mysql();
            $sql_cat = "SELECT idCategoria, nomCategoria FROM categorias WHERE idCategoria = '{$this->intidCategoria}'";
            $request = $this->con->select($sql_cat);
            if (!empty($request)) {
                $this->strnomCategoria = $request['nomCategoria'];
                $sql = "SELECT p.idProducto, p.idCategoria, p.codProducto, p.nomProducto,
                    p.desProducto, c.nomCategoria as nomCategoria, p.vtaProducto, p.rutProducto,
                    p.stoProducto
                    FROM productos p
                    INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                    WHERE estProducto != 0 AND p.idCategoria = $this->intidCategoria AND c.rutCategoria = '{$this->strrutCategoria}'";
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

    }
?>