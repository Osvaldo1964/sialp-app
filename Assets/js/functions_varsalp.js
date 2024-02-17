let tableVarsalp;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableVarsalp = $('#tableVarsalp').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Varsalp/getVarsalps",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idVarsalp" },
            { "data": "codVarsalp" },
            { "data": "desVarsalp" },
            { "data": "estVarsalp" },
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

    //Crear Empresa
    if (document.querySelector('#formVarsalp')) {
        let formVarsalp = document.querySelector('#formVarsalp');
        formGrupo.onsubmit = function (e) {
            e.preventDefault();
            let intcodVarsalp = document.querySelector('#txtcodVarsalp').value;
            let strdesVarsalp = document.querySelector('#txtdesVarsalp').value;
            let intestVarsalp = document.querySelector('#listestVarsalp').value;
            if (intcapGrupo == '' || strdesGrupo == '') {
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
            let ajaxUrl = base_url + '/Varsalp/setVarsalp';
            let formData = new FormData(formVarsalp);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableGVarsalp.api().ajax.reload();    
                        }else{
                            htmlStatus = intestVarsalp == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = intcodVarsalp;
                            rowTable.cells[2].textContent = strdesVarsalp;
                            rowTable.cells[3].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormVarsalp').modal("hide");
                        formVarsalp.reset();
                        swal("Variables", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    //fntCapitulos();
}, false);

function fntViewInfo(idvarsalp) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Varsalp/getVarsalp/' + idvarsalp;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estVarsalp = objData.data[0].estVarsalp == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celcodVarsalp").innerHTML = objData.data[0].codVarsalp;
                document.querySelector("#celdesVarsalp").innerHTML = objData.data[0].desVarsalp;
                document.querySelector("#celestVarsalp").innerHTML = estVarsalp;
                //document.querySelector("#celregGrupo").innerHTML = objData.data[0].regGrupo;
                $('#modalViewVarsalp').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idGrupo) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Grupo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Grupos/getGrupo/' + idGrupo;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idGrupo").value = objData.data[0].idGrupo;
                document.querySelector("#txtnomCapitulo").value = objData.data[0].nomCapitulo;
                document.querySelector("#txtdesGrupo").value = objData.data[0].desGrupo;
                if (objData.data[0].estGrupo == 1) {
                    document.querySelector("#listestGrupo").value = 1;
                } else {
                    document.querySelector("#listestGrupo").value = 2;
                }
                $('#listestGrupo').selectpicker('render');
            }
        }
        $('#modalFormGrupo').modal('show');
    }
}

function fntDelInfo(idGrupo) {
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
            let ajaxUrl = base_url + '/Grupos/delGrupo/';
            let strData = "idGrupo=" + idGrupo;
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

function fntCapitulos() {
    if (document.querySelector('#listCapitulo')) {
        let ajaxUrl = base_url + '/Capitulos/getSelectCapitulos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCapitulo').innerHTML = request.responseText;
                $('#listCapitulo').selectpicker('render'); 
            }
        }
    }
}
function openModal() {
    rowTable = "";
    document.querySelector('#idGrupo').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Grupo";
    document.querySelector("#formGrupo").reset();
    $('#modalFormGrupo').modal('show');
}