<?php
session_start();// Comienzo de la sesión
require_once 'model/usuario.php';
require_once 'model/reservar.php';
require_once 'model/reporte.php';

class Controller
{
    private $model;
    private $model4;
    private $resp;

    public function __CONSTRUCT(){
        $this->model = new Usuario();
        $this->modelreservar = new Reservar();
        $this->modelreporte = new Reporte();
    }

    public function Index(){
        require("view/login.php");
    }

    public function CrearUsuario(){
        require("view/register.php");
    }

    public function IngresarPanel(){
        $totalReservas = $this->modelreporte->obtenerTotalReservas(); //this
        require("view/panel/dashboard.php");
        
    }

    public function IngresarEquipos(){
        require("view/panel/lista-equipos.php"); 
    }

    public function IngresarReserva() {
        $equiposDisponibles = $this->ObtenerEquiposDisponibles();//se cambio a obtener equipos a computadora.php verificar si funciona
        require("view/panel/form-reservar.php");
    }

    public function IngresarVerReportes(){
        
        $result = $this->modelreporte->ObtenerReporteReservas();
        require("view/panel/reporte-reservas.php"); 
    }

    public function IngresarVerMisReservas(){
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $equipo = $_POST['equipo'];
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $descripcion = $_POST['descripcion'];
            $usuarioID = $_SESSION['UsuarioID']; 

            $resultado = $this->modelreservar->RealizarReserva($equipo, $desde, $hasta, $descripcion, $usuarioID);

            if ($resultado === "Reserva exitosa.") {
                $_SESSION['resultado_reserva'] = $resultado;
            }
        }
        
        // obtiene nuevamente la lista de equipos disponibles
        $equiposDisponibles = $this->ObtenerEquiposDisponibles();

        require 'view/panel/form-reservar.php';
    }


}

