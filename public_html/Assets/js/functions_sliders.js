let tableSlider;
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

    tableSlider = $('#tableSlider').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'sliders/getSliders',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idslider'},
            { 'data': 'titulo' },
            { 'data': 'orden' },
            { 'data': 'statusslider' },
            { 'data': 'options' }
        ],
        'responsive': 'true',
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });
    
    if (document.querySelector("#formSlider")) {

        let formSlider = document.querySelector("#formSlider");
        formSlider.onsubmit = function(e) {
            e.preventDefault();

            let strTitulo = document.querySelector('#txtTitulo').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strTitulo == '' || intStatus == '') {

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
            let ajaxUrl = base_url + 'sliders/setSlider';
            let formData = new FormData(formSlider);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        if (rowTable == 0) {
                            tableSlider.ajax.reload(function() {
                                $('#modalFormSliders').modal('hide');
                            });
                        } else {
                            tableSlider.ajax.reload(function() {
                                $('#modalFormSliders').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableSlider.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formSlider.reset();
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

function fntViewSlider(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'sliders/getSlider/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { idslider, link, orden, statusslider, titulo, url_portada } = objData.data;

                let estado = statusslider == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML          = idslider;
                document.querySelector("#celImg").innerHTML         = '<img src="' + url_portada + '" alt="" class="img-fluid" style="heigth:50%; width:50%;" />';
                document.querySelector("#celTitulo").innerHTML      = titulo;
                document.querySelector("#celLink").innerHTML        = link;
                document.querySelector("#celOrden").innerHTML       = orden;
                document.querySelector("#celEstado").innerHTML      = estado;

                let modalViewSlider = new bootstrap.Modal(document.getElementById('modalViewSlider'), {});
                modalViewSlider.show();

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

function fntEditSlider(id) {

    rowTable = tableSlider.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Slider";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'sliders/getSlider/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idslider, imagen, link, orden, statusslider, titulo, url_portada } = objData.data;
                
                document.querySelector("#idSlider").value    = idslider;
                document.querySelector('#foto_actual').value = imagen;
                document.querySelector("#foto_remove").value = 0;
                document.querySelector('#txtTitulo').value   = titulo;
                document.querySelector('#txtLink').value     = link;

                if (statusslider === 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }

                if (orden === 0) {
                    document.querySelector('#listOrden').value = '';
                } else {
                    document.querySelector('#listOrden').value = orden;
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

                $('#modalFormSliders').modal('show');

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

function fntDelSlider(id) {

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
        msg: '¿Realmente quiere eliminar el slider?',
        title: 'Eliminar Slider',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'sliders/delSlider';
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
                            tableSlider.ajax.reload();

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
    document.querySelector('#idSlider').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Slider";
    document.querySelector("#formSlider").reset();

    let modalFormSliders = new bootstrap.Modal(document.getElementById('modalFormSliders'), {});
    modalFormSliders.show();

    let myModal = document.getElementById('modalFormSliders');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });
    
    removePhoto();
}