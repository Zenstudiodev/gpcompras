<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 22/07/2021
 * Time: 20:42
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');

$nombre_empresa = array(
    'type' => 'text',
    'name' => 'nombre_empresa',
    'id' => 'nombre_empresa',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => '',
);
$descripcion_empresa = array(
    'type' => 'text',
    'name' => 'descripcion_empresa',
    'id' => 'descripcion_empresa',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => '',
);
$logo_empresa = array(
    'type' => 'text',
    'name' => 'logo_empresa',
    'id' => 'logo_empresa',
    'class' => 'form-control',
    'accept' => 'image/png, image/jpeg',
);

if ($producto) {
    $producto = $producto->row();
}


?>
<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<?php
//print_contenido($producto);
?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <?php echo form_open_multipart(base_url().'admin/guardar_planilla');?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre empresa</label>
                                    <?php echo form_input($nombre_empresa);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción de empresa </label>
                                    <?php echo form_textarea($descripcion_empresa);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>logo empresa</label>
                                    <?php echo form_upload($logo_empresa);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--fin de <div class="container-fluid">-->
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>