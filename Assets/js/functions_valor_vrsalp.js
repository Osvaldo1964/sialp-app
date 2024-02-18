let tableValorvrsalp;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableValorvrsalp = $('#tableValorvrsalp').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Valorvrsalp/getValores",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idValorvar" },
            { "data": "desVarsalp" },
            { "data": "iniValorvar" },
            { "data": "finValorvar" },
            { "data": "tipValorvar" },
            { "data": "valValorvar" },
            { "data": "estValorvar" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [ 0,1,2 ] },
            { 'className': "textright", "targets": [ 3 ] }
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

    //Crear Valor
    if (document.querySelector('#formValorvar')) {
        let formValorvar = document.querySelector('#formValorvar');
        formValorvar.onsubmit = function (e) {
            e.preventDefault();
            //let intvarValorvar = document.querySelector('#tlistVariable').value;
            //let strdesValorvar = document.querySelector('#txtdesValorvar').value;
            let striniValorvar = document.querySelector("#txtiniValorvar").value;
            let strfinValorvar = document.querySelector("#txtfinValorvar").value;
            let strtipValorvar = document.querySelector("#txttipValorvar").value;
            let fltvalValorvar = document.querySelector("#fltvalValorvar").value;
            let intestValorvar = document.querySelector('#listestValorvar').value;
            if (striniValorvar == '' || strfinValorvar == '' || strtipValorvar == "") {
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
            let ajaxUrl = base_url + '/Valorvrsalp/setValorvar';
            let formData = new FormData(formValorvar);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    console.log(objData);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableValorvrsalp.api().ajax.reload();    
                        }else{
                            htmlStatus = intestValorvar == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = document.querySelector("#listVariable").selectedOptions[0].text;;
                            rowTable.cells[2].textContent = striniValorvar;
                            rowTable.cells[3].textContent = strfinValorvar;
                            rowTable.cells[4].textContent = strtipValorvar;
                            rowTable.cells[5].textContent = fltvalValorvar;
                            rowTable.cells[6].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormValorvar').modal("hide");
                        formValorvar.reset();
                        swal("Registro Movimiento", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    fntVariables();
}, false);

function fntViewInfo(idvalorvar) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Valorvrsalp/getValorvar/' + idvalorvar;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estado = objData.data[0].estValorvar == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celvarValorvar").innerHTML = objData.data[0].varValorvar;
                document.querySelector("#celdesVarsalp").innerHTML = objData.data[0].desVarsalp;
                document.querySelector("#celiniValorvar").innerHTML = objData.data[0].iniValorvar;
                document.querySelector("#celfinValorvar").innerHTML = objData.data[0].finValorvar;
                document.querySelector("#celtipValorvar").innerHTML = objData.data[0].tipValorvar;
                document.querySelector("#celvalValorvar").innerHTML = objData.data[0].valValorvar;
                document.querySelector("#celestValorvar").innerHTML = estado;
                $('#modalViewValorvar').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idValorvar) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Valorvrsalp/getValorvar/' + idValorvar;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idValorvar").value = objData.data[0].idValorvar;
                document.querySelector("#txtiniValorvar").value = objData.data[0].iniValorvar;
                document.querySelector("#txtfinValorvar").value = objData.data[0].finValorvar;
                document.querySelector("#txttipValorvar").value = objData.data[0].tipValorvar;
                document.querySelector("#fltvalValorvar").value = objData.data[0].valValorvar;
                document.querySelector("#listVariable").value = objData.data[0].varValorvar;
                if (objData.data[0].estValorvar == 1) {
                    document.querySelector("#listestValorvar").value = 1;
                } else {
                    document.querySelector("#listestValorvar").value = 2;
                }
                $('#listVariable').selectpicker('render');
                $('#listestValorvar').selectpicker('render');
            }
        }
        $('#modalFormValorvar').modal('show');
    }
}

function fntDelInfo(idValorvar) {
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
            let ajaxUrl = base_url + '/Valorvrsalp/delValorvar/';
            let strData = "idValorvar=" + idValorvar;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableValorvrsalp.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

 function fntVariables() {
    if (document.querySelector('#listVariable')) {
        let ajaxUrl = base_url + '/Varsalp/getSelectVarsalp'; 
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listVariable').innerHTML = request.responseText;
                $('#listVariable').selectpicker('render');
            }
        }
    }
} 
function openModal() {
    rowTable = "";
    document.querySelector('#idValorvar').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro";
    document.querySelector("#formValorvar").reset();
    $('#modalFormValorvar').modal('show');
}