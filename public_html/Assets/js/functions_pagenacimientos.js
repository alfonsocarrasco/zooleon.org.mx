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
                            msg: 'La imagen debe tener un tamaño (1920x820)px.'
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

    // Page Planear Visita
    if (document.querySelector("#formPageReglamento")) {

        let formPageReglamento = document.querySelector("#formPageReglamento");
        formPageReglamento.onsubmit = function(e) {
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
            let ajaxUrl = base_url + 'pagenacimientos/setDataPage';
            let formData = new FormData(formPageReglamento);
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

                        $('#modalFormPageReglamento').modal('hide');
                        fntViewPage();

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

        fntViewPage();
    }

}, false);

// functions page planea visita
function fntViewPage() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pagenacimientos/getDataPage/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { idpagenacimientos, name_especie, name_cientifico, portada_url, portada_url_parallax, status, titulo } = objData.data;

                let statusPage = status == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                if (document.querySelector('.edit')) {
                    document.querySelector('.edit').innerHTML = '<button type="button" class="btn btn-dark btn-ecom" onclick="fntEditPage('+ idpagenacimientos +');"><i class="fa-solid fa-pen-to-square"></i> Editar</button>';
                }
                
                document.querySelector('.title').innerHTML          = titulo;
                document.querySelector('.nameespecie').innerHTML    = name_especie;
                document.querySelector('.namescientific').innerHTML = name_cientifico;
                document.querySelector('.portadaH').innerHTML       = '<img class="img-fluid" src="' + portada_url + '" width="384" height="164" alt="" />';
                document.querySelector('.img_parallax').innerHTML   = '<img class="img-fluid" src="' + portada_url_parallax + '" width="320" height="360" alt="" />';
                document.querySelector('.status').innerHTML         = statusPage;

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

function fntEditPage(id) {

    document.querySelector('#titleModal').innerHTML = 'Actualizar Página Nacimientos';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'pagenacimientos/getDataPage/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idpagenacimientos, name_especie, name_cientifico, parallax, portada, portada_url, portada_url_parallax, status, titulo } = objData.data;
                
                document.querySelector('#idpageregla').value          = idpagenacimientos;
                document.querySelector('#txtTitulo').value            = titulo;
                document.querySelector('#txtNameEspecie').value       = name_especie;
                document.querySelector('#txtNameScien').value         = name_cientifico;
                document.querySelector('#foto_actual').value          = portada;
                document.querySelector('#foto_remove').value          = 0;
                document.querySelector('#foto_actual_parallax').value = parallax;
                document.querySelector('#foto_remove_parallax').value = 0;

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

                if (portada == 'portada_categoria.jpg' || portada == '') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                
                if (parallax == 'portada_categoria.jpg' || parallax == '') {
                    document.querySelector('.delPhoto2').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto2').classList.remove("notBlock");
                }

                if (status == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                let modalFormPageReglamento = new bootstrap.Modal(document.getElementById('modalFormPageReglamento'), {});
                modalFormPageReglamento.show();

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

    document.querySelector('#formPageReglamento').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar Información Página Nacimientos";
    document.querySelector("#formPageReglamento").reset();

    let modalFormPageReglamento = new bootstrap.Modal(document.getElementById('modalFormPageReglamento'), {});
    modalFormPageReglamento.show();

    let myModal = document.getElementById('modalFormPageReglamento');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}