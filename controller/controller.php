<?php
session_start();// Comienzo de la sesión
require_once 'model/usuario.php';
require_once 'model/computadoras.php';
require_once 'model/laboratorio.php';
class Controller
{
    private $user;
    private $pc;
    private $lab;
    private $resp;

   
    public function __CONSTRUCT(){
        $this->user = new Usuario();
        $this->pc = new Computadoras();
    }

    public function Index(){
        require("view/login.php");
    }

    public function CrearUsuario(){
        require("view/register.php");
    }

    public function IngresarPanel(){
        require("view/panel/dashboard.php"); 
    }

    public function IngresarEquipos(){
        require("view/panel/lista-equipos.php"); 
        
    }
    
    public function IngresarReserva(){
        require("view/panel/form-reservar.php"); 
    }

    public function IngresarVerReportes(){
        require("view/panel/reporte-reservas.php"); 
    }

    public function IngresarVerMisReservas(){
        require("view/panel/mis-reservas.php"); 
    }

    public function IngresarPerfil(){
        if(isset($_SESSION['UsuarioID'])) {
            $usuario = $this->user->Obtener($_SESSION['UsuarioID']);
            require("view/panel/profile.php");
        } else {
            // Si no hay una sesión válida, puedes redirigir al usuario a otra página, mostrar un mensaje de error, etc.
            header('Location: ?op=error');
        }
    }

    public function Guardar(){
        $usuario = new Usuario();
    
        $usuario->Nombre = $_POST['nombre'];
        $usuario->Apellido = $_POST['apellido'];
        $usuario->CorreoElectronico = $_POST['correo'];
        $usuario->Contrasena = md5($_REQUEST['contrasena']);
    
        $this->resp = $this->user->Registrar($usuario);
    
        header('Location: ?op=crear&msg=' . $this->resp);
    }

    public function Ingresar(){
        $ingresarUsuario = new Usuario();
        
        $ingresarUsuario->CorreoElectronico = $_REQUEST['correo'];  
        $ingresarUsuario->Contrasena = md5($_REQUEST['contrasena']);    

        //Verificamos si existe en la base de datos
        if ($resultado= $this->user->Consultar($ingresarUsuario))
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

    
   
}
   ?>