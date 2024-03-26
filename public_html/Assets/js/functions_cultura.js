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
    
    if (document.querySelector("#foto2")) {

        let foto2 = document.querySelector("#foto2");
        foto2.onchange = function(event) {

            let uploadFoto = document.querySelector("#foto2").value;
            let fileimg = document.querySelector("#foto2").files;
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

                    if (document.querySelector('#img2')) {
                        document.querySelector('#img2').remove();
                    }

                    document.querySelector('.delPhoto2').classList.add('notBlock');
                    foto2.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img2')) {
                        document.querySelector('#img2').remove();
                    }

                    document.querySelector('.delPhoto2').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoPrivacidad div').innerHTML = '<img id="img2" class="img-fluid" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 1920 || this.height != 1000) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (1920x1000)px.'
                        });
    
                        if (document.querySelector('#img2')) {
                            document.querySelector('#img2').remove();
                        }
    
                        document.querySelector('.delPhoto2').classList.add("notBlock");
                        foto2.value = "";
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

                if (document.querySelector('#img2')) {
                    document.querySelector('#img2').remove();
                }

            }
        }
    }

    if (document.querySelector("#foto3")) {

        let foto3 = document.querySelector("#foto3");
        foto3.onchange = function(event) {

            let uploadFoto = document.querySelector("#foto3").value;
            let fileimg = document.querySelector("#foto3").files;
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

                    if (document.querySelector('#img3')) {
                        document.querySelector('#img3').remove();
                    }

                    document.querySelector('.delPhoto3').classList.add('notBlock');
                    foto3.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img3')) {
                        document.querySelector('#img3').remove();
                    }

                    document.querySelector('.delPhoto3').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoAcreditaciones div').innerHTML = '<img id="img3" class="img-fluid" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 1920 || this.height != 1000) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (1920x1000)px.'
                        });
    
                        if (document.querySelector('#img3')) {
                            document.querySelector('#img3').remove();
                        }
    
                        document.querySelector('.delPhoto3').classList.add("notBlock");
                        foto3.value = "";
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

                if (document.querySelector('#img3')) {
                    document.querySelector('#img3').remove();
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
    
    if (document.querySelector(".delPhoto2")) {
        let delPhoto = document.querySelector(".delPhoto2");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallaxUno').value = 1;
            removePhotoParallaxUno();
        }
    }
    
    if (document.querySelector(".delPhoto3")) {
        let delPhoto = document.querySelector(".delPhoto3");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallaxDos').value = 1;
            removePhotoParallaxDos();
        }
    }

    if (document.querySelector("#formCultura")) {

        let formCultura = document.querySelector("#formCultura");
        formCultura.onsubmit = function(e) {
            e.preventDefault();

            let strTitulo = document.querySelector('#txtTitulo').value;
            let strMision = document.querySelector('#txtMision').value;
            let strVision = document.querySelector('#txtVision').value;
            let strValores = document.querySelector('#txtValores').value;
            let strTituloMision = document.querySelector('#txtTituloMision').value;
            let strTituloVision = document.querySelector('#txtTituloVision').value;
            let strTituloValores = document.querySelector('#txtTituloValores').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strTitulo === '' || strMision === '' || strVision === '' || strValores === '' || strTituloMision === '' || strTituloVision === '' || strTituloValores === '' || intStatus === '') {

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
            let ajaxUrl = base_url + 'cultura/setData';
            let formData = new FormData(formCultura);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
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
                        $('#modalFormCultura').modal('hide');
                        fntViewCultura();
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

    fntViewCultura();

}, false);

