<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 02/10/2020
 * Time: 12:22
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');


if($producto){
    $producto = $producto->row();
}
$producto_codigo = array(
    'type' => 'text',
    'name' => 'producto_codigo',
    'id' => 'producto_codigo',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_codigo,
);
$producto_nombre = array(
    'type' => 'text',
    'name' => 'producto_nombre',
    'id' => 'producto_nombre',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_nombre,
);
$producto_categoria = array(
    'type' => 'text',
    'name' => 'producto_categoria',
    'id' => 'producto_categoria',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_categoria,
);
$producto_sub_categoria = array(
    'type' => 'text',
    'name' => 'producto_sub_categoria',
    'id' => 'producto_sub_categoria',
    'class' => 'form-control',
    'placeholder' => '',
    'value' =>  $producto->producto_sub_categoria,
);
$producto_marca = array(
    'type' => 'text',
    'name' => 'producto_marca',
    'id' => 'producto_marca',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_marca,
);

$producto_color = array(
    'type' => 'text',
    'name' => 'producto_color',
    'id' => 'producto_color',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_color,
);
$producto_medidas = array(
    'type' => 'text',
    'name' => 'producto_medidas',
    'id' => 'producto_medidas',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_medidas,
);
$producto_descripcion = array(
    'type' => 'text',
    'name' => 'producto_descripcion',
    'id' => 'producto_descripcion',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_descripcion,
);
$producto_precio = array(
    'type' => 'number',
    'name' => 'producto_precio',
    'id' => 'producto_precio',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_precio,
);
$producto_precio_oferta = array(
    'type' => 'number',
    'name' => 'producto_precio_oferta',
    'id' => 'producto_precio_oferta',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_precio_oferta,
);
$producto_existencias = array(
    'type' => 'number',
    'name' => 'producto_existencias',
    'id' => 'producto_existencias',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_existencias,
);
$producto_envio_capital = array(
    'type' => 'number',
    'name' => 'producto_envio_capital',
    'id' => 'producto_envio_capital',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_envio_capital,
);
$producto_envio_interior = array(
    'type' => 'number',
    'name' => 'producto_envio_interior',
    'id' => 'producto_envio_interior',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => $producto->producto_envio_interior,
);
$producto_portada = array(
    'type' => 'text',
    'name' => 'producto_portada',
    'id' => 'producto_portada',
    'class' => 'form-control',
    'placeholder' => '',
    'value' => '',
);


?>
<?php $this->start('css_p') ?>
<link rel="stylesheet" href="<?php base_url() ?>/ui/vendor/jQuery-Tags/jquery.tagsinput.css">
<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>
<!--dentro de <div class="container-fluid">-->

<?php
//print_contenido($producto);
?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Datos del producto</h4>
                    <form action="<?php echo base_url()?>/admin/actualizar_producto" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Código de producto</label>
                                        <?php echo form_input($producto_codigo);?>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Nombre del producto</label>
                                        <?php echo form_input($producto_nombre);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoria_padre">Categoría</label>
                                        <select class="form-control" id="producto_categoria_sub_categoria" name="producto_categoria_sub_categoria" >
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label ></label>
                                        <a class="btn btn-info" href="<?php echo base_url().'Admin/categorias'?>" target="_blank">Administrar categorías</a>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <?php echo form_input($producto_categoria);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub categoría</label>
                                        <?php echo form_input($producto_sub_categoria);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <?php echo form_input($producto_marca);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <?php echo form_input($producto_color);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Medidas</label>
                                        <?php echo form_input($producto_medidas);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <?php echo form_textarea($producto_descripcion);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input id="producto_tags" name="producto_tags" type="text" class="tags form-control" value="<?php echo $producto->producto_tags; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <?php echo form_input($producto_precio);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Precio de oferta</label>
                                        <?php echo form_input($producto_precio_oferta);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Existencias</label>
                                        <?php echo form_input($producto_existencias);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Envio capital</label>
                                        <?php echo form_input($producto_envio_capital);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Envio interior</label>
                                        <?php echo form_input($producto_envio_interior);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <input type="hidden" name="producto_id" id="producto_id" value="<?php echo $producto->producto_id?>">
                                <button type="submit" class="btn btn-info">Guardar</button>
                                <!--<button type="reset" class="btn btn-dark">Reset</button>-->
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
<script src="<?php echo base_url(); ?>/ui/vendor/jQuery-Tags/jquery.tagsinput.js"></script>
<script type="text/javascript">

    function onAddTag(tag) {
        alert("Added a tag: " + tag);
    }
    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input,tag) {
        alert("Changed a tag: " + tag);
    }

    $(function() {

        $('#producto_tags').tagsInput({width:'auto'});



// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
    });

</script>
<script>
    $( document ).ready(function() {
        $("#producto_categoria_sub_categoria option[value='<?php echo $producto->producto_categoria_sub_categoria?>']").attr("selected", true);
    });
</script>
<?php $this->stop() ?>
