$categorias<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 11/06/2020
 * Time: 2:23 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>

<hr>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-3 side_col">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar"
                           aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </div>
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

                                        <div class="dropdown-menu categorias_dropdown_container nombre_lineas_menu" aria-labelledby="dropdownMenuLink">
                                            <?php foreach ($sub_catecorias as $sub_categoria) { ?>
                                                <a class="dropdown-item" href="<?php echo base_url().'productos/sub_categoria/'.$categoria->producto_categoria.'/'. $sub_categoria->producto_sub_categoria;?>">
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
                <div class="container listado_categorias">

                    <?php //print_contenido($categorias->result()); ?>
                    <?php if ($categorias) { ?>
                        <div class="row">
                            <?php
                            foreach ($categorias->result() as $categoria) { ?>
                                <div class="col-12 col-md-4 product_col_categorias">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="card-title"><?php echo  $categoria->producto_categoria;?></h5>
                                            <a href="<?php echo base_url().'productos/sub_categoria/'.$linea_actual.'/'. $categoria->producto_categoria;?>" class="btn btn-primary">Sub categorias</a>
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
