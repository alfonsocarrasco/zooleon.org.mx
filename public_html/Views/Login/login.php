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

    <title><?= $data['page_title']; ?></title>
</head>

<body class="bg-white">

  <!--start wrapper-->
    <div class="wrapper">
        <div class="">
            <div class="row g-0 m-0">
                <div class="col-xl-6 col-lg-12">
                    <div class="login-cover-wrapper">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="text-center img-logotipo m-5">
                                    <img src="<?= media(); ?>site/images/zooleon_logo.svg" alt="Parque Zoológico de León">
                                </div>
                                <div class="text-center">
                                    <h4><i class="fa-solid fa-user"></i> Iniciar Sesión</h4>
                                    <p>Inicia sesión con tu cuenta</p>
                                </div>
                                <form id="formLogin" class="form-body row g-3">
                                    <div class="form-floating col-12">
                                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Correo electrónico">
                                        <label for="inputEmail" class="form-label"><i class="fa-solid fa-at"></i> Correo electrónico</label>
                                    </div>
                                    <div class="form-floating col-12">
                                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña">
                                        <label for="inputPassword" class="form-label"><i class="fa-solid fa-key"></i> Contraseña</label>
                                    </div>
                                    <div class="col-12 col-lg-6 text-end">
                                        <a href="<?= base_url(); ?>login/reset">¿Olvidates tu contraseña?</a>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
                    </div>
                </div>
            </div>
        <!--end row-->
        </div>
    </div>
    <!--end wrapper-->

    <script>
        const base_url = '<?= base_url(); ?>';
    </script>
    <!-- JS Files-->
    <script src="<?= media(); ?>js/jquery.min.js"></script>

    <!--plugins-->
    <script src="<?= media(); ?>plugins/notifications/js/lobibox.min.js"></script>
	<script src="<?= media(); ?>plugins/notifications/js/notifications.min.js"></script>

    <script src="<?= media(); ?>js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>