let tableAtracciones;
let rowTable = '';
let divLoading = document.querySelector('#divLoading');

document.addEventListener('DOMContentLoaded', function() {

    if (document.querySelector("#foto")) {

        let foto = document.querySelector("#foto");
        foto.onchange = function(event) {

            let uploadFoto = document.querySelector("#foto").value;
            let fileimg = document.querySelector("#foto").files;
            let nav = window.URL || window.webkitURL;

            if (uploadFoto != '') {

                let type = fileimg[0].type;
                let name = fileimg[0].name;

                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    
                    Lobibox.notify('warning', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'Seleccione un formato de imagen válido JPG o PNG.'
                    });

                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }

                    document.querySelector('.delPhoto').classList.add('notBlock');
                    foto.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }

                    document.querySelector('.delPhoto').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 1920 || this.height != 820) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (1920x820)px.'
                        });
    
                        if (document.querySelector('#img')) {
                            document.querySelector('#img').remove();
                        }
    
                        document.querySelector('.delPhoto').classList.add("notBlock");
                        foto.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);

            } else {

                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-error',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'No ha seleccionado la imagen.'
                });

                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }

            }
        }
    }

    if (document.querySelector(".delPhoto")) {
        let delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove').value = 1;
            removePhoto();
        }
    }

    tableAtracciones = $('#tableAtracciones').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'eventos/getAtracciones',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idatracciones'},
            { 'data': 'titulo' },
            { 'data': 'orden' },
            { 'data': 'status' },
            { 'data': 'options' }
        ],
        'responsive': 'true',
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });
    
    if (document.querySelector("#formAtraccion")) {

        let formAtraccion = document.querySelector("#formAtraccion");
        formAtraccion.onsubmit = function(e) {
            e.preventDefault();

            let strTitulo = document.querySelector('#txtTitulo').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strTitulo == '' || strDescripcion == '' || intStatus == '') {

                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Todos los campos son obligatorios.'
                });
                
                return false;

            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }

            divLoading.style.display = 'flex';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'eventos/setData';
            let formData = new FormData(formAtraccion);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        if (rowTable == 0) {
                            tableAtracciones.ajax.reload(function() {
                                $('#modalFormAtraccion').modal('hide');
                            });
                        } else {
                            tableAtracciones.ajax.reload(function() {
                                $('#modalFormAtraccion').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableAtracciones.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formAtraccion.reset();
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-check-circle',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: objData.msg
                        });
                        removePhoto();

                    } else {
                        Lobibox.notify('error', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-x-circle',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: objData.msg
                        });
                    }
                }
                divLoading.style.display = 'none';
                return false;
            }
        }
    }

}, false);

$('#txtDescripcion').summernote({
    disableResizeEditor: false,
    tabsize: 2,
    height: 250,
    lang: 'es-ES',
    callbacks: {
        onImageUpload: function(files) {
            for (var i = 0; i < files.length; i++) {
                uploadImg(files[i]);
            }
        },
        onMediaDelete: function(target) {
            deleteFile(target[0].src);
        }
    }
});

function uploadImg(file) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'eventos/uploadImages';
    let formData = new FormData();
    formData.append('file', file, file.name);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if(objData.status) {

                const { data } = objData;
                $('#txtDescripcion').summernote('insertImage', data);
                $('#txtDescripcionContamos').summernote('insertImage', data);
                $('#txtAntecedentes').summernote('insertImage', data);

            } else {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: objData.msg
                });
            }
        }
    }

}

function deleteFile(src) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'eventos/deleteImages';
    let formData = new FormData();
    formData.append('src', src);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if(objData.status) {

                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    icon: 'bx bx-check-circle',
                    msg: objData.msg,
                    pauseDelayOnHover: true,
                    position: 'top right',
                    rounded: true,
                    size: 'mini',
                    sound: false
                });

            } else {

                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: objData.msg
                });

            }
        }
    }

}

$('span.note-icon-caret').remove();
$('.note-statusbar').hide();

