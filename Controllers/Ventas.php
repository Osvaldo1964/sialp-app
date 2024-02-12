<?php
    require_once("Models/TCliente.php");
    require_once("Models/TProducto.php");
    require_once("Models/TTipoPago.php");

    class Ventas extends Controllers
    {
        use  TProducto, TCliente, TTipoPago;
        public function __construct()
        {
            parent::__construct();
            sessionStart();
            session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('location: ' . base_url() . '/login');
                die();
            }
            getPermisos(10);
        }

        public function ventas()
        {
            $data['page_tag']   = NOMBRE_EMPRESA . ' - Ventas';
            $data['page_title'] = 'Ventas';
            $data['page_name']  = "ventas";
            $data['page_content']  = "Loremsaslaslaslasl";
            $data['productos'] = $this->getProductosT();
            $data['clientes'] = $this->getClientesT();
            $data['page_functions_js'] = "functions_ventas.js";
            $this->views->getView($this,"ventas",$data);
        }

        public function getSelectClientes(){
            $htmlOptions = "";
            $arrData = $this->getClientesT();
            if (count($arrData) > 0){
                for ($i=0; $i < count($arrData); $i++){
                    $htmlOptions .= '<option value="' . $arrData[$i]['docUsuario'] . '">' .
                                    $arrData[$i]['nomUsuario'] . '</option>';
                }
            }
            echo $htmlOptions;
            die();
        }
        
        public function getSelectTiposPago(){
            $htmlOptions = "";
            $arrData = $this->getTiposPagoT();
            if (count($arrData) > 0){
                $htmlOptions .= '<option value="Seleccionar TipoPago">Seleccionar Tipo Pago</option>';
                for ($i=0; $i < count($arrData); $i++){
                    $htmlOptions .= '<option value="' . $arrData[$i]['idTipopago'] . '">' .
                                    $arrData[$i]['desTipopago'] . '</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function selectProductos()
        {
            $arrData = $this->getProductosT();
            for ($i = 0; $i < count($arrData); $i++) {
                $btnAgregar = '';
                //dep($arrData);
                $arrData[$i]['uniVenta'] = $arrData[$i]['vtaProducto'];
                $arrData[$i]['stoProducto'] = formatMoney($arrData[$i]['stoProducto']);
                $arrData[$i]['vtaProducto'] = SMONEY . ' ' . formatMoney($arrData[$i]['vtaProducto']);
                $btnAgregar = '<button class="btn btn-info btn-sm" onClick="addProducto(this, ' . $arrData[$i]['uniVenta'] . ', ' . $arrData[$i]['idProducto'] . ')" title="Agregar"><i class="fa-solid fa-circle-plus"></i></button>';
                $arrData[$i]['options'] = '<div class="text-center">' . $btnAgregar . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>

