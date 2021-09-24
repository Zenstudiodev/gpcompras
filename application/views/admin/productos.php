<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 02/10/2020
 * Time: 11:29
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
            <a class="btn waves-effect waves-light btn-success" href="<?php echo base_url() ?>admin/crear_producto">Crear
                producto</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">

            <?php if ($productos) { ?>
                <div class="table-responsive">
                    <table id="productos" class="table table-striped table-bordered no-wrap">
                        <thead>
                        <tr>
                            <th>Id producto</th>
                            <th>Nombre producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acción</th>
                            <!--<th>Categoría actualizada</th>-->
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id producto</th>
                            <th>Nombre producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acción</th>
                            <!--<th>Categoría actualizada</th>-->
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($productos->result() as $producto) { ?>
                            <?php //print_contenido($producto);?>
                            <tr>
                                <td><?php echo $producto->producto_id; ?></td>
                                <td><?php echo $producto->producto_nombre; ?></td>
                                <td><?php echo $producto->producto_precio; ?></td>
                                <td><?php echo $producto->producto_existencias; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-success btn-sm"
                                           href="<?php echo base_url() . 'productos/admin_revisar_producto/' . $producto->producto_id; ?>">Revisar
                                            producto</a>
                                        <a class="btn btn-success btn-sm"
                                           href="<?php echo base_url() . 'admin/subir_fotos/' . $producto->producto_id; ?>">Editar fotos</a>
                                        <a class="btn btn-info btn-sm"
                                           href="<?php echo base_url() . 'admin/editar_producto/' . $producto->producto_id; ?>">Editar
                                            producto</a>
                                        <a class="btn btn-danger btn-sm"
                                           href="<?php echo base_url() . 'productos/borrar_producto/' . $producto->producto_id; ?>">Borrar
                                            producto</a>
                                    </div>
                                </td>
                                <!--<td>
                                    <?php /*if ($producto->producto_categoria_sub_categoria == '0') { */?>
                                        <a class="btn btn-danger"></a>
                                    <?php /*} else { */?>
                                        <a class="btn btn-success"></a>
                                    <?php /*} */?>
                                </td>-->

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
        //$('#facturas').DataTable();
        // Setup - add a text input to each footer cell
        $('#productos tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Buscar ' + title + '" />');
        });

        // DataTable
        var table = $('#productos').DataTable();

        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
        //$('#dataTable').DataTable();
    });
</script>
<?php $this->stop() ?>

