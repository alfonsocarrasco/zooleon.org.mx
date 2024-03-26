        <footer class="footer">
            <div class="divider-footer">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>
            <div class="enlaces" data-aos="fade-down" data-aos-duration="750">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-12">
                            <h4>Enlaces</h4>
                        </div>
                        <div class="col-12 menu-enlaces d-flex flex-column justify-content-center align-items-center">
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="<?= base_url(); ?>">Inicio</a></li>
                                <li><a href="<?= base_url(); ?>zooleon">Zooleón</a></li>
                                <li><a href="<?= base_url(); ?>paquetes">Tu visita</a></li>
                                <li><a href="<?= base_url(); ?>contacto">Contacto</a></li>
                            </ul>
                            <div class="e-borde"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="partners-social">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-12 col-xl-6 d-flex justify-content-center" data-aos="fade-right" data-aos-duration="750">
                            <div class="container-lg">
                                <div class="row partners">
                                    <div class="col-12">
                                        <h4>Patrocinadores</h4>
                                    </div>
                                    <div class="partners-img">
                                        <?php
                                            $patrocinadores = getPatrocinadores();
                                            for ($i=0; $i < count($patrocinadores); $i++):
                                                $imageSponsor = media().'images/uploads/'.$patrocinadores[$i]['imagenpatrocinador'];
                                        ?>
                                            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                                                <img src="<?= $imageSponsor; ?>" alt="<?= $patrocinadores[$i]['nombrepatrocinador']; ?>">
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6 social-media d-flex flex-column justify-content-center align-items-center" data-aos="fade-left" data-aos-duration="750">
                            <h4>Síguenos en:</h4>
                            <ul class="d-flex">
                                <li><a href="<?= $data['infogral']['facebook']; ?>" target="_blank"><img src="<?= media(); ?>site/images/social/facebook.svg" alt="facebook"></a></li>
                                <li><a href="<?= $data['infogral']['instagram']; ?>" target="_blank"><img src="<?= media(); ?>site/images/social/instagram.svg" alt="instagram"></a></li>
                                <li><a href="<?= $data['infogral']['twitter']; ?>" target="_blank"><img src="<?= media(); ?>site/images/social/twitter.svg" alt="twitter"></a></li>
                                <li><a href="<?= $data['infogral']['youtube']; ?>" target="_blank"><img src="<?= media(); ?>site/images/social/youtube.svg" alt="youtube"></a></li>
                                <li><a href="<?= $data['infogral']['tiktok']; ?>" target="_blank"><img src="<?= media(); ?>site/images/social/tiktok.svg" alt="tiktok"></a></li>
                            </ul>
                            <?php
                                $timeStart = new DateTime($data['infogral']['horario_apertura']);
                                $timeEnd = new DateTime($data['infogral']['horario_cierre']);
                            ?>
                            <h4 class="cierre">Horario de servicio:</h4>
                            <p><?= $data['infogral']['dias_apertura']; ?> de <?= $timeStart->format('g a').' a '.$timeEnd->format('g a'); ?></p>
                            <p><?= $data['infogral']['dias_cierre']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="foot-menu">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="700">
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="<?= base_url(); ?>acercade">Acerca de</a></li>
                                <li><a href="<?= base_url(); ?>faqs">FAQS</a></li>
                                <li><a href="<?= base_url(); ?>noticias">Noticias</a></li>
                                <li><a href="<?= base_url(); ?>reglamento">Reglamento</a></li>
                                <li><a href="<?= base_url(); ?>transparencia">Transparencia</a></li>
                                <li><a href="<?= base_url(); ?>politicadeprivacidad">Política de Privacidad</a></li>
                                <li><a href="https://drive.google.com/file/d/1677y1uTfFj7tARSdAiKKkDygUAbh02Jy/view" target="_blank">Términos y Condiciones</a></li>
                            </ul>
                        </div>
                        <div class="col-12 copyright" data-aos="fade-up" data-aos-offset="50" data-aos-easing="ease-in-sine" data-aos-duration="800">
                            <p>Zoológico de León © <?= date('Y'); ?> Todos los derechos reservados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Messenger Plugin de chat Code -->
    <div id="fb-root"></div>
    <!-- Your Plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    <script src="<?= media(); ?>site/js/jquery.js"></script>
    <script src="<?= media(); ?>site/js/bootstrap.bundle.min.js"></script>
    <?php if ($data['page_tag'] == 'home' || $data['page_tag'] == 'faqs' || $data['page_tag'] == 'contacto'): ?>
    <script src="<?= media(); ?>site/js/leaflet.js"></script>
    <script src="<?= media(); ?>site/js/leaflet-routing-machine.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.79.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="<?= media(); ?>site/js/lrm-graphhopper-1.2.0.js"></script>
    <?php endif; ?>
    <script src="<?= media(); ?>site/js/slick.min.js"></script>
    <script src="<?= media(); ?>site/js/slick-animation.js"></script>
    <script src="<?= media(); ?>site/js/aos.js"></script>
    <?php if ($data['page_tag'] == 'contacto' || $data['page_tag'] == 'planeavisita'): ?>
    <script src="<?= media(); ?>plugins/notifications/js/lobibox.min.js"></script>
	<script src="<?= media(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?= media(); ?>site/js/jquery.datetimepicker.full.min.js"></script>
    <script> const base_url = '<?= base_url(); ?>'; </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LczrGQkAAAAAHX_mSuhIw_QCC22lZwI8cAIlVc7', {action: 'submit'}).then(function(token) {
                if (document.querySelector('#fcontacto')) {
                    $('#fcontacto').prepend('<input type="hidden" name="token" value="' + token + '">');
                    $('#fcontacto').prepend('<input type="hidden" name="action" value="submit">');
                } else {
                    $('#fpvisita').prepend('<input type="hidden" name="token" value="' + token + '">');
                    $('#fpvisita').prepend('<input type="hidden" name="action" value="submit">');
                }
            });
        });
    </script>
    <?php endif; ?>
    <?php if ($data['page_tag'] == 'transparencia'): ?>
    <script src="<?= media(); ?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= media(); ?>plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= media(); ?>js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= media(); ?>js/dataTables.responsive.min.js"></script>
    <script src="<?= media(); ?>js/responsive.bootstrap.min.js"></script>
    <script> const base_url = '<?= base_url(); ?>'; </script>
    <?php endif; ?>
    <?php if (isset($data['page_functions_js'])): ?>
    <script src="<?= media(); ?>js/<?= $data['page_functions_js']; ?>"></script>
    <?php endif; ?>
    <script src="<?= media(); ?>site/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            $('#main-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                arrows: true,
                pauseOnHover: false
            }).slickAnimation();
        });

        $(document).ready(function() {
            $('.partners-img').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                autoplay: true,
                arrows: false
            });
        });

        if (document.querySelector('#mapa')) {

            const lat = 21.182644239951454;
            const lng = -101.64996963863699;
            const zoom = 13;

            let map = L.map('mapa').setView([lat, lng], zoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: false
            }).addTo(map);

            marker.bindPopup(
                '<div class="d-flex justify-content-center mb-3"><img src="<?= media(); ?>site/images/zooleon_logo.svg" alt="" class="logo-foot"></div><h5 style="text-align: center"><b><?= $data['infogral']['title_contacto']; ?></b></h5><h5 style="text-align: center"><?= $data['infogral']['direccion']; ?></h5>'
            ).openPopup();

            let control = L.Routing.control({
                language: 'es',
                waypoints: [
                    L.latLng(lat, lng),
                    L.latLng(21.150141119337583, -101.67573009760793),
                ],
                router: L.Routing.graphHopper('3b906644-dba7-42f9-89ee-0ae34ab45285'),
                // geocoder: L.Control.Geocoder.openrouteservice({
                //     serviceUrl: 'https://api.openrouteservice.org/geocode/',
                //     apiKey: '5b3ce3597851110001cf62481f57a75edf5a49689dbb127af6b8d13c'
                // }),
                routeWhileDragging: false,
                reverseWaypoints: true,
                showAlternatives: true,
                // geocoder: L.Control.Geocoder.nominatim(),
                altLineOptions: {
                    styles: [
                        {color: 'black', opacity: 0.15, weight: 9},
                        {color: 'white', opacity: 0.8, weight: 6},
                        {color: 'blue', opacity: 0.5, weight: 2}
                    ]
                },
                waypointNameFallback: function(latLng) {
                    function zeroPad(n) {
                        n = Math.round(n);
                        return n < 10 ? '0' + n : n;
                    }
                    function hexagecimal(p, pos, neg) {
                        var n = Math.abs(p),
                            degs = Math.floor(n),
                            mins = (n - degs) * 60,
                            secs = (mins - Math.floor(mins)) * 60,
                            frac = Math.round((secs - Math.floor(secs)) * 100);
                        return (n >= 0 ? pos : neg) + degs + '°' + zeroPad(mins) + '\'' + zeroPad(secs) + '.' + zeroPad(frac) + '"';
                    }

                    return hexagecimal(latLng.lat, 'N', 'S') + ' ' + hexagecimal(latLng.lng, 'E', 'W');
                }
            }).on('routingerror', function(e) {
                try {
                    map.getCenter();
                } catch (e) {
                    map.fitBounds(L.latLngBounds(control.getWaypoints().map(function(wp) { return wp.latLng; })));
                }

                handleError(e);
            }).addTo(map);

            L.Routing.errorControl(control).addTo(map);

            // My geolocation
            L.control.locate().addTo(map);

            // Customs Button
            const customControl = L.Control.extend({
                options: {
                    position: 'bottomleft',
                },

                onAdd: () => {

                    // Create button go to google maps
                    let btn = L.DomUtil.create('a', 'btn-custom'),
                        span = L.DomUtil.create('span', '', btn);
                    btn.href = 'https://goo.gl/maps/xmuCYRjnev2837yK7';
                    btn.title = 'Ver Ruta';
                    btn.setAttribute( 'style', 'color: white; font-size: 12px;');
                    btn.setAttribute('target', '_blank');
                    span.innerHTML = 'Ver ruta en google maps<i class="fa-solid fa-arrow-right-long"></i>';

                    return btn;

                }
            });
            // Adding new button to map
            map.addControl(new customControl());

            const htmlTemplate = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M32 18.451L16 6.031 0 18.451v-5.064L16 .967l16 12.42zM28 18v12h-8v-8h-8v8H4V18l12-9z" /></svg>';

            const homeButton = L.Control.extend({
                options: {
                    position: 'topleft'
                },

                onAdd: (map) => {
                    // create button
                    const btnHome = L.DomUtil.create('button');
                    btnHome.title = 'back to home';
                    btnHome.innerHTML = htmlTemplate;
                    btnHome.className += 'leaflet-bar back-to-home hidden';

                    return btnHome;
                }
            })

            map.addControl(new homeButton());

            // on drag end
            map.on('moveend', getCenterOfMap);

            const buttonBackToHome = document.querySelector('.back-to-home');

            function getCenterOfMap() {
                buttonBackToHome.classList.remove('hidden');

                buttonBackToHome.addEventListener('click', () => {
                    map.flyTo([lat, lng], zoom);
                });

                map.on('moveend', () => {
                    const { lat: latCenter, lng: lngCenter } = map.getCenter();

                    const latC = latCenter.toFixed(3) * 1;
                    const lngC = lngCenter.toFixed(3) * 1;

                    const defaultCoordinate = [+lat.toFixed(3), +lng.toFixed(3)];

                    const centerCoordinate = [latC, lngC];

                    if (compareToArrays(centerCoordinate, defaultCoordinate)) {
                    buttonBackToHome.classList.add('hidden');
                    }
                });
            }

            const compareToArrays = (a, b) => JSON.stringify(a) === JSON.stringify(b);
        }
        
        AOS.init();
    </script>

    <?php if ($data['page_tag'] == 'especies'): ?>
    <script>
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function jump(h){
            let top = document.getElementById(h).offsetTop;
            window.scrollTo(0, top);
        }
    </script>
    <?php endif; ?>

    <script>
        // our SDK code
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "171336062933633");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml       :  true,
                version     : 'v15.0'
            });
        };
        
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        } (document, 'script', 'facebook-jssdk'));
    </script>

</body>
</html>