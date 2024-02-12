let tableEmpresas;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    
    // Tabla de Empresas
    tableEmpresas = $('#tableEmpresas').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Empresas/getEmpresas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idEmpresa" },
            { "data": "nitEmpresa" },
            { "data": "nomEmpresa" },
            { "data": "dirEmpresa" },
            { "data": "telEmpresa" },
            { "data": "emaEmpresa" },
            { "data": "estEmpresa" },
            { "data": "options" }
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
    if (document.querySelector('#formEmpresa')) {
        let formEmpresa = document.querySelector('#formEmpresa');
        formEmpresa.onsubmit = function (e) {
            e.preventDefault();
            let strnitEmpresa = document.querySelector('#txtnitEmpresa').value;
            let strnomEmpresa = document.querySelector('#txtnomEmpresa').value;
            let strdirEmpresa = document.querySelector('#txtdirEmpresa').value;
            let inttelEmpresa = document.querySelector('#txttelEmpresa').value;
            let stremaEmpresa = document.querySelector('#txtemaEmpresa').value;
            let intestEmpresa = document.querySelector('#listestEmpresa').value;
            if (strnitEmpresa == '' || strnomEmpresa == '' || strdirEmpresa == '' ||
                inttelEmpresa == '' || stremaEmpresa == '') {
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
            let ajaxUrl = base_url + '/Empresas/setEmpresa';
            let formData = new FormData(formEmpresa);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableEmpresas.api().ajax.reload();    
                        }else{
                            htmlStatus = intestEmpresa == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strnitEmpresa;
                            rowTable.cells[2].textContent = strnomEmpresa;
                            rowTable.cells[3].textContent = strdirEmpresa;
                            rowTable.cells[4].textContent = inttelEmpresa;
                            rowTable.cells[5].textContent = stremaEmpresa;
                            rowTable.cells[6].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormEmpresa').modal("hide");
                        formEmpresa.reset();
                        swal("Empresas", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

function fntViewInfo(idempresa) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Empresas/getEmpresa/' + idempresa;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estEmpresa = objData.data[0].estEmpresa == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celnitEmpresa").innerHTML = objData.data[0].nitEmpresa;
                document.querySelector("#celnomEmpresa").innerHTML = objData.data[0].nomEmpresa;
                document.querySelector("#celdirEmpresa").innerHTML = objData.data[0].dirEmpresa;
                document.querySelector("#celtelEmpresa").innerHTML = objData.data[0].telEmpresa;
                document.querySelector("#celemaEmpresa").innerHTML = objData.data[0].emaEmpresa;
                document.querySelector("#celestEmpresa").innerHTML = estEmpresa;
                document.querySelector("#celregEmpresa").innerHTML = objData.data[0].regEmpresa;
                $('#modalViewEmpresa').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idEmpresa) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Empresa";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Empresas/getEmpresa/' + idEmpresa;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idEmpresa").value = objData.data[0].idEmpresa;
                document.querySelector("#txtnitEmpresa").value = objData.data[0].nitEmpresa;
                document.querySelector("#txtnomEmpresa").value = objData.data[0].nomEmpresa;
                document.querySelector("#txtdirEmpresa").value = objData.data[0].dirEmpresa;
                document.querySelector("#txttelEmpresa").value = objData.data[0].telEmpresa;
                document.querySelector("#txtemaEmpresa").value = objData.data[0].emaEmpresa;
                if (objData.data[0].estEmpresa == 1) {
                    document.querySelector("#listestEmpresa").value = 1;
                } else {
                    document.querySelector("#listestEmpresa").value = 2;
                }
                $('#listestEmpresa').selectpicker('render');
            }
        }
        $('#modalFormEmpresa').modal('show');
    }
}

function fntDelInfo(idEmpresa) {
    swal({
        title: "Eliminar Empresa",
        text: "¿Realmente quiere eliminar la Empresa?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Empresas/delEmpresa/';
            let strData = "idEmpresa=" + idEmpresa;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableEmpresas.api().ajax.reload();
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
    document.querySelector('#idEmpresa').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Empresa";
    document.querySelector("#formEmpresa").reset();
    $('#modalFormEmpresa').modal('show');
}