document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);
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
            { "data": "idActa" },
            { "data": "desTipoacta" },
            { "data": "desItemacta" },
            { "data": "numActa" },
            { "data": "fecActa" },
            { "data": "desRecurso" },
            { "data": "valActa" },
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

    if (document.querySelector("#txtcodElemento")) {
        let inputCodigo = document.querySelector("#txtcodElemento");
        inputCodigo.onkeyup = function () {
            if (inputCodigo.value.length >= 5) {
                document.querySelector("#divBarCode").classList.remove("notblock");
                fntBarcode();
            } else {
                document.querySelector("#divBarCode").classList.add("notblock");
            }
        }
    }

    if (document.querySelector("#formActa")) {
        let formActa = document.querySelector("#formActa");
        formActa.onsubmit = function (e) {
            e.preventDefault();
            let inttipActa = 2;
            let insiteActa = document.querySelector('#listClases').value;
            let strnumActa = document.querySelector('#txtnumActa').value;
            let strfecActa = document.querySelector('#txtfecActa').value;
            let intrecActa = document.querySelector('#listRecursos').value;
            let flrvalActa = document.querySelector('#fltvalActa').value;
            let intestActa = document.querySelector('#listestActa').value;
            if (strnumActa == '' || strfecActa == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Actas/setActa/';
            let formData = new FormData(formActa);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("", objData.msg, "success");
                        document.querySelector("#idActa").value = objData.idActa;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        if (rowTable == "") {
                            tableActas.api().ajax.reload();
                        } else {
                            htmlStatus = intestActa == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = desTipoacta;
                            rowTable.cells[2].textContent = acta;
                            rowTable.cells[3].textContent = numActa;
                            rowTable.cells[4].textContent = fecActa;
                            rowTable.cells[5].textContent = desRecurso;
                            rowTable.cells[6].textContent = valActa;
                            rowTable.cells[7].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    if (document.querySelector("#formActaelemento")) {
        let formActaelemento = document.querySelector("#formActaelemento");
        formActaelemento.onsubmit = function (e) {
            e.preventDefault();
            let strcodElemento = document.querySelector('#txtcodElemento').value;
            let intrecElemento = document.querySelector('#listRecursos').value;
            let intusoElemento = document.querySelector('#listUsos').value;
            let strdesElemento = '';
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
            let ajaxUrl = base_url + '/Elementos/setElementoadd/';
            let formData = new FormData(formActaelemento);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("", objData.msg, "success");
                        document.querySelector("#idElemento").value = objData.idElemento;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                    } else {
                        swal("Error", objData.msg, "error");
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
    fntRecursos();
    fntInputFile();
    fntInputPdf();
    fntGrupos();
    fntItems();
    fntUsos();
    fntItemactas()
})

function fntInputPdf() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function (inputUploadfile) {
        inputUploadfile.addEventListener('change', function () {
            let idActa = document.querySelector("#idActa").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'application/pdf' ) { //&& type != 'image/jpg' && type != 'image/png'
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Actas/setPdfacta';
                    let formData = new FormData();
                    formData.append('actImagen', idActa);
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

function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function (inputUploadfile) {
        inputUploadfile.addEventListener('change', function () {
            let idActa = document.querySelector("#idActa").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'application/pdf' ) { //&& type != 'image/jpg' && type != 'image/png'
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Actas/setPdfacta';
                    let formData = new FormData();
                    formData.append('actImagen', idActa);
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
    let idActa = document.querySelector("#idActa").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Actas/delPdfacta/';
    let formData = new FormData();
    formData.append('actImagen', idActa);
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

function fntViewInfo(idActa) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Actas/getActa/' + idActa;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objActa = objData.data;
                let estadoActa = objActa[0]['estActa'] == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector('#celtipActa').innerHTML = objActa[0]['desTipoacta'];
                document.querySelector('#celtipActa').innerHTML = objActa[0]['desItemacta'];
                document.querySelector('#celnumActa').innerHTML = objActa[0]['numActa'];
                document.querySelector('#celfecActa').innerHTML = objActa[0]['fecActa'];
                document.querySelector('#celrecActa').innerHTML = objActa[0]['desRecurso'];
                document.querySelector('#celvalActa').innerHTML = objActa[0]['valActa'];
                document.querySelector('#celestActa').innerHTML = estadoActa;
                if (objActa['images'].length > 0) {
                    let objActas = objActa['images'];
                    for (let p = 0; p < objActas.length; p++) {
                        htmlImage += `<iframe src="${objActas[p]['url_image']}"></iframe>`
                    }
                }
                document.querySelector('#celFotos').innerHTML = htmlImage;
                $('#modalViewActa').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idActa) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Acta";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Actas/getActa/' + idActa;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objActa = objData.data;
                document.querySelector("#idActa").value = objActa[0].idActa;
                document.querySelector("#listClases").value = objActa[0].iteActa;
                document.querySelector("#listRecursos").value = objActa[0].recActa;
                document.querySelector("#txtnumActa").value = objActa[0].numActa;
                document.querySelector("#txtfecActa").value = objActa[0].fecActa;
                document.querySelector("#fltvalActa").value = objActa[0].valActa;
                document.querySelector("#listestActa").value = objActa[0].estActa;
                $('#listClases').selectpicker('render');
                $('#listRecursos').selectpicker('render');
                $('#listestActa').selectpicker('render'); 
                if (objActa.images.length > 0) {
                    let objActas = objActa.images;
                    for (let p = 0; p < objActas.length; p++) {
                        let key = Date.now() + p;
                        htmlImage += `<div id="div${key}">
                            <div class="prevImage">
                            <iframe src="${objActas[p].url_image}"></iframe>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objActas[p].nomImagen}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage;
                document.querySelector("#containerGallery").classList.remove("notblock");
                $('#modalFormActas').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(idActa) {
    swal({
        title: "Eliminar Acta",
        text: "¿Realmente quiere eliminar el Acta?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Actas/delActa/';
            let strData = "idActa=" + idActa;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableActas.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

// Registro Elementos al Acta

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
                document.querySelector('#listRecursosadd').innerHTML = request.responseText;
                $('#listRecursosadd').selectpicker('render');
            }
        }
    }
}

function fntBarcode(e) {
    let codigo = document.querySelector("#txtcodElemento").value;
    JsBarcode("#barcode", codigo);
}

function fntPrintBarcode(area) {
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400, width=600');
    vprint.document.write(elemntArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function fntAddElemento(idActa, numActa, fecActa) {
    let eleactActa = idActa;
    let elenumActa = numActa;
    let elefecActa = fecActa;
    document.querySelector('#eleactActa').value = eleactActa;
    //document.querySelector('#elenumActa').value = elenumActa;
    //document.querySelector('#elefecActa').value = elefecActa;
    $('#modalFormActaelemento').modal('show');
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