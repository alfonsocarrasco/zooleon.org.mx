let tableRoles;
let rowTable = '';
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function() {

    tableRoles = $('#tableRoles').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'roles/getRoles',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idrol' },
            { 'data': 'nombrerol' },
            { 'data': 'descripcion' },
            { 'data': 'statusrol' },
            { 'data': 'options' }
        ],
        'resonsieve': "true",
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, "desc"]
        ]
    });

    // Nuevo Rol
    rowTable = tableRoles.page();
    localStorage.setItem('paginaActual', rowTable);
    let formRol = document.querySelector('#formRol');
    formRol.onsubmit = function(e) {
        e.preventDefault();

        let intIdRol = document.querySelector('#idRol').value;
        let strNombre = document.querySelector('#txtRol').value;
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
        let ajaxUrl = base_url + 'roles/setRol';
        let formData = new FormData(formRol);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {

                let objData = JSON.parse(request.responseText);

                if (objData.status) {
                    if (rowTable == 0) {
                        tableRoles.ajax.reload(function() {
                            $('#modalFormRol').modal('hide');
                        });
                    } else {
                        tableRoles.ajax.reload(function() {
                            $('#modalFormRol').modal('hide');
                            let pagina = localStorage.getItem('paginaActual');
                            tableRoles.page(parseInt(pagina)).draw('page');
                            localStorage.removeItem('paginaActual');
                        });
                    }

                    formRol.reset();

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

}, false);

function openModal() {

    document.querySelector('#idRol').value = '';
    document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector('#titleModal').innerHTML = 'Nuevo Rol';
    document.querySelector('#formRol').reset();

    let modalRol = new bootstrap.Modal(document.getElementById('modalFormRol'), {});
    modalRol.show();
    
}

function fntEditRol(idRol) {

    rowTable = tableRoles.page();
    localStorage.setItem('paginaActual', rowTable);

    document.querySelector('#titleModal').innerHTML = 'Actualizar Rol';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let idrol = idRol;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'roles/getRol/' + idrol;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { idrol, nombrerol, descripcion, statusrol } = objData.data;

                document.querySelector('#idRol').value = idrol;
                document.querySelector('#txtRol').value = nombrerol;
                document.querySelector('#txtDescripcion').value = descripcion;

                if (statusrol == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }

                $('#modalFormRol').modal('show');
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

function fntDelRol(idRol) {

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
        msg: '¿Realmente desea eliminar el rol de usuario?',
        title: 'Eliminar Rol de Usuario',
        width: 530,
        callback: function($this, type, ev) {

            if (type === 'yes') {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'roles/delRol';
                let strData = 'idrol=' + idRol;
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
                            tableRoles.ajax.reload();
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

function fntPermisos(idRol) {

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'permisos/getPermisosRol/' + idRol;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#contentAjax').innerHTML = request.responseText;

            let modalPermisos = new bootstrap.Modal(document.getElementById('modalFormPermisos'), {});
            modalPermisos.show();

            document.querySelector('#formPermisos').addEventListener('submit', fntSavePermisos, false);
        }
    }
}

function fntSavePermisos(event) {
    
    event.preventDefault();
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'permisos/setPermisos';
    let formElement = document.querySelector('#formPermisos');
    let formData = new FormData(formElement);
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

                $('#modalFormPermisos').modal('hide');

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