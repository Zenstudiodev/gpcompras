<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 25/06/2021
 * Time: 10:40
 */

$this->layout('public/public_master');
$ci =& get_instance();

$costo_envio;
$total_con_envio;
$user_data = $user_data->row();
$nombre = $user_data->first_name . ' ' . $user_data->last_name;


?>



<?php $this->start('page_content') ?>
<div class="container">
    <hr>
    <?php //print_contenido($_POST); ?>
    <?php //print_contenido($user_data); ?>
    <?php //echo $ci->cart->format_number($ci->cart->total()); ?>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php if ($ci->cart->contents()) {
            } ?>
            <h1>Forma de pago</h1>
            <form method="post" id="forma_pago_form" action="<?php echo base_url() ?>Carrito/guardar_pago">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Contra entrega
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago"
                                                   id="pago_contra_entrega" value="contra entrega">
                                            <label class="form-check-label" for="pago_contra_entrega">
                                                Pago en dirección de entrega
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Tarjeta de crédito débito
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago" id="pago_tarjeta" value="tarjeta"  required>
                                            <label class="form-check-label" for="pago_contra_entrega">
                                                Tarjeta
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_tarjeta">Nombre en la tarjeta</label>
                                    <input type="text" class="form-control" id="nombre_tarjeta" name="nombre_tarjeta" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="numero_tarjeta">numero en la tarjeta</label>
                                    <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="Número de tarjeta">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="vencimiento_tarjeta">Vencimiento tarjeta</label>
                                        <input type="text" class="form-control" id="vencimiento_tarjeta"name="vencimiento_tarjeta" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tarjeta_verificacion">Codigo verificación</label>
                                        <input type="text" class="form-control" id="tarjeta_verificacion" name="tarjeta_verificacion">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Efectivo en oficina de Gp Compras
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago"
                                                   id="pago_gpcompras" value="gpcompras">
                                            <label class="form-check-label" for="pago_contra_entrega">
                                                Pago en GP Compras
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingcuatro">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapsecuatro" aria-expanded="false"
                                        aria-controls="collapsecuatro">
                                    Crédito Bancario
                                </button>
                            </h2>
                        </div>
                        <div id="collapsecuatro" class="collapse" aria-labelledby="headingcuatro"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago"
                                                   id="pago_credito_bancario" value="credito">
                                            <label class="form-check-label" for="pago_contra_entrega">
                                                Credito bancario
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nombre_credito">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_credito"
                                               name="nombre_credito" value="<?php echo $nombre; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="telefono_credito">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono_credito"
                                               name="telefono_credito" value="<?php echo $user_data->phone; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="correo_credito">Correo</label>
                                        <input type="text" class="form-control" id="correo_credito"
                                               name="correo_credito" value="<?php echo $user_data->email; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingcinco">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapsecinco" aria-expanded="false"
                                        aria-controls="collapsecinco">
                                    Planilla Empresarial
                                </button>
                            </h2>
                        </div>
                        <div id="collapsecinco" class="collapse" aria-labelledby="headingcinco"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago"
                                                   id="pago_planilla" value="planilla">
                                            <label class="form-check-label" for="pago_contra_entrega">
                                                Planilla empresarial
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="autoComplete">Seleccione la empresa donde trabaja</label>
                                        <input class="form-control" id="autoComplete" name="empresa_planilla"
                                               aria-describedby="autoCompleteHelp" autocomplete="off" >
                                        <small id="autoCompleteHelp" class="form-text text-muted">Escriba el nombre de
                                            la empresa en la que trabaja
                                        </small>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="puesto_empresa">Puesto</label>
                                        <input class="form-control" id="puesto_empresa" name="puesto_empresa">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="asociacion_solidarista">Asociación solidarisata</label>
                                        <input class="form-control" id="asociacion_solidarista" name="asociacion_solidarista">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-header" id="headingseis">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseseis" aria-expanded="false"
                                        aria-controls="collapseseis">
                                    Visa cuotas / Credi cuotas
                                </button>
                            </h2>
                        </div>
                        <div id="collapseseis" class="collapse" aria-labelledby="headingseis"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="forma_pago"
                                                   id="visacuotas" value="visacuotas">
                                            <label class="form-check-label" for="visacuotas">
                                                Visa cuotas/ Credi cuotas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <input type="hidden" name="departamento_envio" value="<?php echo $departamento_envio; ?>">
                <input type="hidden" name="municipio_envio" value="<?php echo $municipio_envio; ?>">
                <input type="hidden" name="zona_envio" value="<?php echo $zona_envio; ?>">
                <input type="hidden" name="recibe_envio" value="<?php echo $recibe_envio; ?>">
                <input type="hidden" name="telefono_envio" value="<?php echo $telefono_envio; ?>">
                <input type="hidden" name="direccion_envio" value="<?php echo $direccion_envio; ?>">
                <input type="hidden" name="facturacion_nombre" value="<?php echo $facturacion_nombre; ?>">
                <input type="hidden" name="facturacion_nit" value="<?php echo $facturacion_nit; ?>">
                <input type="hidden" name="facturacion_direccion" value="<?php echo $facturacion_direccion; ?>">
                <button type="submit" class="btn btn-primary" id="pagarBtn">Pagar</button>
            </form>

            <div class="position-fixed bottom-0 left-0 p-3" style="z-index: 5; left: 0; bottom: 0;">
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
                     data-delay="4000">
                    <div class="toast-header">
                        <strong class="mr-auto">Seleccione una forma de pago</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Por favor seleccione una forma de pago.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <h2>Detalle</h2>
            <ul class="list-group">
                <li class="list-group-item">Productos: <?php echo $ci->cart->format_number($ci->cart->total()); ?></li>
                <li class="list-group-item">Envio: <?php echo $costo_envio; ?></li>
                <li class="list-group-item">Total: <?php echo $total_con_envio; ?></li>
            </ul>
        </div>
    </div>


