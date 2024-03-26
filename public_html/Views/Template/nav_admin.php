    <!--start sidebar -->
    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="<?= media(); ?>site/images/zooleon_logo.svg" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">Zooleón</h4>
            </div>
            <div class="toggle-icon ms-auto">
                <ion-icon name="menu-sharp"></ion-icon>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="<?= base_url(); ?>logout">
                    <div class="parent-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <div class="menu-title">Cerrar Sesión</div>
                </a>
            </li>
            <?php if(!empty($data['permisos'][1]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>dashboard">
                    <div class="parent-icon">
                        <i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][2]['r']) || !empty($data['permisos'][3]['r'])): ?>
            <li class="menu-label">Control de Usuarios</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="menu-title">Admin Usuarios</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][2]['r'])): ?>
                    <li> <a href="<?= base_url(); ?>usuarios">
                        <i class="bi bi-circle"></i>Usuarios
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][3]['r'])): ?>
                    <li> <a href="<?= base_url(); ?>roles">
                        <i class="bi bi-circle"></i>Roles
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][4]['r'])): ?>
            <li class="menu-label">Control de Categorías</li>
            <li>
                <a href="<?= base_url(); ?>categorias">
                    <div class="parent-icon">
                        <i class="bi bi-inboxes-fill"></i>
                    </div>
                    <div class="menu-title">Categorías</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][5]['r']) || !empty($data['permisos'][18]['r'])): ?>
            <li class="menu-label">Control Página Noticias</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="menu-title">Blog de Noticias</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][5]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>blog">
                            <i class="bi bi-circle"></i>Blog
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][18]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>blog/pagenoticias">
                            <i class="bi bi-circle"></i>Página Noticias
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][6]['r']) || !empty($data['permisos'][19]['r']) || !empty($data['permisos'][30]['r']) || !empty($data['permisos'][31]['r'])): ?>
            <li class="menu-label">Control Página Especies</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-hippo"></i>
                    </div>
                    <div class="menu-title">Especies</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][6]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>ejemplares">
                            <i class="bi bi-circle"></i>Especies
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][30]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>births">
                            <i class="bi bi-circle"></i>Nacimientos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][19]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>pageejemplares">
                            <i class="bi bi-circle"></i>Página Especies
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][31]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>pagenacimientos">
                            <i class="bi bi-circle"></i>Página Nacimientos
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <li class="menu-label">Control del Sitio</li>
            <?php if(!empty($data['permisos'][17]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>infogeneral">
                    <div class="parent-icon">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <div class="menu-title">Informacion General del Sitio</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][7]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>historia">
                    <div class="parent-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <div class="menu-title">Historia</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][27]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>cultura">
                    <div class="parent-icon">
                        <i class="fa-solid fa-shapes"></i>
                    </div>
                    <div class="menu-title">Cultura Zooleon</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][21]['r']) || !empty($data['permisos'][25]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-boxes-packing"></i>
                    </div>
                    <div class="menu-title">Paquetes</div>
                </a>
                <ul>
                    <?php if (!empty($data['permisos'][21]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>pagepaquetes">
                            <i class="bi bi-circle"></i>Paquetes
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($data['permisos'][21]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>paqueteshome">
                            <i class="bi bi-circle"></i>Paquetes Home
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($data['permisos'][25]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>pagepaquetes/sitepaquetes">
                            <i class="bi bi-circle"></i>Página Paquetes
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][20]['r']) || !empty($data['permisos'][24]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="menu-title">Atracciones</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][20]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>eventos">
                            <i class="bi bi-circle"></i>Atracciones
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][24]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>eventos/pageatracciones">
                            <i class="bi bi-circle"></i>Página Atracciones
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][23]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>sliders">
                    <div class="parent-icon">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div class="menu-title">Slider Principal</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][9]['r']) || !empty($data['permisos'][10]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-school-circle-xmark"></i>
                    </div>
                    <div class="menu-title">Reglamento</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][9]['r'])): ?>
                    <li> <a href="<?= base_url(); ?>reglamentogral">
                        <i class="bi bi-circle"></i>Reglas
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][10]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>reglamentogral/pagereglamento">
                            <i class="bi bi-circle"></i>Página Reglamento
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][11]['r']) || !empty($data['permisos'][12]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-file-circle-question"></i>
                    </div>
                    <div class="menu-title">FAQS</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][11]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>faq">
                            <i class="bi bi-circle"></i>FAQs
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][12]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>faq/pagefaqs">
                            <i class="bi bi-circle"></i>Página FAQS
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][8]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>politicaprivacidad">
                    <div class="parent-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="menu-title">Política de Privacidad</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][14]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>patrocinadores">
                    <div class="parent-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div class="menu-title">Patrocinadores</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][15]['r'])): ?>
            <li>
                <a href="<?= base_url(); ?>acreditaciones">
                    <div class="parent-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="menu-title">Acreditaciones</div>
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][13]['r']) || !empty($data['permisos'][16]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="menu-title">Contactanos</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][13]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>contactanos">
                            <i class="bi bi-circle"></i>Mensajes
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][16]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>contactanos/pagecontacto">
                            <i class="bi bi-circle"></i>Página Contacto
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][28]['r']) || !empty($data['permisos'][29]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div class="menu-title">Paquetes Grupales</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][28]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>planearvisita">
                            <i class="bi bi-circle"></i>Mensajes Paquetes Grupales
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][29]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>pageplaneavisita">
                            <i class="bi bi-circle"></i>Página Paquetes Grupales
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(!empty($data['permisos'][22]['r']) || !empty($data['permisos'][26]['r'])): ?>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="menu-title">Transparencia</div>
                </a>
                <ul>
                    <?php if(!empty($data['permisos'][22]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>informacionpublica">
                            <i class="bi bi-circle"></i>Formatos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][22]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>informacionpublica/responsables">
                            <i class="bi bi-circle"></i>Responsables
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($data['permisos'][26]['r'])): ?>
                    <li>
                        <a href="<?= base_url(); ?>informacionpublica/pagetransparencia">
                            <i class="bi bi-circle"></i>Página Transparencia
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
        <!--end navigation-->
    </aside>
    <!--end sidebar -->