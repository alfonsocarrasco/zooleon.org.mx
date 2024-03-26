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
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img2" class="img-fluid" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 640 || this.height != 720) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (640x720)px.'
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
                    document.querySelector('.prevPhotoPrivacidad div').innerHTML = '<img id="img3" class="img-fluid" src="' + objeto_url + '">';

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

    if (document.querySelector("#foto4")) {

        let foto4 = document.querySelector("#foto4");
        foto4.onchange = function(event) {

            let uploadFoto = document.querySelector("#foto4").value;
            let fileimg = document.querySelector("#foto4").files;
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

                    if (document.querySelector('#img4')) {
                        document.querySelector('#img4').remove();
                    }

                    document.querySelector('.delPhoto4').classList.add('notBlock');
                    foto4.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img4')) {
                        document.querySelector('#img4').remove();
                    }

                    document.querySelector('.delPhoto4').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoAcreditaciones div').innerHTML = '<img id="img4" class="img-fluid" src="' + objeto_url + '">';

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
    
                        if (document.querySelector('#img4')) {
                            document.querySelector('#img4').remove();
                        }
    
                        document.querySelector('.delPhoto4').classList.add("notBlock");
                        foto4.value = "";
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

                if (document.querySelector('#img4')) {
                    document.querySelector('#img4').remove();
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
            document.querySelector('#foto_remove_contamos').value = 1;
            removePhotoContamos();
        }
    }
    
    if (document.querySelector(".delPhoto3")) {
        let delPhoto = document.querySelector(".delPhoto3");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallaxUno').value = 1;
            removePhotoParallaxUno();
        }
    }
    
    if (document.querySelector(".delPhoto4")) {
        let delPhoto = document.querySelector(".delPhoto4");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallaxDos').value = 1;
            removePhotoParallaxDos();
        }
    }

    if (document.querySelector("#formHistoria")) {

        let formHistoria = document.querySelector("#formHistoria");
        formHistoria.onsubmit = function(e) {
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
            let ajaxUrl = base_url + 'historia/setDataHistoria';
            let formData = new FormData(formHistoria);
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
                        $('#modalFormHistoria').modal('hide');
                        fntViewHistoria();
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

    fntViewHistoria();

}, false);

