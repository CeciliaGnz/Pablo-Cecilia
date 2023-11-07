<?php

if ($_SESSION["acceso"] != true)
{
    header('Location: ?op=error');
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="../../public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../public/css/style.css" rel="stylesheet" />
        <!-- Scrip de iconos local-->
        <script src="../../public/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="?op=permitido">Equipos - UTP</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar profile user icon-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><span class="text-white font-medium"><?php echo $_SESSION["user"] ?></span></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?op=perfil">Mi perfil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="?op=salir">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menú</div>
                            <a class="nav-link" href="?op=permitido">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="?op=equipos">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                                Lista de equipos
                            </a>

                            <a class="nav-link" href="?op=reservar">
                                <div class="sb-nav-link-icon"><i class="fas fa-desktop-alt"></i></div>
                                Reservar equipo
                            </a>

                            <a class="nav-link" href="?op=reporte">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks-alt"></i></div>
                                Reporte de reservas
                            </a>

                            <a class="nav-link" href="?op=misreservas">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                                Mis reservas
                            </a>

                            
                            <div class="sb-sidenav-menu-heading">Otros</div>
                            <a class="nav-link" href="?op=perfil">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                Perfil
                            </a>
                            <a class="nav-link" href="?op=salir">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Cerrar sesión
                            </a>
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Bienvenido al sistema de reserva de equipos UTP</li>
                        </ol>

                        <div class="row">
                            <!-- Primer rectángulo -->
                            <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="row no-gutters">
                                    <div class="col-md-3 mx-auto text-center">
                                    <div class="image-container w-75 mx-auto">
                                        <img src="../../public/images/pc.png" class="img-fluid d-block mt-3 mb-3">
                                    </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">00</h5>
                                            <h6 class="card-subtitle mb-2 text-light">Total de equipos</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <!-- Segundo rectángulo -->
                            <div class="col-md-6">
                                <div class="card bg-success text-white">
                                    <div class="row no-gutters">
                                        <div class="col-md-3 mx-auto text-center">
                                            <div class="image-container w-75 mx-auto">
                                            <img src="../../public/images/reserva.png" class="img-fluid d-block mt-3 mb-3" >
                                        </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">00</h5>
                                                <h6 class="card-subtitle mb-2 text-light">Total de reservas</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Integrantes: Pablo Delgado 8-992-2046, Cecilia González 8-990-1469. ILS132</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../../public/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../public/js/script.js"></script>
        <script src="../../public/js/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../../public/js/datatables-simple-demo.js"></script>
    </body>
</html>