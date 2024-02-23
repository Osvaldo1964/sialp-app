let tableActas;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

window.addEventListener('load', function () {

    tableACtas = $('#tableActas').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Actas/getActas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idACta" },
            { "data": "desTipoacta" },
            { "data": "desItemacta" },
            { "data": "fecActa" },
            { "data": "desRecurso" },
            { "data": "estActa" },
            { "data": "options" }
        ],
        "columnDefs": [
            { 'className': "textleft", "targets": [1,2] },
            { 'className': "textright", "targets": [0] },
            { 'className': "textcenter", "targets": [3] },
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    if (document.querySelector("#formActa")) {
        let formActa = document.querySelector("#formActa");
        formActa.onsubmit = function (e) {
            e.preventDefault();
            let strcodElemento = document.querySelector('#txtcodElemento').value;
            let strdesElemento = document.querySelector('#txtdesElemento').value;
            let strdirElemento = document.querySelector('#txtdirElemento').value;
            let fltlatElemento = document.querySelector('#fltlatElemento').value;
            let fltlonElemento = document.querySelector('#fltlonElemento').value;
            let intestElemento = document.querySelector('#listestElemento').value;
            if (strdirElemento == '' || strcodElemento == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            if (strcodElemento.length < 5) {
                swal("Atención", "El código debe ser mayor que 5 dígitos.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            tinyMCE.triggerSave();
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Elementos/setElemento/';
            let formData = new FormData(formElemento);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("", objData.msg, "success");
                        document.querySelector("#idElemento").value = objData.idElemento;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        if (rowTable == "") {
                            tableElementos.api().ajax.reload();
                        } else {
                            htmlStatus = intestElemento == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = desGrupo;
                            rowTable.cells[2].textContent = desItem;
                            rowTable.cells[3].textContent = codElemento;
                            rowTable.cells[4].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                    } else {
                        swal("Errorxcxcxc", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    if (document.querySelector(".btnAddImage")) {
        let btnAddImage = document.querySelector(".btnAddImage");
        btnAddImage.onclick = function (e) {
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id = "div" + key;
            newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload"></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
            document.querySelector("#containerImages").appendChild(newElement);
            document.querySelector("#div" + key + " .btnUploadfile").click();
            fntInputFile();
        }
    }
    fntInputFile();
    fntGrupos();
    fntItems();
    fntUsos();
    fntItemactas()
    fntRecursos();
})

function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function (inputUploadfile) {
        inputUploadfile.addEventListener('change', function () {
            let idElemento = document.querySelector("#idElemento").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Elementos/setImage';
                    let formData = new FormData();
                    formData.append('idElemento', idElemento);
                    formData.append("foto", this.files[0]);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function () {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#" + parentId + " .btnDeleteImage").setAttribute("imgname", objData.imgname);
                                document.querySelector("#" + parentId + " .btnUploadfile").classList.add("notblock");
                                document.querySelector("#" + parentId + " .btnDeleteImage").classList.remove("notblock");
                            } else {
                                swal("Error", objData.msg, "error");
                            }
                        }
                    }
                }
            }
        });
    });
}

function fntDelItem(element){
    let nameImg = document.querySelector(element + ' .btnDeleteImage').getAttribute("imgname");
    let idElemento = document.querySelector("#idElemento").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Elementos/delFile/';
    let formData = new FormData();
    formData.append('idElemento', idElemento);
    formData.append('file', nameImg);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status){
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg, "error");
            }
        }
    }
}

