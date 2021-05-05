<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 27/08/2020
 * Time: 18:17
 */

function nombre_de_usuario_por_codigo($user_id){
    $ci =& get_instance();
    $datos_de_usuario = $ci->User_model->get_user_by_id($user_id);
    if($datos_de_usuario){
        $datos_de_usuario = $datos_de_usuario->row();
    }
    return $datos_de_usuario->first_name.' '. $datos_de_usuario->last_name;
}

?>