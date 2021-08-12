<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 27/08/2020
 * Time: 16:40
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');


if ($datos_pedido) {
    $pedido = $datos_pedido->row();
}
if ($cliente) {
    $cliente = $cliente->row();
}
$estado_pedido_select = array(
    'name' => 'estado_pedido',
    'id' => 'estado_pedido',
    'class' => 'form-control',
    'required' => 'required'
);
$estado_pedido_options = array(
    'pendiente_pago' => 'Pendiente de pago',
    'pagado' => 'Pagado',
    'bodega' => 'En bodega',
    'transito' => 'En ruta',
    'entregado' => 'Entregado',
);


?>

<?php $this->start('css_p') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>/ui/lib/datatables/datatables.min.css">
<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<div class="container-fluid">
    <?php if ($pedido) { ?>
        <div class="row">
            <div class="col">
                <h2>Pedido <?php echo $pedido->id_pedido; ?></h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Número pedido</td>
                            <td>Fecha</td>
                            <td>Id cliente</td>
                            <td>Nombre cliente</td>
                            <td>Total pedido</td>
                            <td>Forma de pago</td>
                            <td>Estado</td>
                        </tr>
                        <tr>
                            <td><?php echo $pedido->id_pedido; ?></td>
                            <td><?php echo $pedido->fecha_pedido; ?></td>
                            <td><?php echo $pedido->user_id_pedido; ?></td>
                            <td><?php echo $pedido->user_id_pedido; ?></td>
                            <td><?php echo $pedido->total_pedido; ?></td>
                            <td><?php echo $pedido->forma_pago_pedido; ?></td>
                            <td><?php echo $pedido->estado_pedido; ?></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h2>Datos del cliente</h2>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Id cliente</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                    </tr>
                    <td><?php echo $cliente->id; ?></td>
                    <td><?php echo $cliente->first_name . ' ' . $cliente->last_name; ?></td>
                    <td><?php echo $cliente->email; ?></td>
                    <td><?php echo $cliente->phone; ?></td>

                </table>
            </div>
        </div>
        <hr>
        <?php if($datos_envio){
            $datos_envio =$datos_envio->row();
            ?>
            <?php //print_contenido($datos_envio); ?>
        <div class="row">
            <div class="col">
                <h2>Datos envio</h2>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td>Pais</td>
                        <td>departamento</td>
                        <td>municipio</td>
                        <td>zona</td>
                    </tr>
                    <tr><td><?php echo $datos_envio->direccion_pais; ?></td>
                        <td><?php echo $datos_envio->direccion_departamento; ?></td>
                        <td><?php echo $datos_envio->direccion_municipio; ?></td>
                        <td><?php echo $datos_envio->direccion_zona; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Dirección</b></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $datos_envio->direccion_direccion; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Quien recibe</td>
                        <td>Teléfono</td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo $datos_envio->direccion_recibe; ?></td>
                        <td><?php echo $datos_envio->direccion_telefono; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Nombre facturación</td>
                        <td>Nit</td>
                        <td>Dirección facturación</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $datos_envio->facturacion_nombre; ?></td>
                        <td><?php echo $datos_envio->facturacion_nit; ?></td>
                        <td><?php echo $datos_envio->facturacion_direccion; ?></td>
                    </tr>

                </table>
            </div>
        </div>
        <hr>
        <?php }?>

        <div class="row">
            <div class="col">
                <h2>Productos</h2>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Codigo producto</th>
                    <th>Línea producto</th>
                    <th>Categoria producto</th>
                    <th>Cantidad de producto</th>
                    <th>Precio unitario</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos_pedido->result() as $producto) { ?>
                    <tr>
                        <td><?php echo $producto->codigo_producto; ?></td>
                        <td><?php echo $producto->linea_producto; ?></td>
                        <td><?php echo $producto->categoria_producto; ?></td>
                        <td><?php echo $producto->cantidad_producto; ?></td>
                        <td><?php echo $producto->precio_producto; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <h2>Actualizar pedido</h2>
            </div>
        </div>
        <hr>
        <form action="<?php echo base_url() ?>index.php/admin/actualizar_pedido" method="post">
            <div class="form-row">
                <input type="hidden" name="id_pedido" value="<?php echo $pedido->id_pedido; ?>">
                <div class="form-group col-md-4">
                    <label for="estado_pedido">Estado</label>
                    <?php echo form_dropdown($estado_pedido_select, $estado_pedido_options, $pedido->estado_pedido); ?>

                </div>
                <div class="form-group col-md-4">
                    <br>
                    <button type="submit" class="btn btn-success" name="actualizar_pedido_btn"
                            id="actualizar_pedido_btn">Actualizar
                    </button>
                </div>
            </div>

        </form>


    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            <h3>No hay pedidos</h3>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col">
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


