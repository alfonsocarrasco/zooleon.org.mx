<!-- Modal -->
<div class="modal fade" id="modalFormEjemplar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formEjemplar" class="formEjemplar">
                        <input type="hidden" id="idEspecie" name="idEspecie" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="foto_actual_alimentacion" id="foto_actual_alimentacion" value="">
                        <input type="hidden" name="foto_remove_alimentacion" id="foto_remove_alimentacion" value="0">
                        <input type="hidden" name="foto_actual_tamanio" id="foto_actual_tamanio" value="">
                        <input type="hidden" name="foto_remove_tamanio" id="foto_remove_tamanio" value="0">
                        <input type="hidden" name="foto_actual_distribucion" id="foto_actual_distribucion" value="">
                        <input type="hidden" name="foto_remove_distribucion" id="foto_remove_distribucion" value="0">
                        <input type="hidden" name="foto_actual_peso" id="foto_actual_peso" value="">
                        <input type="hidden" name="foto_remove_peso" id="foto_remove_peso" value="0">
                        <input type="hidden" name="foto_actual_habitat" id="foto_actual_habitat" value="">
                        <input type="hidden" name="foto_remove_habitat" id="foto_remove_habitat" value="0">
                        <input type="hidden" name="foto_actual_sabias" id="foto_actual_sabias" value="">
                        <input type="hidden" name="foto_remove_sabias" id="foto_remove_sabias" value="0">
                        <input type="hidden" name="foto_actual_conservacion" id="foto_actual_conservacion" value="">
                        <input type="hidden" name="foto_remove_conservacion" id="foto_remove_conservacion" value="0">
                        <input type="hidden" name="foto_actual_ubicacion" id="foto_actual_ubicacion" value="">
                        <input type="hidden" name="foto_remove_ubicacion" id="foto_remove_ubicacion" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNombreEspecie" name="txtNombreEspecie" placeholder="Nombre Ejemplar">
                                    <label for="txtNombreEspecie" class="form-label">Nombre Ejemplar <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNombreCientifico" name="txtNombreCientifico" placeholder="Nombre Científico">
                                    <label for="txtNombreCientifico" class="form-label">Nombre Científico <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Agrega una foto de portada (1920x820)px</label>
                                    <div class="prevPhoto prevPortadaCat noticias">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Alimentación (620x285)px</label>
                                    <div class="prevPhotoAlimentacion">
                                        <span class="delPhoto2 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto2"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img2">
                                        </div>
                                        <div class="upimg2">
                                            <input type="file" name="foto2" id="foto2">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Tamaño (535x340)px</label>
                                    <div class="prevPhotoTamanio">
                                        <span class="delPhoto3 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto3"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img3">
                                        </div>
                                        <div class="upimg3">
                                            <input type="file" name="foto3" id="foto3">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Peso (515x315)px</label>
                                    <div class="prevPhotoPeso">
                                        <span class="delPhoto4 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto4"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img4">
                                        </div>
                                        <div class="upimg4">
                                            <input type="file" name="foto4" id="foto4">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Hábitat (535x400)px</label>
                                    <div class="prevPhotoHabitat">
                                        <span class="delPhoto5 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto5"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img5">
                                        </div>
                                        <div class="upimg5">
                                            <input type="file" name="foto5" id="foto5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Distribución (635x465)px</label>
                                    <div class="prevPhotoDistribucion">
                                        <span class="delPhoto6 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto6"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img6">
                                        </div>
                                        <div class="upimg6">
                                            <input type="file" name="foto6" id="foto6">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Sabías Qué? (530x420)px</label>
                                    <div class="prevPhotoSabias">
                                        <span class="delPhoto7 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto7"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img7">
                                        </div>
                                        <div class="upimg7">
                                            <input type="file" name="foto7" id="foto7">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Conservación (1230x530)px</label>
                                    <div class="prevPhotoConservacion">
                                        <span class="delPhoto8 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto8"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img8">
                                        </div>
                                        <div class="upimg8">
                                            <input type="file" name="foto8" id="foto8">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Imagen Ubicación (1920x943)px</label>
                                    <div class="prevPhotoUbicacion">
                                        <span class="delPhoto9 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto9"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img9">
                                        </div>
                                        <div class="upimg9">
                                            <input type="file" name="foto9" id="foto9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" id="txtCoordX" name="txtCoordX" min="0" max="100" placeholder="Ingresa la ubicación en X">
                                    <label for="txtCoordX" class="form-label">Ubicación en X, ejem.:(25%)</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control" id="txtCoordY" name="txtCoordY" min="0" max="100" placeholder="Ingresa la ubicación en Y">
                                    <label for="txtCoordY" class="form-label">Ubicación en Y, ejem.:(25%)</label>
                                </div>
                                <hr>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloVideo" name="txtTituloVideo" placeholder="Ingresa título del video">
                                    <label for="txtTituloVideo" class="form-label">Título Video </label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtVideo" name="txtVideo" placeholder="Ingresa el link del video">
                                    <label for="txtVideo" class="form-label">Video</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="txtGaleria" class="form-label">Galería</label>
                                    <div id="dropzone" class="dropzone">
                                        <div class="dz-default dz-message">
                                            <button class="dz-button" type="button"><i class="bi bi-cloud-arrow-up-fill"></i></button>
                                            <span class="text-dropzone">Arrastra las imagenes aquí o haga click para cargarlas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="imgGaleria d-flex justify-content-center mb-3"></div>
                                <input type="hidden" id="imgGaleriaActual" name="imgGaleriaActual" value="">
                            </div>
                            <div class="row g-1">
                                <div class="form-floating col-6">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listCategoria" name="listCategoria">
                                    </select>
                                    <label for="listCategoria" class="form-label">Categoría <span class="required">*</span></label>
                                </div>
                                <div class="form-floating col-6">
                                    <input type="number" min="1" class="form-control" id="intPosicion" name="intPosicion" placeholder="Ingrese el Orden">
                                    <label for="intPosicion" class="form-label">Ingrese el Orden </label>
                                </div>
                                <div class="form-floating col-12">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listStatus" name="listStatus">
                                        <option value="" selected>Seleccionar Estatus</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                    <label for="listStatus" class="form-label">Estatus de Ejemplar <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                <button type="submit" class="btn btn-primary mb-3" id="btnActionForm"><i class="bi bi-check2-circle"></i><span id="btnText">Guardar</span></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View User -->
