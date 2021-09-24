<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 23/08/2021
 * Time: 12:32
 */


defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');
?>

<?php $this->start('css_p') ?>

    <link href="<?php echo base_url() ?>/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h2>Productos</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">

                <?php if ($productos) { ?>
                    <div class="table-responsive">
                        <table id="productos" class="table table-striped table-bordered no-wrap table-sm">
                            <thead>
                            <tr>
                                <th>Id producto</th>
                                <th>Categoría</th>
                                <th>Nombre producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <!--<th>Categoría actualizada</th>-->
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($productos->result() as $producto) { ?>
                                <?php //print_contenido($producto);?>
                                <tr>
                                    <td><?php echo $producto->producto_id; ?></td>
                                    <td><?php echo get_nombre_categoria($producto->producto_categoria_sub_categoria) ; ?></td>
                                    <td><?php echo $producto->producto_nombre; ?></td>
                                    <td><?php echo $producto->producto_precio; ?></td>
                                    <td><?php echo $producto->producto_existencias; ?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning" role="alert">
                        <h3>No hay pedidos</h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
    <!--This page plugins -->
    <script src="<?php echo base_url() ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <script>


        $(document).ready(function () {

        });
    </script>
<?php $this->stop() ?>