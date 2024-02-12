let tableCategorias;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    
    // Tabla de Categorias
    tableCategorias = $('#tableCategorias').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Categorias/getCategorias",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idCategoria" },
            { "data": "nomCategoria" },
            { "data": "desCategoria" },
            { "data": "estCategoria" },
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

    //NUEVA CATEGORIA
    if (document.querySelector('#formCategoria')) {
        let formCategoria = document.querySelector('#formCategoria');
        formCategoria.onsubmit = function (e) {
            e.preventDefault();
            let strnomCategoria = document.querySelector('#txtnomCategoria').value;
            let strdesCategoria = document.querySelector('#txtdesCategoria').value;
            let intestCategoria = document.querySelector('#listestCategoria').value;
            if (strnomCategoria == '' || strdesCategoria == '' || intestCategoria == '') {
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
            let ajaxUrl = base_url + '/Categorias/setCategoria';
            let formData = new FormData(formCategoria);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == ""){
                            tableCategorias.api().ajax.reload();    
                        }else{
                            htmlStatus = intestCategoria == 1 ? 
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strnomCategoria;
                            rowTable.cells[2].textContent = strdesCategoria;
                            rowTable.cells[3].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormCategoria').modal("hide");
                        formCategoria.reset();
                        swal("Categorias", objData.msg, "success");
                        removePhoto();
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    // Carga de fotos de la Categoría
    if(document.querySelector("#foto")){
        var foto = document.querySelector("#foto");
        foto.onchange = function(e) {
            var uploadFoto = document.querySelector("#foto").value;
            var fileimg = document.querySelector("#foto").files;
            var nav = window.URL || window.webkitURL;
            var contactAlert = document.querySelector('#form_alert');
            if(uploadFoto !=''){
                var type = fileimg[0].type;
                var name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value="";
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        if(document.querySelector('#img')){
                            document.querySelector('#img').remove();
                        }
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                    }
            }else{
                alert("No selecciono foto");
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
            }
        }
    }
    
    if(document.querySelector(".delPhoto")){
        var delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }
}, false);

function fntViewInfo(idecategoria) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + idecategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            if (objData.status) {
                let estCategoria = objData.data[0].estCategoria == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celnomCategoria").innerHTML = objData.data[0].nomCategoria;
                document.querySelector("#celdesCategoria").innerHTML = objData.data[0].desCategoria;
                document.querySelector("#celestCategoria").innerHTML = estCategoria;
                document.querySelector("#imgCategoria").innerHTML = '<img src="' + objData.data.url_portada + '"></img>';
                $('#modalViewCategoria').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idCategoria) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Categoria";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + idCategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCategoria").value = objData.data[0].idCategoria;
                document.querySelector("#txtnomCategoria").value = objData.data[0].nomCategoria;
                document.querySelector("#txtdesCategoria").value = objData.data[0].desCategoria;
                document.querySelector("#txtdesCategoria").value = objData.data[0].desCategoria;
                document.querySelector("#foto_actual").value = objData.data[0].imgCategoria;
                document.querySelector("#foto_remove").value = 0;
                if (objData.data[0].estCategoria == 1) {
                    document.querySelector("#listestCategoria").value = 1;
                } else {
                    document.querySelector("#listestCategoria").value = 2;
                }
                $('#listestCategoria').selectpicker('render');
                if (document.querySelector('#img')){
                    document.querySelector('#img').src = objData.data.url_portada;
                }else{
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objData.data.url_portada + ">";
                }
                if (objData.data.imgCategoria == 'portada_categoria.png'){
                    document.querySelector('.delPhoto').classList.add("notBlock");
                }else{
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
            }
        }
        $('#modalFormCategoria').modal('show');
    }
}

function fntDelInfo(idCategoria) {
    swal({
        title: "Eliminar Categoria",
        text: "¿Realmente quiere eliminar la Categoría?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Categorias/delCategoria/';
            let strData = "idCategoria=" + idCategoria;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableCategorias.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
}

function openModal() {
    rowTable = "";
    document.querySelector('#idCategoria').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoría";
    document.querySelector("#formCategoria").reset();
    $('#modalFormCategoria').modal('show');
    removePhoto();
}