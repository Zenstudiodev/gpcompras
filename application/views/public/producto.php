<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 11/06/2020
 * Time: 3:14 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
if ($producto) {
    $producto = $producto->row();
}

if ($catgoria) {
    $catgoria = $catgoria->row();
}

$ci =& get_instance();
?>

<?php $this->start('css_p') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>/ui/vendor/lightbox2/css/lightbox.min.css">
<?php $this->stop() ?>

<?php $this->start('page_content') ?>

<hr>
<section id="detalle_producto">
    <?php if ($producto) { ?>
        <div id="breadcrumb_conteiner">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a
                                href="<?php echo base_url() . 'productos/categoria/' . $catgoria->categoria_id ?>"><?php echo $catgoria->nombre_categoria; ?></a>
                    </li>
                </ol>
            </nav>
        </div>

    <?php } ?>
    <div class="container">
        <?php //if (false) { ?>

        <div class="row">
            <div class="col-12 col-md-12">
                <div class="container">

                    <?php //print_contenido($productos->result()); ?>
                    <?php if ($producto) { ?>
                        <div class="row">
                            <div class="col">
                                <?php if (isset($mensaje)) { ?>
                                    <div class="alert alert-success alert-block"><a class="close" data-dismiss="alert"
                                                                                    href="#">×</a>
                                        <h4 class="alert-heading">Acción exitosa!</h4>
                                        <p>
                                            <?php echo $mensaje; ?> <a
                                                    href="<?php echo base_url() ?>carrito/ver"
                                                    class="btn btn-success">Ver carrito</a>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
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
                            <div class="col-12 col-md-6">

                                <h2 class="nombre_producto"><?php echo $producto->producto_nombre; ?></h2>
                                <p class="precio">
                                    <span class="cantidad_precio">
                                        <span class="simbolo_precio">Q</span><?php echo number_format($producto->producto_precio, 2, '.', ','); ?>
                                    </span>
                                </p>
                                <p><?php echo $producto->producto_descripcion; ?></p>
                                <hr>
                                <p>
                                    Código: <span
                                            class="badge badge-secondary"><?php echo $producto->producto_codigo; ?></span>
                                </p>
                                <p>

                                    <?php
                                    if ($ci->ion_auth->logged_in()) { ?>

                                <div class="input-group mb-3">
                                    <input type="number" min="1" class="form-control" value="1"
                                           aria-label="Cantidad de productos" aria-describedby="agregar_al_carrito"
                                           id="cantidad_producto" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button" id="agregar_al_carrito">Agregar a
                                            carrito
                                        </button>
                                    </div>
                                </div>

                                <?php } else { ?>
                                    Para comprar debe iniciar sesión
                                    <br>
                                    <a class="btn btn-success" href="<?php echo base_url() ?>User/login">Ingresar <i
                                                class="fas fa-sign-in-alt"></i></a>
                                    <!--<a class="top_boton" href="<?php echo base_url() ?>User/registro">Registrarse <i
                                    class="fas fa-user-plus"></i></a>-->
                                <?php } ?>

                                </p>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Marca:</span> <?php echo $producto->producto_marca; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Color:</span> <?php echo $producto->producto_color; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Medidas:</span> <?php echo $producto->producto_medidas; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php //print_contenido($producto); ?>

                    <? } else { ?>
                        <h3>Producto no disponible</h3>
                    <? } ?>
                    <hr>
                    <?php if($producto){ ?>
                    <a class="btn btn-success" href="<?php echo base_url().'productos/categoria/'.$producto->producto_categoria_sub_categoria;?>">Regresar</a>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<script src="<?php echo base_url(); ?>/ui/vendor/lightbox2/js/lightbox-plus-jquery.min.js"></script>
<!--<script src="<?php /*echo base_url(); */ ?>/ui/vendor/numeral/numeral.min.js"></script>-->
<script>
    lightbox.option({
        'resizeDuration': 200,
        'showImageNumberLabel': false,
        'wrapAround': true,
        'fitImagesInViewport': true,
        'alwaysShowNavOnTouchDevices': true,
    });
</script>

<script>


    var codigo_producto;
    var cantidad_producto;

    $("#agregar_al_carrito").click(function () {

        var inpObj = document.getElementById("cantidad_producto");
        if (inpObj.checkValidity()) {
            console.log('valido');
            codigo_producto = '<?php echo $producto->producto_id;?>';
            cantidad_producto = $("#cantidad_producto").val();
            console.log('agregar ' + cantidad_producto + ' de producto ' + codigo_producto);

            window.location = "<?php echo base_url()?>carrito/agregar_producto/" + codigo_producto + "/" + cantidad_producto;
        } else {
            console.log('invalido');

        }


    });
</script>
<?php $this->stop() ?>
