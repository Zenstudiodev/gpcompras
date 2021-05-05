<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 27/08/2020
 * Time: 16:40
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
            <h2>Pedidos</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">

            <?php if ($pedidos) { ?>
                <div class="table-responsive">
                    <table id="pedidos" class="display table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id Pedido</th>
                            <th>Fecha del pedido</th>
                            <th>Id cliente</th>
                            <th>Nombre cliente</th>
                            <th>Total del pedido</th>
                            <th>Estado del pedido</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($pedidos->result() as $pedido) { ?>
                            <tr>
                                <td><?php echo $pedido->id_pedido; ?></td>
                                <td><?php echo $pedido->fecha_pedido; ?></td>
                                <td><?php echo $pedido->user_id_pedido; ?></td>
                                <td><?php echo nombre_de_usuario_por_codigo($pedido->user_id_pedido); ?></td>
                                <td><?php echo $pedido->total_pedido; ?></td>
                                <td><?php echo $pedido->estado_pedido; ?></td>
                                <td>
                                    <a class="btn btn-success"
                                       href="<?php echo base_url() . '/admin/revisar_pedido/' . $pedido->id_pedido; ?>">Revisar
                                        pedido</a>
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


