<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:10 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller
{
	function __construct()
	{
		parent::__construct();
		// Modelos
        $this->load->model('Productos_model');
        $this->load->model('Banners_model');
        $this->load->model('User_model');
	}

	function index()
	{
        $data['productos'] = $this->Productos_model->get_productos_portada();
        $data['header_banners'] = $this->Banners_model->header_banners_activos();

        //categorias
        $data['categorias'] = $this->Productos_model->get_categorias();
        echo $this->templates->render('public/home', $data);
    }
	public function respuesta(){
	    print_r($_SERVER);
    }
}