<?php
// include autoloader
    require_once 'Libraries/dompdf/autoload.inc.php';
    //require 'Libraries/html2pdf/vendor/autoload.php';
    //use Spipu\Html2Pdf\Html2Pdf;
    use Dompdf\Dompdf;

    class Factura extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('location: ' . base_url() . '/login');
                die();
            }
            getPermisos(MPEDIDOS);
        }

        public function generarFactura($idpedido)
        {
            if($_SESSION['permisosMod']['reaPermiso']){
                if (is_numeric($idpedido)){
                    $idpersona = "";
                    if($_SESSION['permisosMod']['reaPermiso'] and $_SESSION['userData']['idRol'] == RCLIENTES){
                        $idpersona = $_SESSION['userData']['idUsuario'];
                    }
                    $data = $this->model->selectPedido($idpedido, $idpersona);
    
                    if (empty($data)){
                        echo 'Datos no encontrados';
                    }else{
                        $idpedido = $data['orden']['idPedido'];
                        ob_get_clean();
                        $html = getFile("Template/Modals/comprobantePDF", $data);
    
                        $dompdf = new Dompdf();
                        $dompdf->loadHtml($html);
                        $dompdf->setPaper('Carta', 'portrait');
                        $dompdf->render();
                        header("Content-type: application/pdf");
                        header("Content-Disposition: inline; filename=documento.pdf");
                        echo $dompdf->output();
                        //$dompdf->stream('factura-' . $idpedido . '.pdf');
                    }
                }else{
                    echo 'Dato no válido';
                }
            }else{
                header('location: ' . base_url() . '/login');
                die();
            }
        }
    }
?>