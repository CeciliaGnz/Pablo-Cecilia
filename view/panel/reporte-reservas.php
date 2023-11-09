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
        <title>Reporte de reservas</title>
        <link href="./public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./public/css/style.css" rel="stylesheet" />
        <link rel="shortcut icon" href="public/images/utp-logo.png" type="image/x-icon">
        <!-- Scrip de iconos local-->
        <script src="./public/js/all.js" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4">Reporte de reservas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Información de todas las reservas</li>
                        </ol>
                       
                        <div class="container mt-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i> Reservas registradas
                            </div>
                            <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID (Reserva)</th>
                                        <th>Nombre del Equipo</th>
                                        <th>No. Laboratorio</th>
                                        <th>Reservado Por</th>
                                        <th>Fecha de Reserva</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!is_string($result) && count($result) > 0) {
                                        foreach ($result as $row) {
                                            echo "<tr>";
                                            echo "<td class='text-center small'>" . $row["id_reserva"] . "</td>";
                                            echo "<td class='text-center small'>" . $row["nombre_equipo"] . "</td>";
                                            echo "<td class='text-center small'>" . $row["no_laboratorio"] . "</td>";
                                            echo "<td class='text-center small'>" . $row["reservado_por"] . "</td>";
                                            echo "<td class='justify-content-center small'>" . " Fecha: ". $row["fecha_reserva"] . "<br>Hora Inicial: " . $row["hora_inicial"] . "<br> Hora Final: " . $row["hora_final"] . "</td>";
                                            echo "<td class='justify-content-center small'>" . $row["descripcion"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No se encontraron reservas.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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