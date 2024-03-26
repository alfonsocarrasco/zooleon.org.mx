<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="<?= media(); ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?= media(); ?>js/pace.min.js"></script>

    <!--plugins-->
    <link href="<?= media(); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/notifications/css/lobibox.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="<?= media(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= media(); ?>css/bootstrap-extended.css" rel="stylesheet">
    <link href="<?= media(); ?>css/all.min.css" rel="stylesheet">
    <link href="<?= media(); ?>css/style.css" rel="stylesheet">
    <link href="<?= media(); ?>css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= media(); ?>images/favicon.png" type="image/png">

    <script src="https://www.google.com/recaptcha/api.js?render=6LczrGQkAAAAAHX_mSuhIw_QCC22lZwI8cAIlVc7"></script>
    <title><?= $data['page_title']; ?></title>
</head>

<body>
    
    <div class="login-bg-overlay au-reset-password-basic"></div>

    <!--start wrapper-->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-7 mx-auto">
                    <div class="reset-passowrd">
                        <div class="card radius-10 w-100 mt-8">
                            <div class="card-body p-4">
                                <div class="text-center img-logotipo p-3" style="margin: 0 auto; width: 290px;">
                                    <img src="<?= media(); ?>site/images/zooleon_logo.svg" alt="">
                                </div>
                                <div class="text-center">
                                    <h4>¿Olvidaste tu contraseña?</h4>
                                    <p><i class="fa-solid fa-rotate-right"></i> Reiniciar contraseña</p>
                                </div>
                                <form id="formResetPass" name="formResetPass" class="form-body row g-3">
                                    <div class="form-floating col-12">
                                        <input type="email" class="form-control" id="txtEmailReset" name="txtEmailReset" placeholder="abc@example.com">
                                        <label for="txtEmailReset" class="form-label"><i class="fa-solid fa-at"></i> Correo Electrónico</label>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-unlock"></i> Reiniciar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="my-5">
            <div class="container">
                <div class="text-center">
                    <p class="mb-0"><i class="fa-regular fa-copyright"></i> <?= date('Y').' '.NOMBRE_EMPRESA; ?> </p>
                </div>
            </div>
        </footer>
    </div>
    <!--end wrapper-->

    <script>
        const base_url = '<?= base_url(); ?>';
    </script>
    <!-- JS Files-->
    <script src="<?= media(); ?>js/jquery.min.js"></script>

    <!--plugins-->
    <script src="<?= media(); ?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?= media(); ?>plugins/notifications/js/notifications.js"></script>

    <script src="<?= media(); ?>js/<?= $data['page_functions_js']; ?>"></script>

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LczrGQkAAAAAHX_mSuhIw_QCC22lZwI8cAIlVc7', {action: 'submit'}).then(function(token) {
                $('#formResetPass').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#formResetPass').prepend('<input type="hidden" name="action" value="submit">');
            });
        });
    </script>

</body>

</html>