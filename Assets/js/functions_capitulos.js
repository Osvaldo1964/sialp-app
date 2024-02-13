let tableCapìtulos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Capítulos
    tableCapitulos = $('#tableCapitulos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Capitulos/getCapitulos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idCapitulo" },
            { "data": "nomCapitulo" },
            { "data": "tipCapitulo" },
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

    //NUEVO CAPITULO
    if (document.querySelector('#formCapitulo')) {
        let formCapitulo = document.querySelector('#formCapitulo');
        formCapitulo.onsubmit = function (e) {
            e.preventDefault();
            let strnomCapitulo = document.querySelector('#txtnomCapitulo').value;
            let inttipCapitulo = document.querySelector('#listtipCapitulo').value;
            if (strnomCapitulo == '' || inttipCapitulo == '') {
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
            let ajaxUrl = base_url + '/Capitulos/setCapitulo';
            let formData = new FormData(formCapitulo);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableCapitulos.api().ajax.reload();
                        } else {
                            htmlTipo = inttipCapitulo == 1 ?
                                '<span class="badge badge-success">Ingreso</span>' :
                                '<span class="badge badge-danger">Gasto</span>';
                            rowTable.cells[1].textContent = strnomCapitulo;
                            rowTable.cells[3].innerHTML = htmlTipo;
                            rowTable = "";
                        }
                        $('#modalFormCapitulo').modal("hide");
                        formCapitulo.reset();
                        swal("Capitulos", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);
function fntViewInfo(idecapitulo) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Capitulos/getCapitulo/' + idecapitulo;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            if (objData.status) {
                let tipCapitulo = objData.data[0].tipCapitulo == 1 ?
                    '<span class="badge badge-success">Ingreso</span>' :
                    '<span class="badge badge-danger">Gasto</span>';
                document.querySelector("#celnomCapitulo").innerHTML = objData.data[0].nomCapitulo;
                document.querySelector("#celtipCapitulo").innerHTML = tipCapitulo;
                $('#modalViewCapitulo').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idCapitulo) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Capitulo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Capitulos/getCapitulo/' + idCapitulo;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCapitulo").value = objData.data[0].idCapitulo;
                document.querySelector("#txtnomCapitulo").value = objData.data[0].nomCapitulo;
                if (objData.data[0].tipCapitulo == 1) {
                    document.querySelector("#listtipCapitulo").value = 1;
                } else {
                    document.querySelector("#listtipCapitulo").value = 2;
                }
                $('#listtipCapitulo').selectpicker('render');
            }
        }
        $('#modalFormCapitulo').modal('show');
    }
}

function fntDelInfo(idCapitulo) {
    swal({
        title: "Eliminar Capitulo",
        text: "¿Realmente quiere eliminar el Capitulo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Capitulos/delCapitulo/';
            let strData = "idCapitulo=" + idCapitulo;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableCapitulos.api().ajax.reload();
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
    document.querySelector('#idCapitulo').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Capitulo";
    document.querySelector("#formCapitulo").reset();
    $('#modalFormCapitulo').modal('show');
}