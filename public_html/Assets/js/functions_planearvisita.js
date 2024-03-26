let tablePlanearVisita;
let rowTable;
let selects;
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function() {

    let hora = new Date().getHours()+1;
    let time = hora.toString();
    
    $('#txtFechaHr').datetimepicker({
        format:'Y-m-d H:i',
        minDate: 0,
        defaultTime: time,
        allowTimes: [
            '9:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
        ],
        disabledWeekDays: [1],
        // closeOnDateSelect: true
    });
    $.datetimepicker.setLocale('es');
        
    // Fullcalendar
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'America/Mexico_City',
        locale: 'es',
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        validRange: {
            start: '2023-01-01'
        },
        buttonIcons: true, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        events: base_url + 'planearvisita/getEventsDate',
        eventColor: '#00A59F',
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit'
        },
        eventClick: e => {
            const { id } = e.event;
            fntEditInfo(id);
        },
        dateClick: () => {
            openModal();
        }
    });
    calendar.render();

    let selectMunicipio = document.querySelector('#txtEstado');
    selectMunicipio.addEventListener('change', e => {

        let id = e.target.value;
        fetch(`planeavisita/getMunicipios/${id}`)
            .then(res => {

                if(!res.ok) {
                    throw new Error('Hubo un error en la respuesta');
                }//en if
                return res.json();

            })
            .then(datos => {
                
                let html = '<option value="">Seleccionar municipio</option>';
                if(datos.length > 0) {
                    for (let i = 0; i < datos.length; i++) {
                        html += `<option value="${datos[i].id}">${datos[i].nombre}</option>`;
                    }//end for
                }//end if
                document.querySelector('#txtMunicipio').innerHTML = html;

            })
            .catch(error => {
                console.error('Ocurrió un error ' + error);
            });
        
    });

    tablePlanearVisita = $('#tablePlanearVisita').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        'ajax': {
            'url': ' ' + base_url + 'planearvisita/getMensajes',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'idplanea' },
            { 'data': 'evento'},
            { 'data': 'nombre' },
            { 'data': 'email' },
            { 'data': 'medio_contacto' },
            { 'data': 'status_seguimiento', render: data => {
                if (data == 1) {
                    return 'Informes'
                } else if (data == 2) {
                    return 'Reservación'
                } else if (data == 3) {
                    return 'Cancelación'
                } else {
                    return 'Visita'
                }
            } },
            { 'data': 'fecha' },
            { 'data': 'options' }
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [
            [0, 'desc']
        ]
    });

    let selectEvento = document.querySelector('#txtEvento');
    selectEvento.addEventListener('change', e => {

        if (e.target.value == '1') {
            document.querySelector('#txtNumPersonas').setAttribute('min', '15');
            document.querySelector('#txtNumPersonas').value = '';
        } else {
            document.querySelector('#txtNumPersonas').setAttribute('min', '50');
            document.querySelector('#txtNumPersonas').value = '';
        }

        if (e.target.value == '3') {
            document.querySelector('#nombreEmpresa').style.display = 'none';
            document.querySelector('#txtEmpresa').value = '';
            document.querySelector('#txtEmpresa').required = false;
        } else {
            document.querySelector('#nombreEmpresa').style.display = 'block';
            document.querySelector('#txtEmpresa').value = '';
            document.querySelector('#txtEmpresa').required = true;
        }

    });

    if (document.querySelector("#formPlanear")) {

        let formPlanear = document.querySelector("#formPlanear");
        formPlanear.onsubmit = function(e) {
            e.preventDefault();

            let typeEvent  = document.querySelector('#txtEvento').value;
            let nombre     = document.querySelector('#txtNombre').value;
            let estado     = document.querySelector('#txtEstado').value;
            let municipio  = document.querySelector('#txtMunicipio').value;
            let tel        = document.querySelector('#txtTelefono').value;
            let cel        = document.querySelector('#txtCelular').value;
            let email      = document.querySelector('#txtEmail').value;
            let numPers    = document.querySelector('#txtNumPersonas').value;
            let asunto     = document.querySelector('#txtAsunto').value;
            let mensaje    = document.querySelector('#txtMensaje').value;
            let strFechaHr = document.querySelector('#txtFechaHr').value;
            let intStatus  = document.querySelector('#listStatus').value;
            
            if (typeEvent == '' || nombre == '' || estado == '' || municipio == '' || tel == '' || cel == '' || email == '' || numPers == '' ||  asunto == '' || mensaje == '' || strFechaHr == '' || intStatus == '') {

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

            if ((tel.length > 10 || tel.length < 10) || (cel.length > 10 || cel.length < 10)) {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    destroy: false,
                    size: 'mini',
                    rounded: true,
                    icon: 'fa fa-times-circle-o',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Verifique el formato del número telefónico o celular, debe ser de 10 dígitos.'
                });
                return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'planearvisita/setData';
            let formData = new FormData(formPlanear);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {

                if (request.readyState == 4 && request.status == 200) {

                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        if (rowTable == 0) {
                            tablePlanearVisita.ajax.reload(function() {
                                $('#modalFormPlanear').modal('hide');
                                calendar.refetchEvents();
                            });
                        } else {
                            tablePlanearVisita.ajax.reload(function() {
                                $('#modalFormPlanear').modal('hide');
                                let pagina = localStorage.getItem("paginaActual");
                                tablePlanearVisita.page(parseInt(pagina)).draw('page');
                                localStorage.removeItem('paginaActual');
                                calendar.refetchEvents();
                            });
                        }

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

function fntViewInfo(id) {
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'planearvisita/getMensaje/' + id;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { asunto, celular, dispositivo, email, fecha, fecha_horario, idplanea, ip, medio, mensaje, nombre, nombre_empresa, nombre_estado, nombre_municipio, num_personas, seguimiento, telefono, tipo_evento, useragent } = objData.data;

                let evento;
                if (tipo_evento == 1) { evento = 'Escolar' } else if (tipo_evento == 2) { evento = 'Empresarial' } else { evento = 'Fiesta infantil' }

                document.querySelector('#celId').innerHTML          = idplanea;
                document.querySelector('#celEvento').innerHTML      = evento;
                document.querySelector('#celContacto').innerHTML    = medio;
                document.querySelector('#celNombre').innerHTML      = nombre;
                document.querySelector('#celEmpresa').innerHTML     = nombre_empresa;
                document.querySelector('#celEstado').innerHTML      = nombre_estado;
                document.querySelector('#celMunicipio').innerHTML   = nombre_municipio;
                document.querySelector('#celTel').innerHTML         = telefono;
                document.querySelector('#celCel').innerHTML         = celular;
                document.querySelector('#celEmail').innerHTML       = email;
                document.querySelector('#celNumPer').innerHTML      = num_personas;
                document.querySelector('#celFechaHr').innerHTML     = fecha_horario;
                document.querySelector('#celStatusSeg').innerHTML   = seguimiento;
                document.querySelector('#celAsunto').innerHTML      = asunto;
                document.querySelector('#celFecha').innerHTML       = fecha;
                document.querySelector('#celMensaje').innerHTML     = mensaje;
                document.querySelector('#celIP').innerHTML          = ip;
                document.querySelector('#celDispositivo').innerHTML = dispositivo;
                document.querySelector('#celUseragent').innerHTML   = useragent;

                let modalviewMensaje = new bootstrap.Modal(document.getElementById('modalViewMensaje'), {});
                modalviewMensaje.show();

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
    }
}

function fntEditInfo(id) {
    rowTable = tablePlanearVisita.page();
    localStorage.setItem("paginaActual", rowTable);

    document.querySelector('#titleModal').innerHTML = "Actualizar registro planea visita";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'planearvisita/getMensaje/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                const { asunto, celular, email, estado, fecha_horario, idplanea, medio_contacto, mensaje, municipio, nombre, nombre_empresa, num_personas, status_seguimiento, telefono, tipo_evento } = objData.data;

                fetch(`planeavisita/getMunicipios/${estado}`)
                    .then(res => {

                        if(!res.ok) {
                            throw new Error('Hubo un error en la respuesta');
                        }//en if
                        return res.json();

                    })
                    .then(datos => {
                        
                        let html = '<option value="">Seleccionar municipio</option>';
                        if(datos.length > 0) {
                            for (let i = 0; i < datos.length; i++) {
                                html += `<option value="${datos[i].id}">${datos[i].nombre}</option>`;
                            }//end for
                        }//end if
                        document.querySelector('#txtMunicipio').innerHTML = html;
                        document.querySelector("#txtMunicipio").value   = municipio;
                    })
                    .catch(error => {
                        console.error('Ocurrió un error ' + error);
                    });
                    
                
                document.querySelector("#idplanea").value       = idplanea;
                document.querySelector("#txtEvento").value      = tipo_evento;
                document.querySelector('#txtNombre').value      = nombre;
                document.querySelector('#txtEmpresa').value     = nombre_empresa;
                document.querySelector('#txtEstado').value      = estado;
                document.querySelector("#txtTelefono").value    = telefono;
                document.querySelector("#txtCelular").value     = celular;
                document.querySelector("#txtEmail").value       = email;
                document.querySelector("#txtNumPersonas").value = num_personas;
                document.querySelector("#txtAsunto").value      = asunto;
                document.querySelector("#txtMensaje").value     = mensaje;
                document.querySelector("#listStatus").value     = status_seguimiento;
                document.querySelector("#txtFechaHr").value     = fecha_horario;
                
                if (medio_contacto == 3) {
                    document.querySelector("#listMedio").value = "";
                    document.querySelector('#listMedio').disabled = true;
                } else {
                    document.querySelector('#listMedio').disabled = false;
                    document.querySelector("#listMedio").value = medio_contacto;
                }

                selects = document.querySelectorAll('.disabled');
                for (let i = 0; i < selects.length; i++) {
                    const element = selects[i];
                    element.disabled = true;
                }

                let modalviewMensaje = new bootstrap.Modal(document.getElementById('modalFormPlanear'), {});
                modalviewMensaje.show();

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

function fntDelInfo(id) {

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
        msg: '¿Realmente quiere eliminar el mensaje?',
        title: 'Eliminar Mensaje',
        width: 530,
        callback: function($this, type, ev) {
            
            if (type == 'yes') {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + 'planearvisita/delMessage';
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
                            tablePlanearVisita.ajax.reload();

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

    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo registro planea visita";
    
    document.querySelector("#formPlanear").reset();
    document.querySelector('#idplanea').value = 0;
    document.querySelector('#txtMensaje').disabled = false;

    selects = document.querySelectorAll('.disabled');
    for (let i = 0; i < selects.length; i++) {
        const element = selects[i];
        element.disabled = false;
    }

    let modalFormPlanear = new bootstrap.Modal(document.getElementById('modalFormPlanear'), {});
    modalFormPlanear.show();

    let myModal = document.getElementById('modalFormPlanear');
    let myInput = document.getElementById('txtNombre');
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus();
    });
}