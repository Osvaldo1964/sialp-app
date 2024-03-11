//let tableCuadrillas;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableCuadrillas = $('#tableCuadrillas').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Cuadrillas/getCuadrillas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idCuadrilla" },
            { "data": "desCuadrilla" },
            { "data": "conCuadrilla" },
            { "data": "tecCuadrilla" },
            { "data": "ayuCuadrilla" },
            { "data": "estCuadrilla" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [0, 1, 2, 3, 4] },
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
    if (document.querySelector('#formCuadrilla')) {
        let formCuadrilla = document.querySelector('#formCuadrilla');
        formCuadrilla.onsubmit = function (e) {
            e.preventDefault();
            let strdesCuadrilla = document.querySelector('#txtdesCuadrilla').value;
            let strconCuadrilla = document.querySelector('#txtconCuadrilla').value;
            let strtecCuadrilla = document.querySelector('#txttecCuadrilla').value;
            let strayuCuadrilla = document.querySelector('#txtayuCuadrilla').value;
            let intestCuadrilla = document.querySelector('#listestCuadrilla').value;
            if (strdesCuadrilla == '' || strconCuadrilla == '' || strtecCuadrilla == "") {
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
            //divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Cuadrillas/setCuadrilla';
            let formData = new FormData(formCuadrilla);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableCuadrillas.api().ajax.reload();
                        } else {
                            htmlStatus = intestCuadrilla == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strdesCuadrilla;
                            rowTable.cells[2].textContent = strconCuadrilla;
                            rowTable.cells[3].textContent = strtecCuadrilla;
                            rowTable.cells[4].textContent = strayuCuadrilla;
                            rowTable.cells[5].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormCuadrilla').modal("hide");
                        formCuadrilla.reset();
                        swal("Cuadrillas", objData.msg, "success");
                    }
                }
                //divLoading.style.display = "none";
                return false;
            }
        }
    }
    //fntCapitulos();
}, false);

function fntViewInfo(idCuadrilla) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cuadrillas/getCuadrilla/' + idCuadrilla;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estCuadrilla = objData.data[0].estCuadrilla == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celdesCuadrilla").innerHTML = objData.data[0].desCuadrilla;
                document.querySelector("#celconCuadrilla").innerHTML = objData.data[0].conCuadrilla;
                document.querySelector("#celtecCuadrilla").innerHTML = objData.data[0].tecCuadrilla;
                document.querySelector("#celayuCuadrilla").innerHTML = objData.data[0].ayuCuadrilla;
                document.querySelector("#celestCuadrilla").innerHTML = estCuadrilla;

                $('#modalViewCuadrilla').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idCuadrilla) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Cuadrilla";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cuadrillas/getCuadrilla/' + idCuadrilla;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCuadrilla").value = objData.data[0].idCuadrilla;
                document.querySelector("#txtdesCuadrilla").value = objData.data[0].desCuadrilla;
                document.querySelector("#txtconCuadrilla").value = objData.data[0].conCuadrilla;
                document.querySelector("#txttecCuadrilla").value = objData.data[0].tecCuadrilla;
                document.querySelector("#txtayuCuadrilla").value = objData.data[0].ayuCuadrilla;
                if (objData.data[0].estCuadrilla == 1) {
                    document.querySelector("#listestCuadrilla").value = 1;
                } else {
                    document.querySelector("#listestCuadrilla").value = 2;
                }
                //$('#listestCuadrilla').selectpicker('render');
            }
        }
        $('#modalFormCuadrilla').modal('show');
    }
}

function fntDelInfo(idCuadrilla) {
    swal({
        title: "Eliminar Cuadrilla",
        text: "¿Realmente quiere eliminar la Cuadrilla?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Cuadrillas/delCuadrilla/';
            let strData = "idCuadrilla=" + idCuadrilla;
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
    document.querySelector('#idCuadrilla').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Cuadrilla";
    document.querySelector("#formCuadrilla").reset();
    $('#modalFormCuadrilla').modal('show');
}