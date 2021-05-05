<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 12:05 PM
 */


$this->layout('public/public_master');
$ci =& get_instance();
?>



<?php $this->start('page_content') ?>
<div class="container">
    <br>
    <h1>Carro de compras</h1>

    <?php if($ci->cart->contents()){?>

    <?php echo form_open(base_url().'index.php/carrito/actualizar'); ?>
    <div class="table-responsive">
        <table class="table">

            <tr>
                <th>Cantidad</th>
                <th>Nombre de producto</th>
                <th>Código</th>
                <th style="text-align:center">Precio producto</th>
                <th style="text-align:center">Sub-Total</th>
            </tr>

            <?php $i = 1; ?>

            <?php
            //print_contenido($ci->cart->contents());
            //echo 'numero de items'. $ci->cart->total_items();
            ?>

            <?php foreach ($contenido_carrito as $items): ?>
                <?php //print_contenido($items)?>

                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                <tr>
                    <td><?php echo form_input(array('type' => 'number', 'name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'class'=>'form-control')); ?></td>
                    <td>
                        <?php $datos_producto = nombre_de_producto_por_codigo($items['id']);
                        //print_contenido($datos_producto);
                        ?>
                        <?php echo $datos_producto->producto_nombre; ?>

                        <?php if ($ci->cart->has_options($items['rowid']) == TRUE): ?>
                            <p>
                                <?php foreach ($ci->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?> <?php echo $option_value; ?><br />

                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $datos_producto->producto_codigo; ?>
                    </td>

                    <td style="text-align:center">Q.<?php echo $ci->cart->format_number($items['price']); ?></td>
                    <td style="text-align:center">Q.<?php echo $ci->cart->format_number($items['subtotal']); ?></td>
                </tr>

                <?php $i++; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="3"> </td>
                <td class="right"><strong>Total</strong></td>
                <td class="right">Q.<?php echo $ci->cart->format_number($ci->cart->total()); ?></td>
            </tr>

        </table>
            </div>
    <p><?php echo form_submit('', 'Actualizar Carrito',array('class'=>'btn btn-info') ); ?></p>
    </form>
    <div class="row">
        <div class="col">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h2><strong>Cobro por envío</strong></h2>
                <p>- Cuando se cobra: cuando la compra es por un monto menor de Q.500.00 dentro del perímetro de la ciudad y cuando los pedidos son para entrega fuera de la ciudad capital de Guatemala (sin importar el monto). Nuestro asesor de ventas le proporcianara la información del envio.</p>
                <p>- Cuando no se cobra: cuando la compra es por un monto de Q.500.00 en adelante y que la entrega sea dentro del perímetro de la ciudad capital de Guatemala y en zona segura.  La fecha y hora de entrega se realizará de acuerdo a lo establecido en las rutas normales de entrega (2 a 3 días en producto en stock y sin impresiones).</p>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
            <h3>Datos de envio</h3>

        </div>
    </div>
    <form action="<?php echo base_url()?>index.php/Productos/crear_predido" method="post">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pais_envio">País </label>
                <input type="text" class="form-control" id="pais_envio" name="pais_envio" required>
            </div>
            <div class="form-group col-md-3">
                <label for="departamento_envio">Departamento</label>
                <input type="text" class="form-control" id="departamento_envio" name="departamento_envio" required>
            </div>
            <div class="form-group col-md-3">
                <label for="municipio_envio">Municipio</label>
                <input type="text" class="form-control" id="municipio_envio" name="municipio_envio" required>
            </div>
            <div class="form-group col-md-3">
                <label for="zona_envio">Zona</label>
                <input type="text" class="form-control" id="zona_envio" name="zona_envio" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="recibe_envio">Quien recibe </label>
                <input type="text" class="form-control" id="recibe_envio" name="recibe_envio" required>
            </div>
            <div class="form-group col-md-3">
                <label for="telefono_envio">Teléfono</label>
                <input type="text" class="form-control" id="telefono_envio" name="telefono_envio" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="direccion_envio">Direcciòn</label>
                <input type="text"  class="form-control" id="direccion_envio" name="direccion_envio" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Datos de facturación</h3>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="recibe_envio">Nombre </label>
                <input type="text" class="form-control" id="facturacion_nombre" name="facturacion_nombre" required>
            </div>
            <div class="form-group col-md-3">
                <label for="nit_envio">Nit</label>
                <input type="text" class="form-control" id="facturacion_nit" name="facturacion_nit" required>
            </div>
            <div class="form-group col-md-6">
                <label for="telefono_envio">Direccion</label>
                <input type="text" class="form-control" id="facturacion_direccion" name="facturacion_direccion" required>
            </div>


        </div>


    <hr>
    <?php if($ci->cart->total()< 50){ ?>
        <div class="alert alert-warning" role="alert">
            <p><b>Para Generar un pedido el mínimo de compra es de Q.50.00</b></p>
        </div>

    <?php }else{ ?>
        <button type="submit" class="btn btn-success">Generar pedido</button>
        <!--<p><a class="btn btn-success" href="<?php /*echo base_url()*/?>index.php/Productos/crear_predido">Generar pedido</a></p>-->
    <?php  }?>
    </form>

</div>
<?php }else{ ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h2><strong>Carro vacio</strong></h2>
                <p>Agregue productos a su carro para generar un pedido.</p>
                <a class="btn btn-success" href="<?php echo base_url()?>productos/categoria/">Ver productos</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>

<!--NEvRok  estuvo aqui -->
</div>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>