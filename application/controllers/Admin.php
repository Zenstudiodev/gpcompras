<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 5/06/2020
 * Time: 8:05 PM
 */

class Admin extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
        $this->load->library('email');
        $this->load->model('Productos_model');
        $this->load->model('User_model');
        $this->load->model('Banners_model');
        $this->load->model('Admin_model');
    }

    function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        echo $this->templates->render('admin/admin_home');
    }

    //categorias
    public function categorias()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        $data['categorias'] = $this->Productos_model->get_categorias_n();
        echo $this->templates->render('admin/admin_categorias', $data);
    }
    public function crear_categoria()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        $data['categorias'] = $this->Productos_model->get_categorias_n();
        echo $this->templates->render('admin/admin_crear_categoria', $data);
    }
    public function guardar_categoria()
    {
        //print_contenido($_POST);
        $categoria_data = array(
            'categoria_padre' => $this->input->post('categoria_padre'),
            'nombre_categoria' => $this->input->post('nombre_categoria'),
        );
        //print_r($post_data);
        $this->Productos_model->guardar_categoria_sub_categoria($categoria_data);

        redirect(base_url() . 'admin/categorias/');


    }
    public function borrar_categoria(){
        $categoria_id = $this->uri->segment(3);
        $this->Productos_model->borrar_categoria_sub_categoria($categoria_id);
        redirect(base_url() . 'admin/categorias/');

    }

    //productos
    public function listado_productos()
    {
        $data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('admin/productos', $data);
    }
    public function crear_producto()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        $data['categorias'] = $this->Productos_model->get_categorias_n();
        echo $this->templates->render('admin/crear_producto', $data);
    }
    public function guardar_producto()
    {
         //print_contenido($_POST);

        $producto_data = array(
            'producto_codigo' => $this->input->post('producto_codigo'),
            'producto_nombre' => $this->input->post('producto_nombre'),
            'producto_categoria_sub_categoria' => $this->input->post('producto_categoria_sub_categoria'),
            'producto_categoria' => $this->input->post('producto_categoria'),
            'producto_sub_categoria' => $this->input->post('producto_sub_categoria'),
            'producto_marca' => $this->input->post('producto_marca'),
            'producto_color' => $this->input->post('producto_color'),
            'producto_medidas' => $this->input->post('producto_medidas'),
            'producto_descripcion' => $this->input->post('producto_descripcion'),
            'producto_tags' => $this->input->post('producto_tags'),
            'producto_existencias' => $this->input->post('producto_existencias'),
            'producto_precio' => $this->input->post('producto_precio'),
            'producto_precio_oferta' => $this->input->post('producto_precio_oferta'),
            'producto_envio_capital' => $this->input->post('producto_envio_capital'),
            'producto_envio_interior' => $this->input->post('producto_envio_interior'),
        );
        //print_r($post_data);

        $producto_id = $this->Productos_model->guardar_producto($producto_data);

        if ($producto_id) {
            redirect(base_url() . 'admin/subir_fotos/' . $producto_id);
        }
    }
    public function editar_producto()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $producto_id = $this->uri->segment(3);
        $data['producto_id'] = $producto_id;
        //datos de la propiedad
        $data['categorias'] = $this->Productos_model->get_categorias_n();
        $data['producto'] = $this->Productos_model->get_info_producto($producto_id);

        echo $this->templates->render('admin/editar_producto', $data);
    }
    public function actualizar_producto()
    {
        $producto_data = array(
            'producto_id' => $this->input->post('producto_id'),
            'producto_codigo' => $this->input->post('producto_codigo'),
            'producto_nombre' => $this->input->post('producto_nombre'),
            'producto_categoria_sub_categoria' => $this->input->post('producto_categoria_sub_categoria'),
            'producto_categoria' => $this->input->post('producto_categoria'),
            'producto_sub_categoria' => $this->input->post('producto_sub_categoria'),
            'producto_marca' => $this->input->post('producto_marca'),
            'producto_color' => $this->input->post('producto_color'),
            'producto_medidas' => $this->input->post('producto_medidas'),
            'producto_descripcion' => $this->input->post('producto_descripcion'),
            'producto_tags' => $this->input->post('producto_tags'),
            'producto_existencias' => $this->input->post('producto_existencias'),
            'producto_precio' => $this->input->post('producto_precio'),
            'producto_precio_oferta' => $this->input->post('producto_precio_oferta'),
            'producto_envio_capital' => $this->input->post('producto_envio_capital'),
            'producto_envio_interior' => $this->input->post('producto_envio_interior'),
        );
        //print_r($post_data);

        $producto_id = $this->Productos_model->actualizar_producto($producto_data);

        redirect(base_url() . 'admin/listado_productos/' . $producto_id);
    }
    public function desactivar_producto()
    {
    }
    public function borrar_producto()
    {
    }
    public function subir_fotos()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }

        //comprobar que se paso el id de la propiedad
        if (!$this->uri->segment(3)) {
            redirect(base_url() . 'admin/listado_productos');
        }

        $producto_id = $this->uri->segment(3);
        $data['producto_id'] = $producto_id;
        //datos de la propiedad
        $data['producto'] = $this->Productos_model->get_info_producto($producto_id);
        $data['fotos_producto'] = $this->Productos_model->get_fotos_de_producto_by_id($producto_id);
        echo $this->templates->render('admin/subir_imagenes_propiedad', $data);

    }
    public function guardar_imagen()
    {
        // print_contenido($_FILES);
        //print_contenido($_GET);
        //obtenemos el id del producto desde una cabecera http enviada desde el dropzone
        //print_contenido($_SERVER);
        //print_contenido($_POST);
        $producto_id = $_GET['pid'];
        //$producto_id = $_SERVER['HTTP_PRODUCTO_ID'];
        //echo 'el id del producto es : ' . $producto_id;
        //obtenemos los datos del producto con el id de la cabecera
        $datos_de_producto = $this->Productos_model->get_info_producto($producto_id);
        $datos_de_producto = $datos_de_producto->row();

        //obtenemos el numero de imagenes desde el producto
        //$numero_de_imagenes = $datos_de_producto->imagen;

        //generamos el nombre para la imagen que se va a subir
        //comprobamos si hay algun nombre en la tabla de imagenes
        $imagenes_producto = $this->Productos_model->get_fotos_de_producto_by_id($producto_id);
        if ($imagenes_producto) {
            //si ya tiene imagenes y existe la primera
            if (file_exists('/home2/gpautos/gpcompras-/upload/productos_img/' . $producto_id . '.jpg')) {
                $poner_nombre = false;
                $i = 1;//numero de conteo que aumenta para modificar el nombre de la imagen
                do { // comprbar los nombres mientras no se pueda poner el nombre
                    if (file_exists('/home2/gpautos/gpcompras-/upload/productos_img/' . $producto_id . '_' . $i . '.jpg')) {
                        //echo 'la imagen existe no ponerle asi';
                        $poner_nombre = false;
                    } else {
                        //echo 'la imagen no se encuentra ponerle asi \n ';
                        $nombre_imagen = $producto_id . '_' . $i . '.jpg';
                        $poner_nombre = true;
                    }
                    $i = $i + 1;
                } while ($poner_nombre == false); //Loop minetras que no se pueda poner el nombre de la imagen
                echo $nombre_imagen;
            } else {
                //si no existe la primera imagen
                $nombre_imagen = $producto_id . '.jpg';
            }
        } else {
            //si no existen imagenes
            $nombre_imagen = $producto_id . '.jpg';
        }

        $tipo_imagen = $_FILES['imagen_propiedad']['type'];
        $tipo_imagen = explode("/", $tipo_imagen);
        $extension_imgen = $tipo_imagen[1]; // porción2

        //datos de imagen
        $datos_imagen = array(
            "producto_id" => $producto_id,
            "extencion" => $extension_imgen,
            "nombre_imagen" => $nombre_imagen
        );
        //guadramos el nombre generado de la imagen y la asignamos a producto
        $this->Productos_model->guardar_foto_tabla_fotos($datos_imagen);
        //print_r($datos_imagen);

        if (!empty($_FILES['imagen_propiedad']['name'])) { //si se envio un archivo
            $tipo_imagen = $_FILES['imagen_propiedad']['type'];
            echo '<p>' . $nombre_imagen . '</p>';
            echo '<p>' . $tipo_imagen . '</p>';

            $config['upload_path'] = './upload/productos_img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $nombre_imagen;
            $config['overwrite'] = TRUE;
            //$config['max_size']      = 100;
            //$config['max_width']     = 1024;
            //$config['max_height']    = 768;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('imagen_propiedad')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $config['image_library'] = 'gd2';
                $config['source_image'] = './web/propiedades_pic/' . $nombre_imagen;
                //$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 800;
                //$config['height']       = 50;
                $this->load->library('image_lib', $config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }


                $data = array('upload_data' => $this->upload->data());
                //$this->load->view('subir_documento', $data);
                echo $this->upload->data('file_name');
                echo $this->upload->data('file_size');
            }
        } else {

        }
    }
    public function borrar_imagen()
    {

        //Id de imagen desde segmento URL
        $data['imagen_id'] = $this->uri->segment(3);
        //Id de producto desde segmento URL
        $data['prducto_id'] = $this->uri->segment(4);
        $imagen_id = $data['imagen_id'];
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
                    redirect(base_url() . 'admin/subir_fotos/' . $data['prducto_id']);
                } else {
                    // echo 'no se borro';
                }

            } else {

                //echo 'la imagen no existe';
            }


        } else {
            $this->session->set_flashdata('mensaje', 'imagen no existe');
            redirect(base_url() . '/admin/subir_fotos/' . $data['prducto_id']);

        }
    }


    //pedidos
    public function listado_pedidos()
    {
        $data['pedidos'] = $this->Productos_model->get_pedidos();
        echo $this->templates->render('admin/pedidos', $data);
    }
    public function revisar_pedido()
    {
        $id_pedido = $this->uri->segment(3);
        $data['datos_pedido'] = $this->Productos_model->get_pedido_by_id($id_pedido);
        $data['datos_envio'] = $this->Productos_model->get_direccion_pedido($id_pedido);
        if ($data['datos_pedido']) {
            $pedido = $data['datos_pedido']->row();
            $data['cliente'] = $this->User_model->get_user_by_id($pedido->user_id_pedido);
            $data['productos_pedido'] = $this->Productos_model->get_productos_pedido($id_pedido);
        }


        echo $this->templates->render('admin/revisar_pedido', $data);
    }
    public function actualizar_pedido()
    {
        $id_pedido = $this->input->post('id_pedido');
        $estado_pedido = $this->input->post('estado_pedido');

        $datos_pedido = array(
            'pedido_id' => $id_pedido,
            'estado_pedido' => $estado_pedido,
        );
        $this->Productos_model->actualizar_pedido($datos_pedido);

        redirect(base_url() . 'index.php/admin/listado_pedidos');
    }


    //banners
    public function banners()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }

    }
    public function banners_inactivos()
    {
    }
    public function crear_banner()
    {
    }
    public function guardar_banner()
    {
    }
    public function desactivar_banner()
    {
    }
    public function crear_banner_header()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data['titulo'] = 'Crear Banner Header';

        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }

        echo $this->templates->render('admin/admin_crear_banner_header', $data);
    }
    public function guardar_banner_header()
    {
        // print_contenido($_POST);

        $titulo = $this->input->post('titulo');

        $nombre_imagen = str_replace(' ', '_', $titulo);

        $config['upload_path'] = './ui/public/imagenes/banners';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $nombre_imagen;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            $error = array('error' => $this->upload->display_errors());
            print_contenido($error);
            //$this->load->view('upload_form', $error);
        } else {
            $post_data = array(
                'titulo' => $titulo,
                'link' => $this->input->post('link'),
                'imagen' => $nombre_imagen,
                'area' => $this->input->post('area'),
                'vencimiento' => $this->input->post('vencimiento'),
                'estado' => $this->input->post('estado'),
            );


            //print_r($post_data);

            $this->Banners_model->crear_banners_header($post_data);
            redirect(base_url() . 'admin/banners_header/');
        }


    }
    public function banners_header()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }

        $data['banners'] = $this->Banners_model->banners_header();
        echo $this->templates->render('admin/admin_banners_header', $data);
    }
    public function editar_banner_header()
    {
        //id banner
        $data['id_banner'] = $this->uri->segment(3);
        $data['banner_data'] = $this->Banners_model->banner_header_data($data['id_banner']);
        echo $this->templates->render('admin/admin_editar_banner_header', $data);
    }
    public function actualizar_banner_header()
    {
        /* echo '<pre>';
         print_r($_POST);
         echo '</pre>';
         exit();*/
        $post_data = array(
            'id' => $this->input->post('id'),
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
            'imagen' => $this->input->post('imagen'),
            'area' => $this->input->post('area'),
            'vencimiento' => $this->input->post('vencimiento'),
            'estado' => $this->input->post('estado'),
        );
        //print_r($post_data);

        $this->Banners_model->actualizar_banners_header($post_data);
        redirect(base_url() . 'admin/banners_header/');
    }
    public function actualizar_banner()
    {
        $post_data = array(
            'id' => $this->input->post('id'),
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
            'imagen' => $this->input->post('imagen'),
            'area' => $this->input->post('area'),
            'vencimiento' => $this->input->post('vencimiento'),
            'estado' => $this->input->post('estado'),
        );
        //print_r($post_data);

        $this->Banners_model->actualizar_banners($post_data);
        redirect(base_url() . 'admin/banners/');
    }


    //productos de portada
    public function productos_portada()
    {
        $data['productos_portada'] = $this->Productos_model->get_productos_portada();
        $data['productos_no_portada'] = $this->Productos_model->get_productos_no_portada();

        echo $this->templates->render('admin/productos_portada', $data);
    }
    public function asignar_portada()
    {
        $codigo_producto = $this->uri->segment(3);
        $this->Productos_model->asignar_producto_portada($codigo_producto);
        redirect(base_url() . 'index.php/admin/productos_portada');
    }
    public function quitar_portada()
    {
        $codigo_producto = $this->uri->segment(3);
        $this->Productos_model->quitar_producto_portada($codigo_producto);
        redirect(base_url() . 'index.php/admin/productos_portada');
    }
    public function iconos_lineas()
    {
        $data['lineas_productos'] = $this->Productos_model->get_lineas();

        echo $this->templates->render('admin/iconos_lineas', $data);
    }
    public function asignar_icono_linea()
    {
        $linea = $this->uri->segment(3);
        $data['linea'] = $linea;
        echo $this->templates->render('admin/asignar_icono_linea', $data);
    }
    public function guardar_icono_linea()
    {
        // print_contenido($_POST);

        $titulo = $this->input->post('linea');

        $nombre_imagen = str_replace(' ', '_', $titulo);

        $config['upload_path'] = './upload/iconos/lineas';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $nombre_imagen;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            $error = array('error' => $this->upload->display_errors());
            print_contenido($error);
            //$this->load->view('upload_form', $error);
        } else {
            $post_data = array(
                'linea' => $titulo,
                'imagen' => $nombre_imagen,
            );


            //print_r($post_data);

            $this->Productos_model->asignar_icono_linea($post_data);
            redirect(base_url() . 'index.php/admin/iconos_lineas');
        }


    }
    public function borrar_icono_linea()
    {
        $linea = $this->uri->segment(3);

        $datos_imagen = $this->Productos_model->linea_tiene_icono($linea);
        if ($datos_imagen) {
            $datos_imagen = $datos_imagen->row();
            $nombre_imagen = $datos_imagen->imagen;

            //borrado de registro
            $this->Productos_model->borrar_icono_linea($linea);

            //borrado de imagen
            //echo '/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen.'.png';
            if (file_exists('/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen . '.png')) {
                // echo 'imagen existe';
                if (unlink('/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen . '.png')) {
                    $this->session->set_flashdata('mensaje', 'se borro el icono');
                    redirect(base_url() . 'index.php/admin/iconos_lineas');
                } else {
                    echo 'no se borro';
                }

            } else {

                echo 'la imagen no existe';
            }


        } else {
            $this->session->set_flashdata('mensaje', 'imagen no existe');
            redirect(base_url() . 'index.php/admin/iconos_lineas');

        }
    }
    public function actualizar_icono_linea()
    {

    }

    //empresas plantillas
    public function empresas_planilla(){
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        $data['eplanilla'] = $this->Admin_model->get_empresas_planilla();
        echo $this->templates->render('admin/admin_empresas_planilla', $data);
    }
    public function nueva_empresa_planilla(){
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion', $user_id)) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data = array();
        $data['eplanilla'] = $this->Admin_model->get_empresas_planilla();
        echo $this->templates->render('admin/admin_crear_empresa_planilla', $data);
    }
    public function guardar_planilla(){
        //print_contenido($_POST);
        //print_contenido($_FILES);

        $nombre_archivo =  str_replace(' ', '_', $this->input->post('nombre_empresa'));
        $config['upload_path']          = './upload/empresas';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']        = $nombre_archivo;
        $config['overwrite']        = true;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('logo_empresa'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_contenido($error);
           // $this->load->view('upload_form', $error);
        }
        else
        {
            $nombre_archivo = $nombre_archivo.$this->upload->data('file_ext');
            $empresa_planilla =array(
                'ep_nombre'=>$this->input->post('nombre_empresa'),
                'ep_descripcion'=>$this->input->post('nombre_empresa'),
                'ep_logo'=>$nombre_archivo,
            );

            $this->Admin_model->guardar_empresa_planilla($empresa_planilla);



        }
        redirect('Admin/empresas_planilla');
    }


}