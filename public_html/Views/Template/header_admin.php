<?php
    isset($data['imagen']) ? $imageUser = $data['imagen'] != 'default.jpg' ? media().'images/uploads/usuarios/'.$data['imagen'] : media().'images/'.$data['imagen'] : '';
?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="<?= media(); ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?= media(); ?>js/pace.min.js"></script>

    <!--plugins-->
    <link href="<?= media(); ?>plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <link href="<?= media(); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>plugins/dropzone/dist/dropzone.css" rel="stylesheet">
    <?php if ($data['page_tag'] == 'planearvisita'): ?>
    <link rel="stylesheet" href="<?= media(); ?>site/css/jquery.datetimepicker.min.css">
    <?php endif; ?>
    
    <!-- CSS Files -->
    <link href="<?= media(); ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/all.min.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/style.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/icons.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/summernote-lite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= media(); ?>css/dark-theme.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/semi-dark.css" rel="stylesheet" />
    <link href="<?= media(); ?>css/header-colors.css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= media(); ?>images/favicon.png" type="image/png">

    <title><?= $data['page_title']; ?></title>
</head>

<body>

    <div id="divLoading">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span></div>
    </div>

    <!--start wrapper-->
    <div class="wrapper">

    <!--start top header-->
    <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-menu-button">
                <i class="bi bi-list"></i>
            </div>
            <div class="top-navbar-right ms-auto">

                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <div class="alert alert-dismissible fade show py-2 bg-success timesession hidden">
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="text-white">Su sesión expira en: <strong class="time"></strong></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                            <div class="">
                                <i class="bi bi-gear"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-user-setting">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                            <div class="user-setting">
                                <img src="<?= $imageUser; ?>" class="user-img" alt="">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        <img src="<?= $imageUser; ?>" alt="" class="rounded-circle" width="54" height="54">
                                        <div class="">
                                            <h6 class="mb-0 dropdown-user-name"><?= isset($data['nombre']) ? $data['nombre'].' '.$data['primerApellido'] : ''; ?></h6>
                                            <small class="mb-0 dropdown-user-designation text-secondary"><?= isset($data['rol']) ? $data['rol'] : ''; ?></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url(); ?>usuarios/perfil">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <ion-icon name="person-outline"></ion-icon>
                                        </div>
                                        <div class="ms-3"><span>Perfil</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url(); ?>dashboard">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <ion-icon name="speedometer-outline"></ion-icon>
                                        </div>
                                        <div class="ms-3"><span>Dashboard</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url(); ?>logout">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <ion-icon name="log-out-outline"></ion-icon>
                                        </div>
                                        <div class="ms-3"><span>Cerrar Sesión</span></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--end top header-->

    <?php include_once('nav_admin.php'); ?>

    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">