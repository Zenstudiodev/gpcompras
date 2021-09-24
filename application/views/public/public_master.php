<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 3:36 PM
 */


$CI =& get_instance();

if ($CI->ion_auth->logged_in()) {
    //echo'logeado';
    $user_id = $CI->ion_auth->get_user_id();
    $user_data = $CI->User_model->get_user_by_id($user_id);
    $user_data = $user_data->row();
} else {
    // echo'no logeado';
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,600;0,800;1,100&family=Roboto:wght@100;300;400;500;700&display=swap"
          rel="stylesheet">
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/fd7d02f666.js" crossorigin="anonymous"></script>
    <?php echo $this->section('css_p') ?>
    <link href="<?php echo base_url() ?>/ui/public/css/style.css" rel="stylesheet">
    <title>GP COMPRAS</title>
</head>
<body>
<section id="header">

    <div id="top_info">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-4">
                    <a href="tel:+50222945656"> <i aria-hidden="true" class="fas fa-mobile-alt"></i> PBX: (502)
                        2294-5656</a>&nbsp;
                </div>
                <div class="col-12 col-md-3">
                    <a href="mailto:info@gpautos.ne"> <i aria-hidden="true" class="fas fa-envelope"></i>
                        info@gpautos.net</a>
                </div>
                <div class="col-12 col-md-4">
                    <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                    2da Avenida 20-29 Zona 10.
                </div>
                <div class="col-12 col-md-1">
                    <div class="elementor-social-icons-wrapper">
                        <a href="https://www.facebook.com/gpcomprasnet-234506886601172"
                           class="elementor-icon elementor-social-icon elementor-social-icon-facebook-f elementor-repeater-item-d733b61"
                           target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                           class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-repeater-item-9dc26c9"
                           target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main_menu_container" class="inner_menu_container">
        <div class="container">
            <div class="row">
                <div class="col-7 col-md-12">
                    <nav class="navbar navbar-expand-lg ">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png">
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#main_menu" aria-controls="main_menu"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars" aria-hidden="true"></i> Menú
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="main_menu">
                            <ul class="navbar-nav ">
                                <li class="nav-item ">
                                    <a class="nav-link " href="/">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="<?php echo base_url() ?>productos/categoria/">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/#servicioos_container">Nosotros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="openNav()">Categorías</a>
                                </li>
                                <li class="nav-item">
                                    <div id="iconos_menu">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <?php
                                        if ($CI->ion_auth->logged_in()) { ?>
                                            <a href="<?php echo base_url() ?>User/perfil">
                                                <i class="fas fa-user"></i>
                                                Perfil
                                            </a>
                                            <a href="<?php echo base_url() ?>Auth/logout">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Cerrar
                                            </a>

                                            <?php
                                            if ($CI->ion_auth->is_admin()) { ?>
                                                <a href="<?php echo base_url() ?>Admin">
                                                    <i class="fas fa-user"></i>
                                                    Admin panel
                                                </a>
                                            <?php } ?>


                                        <?php } else { ?>
                                            <!--<a href="<?php /*echo base_url() */?>User/registro">
                                                <i class="fas fa-user"></i>
                                                Registrarse
                                            </a>-->
                                            <a href="<?php echo base_url() ?>user/login">
                                                <i class="fas fa-user"></i>
                                                iniciar session
                                            </a>
                                        <?php } ?>


                                        <a href="<?php echo base_url() ?>carrito/ver">
                                            <i class="fas fa-shopping-cart"></i>
                                            carrito
                                        </a>
                                    </div>

                                </li>

                            </ul>
                        </div>
                    </nav>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <form name="buscar_form" action="<?php echo base_url(); ?>productos/buscar_producto"
                                  method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Buscar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input class="form-control" type="text" name="buscar_input" id="buscar_input">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Content Wrapper. Contains page content -->
    <?php echo $this->section('banner') ?>
    <!-- /.content-wrapper -->


</section>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="accordion" id="categoriasMenu">
        <?php
        $categorias = get_categorias_sub_categorias();
        foreach ($categorias

                 as $categoria) { ?>
            <?php if ($categoria->parent_id == '0') { ?>
                <div class="card">
                    <div class="card-header" id="heading_<?php echo $categoria->nombre_categoria; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse"
                                    data-target="#collapse_<?php echo preg_replace('/\s+/', '_', $categoria->nombre_categoria); ?>"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo $categoria->nombre_categoria; ?>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse_<?php echo preg_replace('/\s+/', '_', $categoria->nombre_categoria); ?>"
                         class="collapse" aria-labelledby="heading_<?php echo $categoria->nombre_categoria; ?>"
                         data-parent="#categoriasMenu">
                        <div class="card-body">
                            <?php $subcategorias = obtener_subcategorias($categoria->categoria_id); ?>
                            <?php if ($subcategorias) { ?>
                                <div class="accordion"
                                     id="Sub_<?php echo preg_replace('/\s+/', '_', $categoria->nombre_categoria); ?>">
                                    <?php foreach ($subcategorias as $subcategoria) { ?>
                                        <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                        <?php if ($subcategorias) { ?>
                                            <div class="card">
                                                <div class="card-header"
                                                     id="heading_<?php echo preg_replace('/\s+/', '_', $subcategoria->nombre_categoria); ?>">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed"
                                                                type="button"
                                                                data-toggle="collapse"
                                                                data-target="#collapse_<?php echo preg_replace('/\s+/', '_', $subcategoria->nombre_categoria); ?>"
                                                                aria-expanded="false"
                                                                aria-controls="collapse_<?php echo preg_replace('/\s+/', '_', $subcategoria->nombre_categoria); ?>">
                                                            <?php echo $subcategoria->nombre_categoria; ?>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapse_<?php echo preg_replace('/\s+/', '_', $subcategoria->nombre_categoria); ?>"
                                                     class="collapse"
                                                     aria-labelledby="heading_<?php echo preg_replace('/\s+/', '_', $subcategoria->nombre_categoria); ?>"
                                                     data-parent="#Sub_<?php echo preg_replace('/\s+/', '_', $categoria->nombre_categoria); ?>">
                                                    <div class="card-body">

                                                        <?php //print_contenido($subcategorias); ?>

                                                        <ul class="list-group">
                                                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                                                <li class="list-group-item">
                                                                    <a href="<?php echo base_url().'productos/categoria/'.$subcategoria->categoria_id;?>">
                                                                    <?php echo $subcategoria->nombre_categoria; ?>
                                                                    </a>

                                                                    <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                                    <?php if ($subcategorias) { ?>
                                                                        <ul class="list-group">
                                                                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                                                                <li class="list-group-item">
                                                                                    <a href="<?php echo base_url().'productos/categoria/'.$subcategoria->categoria_id;?>">
                                                                                    <?php echo $subcategoria->nombre_categoria; ?>
                                                                                    </a>
                                                                                    <?php $subcategorias = obtener_subcategorias($subcategoria->categoria_id); ?>
                                                                                    <?php print_contenido($subcategorias); ?>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    <?php } else { ?>

                                                                    <?php } ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>


                                        <?php } else { ?>
                                            <li class="list-group-item">
                                                <a href="<?php echo base_url().'productos/categoria/'.$subcategoria->categoria_id;?>">
                                                    <?php echo $subcategoria->nombre_categoria; ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                    <?php } ?>

                                </div>
                            <?php } else { // sin sib categorias ?>
                                <li class="list-group-item">
                                    <a href="<?php echo base_url().'productos/categoria/'.$categoria->categoria_id;?>">
                                        <?php echo $categoria->nombre_categoria; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>

    </div>


</div>

<section id="main_body">

    <!-- Content Wrapper. Contains page content -->
    <?php echo $this->section('page_content') ?>
    <!-- /.content-wrapper -->
</section>
<footer>
    <div id="footer_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="first" class="first-widget footer-widget">
                        <aside id="followmewidget-3" class="widget widgets-follow-us">
                            <div class="title-outer"><h3 class="widget-title">Redes y forma de pago</h3></div>
                            <div id="follow_us" class="follow-us">
                                <ul class="toggle-block">
                                    <li>
                                        <a href="https://www.facebook.com/gpcomprasnet-234506886601172" title="Facebook"
                                           class="facebook icon" target="_blank"><i
                                                    class="fa fa-facebook"></i></a>
                                        <a href="https://wa.me/50251677220" title="Whatsapp" class="whatsapp icon"
                                           target="_blank"><i
                                                    class="fa fa-whatsapp"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col">
                    <div id="second" class="second-widget footer-widget">
                        <aside id="footercontactuswidget-2" class="widget widgets-footercontact">
                            <div class="title-outer"><h3 class="widget-title">información de contacto</h3></div>
                            <ul class="toggle-block">
                                <li>
                                    <div class="contact_wrapper">
                                        <div class="address">
                                            <div class="address_content">
                                                <div class="contact_address">2da Avenida 20-29 Zona 10.
                                                </div>

                                            </div>
                                        </div>
                                        <div class="phone">
                                            <div class="contact_phone"> (+502) 2294-5656</div>

                                        </div>
                                        <div class="email">
                                            <div class="contact_email"><a href="mailto:info@gpcasas.net">
                                                    info@gpcasas.net</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col">
                    <div id="third" class="third-widget footer-widget">
                        <aside id="staticlinkswidget-3" class="widget widgets-static-links">
                            <div class="title-outer"><h3 class="widget-title">Enlaces de cuenta</h3></div>
                            <ul class="toggle-block">
                                <li>
                                    <div class="static-links-list">
						<span><a href="#">
				Mi cuenta</a></span>

                                        <span><a href="#">
				Mis ordenes</a></span>

                                        <span><a href="#">
				Devoluciones</a></span>

                                        <span><a href="#">
				Politicas de uso</a></span>
                                    </div>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col">
                    <div id="fourth" class="fourth-widget footer-widget">
                        <aside id="newsletterwidget-2" class="widget widget_newsletterwidget">
                            <div class="title-outer"><h3 class="widget-title">Boletín</h3></div>
                            <div class="tnp tnp-widget toggle-block">
                                <form method="post" action=""
                                      onsubmit="return newsletter_check(this)">

                                    <input type="hidden" name="nlang" value="">
                                    <input type="hidden" name="nr" value="widget">
                                    <input type="hidden" name="nl[]" value="0">
                                    <div class="input-group mb-3">
                                        <input class="tnp-email form-control"
                                               type="email"
                                               name="ne"
                                               required="">
                                        <div class="input-group-append">
                                            <input class="tnp-submit btn btn-success"
                                                   type="submit"
                                                   value="Subscribe">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer_links">
        <div class="footer-bottom-container">
            <div class="footer-bottom-left">

                <div class="footer-menu-links">
                    <ul id="menu-mainmenu-2" class="footer-menu">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-212 current_page_item menu-item-7179">
                            <a href="#"
                               aria-current="page">Inicio</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-8502">
                            <a href=#>Productos</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-7189">
                            <a href="#">Nosotros</a></li>
                    </ul>
                </div><!-- #footer-menu-links -->

                <div class="site-info"> 2020 GP COMPRAS</div>
            </div>
        </div>

    </div>
</footer>
<script src="//code.jivosite.com/widget/ML8Ewd7IHI" async></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main_body").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main_body").style.marginLeft = "0";
    }
</script>
<?php echo $this->section('js_p') ?>
</body>
<!--<img src="<?php /*echo base_url(); */ ?>ui/imagenes/dise%f1o1.jpg">-->




