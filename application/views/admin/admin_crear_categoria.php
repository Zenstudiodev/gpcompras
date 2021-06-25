<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 25/06/2021
 * Time: 08:47
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
                    <hr>
                    <form method="post" action="<?php echo base_url()?>Admin/guardar_categoria">
                        <div class="form-group">
                            <label for="categoria_padre">Categoría padre</label>
                            <select class="form-control" id="categoria_padre" name="categoria_padre" >
                                <option value="0">-</option>
                                <?php foreach ($categorias->result() as $categoria) { ?>
                                    <?php if ($categoria->parent_id == '0') { ?>
                                        <option value="<?php echo $categoria->categoria_id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                            <?php $subcategorias = obtener_subcategorias($categoria->categoria_id); ?>
                                            <?php if ($subcategorias) { ?>
                                                    <?php foreach ($subcategorias as $subcategoria) { ?>
                                                       <option value="<?php echo $subcategoria->categoria_id; ?>">- <?php echo $subcategoria->nombre_categoria; ?></option>
                                                            <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                            <?php //print_contenido($subcategorias); ?>
                                                            <?php if ($subcategorias) { ?>
                                                                    <?php foreach ($subcategorias as $subcategoria) { ?>
                                                                        <option value="<?php echo $subcategoria->categoria_id; ?>">-- <?php echo $subcategoria->nombre_categoria; ?></option>
                                                                            <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                                            <?php print_contenido($subcategorias); ?>
                                                                        </li>
                                                                    <?php } ?>

                                                            <?php } ?>
                                                    <?php } ?>
                                            <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre_categoria">Nombre categoría</label>
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar categoría</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--fin de <div class="container-fluid">-->
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>