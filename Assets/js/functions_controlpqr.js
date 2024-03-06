let tableControlPqr;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Tabla de Grupos
    tableControlPqr = $('#tableControlPqr').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Controlpqr/getPqrs",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idPqrs" },
            { "data": "nomPqrs" },
            { "data": "dirPqrs" },
            { "data": "frePqrs" },
            { "data": "estPqrs" },
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

    //Solucion PQR
    if (document.querySelector('#formPqrs')) {
        let formPqrs = document.querySelector('#formPqrs');
        formPqrs.onsubmit = function (e) {
            e.preventDefault();
            let strfsoPqrs = document.querySelector('#txtfsoPqrs').value;
            let strdsoPqrs = document.querySelector('#txtdsoPqrs').value;
            let intestPqrs = document.querySelector('#listestPqrs').value;
            if (strfsoPqrs == '' || strdsoPqrs == '') {
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
            let ajaxUrl = base_url + '/Controlpqr/setPqrs';
            let formData = new FormData(formPqrs);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        tableControlPqr.api().ajax.reload();    
/*                         if (rowTable == ""){
                            tableControlPqr.api().ajax.reload();    
                        }else{
                             htmlStatus = intestPqrs == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strnomPqrs;
                            rowTable.cells[2].textContent = strdirPqrs;
                            rowTable.cells[3].textContent = strfrePqrs;
                            rowTable.cells[4].innerHTML = htmlStatus;
                            rowTable = ""; 
                        } */
                        $('#modalFormPqrs').modal("hide");
                        formPqrs.reset();
                        swal("Pqrs", objData.msg, "success");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

        //Solucion PQR
        if (document.querySelector('#formCuadrilla')) {
            let formCuadrilla = document.querySelector('#formCuadrilla');
            formCuadrilla.onsubmit = function (e) {
                e.preventDefault();
                let intidPqrs = document.querySelector('#txtidPqrs').value;
                let strasiPqrs = document.querySelector('#txtasiPqrs').value;
                let intcuaPqrs = document.querySelector('#listCuadrillas').value;
                //let intestPqrs = document.querySelector('#listestPqrs').value;
                if (strasiPqrs == '' || intcuaPqrs == '') {
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
                let ajaxUrl = base_url + '/Controlpqr/setCuadrilla/' + intidPqrs;
                let formData = new FormData(formCuadrilla);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            tableControlPqr.api().ajax.reload();    
    /*                         if (rowTable == ""){
                                tableControlPqr.api().ajax.reload();    
                            }else{
                                 htmlStatus = intestPqrs == 1 ? 
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                                rowTable.cells[1].textContent = strnomPqrs;
                                rowTable.cells[2].textContent = strdirPqrs;
                                rowTable.cells[3].textContent = strfrePqrs;
                                rowTable.cells[4].innerHTML = htmlStatus;
                                rowTable = ""; 
                            } */
                            $('#modalFormCuadarilla').modal("hide");
                            formCuadrilla.reset();
                            swal("Cuadrillas", objData.msg, "success");
                        }
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    

    fntCuadrillas();
}, false);

function fntViewInfo(idpqrs) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Controlpqr/getPqr/' + idpqrs;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estPqrs = objData.data[0].estPqrs == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celidPqrs").innerHTML = objData.data[0].idPqrs;
                document.querySelector("#celnomPqrs").innerHTML = objData.data[0].nomPqrs;
                document.querySelector("#celemaPqrs").innerHTML = objData.data[0].emaPqrs;
                document.querySelector("#celdirPqrs").innerHTML = objData.data[0].dirPqrs;
                document.querySelector("#celfrePqrs").innerHTML = objData.data[0].frePqrs;
                document.querySelector("#celmsgPqrs").innerHTML = objData.data[0].msgPqrs;
                document.querySelector("#celfsoPqrs").innerHTML = objData.data[0].fsoPqrs;
                document.querySelector("#celdsoPqrs").innerHTML = objData.data[0].dsoPqrs;
                document.querySelector("#celestPqrs").innerHTML = estPqrs;
                $('#modalViewPqrs').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}
function fntEditInfo(element, idPqrs) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar PQR";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Controlpqr/getPqr/' + idPqrs;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idPqrs").value = objData.data[0].idPqrs;
                document.querySelector("#txtnomPqrs").value = objData.data[0].nomPqrs;
                document.querySelector("#txtemaPqrs").value = objData.data[0].emaPqrs;
                document.querySelector("#txtdirPqrs").value = objData.data[0].dirPqrs;
                document.querySelector("#txtmsgPqrs").value = objData.data[0].msgPqrs;
                document.querySelector("#txtfsoPqrs").value = objData.data[0].fsoPqrs;
                document.querySelector("#txtdsoPqrs").value = objData.data[0].dsoPqrs;
                document.querySelector("#listCuadrillas").value = objData.data[0].cuaPqrs;
/*                 if (objData.data[0].estPqrs == 1) {
                    document.querySelector("#listestPqrs").value = 1;
                } else {
                    document.querySelector("#listestPqrs").value = 2;
                } */
                $('#listestPqrs').selectpicker('render');
            }
        }
        $('#modalFormPqrs').modal('show');
    }
}

function fntCuadrilla(element, idPqrs) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Asignar Cuadrilla al PQR";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Asignar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Controlpqr/getPqr/' + idPqrs;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idPqrs").value = objData.data[0].idPqrs;
                document.querySelector("#txtidPqrs").value = objData.data[0].idPqrs;
                document.querySelector("#txtnomPqrs").value = objData.data[0].nomPqrs;
                document.querySelector("#txtemaPqrs").value = objData.data[0].emaPqrs;
                document.querySelector("#txtdirPqrs").value = objData.data[0].dirPqrs;
                document.querySelector("#txtmsgPqrs").value = objData.data[0].msgPqrs;
                document.querySelector("#txtasiPqrs").value = objData.data[0].asiPqrs;
                document.querySelector("#listCuadrillas").value = objData.data[0].cuaPqrs;
/*                 if (objData.data[0].estPqrs == 1) {
                    document.querySelector("#listestPqrs").value = 1;
                } else {
                    document.querySelector("#listestPqrs").value = 2;
                }
                $('#listestPqrs').selectpicker('render'); */
                $('#listCuadrillas').selectpicker('render');
            }
        }
        $('#modalFormCuadrilla').modal('show');
    }
}

function fntDelInfo(idPqrs) {
    swal({
        title: "Eliminar PQR",
        text: "¿Realmente quiere eliminar esta PQR?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Controlpqr/delPqr/';
            let strData = "idPqrs=" + idPqrs;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableControlPqr.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function fntCuadrillas() {
    if (document.querySelector('#listCuadrillas')) {
        let ajaxUrl = base_url + '/Cuadrillas/getSelectCuadrillas';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCuadrillas').innerHTML = request.responseText;
                $('#listCuadrillas').selectpicker('render');
            }
        }
    }
}

function openModal() {
    rowTable = "";
    document.querySelector('#idPqrs').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva PQR";
    document.querySelector("#formPqrs").reset();
    $('#modalFormPqrs').modal('show');
}