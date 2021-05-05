<?php
/**
 * Created by PhpStorm.
 * User: potato
 * Date: 27/09/2019
 * Time: 12:30 AM
 */

function print_contenido($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
function id_departamento_a_nombre($id){
    $ci =& get_instance();
    $ci->load->model('Busqueda_model');
    $departamento = $ci->Busqueda_model->get_departamento_by_id($id);
    if($departamento){
        $departamento = $departamento->row();
        $nombre_departamento = $departamento->nombre_departamento;
    }else{
        $nombre_departamento ='';
    }
    return $nombre_departamento;
}
function id_municipio_a_nombre($id){
    $ci =& get_instance();
    $ci->load->model('Busqueda_model');
    $municipio = $ci->Busqueda_model->get_municipios_by_id($id);
    if($municipio){
        $municipio = $municipio->row();
        $nombre_municipio = $municipio->nombre_municipio;
    }else{
        $nombre_municipio ='';
    }
    return $nombre_municipio;
}
?>