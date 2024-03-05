let tableComerciales;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableComerciales = $('#tableComerciales').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Comerciales/getComerciales",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idComercial" },
            { "data": "nomComercial" },
            { "data": "cntComercial" },
            { "data": "valComercial" },
            { "data": "estComercial" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [0, 1, 2, 3] },
            { 'className': "textright", "targets": [3] }
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

    //Crear Empresa
    if (document.querySelector('#formComerciales')) {
        let formComerciales = document.querySelector('#formComerciales');
        formComerciales.onsubmit = function (e) {
            e.preventDefault();
            let strnomComercial = document.querySelector('#txtnomComercial').value;
            let strcntComercial = document.querySelector('#txtcntComercial').value;
            let fltvalComercial = document.querySelector('#fltvalComercial').value;
            let intestComercial = document.querySelector('#listestComercial').value;
            if (strnomComercial == '' || strcntComercial == '' || fltvalComercial == "") {
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
            let ajaxUrl = base_url + '/Comerciales/setComercial';
            let formData = new FormData(formComerciales);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableComerciales.api().ajax.reload();
                        } else {
                            htmlStatus = intestComercial == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strnomComercial;
                            rowTable.cells[2].textContent = strcntComercial;
                            rowTable.cells[3].textContent = fltvalComercial;
                            rowTable.cells[4].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormComerciales').modal("hide");
                        formComerciales.reset();
                        swal("Comerciales", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    //fntCapitulos();
}, false);

function fntViewInfo(idComercial) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Comerciales/getComercial/' + idComercial;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estComercial = objData.data[0].estComercial == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celnomComercial").innerHTML = objData.data[0].nomComercial;
                document.querySelector("#celcntComercial").innerHTML = objData.data[0].cntComercial;
                document.querySelector("#celvalComercial").innerHTML = objData.data[0].valComercial;
                document.querySelector("#celestComercial").innerHTML = estComercial;

                $('#modalViewComerciales').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idComercial) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Comerciales";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Comerciales/getComercial/' + idComercial;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idComercial").value = objData.data[0].idComercial;
                document.querySelector("#txtnomComercial").value = objData.data[0].nomComercial;
                document.querySelector("#txtcntComercial").value = objData.data[0].cntComercial;
                document.querySelector("#fltvalComercial").value = objData.data[0].valComercial;
                if (objData.data[0].estComercial == 1) {
                    document.querySelector("#listestComercial").value = 1;
                } else {
                    document.querySelector("#listestComercial").value = 2;
                }
                $('#listestComercial').selectpicker('render');
            }
        }
        $('#modalFormComerciales').modal('show');
    }
}

function fntDelInfo(idComercial) {
    swal({
        title: "Eliminar Comerciales",
        text: "¿Realmente quiere eliminar la Entidad?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Comerciales/delComercial/';
            let strData = "idComercial=" + idComercial;
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

function openModal() {
    rowTable = "";
    document.querySelector('#idComercial').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Entidad";
    document.querySelector("#formComerciales").reset();
    $('#modalFormComerciales').modal('show');
}