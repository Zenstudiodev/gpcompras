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
        $this->load->model('Admin_model');
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

        $user_id = $this->ion_auth->get_user_id();
        $user_data = $this->User_model->get_user_by_id($user_id);
        $data['user_data'] = $user_data;


        $data['costo_envio'] = $this->input->post('costo_envio');
        $data['total_con_envio'] = $this->input->post('total_con_envio');
        $data['departamento_envio'] = $this->input->post('departamento_envio');
        $data['municipio_envio'] = $this->input->post('municipio_envio');
        $data['zona_envio'] = $this->input->post('zona_envio');
        $data['recibe_envio'] = $this->input->post('recibe_envio');
        $data['telefono_envio'] = $this->input->post('telefono_envio');
        $data['direccion_envio'] = $this->input->post('direccion_envio');
        $data['facturacion_nombre'] = $this->input->post('facturacion_nombre');
        $data['facturacion_nit'] = $this->input->post('facturacion_nit');
        $data['facturacion_direccion'] = $this->input->post('facturacion_direccion');

        $data['eplanilla'] = $this->Admin_model->get_empresas_planilla();
        echo $this->templates->render('public/formas_pago', $data);
    }
    function guardar_pago(){
        //comprobamos que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }


       // print_contenido($_POST);
        $forma_pago = $this->input->post('forma_pago');
        $nombre_tarjeta = $this->input->post('nombre_tarjeta');
        $numero_tarjeta = $this->input->post('numero_tarjeta');
        $vencimiento_tarjeta = $this->input->post('vencimiento_tarjeta');
        $tarjeta_verificacion = $this->input->post('tarjeta_verificacion');
        $departamento_envio = $this->input->post('departamento_envio');
        $municipio_envio = $this->input->post('municipio_envio');
        $zona_envio = $this->input->post('zona_envio');
        $direccion_envio = $this->input->post('direccion_envio');
        $recibe_envio = $this->input->post('recibe_envio');
        $telefono_envio = $this->input->post('telefono_envio');
        $facturacion_nombre = $this->input->post('facturacion_nombre');
        $facturacion_nit = $this->input->post('facturacion_nit');
        $facturacion_direccion = $this->input->post('facturacion_direccion');
        $nombre_credito = $this->input->post('nombre_credito');
        $telefono_credito = $this->input->post('telefono_credito');
        $correo_credito = $this->input->post('correo_credito');
        $empresa_planilla = $this->input->post('empresa_planilla');



        //obtenemos datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        $user_data = $this->User_model->get_user_by_id($user_id);
        $user_data = $user_data->row();
        $nombre = $user_data->first_name . ' ' . $user_data->last_name;


        /* print_contenido($user_data);
         print_contenido($_POST);
        exit();*/
        //obtenemos datos de carrito
        $productos_pedido = $this->cart->contents();
        $total_pedido = $this->cart->total();
        // print_contenido($productos_pedido);
        //echo 'total: '.$total_pedido;
        //generamos set de datos del pedido
        $datos_pedido = array(
            'user_id' => $user_id,
            'total_pedido' => $total_pedido,
            'forma_pago' => $forma_pago
        );
        //print_contenido($datos_pedido);

        //guardamos el pedido en base de datos
        $pedido_id = $this->Productos_model->guardar_pedido($datos_pedido);
        //echo 'peddido id '.$pedido_id;

        //asignamos productos a pedido
        $productos_pedido_mensaje ='';
        foreach ($productos_pedido as $producto) {
            //print_contenido($producto);
            $datos_producto = $this->Productos_model->get_info_producto($producto['id']);
            $datos_producto = $datos_producto->row();
            //print_contenido($datos_producto);
            //set de datos
            $producto_pedido = array(
                'pedido_id' => $pedido_id,
                'codigo_producto' => $producto['id'],
                //'linea_producto' => $datos_producto->producto_linea,
                //'categoria_producto' => $datos_producto->producto_categoria,
                'cantidad_producto' => $producto['qty'],
                'precio_producto' => $producto['price'],
            );
            $this->Productos_model->guardar_producto_pedido($producto_pedido);
            $productos_pedido_mensaje .= '<tr><td><strong>codigo producto</strong> </td><td>' . $datos_producto->producto_id. '</td></tr>';
            $productos_pedido_mensaje .= '<tr><td><strong>producto</strong> </td><td>' . $datos_producto->producto_nombre. '</td></tr>';


        }
        //guardamos direccion de pedido
        $datos_envio = array(
            'pedido_id' => $pedido_id,
            //'direccion_pais' => $this->input->post('pais_envio'),
            'direccion_departamento' => $departamento_envio,
            'direccion_municipio' => $municipio_envio,
            'direccion_zona' => $zona_envio,
            'direccion_direccion' => $direccion_envio,
            'direccion_recibe' => $recibe_envio,
            'direccion_telefono' => $telefono_envio,
            'facturacion_nombre' => $facturacion_nombre,
            'facturacion_nit' => $facturacion_nit,
            'facturacion_direccion' => $facturacion_direccion,
        );
        $this->Productos_model->guardar_direcicon_pedido($datos_envio);
        //print_contenido($producto_pedido);
        //notificamos pedido

        //phpinfo();

        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;

        $this->email->initialize($config);

        $this->email->from('pedidos@gpcompras.net', 'GP COPMRAS');
        $this->email->to('pedidos@gpcompras.net ');
        //$this->email->cc('ventas@ajumbo.com');
        $this->email->bcc('csamayoa@zenstudiogt.com');
        $this->email->subject('Pedido');



        if($forma_pago == 'contra entrega'){
            //
            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
        }

        if($forma_pago == 'tarjeta'){
            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
        }
        if($forma_pago == 'gpcompras'){
            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
        }
        if($forma_pago == 'credito'){
            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
        }
        if($forma_pago == 'planilla'){

            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Empresa planilla:</strong> </td><td>" . strip_tags($empresa_planilla) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";

        }
        if($forma_pago == 'visacuotas'){
            //
            $message = '<html><body>';
            $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Forma de pago:</strong> </td><td>" . strip_tags($forma_pago) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Teléfono:</strong> </td><td>" . strip_tags($telefono_envio) . "</td></tr>";
            $message .= $productos_pedido_mensaje;
            $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
        }










        $this->email->message($message);

        //$this->email->send();

        if (!$this->email->send()) {
            // Generate error
            $this->email->print_debugger(array('headers'));
        }


        //vaciamos carrito
        $this->cart->destroy();

        redirect(base_url() . 'index.php/user/perfil');
    }
    function forma_envio(){
        $data['contenido_carrito'] = '';
        echo $this->templates->render('public/formas_envio', $data);
    }

}