</div>

</div>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<script src="<?php echo base_url() ?>ui/vendor/autoComplete/autoComplete.min.js"></script>
<script>
    <?php if ($eplanilla) { ?>
    empresas = [
        <?php foreach ($eplanilla->result() as $empresa) { ?>
        <?php //print_contenido($empresa); ?>
        "<?php echo $empresa->ep_nombre; ?>",
        <?php } ?>
    ];

    //autocomplete
    const autoCompleteJS = new autoComplete({
        placeHolder: "Buscar empresa...",
        data: {
            src: empresas,
            cache: true,
        },
        resultItem: {
            highlight: true
        },
        events: {
            input: {
                selection: (event) => {
                    const selection = event.detail.selection.value;
                    autoCompleteJS.input.value = selection;
                }
            }
        }
    });
    <?php }?>

    //acordeon
    $('#collapseOne').on('show.bs.collapse', function () {
        // do something...
        console.log('se abrio pago efectivo');
        $("#pago_contra_entrega").prop("checked", true);

    });
    $('#collapseTwo').on('show.bs.collapse', function () {
        // do something...
        $("#pago_tarjeta").prop("checked", true);

    });
    $('#collapseThree').on('show.bs.collapse', function () {
        // do something...
        $("#pago_gpcompras").prop("checked", true);

    });
    $('#collapsecuatro').on('show.bs.collapse', function () {
        // do something...
        $("#pago_credito_bancario").prop("checked", true);

    });
    $('#collapsecinco').on('show.bs.collapse', function () {
        // do something...
        $("#pago_planilla").prop("checked", true);

    });

    $('#pagarBtn').on('click', function () {
        if ($("forma_pago").is(':checked')) {
            //alert("Está activado");
        } else {
            console.log($("forma_pago"));
            $('#liveToast').toast('show');
        }
    });


</script>
<?php $this->stop() ?>

