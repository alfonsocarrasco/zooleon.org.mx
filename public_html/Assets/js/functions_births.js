let tableNacimientos;
let rowTable;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    tableNacimientos = $('#tableNacimientos').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'births/getData',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idnacimiento'},
            { 'data': 'nombre_especie' },
            { 'data': 'nombre_cientifico' },
            { 'data': 'fecha_nacimiento' },
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
    
    if (document.querySelector("#formNacimientos")) {

        let arrImage = [];
        let maxImageWidth = 600;
        let maxImageHeight = 600;
    
        let myDropzone = new Dropzone('.dropzone', {
            autoProcessQueue: false,
            acceptedFiles: 'image/jpeg, image/png',
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
            maxFilesize: 2,
            maxFiles: 10,
            parallelUploads: 10,
            url: base_url,
            init: function () {
                let myDropzone = this;

                rowTable = tableNacimientos.page();
                localStorage.setItem('paginaActual', rowTable);

                let formNacimientos = document.querySelector("#formNacimientos");
                formNacimientos.onsubmit = function(e) {
                    e.preventDefault();

                    myDropzone.processQueue();

                    let strNombreEsp   = document.querySelector('#txtNombreEspecie').value;
                    let strNombreCie   = document.querySelector('#txtNombreCientifico').value;
                    let strFecha       = document.querySelector('#txtFecha').value;
                    let strDescripcion = document.querySelector('#txtDescripcion').value;
                    let intCategoria   = document.querySelector('#listCategoria').value;
                    let intStatus      = document.querySelector('#listStatus').value;

                    if (strNombreEsp == '' || strNombreCie == '' || strFecha == '' || strDescripcion == '' || intCategoria == '' || intStatus == '') {

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
                    let ajaxUrl = base_url + 'births/setData';
                    let formData = new FormData(formNacimientos);

                    for (let i = 0; i < arrImage.length; i++) {
                        formData.append('txtGaleria[]', arrImage[i]);
                    }
                    
                    request.open('POST', ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                if (rowTable == 0) {
                                    tableNacimientos.ajax.reload(function() {
                                        $('#modalFormNacimientos').modal('hide');
                                    });
                                } else {
                                    tableNacimientos.ajax.reload(function() {
                                        $('#modalFormNacimientos').modal('hide');
                                        let pagina = localStorage.getItem('paginaActual');
                                        tableNoticias.page(parseInt(pagina)).draw('page');
                                        localStorage.removeItem('paginaActual');
                                    });
                                }

                                formNacimientos.reset();

                                Lobibox.notify('success', {
                                    pauseDelayOnHover: true,
                                    size: 'mini',
                                    rounded: true,
                                    icon: 'bx bx-check-circle',
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    msg: objData.msg
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
                        divLoading.style.display = 'none';
                        return false;
                    }
                }

                this.on('thumbnail', function(file) {
                    if (file.width != maxImageWidth || file.height != maxImageHeight) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (600x600)px.'
                        });
                        this.removeAllFiles(file);
                    }
                })

                this.on('complete', file => {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        this.removeAllFiles(file);
                    }
                });
            }
        });
    
        myDropzone.on('addedfile', file => {
            arrImage.push(file);
        });
    
        myDropzone.on('removedfile', file => {
            x = arrImage.indexOf(file);
            arrImage.splice(x, 1);
        });
    }

    fntCategorias();

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
    let ajaxUrl = base_url + 'births/uploadImages';
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
    let ajaxUrl = base_url + 'births/deleteImages';
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

