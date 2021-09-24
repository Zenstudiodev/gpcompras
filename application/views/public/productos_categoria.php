<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 12/06/2020
 * Time: 2:24 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>

                    <?php //print_contenido($productos->result()); ?>
                    <?php if ($productos) { ?>
                        <div class="row" id="productos_list_container">
                            <?php
                            foreach ($productos->result() as $producto) {

                                //obtenemos imagenes del producto
                                $imagenes_producto = get_imgenes_producto_public($producto->producto_id);
                                ?>
                                <div class="col-12 col-md-4 product_col_categorias">
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
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>

