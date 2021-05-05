<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 2/05/2020
 * Time: 10:01 AM
 */


function print_contenido($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
function compobarSesion()
{
    $ci =& get_instance();
    $data = array();

    //si esta  logueado tomar datos de usuario desde la sesión
    if (isset($ci->session->userdata['logged_in'])) {
        $data['user_id'] = $ci->session->userdata['logged_in']['id'];
        $data['username'] = $ci->session->userdata['logged_in']['username'];
        $data['email'] = $ci->session->userdata['logged_in']['email'];
        $data['nombre'] = $ci->session->userdata['logged_in']['nombre'];
        $data['rol'] = $ci->session->userdata['logged_in']['rol'];
    } else {
        redirect('/login', 'refresh');
    }
    return $data;

}

?>