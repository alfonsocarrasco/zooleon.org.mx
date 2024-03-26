<?php
    headerAdmin($data);
    getModal('modal_cultura', $data);
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
                                            <h3 class="mt-3 mt-lg-0 mb-0 title"></h3>
                                            <div class="mt-3">
                                                <p class="status"></p>
                                                <hr/>
                                                <h5 class="titleMision"></h5>
                                                <p class="mb-0 mision"></p>
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
                                <div class="col col-lg-6 px-3">
                                    <div class="product-review">
                                        <div class="review-list">
                                            <div>
                                                <h5 class="mb-4 titleVision"></h5>
                                                <div class="review-content ms-3 vision">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 px-3">
                                    <div class="product-review">
                                        <div class="review-list">
                                            <div>
                                                <h5 class="mb-4 titleValores"></h5>
                                                <div class="review-content ms-3 valores">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-12 col-lg-6 parallax1 pe-3"></div>
                                <div class="col-12 col-lg-6 parallax2 pe-3"></div>
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