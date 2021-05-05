<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 25/11/2019
 * Time: 12:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function get_user_by_id($user_id){
        $this->db->where('id', $user_id);
        $this->db->from('users');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
}