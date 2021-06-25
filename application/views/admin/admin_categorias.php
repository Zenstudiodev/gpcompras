<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 22/06/2021
 * Time: 16:31
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
                    <?php //print_contenido($categorias->result()); ?>
                    <a class="btn btn-success" href="<?php echo base_url()?>Admin/crear_categoria">Nueva categoria</a>
                    <hr>
                    <ul class="list-group">
                        <?php foreach ($categorias->result() as $categoria) { ?>
                            <?php if ($categoria->parent_id == '0') { ?>
                                <li class="list-group-item"><?php echo $categoria->nombre_categoria; ?>
                                    <?php $subcategorias = obtener_subcategorias($categoria->categoria_id); ?>
                                    <?php if ($subcategorias) { ?>
                                        <ul class="list-group">
                                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                                <li class="list-group-item"><?php echo $subcategoria->nombre_categoria; ?>
                                                    <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                    <?php //print_contenido($subcategorias); ?>
                                                    <?php if ($subcategorias) { ?>
                                                        <ul class="list-group">
                                                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                                                <li class="list-group-item"><?php echo $subcategoria->nombre_categoria; ?>
                                                                    <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                                    <?php if ($subcategorias) { ?>
                                                                        <ul class="list-group">
                                                                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                                                                <li class="list-group-item"><?php echo $subcategoria->nombre_categoria; ?>
                                                                                    <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                                                    <?php print_contenido($subcategorias); ?>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    <?php }else{ ?>
                                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url().'Admin/borrar_categoria/'.$subcategoria->categoria_id; ?>">Borrar categoría</a>
                                                                    <?php } ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php }else{ ?>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url().'Admin/borrar_categoria/'.$subcategoria->categoria_id; ?>">Borrar categoría</a>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php }else{ ?>
                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url().'Admin/borrar_categoria/'.$categoria->categoria_id; ?>">Borrar categoría</a>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!--fin de <div class="container-fluid">-->
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>