<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 22/07/2021
 * Time: 20:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');

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
                    <?php if ($eplanilla) { ?>
                        <a class="btn btn-success" href="<?php echo base_url().'admin/nueva_empresa_planilla'?>">Nueva empresa</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Nombre</td>
                                    <td>logo</td>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($eplanilla->result() as $empresa) { ?>
                                    <?php //print_contenido($empresa); ?>
                                    <tr>
                                        <td><?php echo $empresa->ep_id; ?></td>
                                        <td><?php echo $empresa->ep_nombre; ?></td>
                                        <td style="width: 200px;"><img src="<?php echo base_url().'upload/empresas/'.$empresa->ep_logo;?>" class="img-fluid"></td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <!--fin de <div class="container-fluid">-->
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>