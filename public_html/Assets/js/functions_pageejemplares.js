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
                        let msg;
                        if (this.width != 1920 || this.height != 820) msg = 'La imagen debe tener un tamaño (1920x820)px.';
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: msg
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
                    foto2.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img4')) {
                        document.querySelector('#img4').remove();
                    }

                    document.querySelector('.delPhoto4').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoEjemplares div').innerHTML = '<img id="img4" class="img-fluid" src="' + objeto_url + '">';

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
            document.querySelector('#foto_remove_parallax').value = 1;
            removePhotoParallax();
        }
    }

    if (document.querySelector(".delPhoto3")) {
        let delPhoto = document.querySelector(".delPhoto3");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallax2').value = 1;
            removePhotoParallax2();
        }
    }
    
    if (document.querySelector(".delPhoto4")) {
        let delPhoto = document.querySelector(".delPhoto4");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_parallax3').value = 1;
            removePhotoParallax3();
        }
    }
    
    // Page FAQS
    if (document.querySelector("#formPageEjemplares")) {

        let formPageEjemplares = document.querySelector("#formPageEjemplares");
        formPageEjemplares.onsubmit = function(e) {
            e.preventDefault();

            let strTitulo      = document.querySelector('#txtTitulo').value;
            let strNameEspecie = document.querySelector('#txtNameEspecie').value;
            let strNameScie    = document.querySelector('#txtNameScien').value;
            let intStatus      = document.querySelector('#listStatus').value;

            if (strTitulo == '' || strNameEspecie == '' || strNameScie == '' || intStatus == '') {

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
            let ajaxUrl = base_url + 'pageejemplares/setDataPageEjemplares';
            let formData = new FormData(formPageEjemplares);
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

                        $('#modalFormPageEjemplares').modal('hide');
                        fntViewPageEjemplares();

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

    fntViewPageEjemplares();

}, false);

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function removePhotoParallax() {
    document.querySelector('#foto2').value = "";
    document.querySelector('.delPhoto2').classList.add("notBlock");
    if (document.querySelector('#img2')) {
        document.querySelector('#img2').remove();
    }
}

function removePhotoParallax2() {
    document.querySelector('#foto3').value = "";
    document.querySelector('.delPhoto3').classList.add("notBlock");
    if (document.querySelector('#img3')) {
        document.querySelector('#img3').remove();
    }
}

function removePhotoParallax3() {
    document.querySelector('#foto4').value = "";
    document.querySelector('.delPhoto4').classList.add("notBlock");
    if (document.querySelector('#img4')) {
        document.querySelector('#img4').remove();
    }
}

// functions page faqs
function fntViewPageEjemplares() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pageejemplares/getDataPageEjemplares/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { idpageejemplares, namescie2, namescie3, namescie_pageejemplares, namespecie2, namespecie3, namespecie_pageejemplares, portada_url, portada_url_parallax, portada_url_parallax2, portada_url_parallax3, statuspageejemplares, titulo_pageejemplares } = objData.data;

                let status = statuspageejemplares == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                if (document.querySelector('.edit')) {
                    document.querySelector('.edit').innerHTML = '<button type="button" class="btn btn-dark btn-ecom" onclick="fntEditPageEjemplares('+ idpageejemplares +');"><i class="fa-solid fa-pen-to-square"></i> Editar</button>';
                }
                
                document.querySelector('.title').innerHTML            = titulo_pageejemplares;
                document.querySelector('.nameespecie').innerHTML      = namespecie_pageejemplares;
                document.querySelector('.namescientific').innerHTML   = namescie_pageejemplares;
                document.querySelector('.portadaH').innerHTML         = '<img class="img-fluid" src="' + portada_url + '" width="384" height="164" alt="" />';
                document.querySelector('.img_parallax').innerHTML     = '<img class="img-fluid" src="' + portada_url_parallax + '" width="384" height="164" alt="" />';
                document.querySelector('.nameespecie2').innerHTML     = namespecie2;
                document.querySelector('.namescientific2').innerHTML  = namescie2;
                document.querySelector('.parallax2').innerHTML        = '<img class="img-fluid" src="' + portada_url_parallax2 + '" width="384" height="164" alt="" />';
                document.querySelector('.nameespecie3').innerHTML     = namespecie3;
                document.querySelector('.namescientific3').innerHTML  = namescie3;
                document.querySelector('.parallax3').innerHTML        = '<img class="img-fluid" src="' + portada_url_parallax3 + '" width="384" height="164" alt="" />';
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
                openModalPage();
            }
        }
    }
}

