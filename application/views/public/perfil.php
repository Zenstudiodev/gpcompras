<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 20/11/2019
 * Time: 21:23
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master', array(
    'sin_banner' => $sin_banner,
));
$CI =& get_instance();
$user =$user->row();


?>

<?php $this->start('css_p') ?>
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
    <div class="row">
        <div class="input-field col  center">
            <h2>Perfil</h2>
        </div>
    </div>
    <!--<div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="<?php /*echo base_url()*/?>user/subir_propiedad">Agregar una propiedad</a>
        </div>
    </div>-->
    <hr>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card">
                <!--<img src="<?php echo base_url()?>/ui/public/images/user.png" class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user->first_name; ?></h5>

                </div>
            </div>
            <hr>
        </div>
        <div class="col-12 col-md-9 ">
            <?php if (isset($mensaje)) { ?>
                <div class="alert alert-success alert-block"><a class="close" data-dismiss="alert"
                                                                href="#">×</a>
                    <h4 class="alert-heading">Acción exitosa!</h4>
                    <p>
                        <?php echo $mensaje; ?>
                    </p>
                </div>
            <?php } ?>

            <h2>Pedidos</h2>
            <?php
            if($pedidos){ ?>
                <div class="row">
                <?php  foreach ($pedidos->result() as $pedido) {
                    //obtenemos imagenes de la propiedad
                    //$imagenes_propiedad = get_imgenes_propiedad_public($casa->Id_propiedad);
                    ?>


                    <div class="col-md-4 filtro_card">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Número pedido <span class="badge badge-primary"><?php echo $pedido->id_pedido; ?></span> </h5>
                                <div class="card-text">
                                    <p>Total pedido Q.<?php echo $pedido->total_pedido; ?></p>
                                    <p>Estado pedido: <span class="badge badge-info"><?php echo $pedido->estado_pedido; ?></span></p>

                                </div>

                            </div>
                            <div class="card-footer text-muted">
                                <a href="<?php echo base_url().'index.php/productos/pagar_pedido/'.$pedido->id_pedido?>" class="card-link">Pagar pedido</a>
                                <a href="#" class="card-link"></a>
                            </div>
                        </div>
                        <?php //print_contenido($casa); ?>
                    </div>


                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>


    <?php //print_contenido($user)?>
</div>

<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>
