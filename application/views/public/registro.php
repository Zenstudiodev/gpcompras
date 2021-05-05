<?php
/**
 * Created by PhpStorm.
 * User: potato
 * Date: 18/11/2019
 * Time: 01:51 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master', array(
    'sin_banner' => $sin_banner,
));

$CI =& get_instance();
//nombre
$nombre = array(
    'type' => 'text',
    'name' => 'first_name',
    'id' => 'first_name',
    'class' => ' browser-default form-control',
    'placeholder' => 'Nombre',
    'required' => 'required'
);
//apellidos
$apellido = array(
    'type' => 'text',
    'name' => 'last_name',
    'id' => 'last_name',
    'class' => ' browser-default form-control',
    'placeholder' => 'Apellido',
    'required' => 'required'
);
//phone
$phone = array(
    'type' => 'text',
    'name' => 'phone',
    'id' => 'phone',
    'class' => ' browser-default form-control',
    'placeholder' => 'Teléfono',
    'required' => 'required'
);
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
//clave
$confirmar_clave = array(
    'type' => 'password',
    'name' => 'password',
    'id' => 'password',
    'class' => ' browser-default form-control',
    'placeholder' => 'Confirmar su clave',
    'required' => 'required'
);

?>

<?php $this->start('css_p') ?>
<?php $this->stop() ?>

<?php $this->start('page_content') ?>

<div class="container">
    <?php
    //echo  $CI->ion_auth->get_user_id();?>

    <div class="row">
        <div class="input-field col s12 center">
            <h4>Registro</h4>
            <p class="center">Registrate ahora</p>
        </div>
    </div>
    <?php if (isset($message)) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $message; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php echo form_open(base_url()."User/registro");?>
    <div class="form-group">
        <label for="first_name">Nombre</label>
        <?php echo form_input($first_name);?>
    </div>
    <div class="form-group">
        <label for="last_name">Apellido</label>
        <?php echo form_input($last_name);?>
    </div>

    <?php
    if($identity_column!=='email') {
        echo '<p>';
        echo lang('create_user_identity_label', 'identity');
        echo '<br />';
        echo form_error('identity');
        echo form_input($identity);
        echo '</p>';
    }
    ?>

    <!--<div class="row margin">
        <div class="input-field col s12">
            <i class="material-icons prefix pt-5">account_balance</i>
            <?php /*echo form_input($company);*/?>
            <?php /*echo lang('create_user_company_label', 'company');*/?>
        </div>
    </div>-->
    <div class="form-group">
        <label for="last_name">Correo</label>
        <?php echo form_input($email);?>
    </div>
    <div class="form-group">
        <label for="last_name">Teléfono</label>
        <?php echo form_input($phone);?>
    </div>
    <div class="form-group">
        <label for="last_name">Clave</label>
        <?php echo form_input($password);?>
    </div>
    <div class="form-group">
        <label for="last_name">Confirmar clave</label>
        <?php echo form_input($password_confirm);?>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="hidden" name="token" id="token">
            <input type="submit" name="guardar_registro" value="Registrarse" class="btn btn-success">
        </div>
        <div class="input-field col s12">
            <p class="margin center medium-small sign-up">¿Ya tiene una cuenta? <a href="login">inicie session</a></p>
        </div>
    </div>

    <?php echo form_close();?>












</div>

<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Le2pcMUAAAAAGezpReJseqnBAijwYanQXpmQoS7', {action: 'registro'}).then(function(token) {
            //console.log(token);
            $("#token").val(token);
        });
    });
</script>
<?php $this->stop() ?>
