let tableUsuarios;
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
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + " style='width:215px; height:215px;'>";
                }

                let uploadFile = fileimg[0];
                let img = new Image();

                img.onload = function() {
                    if (this.width != 215 || this.height != 215) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-error',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La imagen debe tener un tamaño (215x215)px.'
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

    if (document.querySelector('.delPhoto')) {
        let delPhoto = document.querySelector('.delPhoto');
        delPhoto.onclick = function(e) {
            document.querySelector('#foto_remove').value = 1;
            removePhoto();
        }
    }

    if (document.querySelector('#btnUpload')) {
        let inputImg = document.getElementById('btnUpload');
        inputImg.addEventListener('click', function() {
            document.getElementById('inputImg').click();
        });
    }

    tableUsuarios = $('#tableUsuarios').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'usuarios/getUsuarios',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'iduser' },
            { 'data': 'nombre' },
            { 'data': 'primerapellido' },
            { 'data': 'segundoapellido' },
            { 'data': 'nameuser' },
            { 'data': 'nombrerol' },
            { 'data': 'statususer' },
            { 'data': 'options' }
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, "desc"]
        ]
    });

    if (document.querySelector('#formUsuario')) {

        rowTable = tableUsuarios.page();
        localStorage.setItem('paginaActual', rowTable);

        let formUsuario = document.querySelector('#formUsuario');

        formUsuario.onsubmit = function(e) {
            e.preventDefault();

            let strNombre = document.querySelector('#txtNombre').value;
            let strPrimerApellido = document.querySelector('#txtPrimerApellido').value;
            let strApellidoMat = document.querySelector('#txtSegundoApellido').value;
            let strEmail = document.querySelector('#txtMail').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intRolUsuario = document.querySelector('#listRol').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (strNombre == '' || strPrimerApellido == '' || strEmail == '' || intRolUsuario == '' || intStatus == '') {
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

            let elementsValid = document.getElementsByClassName('valid');
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal('Atención', 'Verifique los campos incorrectos.', 'error');
                    return false;
                }
            }

            divLoading.style.display = 'flex';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'usuarios/setUsuario';
            let formData = new FormData(formUsuario);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == 0) {
                            tableUsuarios.ajax.reload(function() {
                                $('#modalFormUsuario').modal('hide');
                            });
                        } else {
                            tableUsuarios.ajax.reload(function() {
                                $('#modalFormUsuario').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableUsuarios.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formUsuario.reset();
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
        };
    }

    // Actualizar Perfil
    if (document.querySelector('#formPerfil')) {
        let formPerfil = document.querySelector('#formPerfil');
        formPerfil.onsubmit = function(e) {
            e.preventDefault();

            let strNombre = document.querySelector('#txtNombre').value;
            let strApellidoPat = document.querySelector('#txtPrimerApellido').value;
            let strApellidoMat = document.querySelector('#txtSegundoApellido').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            if (strNombre == '' || strApellidoPat == '') {
                Lobibox.notify('error', {
                    continueDelayOnInactiveTab: false,
                    icon: 'bx bx-x-circle',
                    msg: 'Todos los campos son obligatorios.',
                    pauseDelayOnHover: true,
                    position: 'top right',
                    rounded: true,
                    size: 'mini',
                    sound: false
                });
                return false;
            }

            if (strPassword != '' || strPasswordConfirm != '') {
                if (strPassword != strPasswordConfirm) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        icon: 'bx bx-x-circle',
                        msg: 'Las contraseñas no son iguales.',
                        pauseDelayOnHover: true,
                        position: 'top right',
                        rounded: true,
                        size: 'mini',
                        sound: false
                    });
                    return false;
                }
                if (strPassword.length < 8) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        icon: 'bx bx-x-circle',
                        msg: 'La contraseña debe tener un mínimo de 8 caracteres.',
                        pauseDelayOnHover: true,
                        position: 'top right',
                        rounded: true,
                        size: 'mini',
                        sound: false
                    });
                    return false;
                }
            }

            let elementsValid = document.getElementsByClassName('valid');
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal('Atención', 'Verifique los campos incorrectos.', 'error');
                    return false;
                }
            }

            divLoading.style.display = 'flex';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'usuarios/putPerfil';
            let formData = new FormData(formPerfil);
            request.open('POST', ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {

                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal('hide');
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
                            continueDelayOnInactiveTab: false,
                            icon: 'bx bx-x-circle',
                            msg: objData.msg,
                            pauseDelayOnHover: true,
                            position: 'top right',
                            rounded: true,
                            size: 'mini',
                            sound: false
                            
                        });
                    }
                }
                divLoading.style.display = 'none';
                return false;
            }
        };
    }
}, false);

