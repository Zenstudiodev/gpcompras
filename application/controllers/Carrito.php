<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 12:00 PM
 */

class Carrito extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
        $this->load->model('Productos_model');
        $this->load->model('User_model');
        $this->load->library("pagination");
        $this->load->library('cart');
    }

    function index()
    {
        $data = compobarSesion();
        $data['clientes'] = $this->Cliente_model->listar_clientes();

        echo $this->templates->render('admin/lista_clientes', $data);
    }
    function agregar_producto(){

        //Id de producto desde segmento URL
        $data['Producto_id'] = $this->uri->segment(3);
        $data['cantidad'] = $this->uri->segment(4);

       // echo  $data['Producto_id'] ;
       // echo '<br>';
        //echo  $data['cantidad'] ;



        if($data['Producto_id']){
            //si se paso un producto
            $datos_producto = $this->Productos_model->get_info_producto($data['Producto_id']);
            if($datos_producto){
                //si existe el producto
                $datos_producto = $datos_producto->row();
                //print_contenido($datos_producto);
                $precio_producto =0;
                /*if($datos_producto->precio_descuento!='0'){
                    $precio_producto = $datos_producto->precio_descuento;
                }else{
                    $precio_producto = mostrar_precio_producto($datos_producto->avaluo_comercial, $datos_producto->precio_venta);
                }*/

                $data_carrito = array(
                    'id'      => $datos_producto->producto_id,
                    'qty'     =>  $data['cantidad'],
                    'price'   => $datos_producto->producto_precio,
                    'name'    => 'producto',
                    //'options' => array('Size' => 'L', 'Color' => 'Red')
                );
                //print_contenido($data_carrito);
                // exit();
                $this->cart->insert($data_carrito);

                /*$data = array(
                    'id'      => 'sku_123ABC',
                    'qty'     => 0,
                    'price'   => 39.95,
                    'name'    => 'T-Shirt',
                    'options' => array('Size' => 'L', 'Color' => 'Red')
                );
               $this->cart->insert($data);*/
                //print_r($this->cart->contents());

                $this->session->set_flashdata('mensaje', 'Se agrego el producto a su carrito');
                redirect(base_url().'index.php/productos/ver_producto/'.$datos_producto->producto_id    );
            }else{
                //devolver el producto no existe
            }


        }


    }
    function ver(){
        $data['contenido_carrito'] = $this->cart->contents();
        echo $this->templates->render('public/carrito', $data);
    }
    function actualizar(){


        //print_contenido($_POST);
        $productos = $_POST;
        //print_contenido($productos);


       // $data['contenido_carrito'] = $this->cart->contents();
        $this->cart->update($productos);
        //print_contenido($this->cart->contents());
        redirect(base_url().'index.php/carrito/ver');
    }
    function formas_pago(){
        $data['contenido_carrito'] = '';
        echo $this->templates->render('public/formas_pago', $data);
    }
    function forma_envio(){
        $data['contenido_carrito'] = '';
        echo $this->templates->render('public/formas_envio', $data);
    }

}