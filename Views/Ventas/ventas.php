<?php
    headerAdmin($data);
    getModal('modalClientes', $data);
    //dep($data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i><?php echo $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Página Principal</a></li>
        </ul>
    </div>
    <div class="contenedorVentas">
        <div class="row">
            <div class="col-6 float-left overflow-auto p-3 bg-light">
                <div class="row">
                    <div class="col-10">
                        <select class="form-control ml-1" data-live-search="true" id="listidClientes" name="listidClientes">
                        </select>
                    </div>
                    <div class="col-2 mb-3 btnCrearVenta">
                        <button class="btn btn-primary" type="button" onclick="openModal();">Cliente <i class="fa-solid fa-circle-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group row">
                                <label for="fechaEntrega" class="col-form-label col-sm-6">Fecha de entrega:</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="fechaEntrega">
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group row">
                                <label for="fechaActual" class="col-form-label col-sm-6">Fecha de Elaboración:</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="fechaActual">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <textarea class="form-control mt-2" id="observaVentas" rows="3" placeholder="Escriba alguna observación sobre su pedido..." ></textarea>
                </div>
                <table id="tablaVentaProductos" class="table table-striped table-hover nowrap table_general">
                    <thead>
                        <tr>
                        <th scope="col"> Codigo </th>
                        <th scope="col"> Descripcion </th>
                        <th scope="col"> Cantidad </th>
                        <th scope="col"> Precio </th>
                        <th scope="col"> % Dcto </th>
                        <th scope="col"> Tasa </th>
                        <th scope="col"> Precio Total </th>
                        <th scope="col"> Accion </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot id="tfoot" style="display: none">
                        <tr>
                            <td colspan="6">
                                <span style="color: black; float: right;">SUBTOTAL</span>
                            </td>
                            <td id="subtotal" style="text-align: right">
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <span style="color: black; float: right;">IMPUESTOS</span>
                            </td>
                            <td id="impuestos" style="text-align: right">
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <span style="color: black; float: right;">TOTAL</span>
                            </td>
                            <td id="total" style="text-align: right">
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group row">
                            <select class="form-control ml-1" data-live-search="true" id="listidtipoPago" name="listidtipoPago" onchange='fntVerAutorizacion()'>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm- col-md-4">
                        <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="txtAutoriza" name="txtAutoriza">
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm- col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txtValorPago" name="txtValorPago">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-info btn-sm " title="Agregar pago"><i class="fa-sharp fa-light fa-cash-register"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botonProcesarPedido">
                    <button class="btn btn-info mb-1" id="btn_procesar_pedido" disabled style="float: right;" onclick="procesar_pedido()">
                    Procesar Pedido <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="col-6 float-right overflow-auto p-3">
                <div class="border col-lg-12">
                    <div class="tablaAgregaProductos">
                        <div class="card-heading">
                            <h2 class="title pt-2">Seleccione Productos de esta Venta</h2>
                            <hr>
                        </div>
                    </div>
                    <table id="tableProductos" class="table table-striped table-hover nowrap table_general">
                        <thead>
                            <th> Codigo </th>
                            <th> Descripcion </th>
                            <th> Existencia </th>
                            <th> Precio </th>
                            <th> Accion </th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
}
</script>

<?php footerAdmin($data); ?>