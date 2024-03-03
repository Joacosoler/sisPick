<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel Adminstrativo</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url; ?>Administracion/home">Pick Some Food</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiarPass">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools fa-2x mr-2"></i></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down mr-2"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user mr-2 "></i> Usuarios</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Administracion/home"><i class="fas fa-user mr-2"></i> Administracion</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Configuracion"><i class="fas fa-user mr-2 "></i> Configuracion</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaja" aria-expanded="false" aria-controls="collapseCaja">
                            <div class="sb-nav-link-icon"><i class="fas fa-box fa-2x mr-2"></i></div>
                            Cajas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down mr-2"></i></div>
                        </a>
                        <div class="collapse" id="collapseCaja" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fas fa-user mr-2"></i> Cajas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Cajas/arqueo"><i class="fas fa-user mr-2 "></i> Arqueo Caja</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x mr-2"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Proveedores">
                            <div class="sb-nav-link-icon"><i class="fa fa-shipping-fast fa-2x mr-2"></i></div>
                            Proveedores
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Medidas">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left fa-2x mr-2"></i></div>
                            Medidas
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                            <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x mr-2"></i></div>
                            Categorias
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Productos">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt fa-2x mr-2"></i></div>
                            Productos
                        </a>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart  fa-2x mr-2"></i></div>
                            Entradas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down mr-2"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/Precios"><i class="fas fa-shopping-cart mr-2"></i> Precios</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fas fa-shopping-cart mr-2"></i> Nueva Orden</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/historial"><i class="fas fa-list mr-2"></i> Historial Compras</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVenta" aria-expanded="false" aria-controls="collapseVenta">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart  fa-2x mr-2"></i></div>
                            Salidas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down mr-2"></i></div>
                        </a>
                        <div class="collapse" id="collapseVenta" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/ventas"><i class="fas fa-shopping-cart mr-2"></i> Ventas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/historial_ventas"><i class="fas fa-list mr-2"></i> Historial Ventas</a>
                            </nav>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">