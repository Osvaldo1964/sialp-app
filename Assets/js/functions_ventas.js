$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

let productos_seleccionados = new Array();
let filas = "";

window.addEventListener('load', function () {
    tableProductos = $('#tableProductos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Ventas/selectProductos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "codProducto" },
            { "data": "nomProducto" },
            { "data": "stoProducto" },
            { "data": "vtaProducto" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textright", "targets": [2] },
            { 'className': "textright", "targets": [3] },
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    });

    fntClientes();
    fntTipoPagos();
})

document.addEventListener('DOMContentLoaded', function () {
    //Crear Cliente
    if (document.querySelector('#formCliente')) {
        let formCliente = document.querySelector('#formCliente');
        formCliente.onsubmit = function (e) {
            e.preventDefault();
            let strtdoCliente = document.querySelector('#listdoCliente').value;
            let strdocCliente = document.querySelector('#txtdocCliente').value;
            let strnomCliente = document.querySelector('#txtnomCliente').value;
            let strapeCliente = document.querySelector('#txtapeCliente').value;
            let strdirCliente = document.querySelector('#txtdirCliente').value;
            let inttelCliente = document.querySelector('#txttelCliente').value;
            let stremaCliente = document.querySelector('#txtemaCliente').value;
            let inttipCliente = document.querySelector('#listipCliente').value;
            let strrazCliente = document.querySelector('#txtrazCliente').value;
            let stractCliente = document.querySelector('#txtactCliente').value;
            let strrepCliente = document.querySelector('#txtrepCliente').value;
            let strefaCliente = document.querySelector('#txtefaCliente').value;
            //let strpasCliente = document.querySelector('#txtpasCliente').value;

            if (strtdoCliente == '' || strdocCliente == '' || strnomCliente == '' || strdirCliente == '' ||
                inttelCliente == '' || stremaCliente == '' || inttipCliente == '' || strrazCliente == '' ||
                stractCliente == '' || strrepCliente == '' || strefaCliente == '')
            {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Clientes/setCliente';
            let formData = new FormData(formCliente);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        let tipoCliente = "";
                        if (rowTable == "") {
                            tableClientes.api().ajax.reload();
                        } else {
                            if (strtdoCliente == 1){
                                tipoCliente = 'C.C.';
                            }else if (strtdoCliente == 2){
                                tipoCliente = 'C.E.';
                            }else{
                                tipoCliente = 'PPT';
                            }
                            rowTable.cells[1].textContent = tipoCliente;
                            rowTable.cells[2].textContent = strdocCliente;
                            rowTable.cells[3].textContent = strnomCliente;
                            rowTable.cells[4].textContent = strapeCliente;
                            rowTable.cells[5].textContent = strdirCliente;
                            rowTable.cells[6].textContent = inttelCliente;
                            rowTable.cells[7].textContent = stremaCliente;
                            rowTable = "";
                        }
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                        swal("Clientes", objData.msg, "success");
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

function fntClientes() {
    if (document.querySelector('#listidClientes')) {
        let ajaxUrl = base_url + '/Clientes/getSelectClientes';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listidClientes').innerHTML = request.responseText;
                $('#listidClientes').selectpicker('render');
            }
        }
    }
}

function fntTipoPagos() {
    if (document.querySelector('#listidtipoPago')) {
        let ajaxUrl = base_url + '/Ventas/getSelectTiposPago';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listidtipoPago').innerHTML = request.responseText;
                $('#listidtipoPago').selectpicker('render');
            }
        }
    }
}

function addProducto(element, vtaProducto, idProducto) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    console.log(rowTable.cells[0].textContent);
    let codigo = rowTable.cells[0].textContent;
    let descripcion = rowTable.cells[1].textContent;
    let cantidad = 1;
    let precio = vtaProducto;
    let tasa = 0;
    let vlr_descuento = 0;

    let subtotal = cantidad * precio;
    //vlr_descuento = cantidad * (precio * descuento / 100);

    var aux = {};
    aux['codigo'] = codigo;
    aux['descripcion'] = descripcion;
    aux['cantidad'] = 1;
    aux['precio'] = precio;
    aux['descuento'] = 0.00;
    aux['vlr_descuento'] = 0.00;
    aux['subtotal'] = subtotal;
    aux['tasa'] = tasa;

    productos_seleccionados.push(aux);

    $('.dataTables_empty').parent('tr').html('');
    $('#tablaVentaProductos tbody').append(`<tr>
							<td width="110px">${codigo}</td>
							<td width="260px">${descripcion}</td>
							<td width="80px"><input style="width:80px;" type="number" onblur='editar_cantidad("${idProducto}", ${cantidad}, this)' value="${cantidad}" /></td>
							<td id="precio" width="80px"><input style="width:100px;" type="number" onblur='cambiar_precio("${idProducto}", this)' value="${precio}" /></td>
							<td width="80px"><input style="width:80px;"type="number" onblur='descuento("${idProducto}", this)' value="${vlr_descuento}" /></td>
							<td>${tasa}</td>
							<td width="80px" style="text-align: right">${subtotal}</td>
							<td width="80px">
								<button class="btn btn_ventas btn-danger btn_borrar" onclick="borrar(this)">
									<i class="fa fa-trash"></i>
								</button>
							</td>
							</tr>`);
    calcular_total();
}

