let tableCstenergia;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Capítulos
    tableCstenergia = $('#tableCstenergia').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Cstenergia/getCostos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idCosto" },
            { "data": "perCosto" },
            { "data": "csmCosto" },
            { "data": "vlrCosto" },
            { "data": "totCosto" },
            { "data": "estCosto" },
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
    if (document.querySelector('#formCstenergia')) {
        let formCapitulo = document.querySelector('#formCstenergia');
        formCapitulo.onsubmit = function (e) {
            e.preventDefault();
            let intperCosto = document.querySelector('#intperCosto').value;
            let intcsmCosto = document.querySelector('#intcsmCosto').value;
            let intvlrCosto = document.querySelector('#intvlrCosto').value;
            let inttotCosto = document.querySelector('#inttotCosto').value;
            let intestCosto = document.querySelector('#listestCosto').value;
            if (intperCosto == '' || intcsmCosto == '' || intvlrCosto == '' || inttotCosto == '') {
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
            let ajaxUrl = base_url + '/Cstenergia/setCostos';
            let formData = new FormData(formCapitulo);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableCstenergia.api().ajax.reload();
                        } else {
                            htmlStatus = intestCosto == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = intperCosto;
                            rowTable.cells[2].textContent = intcsmCosto;
                            rowTable.cells[3].textContent = intvlrCosto;
                            rowTable.cells[4].textContent = inttotCosto;
                            rowTable.cells[5].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormCstenergia').modal("hide");
                        formCapitulo.reset();
                        swal("Costos Energía", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);
function fntViewInfo(idcosto) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cstenergia/getCosto/' + idcosto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            if (objData.status) {
                let estCosto = objData.data[0].estCosto == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celperCosto").innerHTML = objData.data[0].perCosto;
                document.querySelector("#celcsmCosto").innerHTML = objData.data[0].csmCosto;
                document.querySelector("#celvlrCosto").innerHTML = objData.data[0].vlrCosto;
                document.querySelector("#celtotCosto").innerHTML = objData.data[0].totCosto;
                document.querySelector("#celestCosto").innerHTML = estCosto;
                $('#modalViewCstenergia').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idCosto) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cstenergia/getCosto/' + idCosto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCosto").value = objData.data[0].idCosto;
                document.querySelector("#intperCosto").value = objData.data[0].perCosto;
                document.querySelector("#intcsmCosto").value = objData.data[0].csmCosto;
                document.querySelector("#intvlrCosto").value = objData.data[0].vlrCosto;
                document.querySelector("#inttotCosto").value = objData.data[0].totCosto;
                if (objData.data[0].estCosto == 1) {
                    document.querySelector("#listestCosto").value = 1;
                } else {
                    document.querySelector("#listestCosto").value = 2;
                }
                $('#listestCosto').selectpicker('render');
            }
        }
        $('#modalFormCstenergia').modal('show');
    }
}

function fntDelInfo(idCapitulo) {
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
            let ajaxUrl = base_url + '/Cstenergia/delCosto/';
            let strData = "idCosto=" + idCosto;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableCstenergia.api().ajax.reload();
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
    document.querySelector('#idCosto').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro";
    document.querySelector("#formCstenergia").reset();
    $('#modalFormCstenergia').modal('show');
}