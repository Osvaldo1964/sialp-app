<?php
class Censo extends Controllers
{
    public function __construct()
    {
        sessionStart();
        parent::__construct();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . '/login');
        }
        getPermisos(MCOMPONENTES);
    }

    public function censo()
    {
        if (empty($_SESSION['permisosMod']['reaPermiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag']   = "Censo";
        $data['page_title'] = "CENSO UCAPs <small> SALP - APP</small>";
        $data['page_name']  = "censo";
        //$data['page_functions_js'] = "functions_censo.js";
        $data['arrPedido'] = $this->model->selectCenso();
        $this->views->getView($this, "censo", $data);
    }

}