function calcular_total() {
    var subtotal = 0.00;
    var impuestos = 0.00;

    for (var i = productos_seleccionados.length - 1; i >= 0; i--) {
        productos_seleccionados[i]['vlr_descuento'] = productos_seleccionados[i]['precio'] * productos_seleccionados[i]['descuento'] / 100;
        productos_seleccionados[i]['subtotal'] = (productos_seleccionados[i]['precio'] - productos_seleccionados[i]['vlr_descuento']) * productos_seleccionados[i]['cantidad']
        subtotal += (productos_seleccionados[i]['precio'] - productos_seleccionados[i]['vlr_descuento']) * productos_seleccionados[i]['cantidad']
        impuestos += productos_seleccionados[i]['subtotal'] * (productos_seleccionados[i]['tasa'] / 100);
    }

    total = subtotal + impuestos;
    subtotal = subtotal;
    impuestos = impuestos;
    $('#subtotal').text(subtotal);
    $('#impuestos').text(impuestos);
    $('#total').text(total);

    if (productos_seleccionados.length > 0) {
        $('#tfoot').slideDown();
    } else {
        $('#tfoot').hide();
    }
}


function cambiar_precio(codigo, precio, input) {
    var nuevo_precio = $(input).val();
    precio_anterior = precio;
    for (var i = productos_seleccionados.length - 1; i >= 0; i--) {
        if (codigo == productos_seleccionados[i]['codigo']) {
            productos_seleccionados[i]['precio'] = nuevo_precio;
            //$(input).closest('tr').children('td:eq(4)').val() = $(input).val();
            calcular_total();
            $(input).closest('tr').children('td:eq(6)').text((productos_seleccionados[i]['subtotal']));
        }
    }
}

function descuento(codigo, input) {
    for (var i = productos_seleccionados.length - 1; i >= 0; i--) {
        if (codigo == productos_seleccionados[i]['codigo']) {
            productos_seleccionados[i]['descuento'] = $(input).val();
            //$(input).closest('tr').children('td:eq(5)').text((productos_seleccionados[i]['subtotal']));
            calcular_total();
            $(input).closest('tr').children('td:eq(6)').text((productos_seleccionados[i]['subtotal']));
        }
    }
}

function borrar(boton) {
    var codigo = $(boton).closest('tr').children('td:eq(0)').text();
    $(boton).closest('tr').html('');
    for (var i = productos_seleccionados.length - 1; i >= 0; i--) {
        if (productos_seleccionados[i]['codigo'] == codigo) {
            productos_seleccionados.splice(i, 1);
        }
    }
    calcular_total();
}

function editar_cantidad(codigo, cantidad, input) {
    var nueva_cantidad = $(input).val();
    cantidad_anterior = cantidad;
    //console.log(codigo);
    //console.log(nueva_cantidad);
    //console.log(cantidad_anterior);
    for (var i = productos_seleccionados.length - 1; i >= 0; i--) {
        if (codigo == productos_seleccionados[i]['codigo']) {
            //if (nueva_cantidad <= productos_seleccionados[i]['existencia']) {
                productos_seleccionados[i]['cantidad'] = nueva_cantidad;
            //} else {
            //    productos_seleccionados[i]['cantidad'] = cantidad_anterior;
            //    $(input).val(cantidad_anterior);
            //}
            calcular_total();
            $(input).closest('tr').children('td:eq(6)').text((productos_seleccionados[i]['subtotal']));
        }
    }
}

/* function modalProductos() {
    rowTable = "";
     document.querySelector('#idCategoria').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoría";
    document.querySelector("#formCategoria").reset();
    $('#openModalProductos').modal('show');
    removePhoto();
}
 */

function fntVerAutorizacion(idtipoPago){
    document.getElementById('listidtipoPago').onchange = function() {
        alert(this.value);
    }
    //alert(idtipoPago);

/*     let direccion = document.querySelector("#txtDireccion").value;
    if (direccion == "" || ciudad == ""){
        document.querySelector('#divMetodoPago').classList.add("notblock");
    }else{
        document.querySelector('#divMetodoPago').classList.remove("notblock");
    } */
}

function openModal() {
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    //document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
}