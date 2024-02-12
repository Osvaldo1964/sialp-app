let tableClientes;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {

    // Tabla de Clientes
    tableClientes = $('#tableClientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Clientes/getClientes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "tdoUsuario" },
            { "data": "docUsuario" },
            { "data": "nomUsuario" },
            { "data": "apeUsuario" },
            { "data": "dirUsuario" },
            { "data": "telUsuario" },
            { "data": "emaUsuario" },
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
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

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
            let strpasCliente = document.querySelector('#txtpasCliente').value;

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

function fntViewInfo(idpersona) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Clientes/getCliente/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                validaTipoCliente(objData.data[0].tipUsuario);
                validaDocumento(objData.data[0].tdoUsuario);
                document.querySelector("#celtdoCliente").innerHTML = docuUsuario; //objData.data[0].tdoUsuario;    
                document.querySelector("#celdocCliente").innerHTML = objData.data[0].docUsuario;
                document.querySelector("#celnomCliente").innerHTML = objData.data[0].nomUsuario;
                document.querySelector("#celapeCliente").innerHTML = objData.data[0].apeUsuario;
                document.querySelector("#celdirCliente").innerHTML = objData.data[0].dirUsuario;
                document.querySelector("#celtelCliente").innerHTML = objData.data[0].telUsuario;
                document.querySelector("#celemaCliente").innerHTML = objData.data[0].emaUsuario;
                document.querySelector("#celregCliente").innerHTML = objData.data[0].regUsuario;
                document.querySelector("#celtipCliente").innerHTML = tipoUsuario;
                document.querySelector("#celrazCliente").innerHTML = objData.data[0].razUsuario;
                document.querySelector("#celactCliente").innerHTML = objData.data[0].actUsuario;
                document.querySelector("#celrepCliente").innerHTML = objData.data[0].repUsuario;
                document.querySelector("#celefaCliente").innerHTML = objData.data[0].efaUsuario;
                $('#modalViewCliente').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idUsuario) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Clientes/getCliente/' + idUsuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                validaTipoCliente(objData.data[0].tipUsuario);
                validaDocumento(objData.data[0].tdoUsuario);
                document.querySelector("#idCliente").value = objData.data[0].idUsuario;
                document.querySelector("#listdoCliente").value = objData.data[0].tdoUsuario;
                document.querySelector("#txtdocCliente").value = objData.data[0].docUsuario;
                document.querySelector("#txtnomCliente").value = objData.data[0].nomUsuario;
                document.querySelector("#txtapeCliente").value = objData.data[0].apeUsuario;
                document.querySelector("#txtdirCliente").value = objData.data[0].dirUsuario;
                document.querySelector("#txttelCliente").value = objData.data[0].telUsuario;
                document.querySelector("#txtemaCliente").value = objData.data[0].emaUsuario;
                document.querySelector("#listipCliente").value = objData.data[0].tipUsuario;
                document.querySelector("#txtrazCliente").value = objData.data[0].razUsuario;
                document.querySelector("#txtactCliente").value = objData.data[0].actUsuario;
                document.querySelector("#txtrepCliente").value = objData.data[0].repUsuario;
                document.querySelector("#txtefaCliente").value = objData.data[0].efaUsuario;
                $('#listdoCliente').selectpicker('render');
                $('#listipCliente').selectpicker('render');
            }
        }
        $('#modalFormCliente').modal('show');
    }
}

function fntDelInfo(idCliente) {
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar el Cliente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Clientes/delCliente/';
            let strData = "idCliente=" + idCliente;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableClientes.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function validaDocumento(tdoUsuario) {
    if (tdoUsuario == 1) {
        docuUsuario = 'C.C.';
    } else if (tdoUsuario == 2) {
        docuUsuario = 'C.E.';
    } else {
        docuUsuario = 'PPT';
    }

    return docuUsuario;
}

function validaTipoCliente(tipUsuario) {
    if (tipUsuario == 1) {
        tipoUsuario = 'Corporativo';
    } else if (tipUsuario == 2) {
        tipoUsuario = 'Particular';
    } else {
        tipoUsuario = 'Especial';
    }

    return tipoUsuario;
}

function openModal() {
    rowTable = "";
    document.querySelector('#idCliente').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
}