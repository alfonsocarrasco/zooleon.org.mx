<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (!empty($data['page_content'])): ?>
    <meta name="description" content="<?= strip_tags($data['page_content']); ?>">
    <?php endif; ?>
    <?php if (!empty($data['page_keywords'])): ?>
    <meta name="keywords" content="<?= $data['page_keywords']; ?>">
    <?php endif; ?>
    <?php if (!empty($data['page_name'])): ?>
    <meta name="author" content="<?= $data['page_name']; ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= media(); ?>site/css/all.min.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/v4-shims.min.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/bootstrap.min.css">
    <?php if ($data['page_tag'] == 'home' || $data['page_tag'] == 'faqs' || $data['page_tag'] == 'contacto'): ?>
    <link rel="stylesheet" href="<?= media(); ?>site/css/leaflet.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.79.0/dist/L.Control.Locate.min.css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?= media(); ?>site/css/slick.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/slick-theme.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/animate.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/aos.css">
    <?php if ($data['page_tag'] == 'contacto' || $data['page_tag'] == 'planeavisita'): ?>
    <link rel="stylesheet" href="<?= media(); ?>plugins/notifications/css/lobibox.min.css" />
    <link rel="stylesheet" href="<?= media(); ?>site/css/jquery.datetimepicker.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf98KUpAAAAAOXaPNTLUtIkWcnOfct9nTPpdlQb"></script>
    <?php endif; ?>
    <?php if ($data['page_tag'] == 'transparencia'): ?>
    <link rel="stylesheet" href="<?= media(); ?>plugins/datatable/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="<?= media(); ?>css/fixedHeader.dataTables.min.css" />
    <link rel="stylesheet" href="<?= media(); ?>css/responsive.bootstrap.min.css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?= media(); ?>site/css/styles.css">
    <link rel="stylesheet" href="<?= media(); ?>site/css/responsive.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= media(); ?>site/images/favicon.png" type="image/png">

    <title><?= $data['page_title']; ?></title>
</head>
<body>
    <div id="wrapper">

        <button id="backToTopBtn"><i class="fas fa-arrow-up"></i></button>

        <?php require_once('nav_site.php'); ?>

        <div class="logo-municipio animate__animated animate__fadeInRight animate__delay-1s">
            <a href="https://www.leon.gob.mx/" target="_blank">
                <img src="<?= media(); ?>site/images/municipio/logo-leon_vedaw.svg" alt="León Ayuntamiento 2021-2024">
            </a>
        </div>
