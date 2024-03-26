<?php
    headerAdmin($data);
    getModal('modal_privacidad', $data);
?>

        <!--start breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><?= $data['page_title']; ?></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $data['page_title']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <!--start product detail-->
        <section class="shop-page">
            <div class="shop-container">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="product-detail-card">
                            <div class="product-detail-body">
                                <div class="row g-0">
                                    <div class="col-12 col-lg-5">
                                        <div class="image-zoom-section">
                                            <div class="product-gallery border rounded mb-3 p-3" data-slider-id="1">
                                                <div class="item portadaH">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="product-info-section p-3">
                                            <h3 class="mt-3 mt-lg-0 mb-0 "><?= $data['page_title']; ?></h3>
                                            <div class="mt-3">
                                                <p class="status"></p>
                                            </div>
                                            <hr/>
                                            <?php if($data['permisosMod']['w']): ?>
                                                <div class="d-flex gap-2 mt-3 edit">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>

                        <!--start product more info-->
                        <div class="product-more-info">
                            <div class="row g-0">
                                <div class="col col-lg-8 px-3">
                                    <div class="product-review">
                                        <div class="review-list">
                                            <div class="d-flex align-items-start">
                                                <h5 class="mb-4 title"></h5>
                                                <div class="review-content ms-3 description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4 px-3">
                                    <div class="add-review">
                                        <div class="form-body p-3 rounded border bg-light">
                                            <h5 class="mb-4">Imagen Fondo (Parallax)</h5>
                                            <div class="mb-3">
                                                <div class="img_parallax"></div>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="nameespecie"></h6>
                                                <h6 class="namescientific"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>    
            </div>
        </section>
        <!--end product detail-->

<?php
    footerAdmin($data);
?>