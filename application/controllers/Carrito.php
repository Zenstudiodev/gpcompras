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

    function agregar_producto()
    {
        //Id de producto desde segmento URL
        $data['Producto_id'] = $this->uri->segment(3);
        $data['cantidad'] = $this->uri->segment(4);
        // echo  $data['Producto_id'] ;
        // echo '<br>';
        //echo  $data['cantidad'] ;
        if ($data['Producto_id']) {
            //si se paso un producto
            $datos_producto = $this->Productos_model->get_info_producto($data['Producto_id']);
            if ($datos_producto) {
                //si existe el producto
                $datos_producto = $datos_producto->row();
                //print_contenido($datos_producto);
                $precio_producto = 0;
                /*if($datos_producto->precio_descuento!='0'){
                    $precio_producto = $datos_producto->precio_descuento;
                }else{
                    $precio_producto = mostrar_precio_producto($datos_producto->avaluo_comercial, $datos_producto->precio_venta);
                }*/

                $data_carrito = array(
                    'id' => $datos_producto->producto_id,
                    'qty' => $data['cantidad'],
                    'price' => $datos_producto->producto_precio,
                    'name' => 'producto',
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
                redirect(base_url() . 'index.php/productos/ver_producto/' . $datos_producto->producto_id);
            } else {
                //devolver el producto no existe
            }
        }
    }

    function ver()
    {
        $data['contenido_carrito'] = $this->cart->contents();
        echo $this->templates->render('public/carrito', $data);
    }

    function actualizar()
    {

        //print_contenido($_POST);
        $productos = $_POST;
        //print_contenido($productos);


        // $data['contenido_carrito'] = $this->cart->contents();
        $this->cart->update($productos);
        //print_contenido($this->cart->contents());
        redirect(base_url() . 'index.php/carrito/ver');
    }

    function formas_pago()
    {

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

    function guardar_pago()
    {
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
        $puesto_empresa = $this->input->post('puesto_empresa');
        $asociacion = $this->input->post('asociacion_solidarista');


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
        $productos_pedido_mensaje = '';
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
            $productos_pedido_mensaje .= '<tr><td><strong>codigo producto</strong> </td><td>' . $datos_producto->producto_id . '</td></tr>';
            $productos_pedido_mensaje .= '<tr><td><strong>producto</strong> </td><td>' . $datos_producto->producto_nombre . '</td></tr>';


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


        if ($forma_pago == 'contra entrega') {
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

        if ($forma_pago == 'tarjeta') {
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
        if ($forma_pago == 'gpcompras') {
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
        if ($forma_pago == 'credito') {
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
        if ($forma_pago == 'planilla') {

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


            //generar pdf
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


            $numero_solicitud = $pedido_id;
            $nombre_cliente = $nombre;
            $puesto_cliente = $puesto_empresa;
            $telefono_cliente = $telefono_envio;
            $empresa_cliente = $empresa_planilla;
            $asociacion_solidarista = $asociacion;

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
            foreach ($productos_pedido as $producto) {
                //print_contenido($producto);
                $datos_producto = $this->Productos_model->get_info_producto($producto['id']);
                $datos_producto = $datos_producto->row();
                //print_contenido($datos_producto);
                //set de datos

                $html .= '    <tr >';
                $html .= '        <td >'.$producto['qty'].'</td >';
                $html .= '        <td > '.$datos_producto->producto_id.'</td >';
                $html .= '        <td > '.$datos_producto->producto_nombre .'</td >';
                $html .= '        <td >'.$producto['price'].'</td >';
                $html .= '        <td >'. floatval($producto['qty'] * $producto['price']).'</td >';
                $html .= '    </tr >';

            }
            $html .= '    <tr >';
            $html .= '        <td colspan = "3" ></td >';
            $html .= '        <td  class="tl-d" > Total:</td >';
            $html .= '        <td >'.$total_pedido.'</td >';
            $html .= '        <td ></td >';
            $html .= '    </tr >';
            $html .= '</table >';
            $html .= '<div style="height: 50px; display:block;"><p>&nbsp;</p></div>';
            $html .= '<table id = "entrega" class="w-100" >';
            $html .= '    <tr >';
            $html .= '        <td >';
            $html .= 'lugar de entrega';
            $html .= '</td >';
            $html .= '        <td style = "border: 1px solid black" >'.$direccion_envio.'</td >';
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
            $apdf = $pdf->Output('/home2/gpautos/gpcompras-/pdf/solicitud_planilla/solicitud_pedido_'.$pedido_id.'.pdf', 'F');
            $this->email->attach('/home2/gpautos/gpcompras-/pdf/solicitud_planilla/solicitud_pedido_'.$pedido_id.'.pdf');
            //$pdf->Output('laura pausini', 'I');

            //============================================================
            // END OF FILE
            //============================================================
        }
        if ($forma_pago == 'visacuotas') {
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
        $this->email->send();

        if (!$this->email->send()) {
            // Generate error
            $this->email->print_debugger(array('headers'));
        }


        //vaciamos carrito
        //$this->cart->destroy();

        //redirect(base_url() . 'index.php/user/perfil');
    }

    function forma_envio()
    {
        $data['contenido_carrito'] = '';
        echo $this->templates->render('public/formas_envio', $data);
    }

}