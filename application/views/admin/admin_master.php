<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 3:36 PM
 */
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" sizes="16x16" href="<?php echo base_url() ?>/ui/imagenes/favicon.ico">
    <title>GP COMPRAS</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!--<link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    -->
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>dist/css/admin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/extra-libs/prism/prism.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <?php echo $this->section('css_p') ?>




    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md">
            <div class="navbar-header" data-logobg="skin6">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-brand">
                    <!-- Logo icon -->
                    <a href="<?php echo base_url() ?>admin">
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png" alt="homepage" class="GP COMPRAS"/>
                        </b>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                   data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                    <!-- Notification -->

                    <!-- End Notification -->
                    <!-- ============================================================== -->
                    <!-- create new -->
                    <!-- ============================================================== -->

                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="javascript:void(0)">
                            <form>
                                <div class="customize-input">
                                    <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                           type="search" placeholder="Busqueda" aria-label="Search">
                                    <i class="form-control-icon" data-feather="search"></i>
                                </div>
                            </form>
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url()?>/assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle"
                                 width="40">
                            <span class="ml-2 d-none d-lg-inline-block"><span>Hola,</span> <span
                                        class="text-dark">Carlos</span> <i data-feather="chevron-down"
                                                                              class="svg-icon"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user"
                                                                                  class="svg-icon mr-2 ml-1"></i>
                                My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="credit-card"
                                                                                  class="svg-icon mr-2 ml-1"></i>
                                My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail"
                                                                                  class="svg-icon mr-2 ml-1"></i>
                                Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings"
                                                                                  class="svg-icon mr-2 ml-1"></i>
                                Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                                                                  class="svg-icon mr-2 ml-1"></i>
                                Logout</a>
                            <div class="dropdown-divider"></div>
                            <div class="pl-4 p-3"><a href="javascript:void(0)" class="btn btn-sm btn-info">View
                                    Profile</a></div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>admin" aria-expanded="false">
                            <i data-feather="home"  class="feather-icon"></i>
                            <span lass="hide-menu">Inicio</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>Admin/empresas_planilla" aria-expanded="false">
                            <i data-feather="shopping-bag"  class="feather-icon"></i>
                            <span class="hide-menu">Empresas planilla</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>admin/categorias" aria-expanded="false">
                            <i data-feather="shopping-bag"  class="feather-icon"></i>
                            <span class="hide-menu">Categoría y sub categorías</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>admin/listado_productos" aria-expanded="false">
                            <i data-feather="shopping-bag"  class="feather-icon"></i>
                            <span class="hide-menu">Productos</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>admin/listado_pedidos" aria-expanded="false">
                            <i data-feather="edit"  class="feather-icon"></i>
                            <span class="hide-menu">Pedidos</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="<?php echo base_url() ?>admin/banners_header" aria-expanded="false">
                            <i data-feather="shopping-bag"  class="feather-icon"></i>
                            <span class="hide-menu">Banners</span>
                        </a>
                    </li>

                    <!--<li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>


                    <li class="list-divider"></li>


                    <li class="list-divider"></li>
                    -->

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">

                </div>
                <div class="col-5 align-self-center">

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->


        <div class="container-fluid">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <!-- Content Wrapper. Contains page content -->
            <?php echo $this->section('page_content') ?>
            <!-- /.content-wrapper -->
            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Sales Charts Section -->
            <!-- *************************************************************** -->

            <!-- *************************************************************** -->
            <!-- End Sales Charts Section -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Location and Earnings Charts Section -->
            <!-- *************************************************************** -->

            <!-- *************************************************************** -->
            <!-- End Location and Earnings Charts Section -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Top Leader Table -->
            <!-- *************************************************************** -->

            <!-- *************************************************************** -->
            <!-- End Top Leader Table -->
            <!-- *************************************************************** -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            gpcompras.net
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
<script src="<?php echo base_url() ?>dist/js/feather.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript-->
<script src="<?php echo base_url() ?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?php echo base_url() ?>assets/extra-libs/c3/d3.min.js"></script>
<script src="<?php echo base_url() ?>assets/extra-libs/c3/c3.min.js"></script>
<!--<script src="<?php echo base_url() ?>assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
-->
<script src="<?php echo base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<!--<script src="<?php echo base_url() ?>dist/js/pages/dashboards/dashboard1.min.js"></script>-->
<?php echo $this->section('js_p') ?>

</body>

</html>





