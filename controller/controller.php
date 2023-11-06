<?php

require_once 'model/usuario.php';

class Controller
{
    private $model;
    private $resp;

    public function __CONSTRUCT(){
        $this->model = new Usuario();
    }

    public function Index(){
        require("view/login.php");
    }

    public function CrearUsuario(){
        require("view/register.php");
    }

    public function IngresarPanel(){
        require("view/panel/dashboard.php"); //CAMBIAR DESPUES AL DASHBOARD PARA QUE SEA LO PRIMERO QUE REDIRIGA CUANDO INICIA SESION

    }

    public function IngresarPerfil(){

        $usuario = new Usuario();
        $usuario = $this->model->Obtener($_SESSION['UsuarioID']);

        require("view/panel/profile.php");
    }

    public function Guardar(){
        $usuario = new Usuario();
    
        $usuario->Nombre = $_POST['nombre'];
        $usuario->Apellido = $_POST['apellido'];
        $usuario->CorreoElectronico = $_POST['email'];
        $usuario->Contrasena = md5($_REQUEST['password1']);
        $usuario->TipoUsuario = 2;  
    
        $this->resp = $this->model->Registrar($usuario);
    
        header('Location: ?op=crear&msg=' . $this->resp);
    }

    public function Ingresar(){
        $ingresarUsuario = new Usuario();
        
        $ingresarUsuario->CorreoElectronico = $_REQUEST['correo'];  
        $ingresarUsuario->Contrasena = md5($_REQUEST['password']);    

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

}

