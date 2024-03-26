let tableEjemplares;
let rowTable;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    tableEjemplares = $('#tableEjemplares').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'ejemplares/getEjemplares',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idespecie'},
            { 'data': 'nombre_especie' },
            { 'data': 'nombre_cientifico' },
            { 'data': 'orden' },
            { 'data': 'statusespecie' },
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

    if (document.querySelector('#foto2')) {

        let foto2 = document.querySelector('#foto2');
        foto2.onchange = function(e) {

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
                    document.querySelector('.prevPhotoAlimentacion div').innerHTML = '<img id="img2" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 620 || this.height != 285) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (620x285)px.'
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
            }
        }
    }

    if (document.querySelector(".delPhoto2")) {
        let delPhoto = document.querySelector(".delPhoto2");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_alimentacion').value = 1;
            removePhotoAlim();
        }
    }

    if (document.querySelector('#foto3')) {

        let foto3 = document.querySelector('#foto3');
        foto3.onchange = function(e) {

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

                    if (document.querySelector('#img3')) {
                        document.querySelector('#img3').remove();
                    }

                    document.querySelector('.delPhoto3').classList.add("notBlock");
                    foto3.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img3')) {
                        document.querySelector('#img3').remove();
                    }

                    document.querySelector('.delPhoto3').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoTamanio div').innerHTML = '<img id="img3" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 535 || this.height != 340) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (535x340)px.'
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
            }
        }
    }

    if (document.querySelector(".delPhoto3")) {
        let delPhoto = document.querySelector(".delPhoto3");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_tamanio').value = 1;
            removePhotoTamanio();
        }
    }
    
    if (document.querySelector('#foto4')) {

        let foto4 = document.querySelector('#foto4');
        foto4.onchange = function(e) {

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
                    document.querySelector('.prevPhotoPeso div').innerHTML = '<img id="img4" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 515 || this.height != 315) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (515x315)px.'
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
            }
        }
    }

    if (document.querySelector(".delPhoto4")) {
        let delPhoto = document.querySelector(".delPhoto4");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_peso').value = 1;
            removePhotoPeso();
        }
    }
    
    if (document.querySelector('#foto5')) {

        let foto5 = document.querySelector('#foto5');
        foto5.onchange = function(e) {

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

                    if (document.querySelector('#img5')) {
                        document.querySelector('#img5').remove();
                    }

                    document.querySelector('.delPhoto5').classList.add('notBlock');
                    foto5.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img5')) {
                        document.querySelector('#img5').remove();
                    }

                    document.querySelector('.delPhoto5').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoHabitat div').innerHTML = '<img id="img5" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 535 || this.height != 400) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (535x400)px.'
                        });
    
                        if (document.querySelector('#img5')) {
                            document.querySelector('#img5').remove();
                        }
    
                        document.querySelector('.delPhoto5').classList.add("notBlock");
                        foto5.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    }
    
    if (document.querySelector(".delPhoto5")) {
        let delPhoto = document.querySelector(".delPhoto5");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_habitat').value = 1;
            removePhotoHabitat();
        }
    }
    
    if (document.querySelector('#foto6')) {

        let foto6 = document.querySelector('#foto6');
        foto6.onchange = function(e) {

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

                    if (document.querySelector('#img6')) {
                        document.querySelector('#img6').remove();
                    }

                    document.querySelector('.delPhoto6').classList.add('notBlock');
                    foto6.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img6')) {
                        document.querySelector('#img6').remove();
                    }

                    document.querySelector('.delPhoto6').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoDistribucion div').innerHTML = '<img id="img6" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 635 || this.height != 465) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (635x465)px.'
                        });
    
                        if (document.querySelector('#img6')) {
                            document.querySelector('#img6').remove();
                        }
    
                        document.querySelector('.delPhoto5').classList.add("notBlock");
                        foto6.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    }

    if (document.querySelector(".delPhoto6")) {
        let delPhoto = document.querySelector(".delPhoto6");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_distribucion').value = 1;
            removePhotoDistribucion();
        }
    }
    
    if (document.querySelector('#foto7')) {

        let foto7 = document.querySelector('#foto7');
        foto7.onchange = function(e) {

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

                    if (document.querySelector('#img7')) {
                        document.querySelector('#img7').remove();
                    }

                    document.querySelector('.delPhoto7').classList.add('notBlock');
                    foto7.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img7')) {
                        document.querySelector('#img7').remove();
                    }

                    document.querySelector('.delPhoto7').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoSabias div').innerHTML = '<img id="img7" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 530 || this.height != 420) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (530x420)px.'
                        });
    
                        if (document.querySelector('#img7')) {
                            document.querySelector('#img7').remove();
                        }
    
                        document.querySelector('.delPhoto7').classList.add("notBlock");
                        foto7.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    }
    
    if (document.querySelector(".delPhoto7")) {
        let delPhoto = document.querySelector(".delPhoto7");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_sabias').value = 1;
            removePhotoSabias();
        }
    }
    
    if (document.querySelector('#foto8')) {

        let foto8 = document.querySelector('#foto8');
        foto8.onchange = function(e) {

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

                    if (document.querySelector('#img8')) {
                        document.querySelector('#img8').remove();
                    }

                    document.querySelector('.delPhoto8').classList.add('notBlock');
                    foto8.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img8')) {
                        document.querySelector('#img8').remove();
                    }

                    document.querySelector('.delPhoto8').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoConservacion div').innerHTML = '<img id="img8" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 1230 || this.height != 530) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (1230x530)px.'
                        });
    
                        if (document.querySelector('#img8')) {
                            document.querySelector('#img8').remove();
                        }
    
                        document.querySelector('.delPhoto8').classList.add("notBlock");
                        foto8.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    }
    
    if (document.querySelector(".delPhoto8")) {
        let delPhoto = document.querySelector(".delPhoto8");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_conservacion').value = 1;
            removePhotoConservacion();
        }
    }

    if (document.querySelector('#foto9')) {

        let foto9 = document.querySelector('#foto9');
        foto9.onchange = function(e) {

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

                    if (document.querySelector('#img9')) {
                        document.querySelector('#img9').remove();
                    }

                    document.querySelector('.delPhoto9').classList.add('notBlock');
                    foto9.value = '';
                    return false;

                } else {

                    if (document.querySelector('#img9')) {
                        document.querySelector('#img9').remove();
                    }

                    document.querySelector('.delPhoto9').classList.remove('notBlock');
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhotoUbicacion div').innerHTML = '<img id="img9" src="' + objeto_url + '">';

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 1920 || this.height != 943) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño de (1920x943)px.'
                        });
    
                        if (document.querySelector('#img9')) {
                            document.querySelector('#img9').remove();
                        }
    
                        document.querySelector('.delPhoto9').classList.add("notBlock");
                        foto9.value = "";
                        return false;
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    }
    
    if (document.querySelector(".delPhoto9")) {
        let delPhoto = document.querySelector(".delPhoto9");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove_ubicacion').value = 1;
            removePhotoUbicacion();
        }
    }
    
    if (document.querySelector("#formEjemplar")) {

        let arrImage = [];
        let maxImageWidth = 600;
        let maxImageHeight = 600;
    
        let myDropzone = new Dropzone('.dropzone', {
            autoProcessQueue: false,
            acceptedFiles: 'image/jpeg, image/png',
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
            maxFilesize: 2,
            maxFiles: 8,
            parallelUploads: 10,
            url: base_url,
            init: function () {
                let myDropzone = this;

                
                rowTable = tableEjemplares.page();
                localStorage.setItem('paginaActual', rowTable);
                
                let formEjemplar = document.querySelector("#formEjemplar");
                formEjemplar.onsubmit = function(e) {
                    e.preventDefault();
                    
                    myDropzone.processQueue();

                    let strNombreEsp = document.querySelector('#txtNombreEspecie').value;
                    let strNombreCie = document.querySelector('#txtNombreCientifico').value;
                    let intCategoria = document.querySelector('#listCategoria').value;
                    let intStatus = document.querySelector('#listStatus').value;

                    if (strNombreEsp == '' || strNombreCie == '' || intCategoria == '' || intStatus == '') {

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
                    let ajaxUrl = base_url + 'ejemplares/setEjemplar';
                    let formData = new FormData(formEjemplar);

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
                                    tableEjemplares.ajax.reload(function() {
                                        $('#modalFormEjemplar').modal('hide');
                                    });
                                } else {
                                    tableEjemplares.ajax.reload(function() {
                                        $('#modalFormEjemplar').modal('hide');
                                        let pagina = localStorage.getItem('paginaActual');
                                        tableNoticias.page(parseInt(pagina)).draw('page');
                                        localStorage.removeItem('paginaActual');
                                    });
                                }

                                formEjemplar.reset();

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

function fntViewEjemplar(idejemplar) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'ejemplares/getEjemplar/' + idejemplar;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { categoriaid, idespecie, image_alimentacion, image_conservacion, image_distribucion, imagen_habitat, imagen_peso, imagen_sabias, imagen_tamanio, images_especie, img_galeria, nombre_categoria, nombre_cientifico, nombre_especie, portada_especie, ruta_especie, statusespecie, titulo_video, ubicacion_img, url_imgalimentacion, url_imgconservacion, url_imgdistribucion, url_imghabitat, url_imgpeso, url_imgsabias, url_imgtamanio, url_imgubicacion, url_portada, video_especie } = objData.data;

                let status = statusespecie == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                
                document.querySelector('.nombrecat').innerHTML        = nombre_categoria;
                document.querySelector('.nombreEspecie').innerHTML    = nombre_especie;
                document.querySelector('.nombreCientifico').innerHTML = nombre_cientifico;
                
                if (imagen_tamanio != '') {
                    document.querySelector('.tamanio_img').innerHTML = `<img class="img-fluid" src="${url_imgtamanio}" alt="Imagen sabías qué?" />'`;
                }

                document.querySelector('.portadaImg').innerHTML = `<img class="img-fluid" src="${url_portada}" alt="${nombre_especie}" />'`;

                if (imagen_sabias != '') {
                    document.querySelector('.sabiasq').innerHTML = `<img class="img-fluid" src="${url_imgsabias}" alt="Imagen sabías qué?" />'`;
                }
                
                if (image_alimentacion != '') {
                    document.querySelector('.food-img').innerHTML = `<img src="${url_imgalimentacion}" class="img-fluid" alt="Imagen alimentación" />'`;
                }

                if (image_conservacion != '') {
                    document.querySelector('.conservacion').innerHTML = '<img src="' + url_imgconservacion + '" class="img-fluid" alt="" />';
                }

                if (image_distribucion != '') {
                    document.querySelector('.distribution_img').innerHTML = '<img src="' + url_imgdistribucion + '" class="img-fluid" alt="" />';
                }
                
                if (imagen_peso != '') {
                    document.querySelector('.peso_img').innerHTML = '<img src="' + url_imgpeso + '" class="img-fluid" alt="" />';
                }
                
                if (imagen_habitat != '') {
                    document.querySelector('.habitat_img').innerHTML = '<img src="' + url_imghabitat + '" class="img-fluid" alt="" />';
                }
                
                if (ubicacion_img != '') {
                    document.querySelector('.location').innerHTML = '<img src="' + url_imgubicacion + '" class="img-fluid" alt="" />';
                }

                document.querySelector('.video').innerHTML            = video_especie;
                document.querySelector('.title_v').innerHTML          = titulo_video;
                document.querySelector('.status').innerHTML           = status;
                document.querySelector('.profile-cover').setAttribute('style', 'background-image: url(' + url_portada + ');background-position:top; filter: none;');

                let imgGaleria = (images_especie != null && images_especie != '') ? img_galeria.reduce((accum, img) => {
                    return accum + '<img class="img-thumbnail" src="' + img +'" />';
                }, '') : '';

                document.querySelector('.galeria').innerHTML = imgGaleria;

                let modalEjemplar = new bootstrap.Modal(document.getElementById('modalViewEjemplar'), {});
                modalEjemplar.show();

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

function fntEditEjemplar(idejemplar) {

    rowTable = tableEjemplares.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Ejemplar";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'ejemplares/getEjemplar/' + idejemplar;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { categoriaid, coord_x, coord_y, idespecie, image_alimentacion, image_conservacion, image_distribucion, imagen_habitat, imagen_peso, imagen_sabias, imagen_tamanio, img_galeria, nombre_cientifico, nombre_especie, orden, portada_especie, statusespecie, titulo_video, ubicacion_img, url_imgalimentacion, url_imgconservacion, url_imgdistribucion, url_imghabitat, url_imgpeso, url_imgsabias, url_imgtamanio, url_imgubicacion, url_portada, video_especie } = objData.data;
                
                document.querySelector('#idEspecie').value                = idespecie;
                document.querySelector('#txtNombreEspecie').value         = nombre_especie;
                document.querySelector('#txtNombreCientifico').value      = nombre_cientifico;
                document.querySelector('#foto_actual').value              = portada_especie;
                document.querySelector('#foto_remove').value              = 0;
                document.querySelector('#foto_actual_alimentacion').value = image_alimentacion;
                document.querySelector('#foto_remove_alimentacion').value = 0;
                document.querySelector('#foto_actual_tamanio').value      = imagen_tamanio;
                document.querySelector('#foto_remove_tamanio').value      = 0;
                document.querySelector('#foto_actual_distribucion').value = image_distribucion;
                document.querySelector('#foto_remove_distribucion').value = 0;
                document.querySelector('#foto_actual_peso').value         = imagen_peso;
                document.querySelector('#foto_remove_peso').value         = 0;
                document.querySelector('#foto_actual_habitat').value      = imagen_habitat;
                document.querySelector('#foto_remove_habitat').value      = 0;
                document.querySelector('#foto_actual_sabias').value       = imagen_sabias;
                document.querySelector('#foto_remove_sabias').value       = 0;
                document.querySelector('#foto_actual_conservacion').value = image_conservacion;
                document.querySelector('#foto_remove_conservacion').value = 0;
                document.querySelector('#foto_actual_ubicacion').value    = ubicacion_img;
                document.querySelector('#foto_remove_ubicacion').value    = 0;
                document.querySelector('#txtCoordX').value                = coord_x;
                document.querySelector('#txtCoordY').value                = coord_y;
                document.querySelector('#listCategoria').value            = categoriaid;
                document.querySelector('#txtTituloVideo').value           = titulo_video;
                document.querySelector('#txtVideo').value                 = video_especie;
                document.querySelector('#intPosicion').value              = orden;

                if (img_galeria) {
                    document.querySelector('#imgGaleriaActual').value = JSON.stringify(img_galeria);
                } else {
                    document.querySelector('#imgGaleriaActual').value = '';
                }

                if (statusespecie == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '" />';
                }
                
                if (document.querySelector('#img2')) {
                    if (image_alimentacion == '') {
                        document.querySelector('#img2').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img2').src = url_imgalimentacion;
                    }
                } else {
                    document.querySelector('.prevPhotoAlimentacion div').innerHTML = '<img id="img2" src="' + url_imgalimentacion + '" />';
                }
                
                if (document.querySelector('#img3')) {
                    if (imagen_tamanio == '') {
                        document.querySelector('#img3').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img3').src = url_imgtamanio;
                    }
                } else {
                    document.querySelector('.prevPhotoTamanio div').innerHTML = '<img id="img3" src="' + url_imgtamanio + '" />';
                }
                
                if (document.querySelector('#img4')) {
                    if (imagen_peso == '') {
                        document.querySelector('#img4').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img4').src = url_imgpeso;
                    }
                } else {
                    document.querySelector('.prevPhotoPeso div').innerHTML = '<img id="img4" src="' + url_imgpeso + '" />';
                }
                
                if (document.querySelector('#img5')) {
                    if (imagen_habitat == '') {
                        document.querySelector('#img5').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img5').src = url_imghabitat;
                    }
                } else {
                    document.querySelector('.prevPhotoHabitat div').innerHTML = '<img id="img5" src="' + url_imghabitat + '" />';
                }

                if (document.querySelector('#img6')) {
                    if (image_distribucion == '') {
                        document.querySelector('#img6').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img6').src = url_imgdistribucion;
                    }
                } else {
                    document.querySelector('.prevPhotoDistribucion div').innerHTML = '<img id="img6" src="' + url_imgdistribucion + '" />';
                }
                
                if (document.querySelector('#img7')) {
                    if (imagen_sabias == '') {
                        document.querySelector('#img7').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img7').src = url_imgsabias;
                    }
                } else {
                    document.querySelector('.prevPhotoSabias div').innerHTML = '<img id="img7" src="' + url_imgsabias + '" />';
                }

                if (document.querySelector('#img8')) {
                    if (image_conservacion == '') {
                        document.querySelector('#img8').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img8').src = url_imgconservacion;
                    }
                } else {
                    document.querySelector('.prevPhotoPeso div').innerHTML = '<img id="img8" src="' + url_imgconservacion + '" />';
                }

                if (document.querySelector('#img9')) {
                    if (ubicacion_img == '') {
                        document.querySelector('#img9').src = base_url + 'Assets/images/portada_categoria.jpg';
                    } else {
                        document.querySelector('#img9').src = url_imgubicacion;
                    }
                } else {
                    document.querySelector('.prevPhotoUbicacion div').innerHTML = '<img id="img9" src="' + url_imgubicacion + '" />';
                }

                if (portada_especie == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto').classList.remove('notBlock');
                }
                
                if (image_alimentacion == 'portada_categoria.jpg' || image_alimentacion == '') {
                    document.querySelector('.delPhoto2').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto2').classList.remove('notBlock');
                }
                
                if (imagen_tamanio == 'portada_categoria.jpg' || imagen_tamanio == '') {
                    document.querySelector('.delPhoto3').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto3').classList.remove('notBlock');
                }
                
                if (imagen_peso == 'portada_categoria.jpg' || imagen_peso == '') {
                    document.querySelector('.delPhoto4').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto4').classList.remove('notBlock');
                }
                
                if (imagen_habitat == 'portada_categoria.jpg' || imagen_habitat == '') {
                    document.querySelector('.delPhoto5').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto5').classList.remove('notBlock');
                }
                
                if (image_distribucion == 'portada_categoria.jpg' || image_distribucion == '') {
                    document.querySelector('.delPhoto6').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto6').classList.remove('notBlock');
                }
                
                if (imagen_sabias == 'portada_categoria.jpg' || imagen_sabias == '') {
                    document.querySelector('.delPhoto7').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto7').classList.remove('notBlock');
                }
                
                if (image_conservacion == 'portada_categoria.jpg' || image_conservacion == '') {
                    document.querySelector('.delPhoto8').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto8').classList.remove('notBlock');
                }
                
                if (ubicacion_img == 'portada_categoria.jpg' || ubicacion_img == '') {
                    document.querySelector('.delPhoto9').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto9').classList.remove('notBlock');
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

                let modalEjemplar = new bootstrap.Modal(document.getElementById('modalFormEjemplar'), {});
                modalEjemplar.show();

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

function fntDelEjemplar(id) {
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
                let ajaxUrl = base_url + 'ejemplares/delEjemplar';
                let strData = 'idEjemplar=' + id;
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
                            tableEjemplares.ajax.reload();
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
    document.querySelector('#idEspecie').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Ejemplar";
    document.querySelector("#formEjemplar").reset();
    document.querySelector('.imgGaleria').innerHTML = '';

    let modalEjemplar = new bootstrap.Modal(document.getElementById('modalFormEjemplar'), {});
    modalEjemplar.show();
    
    removePhoto();
    removePhotoAlim();
    removePhotoTamanio();
    removePhotoDistribucion();
    removePhotoPeso();
    removePhotoHabitat();
    removePhotoSabias();
    removePhotoConservacion();
    removePhotoUbicacion()
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

function removePhotoAlim() {
    document.querySelector('#foto2').value = "";
    document.querySelector('.delPhoto2').classList.add("notBlock");
    if (document.querySelector('#img2')) {
        document.querySelector('#img2').remove();
    }
}

function removePhotoTamanio() {
    document.querySelector('#foto3').value = "";
    document.querySelector('.delPhoto3').classList.add("notBlock");
    if (document.querySelector('#img3')) {
        document.querySelector('#img3').remove();
    }
}

function removePhotoPeso() {
    document.querySelector('#foto4').value = "";
    document.querySelector('.delPhoto4').classList.add("notBlock");
    if (document.querySelector('#img4')) {
        document.querySelector('#img4').remove();
    }
}

function removePhotoHabitat() {
    document.querySelector('#foto5').value = "";
    document.querySelector('.delPhoto5').classList.add("notBlock");
    if (document.querySelector('#img5')) {
        document.querySelector('#img5').remove();
    }
}

function removePhotoDistribucion() {
    document.querySelector('#foto6').value = "";
    document.querySelector('.delPhoto6').classList.add("notBlock");
    if (document.querySelector('#img6')) {
        document.querySelector('#img6').remove();
    }
}

function removePhotoSabias() {
    document.querySelector('#foto7').value = "";
    document.querySelector('.delPhoto7').classList.add("notBlock");
    if (document.querySelector('#img7')) {
        document.querySelector('#img7').remove();
    }
}

function removePhotoConservacion() {
    document.querySelector('#foto8').value = "";
    document.querySelector('.delPhoto8').classList.add("notBlock");
    if (document.querySelector('#img8')) {
        document.querySelector('#img8').remove();
    }
}

function removePhotoUbicacion() {
    document.querySelector('#foto9').value = "";
    document.querySelector('.delPhoto9').classList.add("notBlock");
    if (document.querySelector('#img9')) {
        document.querySelector('#img9').remove();
    }
}