document.addEventListener("DOMContentLoaded", function() {
        if (document.querySelector("#formLogin")) {
            let formLogin = document.querySelector("#formLogin");
            formLogin.onsubmit = function(e) {
                e.preventDefault();

                let strEmail = document.querySelector("#inputEmail").value;
                let strPassword = document.querySelector("#inputPassword").value;

                if (strEmail == "" || strPassword == "") {

                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-x-circle',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'Ingrese el usuario y contraseña.'
                    });
                    return false;

                } else {
                    let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + 'login/loginUser';
                    let formData = new FormData(formLogin);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);

                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);

                            if (objData.status) {
                                window.location = base_url + 'dashboard';
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
                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Error en el proceso.'
                            });
                        }
                        return false;
                    };
                }
            };
        }

        // Form Reset Password
        if (document.querySelector("#formResetPass")) {
            let formResetPass = document.querySelector("#formResetPass");
            formResetPass.onsubmit = function(e) {
                e.preventDefault();

                let strEmail = document.querySelector("#txtEmailReset").value;
                
                if (strEmail == "") {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-x-circle',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'Ingresa tu correo electrónico.'
                    });
                    return false;
                } else {
                    let request = window.XMLHttpRequest ?
                        new XMLHttpRequest() :
                        new ActiveXObject("Microsoft.XMLHTTP");
                    let ajaxUrl = base_url + "login/resetPass";
                    let formData = new FormData(formResetPass);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                Lobibox.confirm({
                                    buttons: {
                                        ok: {
                                            'class': 'btn btn-success'
                                        }
                                    },
                                    closeButton: false,
                                    iconClass: 'bi bi-check2-circle',
                                    msg: objData.msg,
                                    title: '¡Restauración de contraseña!',
                                    width: 530,
                                    callback: function($this, type, ev) {

                                        if (type === 'ok') {
                                            window.location = base_url + 'login';
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
                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Error en el proceso.'
                            });
                        }
                        return false;
                    };
                }
            };
        }

        if (document.querySelector("#formCambiarPass")) {
            let formCambiarPass = document.querySelector("#formCambiarPass");
            formCambiarPass.onsubmit = function(e) {
                e.preventDefault();

                let strPassword = document.querySelector("#txtPassword").value;
                let strPasswordConfirm = document.querySelector("#txtPasswordConfirm").value;
                let idUsuario = document.querySelector("#idUsuario").value;

                if (strPassword == "" || strPasswordConfirm == "") {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        icon: 'bx bx-x-circle',
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        msg: 'Ingrese la nueva contraseña.'
                    });
                    return false;
                } else {
                    if (strPassword.length < 8) {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bi bi-exclamation-circle',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La contraseña debe tener un mínimo de 8 caracteres.'
                        });
                        return false;
                    }
                    if (strPassword != strPasswordConfirm) {
                        Lobibox.notify('error', {
                            pauseDelayOnHover: true,
                            size: 'mini',
                            rounded: true,
                            icon: 'bx bx-x-circle',
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: 'La contraseña no coincide.'
                        });
                        return false;
                    }

                    let request = window.XMLHttpRequest ?
                        new XMLHttpRequest() :
                        new ActiveXObject("Microsoft.XMLHTTP");
                    let ajaxUrl = base_url + 'login/setPassword';
                    let formData = new FormData(formCambiarPass);
                    request.open('POST', ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);

                            if (objData.status) {
                                Lobibox.confirm({
                                    buttons: {
                                        ok: {
                                            'class': 'btn btn-success'
                                        }
                                    },
                                    closeButton: false,
                                    iconClass: 'bi bi-check2-circle',
                                    msg: objData.msg,
                                    title: '¡Restauración de contraseña!',
                                    width: 530,
                                    callback: function($this, type, ev) {

                                        if (type === 'ok') {
                                            window.location = base_url + 'login';
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
                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Error en el proceso.'
                            });
                        }
                    };
                }
            };
        }
    },
    false
);