<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:12 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');


?>
<?php $this->start('banner') ?>
<?php if (isset($header_banners)) { ?>
    <hr>
    <div class="container">


        <div class="row">

            <div class="col-12 col-xl-12" >
                <div id="banner_container">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <?php
                            $start_banner = 0;
                            foreach ($header_banners->result() as $banner) { ?>
                                <div class="carousel-item <?php if ($start_banner < 1) {
                                    echo 'active';
                                } ?> ">
                                    <a href="<?php echo $banner->link_bh ?>" target="_blank"
                                       banner_id="<?php echo $banner->id_bh; ?>">
                                        <img src="<?php echo base_url() . 'ui/public/imagenes/banners/' . $banner->imagen_bh . '.jpg' ?>"
                                             class="d-block w-100">
                                    </a>
                                </div>

                                <?php $start_banner++ ?>


                            <?php } ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<?php $this->stop() ?>


<?php $this->start('page_content') ?>
    <div id="iconos_top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="iconos_top_card">
                        <i class="fas fa-truck"></i>
                        <h3>Politicas de envío
                            <small></small>
                        </h3>
                    </div>
                </div>
                <div class="col">
                    <div class="iconos_top_card">
                        <i class="fas fa-headset"></i>
                        <h3>Servicio al cliente
                            <small></small>
                        </h3>
                    </div>
                </div>
                <div class="col">
                    <div class="iconos_top_card">
                        <i class="fas fa-certificate"></i>
                        <h3>Garantía
                            <small></small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ofertas_block">
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="productos_front_page">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php if ($productos) { ?>
                        <div class="row" id="productos_list_container">
                            <?php
                            foreach ($productos->result() as $producto) {

                                //obtenemos imagenes del producto
                                $imagenes_producto = get_imgenes_producto_public($producto->producto_id);
                                ?>
                                <div class="col-12 col-md-3 product_col_categorias">
                                    <div class="card product_card">

                                        <?php
                                        //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                        if ($imagenes_producto) { ?>
                                            <div class="item">
                                                <a href="<?php echo base_url() . '/productos/ver_producto/' . $producto->producto_id; ?>">
                                                    <div class="image_list_holder">
                                                        <img src="<?php echo base_url() . 'upload/productos_img/' . $producto->producto_id . '.jpg'; ?>"
                                                             class=" card-img-top img_lista_categoria">
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>ui/public/imagenes/placeholder.png"
                                                 class="card-img-top img_lista_categoria " alt="...">
                                        <?php } ?>


                                        <div class="card-body">

                                            <a href="<?php echo base_url() . 'productos/ver_producto/' . $producto->producto_id; ?>">
                                                <h2 class="titulo_producto_list">
                                                    <?php echo mb_strtolower($producto->producto_nombre); ?>
                                                </h2>
                                            </a>


                                            <p class="card-text cat_codigo_producto">
                                                Q <?php echo $producto->producto_precio; ?></p>
                                            <!--<a href="<?php /*echo base_url() . 'index.php/productos/ver_producto/' . $producto->producto_codigo; */ ?>" class="btn btn-primary product_list_btn">Cotizar</a>-->
                                            <a href="<?php echo base_url() . 'productos/ver_producto/' . $producto->producto_id; ?>"
                                               class="btn btn-primary product_list_btn">Detalle</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <? } else { ?>
                        <h3>No hay productos</h3>
                    <? } ?>
                </div>
            </div>
        </div>

    </div>
    <div id="home_parallax">

    </div>
<?php $this->stop() ?>