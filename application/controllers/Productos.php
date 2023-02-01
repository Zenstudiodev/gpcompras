<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 12/05/2020
 * Time: 8:55 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
        $this->load->library('email');
        $this->load->model('Productos_model');
        $this->load->model('User_model');
    }

    function index()
    {
        $data['productos'] = $this->Productos_model->get_productos_portada();
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        echo $this->templates->render('public/productos', $data);
    }

    function t()
    {
        $data['productos'] = $this->Productos_model->get_productos_recientes();
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        echo $this->templates->render('public/productos', $data);
    }

    function ver_producto()
    {

        $id_producto = $this->uri->segment(3);
        $porducto = $this->Productos_model->get_info_producto($id_producto);
        $data['producto'] = $porducto;
        $porducto = $porducto->row();
        $categoria_id= $porducto->producto_categoria_sub_categoria;
        //echo $categoria_id;
        $data['catgoria'] = $this->Productos_model->get_categoria_by_id($categoria_id);

        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }
        echo $this->templates->render('public/producto', $data);
    }

    function categoria()
    {
        $linea = urldecode($this->uri->segment(3));

        if ($keyword = $this->input->post('buscar_input')) {
            $data['keyword'] = $keyword;
        } else {
            $data['keyword'] = '';
        }
        $data['productos'] = $this->Productos_model->get_productos_categoria($linea);
        //print_contenido($data['productos']->result());

        echo $this->templates->render('public/productos_categoria', $data);
    }

    function sub_categoria()
    {
        $categoria = urldecode($this->uri->segment(3));
        $sub_categoria = urldecode($this->uri->segment(4));


        $data['productos_sub_categoria'] = $this->Productos_model->get_productos_sub_categoria($categoria, $sub_categoria);
        $data['categorias'] = $this->Productos_model->get_categorias();
        $data['sub_categorias'] = $this->Productos_model->get_sub_categorias($categoria);
        $data['categoria_actual'] = $categoria;
        echo $this->templates->render('public/sub_categorias', $data);

    }


    function listado_productos_categoria()
    {
        $categoria = urldecode($this->uri->segment(3));
        $sub_categoria = urldecode($this->uri->segment(4));
        $data['productos_sub_categoria'] = $this->Productos_model->get_productos_sub_categoria($categoria, $sub_categoria);
        $data['categorias'] = $this->Productos_model->get_categorias();
        if ($keyword = $this->input->post('buscar_input')) {
            $data['keyword'] = $keyword;
        } else {
            $data['keyword'] = '';
        }
        echo $this->templates->render('public/productos_categoria', $data);
    }

    //pedidos
    public function crear_predido()
    {

        //comprobamos que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        //obtenemos datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        $user_data = $this->User_model->get_user_by_id($user_id);
        $user_data = $user_data->row();
        $nombre = $user_data->first_name . ' ' . $user_data->last_name;

        /* print_contenido($user_data);
         print_contenido($_POST);*/
        //exit();
        //obtenemos datos de carrito
        $productos_pedido = $this->cart->contents();
        $total_pedido = $this->cart->total();
        // print_contenido($productos_pedido);
        //echo 'total: '.$total_pedido;
        //generamos set de datos del pedido
        $datos_pedido = array(
            'user_id' => $user_id,
            'total_pedido' => $total_pedido
        );
        //print_contenido($datos_pedido);

        //guardamos el pedido en base de datos
        $pedido_id = $this->Productos_model->guardar_pedido($datos_pedido);
        //echo 'peddido id '.$pedido_id;

        //asignamos productos a pedido
        foreach ($productos_pedido as $producto) {
            //print_contenido($producto);
            $datos_producto = $this->Productos_model->get_info_producto($producto['id']);
            $datos_producto = $datos_producto->row();
            //print_contenido($datos_producto);
            //set de datos
            $producto_pedido = array(
                'pedido_id' => $pedido_id,
                'codigo_producto' => $producto['id'],
                'linea_producto' => $datos_producto->producto_linea,
                'categoria_producto' => $datos_producto->producto_categoria,
                'cantidad_producto' => $producto['qty'],
                'precio_producto' => $producto['price'],
            );
            $this->Productos_model->guardar_producto_pedido($producto_pedido);


        }
        //guardamos direccion de pedido
        $direccion_pedido = array(
            'pedido_id' => $pedido_id,
            'direccion_pais' => $this->input->post('pais_envio'),
            'direccion_departamento' => $this->input->post('departamento_envio'),
            'direccion_municipio' => $this->input->post('municipio_envio'),
            'direccion_zona' => $this->input->post('zona_envio'),
            'direccion_direccion' => $this->input->post('direccion_envio'),
            'direccion_recibe' => $this->input->post('recibe_envio'),
            'direccion_telefono' => $this->input->post('telefono_envio'),
            'facturacion_nombre' => $this->input->post('facturacion_nombre'),
            'facturacion_nit' => $this->input->post('facturacion_nit'),
            'facturacion_direccion' => $this->input->post('facturacion_direccion'),
        );
        $this->Productos_model->guardar_direcicon_pedido($direccion_pedido);
        //print_contenido($producto_pedido);
        //notificamos pedido

        //phpinfo();
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;

        $this->email->initialize($config);

        $this->email->from('pedidos@gpcompras.net', 'GP COPMRAS');
        $this->email->to('pedidos@gpcompras.net ');
        $this->email->bcc('csamayoa@zenstudiogt.com');
        $this->email->subject('Pedido');


        $message = '<html><body>';
        $message .= '<img src="' . base_url() . '/ui/public/imagenes/logo.png" alt="GP COPMRAS" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
        $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";


        $this->email->message($message);

        $this->email->send();

        if (!$this->email->send()) {
            // Generate error
            $this->email->print_debugger(array('headers'));
        }


        //vaciamos carrito
        //$this->cart->destroy();

        //redirect(base_url() . 'index.php/user/perfil');

    }

    function prueba_pedido()
    {

        echo 'prueba pedido';
    }

    function pagar_pedido()
    {
        //comprobar que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        $user_id = $this->ion_auth->get_user_id();
        //comporbar que sea su pedido
        $pedido_id = $this->uri->segment(3);
        $datos_pedido = $this->Productos_model->get_pedido_by_id_user_id($pedido_id, $user_id);

        //datos del pedido
        if ($datos_pedido) {
            $datos_pedido = $datos_pedido->row();
        }
        //print_contenido($datos_pedido);
        //productos del pedido
        $productos_pedido = $this->Productos_model->get_productos_pedido($pedido_id);
        if ($productos_pedido) {
            $productos_pedido = $productos_pedido->result();
        }
        //print_contenido($productos_pedido);

        //direccion de pedido
        $direccion_pedido = $this->Productos_model->get_direccion_pedido($pedido_id);
        if ($direccion_pedido) {
            $direccion_pedido = $direccion_pedido->row();
        }
        //vista de pago del pedido
        $data['datos_pedido'] = $datos_pedido;
        $data['productos_pedido'] = $productos_pedido;
        $data['direccion_pedido'] = $direccion_pedido;
        echo $this->templates->render('public/pagar_pedido', $data);


    }

    function procesar_pago()
    {
        print_contenido($_POST);
        //comprobar que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }

        //datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        $datos_usuario = $this->User_model->get_user_by_id($user_id);
        $datos_usuario = $datos_usuario->row();
        $nombre_usuario = $datos_usuario->first_name . ' ' . $datos_usuario->last_name;
        $data['email'] = $this->session->email;
        $data['ip_adress'] = $this->input->ip_address();

        $direccion_factura = 'direccion';
        $ciudad = 'Guatemala';
        $departamento = 'Guatemala';

        $numero_tarjeta = $this->input->post('numero_tarjeta');
        $expirationMonth = $this->input->post('mes_vencimiento_tarjeta');
        $expirationYear = $this->input->post('ano_vencimiento_tarjeta');
        $cvv = $this->input->post('cvv_tarjeta');


        $pedido_id = $this->input->post('pedido_id');
        $datos_pedido = $this->Productos_model->get_pedido_by_id_user_id($pedido_id, $user_id);
        if ($datos_pedido) {
            $datos_pedido = $datos_pedido->row();
        }


        $referenceCode = 'visanetgt_gpautos';

        $client = new CybsSoapClient();
        $request = $client->createRequest($referenceCode);
        // This section contains a sample transaction request for the authorization
        //// service with complete billing, payment card, and purchase (two items) information.

        $ccAuthService = new stdClass();
        $ccAuthService->run = 'true';
        $request->ccAuthService = $ccAuthService;

        $billTo = new stdClass();
        $billTo->firstName = $datos_usuario->first_name;
        $billTo->lastName = $datos_usuario->last_name;
        $billTo->street1 = $direccion_factura;
        $billTo->city = $ciudad;
        $billTo->state = $departamento;
        $billTo->postalCode = '01010';
        $billTo->country = 'GT';
        $billTo->email = $data['email'];
        $billTo->ipAddress = $data['ip_adress'];
        $request->billTo = $billTo;

        $card = new stdClass();
        $card->accountNumber = $numero_tarjeta;
        $card->expirationMonth = $expirationMonth;
        $card->expirationYear = $expirationYear;
        $card->cvNumber = $cvv;
        $request->card = $card;


        $purchaseTotals = new stdClass();
        $purchaseTotals->currency = 'GTQ';
        $request->purchaseTotals = $purchaseTotals;


        $request->deviceFingerprintID = $this->input->post('deviceFingerprintID');
        //echo $this->input->post('deviceFingerprintID');

        /*$item0 = new stdClass();
        $item0->unitPrice = '12.34';
        $item0->quantity = '2';
        $item0->id = '0';*/

        $item1 = new stdClass();
        //prueba
        //$item1->unitPrice = '1';
        $item1->unitPrice = $datos_pedido->total_pedido;
        $item1->productName = 'productos jumbo';
        $item1->id = '1';

        //$request->item = array($item0, $item1);
        $request->item = array($item1);

        //print_contenido($request);
        $reply = $client->runTransaction($request);

// This section will show all the reply fields.
        print("\nAUTH RESPONSE: " . print_contenido($reply, true));

        if ($reply->decision == 'ACCEPT' or $reply->ccAuthReply->reasonCode == '100') {

            //correo notificacion de pago
            /* $this->notiticacion_pago($user_id, $data['email'], $nombre_usuario, $total_a_pagar, $data['tipo_anuncio'], 'Pago con tarjeta');

             $datos_cliente = (object)null;
             $datos_cliente->nitComprador = $nit;
             $datos_cliente->nombreComercialComprador = $nombre_factura;
             $datos_cliente->direccionComercialComprador = $direccion_factura;
             $datos_cliente->telefonoComprador = '0';
             $datos_cliente->correoComprador = $data['email'];
             $producto_facturar = (object)null;

             //$anuncio_vip = true;
             //$anuncio_individual = true;

             if ($this->session->facebook) {

                 $precio_unitario = $precio_facebook;
                 $monto_bruto = $precio_unitario / 1.12;
                 $monto_bruto = round($monto_bruto, 2);
                 $iva = $monto_bruto * 0.12;
                 $iva = round($iva, 2);

                 $total_a_pagar = $total_a_pagar + $precio_facebook->parametro_valor;
                 $producto_facturar->vip = (object)array(
                     'producto' => 'vip',
                     'cantidad' => '1',
                     'unidadMedida' => 'UND',
                     'codigoProducto' => '001-2020',
                     'descripcionProducto' => 'Anuncio Facebook',
                     'precioUnitario' => $precio_unitario,
                     'montoBruto' => $monto_bruto,
                     'montoDescuento' => '0',
                     'importeNetoGravado' => $precio_unitario,
                     'detalleImpuestosIva' => $iva,
                     'importeExento' => '0',
                     'otrosImpuestos' => '0',
                     'importeOtrosImpuestos' => '0',
                     'importeTotalOperacion' => $precio_unitario,
                     'tipoProducto' => 'S',

                 );

             }


             if ($data['tipo_anuncio'] == 'vip') {
                 $producto_facturar->vip = (object)array(
                     'producto' => 'vip',
                     'cantidad' => '1',
                     'unidadMedida' => 'UND',
                     'codigoProducto' => '001-2020',
                     'descripcionProducto' => 'Anuncio Vip',
                     'precioUnitario' => '0',
                     'montoBruto' => '0',
                     'montoDescuento' => '0',
                     'importeNetoGravado' => '0',
                     'detalleImpuestosIva' => '0',
                     'importeExento' => '0',
                     'otrosImpuestos' => '0',
                     'importeOtrosImpuestos' => '0',
                     'importeTotalOperacion' => '0',
                     'tipoProducto' => 'S',

                 );
             }
             /* if ($data['tipo_anuncio'] == 'vip') {
                  $producto_facturar->vip = (object)array(
                      'producto' => 'vip',
                      'cantidad' => '1',
                      'unidadMedida' => 'UND',
                      'codigoProducto' => '001-2020',
                      'descripcionProducto' => 'Anuncio Vip',
                      'precioUnitario' => '275',
                      'montoBruto' => '245.54',
                      'montoDescuento' => '0',
                      'importeNetoGravado' => '275',
                      'detalleImpuestosIva' => '29.46',
                      'importeExento' => '0',
                      'otrosImpuestos' => '0',
                      'importeOtrosImpuestos' => '0',
                      'importeTotalOperacion' => '275',
                      'tipoProducto' => 'S',

                  );
              }*/

            /*
                        if ($data['tipo_anuncio'] == 'individual') {
                            $producto_facturar->individual = (object)array(
                                'producto' => 'individual',
                                'cantidad' => '1',
                                'unidadMedida' => 'UND',
                                'codigoProducto' => '002-2020',
                                'descripcionProducto' => 'Anuncio Individual',
                                'precioUnitario' => '75',
                                'montoBruto' => '66.96',// 75 /1.12= 66.96
                                'montoDescuento' => '0',
                                'importeNetoGravado' => '175',
                                'detalleImpuestosIva' => '8.03',// 66.96*0.12= 8.03
                                'importeExento' => '0',
                                'otrosImpuestos' => '0',
                                'importeOtrosImpuestos' => '0',
                                'importeTotalOperacion' => '175',
                                'tipoProducto' => 'S',
                            );

                        }

                        $this->facturar_global($producto_facturar, $datos_cliente);

            */

            /*if ($data['tipo_anuncio'] == 'individual') {
                redirect(base_url() . 'cliente/publicar_carro');
            }
            if ($data['tipo_anuncio'] == 'vip') {
                redirect(base_url() . 'cliente/publicar_carro_vip');
            }*/

            //pasar pedido a pagado
            $this->session->set_flashdata('mensaje', 'el pedido se pago correctamente');
            $this->Productos_model->pasar_pedido_a_pagado($pedido_id);
            redirect(base_url() . 'index.php/user/perfil');


            //redirect(base_url() . 'cliente/perfil');
            //redirect(base_url() . 'cliente/publicar_carro');
            //echo 'guardar numero de transaccion en base de datos';
            //echo $reply->requestID;
        } else {
            $this->session->set_flashdata('error', $reply->reasonCode);
            //$this->notiticacion_error_pago($user_id, $data['email'], $nombre_usuario, $datos_pedido->total_pedido, $data['tipo_anuncio'], 'Pago con tarjeta', $reply);
            //redirect(base_url() . 'cliente/datos_pago');
            //echo 'poner mensaje de error redireccionar';
            //print("\nFailed auth request.\n");
            // This section will show all the reply fields.
            //echo '<pre>';
            //print("\nRESPONSE: " . print_r($reply, true));
            //echo '</pre>';
            return;
        }

// Build a capture using the request ID in the response as the auth request ID
        /* $ccCaptureService = new stdClass();
         $ccCaptureService->run = 'true';
         $ccCaptureService->authRequestID = $reply->requestID;

         $captureRequest = $client->createRequest($referenceCode);
         $captureRequest->ccCaptureService = $ccCaptureService;
         $captureRequest->item = array($item1);
         $captureRequest->purchaseTotals = $purchaseTotals;

         $captureReply = $client->runTransaction($captureRequest);
        */
        // This section will show all the reply fields.
        // print("\nCAPTRUE RESPONSE: " . print_contenido($captureReply, true));


    }

    //administracion

    function borrar_producto()
    {
        $id_producto = $this->uri->segment(3);
        $producto = $this->Productos_model->get_info_producto_admin($id_producto);
        $producto = $producto->row();
        //print_contenido($producto);
        $this->Productos_model->borrar_registro_producto($id_producto);
        $imagenes_producto = get_imgenes_producto_public($producto->producto_id);
        if ($imagenes_producto) {
            // print_contenido($imagenes_producto->result());

            $start_banner = 0;
            foreach ($imagenes_producto->result() as $imagen) {

                $imagen_id = $imagen->imagen_id;
                // echo $imagen_id;

                $datos_imagen = $this->Productos_model->get_datos_imagen($imagen_id);
                if ($datos_imagen) {
                    $datos_imagen = $datos_imagen->row();
                    $nombre_imagen = $datos_imagen->nombre_imagen;
                    //echo $nombre_imagen;

                    //borrado de registro
                    $this->Productos_model->borrar_registro_imagen($imagen_id);

                    //borrado de imagen
                    if (file_exists('/home2/gpautos/gpcompras-/upload/productos_img/' . $nombre_imagen)) {
                        // echo 'imagen existe';
                        if (unlink('/home2/gpautos/gpcompras-/upload/productos_img/' . $nombre_imagen)) {
                            $this->session->set_flashdata('mensaje', 'se borro la imagen');
                            //echo 'se borro';
                            //redirect(base_url() . 'admin/subir_fotos/' . $data['prducto_id']);
                        } else {
                            // echo 'no se borro';
                        }

                    } else {

                        //echo 'la imagen no existe';
                    }


                } else {
                    $this->session->set_flashdata('mensaje', 'imagen no existe');
                    //edirect(base_url() . '/admin/subir_fotos/' . $data['prducto_id']);

                }

            }


        }

        redirect(base_url() . 'admin/listado_productos');


    }

    //buscar
    function buscar_producto()
    {
        $keyword = $this->input->post('buscar_input');
        if ($keyword) {
            $productos = $this->Productos_model->buscar($keyword);
            $data['keyword'] = $keyword;
            $data['productos_sub_categoria'] = $productos;
            $data['categorias'] = $this->Productos_model->get_categorias();
            //$data['catalogos_list'] = $this->Productos_model->get_catalogos();
            //print_contenido($productos->result());
            echo $this->templates->render('public/productos_categoria', $data);
        } else {
            redirect(base_url());
        }
    }

    function admin_revisar_producto()
    {
        $id_producto = $this->uri->segment(3);
        $data['producto'] = $this->Productos_model->get_info_producto($id_producto);
        echo $this->templates->render('admin/admin_revisar_producto', $data);
    }

    function pdf_generatort()
    {
        echo $this->templates->render('admin/solicitud_de_compra');

    }

    function pdf_generator()
    {


        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('GP Compras');
        $pdf->SetTitle('Pedido ');
        $pdf->SetSubject('Solicitud de pago por planilla');
        $pdf->SetKeywords('GP compras');
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 061', PDF_HEADER_STRING);

        // set header and footer fonts
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set font
        //$pdf->SetFont('helvetica', '', 10);

// add a page
        $pdf->AddPage();

        /* NOTE:
         * *********************************************************
         * You can load external XHTML using :
         *
         * $html = file_get_contents('/path/to/your/file.html');
         *
         * External CSS files will be automatically loaded.
         * Sometimes you need to fix the path of the external CSS.
         * *********************************************************
         */

// define some HTML content with style
        $html = '<style>
        .t-center,h1{text-align:center}#cuadro_firma,.datos_productos table,.datos_productos td,.datos_productos th{border:1px solid #000}.w-100{width:100%}.w-90{width:90%}.w-80{width:80%}.w-70{width:70%}.w-60{width:60%}.w-50{width:50%}.w-40{width:40%}.w-30{width:30%}.w-20{width:20%}.w-10{width:10%}.forma_pdf{width:800px;background:#f7f4f3;font-family:Arial}.forma_pdf_container{margin:10px auto;width:97%}.titulo{color:#f19800;font-size:24px;font-weight:700;padding-top:11px;display:block}#logo{height:auto;width:180px}h1{font-size:30px}.datos_cliente{margin-bottom:20px}table{border-collapse:separate!important;border-spacing:0!important;padding:5px}.datos_productos{margin:10px auto}.tl-d{text-align:right}#entrega{margin:40px auto}#cuadro_firma{width:300px;height:160px}
</style>';


        $numero_solicitud = '4554';
        $nombre_cliente = 'nombre cliente';
        $puesto_cliente = 'puesto cliente';
        $telefono_cliente = 'telefono cliente';
        $empresa_cliente = 'empresa cliente';
        $asociacion_solidarista = 'Asociacion';
        $html .= '<div class="forma_pdf" style=" width: 800px; background: #f7f4f3;     font-family: Arial;">';
        $html .= '<div class="forma_pdf_container">';
        $html .= '<table class="table">';
        $html .= '    <tr>';
        $html .= '        <td class="w-50">';
        $html .= ' <a href="' . base_url() . '">';
        $html .= '                <img src="' . base_url() . 'ui/public/imagenes/logo.png" id="logo">';
        $html .= '            </a>';
        $html .= '        </td>';
        $html .= '<td class="w-50 t-center" >';
        $html .= '            <span class="titulo" style="color: #f19800; font-size: 24px; font-weight: 900; padding-top: 11px; display: block;"> www.GPCOMPRAS.NET</span >';
        $html .= '        </td >';
        $html .= '    </tr >';
        $html .= '    <tr >';
        $html .= '<td class="t-center" colspan = "2" >';
        $html .= '</td >';
        $html .= '</tr >';
        $html .= '<tr >';
        $html .= '<td class="t-center" colspan = "2" >';
        $html .= '<h1 > Solicitud de compra ' . $numero_solicitud . '</h1>';
        $html .= '</td >';
        $html .= '</tr >';
        $html .= '</table >';
        $html .= '<table class="datos_cliente" >';
        $html .= '<tr >';
        $html .= '<td class="w-20" > Cliente:</td >';
        $html .= '<td >' . $nombre_cliente . '</td >';
        $html .= '</tr >';
        $html .= '<tr >';
        $html .= '<td > Puesto:</td >';
        $html .= '<td >' . $puesto_cliente . '</td >';
        $html .= '</tr >';
        $html .= '<tr >';
        $html .= '<td > Telefono</td >';
        $html .= '<td >' . $telefono_cliente . '</td >';
        $html .= '</tr >';
        $html .= '<tr >';
        $html .= '<td> Empresa</td >';
        $html .= '<td>' . $empresa_cliente . '</td >';
        $html .= '</tr >';
        $html .= '   <tr >';
        $html .= '        <td > Asociación solidarista </td >';
        $html .= '        <td >' . $asociacion_solidarista . '</td >';
        $html .= '    </tr >';
        $html .= '</table >';
        $html .= '<div style="height: 20px; display:block;"></div>';
        $html .= '<table class="datos_productos w-100" >';
        $html .= '    <tr >';
        $html .= '       <td >Cantidad </td >';
        $html .= '        <td > Codigo</td >';
        $html .= '        <td > Producto</td >';
        $html .= '        <td > Precio unidad </td >';
        $html .= '        <td > Total</td >';
        $html .= '    </tr >';
        $html .= '    <tr >';
        $html .= '        <td > 1</td >';
        $html .= '        <td > 102</td >';
        $html .= '        <td > OLLA DE PRESION DE 9 LITROS BLACK & DECK </td >';
        $html .= '        <td > 485.00</td >';
        $html .= '        <td > 485.00</td >';
        $html .= '    </tr >';
        $html .= '    <tr >';
        $html .= '        <td > 1</td >';
        $html .= '        <td > 102</td >';
        $html .= '        <td > OLLA DE PRESION DE 9 LITROS BLACK & DECK </td >';
        $html .= '        <td > 485.00</td >';
        $html .= '        <td > 485.00</td >';
        $html .= '    </tr >';

        $html .= '    <tr >';
        $html .= '        <td colspan = "3" ></td >';
        $html .= '        <td  class="tl-d" > Total:</td >';
        $html .= '        <td ></td >';
        $html .= '        <td ></td >';
        $html .= '    </tr >';
        $html .= '</table >';
        $html .= '<div style="height: 50px; display:block;"><p>&nbsp;</p></div>';
        $html .= '<table id = "entrega" class="w-100" >';
        $html .= '    <tr >';
        $html .= '        <td >';
        $html .= 'lugar de entrega';
        $html .= '</td >';
        $html .= '        <td style = "border: 1px solid black" > Km, 16.5 carr salvador arrazola panorama lote 32 codigo 0990 </td >';
        $html .= '    </tr >';
        $html .= '</table >';
        $html .= '<div style="height: 50px; display:block;"><p>&nbsp;</p></div>';
        $html .= '<table class="w-100" >';
        $html .= '    <tr >';
        $html .= '        <td class="w-50" >';
        $html .= '            <table >';
        $html .= '                <tr >';
        $html .= '                    <td colspan = "2" >';
        $html .= 'Autorizacion';
        $html .= '                    </td >';
        $html .= '                </tr >';
        $html .= '                <tr >';
        $html .= '                    <td >';
        $html .= 'Nombre';
        $html .= '                   </td >';
        $html .= '                    <td ></td >';
        $html .= '                </tr >';
        $html .= '                <tr >';
        $html .= '                    <td >';
        $html .= 'Puesto';
        $html .= '                    </td >';
        $html .= '                    <td ></td >';
        $html .= '                </tr >';
        $html .= '                <tr >';
        $html .= '                    <td >';
        $html .= 'Fecha Autorizacion';
        $html .= '</td >';
        $html .= '                    <td ></td >';
        $html .= '                </tr >';
        $html .= '            </table >';
        $html .= '</td >';
        $html .= '        <td class="w-50" >';
        $html .= '            <table >';
        $html .= '                <tr >';
        $html .= '                    <td >';
        $html .= 'Frima de autorizado';
        $html .= '</td >';
        $html .= '                </tr >';
        $html .= '                <tr >';
        $html .= '                    <td >';
        $html .= '                        <div id = "cuadro_firma" >';
        $html .= '                                </div >';
        $html .= '                    </td >';
        $html .= '                </tr >';
        $html .= '            </table >';
        $html .= '</td >';
        $html .= '    </tr >';
        $html .= '</table >';
        $html .= '</div >';
        $html .= '</div > ';


// output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// reset pointer to the last page
        $pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('example_061.pdf', 'I');
        //$pdf->Output('laura pausini', 'I');


//============================================================+
// END OF FILE
//============================================================+

    }


}

