let tableCategorias;
let rowTable = '';
let divLoading = document.querySelector('#divLoading');
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

                img.onload = () => {
                    if (this.width != 215 || this.height != 215) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (570x380)px.'
                        });

                        if (document.querySelector('#img')) {
                            document.querySelector('#img').remove();
                        }

                        document.querySelector('.delPhoto').classList.add("notBlock");
                        foto.value = "";
                        return false;
                    }
                }
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
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }

    tableCategorias = $('#tableCategorias').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'categorias/getCategorias',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idcategoria' },
            { 'data': 'nombre_categoria' },
            { 'data': 'descripcion_categoria' },
            { 'data': 'status_categoria' },
            { 'data': 'options' }
        ],
        'resonsieve': 'true',
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });

    //NUEVA CATEGORIA
    rowTable = tableCategorias.page();
    localStorage.setItem('paginaActual', rowTable);

    let formCategoria = document.querySelector("#formCategoria");
    formCategoria.onsubmit = function(e) {
        e.preventDefault();

        let strNombre = document.querySelector('#txtNombre').value;
        let strDescripcion = document.querySelector('#txtDescripcion').value;
        let intStatus = document.querySelector('#listStatus').value;

        if (strNombre == '' || strDescripcion == '' || intStatus == '') {
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

        divLoading.style.display = 'flex';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + 'categorias/setCategoria';
        let formData = new FormData(formCategoria);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {

                let objData = JSON.parse(request.responseText);
                if (objData.status) {

                    if (rowTable == '') {
                        tableCategorias.ajax.reload(function() {
                            $('#modalFormCategorias').modal('hide');
                        });
                    } else {
                        tableCategorias.ajax.reload(function() {
                            $('#modalFormCategorias').modal('hide');
                            let pagina = localStorage.getItem('paginaActual');
                            tableCategorias.page(parseInt(pagina)).draw('page');
                            localStorage.removeItem('paginaActual');
                        });
                    }

                    formCategoria.reset();
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        icon: 'bx bx-check-circle',
                        msg: objData.msg,
                        pauseDelayOnHover: true,
                        position: 'top right',
                        rounded: true,
                        size: 'mini',
                    });
                    removePhoto();
                } else {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        icon: 'bx bx-x-circle',
                        msg: objData.msg,
                        pauseDelayOnHover: true,
                        position: 'top right',
                        rounded: true,
                        size: 'mini',
                    });
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }

}, false);

function fntViewInfo(idcategoria) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'categorias/getCategoria/' + idcategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { status_categoria, idcategoria, nombre_categoria, descripcion_categoria, url_portada } = objData.data

                let estado = status_categoria == 1 ?
                    '<span class="badge rounded-pill bg-success">Activo</span>' :
                    '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                document.querySelector("#celId").innerHTML = idcategoria;
                document.querySelector("#celNombre").innerHTML = nombre_categoria;
                document.querySelector("#celDescripcion").innerHTML = descripcion_categoria;
                document.querySelector("#celEstado").innerHTML = estado;
                document.querySelector("#imgCategoria").innerHTML = '<img src="' + url_portada + '"></img>';
                
                let modalCategoria = new bootstrap.Modal(document.getElementById('modalViewCategoria'), {});
                modalCategoria.show();

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

function fntEditInfo(idcategoria) {

    rowTable = tableCategorias.page();
    localStorage.setItem('paginaActual', rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'categorias/getCategoria/' + idcategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { idcategoria, nombre_categoria, descripcion_categoria, portada_categoria, status_categoria, url_portada } = objData.data;

                console.log(objData.data);

                document.querySelector("#idCategoria").value = idcategoria;
                document.querySelector("#txtNombre").value = nombre_categoria;
                document.querySelector("#txtDescripcion").value = descripcion_categoria;
                document.querySelector('#foto_actual').value = portada_categoria;
                document.querySelector("#foto_remove").value = 0;

                if (status_categoria == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                // $('#listStatus').selectpicker('render');

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + url_portada + ">";
                }

                if (portada_categoria == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormCategorias').modal('show');

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

function fntDelInfo(idcategoria) {

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
        msg: '¿Realmente quiere eliminar al categoría?',
        title: 'Eliminar Categoría',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'categorias/delCategoria';
                let strData = 'idCategoria=' + idcategoria;
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
                            tableCategorias.ajax.reload();

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
    document.querySelector('#foto').value = '';
    document.querySelector('.delPhoto').classList.add('notBlock');
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function openModal() {

    rowTable = '';
    document.querySelector('#idCategoria').value = '';
    document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector('#titleModal').innerHTML = 'Nueva Categoría';
    document.querySelector('#formCategoria').reset();
    removePhoto();

    let modalCategorias = new bootstrap.Modal(document.getElementById('modalFormCategorias'), {});
    modalCategorias.show();

}