let tablePaquetes;
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

    tablePaquetes = $('#tablePaquetes').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'pagepaquetes/getPaquetes',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idpaquete'},
            { 'data': 'titulo' },
            { 'data': 'statuspaquete' },
            { 'data': 'options' }
        ],
        'responsive': 'true',
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });
    
    if (document.querySelector("#formPaquete")) {

        let formPaquete = document.querySelector("#formPaquete");
        formPaquete.onsubmit = function(e) {
            e.preventDefault();

            let strTitulo = document.querySelector('#txtTitulo').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let strDescCorta = document.querySelector('#txtDescripCorta').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strTitulo == '' || strDescripcion == '' || strDescCorta == '' || intStatus == '') {

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
            let ajaxUrl = base_url + 'pagepaquetes/setData';
            let formData = new FormData(formPaquete);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        if (rowTable == 0) {
                            tablePaquetes.ajax.reload(function() {
                                $('#modalFormPaquete').modal('hide');
                            });
                        } else {
                            tablePaquetes.ajax.reload(function() {
                                $('#modalFormPaquete').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tablePaquetes.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formPaquete.reset();
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
    let ajaxUrl = base_url + 'pagepaquetes/uploadImages';
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
    let ajaxUrl = base_url + 'pagepaquetes/deleteImages';
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

function fntViewPaquete(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pagepaquetes/getPaquete/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { descripcion, descripcion_corta, duracion, horario, idpaquete, imagen, link_ecommerce, statuspaquete, titulo, url_portada } = objData.data;

                let estado = statuspaquete == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML          = idpaquete;
                document.querySelector("#celImg").innerHTML         = '<img src="' + url_portada + '" alt="" class="img-fluid" style="heigth:50%; width:50%;" />';
                document.querySelector("#celTitulo").innerHTML      = titulo;
                document.querySelector("#celDescripcion").innerHTML = descripcion;
                document.querySelector("#celDescCorta").innerHTML   = descripcion_corta;
                document.querySelector("#celDuracion").innerHTML    = duracion;
                document.querySelector("#celHorario").innerHTML     = horario;
                document.querySelector("#celLink").innerHTML        = link_ecommerce;
                document.querySelector("#celEstado").innerHTML      = estado;

                let modalViewPaquete = new bootstrap.Modal(document.getElementById('modalViewPaquete'), {});
                modalViewPaquete.show();

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

function fntEditPaquete(id) {

    rowTable = tablePaquetes.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Paquete";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pagepaquetes/getPaquete/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { descripcion, descripcion_corta, duracion, horario, idpaquete, imagen, link_ecommerce, statuspaquete, titulo, url_portada } = objData.data;
                
                document.querySelector("#idPaquete").value    = idpaquete;
                document.querySelector('#foto_actual').value  = imagen;
                document.querySelector("#foto_remove").value  = 0;
                document.querySelector('#txtTitulo').value    = titulo;
                $('#txtDescripcion').summernote('code', descripcion);
                document.querySelector('#txtDescripCorta').value  = descripcion_corta;
                document.querySelector('#txtDuracion').value  = duracion;
                document.querySelector('#txtHorario').value   = horario;
                document.querySelector('#txtEcommerce').value = link_ecommerce;

                if (statuspaquete == 1) {
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

                $('#modalFormPaquete').modal('show');

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

function fntDelPaquete(id) {

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
                let ajaxUrl = base_url + 'pagepaquetes/delData';
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
                            tablePaquetes.ajax.reload();

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
    document.querySelector('#formPaquete').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Paquete";
    document.querySelector("#formPaquete").reset();
    $('#txtDescripcion').summernote('code', '');

    let modalFormPaquete = new bootstrap.Modal(document.getElementById('modalFormPaquete'), {});
    modalFormPaquete.show();

    let myModal = document.getElementById('modalFormPaquete');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

    removePhoto();
}