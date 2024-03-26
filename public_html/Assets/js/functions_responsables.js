let tableResponsables;
let rowTable = '';
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
                    document.querySelector('.prevPhoto div').innerHTML = `<img id="img" src="${objeto_url}">`;

                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if ((this.width != 195 || this.height != 108)) {
                        let msg = 'La imagen debe tener un tamaño (330x110px)px ó (110x170)px.';

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

    if (document.querySelector(".delPhoto")) {
        let delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove').value = 1;
            removePhoto();
        }
    }

    tableResponsables = $('#tableResponsables').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': `${base_url}informacionpublica/getResponsables`,
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idresponsables' },
            { 'data': 'nombre' },
            { 'data': 'imagen' },
            { 'data': 'status' },
            { 'data': 'options' }
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 25,
        'order': [
            [0, 'desc']
        ]
    });

    if (document.querySelector("#formResponsables")) {
        let formResponsables = document.querySelector("#formResponsables");
        formResponsables.onsubmit = function(e) {
            e.preventDefault();

            let txtNombre = document.querySelector('#txtNombre').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (txtNombre == '' || intStatus == '') {

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

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = `${base_url}informacionpublica/setResponsables`;
            let formData = new FormData(formResponsables);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {

                    let objData = JSON.parse(request.responseText);

                    if (objData.status) {

                        if (rowTable == 0) {
                            tableResponsables.ajax.reload(function() {
                                $('#modalFormResponsables').modal('hide');
                            });
                        } else {
                            tableResponsables.ajax.reload(function() {
                                $('#modalFormResponsables').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableResponsables.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formResponsables.reset();
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

                divLoading.style.display = "none";
                return false;

            }
        }
    }

    // Titular
    if (document.querySelector('#formTitular')) {

        let formTitular = document.querySelector('#formTitular');
        formTitular.onsubmit = function(e) {
    
            e.preventDefault();
            
            let strNombre = document.querySelector('#txtNombreTitular').value;
            let strPuesto = document.querySelector('#txtPuesto').value;
            let intStatus = document.querySelector('#listStatusT').value;
            
            if (strNombre == '' || strPuesto == '' || intStatus == '') {
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
            let ajaxUrl = `${base_url}informacionpublica/setTitular`;
            let formData = new FormData(formTitular);
            
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
    
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Lobibox.confirm({
                            buttons: {
                                ok: {
                                    'class': 'btn btn-success'
                                }
                            },
                            closeButton: false,
                            iconClass: 'bi bi-exclamation-circle',
                            msg: objData.msg,
                            title: '',
                            width: 530,
                            callback: function($this, type, ev) {
                    
                                if (type == 'ok') {
                                    location.reload();
                                }
                            }
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
    }

    fntEditInfo(1);

}, false);

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function fntViewResponsable(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = `${base_url}informacionpublica/getResponsable/${id}`;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { idresponsables, nombre, link, status, url_portada } = objData.data;

                let estado = status == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML     = idresponsables;
                document.querySelector("#celName").innerHTML   = nombre;
                document.querySelector("#celLink").innerHTML   = link;
                document.querySelector("#celImg").innerHTML    = '<img src="' + url_portada + '" alt="" class="img-fluid" style="heigth:50%; width:50%;" />';
                document.querySelector("#celEstado").innerHTML = estado;

                let modalViewResponsable = new bootstrap.Modal(document.getElementById('modalViewResponsable'), {});
                modalViewResponsable.show();

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

function fntEditResponsable(id) {

    rowTable = tableResponsables.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = 'Actualizar Responsable';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#titleModal').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = `${base_url}informacionpublica/getResponsable/${id}`;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idresponsables, imagen, link, nombre, status, url_portada } = objData.data;
                
                document.querySelector("#idResponsable").value = idresponsables;
                document.querySelector('#txtNombre').value     = nombre;
                document.querySelector('#txtLink').value       = link;
                document.querySelector('#foto_actual').value   = imagen;
                document.querySelector("#foto_remove").value   = 0;

                if (status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = `<img id="img" src="${url_portada}">`;
                }

                if (imagen == 'portada_categoria.jpg') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormResponsables').modal('show');
            }
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
    };
}

function fntDelResponsable(id) {

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
        msg: '¿Realmente quiere eliminiar el registro?',
        title: 'Eliminar Registro',
        width: 530,
        callback: function($this, type, ev) {

            if (type == 'yes') {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = `${base_url}informacionpublica/delResponsable`;
                let strData = `id=${id}`;
                request.open("POST", ajaxUrl, true);
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
                            tableResponsables.ajax.reload();

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

function fntEditInfo(id) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = `${base_url}informacionpublica/getTitular/${id}`;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {

            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { idtitular, link, puesto, nombre, status } = objData.data;

                document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
                idtitular != 0 && (document.querySelector('#btnText').innerHTML = 'Actualizar');

                document.querySelector("#idTitular").value  = idtitular;
                document.querySelector("#txtNombreTitular").value  = nombre;
                document.querySelector("#txtPuesto").value  = puesto;
                document.querySelector("#txtTesoreria").value  = link;
                document.querySelector("#listStatusT").value = status;

            }
        }
    }
}

function openModal() {
    rowTable = '';
    document.querySelector('#idResponsable').value = '';
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Responsable";

    document.querySelector("#formResponsables").reset();

    let modalFormResponsables = new bootstrap.Modal(document.getElementById('modalFormResponsables'), {});
    modalFormResponsables.show();

    let myModal = document.getElementById('modalFormResponsables');
    let myInput = document.getElementById('txtNombre');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

    removePhoto();
}