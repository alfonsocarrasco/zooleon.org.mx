function fntViewInfo(idmensaje) {
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'contactanos/getMensaje/' + idmensaje;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                const { asunto, dispositivo, email, fecha, idcontacto, ip, mensaje, nombre, telefono, useragent } = objData.data;

                document.querySelector('#celId').innerHTML          = idcontacto;
                document.querySelector('#celNombre').innerHTML      = nombre;
                document.querySelector('#celTel').innerHTML         = telefono;
                document.querySelector('#celEmail').innerHTML       = email;
                document.querySelector('#celAsunto').innerHTML      = asunto;
                document.querySelector('#celFecha').innerHTML       = fecha;
                document.querySelector('#celMensaje').innerHTML     = mensaje;
                document.querySelector('#celIP').innerHTML          = ip;
                document.querySelector('#celDispositivo').innerHTML = dispositivo;
                document.querySelector('#celUseragent').innerHTML   = useragent;
                $('#modalViewMensaje').modal('show');
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