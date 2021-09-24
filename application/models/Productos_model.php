<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 20/02/2020
 * Time: 10:03 AM
 */

class Productos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    //categorias

    public function get_productos_categoria($categoria){
        $this->db->where('producto_categoria_sub_categoria', $categoria);
        $this->db->where('producto_existencias >=', '1');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_categorias_n(){
        $query = $this->db->get('categorias');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_categoria_by_id($categoria_id){
        $this->db->where('categoria_id', $categoria_id);
        $query = $this->db->get('categorias');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function obtener_subcategorias($categoria_id){

        $this->db->where('parent_id', $categoria_id);
        $query = $this->db->get('categorias');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_categoria_subcategoria_by_id($categoria_id){

        $this->db->where('categoria_id', $categoria_id);
        $query = $this->db->get('categorias');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function guardar_categoria_sub_categoria($data){
        $categoria = array(
            'parent_id' => $data['categoria_padre'],
            'nombre_categoria' => $data['nombre_categoria'],
        );
        // insertamon en la base de datos
        $this->db->insert('categorias', $categoria);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function borrar_categoria_sub_categoria($categoria_id){
        $this->db->where('categoria_id', $categoria_id);
        $this->db->delete('categorias');
    }

    public function limpiar_tabla()
    {
        $this->db->truncate('productos');
    }

    public function get_productos_recomendados_home()
    {
        $this->db->limit(9);
        $this->db->order_by('producto_linea', 'RANDOM');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    //productos portada
    public function get_productos_portada()
    {
        $this->db->limit(12);
        $this->db->order_by('producto_linea', 'RANDOM');
        $this->db->where('producto_existencias >=', '1');
        //$this->db->where('producto_portada', '1');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos_no_portada()
    {
        $this->db->where('producto_portada', '0');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function asignar_producto_portada($codigo_porducto)
    {
        $datos = array(
            'producto_portada' => '1',
        );
        $this->db->where('producto_codigo', $codigo_porducto);
        $query = $this->db->update('productos', $datos);
    }
    public function quitar_producto_portada($codigo_porducto)
    {
        $datos = array(
            'producto_portada' => '0',
        );
        $this->db->where('producto_codigo', $codigo_porducto);
        $query = $this->db->update('productos', $datos);
    }
    public function get_productos()
    {
        $this->db->order_by('producto_categoria_sub_categoria', 'ASC');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos_recientes()
    {
        // $this->db->limit(9);
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }


    public function importar_productos($data)
    {


        $datos_de_producto = array(
            //'producto_id' => $data['producto_id'],
            'producto_nombre' => $data['producto_nombre'],
            'producto_codigo' => $data['producto_codigo'],
            'producto_linea' => $data['producto_linea'],
            'producto_categoria' => $data['producto_categoria'],
            'producto_material' => $data['producto_material'],
            'producto_marca' => $data['producto_marca'],
            'producto_descripcion' => $data['producto_descripcion'],
            'producto_color' => $data['producto_color'],
            'producto_medidas' => $data['productdo_medida'],
            'producto_estilo' => $data['producto_estilo'],
            'producto_precio' => $data['producto_precio'],
            'producto_precio_empresario' => $data['producto_precio_empresario'],
            'producto_tecnica_de_impresion' => $data['producto_tecnica_de_impresion'],
            'producto_envio' => $data['producto_envio'],
        );
        // insertamon en la base de datos
        $this->db->insert('productos', $datos_de_producto);


    }
    public function guardar_producto($data)
    {
        $datos_de_producto = array(
            //'producto_id' => $data['producto_id'],
            'producto_nombre' => $data['producto_nombre'],
            'producto_codigo' => $data['producto_codigo'],
            'producto_categoria_sub_categoria' => $data['producto_categoria_sub_categoria'],
            'producto_categoria' => $data['producto_categoria'],
            'producto_sub_categoria' => $data['producto_sub_categoria'],
            //'producto_material' => $data['producto_material'],
            'producto_marca' => $data['producto_marca'],
            'producto_descripcion' => $data['producto_descripcion'],
            'producto_tags' => $data['producto_tags'],
            'producto_color' => $data['producto_color'],
            'producto_medidas' => $data['producto_medidas'],
            'producto_existencias' => $data['producto_existencias'],
            //'producto_estilo' => $data['producto_estilo'],
            'producto_precio' => $data['producto_precio'],
            'producto_precio_oferta' => $data['producto_precio_oferta'],
            'producto_envio_capital' => $data['producto_envio_capital'],
            'producto_envio_interior' => $data['producto_envio_interior'],
            //'producto_envio' => $data['producto_envio'],
        );
        // insertamon en la base de datos
        $this->db->insert('productos', $datos_de_producto);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function actualizar_producto($data)
    {
        $datos_de_producto = array(
            //'producto_id' => $data['producto_id'],
            'producto_nombre' => $data['producto_nombre'],
            'producto_codigo' => $data['producto_codigo'],
            'producto_categoria_sub_categoria' => $data['producto_categoria_sub_categoria'],
            'producto_categoria' => $data['producto_categoria'],
            'producto_sub_categoria' => $data['producto_sub_categoria'],
            //'producto_material' => $data['producto_material'],
            'producto_marca' => $data['producto_marca'],
            'producto_descripcion' => $data['producto_descripcion'],
            'producto_tags' => $data['producto_tags'],
            'producto_color' => $data['producto_color'],
            'producto_medidas' => $data['producto_medidas'],
            'producto_existencias' => $data['producto_existencias'],
            //'producto_estilo' => $data['producto_estilo'],
            'producto_precio' => $data['producto_precio'],
            'producto_precio_oferta' => $data['producto_precio_oferta'],
            'producto_envio_capital' => $data['producto_envio_capital'],
            'producto_envio_interior' => $data['producto_envio_interior'],
            //'producto_envio' => $data['producto_envio'],
        );
        // insertamon en la base de datos
        $this->db->where('producto_id', $data['producto_id']);
        $this->db->update('productos', $datos_de_producto);

    }
    public function get_info_producto($id_producto)
    {
        $this->db->where('producto_id', $id_producto);
        $this->db->where('producto_existencias >=', '1');
        $this->db->order_by('producto_id', 'ASC');
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_info_producto_admin($id_producto)
    {
        $this->db->where('producto_id', $id_producto);
        $this->db->order_by('producto_id', 'ASC');
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }


    public function get_productos_sub_categoria($categoria, $sub_categoria)
    {
        $this->db->where('producto_categoria', $categoria);
        $this->db->where('producto_sub_categoria', $sub_categoria);
        $this->db->order_by('producto_id', 'ASC');
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;

    }


    //imagenes propiedad
    public function get_fotos_de_producto_by_id($producto_id)
    {
        $this->db->where('producto_id', $producto_id);
        $this->db->order_by('nombre_imagen', 'desc');
        $query = $this->db->get('imagenes_producto');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    function guardar_foto_tabla_fotos($datos_foto)
    {
        $datos_de_imagen = array(
            'producto_id' => $datos_foto['producto_id'],
            'extencion' => 'jpg',
            'nombre_imagen' => $datos_foto['nombre_imagen']
        );
        // insertamon en la base de datos
        $this->db->insert('imagenes_producto', $datos_de_imagen);
    }

    function get_datos_imagen($imagen_id)
    {
        $this->db->where('imagen_id', $imagen_id);
        $query = $this->db->get('imagenes_producto');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    function borrar_registro_imagen($imagen_id)
    {
        $this->db->where('imagen_id', $imagen_id);
        $this->db->delete('imagenes_producto');
    }
    function borrar_registro_producto($producto_id)
    {
        $this->db->where('producto_id', $producto_id);
        $this->db->delete('productos');
    }

    //lineas
    public function get_categorias()
    {
        $this->db->distinct('producto_categoria');
        $this->db->select('producto_categoria');
        $this->db->from('productos');
        $this->db->order_by('producto_categoria', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function get_sub_categorias($linea)
    {
        $this->db->distinct('producto_sub_categoria');
        $this->db->select('producto_sub_categoria');
        $this->db->from('productos');
        $this->db->where('producto_categoria', $linea);
        $this->db->order_by('producto_sub_categoria', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function linea_tiene_icono($linea)
    {

        $this->db->where('iconos_lineas_linea', $linea);
        $query = $this->db->get('iconos_lineas');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function asignar_icono_linea($post_data)
    {
        $datos = array(
            'iconos_lineas_linea' => $post_data['linea'],
            'imagen' => $post_data['linea'],
        );
        $this->db->insert('iconos_lineas', $datos);
    }

    public function borrar_icono_linea($linea)
    {
        $this->db->where('iconos_lineas_linea', $linea);
        $this->db->delete('iconos_lineas');
    }

    //pedido
    public function guardar_pedido($data)
    {

        $fecha = New DateTime();
        $datos_pedido = array(
            'fecha_pedido' => $fecha->format('Y-m-d'),
            'user_id_pedido' => $data['user_id'],
            'total_pedido' => $data['total_pedido'],
            'forma_pago_pedido' => $data['forma_pago'],
        );
        $this->db->insert('pedidos', $datos_pedido);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }

    public function guardar_producto_pedido($data)
    {
        $datos_producto = array(
            'pedido_id' => $data['pedido_id'],
            'codigo_producto' => $data['codigo_producto'],
            //'linea_producto' => $data['linea_producto'],
            //'categoria_producto' => $data['categoria_producto'],
            'cantidad_producto' => $data['cantidad_producto'],
            'precio_producto' => $data['precio_producto'],
        );
        $this->db->insert(' productos_pedido', $datos_producto);
        //$insert_id = $this->db->insert_id();
        // return $insert_id;
    }

    public function get_pedidos_user_id($user_id)
    {
        $this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function get_pedido_by_id_user_id($pedido_id, $user_id)
    {
        $this->db->where('id_pedido', $pedido_id);
        $this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function get_productos_pedido($pedido_id)
    {
        $this->db->where('pedido_id', $pedido_id);
        //$this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('productos_pedido');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function pasar_pedido_a_pagado($pedido_id)
    {
        $datos = array(
            'estado_pedido' => 'pagado',
        );
        $this->db->where('id_pedido', $pedido_id);
        $query = $this->db->update('pedidos', $datos);
    }

    public function guardar_direcicon_pedido($data)
    {

        $direccion_pedido = array(
            'id_pedido' => $data['pedido_id'],
            //'direccion_pais' => $data['direccion_pais'],
            'direccion_departamento' => $data['direccion_departamento'],
            'direccion_municipio' => $data['direccion_municipio'],
            'direccion_zona' => $data['direccion_zona'],
            'direccion_direccion' => $data['direccion_direccion'],
            'direccion_recibe' => $data['direccion_recibe'],
            'direccion_telefono' => $data['direccion_telefono'],
            'facturacion_nombre' => $data['facturacion_nombre'],
            'facturacion_nit' => $data['facturacion_nit'],
            'facturacion_direccion' => $data['facturacion_direccion'],
        );
        $this->db->insert('direccion_pedido', $direccion_pedido);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_direccion_pedido($pedido_id)
    {
        $this->db->where('id_pedido', $pedido_id);
        //$this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('direccion_pedido');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    //admin
    public function get_pedidos()
    {
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function get_pedido_by_id($pedido_id)
    {
        $this->db->where('id_pedido', $pedido_id);
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }

    public function actualizar_pedido($data)
    {
        $datos = array(
            'estado_pedido' => $data['estado_pedido'],
        );
        $this->db->where('id_pedido', $data['pedido_id']);
        $query = $this->db->update('pedidos', $datos);
    }

    //buscar
    function buscar($keyword){
        $this->db->like('producto_nombre', $keyword);
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;

    }


}