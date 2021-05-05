<?php
/**
 * Created by PhpStorm.
 * User: potato
 * Date: 30/09/2019
 * Time: 01:51 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');

//correo
$correo = array(
    'type' => 'email',
    'name' => 'identity',
    'id' => 'identity',
    'class' => ' browser-default form-control',
    'placeholder' => ' Ingrese su correo',
    'required' => 'required'
);
//clave
$clave = array(
    'type' => 'password',
    'name' => 'password',
    'id' => 'password',
    'class' => ' browser-default form-control',
    'placeholder' => ' Ingrese su clave',
    'required' => 'required'
);

?>

<?php $this->start('css_p') ?>
<?php $this->stop() ?>

<?php $this->start('page_content') ?>

<div class="container">
    <?php if(isset($message)){?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $message;?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <form action="<?php echo base_url()?>index.php/auth/login" method="post">
        <div class="form-group">
            <label for="identity">Correo</label>
            <?php echo form_input($correo); ?>
        </div>
        <div class="form-group">
            <label for="password">Clave</label>
            <?php echo form_input($clave); ?>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <hr>
    <div class="alert alert-info" role="alert">
        Si aun no tiene cuenta se puede registrar acá <a href="<?php echo base_url()?>index.php/User/registro" class="btn btn-info">Registrarse</a>
    </div>
</div>

<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>
