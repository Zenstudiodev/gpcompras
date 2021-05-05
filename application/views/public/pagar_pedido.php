<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 18/06/2020
 * Time: 12:29 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');

$ci =& get_instance();
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Pagar pedido</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Datos de pedido</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <table class="table">
                            <thead>
                            <tr class="table-dark texto_negro">
                                <td>Código</td>
                                <td>Descripción</td>
                                <td>Cantidad</td>
                                <td>Precio unitario</td>
                                <td>Sub total</td>
                            </tr>
                            </thead>
                            <?php
                            //print_contenido($productos_pedido);
                            //print_contenido($datos_pedido);

                            foreach ($productos_pedido as $producto) { ?>
                                <tr>
                                    <td><?php echo $producto->codigo_producto ?></td>
                                    <?php $datos_producto= nombre_de_producto_por_codigo($producto->codigo_producto) ?>
                                    <td><?php echo $datos_producto->producto_nombre; ?> </td>
                                    <td><?php echo $producto->cantidad_producto ?></td>
                                    <td><?php echo 'Q.'.number_format($producto->precio_producto, 2, '.', ','); ?></td>
                                    <?php $total_producto = intval($producto->cantidad_producto) * floatval($producto->precio_producto); ?>
                                    <td><?php echo 'Q.'.number_format($total_producto, 2, '.', ','); ?></td>
                                </tr>

                            <?php } ?>
                            <?php if(false){?>
                                <tr>
                                    <td colspan="4">
                                        Sumar envio
                                    </td>
                                    <td>
                                        Costo del envio
                                    </td>
                                </tr>

                            <?php } ?>



                            <tr class="table-dark texto_negro">
                                <td colspan="4">Total Pedido:</td>
                                <td>Q.<?php echo number_format($datos_pedido->total_pedido, 2, '.', ','); ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <form method="post" action="<?php echo base_url() ?>index.php/productos/procesar_pago">

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Direccion de pedido</h3>
                        </div>
                        <div class="card-body">

                            <?php
                            // print_contenido($direccion_pedido);
                            if ($direccion_pedido) {
                                // $direccion_pedido = $direccion_pedido->row();
                                ?>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Pais</td>
                                        <td><?php echo $direccion_pedido->direccion_pais;?></td>
                                    </tr>
                                    <tr>
                                        <td>Departamento</td>
                                        <td><?php echo $direccion_pedido->direccion_departamento;?></td>
                                    </tr>
                                    <tr>
                                        <td>Municipio</td>
                                        <td><?php echo $direccion_pedido->direccion_municipio;?></td>
                                    </tr>
                                    <tr>
                                        <td>Zona</td>
                                        <td><?php echo $direccion_pedido->direccion_zona;?></td>
                                    </tr>
                                    <tr>
                                        <td>Direcciòn</td>
                                        <td><?php echo $direccion_pedido->direccion_direccion;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Datos de pago</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="numero_tarjeta">Número de tarjeta  <img src="<?php echo base_url(); ?>ui/public/imagenes/iconos_tarjetas.png"></label>
                                        <input type="number" class="form-control" id="numero_tarjeta"
                                               name="numero_tarjeta" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="mes_vencimiento_tarjeta">Expira</label>
                                    <select class="form-control" name="mes_vencimiento_tarjeta"
                                            id="mes_vencimiento_tarjeta">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="ano_vencimiento_tarjeta"> .</label>
                                    <select class="form-control" name="ano_vencimiento_tarjeta"
                                            id="ano_vencimiento_tarjeta">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cvv_tarjeta">CVV</label>
                                        <input type="number" class="form-control" id="cvv_tarjeta" name="cvv_tarjeta"
                                               required>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6">

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card" >
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <h3>Formas de pago</h3>
                                <p class="text-justify">
                                    Nuestra Política de pagos proporciona a nuestros clientes una serie de opciones de pago
                                    convenientes. Para garantizar una plataforma de comercio electrónico segura, como comprador
                                    solamente puedes utilizar las formas de pago aprobadas por Almacén Jumbo.
                                </p>
                                <p>
                                    Para realizar pedidos a través del Sitio web, podrá realizar sus pagos por medio de:
                                </p>
                                <ul>
                                    <li>- Pago con tarjeta de crédito de forma presencial (mínimo de compra Q 50.00), deberá
                                        presentar identificación
                                    </li>
                                    <li>- Link de pago con el cual podrá realizar pagos desde la comodidad de su hogar u oficina
                                        (monto mínimo Q 50.00)
                                    </li>
                                    <li>- Deposito o transferencia bancaria a nuestras cuentas de Depósitos monetarios a nombre de
                                        Almacén Jumbo, S.A.
                                    </li>
                                    <li>Banco Industrial No. 003-024785-8<br>
                                        Banrural No. 3-033-70589-5<br>
                                        G&T Continental No. 30-4020681-4<br>
                                    </li>
                                </ul>
                                <p class="text-justify">
                                    Al efectuar un pago con transferencia/depósito bancario deberá enviar una copia del comprobante
                                    de transferencia/depósito al correo <a href="mailto:ventas@ajumbo.com">ventas@ajumbo.com</a> o a
                                    nuestro WhatsApp 56921011 junto con el
                                    número de pedido en el que se efectuó dicha operación.
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <input type="hidden" id="deviceFingerprintID" name="deviceFingerprintID">
                    <input type="hidden" name="pedido_id" value="<?php echo $datos_pedido->id_pedido; ?>">
                    <button type="submit" class="btn btn-success btn-lg">Pagar</button>
                </div>
            </div>
        </form>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<!-- Visa fingerprint -->
<script src="<?php echo base_url() ?>ui/public/js/cybs_devicefingerprint.js"></script>

<script>
    var sessionID;
    sessionID = cybs_dfprofiler("visanetgt_gpautos", "test");
   // sessionID = cybs_dfprofiler("visanetgt_gpautos", "live");
    console.log(sessionID);
    $("#deviceFingerprintID").val(sessionID);
</script>
<?php $this->stop() ?>