function fntEditPageEjemplares(id) {

    document.querySelector('#titleModal').innerHTML = 'Actualizar Página Preguntas Frecuentes';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pageejemplares/getDataPageEjemplares/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idpageejemplares, namescie2, namescie3, namescie_pageejemplares, namespecie2, namespecie3, namespecie_pageejemplares, parallax2, parallax3, parallax_pageejemplares, portada_pageejemplares, portada_url, portada_url_parallax, portada_url_parallax2, portada_url_parallax3, statuspageejemplares, titulo_pageejemplares } = objData.data;
                
                document.querySelector('#idpageejemplares').value     = idpageejemplares;
                document.querySelector('#txtTitulo').value            = titulo_pageejemplares;
                document.querySelector('#txtNameEspecie').value       = namespecie_pageejemplares;
                document.querySelector('#txtNameScien').value         = namescie_pageejemplares;
                document.querySelector('#txtNameEspecie2').value       = namespecie2;
                document.querySelector('#txtNameScien2').value         = namescie2;
                document.querySelector('#txtNameEspecie3').value       = namespecie3;
                document.querySelector('#txtNameScien3').value         = namescie3;
                document.querySelector('#foto_actual').value          = portada_pageejemplares;
                document.querySelector('#foto_remove').value          = 0;
                document.querySelector('#foto_actual_parallax').value = parallax_pageejemplares;
                document.querySelector('#foto_remove_parallax').value = 0;
                document.querySelector('#foto_actual_parallax2').value = parallax2;
                document.querySelector('#foto_remove_parallax2').value = 0;
                document.querySelector('#foto_actual_parallax3').value = parallax3;
                document.querySelector('#foto_remove_parallax3').value = 0;

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = portada_url;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + portada_url + '">';
                }
                
                if (document.querySelector('#img2')) {
                    document.querySelector('#img2').src = portada_url_parallax;
                } else {
                    document.querySelector('.prevPhotoPrivacidad div').innerHTML = '<img id="img" src="' + portada_url_parallax + '">';
                }

                if (document.querySelector('#img3')) {
                    document.querySelector('#img3').src = portada_url_parallax2;
                } else {
                    document.querySelector('.prevPhotoAcreditaciones div').innerHTML = '<img id="img" src="' + portada_url_parallax2 + '">';
                }

                if (document.querySelector('#img4')) {
                    document.querySelector('#img4').src = portada_url_parallax3;
                } else {
                    document.querySelector('.prevPhotoEjemplares div').innerHTML = '<img id="img" src="' + portada_url_parallax3 + '">';
                }

                if (portada_pageejemplares == 'portada_categoria.jpg' || portada_pageejemplares == '') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                
                if (parallax_pageejemplares == 'portada_categoria.jpg' || parallax_pageejemplares == '') {
                    document.querySelector('.delPhoto2').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto2').classList.remove("notBlock");
                }
                
                if (parallax2 == 'portada_categoria.jpg' || parallax2 == '') {
                    document.querySelector('.delPhoto3').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto3').classList.remove("notBlock");
                }
                
                if (parallax3 == 'portada_categoria.jpg' || parallax3 == '') {
                    document.querySelector('.delPhoto4').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto4').classList.remove("notBlock");
                }

                if (statuspageejemplares == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                let modalFormPageEjemplares = new bootstrap.Modal(document.getElementById('modalFormPageEjemplares'), {});
                modalFormPageEjemplares.show();

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

function openModalPage() {

    document.querySelector('#formPageEjemplares').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar Ejemplar";
    document.querySelector("#formPageEjemplares").reset();

    let modalFormPageEjemplares = new bootstrap.Modal(document.getElementById('modalFormPageEjemplares'), {});
    modalFormPageEjemplares.show();

    let myModal = document.getElementById('modalFormPageEjemplares');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}