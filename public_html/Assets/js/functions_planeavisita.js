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
            '16:00'
        ],
        disabledWeekDays: [1],
        // closeOnDateSelect: true
    });
    $.datetimepicker.setLocale('es');

}, false);

let selectEvento = document.querySelector('#txtTipoEvento');
selectEvento.addEventListener('change', e => {

    if (e.target.value == '1') {
        document.querySelector('#txtNumeroPersonas').setAttribute('min', '15');
        document.querySelector('#txtNumeroPersonas').value = '';
    } else {
        document.querySelector('#txtNumeroPersonas').setAttribute('min', '50');
        document.querySelector('#txtNumeroPersonas').value = '';
    }

    if (e.target.value === '3') {
        document.querySelector('#nombreEmpresa').style.display = 'none';
        document.querySelector('#txtEmpresa').value = '';
        document.querySelector('#txtEmpresa').required = false;
    } else {
        document.querySelector('#nombreEmpresa').style.display = 'block';
        document.querySelector('#txtEmpresa').value = '';
        document.querySelector('#txtEmpresa').required = true;
    }

});

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