<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 21/06/2021
 * Time: 12:21
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');


if ($producto) {
    $producto = $producto->row();
}


?>
<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<?php
//print_contenido($producto);
?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_id ?>
                                <span class="badge badge-primary badge-pill">producto_id</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_nombre ?>
                                <span class="badge badge-primary badge-pill">Nombre producto</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_categoria ?>
                                <span class="badge badge-primary badge-pill">Categoria producto</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_sub_categoria ?>
                                <span class="badge badge-primary badge-pill">Sub categoria</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_material ?>
                                <span class="badge badge-primary badge-pill">Material</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_marca ?>
                                <span class="badge badge-primary badge-pill">Marca</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_descripcion ?>
                                <span class="badge badge-primary badge-pill">Descripción</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_color ?>
                                <span class="badge badge-primary badge-pill">Color</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_medidas ?>
                                <span class="badge badge-primary badge-pill">Medidas</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_existencias ?>
                                <span class="badge badge-primary badge-pill">Existencias</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_precio ?>
                                <span class="badge badge-primary badge-pill">Precio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_precio_oferta ?>
                                <span class="badge badge-primary badge-pill">precio oferta</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_envio_capital ?>
                                <span class="badge badge-primary badge-pill">Envio capital</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $producto->producto_envio_interior ?>
                                <span class="badge badge-primary badge-pill">envio interior</span>
                            </li>

                        </ul>
                    </div>
                    <div class="col">
                        <?php
                        $imagenes_producto = get_imgenes_producto_public($producto->producto_id);
                        ?>
                        <?php if ($imagenes_producto) { ?>
                            <?php
                            $start_banner = 0;
                            foreach ($imagenes_producto->result() as $imagen) {

                                $wrapper_class = "img_wreapper";
                                $img_class = "";
                                if ($start_banner >= 1) {
                                    $img_class = 'thumb';
                                    $wrapper_class = "thumb_img_wreapper";
                                }


                                ?>

                                <div class=" <?php echo $wrapper_class; ?>">
                                    <a href="<?php echo base_url() . '/upload/productos_img/' . $imagen->nombre_imagen; ?>"
                                       data-lightbox="<?php echo 'prod_' . $producto->producto_nombre; ?>"
                                       data-title="<?php echo $producto->producto_nombre; ?>">
                                        <img class=" img_producto img-fluid <?php echo $img_class; ?>"
                                             src="<?php echo base_url() . '/upload/productos_img/' . $imagen->nombre_imagen; ?>"
                                             alt="<?php echo $producto->producto_nombre; ?>">
                                    </a>
                                    <i class="fa fa-search-plus img_zoom_icon" aria-hidden="true"></i>
                                </div>

                                <?php $start_banner++ ?>
                            <?php } ?>

                        <?php } else { ?>
                            <img src="<?php echo base_url() ?>ui/public/imagenes/placeholder.png"
                                 class="card-img-top" alt="...">
                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>


    <!--fin de <div class="container-fluid">-->
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>