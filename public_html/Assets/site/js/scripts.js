// Boton To Top
const backToTopButton = document.querySelector('#backToTopBtn');

window.addEventListener('scroll', scrollFunction = () => {
    if (window.pageYOffset > 300) {
        // Show backToTopButton
        if (backToTopButton.classList.contains('backToTopBtn')) {
            backToTopButton.classList.remove('backToTopBtn');
            backToTopButton.classList.remove('animate__animated', 'animate__fadeOutDown');
            backToTopButton.classList.add('animate__animated', 'animate__fadeInUp');
            backToTopButton.style.display = 'block';
        }
    } else {
        // Hide backToTopButton
        if (!backToTopButton.classList.contains('backToTopBtn')) {
            backToTopButton.classList.remove('animate__animated', 'animate__fadeInUp');
            backToTopButton.classList.add('animate__animated', 'animate__fadeOutDown');
            backToTopButton.classList.add('backToTopBtn');
            setTimeout(function() {
                backToTopButton.style.display = 'none';
            }, 250);
        }
    }
});

backToTopButton.addEventListener('click', smoothScrollBackToTop);

function smoothScrollBackToTop() {
    const targetPosition = 0;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    const duration = 750;
    let start = null;

    window.requestAnimationFrame(step);

    function step(timestamp) {
        if (!start) start = timestamp;
        const progress = timestamp - start;
        window.scrollTo(0, easeInOutCubic(progress, startPosition, distance, duration));
        if (progress < duration) window.requestAnimationFrame(step);
    }
}

function easeInOutCubic(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t * t + b;
    t -= 2;
    return c / 2 * (t * t * t + 2) + b;
};

/*==================================================================
[ Contacto ]*/
if (document.querySelector('#fcontacto')) {
    let contactform = document.querySelector('#fcontacto');
    contactform.addEventListener('submit', function(e) {
        e.preventDefault();

        let nombre = document.querySelector('#txtNombre').value;
        let email = document.querySelector('#txtEmail').value;
        let tel = document.querySelector('#txtTel').value;
        let asunto = document.querySelector('#txtAsunto').value;
        let mensaje = document.querySelector('#txtMensaje').value;

        if (nombre == '' || tel == '' || email == '' || asunto == '' || mensaje == '') {
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                destroy: false,
                size: 'mini',
                rounded: true,
                icon: 'fa fa-times-circle-o',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Todos los campos son obligatorios.'
            });
            return false;
        }

        if (tel.length > 10 || tel.length < 10) {
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                destroy: false,
                size: 'mini',
                rounded: true,
                icon: 'fa fa-times-circle-o',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Verifique el formato del número telefónico, debe ser de 10 dígitos.'
            });
            return false;
        }

        let elementsValid = document.getElementsByClassName('valid');
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    destroy: false,
                    size: 'mini',
                    rounded: true,
                    icon: 'fa fa-times-circle-o',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Verifique los campos incorrectos.'
                });
                return false;
            }
        }

        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + 'contacto/sendContacto';
        let formData = new FormData(contactform);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        destroy: false,
                        size: 'mini',
                        rounded: true,
                        icon: 'fa-solid fa-circle-check',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: objData.msg
                    });
                    document.querySelector('#fcontacto').reset();
                } else {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        destroy: false,
                        size: 'mini',
                        rounded: true,
                        icon: 'fa fa-times-circle-o',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: objData.msg
                    });
                }
            }
            return false;
        }

    }, false);
}

/*==================================================================
[ Planea tu visita ]*/
if (document.querySelector('#fpvisita')) {
    let formPVisita = document.querySelector('#fpvisita');
    formPVisita.addEventListener('submit', function(e) {
        e.preventDefault();

        let typeEvent = document.querySelector('#txtTipoEvento').value;
        let nombre    = document.querySelector('#txtNombre').value;
        let estado    = document.querySelector('#txtEstado').value;
        let municipio = document.querySelector('#txtMunicipio').value;
        let tel       = document.querySelector('#txtTelFijo').value;
        let cel       = document.querySelector('#txtTelCel').value;
        let email     = document.querySelector('#txtEmail').value;
        let numPers   = document.querySelector('#txtNumeroPersonas').value;
        let fechaHr   = document.querySelector('#txtFechaHr').value;
        let asunto    = document.querySelector('#txtAsunto').value;
        let mensaje   = document.querySelector('#txtMensaje').value;

        if (typeEvent === '' || nombre === '' || estado === '' || municipio === '' || tel === '' || cel === '' || email === '' || numPers === '' || fechaHr === '' ||  asunto == '' || mensaje == '') {

            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                destroy: false,
                size: 'mini',
                rounded: true,
                icon: 'fa fa-times-circle-o',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Todos los campos son obligatorios.'
            });
            return false;

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

        let elementsValid = document.getElementsByClassName('valid');
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    destroy: false,
                    size: 'mini',
                    rounded: true,
                    icon: 'fa fa-times-circle-o',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Verifique los campos incorrectos.'
                });
                return false;
            }
        }

        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + 'contacto/sendVisita';
        let formData = new FormData(formPVisita);
        request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState != 4) return;
            if (request.status == 200) {

                let objData = JSON.parse(request.responseText);
                if (objData.status) {

                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        destroy: false,
                        size: 'mini',
                        rounded: true,
                        icon: 'fa-solid fa-circle-check',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: objData.msg
                    });
                    document.querySelector('#fpvisita').reset();

                } else {

                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        destroy: false,
                        size: 'mini',
                        rounded: true,
                        icon: 'fa fa-times-circle-o',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: objData.msg
                    });

                }

            }
            return false;
        }

    }, false);
}