let tableFacturacion;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableFacturacion = $('#tableFacturacion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Facturacion/getFacturas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idFactura" },
            { "data": "perFactura" },
            { "data": "desEstrato" },
            { "data": "canFactura" },
            { "data": "facFactura" },
            { "data": "recFactura" },
            { "data": "estFactura" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [ 1,2 ] },
            { 'className': "textright", "targets": [ 0 ] }
          ],   
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"

            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    });

    //Crear Registro
    if (document.querySelector('#formFacturacion')) {
        let formGrupo = document.querySelector('#formFacturacion');
        formGrupo.onsubmit = function (e) {
            e.preventDefault();
            let idFactura = document.querySelector('#idFactura').value;
            let intperFactura = document.querySelector('#intperFactura').value;
            let intrelFactura = document.querySelector('#listEstrato').value;
            let intcanFactura = document.querySelector('#intcanFactura').value;
            let intfacFactura = document.querySelector('#intfacFactura').value;
            let intrecFactura = document.querySelector('#intrecFactura').value;
            let intestFactura    = document.querySelector('#listestFactura').value;
            if (intperFactura == '' || intrelFactura == '' || intcanFactura == '' || intfacFactura == '' ||
                intrecFactura == '' || intestFactura == '') {
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
            let ajaxUrl = base_url + '/Facturacion/setFactura';
            let formData = new FormData(formFacturacion);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableFacturacion.api().ajax.reload();    
                        }else{
                            htmlStatus = intestFactura == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = intperFactura;
                            rowTable.cells[2].textContent = document.querySelector('#listEstrato').selectedOptions[0].text;
                            rowTable.cells[3].textContent = intcanFactura;
                            rowTable.cells[4].textContent = intfacFactura;
                            rowTable.cells[5].textContent = intrecFactura;
                            rowTable.cells[6].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormFacturacion').modal("hide");
                        formFacturacion.reset();
                        swal("Facturas", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    fntEstratos();
}, false);

function fntViewInfo(idfactura) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Facturacion/getFactura/' + idfactura;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estFactura = objData.data[0].estFactura == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celperFactura").innerHTML = objData.data[0].perFactura;                
                document.querySelector("#celdesEstrato").innerHTML = objData.data[0].desEstrato;
                document.querySelector("#celcanFactura").innerHTML = objData.data[0].canFactura.toLocaleString("es");
                document.querySelector("#celfacFactura").innerHTML = objData.data[0].facFactura.toLocaleString("es",{style: 'currency', minimumFractionDigits: 2,currency: 'COP'});;
                document.querySelector("#celrecFactura").innerHTML = objData.data[0].recFactura.toLocaleString("es",{style: 'currency', minimumFractionDigits: 2,currency: 'COP'});;
                document.querySelector("#celestFactura").innerHTML = estFactura;
                //document.querySelector("#celregGrupo").innerHTML = objData.data[0].regGrupo;
                $('#modalViewFacturacion').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idFactura) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Facturacion/getFactura/' + idFactura;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idFactura").value = objData.data[0].idFactura;
                document.querySelector("#intperFactura").value = objData.data[0].perFactura;                
                document.querySelector("#listEstrato").value = objData.data[0].relFactura;
                document.querySelector("#intcanFactura").value = objData.data[0].canFactura;
                document.querySelector("#intfacFactura").value = objData.data[0].facFactura;
                document.querySelector("#intrecFactura").value = objData.data[0].recFactura;
                if (objData.data[0].estFactura == 1) {
                    document.querySelector("#listestFactura").value = 1;
                } else {
                    document.querySelector("#listestFactura").value = 2;
                }
                $('#listEstrato').selectpicker('render');
            }
        }
        $('#modalFormFacturacion').modal('show');
    }
}

function fntDelInfo(idFactura) {
    swal({
        title: "Eliminar Registro",
        text: "¿Realmente quiere eliminar el Registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Facturacion/delFactura/';
            let strData = "idFactura=" + idFactura;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableGrupos.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function fntEstratos() {
    if (document.querySelector('#listEstrato')) {
        let ajaxUrl = base_url + '/Estratos/getSelectEstratos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listEstrato').innerHTML = request.responseText;
                $('#listEstrato').selectpicker('render'); 
            }
        }
    }
}
function openModal() {
    rowTable = "";
    document.querySelector('#idFactura').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro";
    document.querySelector("#formFacturacion").reset();
    $('#modalFormFacturacion').modal('show');
}