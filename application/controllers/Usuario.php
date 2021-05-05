<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 6/06/2020
 * Time: 12:30 PM
 */

class Usuario extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
    }

    function index()
    {
        echo $this->templates->render('admin/admin_home');
    }
    function login(){
        echo $this->templates->render('login/login');
    }

}