$('#txtDescripcion, #txtDescripcionContamos, #txtAntecedentes').summernote({
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
    let ajaxUrl = base_url + 'historia/uploadImages';
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
    let ajaxUrl = base_url + 'historia/deleteImages';
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

function fntViewHistoria() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'historia/getDataHistoria/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { antecedentes_h, descripcion_contamos_h, descripcion_h, idhistoria, numero_animales_h, numero_especies_h, numero_personas_h, portada_contamos, portada_parallax1, portada_parallax2, portada_url, statushistoria, titulo_animales_h, titulo_contamos_h, titulo_especies_h, titulo_historia, titulo_personas_h } = objData.data;

                let descripcion = descripcion_h.substr(0, 450) + ' ...';
                let status = statushistoria == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                if (document.querySelector('.edit')) {
                    document.querySelector('.edit').innerHTML = '<button type="button" class="btn btn-dark btn-ecom" onclick="fntEditHistoria('+ idhistoria +');"><i class="fa-solid fa-pen-to-square"></i> Editar</button>';
                }
                
                document.querySelector('.title').innerHTML            = titulo_historia;
                document.querySelector('.portadaH').innerHTML         = '<img class="img-fluid" src="' + portada_url + '" alt="" />';
                document.querySelector('.antecedentes').innerHTML     = antecedentes_h;
                document.querySelector('.description').innerHTML      = descripcion;
                document.querySelector('.titleContamos').innerHTML    = titulo_contamos_h;
                document.querySelector('.descripContamos').innerHTML  = descripcion_contamos_h;
                document.querySelector('.img_contamos').innerHTML     = '<img class="img-fluid" src="' + portada_contamos + '" width="320" height="360" alt="" />';
                document.querySelector('.titleNumAnimals').innerHTML  = titulo_animales_h;
                document.querySelector('.numAnimales').innerHTML      = numero_animales_h;
                document.querySelector('.titleNumEspecies').innerHTML = titulo_especies_h;
                document.querySelector('.numEspecies').innerHTML      = numero_especies_h;
                document.querySelector('.titleNumPer').innerHTML      = titulo_personas_h;
                document.querySelector('.numPer').innerHTML           = numero_personas_h;
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

function fntEditHistoria(id) {

    document.querySelector('#titleModal').innerHTML = 'Actualizar Historia';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'historia/getDataHistoria/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { antecedentes_h, descripcion_contamos_h, descripcion_h, idhistoria, numero_animales_h, numero_especies_h, numero_personas_h, parallax_dos, parallax_uno, portada_contamos, portada_contamos_h, portada_historia, portada_parallax1, portada_parallax2, portada_url, statushistoria, titulo_animales_h, titulo_contamos_h, titulo_especies_h, titulo_historia, titulo_personas_h } = objData.data;
                
                document.querySelector('#idHistoria').value           = idhistoria;
                document.querySelector('#txtTitulo').value            = titulo_historia;
                document.querySelector('#txtTituloNumAnimales').value = titulo_animales_h;
                document.querySelector('#txtNumAnimales').value       = numero_animales_h;
                document.querySelector('#txtTituloNumEspecies').value = titulo_especies_h;
                document.querySelector('#txtNumEspecies').value       = numero_especies_h;
                document.querySelector('#txtTituloNumPersonas').value = titulo_personas_h;
                document.querySelector('#txtNumPersonas').value       = numero_personas_h;
                document.querySelector('#txtTituloContamos').value    = titulo_contamos_h;
                document.querySelector('#foto_actual').value = portada_historia;
                document.querySelector('#foto_remove').value = 0;
                document.querySelector('#foto_actual_contamos').value = portada_contamos_h;
                document.querySelector('#foto_remove_contamos').value = 0;
                document.querySelector('#foto_actual_parallaxUno').value = parallax_uno;
                document.querySelector('#foto_remove_parallaxUno').value = 0;
                document.querySelector('#foto_actual_parallaxDos').value = parallax_dos;
                document.querySelector('#foto_remove_parallaxDos').value = 0;

                $('#txtDescripcion').summernote('code', descripcion_h);
                $('#txtDescripcionContamos').summernote('code', descripcion_contamos_h);
                $('#txtAntecedentes').summernote('code', antecedentes_h);

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = portada_url;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + portada_url + '">';
                }
                
                if (document.querySelector('#img2')) {
                    document.querySelector('#img2').src = portada_contamos;
                } else {
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img" src="' + portada_contamos + '">';
                }
                
                if (document.querySelector('#img3')) {
                    document.querySelector('#img3').src = portada_parallax1;
                } else {
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img" src="' + portada_parallax1 + '">';
                }
                
                if (document.querySelector('#img4')) {
                    document.querySelector('#img4').src = portada_parallax2;
                } else {
                    document.querySelector('.prevPhotoContamos div').innerHTML = '<img id="img" src="' + portada_parallax2 + '">';
                }

                if (portada_historia == 'portada_categoria.jpg' || portada_historia == '') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                
                if (portada_contamos_h == 'portada_categoria.jpg' || portada_contamos_h == '') {
                    document.querySelector('.delPhoto2').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto2').classList.remove("notBlock");
                }
                
                if (parallax_uno == 'portada_categoria.jpg' || parallax_uno == '') {
                    document.querySelector('.delPhoto3').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto3').classList.remove("notBlock");
                }
                
                if (parallax_dos == 'portada_categoria.jpg' || parallax_dos == '') {
                    document.querySelector('.delPhoto4').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto4').classList.remove("notBlock");
                }

                if (statushistoria == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                let modalHistoria = new bootstrap.Modal(document.getElementById('modalFormHistoria'), {});
                modalHistoria.show();

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

function removePhotoContamos() {
    document.querySelector('#foto2').value = "";
    document.querySelector('.delPhoto2').classList.add("notBlock");
    if (document.querySelector('#img2')) {
        document.querySelector('#img2').remove();
    }
}

function removePhotoParallaxUno() {
    document.querySelector('#foto3').value = "";
    document.querySelector('.delPhoto3').classList.add("notBlock");
    if (document.querySelector('#img3')) {
        document.querySelector('#img3').remove();
    }
}

function removePhotoParallaxDos() {
    document.querySelector('#foto4').value = "";
    document.querySelector('.delPhoto4').classList.add("notBlock");
    if (document.querySelector('#img4')) {
        document.querySelector('#img4').remove();
    }
}

function openModal() {

    document.querySelector('#formHistoria').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar Historia";
    document.querySelector("#formHistoria").reset();
    $('#txtDescripcion').summernote('code', '');
    $('#txtDescripcionContamos').summernote('code', '');
    $('#txtAntecedentes').summernote('code', '');

    let modalHistoria = new bootstrap.Modal(document.getElementById('modalFormHistoria'), {});
    modalHistoria.show();

    let myModal = document.getElementById('modalFormHistoria');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}