function fntViewInfo(idElemento) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Elementos/getElemento/' + idElemento;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objElemento = objData.data;
                let estadoElemento = objElemento[0]['estElemento'] == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector('#celdesGrupo').innerHTML = objElemento[0]['desGrupo'];
                document.querySelector('#celcodElemento').innerHTML = objElemento[0]['codElemento'];
                document.querySelector('#celnomElemento').innerHTML = objElemento[0]['nomElemento'];
                document.querySelector('#celdesElemento').innerHTML = objElemento[0]['desElemento'];
                document.querySelector('#celestElemento').innerHTML = estadoElemento;
                if (objElemento['images'].length > 0) {
                    let objElementos = objElemento['images'];
                    for (let p = 0; p < objElementos.length; p++) {
                        htmlImage += `<img src="${objElementos[p]['url_image']}"></img>`
                    }
                }
                document.querySelector('#celFotos').innerHTML = htmlImage;
                $('#modalViewElemento').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idElemento) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Elemento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Elementos/getElemento/' + idElemento;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objElemento = objData.data;
                document.querySelector("#idElemento").value = objElemento[0].idElemento;
                document.querySelector("#listGrupos").value = objElemento[0].gruElemento;
                document.querySelector("#listItems").value = objElemento[0].iteElemento;
                document.querySelector("#listRecursos").value = objElemento[0].recElemento;
                document.querySelector("#listUsos").value = objElemento[0].usoElemento;
                document.querySelector("#txtcodElemento").value = objElemento[0].codElemento;
                document.querySelector("#txtdesElemento").value = objElemento[0].desElemento;
                document.querySelector("#txtdirElemento").value = objElemento[0].dirElemento;
                document.querySelector("#fltlatElemento").value = objElemento[0].latElemento;
                document.querySelector("#fltlonElemento").value = objElemento[0].lonElemento;
                document.querySelector("#txtainElemento").value = objElemento[0].ainElemento;
                document.querySelector("#txtfinElemento").value = objElemento[0].finElemento;
                document.querySelector("#txtabaElemento").value = objElemento[0].abaElemento;
                document.querySelector("#txtfbaElemento").value = objElemento[0].fbaElemento;
                document.querySelector("#listestElemento").value = objElemento[0].estElemento;
                tinymce.activeEditor.setContent(objElemento[0].desElemento);
                $('#listGrupos').selectpicker('render');
                $('#listItems').selectpicker('render');
                $('#listRecursos').selectpicker('render');
                $('#listUsos').selectpicker('render');
                $('#listestElemento').selectpicker('render'); 
                fntBarcode();
                if (objElemento.images.length > 0) {
                    let objElementos = objElemento.images;
                    for (let p = 0; p < objElementos.length; p++) {
                        let key = Date.now() + p;
                        htmlImage += `<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objElementos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objElementos[p].nomImagen}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage;
                document.querySelector("#divBarCode").classList.remove("notblock");
                document.querySelector("#containerGallery").classList.remove("notblock");
                $('#modalFormElemento').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(idElemento) {
    swal({
        title: "Eliminar Elemento",
        text: "¿Realmente quiere eliminar el Elemento?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Elementos/delElemento/';
            let strData = "idElemento=" + idElemento;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableElementos.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function fntGrupos() {
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

function fntItems() {
    if (document.querySelector('#listItems')) {
        let ajaxUrl = base_url + '/Items/getSelectItems';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listItems').innerHTML = request.responseText;
                $('#listItems').selectpicker('render');
            }
        }
    }
}

function fntUsos() {
    if (document.querySelector('#listUsos')) {
        let ajaxUrl = base_url + '/Usos/getSelectUsos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listUsos').innerHTML = request.responseText;
                $('#listUsos').selectpicker('render');
            }
        }
    }
}

function fntItemactas() {
    if (document.querySelector('#listClases')) {
        let ajaxUrl = base_url + '/Itemsactas/getSelectItemsactas';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listClases').innerHTML = request.responseText;
                $('#listClases').selectpicker('render');
            }
        }
    }
}

function fntRecursos() {
    if (document.querySelector('#listRecursos')) {
        let ajaxUrl = base_url + '/Recursos/getSelectRecursos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRecursos').innerHTML = request.responseText;
                $('#listRecursos').selectpicker('render');
            }
        }
    }
}

function openModal() {
    rowTable = "";
    document.querySelector('#idActa').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Acta";
    document.querySelector("#formActa").reset();
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormActas').modal('show');
}