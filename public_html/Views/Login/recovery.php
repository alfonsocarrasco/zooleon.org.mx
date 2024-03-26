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

<body>

    <div class="login-bg-overlay au-reset-password-basic"></div>

    <!--start wrapper-->
    <div class="wrapper">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-white p-3">
                <div class="container-fluid">
                    <a href="javascript:;"><img src="<?= media(); ?>site/images/zooleon_logo.svg" width="140" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-7 mx-auto">
                    <div class="reset-passowrd">
                        <div class="card radius-10 w-100 mt-8">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h4>Cambiar contraseña</h4>
                                </div>
                                <form id="formCambiarPass" name="formCambiarPass" class="form-body row g-3">
                                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?= $data['iduser']; ?>" required>
                                    <input type="hidden" name="txtEmail" id="txtEmail" value="<?= $data['nameuser']; ?>" required>
                                    <input type="hidden" name="txtToken" id="txtToken" value="<?= $data['tokenuser']; ?>" required>
                                    <div class="form-floating col-12">
                                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="abc@example.com">
                                        <label for="txtPassword" class="form-label"><i class="fa-solid fa-key"></i> Contraseña</label>
                                    </div>
                                    <div class="form-floating col-12">
                                        <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="abc@example.com">
                                        <label for="txtPasswordConfirm" class="form-label"><i class="fa-solid fa-key"></i> Confirmar Contraseña</label>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-arrow-rotate-right"></i> Reiniciar</button>
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
                    <p class="mb-0">&copy; <?= date('Y').' '.NOMBRE_EMPRESA; ?></p>
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

</body>

</html>