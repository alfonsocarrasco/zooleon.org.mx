let tableTransparencia;
let rowTable = '';
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    if (document.querySelector("#txtFilePDF")) {
        let txtFilePDF = document.querySelector("#txtFilePDF");
        txtFilePDF.onchange = function(e) {

            let uploadtxtFilePDF = document.querySelector("#txtFilePDF").value;
            let filePDF = document.querySelector("#txtFilePDF").files[0];
            let nav = window.URL || window.webkitURL;

            if (uploadtxtFilePDF != '') {

                let type = filePDF.type;
                let name = filePDF.name;

                if (type != 'application/pdf') {

                    uploadtxtFilePDF = document.querySelector("#txtFilePDF").value = '';
                    Lobibox.notify('warning', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'El archivo no es válido.'
                    });
                    
                    txtFilePDF.value = "";
                    return false;

                } else if (filePDF.size >= 10000000) {

                    uploadtxtFilePDF = document.querySelector("#txtFilePDF").value = '';
                    Lobibox.notify('warning', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'El archivo no debe pesar mas de 5MB!'
                    });

                }
            }
        };
    }

    if (document.querySelector("#txtFileXLS")) {
        let txtFileXLS = document.querySelector("#txtFileXLS");
        txtFileXLS.onchange = function(e) {

            let uploadtxtFileXLS = document.querySelector("#txtFileXLS").value;
            let fileXLS = document.querySelector("#txtFileXLS").files[0];
            let nav = window.URL || window.webkitURL;

            if (uploadtxtFileXLS != '') {

                let type = fileXLS.type;
                let name = fileXLS.name;

                if (type != 'application/vnd.ms-excel' && type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && type != 'application/msword') {

                    uploadtxtFileXLS = document.querySelector("#txtFileXLS").value = '';
                    Lobibox.notify('warning', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'El archivo no es válido.'
                    });
                    txtFileXLS.value = "";
                    return false;

                } else if (fileXLS.size >= 15000000) {

                    uploadtxtFileXLS = document.querySelector("#txtFileXLS").value = '';
                    Lobibox.notify('warning', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'El archivo no debe pesar mas de 15MB!'
                    });

                } else {
                    document.querySelector('#nameXLS').innerHTML = name;
                }
            }
        };
    }

    tableTransparencia = $('#tableTransparencia').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': base_url + 'informacionpublica/getFormatos',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'id' },
            { 'data': 'titulo' },
            { 'data': 'formato' },
            { 'data': 'anio', render: function(data) {
                if (data == '0000') { return 'N/A' } else { return data };
            } },
            { 'data': 'subtitulo' },
            { 'data': 'filePDF' },
            { 'data': 'fileXLS' },
            { 'data': 'status' },
            { 'data': 'options' }
        ],
        // 'bFilter': false,
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 25,
        'order': [
            [0, 'desc']
        ]
    });

    // Filtro busqueda
    document.querySelector('#title').addEventListener('keyup', function() {
        tableTransparencia.columns($(this).data('index')).search(this.value).draw();
    })

    document.querySelector('#formato').addEventListener('keyup', function() {
        tableTransparencia.columns($(this).data('index')).search(this.value).draw();
    })

    document.querySelector('#anio').addEventListener('keyup', function() {
        tableTransparencia.columns($(this).data('index')).search(this.value).draw();
    })

    document.querySelector('#subtitle').addEventListener('keyup', function() {
        tableTransparencia.columns($(this).data('index')).search(this.value).draw();
    })

    if (document.querySelector("#formTransparencia")) {
        let formTransparencia = document.querySelector("#formTransparencia");
        formTransparencia.onsubmit = function(e) {
            e.preventDefault();

            let txtTitulo = document.querySelector('#txtTitulo').value;
            let txtFormato = document.querySelector('#txtFormato').value;
            let txtSubtitulo = document.querySelector('#txtSubtitulo').value;
            let intStatus = document.querySelector('#listStatus').value;

            if (txtTitulo == '' || txtFormato == '' || txtSubtitulo == '' || intStatus == '') {

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
            let ajaxUrl = base_url + 'informacionpublica/setFormato';
            let formData = new FormData(formTransparencia);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {

                    let objData = JSON.parse(request.responseText);

                    if (objData.status) {

                        if (rowTable == 0) {
                            tableTransparencia.ajax.reload(function() {
                                $('#modalFormTransparencia').modal('hide');
                            });
                        } else {
                            tableTransparencia.ajax.reload(function() {
                                $('#modalFormTransparencia').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tableTransparencia.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                            });
                        }

                        formTransparencia.reset();
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

}, false);

function fntViewFormato(id) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'informacionpublica/getFormato/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                const { anio, filePDF, fileXLS, formato, id, status, subtitulo, titulo } = objData.data;

                let estado = status == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML        = id;
                document.querySelector("#celTitulo").innerHTML    = titulo;
                document.querySelector("#celFormato").innerHTML   = formato;
                document.querySelector("#celAnio").innerHTML      = (anio === '0000') ? 'N/A' : anio;
                document.querySelector("#celSubtitulo").innerHTML = subtitulo;
                document.querySelector("#celEstado").innerHTML    = estado;
                document.querySelector('#celPDF').innerHTML       = (filePDF === '') ? 'N/A' : filePDF.replace(/.*\/|\.*$/g, '');
                document.querySelector('#celXLS').innerHTML       = (fileXLS === '') ? 'N/A' : fileXLS.replace(/.*\/|\.*$/g, '');

                let modalViewTransparencia = new bootstrap.Modal(document.getElementById('modalViewTransparencia'), {});
                modalViewTransparencia.show();

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

function fntEditFormato(id) {

    rowTable = tableTransparencia.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = 'Actualizar Formato';
    document.querySelector('.modal-header').classList.replace('headerRegister', 'headerUpdate');
    document.querySelector('#titleModal').classList.replace('btn-primary', 'btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';
    document.querySelector('#filePDFActual').value = '';

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'informacionpublica/getFormato/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { anio, filePDF, fileXLS, formato, id, status, subtitulo, titulo } = objData.data;

                document.querySelector('#idFormato').value = id;
                document.querySelector('#txtTitulo').value = titulo;
                document.querySelector('#txtFormato').value = formato;
                document.querySelector('#txtAnio').value = (anio === '0000') ? '' : anio;
                document.querySelector('#txtSubtitulo').value = subtitulo;
                document.querySelector('#filePDFActual').value = filePDF;
                document.querySelector('#fileXLSActual').value = fileXLS;

                if (filePDF !== '') {
                    document.querySelector('.filePDFActual').innerHTML = filePDF.replace(/.*\/|\.*$/g, '');
                    document.querySelector('.filePDFActual').classList.add('bg-success');
                    document.querySelector('.filePDFActual').classList.remove('bg-danger');
                }

                if (fileXLS !== '') {
                    // (/.*\/|\.[^.]*$/g, '')
                    document.querySelector('.fileXLSActual').innerHTML = fileXLS.replace(/.*\/|\.*$/g, '');
                    document.querySelector('.fileXLSActual').classList.add('bg-success');
                    document.querySelector('.fileXLSActual').classList.remove('bg-danger');
                }

                if (status === 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }
            }
        }

        $('#modalFormTransparencia').modal('show');
    };
}

function fntDelFormato(id) {
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
        msg: '¿Realmente quiere eliminiar el formato?',
        title: 'Eliminar Formato',
        width: 530,
        callback: function($this, type, ev) {

            if (type == 'yes') {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'informacionpublica/delFormato';
                let strData = 'id=' + id;
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
                            tableTransparencia.ajax.reload();

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
    document.querySelector('#idFormato').value = '';
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Formato";

    document.querySelector('.filePDFActual').innerHTML = '';
    document.querySelector('#filePDFActual').value = '';
    document.querySelector('.fileXLSActual').innerHTML = '';
    document.querySelector('#fileXLSActual').value = '';
    document.querySelector("#formTransparencia").reset();

    let modalFormTransparencia = new bootstrap.Modal(document.getElementById('modalFormTransparencia'), {});
    modalFormTransparencia.show();

    let myModal = document.getElementById('modalFormTransparencia');
    let myInput = document.getElementById('txtTitulo');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });
}