<?php
    headerAdmin($data);
    getModal('modal_pagetransparencia', $data);
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

        <!--start page detail-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th class="align-middle text-center">
                                    <p class="mb-0 text-uppercase fs-3 fw-light"><?= $data['page_title']; ?></p>
                                </th>
                                <th class="align-middle text-center portadaH">
                                </th>
                                <th class="align-middle text-center img_parallax">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Portada Principal</td>
                                <td>Imagen de Fondo (Parallax)</td>
                            </tr>
                            <tr>
                                <td>Título página</td>
                                <td class="title"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nombre Especie</td>
                                <td></td>
                                <td class="nameespecie"></td>
                            </tr>
                            <tr>
                                <td>Nombre Científico</td>
                                <td></td>
                                <td class="namescientific"></td>
                            </tr>
                            <tr>
                                <td>Estatus</td>
                                <td class="status"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="edit"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<?php
    footerAdmin($data);
?>