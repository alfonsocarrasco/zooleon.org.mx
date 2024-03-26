let divLoading = document.querySelector('#divLoading');

document.addEventListener('DOMContentLoaded', function() {

    if (document.querySelector("#foto")) {

        let foto = document.querySelector("#foto");
        foto.onchange = function(e) {

            let uploadFoto = this.value;
            let fileimg = this.files;
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

                }  else {

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
                    if (this.width.toFixed(0) != 1920 && this.height.toFixed(0) != 1000) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (1920x1000)px.'
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
                    foto2.value = '';
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
                    if (this.width != 960 || this.height != 773) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (960x773)px.'
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
            document.querySelector('#foto_remove_pallxd').value = 1;
            removePhotoContamos();
        }
    }
    
    if (document.querySelector(".delPhoto3")) {
        let delPhoto = document.querySelector(".delPhoto3");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_acredita').value = 1;
            removePhotoAcred();
        }
    }

    if (document.querySelector("#formInfoGral")) {

        let formInfoGral = document.querySelector("#formInfoGral");
        formInfoGral.onsubmit = function(e) {
            e.preventDefault();

            let strApertura     = document.querySelector('#txtDias').value;
            let strHrApertura   = document.querySelector('#txtHorarioApertura').value;
            let strHrCierre     = document.querySelector('#txtHorarioCierre').value;
            let strTitleContact = document.querySelector('#txtTituloContacto').value;
            let strTelefono     = document.querySelector('#txtTelefono').value;
            let strEmail        = document.querySelector('#txtEmail').value;
            let strDireccion    = document.querySelector('#txtDireccion').value;
            let intStatus       = document.querySelector('#listStatus').value;

            if (strApertura == '' || strHrApertura == '' || strHrCierre == '' || strTitleContact == '' || strTelefono == '' || strEmail == '' || strDireccion == '' || intStatus == '') {

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
            let ajaxUrl = base_url + 'infogeneral/setDataInfoGral';
            let formData = new FormData(formInfoGral);
            request.open("POST", ajaxUrl, true);
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
                        $('#modalFormInfoGral').modal('hide');
                        fntViewInfoGral();
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

    fntViewInfoGral();

}, false);

function fntViewInfoGral() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'infogeneral/getDataInfoGral/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                
                const { desc_linea_dos, desc_linea_uno, dias_apertura, dias_cierre, direccion, email, facebook, horario_apertura, horario_cierre, id, img_acreditaciones, img_parallax_dos, img_parallax_uno, instagram, linea_dos, linea_uno, name_especieinfogral, name_scieninfogral, statusinfogral, telefono, tiktok, title_contacto, title_transporte, twitter, url_portada, url_portada_acreditaciones, url_portada_parallaxdos, youtube } = objData.data;

                let status = statusinfogral == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                if (document.querySelector('.edit')) {
                    document.querySelector('.edit').innerHTML = '<a href="javascript:;" class="btn btn-dark" onclick="fntEditInfoGral('+ id +');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>';
                }

                document.querySelector('.dias').innerHTML             = dias_apertura;
                document.querySelector('.cierre').innerHTML           = dias_cierre;
                document.querySelector('.horario').innerHTML          = horario_apertura + ' - ' + horario_cierre;
                document.querySelector('.titulo').innerHTML           = title_contacto;
                document.querySelector('.nameespecie').innerHTML      = name_especieinfogral;
                document.querySelector('.namescie').innerHTML         = name_scieninfogral;
                document.querySelector('.tituloTransporte').innerHTML = title_transporte;
                document.querySelector('.tlineauno').innerHTML        = linea_uno;
                document.querySelector('.dlineauno').innerHTML        = desc_linea_uno;
                document.querySelector('.tlineados').innerHTML        = linea_dos;
                document.querySelector('.dlineados').innerHTML        = desc_linea_dos;
                document.querySelector('.dir').innerHTML              = direccion;
                document.querySelector('.tel').innerHTML              = telefono;
                document.querySelector('.mail').innerHTML             = email;
                document.querySelector(".facebook").innerHTML         = facebook;
                document.querySelector(".instagram").innerHTML        = instagram;
                document.querySelector(".twitter").innerHTML          = twitter;
                document.querySelector(".youtube").innerHTML          = youtube;
                document.querySelector(".tiktok").innerHTML           = tiktok;
                document.querySelector('.status').innerHTML           = status;

                
                img_parallax_uno == 'portada_categoria.jpg' ? document.querySelector('.imgEspecie').innerHTML = '<img src="' + url_portada +'" class="img-fluid" alt="">' : document.querySelector('.imgEspecie').innerHTML = '<img src="' + url_portada +'" class="img-fluid" alt="">';
                // document.querySelector('.user-profile-avatar').innerHTML = '<img src="'+ url_portada +'" alt="" />';
                
                img_parallax_dos == 'portada_categoria.jpg' ? document.querySelector('.imgEspecieDos').innerHTML = '<img src="' + url_portada_parallaxdos +'" class="img-fluid" alt="">' : document.querySelector('.imgEspecieDos').innerHTML = '<img src="' + url_portada_parallaxdos +'" class="img-fluid" alt="">';
                
                img_acreditaciones == 'portada_categoria.jpg' ? document.querySelector('.imgAcreditaciones').innerHTML = '<img src="' + url_portada_acreditaciones +'" class="img-fluid" alt="">' : document.querySelector('.imgAcreditaciones').innerHTML = '<img src="' + url_portada_acreditaciones +'" class="img-fluid" style="width: 30%;" alt="">';

            } else {
                openModal();
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

function fntEditInfoGral(id) {

    document.querySelector('#titleModal').innerHTML = 'Actualizar Información General';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'infogeneral/getDataInfoGral/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { desc_linea_dos, desc_linea_uno, dias_apertura, direccion, email, facebook, horario_apertura, horario_cierre, id, img_acreditaciones, img_parallax_dos, img_parallax_uno, instagram, linea_dos, linea_uno, name_especieinfogral, name_scieninfogral, statusinfogral, telefono, tiktok, title_contacto, title_transporte, twitter, url_portada, url_portada_acreditaciones, url_portada_parallaxdos, youtube } = objData.data;

                let status = statusinfogral;
                
                document.querySelector('#idInfoGral').value           = id;
                document.querySelector('#txtDias').value              = dias_apertura;
                document.querySelector('#foto_actual').value          = img_parallax_uno;
                document.querySelector('#foto_remove').value          = 0;
                document.querySelector('#foto_actual_pallxd').value   = img_parallax_dos;
                document.querySelector('#foto_remove_pallxd').value   = 0;
                document.querySelector('#foto_actual_acredita').value = img_acreditaciones;
                document.querySelector('#foto_remove_acredita').value = 0;

                document.querySelector('#txtHorarioApertura').value = horario_apertura;
                document.querySelector('#txtHorarioCierre').value   = horario_cierre;

                document.querySelector('#txtNameEspecie').value     = name_especieinfogral;
                document.querySelector('#txtNameScien').value       = name_scieninfogral;

                document.querySelector('#txtTituloContacto').value  = title_contacto;
                document.querySelector('#txtTelefono').value        = telefono;
                document.querySelector('#txtEmail').value           = email;
                document.querySelector('#txtDireccion').value       = direccion;
                
                document.querySelector('#txtTituloLinea').value     = title_transporte;
                document.querySelector('#txtTituloLineaUno').value  = linea_uno;
                document.querySelector('#txtDescripLineaUno').value = desc_linea_uno;
                document.querySelector('#txtTituloLineaDos').value  = linea_dos;
                document.querySelector('#txtDescripLineDos').value  = desc_linea_dos;

                document.querySelector('#txtFacebook').value        = facebook;
                document.querySelector('#txtInstagram').value       = instagram;
                document.querySelector('#txtTwitter').value         = twitter;
                document.querySelector('#txtYoutube').value         = youtube;
                document.querySelector('#txtTiktok').value          = tiktok;

                if (status == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '">';
                }
                
                if (document.querySelector('#img2')) {
                    document.querySelector('#img2').src = url_portada_parallaxdos;
                } else {
                    document.querySelector('.prevPhotoPrivacidad div').innerHTML = '<img id="img" src="' + url_portada_parallaxdos + '">';
                }
                
                if (document.querySelector('#img3')) {
                    document.querySelector('#img3').src = url_portada_acreditaciones;
                } else {
                    document.querySelector('.prevPhotoAcreditaciones div').innerHTML = '<img id="img" src="' + url_portada_acreditaciones + '">';
                }

                if (img_parallax_uno == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                
                if (img_parallax_dos == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto2').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto2').classList.remove("notBlock");
                }
                
                if (img_acreditaciones == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto3').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto3').classList.remove("notBlock");
                }

                let modalFormInfoGral = new bootstrap.Modal(document.getElementById('modalFormInfoGral'), {});
                modalFormInfoGral.show();

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

function removePhotoAcred() {
    document.querySelector('#foto3').value = "";
    document.querySelector('.delPhoto3').classList.add("notBlock");
    if (document.querySelector('#img3')) {
        document.querySelector('#img3').remove();
    }
}

function openModal() {

    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar Información General";
    document.querySelector("#formInfoGral").reset();

    let modalFormInfoGral = new bootstrap.Modal(document.getElementById('modalFormInfoGral'), {});
    modalFormInfoGral.show();

    let myModal = document.getElementById('modalFormInfoGral');
    let myInput = document.getElementById('txtDias');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}