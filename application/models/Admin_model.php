<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 22/07/2021
 * Time: 20:18
 */

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_empresas_planilla(){

        //$this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('empresas_planilla');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function guardar_empresa_planilla($data){
        $datos_pedido = array(
            'ep_nombre' => $data['ep_nombre'],
            'ep_descripcion' => $data['ep_descripcion'],
            'ep_logo' => $data['ep_logo'],
        );
        $this->db->insert('empresas_planilla', $datos_pedido);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}