$('#txtMision, #txtVision, #txtValores').summernote({
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
    let ajaxUrl = base_url + 'cultura/uploadImages';
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
    let ajaxUrl = base_url + 'cultura/deleteImages';
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

function fntViewCultura() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'cultura/getData/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { idcultura, mision, portada_url, portada_parallax1, portada_parallax2, valores, vision, statuscultura, titulo, titulo_mision, titulo_valores, titulo_vision } = objData.data;

                let status = statuscultura == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                if (document.querySelector('.edit')) {
                    document.querySelector('.edit').innerHTML = '<button type="button" class="btn btn-dark btn-ecom" onclick="fntEditCultura('+ idcultura +');"><i class="fa-solid fa-pen-to-square"></i> Editar</button>';
                }
                
                document.querySelector('.title').innerHTML            = titulo;
                document.querySelector('.portadaH').innerHTML         = '<img class="img-fluid" src="' + portada_url + '" alt="" />';
                document.querySelector('.mision').innerHTML           = mision;
                document.querySelector('.titleMision').innerHTML      = titulo_mision;
                document.querySelector('.vision').innerHTML           = vision;
                document.querySelector('.titleVision').innerHTML      = titulo_vision;
                document.querySelector('.titleValores').innerHTML     = titulo_valores;
                document.querySelector('.valores').innerHTML          = valores;
                document.querySelector('.parallax1').innerHTML        = '<img class="img-fluid" src="' + portada_parallax1 + '" alt="" />';
                document.querySelector('.parallax2').innerHTML        = '<img class="img-fluid" src="' + portada_parallax2 + '" alt="" />';
                document.querySelector('.status').innerHTML           = status;

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
                openModal();
            }
        }
    }
}

function fntEditCultura(id) {

    document.querySelector('#titleModal').innerHTML = 'Actualizar Cultura Zooleon';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'cultura/getData/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idcultura, mision, parallax1, parallax2, portada, portada_url, portada_parallax1, portada_parallax2, valores, vision, statuscultura, titulo, titulo_mision, titulo_valores, titulo_vision } = objData.data;
                
                document.querySelector('#idCultura').value               = idcultura;
                document.querySelector('#txtTitulo').value               = titulo;
                document.querySelector('#txtTituloMision').value         = titulo_mision;
                document.querySelector('#txtMision').value               = mision;
                document.querySelector('#txtTituloVision').value         = titulo_vision;
                document.querySelector('#txtVision').value               = vision;
                document.querySelector('#txtTituloValores').value        = titulo_valores;
                document.querySelector('#txtValores').value              = valores;
                document.querySelector('#foto_actual').value             = portada;
                document.querySelector('#foto_remove').value             = 0;
                document.querySelector('#foto_actual_parallaxUno').value = parallax1;
                document.querySelector('#foto_remove_parallaxUno').value = 0;
                document.querySelector('#foto_actual_parallaxDos').value = parallax2;
                document.querySelector('#foto_remove_parallaxDos').value = 0;

                $('#txtMision').summernote('code', mision);
                $('#txtVision').summernote('code', vision);
                $('#txtValores').summernote('code', valores);

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = portada_url;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + portada_url + '">';
                }
                
                if (document.querySelector('#img2')) {
                    document.querySelector('#img2').src = portada_parallax1;
                } else {
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img" src="' + portada_parallax1 + '">';
                }
                
                if (document.querySelector('#img3')) {
                    document.querySelector('#img3').src = portada_parallax2;
                } else {
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img" src="' + portada_parallax2 + '">';
                }

                if (portada == 'portada_categoria.jpg' || portada == '') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                
                if (parallax1 == 'portada_categoria.jpg' || parallax1 == '') {
                    document.querySelector('.delPhoto2').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto2').classList.remove("notBlock");
                }
                
                if (parallax2 == 'portada_categoria.jpg' || parallax2 == '') {
                    document.querySelector('.delPhoto3').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto3').classList.remove("notBlock");
                }

                if (statuscultura == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                let modalFormCultura = new bootstrap.Modal(document.getElementById('modalFormCultura'), {});
                modalFormCultura.show();

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

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function removePhotoParallaxUno() {
    document.querySelector('#foto2').value = "";
    document.querySelector('.delPhoto2').classList.add("notBlock");
    if (document.querySelector('#img2')) {
        document.querySelector('#img2').remove();
    }
}

function removePhotoParallaxDos() {
    document.querySelector('#foto3').value = "";
    document.querySelector('.delPhoto3').classList.add("notBlock");
    if (document.querySelector('#img3')) {
        document.querySelector('#img3').remove();
    }
}

function openModal() {

    document.querySelector('#formCultura').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar Cultura Zooleon";
    document.querySelector("#formCultura").reset();
    $('#txtMision').summernote('code', '');
    $('#txtVision').summernote('code', '');
    $('#txtValores').summernote('code', '');

    let modalFormCultura = new bootstrap.Modal(document.getElementById('modalFormCultura'), {});
    modalFormCultura.show();

    let myModal = document.getElementById('modalFormCultura');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}