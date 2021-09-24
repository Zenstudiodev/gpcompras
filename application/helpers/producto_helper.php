<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 11:56 PM
 */



function obtener_subcategorias($categoria_id){
    $ci =& get_instance();
    $sub_categorias = $ci->Productos_model->obtener_subcategorias($categoria_id);
    if($sub_categorias){
        return $sub_categorias->result();
    }else{
        return false;
    }
}

function get_categorias_sub_categorias(){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->get_categorias_n();
    if($categorias){
        return $categorias->result();
    }else{
        return false;
    }
}

function nombre_de_producto_por_codigo($producto_id){
    $ci =& get_instance();
    $datos_de_producto = $ci->Productos_model->get_info_producto($producto_id);
    if($datos_de_producto){
        $datos_de_producto = $datos_de_producto->row();
    }
    return $datos_de_producto;
}
function sub_categorias_de_categoria($categoria){
    $ci =& get_instance();
    $sub_categorias = $ci->Productos_model->get_sub_categorias($categoria);
    if($sub_categorias){
        return $sub_categorias->result();
    }else{
        return false;
    }

}
function get_nombre_categoria($categoria){
    $ci =& get_instance();
    $sub_categorias = $ci->Productos_model->get_categoria_subcategoria_by_id($categoria);
    if($sub_categorias){
        $sub_categorias = $sub_categorias->row();
       // print_contenido($sub_categorias);
        return $sub_categorias->nombre_categoria;

    }else{
        return false;
    }
}
function linea_tiene_icono($linea){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->linea_tiene_icono($linea);
    if($categorias){
        return $categorias->result();
    }else{
        return false;
    }
}
function get_icono_linea($linea){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->linea_tiene_icono($linea);
    if($categorias){
        $categorias = $categorias->row();
        //print_contenido($categorias->Imagen);
        return base_url().'upload/iconos/lineas/'.$categorias->imagen.'.png';
    }else{
        return false;
    }
}

function get_imgenes_producto_public($producto_id)
{
    $ci =& get_instance();
    $imagenes_producto = $ci->Productos_model->get_fotos_de_producto_by_id($producto_id);
    return $imagenes_producto;
}
function costo_envio_producto($producto_id){
    $ci =& get_instance();
    $datos_de_producto = $ci->Productos_model->get_info_producto($producto_id);
    if($datos_de_producto){
        $datos_de_producto = $datos_de_producto->row();
    }
    return $datos_de_producto->producto_envio_capital;
}

?>