function fntViewData(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'births/getNacimiento/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { descripcion, fecha_nacimiento, galeria, idnacimiento, img_galeria, nombre_categoria, nombre_cientifico, nombre_especie, status, url_portada } = objData.data;

                let statusnac = status == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                
                document.querySelector('#celId').innerHTML               = idnacimiento;
                document.querySelector('#celNombre').innerHTML           = nombre_especie;
                document.querySelector('#celNombreCientifico').innerHTML = nombre_cientifico;
                document.querySelector('#celFechaNacimiento').innerHTML  = fecha_nacimiento;
                document.querySelector('#celDescripcion').innerHTML      = descripcion;

                document.querySelector('#celPortada').innerHTML          = `<img class="img-fluid" src="${url_portada}" alt="${nombre_especie}" />'`;

                document.querySelector('#celCat').innerHTML              = nombre_categoria;
                document.querySelector('#celStatus').innerHTML           = statusnac;

                let imgGaleria = (galeria != null && galeria != '') ? img_galeria.reduce((accum, img) => {
                    return accum + '<img class="img-thumbnail" src="' + img +'" style="width:20%" />';
                }, '') : '';

                document.querySelector('#celGal').innerHTML = imgGaleria;

                let modalNacimiento = new bootstrap.Modal(document.getElementById('modalViewNacimiento'), {});
                modalNacimiento.show();

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

function fntEditData(id) {

    rowTable = tableNacimientos.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Nacimiento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'births/getNacimiento/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { categoria, descripcion, fecha_nacimiento, idnacimiento, img_galeria, nombre_cientifico, nombre_especie, portada, status, url_portada } = objData.data;
                
                document.querySelector('#idNacimiento').value             = idnacimiento;
                document.querySelector('#txtNombreEspecie').value         = nombre_especie;
                document.querySelector('#txtNombreCientifico').value      = nombre_cientifico;
                document.querySelector('#txtFecha').value                 = fecha_nacimiento;
                document.querySelector('#foto_actual').value              = portada;
                document.querySelector('#foto_remove').value              = 0;
                document.querySelector('#listCategoria').value            = categoria;
                $('#txtDescripcion').summernote('code', descripcion);

                if (img_galeria) {
                    document.querySelector('#imgGaleriaActual').value = JSON.stringify(img_galeria);
                } else {
                    document.querySelector('#imgGaleriaActual').value = '';
                }

                if (status == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '" />';
                }

                if (portada == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto').classList.remove('notBlock');
                }

                if (img_galeria) {
                    let imgGaleria = img_galeria.reduce((accum, img, index) => {
                        return accum + `<div class="content-galeria"><span class="delImg notBlock" id="img${index}"><i class="bi bi-x"></i></span><img class="img-thumbnail" src="${img}" /></div>`;
                    }, '');

                    document.querySelector('.imgGaleria').innerHTML = imgGaleria;
                    
                    if (imgGaleria != '') {
                        let delImg = document.querySelectorAll('.delImg');
                        delImg.forEach(function(e) {
                            e.classList.remove('notBlock');
                        });
                    }
                }

                if (document.querySelector(".delImg")) {
                    let delImg = document.querySelectorAll(".delImg");
                    Array.from(delImg).map(elem => {
                        elem.onclick = () => {
                            elem.parentNode.remove();
                            let indexArray = img_galeria.indexOf(elem.parentNode.childNodes[1].src);
                            if (indexArray > -1) img_galeria.splice(indexArray, 1);
                            document.querySelector('#imgGaleriaActual').value = JSON.stringify(img_galeria);
                        }
                    });
                }

                let modalNacimiento = new bootstrap.Modal(document.getElementById('modalFormNacimientos'), {});
                modalNacimiento.show();

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

function fntDelData(id) {
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
        msg: '¿Realmente desea eliminar el registro?',
        title: 'Eliminar Ejemplar',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'births/delData';
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
                            tableNacimientos.ajax.reload();
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

function openModal() {
    rowTable = '';
    document.querySelector('#idNacimiento').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Nacimiento";
    document.querySelector("#formNacimientos").reset();
    document.querySelector('.imgGaleria').innerHTML = '';
    $('#txtDescripcion').summernote('code', '');

    let modalEjemplar = new bootstrap.Modal(document.getElementById('modalFormNacimientos'), {});
    modalEjemplar.show();
    
    removePhoto();
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

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}