<div class="modal fade" id="modalViewEjemplar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del Ejemplar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="card overflow-hidden radius-10">
                            <div class="profile-cover bg-dark position-relative mb-4" style>
                                <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x portadaImg">
                                    <img src="https://via.placeholder.com/110X110/212529/fff" alt="...">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mt-5 d-flex align-items-start justify-content-between">
                                    <div class="">
                                        <h3 class="mb-2 nombreEspecie"></h3>
                                        <p class="mb-1 nombreCientifico"></p>
                                        <p>Categoria: <span class="nombrecat"></span></p>
                                        <div class="status"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="mb-2"><i class="fa-solid fa-book-open"></i> Tamaño</h4>
                                        <div class="especie tamanio_img"></div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="my-3"><i class="fa-solid fa-earth-americas"></i> Distribución</h4>
                                        <div class="mt-3 mb-0 distribution_img d-flex justify-content-center"></div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="mb-2"><i class="fa-solid fa-book-open"></i> Peso</h4>
                                        <div class="especie peso_img"></div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="my-3"><i class="fa-solid fa-earth-americas"></i> Hábitat</h4>
                                        <div class="mt-3 mb-0 habitat_img d-flex justify-content-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-3">
                        <div class="card radius-10">
                            <div class="card-body">
                                <h5 class="mb-3"><i class="bi bi-question-circle-fill"></i> Sabías que...</h5>
                                <div class="mb-3 sabiasq"></div>
                                <h5 class="mb-3"><i class="fa-solid fa-bowl-food"></i> Alimentación</h5>
                                <div class="my-3 food-img d-flex justify-content-center"></div>
                                <h5 class="mb-3"><i class="fa-solid fa-hand-holding-heart"></i> Conservación</h5>
                                <div class="mb-0 conservacion"></div>
                                <h5 class="mb-3"><i class="fa-solid fa-location-dot"></i> Ubicación</h5>
                                <div class="mb-0 location"></div>
                            </div>
                        </div>
                        <div class="card radius-10">
                            <div class="card-body">
                                <h5 class="mb-3"><i class="fa-solid fa-video"></i> Video</h5>
                                <div class="especie title_v"></div>
                                <div class="especie video"></div>
                            </div>
                        </div>

                        <div class="card radius-10">
                            <div class="card-body">
                                <h5 class="mb-3"><i class="fa-solid fa-image"></i> Foto Galería</h5>
                                <div class="especies galeria"></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>