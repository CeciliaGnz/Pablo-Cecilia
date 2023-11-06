<?php
class Sesion {
    public function iniciarSesion() {
        session_start();
    }

    public function cerrarSesion() {
        session_destroy();
    }

    public function estaAutenticado() {
        return isset($_SESSION['usuario_id']);
    }
}