function fntViewAtraccion(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'eventos/getAtraccion/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { costo, costo2, costo3, descripcion, dia_apertura ,dia_apertura_2, horarioa, horarioa2, horarioc, horarioc2, idatracciones, imagen, status, titulo, url_portada } = objData.data;

                let estado = status == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML          = idatracciones;
                document.querySelector("#celImg").innerHTML         = '<img src="' + url_portada + '" alt="" class="img-fluid" style="heigth:50%; width:50%;" />';
                document.querySelector("#celTitulo").innerHTML      = titulo;
                document.querySelector("#celDescripcion").innerHTML = descripcion;
                document.querySelector("#celDias").innerHTML        = dia_apertura;
                document.querySelector("#celHorario").innerHTML     = horarioa + ' - ' + horarioc;
                document.querySelector("#celCosto").innerHTML       = costo;
                document.querySelector("#celDias2").innerHTML       = dia_apertura_2;
                document.querySelector("#celHorario2").innerHTML    = horarioa2 + ' - ' + horarioc2;
                document.querySelector("#celCosto2").innerHTML      = costo2;
                document.querySelector("#celCosto3").innerHTML      = costo3;
                document.querySelector("#celEstado").innerHTML      = estado;

                let modalViewAtraccion = new bootstrap.Modal(document.getElementById('modalViewAtraccion'), {});
                modalViewAtraccion.show();

            } else {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: objData.msg
                });
            }
        }
    }
}

function fntEditAtraccion(id) {

    rowTable = tableAtracciones.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Atracción";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'eventos/getAtraccion/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { costo, costo2, costo3, descripcion, dia_apertura ,dia_apertura_2, horarioa, horarioa2, horarioc, horarioc2, idatracciones, imagen, orden, status, titulo, url_portada } = objData.data;
                
                document.querySelector("#idAtraccion").value    = idatracciones;
                document.querySelector('#foto_actual').value    = imagen;
                document.querySelector("#foto_remove").value    = 0;
                document.querySelector('#txtTitulo').value      = titulo;
                $('#txtDescripcion').summernote('code', descripcion);
                document.querySelector('#txtDias').value        = dia_apertura;
                document.querySelector('#txtHorarioA').value    = horarioa;
                document.querySelector('#txtHorarioC').value    = horarioc;
                document.querySelector('#txtDias2').value       = dia_apertura_2;
                document.querySelector('#txtHorarioA2').value   = horarioa2;
                document.querySelector('#txtHorarioC2').value   = horarioc2;
                document.querySelector('#txtCosto').value       = costo;
                document.querySelector('#txtCosto2').value      = costo2;
                document.querySelector('#txtCosto3').value      = costo3;
                document.querySelector('#intPosicion').value    = orden;

                if (status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '">';
                }

                if (imagen == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormAtraccion').modal('show');

            } else {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: objData.msg
                });
            }
        }
    }
}

function fntDelAtraccion(id) {

    Lobibox.confirm({
        buttons: {
            yes: {
                'class': 'btn btn-danger'
            },
            no: {
                'class': 'btn btn-dark',
                closeOnClick: true
            }
        },
        closeButton: false,
        iconClass: 'bi bi-exclamation-circle',
        msg: '¿Realmente quiere eliminar la atracción?',
        title: 'Eliminar Atracción',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'eventos/delData';
                let strData = 'id=' + id;
                request.open('POST', ajaxUrl, true);
                request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                request.send(strData);
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {

                        let objData = JSON.parse(request.responseText);

                        if (objData.status) {

                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-check-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: objData.msg
                            });
                            tableAtracciones.ajax.reload();

                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: objData.msg
                            });
                        }
                    }
                }   
            }
        }
    });

}

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function openModal() {
    rowTable = '';
    document.querySelector('#formAtraccion').value = "";
    document.querySelector('#idAtraccion').value = "";
    document.querySelector('#foto_actual').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Atracción";
    document.querySelector("#formAtraccion").reset();
    $('#txtDescripcion').summernote('code', '');

    let modalFormAtraccion = new bootstrap.Modal(document.getElementById('modalFormAtraccion'), {});
    modalFormAtraccion.show();

    let myModal = document.getElementById('modalFormAtraccion');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

    removePhoto();
}