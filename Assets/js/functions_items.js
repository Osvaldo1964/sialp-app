let tableItems;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableItems = $('#tableItems').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Items/getItems",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idItem" },
            { "data": "desGruposalp" },
            { "data": "desItem" },
            { "data": "csmItem" },
            { "data": "estItem" },
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

    //Crear Items
    if (document.querySelector('#formItems')) {
        let formItems = document.querySelector('#formItems');
        formItems.onsubmit = function (e) {
            e.preventDefault();
            let intgruItem = document.querySelector('#listGrupos').value;
            let strdesItem = document.querySelector('#txtdesItem').value;
            let intcsmItem = document.querySelector('#intcsmItem').value;
            let intestItem = document.querySelector('#listestItem').value;
            if (intgruItem == '' || strdesItem == '') {
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
            let ajaxUrl = base_url + '/Items/setItem';
            let formData = new FormData(formItems);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableItems.api().ajax.reload();    
                        }else{
                            htmlStatus = intestItem == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = document.querySelector("#listGrupos").selectedOptions[0].text;
                            rowTable.cells[2].textContent = strdesItem;
                            rowTable.cells[3].textContent = intcsmItem;
                            rowTable.cells[4].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormItems').modal("hide");
                        formItems.reset();
                        swal("Items", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    fntGrupossalp();
}, false);

function fntViewInfo(iditem) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Items/getItem/' + iditem;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estItem = objData.data[0].estItem == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celnomGrupo").innerHTML = objData.data[0].desGruposalp;
                document.querySelector("#celdesItem").innerHTML = objData.data[0].desItem;
                document.querySelector("#celcsmItem").innerHTML = objData.data[0].csmItem;
                document.querySelector("#celestItem").innerHTML = estItem;
                $('#modalViewItems').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idItem) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Items";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Items/getItem/' + idItem;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idItem").value = objData.data[0].idItem;
                document.querySelector("#listGrupos").value = objData.data[0].gruItem;
                document.querySelector("#txtdesItem").value = objData.data[0].desItem;
                document.querySelector("#intcsmItem").value = objData.data[0].csmItem;
                if (objData.data[0].estItem == 1) {
                    document.querySelector("#listestItem").value = 1;
                } else {
                    document.querySelector("#listestItem").value = 2;
                }
                $('#listestItem').selectpicker('render');
            }
        }
        $('#modalFormItems').modal('show');
    }
}

function fntDelInfo(idItem) {
    swal({
        title: "Eliminar Item",
        text: "¿Realmente quiere eliminar el Item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Items/delItem/';
            let strData = "idItem = " + idItem;
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

function fntGrupossalp() {
    if (document.querySelector('#listGrupos')) {
        let ajaxUrl = base_url + '/Grupossalp/getSelectGruposalp';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listGrupos').innerHTML = request.responseText;
                $('#listGrupos').selectpicker('render'); 
            }
        }
    }
}
function openModal() {
    rowTable = "";
    document.querySelector('#idItem').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Item";
    document.querySelector("#formItems").reset();
    $('#modalFormItems').modal('show');
}