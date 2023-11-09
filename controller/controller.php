<?php
session_start();// Comienzo de la sesión
require_once 'model/usuario.php';
require_once 'model/reservar.php';
require_once 'model/computadoras.php';
require_once 'model/reporte.php';
require_once 'model/laboratorio.php';

class Controller
{
    private $model;
    private $reserva;
    private $reporte;
    private $pc;
    private $resp;
    private $msg;

   
    public function __CONSTRUCT(){
        $this->model = new Usuario();
        $this->reserva = new Reservar();
        $this->reporte = new Reporte();
        $this->pc = new Computadoras();
        $this->laboratorio = new Laboratorio();
    }

    public function Index(){
        require("view/login.php");
    }

    public function CrearUsuario(){
        require("view/register.php");
    }

    public function IngresarPanel(){
        $totalReservas = $this->reporte->obtenerTotalReservas(); 
        $totalEquipos = $this->pc->obtenerTotalEquiposDisponibles(); 
        require("view/panel/dashboard.php");
        
    }

    public function IngresarEquipos(){
        $datos = $this->pc->mostrarComputadoras();
        $nombreLab = $this->laboratorio->mostrarLaboratorios();
        require("view/panel/lista-equipos.php"); 
        
    }
    

    public function IngresarReserva() {
        $equiposDisponibles = $this->pc->ObtenerEquiposDisponibles();
        require("view/panel/form-reservar.php");
    }

    public function IngresarVerReportes(){
        $result = $this->reporte->ObtenerReporteReservas();
        $totalReservas = $this->reporte->obtenerTotalReservas(); 
        require("view/panel/reporte-reservas.php"); 
    }

    public function IngresarVerMisReservas()
    {
        $usuarioID = $_SESSION['UsuarioID'];
        $misReservas = $this->reserva->ObtenerMisReservas($usuarioID);

        require("view/panel/mis-reservas.php");
    }

    public function IngresarPerfil(){
        if(isset($_SESSION['UsuarioID'])) {
            $usuario = $this->model->Obtener($_SESSION['UsuarioID']);
            require("view/panel/profile.php");
        } else {
            header('Location: ?op=error');
        }
    }

    public function Guardar(){
        $usuario = new Usuario();
    
        $usuario->Nombre = $_POST['nombre'];
        $usuario->Apellido = $_POST['apellido'];
        $usuario->CorreoElectronico = $_POST['correo'];
        $usuario->Contrasena = md5($_REQUEST['contrasena']);
    
        $this->resp = $this->model->Registrar($usuario);
    
        header('Location: ?op=crear&msg=' . $this->resp);
    }


    public function Ingresar(){
        $ingresarUsuario = new Usuario();
        
        $ingresarUsuario->CorreoElectronico = $_REQUEST['correo'];  
        $ingresarUsuario->Contrasena = md5($_REQUEST['contrasena']);    

        //Verificamos si existe en la base de datos
        if ($resultado= $this->model->Consultar($ingresarUsuario))
        {
            $_SESSION["acceso"] = true;
            $_SESSION["UsuarioID"] = $resultado->UsuarioID;
            $_SESSION["nivel"] = $resultado->TipoUsuario;
            $_SESSION["user"] = $resultado->Nombre." ".$resultado->Apellido;
            header('Location: ?op=permitido');

        }
        else
        {
            header('Location: ?&msg=Su contraseña o usuario está incorrecto');
        }
    }

    public function RealizarReservaForm()
    {

        $pc = new Computadoras(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $equipo = $_POST['equipo'];
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $descripcion = $_POST['descripcion'];
            $usuarioID = $_SESSION['UsuarioID']; 

            
            $resultado = $this->reserva->RealizarReserva($equipo, $desde, $hasta, $descripcion, $usuarioID);

            if ($resultado === "Reserva exitosa.") {
                $_SESSION['resultado_reserva'] = $resultado;
            }
        }
        
        // obtiene nuevamente la lista de equipos disponibles
        $equiposDisponibles = $this->pc->ObtenerEquiposDisponibles();

        require 'view/panel/form-reservar.php';
    }


    public function guardarComputadora(){
        $pc = new Computadoras();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombrePC'];
            $lab_No = $_POST['nameLab'];
            $resultado = $this->pc->agregarComputadora($nombre, $lab_No);
            header("Location: index.php?op=equipos");
            exit();
        }
    }
    public function editarComputadora(){

    }

    

    public function eliminarComputadora(){
        if (isset($_GET['pcID'])) {
            $pcID = $_GET['pcID'];
            $pc = new Computadoras();
            $resultado = $pc->eliminarComputadora($pcID);

            if ($resultado) {
                // Éxito al eliminar
                header("Location: index.php?op=equipos&success=1");
                exit();
            } else {
                // Error al eliminar
                header("Location: index.php?op=equipos&error=1");
                exit();
            }
        } else {
            // Redireccionar o mostrar un mensaje de error
            echo "ID de computadora no proporcionado";
        }
    }

    public function eliminarReserva() {
        if (isset($_GET['id_reserva'])) {
            $reservaID = $_GET['id_reserva'];
    
            $resultado = $this->reserva->eliminarReserva($reservaID);
    
            if ($resultado) {
                header("Location: index.php?op=misreservas");
                exit();
            } else {
                echo "Error al eliminar la reserva.";
            }
        }
    }
    
   

}
   ?>