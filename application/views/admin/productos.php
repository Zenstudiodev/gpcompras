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
<link rel="stylesheet" href="<?php echo base_url() ?>/ui/lib/datatables/datatables.min.css">
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
            <a class="btn waves-effect waves-light btn-success" href="<?php echo base_url()?>admin/crear_producto">Crear producto</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <?php if ($productos) { ?>
                <div class="table-responsive">
                    <table id="pedidos" class="display table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id producto</th>
                            <th>Nombre producto</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($productos->result() as $producto) { ?>
                            <?php //print_contenido($producto);?>
                            <tr>
                                <td><?php echo $producto->producto_id; ?></td>
                                <td><?php echo $producto->producto_nombre; ?></td>
                                <td><?php echo $producto->producto_precio; ?></td>
                                <td>
                                    <a class="btn btn-success"
                                       href="<?php echo base_url() . 'productos/admin_revisar_producto/' . $producto->producto_id; ?>">Revisar
                                        producto</a>
                                    <a class="btn btn-info"
                                       href="<?php echo base_url() . 'admin/editar_producto/' . $producto->producto_id; ?>">Editar
                                        producto</a>
                                    <a class="btn btn-danger"
                                       href="<?php echo base_url() . 'productos/borrar_producto/' . $producto->producto_id; ?>">Borrar
                                        producto</a>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Id Pedido</th>
                            <th>Fecha del pedido</th>
                            <th>Id cliente</th>
                            <th>Nombre cliente</th>
                            <th>Total del pedido</th>
                            <th>Estado del pedido</th>
                            <th></th>
                        </tr>
                        </tfoot>
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
<script src="<?php echo base_url() ?>/ui/lib/datatables/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#pedidos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });
</script>
<?php $this->stop() ?>

