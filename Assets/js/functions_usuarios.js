let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "docUsuario" },
            { "data": "nomUsuario" },
            { "data": "apeUsuario" },
            { "data": "telUsuario" },
            { "data": "emaUsuario" },
            { "data": "nomRol" },
            { "data": "estUsuario" },
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

    if (document.querySelector('#formUsuario')) {
        let formUsuario = document.querySelector('#formUsuario');
        formUsuario.onsubmit = function (e) {
            e.preventDefault();
            let strdocUsuario = document.querySelector('#txtdocUsuario').value;
            let strnomUsuario = document.querySelector('#txtnomUsuario').value;
            let strapeUsuario = document.querySelector('#txtapeUsuario').value;
            let stremaUsuario = document.querySelector('#txtemaUsuario').value;
            let inttelUsuario = document.querySelector('#txttelUsuario').value;
            let intidRol = document.querySelector('#listidRol').value;
            let strpasUsuario = document.querySelector('#txtpasUsuario').value;
            let intStatus = document.querySelector("#listestUsuario").value;
            if (strdocUsuario == '' || strnomUsuario == '' || strapeUsuario == '' || stremaUsuario == '' || inttelUsuario == '' || intidRol == '') {
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
            let ajaxUrl = base_url + '/Usuarios/setUsuario';
            let formData = new FormData(formUsuario);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableUsuarios.api().ajax.reload();    
                        }else{
                            htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strdocUsuario;
                            rowTable.cells[2].textContent = strnomUsuario;
                            rowTable.cells[3].textContent = strapeUsuario;
                            rowTable.cells[4].textContent = inttelUsuario;
                            rowTable.cells[5].textContent = stremaUsuario;
                            rowTable.cells[6].textContent = document.querySelector("#listidRol").selectedOptions[0].text;
                            rowTable.cells[7].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal("Usuarios", objData.msg, "success");
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    //Actualizar Perfil de Usuario
    if (document.querySelector('#formPerfil')) {
        let formPerfil = document.querySelector('#formPerfil');
        formPerfil.onsubmit = function (e) {
            e.preventDefault();
            let strdocUsuario = document.querySelector('#txtdocUsuario').value;
            let strnomUsuario = document.querySelector('#txtnomUsuario').value;
            let strapeUsuario = document.querySelector('#txtapeUsuario').value;
            let inttelUsuario = document.querySelector('#txttelUsuario').value;
            let strPassword = document.querySelector('#txtpasUsuario').value;
            let strPasswordConfirm = document.querySelector('#txtpasUsuarioConfirm').value;
            if (strdocUsuario == '' || strnomUsuario == '' || strapeUsuario == '' || inttelUsuario == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            if (strPassword != "" || strPasswordConfirm != "") {
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseñas no son iguales.", "info");
                    return false;
                }
                if (strPassword.length < 5) {
                    swal("Atención", "La contraseña debe tener mínimo 5 caracteres.", "error");
                    return false;
                }
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
            let ajaxUrl = base_url + '/Usuarios/putPerfil';
            let formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    //Actualizar Datos Comerciales
    if (document.querySelector('#formDataFiscal')) {
        let formDataFiscal = document.querySelector('#formDataFiscal');
        formDataFiscal.onsubmit = function (e) {
            e.preventDefault();
            let listipUsuario = document.querySelector('#listipUsuario').value;
            let strrazUsuario = document.querySelector('#txtrazUsuario').value;
            let stractUsuario = document.querySelector('#txtactUsuario').value;
            let strrepUsuario = document.querySelector('#txtrepUsuario').value;
            let strdirUsuario = document.querySelector('#txtdirUsuario').value;
            let strefaUsuario = document.querySelector('#txtefaUsuario').value;
            if (listipUsuario == '' || strrazUsuario == '' || stractUsuario == '' || strrepUsuario == '' || strdirUsuario == ''
                                    || strefaUsuario == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/putComercial';
            let formData = new FormData(formDataFiscal);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
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

window.addEventListener('load', function () {
    fntRolesUsuario();
}, false);

function fntRolesUsuario() {
    if (document.querySelector('#listidRol')) {
        let ajaxUrl = base_url + '/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listidRol').innerHTML = request.responseText;
                $('#listidRol').selectpicker('render');
            }
        }
    }
}

function fntViewUsuario(idpersona) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estadoUsuario = objData.data[0].estUsuario == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celdocUsuario").innerHTML = objData.data[0].docUsuario;
                document.querySelector("#celnomUsuario").innerHTML = objData.data[0].nomUsuario;
                document.querySelector("#celapeUsuario").innerHTML = objData.data[0].apeUsuario;
                document.querySelector("#celtelUsuario").innerHTML = objData.data[0].telUsuario;
                document.querySelector("#celemaUsuario").innerHTML = objData.data[0].emaUsuario;
                document.querySelector("#celrolUsuario").innerHTML = objData.data[0].nomRol;
                document.querySelector("#celestUsuario").innerHTML = estadoUsuario;
                document.querySelector("#celregUsuario").innerHTML = objData.data[0].regUsuario;
                $('#modalViewUsuario').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUsuario(element, idUsuario) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/getUsuario/' + idUsuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idUsuario").value = objData.data[0].idUsuario;
                document.querySelector("#txtdocUsuario").value = objData.data[0].docUsuario;
                document.querySelector("#txtnomUsuario").value = objData.data[0].nomUsuario;
                document.querySelector("#txtapeUsuario").value = objData.data[0].apeUsuario;
                document.querySelector("#txttelUsuario").value = objData.data[0].telUsuario;
                document.querySelector("#txtemaUsuario").value = objData.data[0].emaUsuario;
                document.querySelector("#listidRol").value = objData.data[0].idRol;
                $('#listidRol').selectpicker('render');
                if (objData.data[0].estUsuario == 1) {
                    document.querySelector("#listestUsuario").value = 1;
                } else {
                    document.querySelector("#listestUsuario").value = 2;
                }
                $('#listestUsuario').selectpicker('render');
            }
        }
        $('#modalFormUsuario').modal('show');
    }
}

function fntDelUsuario(idUsuario) {
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/delUsuario/';
            let strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableUsuarios.api().ajax.reload();
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
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}

function openModalPerfil() {
    $('#modalFormPerfil').modal('show');
}