window.addEventListener('load', function() {
    fntRolesUsuario();
}, false);

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function fntRolesUsuario() {
    if (document.querySelector('#listRol')) {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + 'roles/getSelectRoles';
        request.open('GET', ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRol').innerHTML = request.responseText;
                // $('#listRol').selectpicker('render');
            }
        };
    }
}

function fntViewUsuario(idusuario) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'usuarios/getUsuario/' + idusuario;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                let estadoUsuario = objData.data.statususer == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector('#celFoto').innerHTML = '<img src="' + objData.data.url_portada + '">';
                document.querySelector('#celNombre').innerHTML = objData.data.nombre;
                document.querySelector('#celAP').innerHTML = objData.data.primerapellido;
                document.querySelector('#celAM').innerHTML = objData.data.segundoapellido;
                document.querySelector('#celUser').innerHTML = objData.data.nameuser;
                document.querySelector('#celRol').innerHTML = objData.data.nombrerol;
                document.querySelector('#celStatus').innerHTML = estadoUsuario;
                document.querySelector('#celDate').innerHTML = objData.data.fechaRegistro;

                let modalUsuario = new bootstrap.Modal(document.getElementById('modalViewUser'), {});
                modalUsuario.show();

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
    };
}

function fntEditUsuario(idusuario) {

    rowTable = tableUsuarios.page();
    localStorage.setItem('paginaActual', rowTable);

    document.querySelector('#titleModal').innerHTML = 'Actualizar Usuario';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'usuarios/getUsuario/' + idusuario;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const {iduser, idrol, nombre, primerapellido, segundoapellido, nameuser, imguser, statususer, url_portada} = objData.data;

                document.querySelector('#idUsuario').value = iduser;
                document.querySelector('#foto_actual').value = imguser;
                document.querySelector('#txtNombre').value = nombre;
                document.querySelector('#txtPrimerApellido').value = primerapellido;
                document.querySelector('#txtSegundoApellido').value = segundoapellido;
                document.querySelector('#txtMail').value = nameuser;
                document.querySelector('#listRol').value = idrol;
                document.querySelector('#foto_remove').value = 0;

                if (statususer == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '">';
                }

                if (imguser == 'default.jpg') {
                    document.querySelector('.delPhoto').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto').classList.remove('notBlock');
                }
            }
        }
        $('#modalFormUsuario').modal('show');
    };
}

function fntDelUsuario(idusuario) {

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
        msg: '¿Realmente desea eliminar el usuario?',
        title: 'Eliminar Usuario',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type === 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'usuarios/delUsuario';
                let strData = 'iduser=' + idusuario;
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
                            tableUsuarios.ajax.reload();

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
    document.querySelector('#idUsuario').value = '';
    document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector('#titleModal').innerHTML = 'Nuevo Usuario';
    document.querySelector('#formUsuario').reset();
    removePhoto();

    let modalUsuario = new bootstrap.Modal(document.getElementById('modalFormUsuario'), {});
    modalUsuario.show();

    let myModal = document.getElementById('modalFormUsuario');
    let myInput = document.getElementById('txtNombre');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });

}

function closeModal() {
    $('.selectpicker').selectpicker('val', 1);
    $('#listRolid').selectpicker('val', 1);
}

function fntEditPerfil(idusuario) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'usuarios/getPerfil/' + idusuario;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { imguser, nombre, primerapellido, segundoapellido, nameuser, url_portada } = objData.data;

                document.querySelector('#foto_actual').value = imguser;
                document.querySelector('#txtNombre').value = nombre;
                document.querySelector('#txtPrimerApellido').value = primerapellido;
                document.querySelector('#txtSegundoApellido').value = segundoapellido;
                document.querySelector('#txtMail').value = nameuser;
                document.querySelector('#foto_remove').value = 0;

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="' + url_portada + '">';
                }

                if (imguser == 'default.jpg') {
                    document.querySelector('.delPhoto').classList.add('notBlock');
                } else {
                    document.querySelector('.delPhoto').classList.remove('notBlock');
                }
            }
        }
        $('#modalFormPerfil').modal('show');
    };
}