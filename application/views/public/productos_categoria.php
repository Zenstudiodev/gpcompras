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
            <div class="col-12 col-xl-3 side_col">
                <form name="buscar_form" action="<?php echo base_url(); ?>productos/buscar_producto" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar" name="buscar_input" value="<?php echo $keyword; ?>"
                               aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                        class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <h3 class="titulo_lineas">Categorías</h3>
                <ul class="list-group">
                    <?php
                    if ($categorias) {
                        foreach ($categorias->result() as $categoria) { ?>

                            <li class="list-group-item  align-items-center">

                                <?php $sub_catecorias = sub_categorias_de_categoria($categoria->producto_categoria);
                                if ($sub_catecorias) {
                                    ?>

                                    <div class="dropdown">
                                        <a class=" dropdown-toggle nombre_lineas_menu"
                                           href="<?php echo base_url() . 'productos/sub_categoria/' . $categoria->producto_categoria ?>"
                                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true"
                                           aria-expanded="false">
                                            <?php echo mb_strtolower($categoria->producto_categoria); ?>
                                        </a>

                                        <div class="dropdown-menu categorias_dropdown_container nombre_lineas_menu"
                                             aria-labelledby="dropdownMenuLink">
                                            <?php foreach ($sub_catecorias as $sub_categoria) { ?>
                                                <a class="dropdown-item"
                                                   href="<?php echo base_url() . 'productos/listado_productos_categoria/' . $categoria->producto_categoria . '/' . $sub_categoria->producto_sub_categoria; ?>">
                                                    <?php echo mb_strtolower($sub_categoria->producto_sub_categoria); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'index.php/productos/linea/' . $linea->producto_linea ?>">
                                        <?php echo $linea->producto_linea; ?>
                                    </a>
                                <?php } ?>


                                <!--<span class="badge badge-primary badge-pill">14</span>-->
                            </li>
                        <?php }
                    }
                    ?>

                </ul>
                <hr>
            </div>
            <div class="col-12 col-xl-9">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>

                    <?php //print_contenido($productos->result()); ?>
                    <?php if ($productos_sub_categoria) { ?>
                        <div class="row" id="productos_list_container">
                            <?php
                            foreach ($productos_sub_categoria->result() as $producto) {

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

