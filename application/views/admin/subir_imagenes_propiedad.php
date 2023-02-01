<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 15/06/2020
 * Time: 5:26 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master',
    array(
        'menu' => $menu
    ));


if ($producto) {
    $producto = $producto->row();
}
?>
<?php $this->start('css_p') ?>
<!-- Dropzone -->
<link rel="stylesheet" href="<?php base_url() ?>/ui/vendor/dropzone/dropzone.css">
<?php $this->stop() ?>

<?php $this->start('page_content') ?>
<div class="container">
    <?php if (isset($message)) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $message; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if ($producto) { ?>
        <div class="card">
            <div class="card-header">
                Subir imágenes producto ID:<?php echo $producto->producto_id; ?>
                - <?php echo $producto->producto_nombre; ?>
            </div>
            <div class="card-body">
                <?php if (isset($mensaje)) { ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?php echo $mensaje ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php } ?>
                <form action="<?php echo base_url() ?>Productos/guardar_imagen" class="dropzone" id="dpf">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </form>
                <hr>
                <?php
                if ($fotos_producto) {
                    ?>
                    <div class="row">
                        <?php foreach ($fotos_producto->result() as $imagen) { ?>
                            <div class="col-md-4">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <i class="fas fa-file-image"></i>
                                        <h3 class="box-title"><?php echo $imagen->nombre_imagen ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <img class="img-fluid pad img_subida"
                                             src="<?php echo base_url() . '/upload/productos_img/' . $imagen->nombre_imagen; ?>"
                                             alt="Photo">
                                        <a href="<?php echo base_url() . 'admin/borrar_imagen/' . $imagen->imagen_id . '/' . $producto->producto_id; ?>"
                                           class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                        </a>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                <?php } ?>
            </div>
        </div>

    <?php } else { ?>
        <div class="row">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×
                </button>
                <h4><i class="fas fa-bell"></i> el producto que busca no existe</h4>
            </div>
        </div>
    <?php } ?>

    <hr>
    <div class="row">
        <a class=" btn btn-success"
           href="<?php echo base_url() . 'admin/'?>">Publicar anuncio</a>
    </div>
</div>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<!-- Dropzone js-->
<script src="<?php echo base_url(); ?>/ui/vendor/dropzone/dropzone.js"></script>
<!-- page script -->
<script>
    //variables

    // This example uses jQuery so it creates the Dropzone, only when the DOM has
    // loaded.

    // Disabling autoDiscover, otherwise Dropzone will try to attach twice.
    Dropzone.autoDiscover = false;
    // or disable for specific dropzone:
    // Dropzone.options.myDropzone = false;

    $(function () {
        // Now that the DOM is fully loaded, create the dropzone, and setup the
        // event listeners
        var myDropzone = new Dropzone("#dpf ",
            {
                url: "<?php echo base_url()?>Admin/guardar_imagen?pid=<?php echo $producto->producto_id;?>",
                paramName: "imagen_propiedad",
                parallelUploads: 1,
                maxFiles: 15,
                acceptedFiles: ".jpg,.jpeg",
                resizeWidth: '1920',
                //resizeMimeType: '.jpg',
                //uploadMultiple: true,
                //chunking: true,
                //retryChunks: true,
                //forceChunking: true,
                //chunkSize: 500000,
                //retryChunksLimit: 40,
                //method: "post",
                //withCredentials: true,
                headers: {
                    "propiedad_id": "<?php echo $producto->producto_id;?>"
                }
            })
        ;


        myDropzone.on("addedfile", function (file) {
            //console.log(file)
            /* Maybe display some more file information on your page */
        });
        myDropzone.on("success", function (file, data) {
            console.log(file);
            console.log(data);
            window.navigator.vibrate(200);
           location.reload();
            /* Maybe display some more file information on your page */
        });

        myDropzone.on("queuecomplete", function () {

           // location.reload();
            /* Maybe display some more file information on your page */
        });




    })


</script>
<?php $this->stop() ?>

