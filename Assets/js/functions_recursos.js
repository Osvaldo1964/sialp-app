window.addEventListener('load', function () {
    alert('documento carado');
 
    fntInputFile();
    fntGrupos();
    fntItems();
    fntUsos();
    fntRecursos();
})

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
function fntRecursos() {
    if (document.querySelector('#listRecursos')) {
        let ajaxUrl = base_url + '/Recursos/getSelectRecursos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRecursos').innerHTML = request.responseText;
                $('#listReceursos').selectpicker('render');
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

function openModal() {
    rowTable = "";
    document.querySelector('#idElemento').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Elemento";
    document.querySelector("#formElemento").reset();
    document.querySelector("#divBarCode").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormElemento').modal('show');
}