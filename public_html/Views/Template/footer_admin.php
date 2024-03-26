            </div>
            <!-- end page content-->
        </div>
        <!--end page content wrapper-->

        <!--start footer-->
        <!-- <footer class="footer">
            <div class="footer-text">
                Derechos Reservados <i class="fa-regular fa-registered"></i> <?= date('Y'); ?>. Todos los derechos reservados.
            </div>
        </footer> -->
        <!--end footer-->


        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
            <ion-icon name="arrow-up-outline"></ion-icon>
        </a>
        <!--End Back To Top Button-->

        <!--start switcher-->
        <div class="switcher-body">
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false"
                tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Personalizar tema</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Variaciones de tema</h6>
                    <hr>
                    <div class="form-check form-switch d-flex justify-content-between align-items-center">
                        <input class="form-check-input" type="checkbox" id="switch">
                        <label class="form-check-label" for="switch">Modo Obscuro</label>
                    </div>
                    <hr />
                    <h6 class="mb-0">Colores de encabezado</h6>
                    <hr />
                    <div class="header-colors-indigators">
                        <div class="row row-cols-auto g-3">
                            <div class="col">
                                <div class="indigator headercolor1" id="headercolor1"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor2" id="headercolor2"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor3" id="headercolor3"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor4" id="headercolor4"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor5" id="headercolor5"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor6" id="headercolor6"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor7" id="headercolor7"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor8" id="headercolor8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end switcher-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

    </div>
    <!--end wrapper-->

    <script>
        const base_url = '<?= base_url(); ?>';
    </script>
    <!-- JS Files-->
    <script src="<?= media(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= media(); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= media(); ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= media(); ?>js/summernote-lite.min.js"></script>
    <script src="<?= media(); ?>js/lang/summernote-es-ES.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script type="text/javascript" src="<?= media(); ?>/js/tinymce/tinymce.min.js"></script> -->
    
    <!--plugins-->
    <script src="<?= media(); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= media(); ?>plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= media(); ?>plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= media(); ?>plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="<?= media(); ?>plugins/chartjs/chart.min.js"></script>
    <script src="<?= media(); ?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= media(); ?>plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= media(); ?>plugins/notifications/js/lobibox.min.js"></script>
	<script src="<?= media(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?= media(); ?>plugins/dropzone/dist/dropzone-min.js"></script>
    <script src="<?= media(); ?>js/dataTables.responsive.min.js"></script>
    <script src="<?= media(); ?>js/responsive.bootstrap.min.js"></script>
    <?php if ($data['page_tag'] == 'planearvisita'): ?>
    <script src="<?= media(); ?>site/js/jquery.datetimepicker.full.min.js"></script>
    <script src="<?= media(); ?>js/index.global.min.js"></script>
    <script src="<?= media(); ?>js/es.js"></script>
    <?php endif; ?>
    <!-- <script src="<?= media(); ?>js/index.js"></script> -->
    <!-- Main JS-->
    <script src="<?= media(); ?>js/main.js"></script>
    <?php if(!empty($data['page_functions_js'])): ?>
        <script src="<?= media(); ?>js/<?= $data['page_functions_js'] ?>"></script>
    <?php endif; ?>

</body>

</html>