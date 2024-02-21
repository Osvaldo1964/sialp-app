let tableGrupossalp;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableGrupossalp = $('#tableGrupossalp').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Grupossalp/getGrupossalp",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idGruposalp" },
            { "data": "codGruposalp" },
            { "data": "desGruposalp" },
            { "data": "vidGruposalp" },
            { "data": "tipGruposalp" },
            { "data": "estGruposalp" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [0, 1, 2] },
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
    if (document.querySelector('#formGruposalp')) {
        let formGruposalp = document.querySelector('#formGruposalp');
        formGruposalp.onsubmit = function (e) {
            e.preventDefault();
            let strcodGruposalp = document.querySelector('#txtcodGruposalp').value;
            let strdesGruposalp = document.querySelector('#txtdesGruposalp').value;
            let fltvidGruposalp = document.querySelector('#fltvidGruposalp').value;
            let inttipGruposalp = document.querySelector('#listtipGruposalp').value;
            let intestGruposalp = document.querySelector('#listestGruposalp').value;
            if (strcodGruposalp == '' || strdesGruposalp == '' || fltvidGruposalp == 0.00) {
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
            let ajaxUrl = base_url + '/Grupossalp/setGruposalp';
            let formData = new FormData(formGruposalp);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableGrupossalp.api().ajax.reload();
                        } else {
                            htmlStatus = intestGruposalp == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            htmlTipo = inttipGruposalp == 1 ?
                                '<span class="badge badge-success">Eléctrico</span>' :
                                '<span class="badge badge-danger">No Eléctrico</span>';
                            rowTable.cells[1].textContent = strcodGruposalp;
                            rowTable.cells[2].textContent = strdesGruposalp;
                            rowTable.cells[3].textContent = strdesGruposalp;
                            rowTable.cells[4].innerHTML = htmlTipo;
                            rowTable.cells[5].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormGruposalp').modal("hide");
                        formGruposalp.reset();
                        swal("Grupos SALP", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    //fntCapitulos();
}, false);

function fntViewInfo(idgruposalp) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Grupossalp/getGruposalp/' + idgruposalp;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estGruposalp = objData.data[0].estGruposalp == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                let tipGruposalp = objData.data[0].tipGruposalp == 1 ?
                    '<span class="badge badge-success">Eléctrico</span>' :
                    '<span class="badge badge-danger">No Eléctrico</span>';
                document.querySelector("#celcodGruposalp").innerHTML = objData.data[0].codGruposalp;
                document.querySelector("#celdesGruposalp").innerHTML = objData.data[0].desGruposalp;
                document.querySelector("#celvidGruposalp").innerHTML = objData.data[0].vidGruposalp;
                document.querySelector("#celestGruposalp").innerHTML = tipGruposalp;
                document.querySelector("#celestGruposalp").innerHTML = estGruposalp;

                $('#modalViewGruposalp').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idGruposalp) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Grupo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Grupossalp/getGruposalp/' + idGruposalp;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idGruposalp").value = objData.data[0].idGruposalp;
                document.querySelector("#txtcodGruposalp").value = objData.data[0].codGruposalp;
                document.querySelector("#txtdesGruposalp").value = objData.data[0].desGruposalp;
                document.querySelector("#fltvidGruposalp").value = objData.data[0].vidGruposalp;
                if (objData.data[0].estGruposalp == 1) {
                    document.querySelector("#listestGruposalp").value = 1;
                } else {
                    document.querySelector("#listestGruposalp").value = 2;
                }
                if (objData.data[0].tipGruposalp == 1) {
                    document.querySelector("#listtipGruposalp").value = 1;
                } else {
                    document.querySelector("#listtipGruposalp").value = 2;
                }
                $('#listestGruposalp').selectpicker('render');
                $('#listtipGruposalp').selectpicker('render');
            }
        }
        $('#modalFormGruposalp').modal('show');
    }
}

function fntDelInfo(idGruposalp) {
    swal({
        title: "Eliminar Grupo",
        text: "¿Realmente quiere eliminar el Grupo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Grupossalp/delGruposalp/';
            let strData = "idGruposalp=" + idGruposalp;
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
    document.querySelector('#idGruposalp').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Grupo";
    document.querySelector("#formGruposalp").reset();
    $('#modalFormGruposalp').modal('show');
}