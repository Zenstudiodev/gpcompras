<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 28/08/2020
 * Time: 17:04
 */

class Banners_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function header_banners_activos()
    {
        $this->db->where('estado_bh', "activo");
        $this->db->where('area_bh', "todo");
        $this->db->order_by('id_bh', 'RANDOM');
        $query = $this->db->get('banners_header');

        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function header_banners_feria_activos()
    {

        $this->db->where('estado_bh', "activo");
        $this->db->where('area_bh', "feria");
        $this->db->order_by('id_bh', 'RANDOM');
        $query = $this->db->get('banners_header');

        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function banneers_activos()
    {
        $where = "estado='activo'";
        $this->db->where($where);
        $query = $this->db->get('banners');

        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function banners(){
        $query = $this->db->get('banners');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function banners_header(){
        $query = $this->db->get('banners_header');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function banner_data($id_banner){
        $this->db->where('id_banner', $id_banner);
        $query = $this->db->get('banners');
        if ($query->num_rows() > 0) return $query;
        else return false;

    }
    function banner_header_data($id_banner){
        $this->db->where('id_bh', $id_banner);
        $query = $this->db->get('banners_header');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    function actualizar_banners($post_data){
        $datos = array(
            'titulo'=> $post_data['titulo'],
            'link'=> $post_data['link'],
            'imagen'=> $post_data['imagen'],
            'area'=> $post_data['area'],
            'vencimiento'=> $post_data['vencimiento'],
            'estado'=> $post_data['estado']
        );
        $this->db->where('id_banner', $post_data['id']);
        $query = $this->db->update('banners',$datos);
    }
    function actualizar_banners_header($post_data){
        $datos = array(
            'titulo_bh'=> $post_data['titulo'],
            'link_bh'=> $post_data['link'],
            'imagen_bh'=> $post_data['imagen'],
            'area_bh'=> $post_data['area'],
            'vencimiento_bh'=> $post_data['vencimiento'],
            'estado_bh'=> $post_data['estado']
        );
        $this->db->where('id_bh', $post_data['id']);
        $query = $this->db->update('banners_header',$datos);
    }
    function crear_banners_header($post_data){
        $datos = array(
            'titulo_bh'=> $post_data['titulo'],
            'link_bh'=> $post_data['link'],
            'imagen_bh'=> $post_data['imagen'],
            'area_bh'=> $post_data['area'],
            'vencimiento_bh'=> $post_data['vencimiento'],
            'estado_bh'=> $post_data['estado']
        );
        $this->db->insert('banners_header', $datos);
    }

    /*BANNER BUSQUEDA*/
    function guardar_click_banner_busqueda($banner_id){
        $this->db->where('id_banner', $banner_id);
        $this->db->set('clicks', 'clicks+1', FALSE);
        $this->db->update('banners');
    }
    function guardar_vista_banner_busqueda($banner_id){
        $this->db->where('id_banner', $banner_id);
        $this->db->set('visualizaciones', 'visualizaciones+1', FALSE);
        $this->db->update('banners');

    }
    /*BANNER HEADER*/
    function guardar_click_banner_header($banner_id){
        $this->db->where('id_bh', $banner_id);
        $this->db->set('clicks_bh', 'clicks_bh+1', FALSE);
        $this->db->update('banners_header');
    }
    function guardar_vista_banner_header($banner_id){
        $this->db->where('id_bh', $banner_id);
        $this->db->set('visualizaciones_bh', 'visualizaciones_bh+1', FALSE);
        $this->db->update('banners_header');

    }
}