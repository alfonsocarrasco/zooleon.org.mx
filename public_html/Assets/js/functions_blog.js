let tableNoticias;
let rowTable;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    if (document.querySelector("#foto")) {

        let foto = document.querySelector("#foto");
        foto.onchange = function(e) {

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

                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value = "";
                    return false;

                } else {

                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }

                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";

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

    tableNoticias = $('#tableNoticias').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'blog/getNoticias',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idblog'},
            { 'data': 'titulo_nota' },
            { 'data': 'fecha_nota' },
            { 'data': 'statusnota' },
            { 'data': 'options' }
        ],
        'responsive': 'true',
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });    

    if (document.querySelector("#formNoticias")) {

        rowTable = tableNoticias.page();
        localStorage.setItem('paginaActual', rowTable);

        let formNoticias = document.querySelector("#formNoticias");
        formNoticias.onsubmit = function(e) {
            e.preventDefault();

            let strNota = document.querySelector('#txtTituloNota').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let strLinkVideo = document.querySelector('#txtVideo').value;
            let intCategoria = document.querySelector('#listCategoria').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strNota == '' || strDescripcion == '' || intCategoria == '' || intStatus == '') {

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

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'blog/setNoticia';
            let formData = new FormData(formNoticias);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == 0) {
                            tableNoticias.ajax.reload(function() {
                                $('#modalFormNoticias').modal('hide');
                            });
                        } else {
                            tableNoticias.ajax.reload(function() {
                                $('#modalFormNoticias').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableNoticias.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formNoticias.reset();
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
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    fntCategorias();

}, false);

$('#txtDescripcion').summernote({
    placeholder: 'Descripción del Post',
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
    let ajaxUrl = base_url + 'blog/uploadImages';
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
    let ajaxUrl = base_url + 'blog/deleteImages';
    let formData = new FormData();
    formData.append('src', src);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);

            console.log(objData);

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

function fntViewNota(idnota) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'blog/getNoticia/' + idnota;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { descripcion_nota, fecha_publicacion, idblog, ruta_nota, statusnota, titulo_nota, url_portada, video_nota } = objData.data;

                let estado = statusnota == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                let fecha = formato(fecha_publicacion);

                document.querySelector("#celId").innerHTML = idblog;
                document.querySelector("#celImg").innerHTML = '<img src="' + url_portada + '" alt="'+ titulo_nota +'" style="heigth:50%; width:50%;" />';
                document.querySelector("#celTitulo").innerHTML = titulo_nota;
                document.querySelector("#celDescripcion").innerHTML = descripcion_nota;
                document.querySelector("#celFecha").innerHTML = fecha;
                document.querySelector("#celVideo").innerHTML = video_nota;
                document.querySelector("#celEstado").innerHTML = estado;

                let modalNoticia = new bootstrap.Modal(document.getElementById('modalViewNoticia'), {});
                modalNoticia.show();

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

function fntEditNota(idnota) {

    rowTable = tableNoticias.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Post";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'blog/getNoticia/' + idnota;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { descripcion_nota, fecha_publicacion, img_nota, idblog, statusnota, titulo_nota, url_portada, video_nota, categoriaid_nota } = objData.data;
                
                document.querySelector("#idNota").value = idblog;
                document.querySelector('#txtTituloNota').value = titulo_nota;
                $('#txtDescripcion').summernote('code', descripcion_nota);
                document.querySelector('#foto_actual').value = img_nota;
                document.querySelector("#foto_remove").value = 0;
                document.querySelector('#fechaPub').value = fecha_publicacion;
                document.querySelector('#listCategoria').value = categoriaid_nota;
                let video = document.querySelector('#txtVideo').value = video_nota;

                if (statusnota == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                // $('#listStatus').selectpicker('render');

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '">';
                }

                if (img_nota == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormNoticias').modal('show');

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

function fntDelNota(idnota) {

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
        msg: '¿Realmente desea eliminar el post?',
        title: 'Eliminar Post',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'blog/delNoticia';
                let strData = 'idNota=' + idnota;
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
                            tableNoticias.ajax.reload();
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

function fntCategorias() {
    if (document.querySelector('#listCategoria')) {
        let ajaxUrl = base_url + 'categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCategoria').innerHTML = request.responseText;
            }
        }
    }
}

function formato(txtFecha){
    return txtFecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
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
    document.querySelector('#idNota').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Post";
    document.querySelector("#formNoticias").reset();
    $('#txtDescripcion').summernote('code', '');

    let modalUsuario = new bootstrap.Modal(document.getElementById('modalFormNoticias'), {});
    modalUsuario.show();

    let myModal = document.getElementById('modalFormNoticias');
    let myInput = document.getElementById('txtTituloNota');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });
    
    removePhoto();
}