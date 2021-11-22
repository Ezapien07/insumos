<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/material-pro/minisidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Feb 2019 11:12:05 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>Patelería "La Luz"</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this page -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- chartist CSS -->
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="{{asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">

    <!-- Link para selector-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon 
                            <img src="{{asset('assets/images/logo-icon_2.png')}}" alt="homepage" class="dark-logo" />
                            Light Logo icon
                            <img src="{{asset('assets/images/logo-icon_2.png')}}" alt="homepage" class="light-logo" />-->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text 
                            <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />-->
                            <!-- Light Logo text 
                            <img src="{{asset('assets/images/logo-text.png')}}" class="light-logo" alt="homepage" />-->
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>-->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify" id="puntito">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul id="notificaciones">
                                    <li>
                                        <div class='drop-title'>
                                            <h4 class="card-title">Materia prima con stock bajo</h4>
                                            <span class='mail-desc text-center'>No hay notificaciones</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class='drop-title'>
                                            <h4 class="card-title">Productos con stock bajo</h4>
                                            <span class='mail-desc text-center'>No hay notificaciones</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-text">
                                                <h4>Yisus</h4>
                                                <p class="text-muted"> <a href="https://www.wrappixel.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e4928596918aa48389858d88ca878b89">
                                                        [email&#160;protected]</a>
                                                    <a href="#">YUisus</a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> Mí Perfil</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-power-off"></i> Salir</a></li>
                                </ul>
                            </div>
                        </li>
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
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!--<li class="nav-small-cap">PERSONAL</li>-->
                        <li> <a class="has-arrow waves-effect" href="#" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Venta</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/ventas')}}">Ventas activas</a></li>
                                <li><a href="{{URL::to('/ventas_inactivas')}}">Ventas canceladas</a></li>
                                <li class="nav-devider"></li>
                                <li><a href="{{URL::to('/pastelesVendidos')}}">Pasteles más vendidos</a></li>
                                <li><a href="{{URL::to('/reporte_ventas_dia')}}">Reporte de ventas por día</a></li>
                                <li><a href="{{URL::to('/reporte_venta_mensual')}}">Reporte de ventas por mes</a></li>
                                <li><a href="{{URL::to('/reporte_venta_rangoF')}}">Reporte de ventas por un rango de fecha</a></li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-calendar-multiple"></i><span class="hide-menu">Pedido
                                    especial</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/pedidoEspecial')}}">Pedidos activos</a></li>
                                <li><a href="{{URL::to('/pedidoEspecialFinalizado')}}">Pedidos finalizados</a></li>
                                <li><a href="{{URL::to('/pedidoEspecialCancelado')}}">Pedidos cancelados</a></li>
                                <li><a href="{{URL::to('/pedidoEspecialEntregado')}}">Pedidos entregados</a></li>
                                <li class="nav-devider"></li>
                                <li><a href="{{URL::to('/reporte_pedido_semanal')}}">Reporte de pedidos</a></li>
                                <li><a href="{{URL::to('/reporte_pedido_mensual')}}">Reporte de pedidos Mensuales</a></li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Cliente</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/cliente')}}">Clientes activos</a></li>
                                <li><a href="{{URL::to('/cliente_inactivos')}}">Clientes inactivos</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cake-variant"></i><span class="hide-menu">Producto</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/insumos')}}">Productos activos</a></li>
                                <li><a href="{{URL::to('/producto_inactivo')}}">Productos inactivos</a></li>
                                <li class="nav-devider"></li>
                                <li><a href="{{URL::to('/reporte_inventario')}}">Reporte de inventario actual</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Categoría</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/categoria')}}">Categorías activas</a></li>
                                <li><a href="{{URL::to('/categoria_inactivas')}}">Categorías inactivas</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">Orden de
                                    compra</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/ordenCompra')}}">Ordenes de compra activas</a></li>
                                <li><a href="{{URL::to('/ordenCompraCompletada')}}">Ordenes de compra entregadas</a></li>
                                <li class="nav-devider"></li>
                                <li><a href="{{URL::to('/reporte_ordenCompra_men')}}">Reporte Orden de Compra mensual</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cake-layered"></i><span class="hide-menu">Materia prima</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/materiaPrima')}}">Materia prima activa</a></li>
                                <li><a href="{{URL::to('/materiaPrima_inactiva')}}">Materia prima inactiva</a></li>
                                <li class="nav-devider"></li>
                                <li><a href="{{URL::to('/reporte_inventario_materiaP')}}">Reporte de materia prima</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-domain"></i><span class="hide-menu">Proveedor</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/proveedor')}}">Provedores activos</a></li>
                                <li><a href="{{URL::to('/proveedor_inactivo')}}">Proveedores inactivos</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Empleado</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/empleado')}}">Empleados activos</a></li>
                                <li><a href="{{URL::to('/empleados_inactivos')}}">Empleados inactivos</a></li>
                                <li><a href="{{URL::to('/restablecerPass')}}">Restablecer contraseña</a></li>
                            </ul>
                        </li>
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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">

                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('contenido')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2021 Patelería "La Luz"
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
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>

    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/sweetalert-dev.js')}}"></script>
    <!-- ============================================================== -->
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-notify/notifications.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
    <!-- chartist chart -->
    <!-- <script src="{{asset('assets/plugins/chartist-js/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script> -->
    <!--c3 JavaScript -->
    <script src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('assets/plugins/c3-master/c3.min.js')}}"></script>
    <!-- Chart JS -->
    <!--<script src="{{asset('js/dashboard1.js')}}"></script>-->
    <!-- ============================================================== -->
    <!-- This is data table -->
    <script src="{{asset('assets/plugins/datatables/dataTables.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <!-- ============================================================== -->
    <script>
        $('#tbEjemplo').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('#tbCategoria').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('#tbCategoriaInactiva').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <!-- Archivos js de la aplicación 
    
    <script src="{{asset('js_aplicacion/categoria.js')}}"></script>
    <script src="{{asset('js_aplicacion/materiaPrima.js')}}"></script>
    <script src="{{asset('js_aplicacion/cliente.js')}}"></script>
    <script src="{{asset('js_aplicacion/empleado.js')}}"></script>
    <script src="{{asset('js_aplicacion/producto.js')}}"></script>
    <script src="{{asset('js_aplicacion/materiaPrima.js')}}"></script>
    <script src="{{asset('js_aplicacion/ventas.js')}}"></script>
    <script src="{{asset('js_aplicacion/ordenCompra.js')}}"></script>
    <script src="{{asset('js_aplicacion/pedidoEspecial.js')}}"></script>
    <script src="{{asset('js_aplicacion/proveedor.js')}}"></script>-->
    <script src="{{asset('js_aplicacion/general.js')}}"></script>
    <script src="{{asset('js_aplicacion/insumos.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.js"></script>

</body>

<!-- Mirrored from www.wrappixel.com/demos/admin-templates/material-pro/minisidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Feb 2019 11:12:10 GMT -->

</html>