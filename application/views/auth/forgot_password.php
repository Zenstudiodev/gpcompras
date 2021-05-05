<?php $this->layout('public/public_master_cliente', [
    'header_banners' => $header_banners,
    'predios' => $predios,
    'tipos' => $tipos,
    'ubicaciones' => $ubicaciones,
    'marca' => $marca,
    'linea' => $linea,
    'transmisiones' => $transmisiones,
    'combustibles' => $combustibles,
]);



?>


<?php $this->start('css_p') ?>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url() ?>/ui/vendor/cropperjs/cropper.min.css"/>
<?php $this->stop() ?>

<?php $this->start('banner') ?>


<?php $this->stop() ?>

<?php $this->start('page_content') ?>

<div class="container">
    <div class="row">
        <div class=" col col12">
            <h1><?php echo lang('forgot_password_heading');?></h1>
            <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

            <div id="infoMessage"><?php echo $message;?></div>

            <?php echo form_open("auth/forgot_password");?>

            <p>
                <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                <?php echo form_input($identity);?>
            </p>

            <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>

            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->stop() ?>
    <!-- JS personalizado -->
<?php $this->start('js_p') ?>

<?php $this->stop() ?>