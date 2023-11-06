<?php
class controller
{
    public function login()
    {
        // Mostrar la vista de inicio de sesión
        require_once 'app/views/login.php';
    }

    public function register()
    {
        // Mostrar la vista de registro
        require_once '../views/register.php';
    }

    public function authenticate($email, $password)
    {
        // Verificar las credenciales del usuario
        $user = Usuario::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            // Redirigir al panel de control
            header('Location: index.php?route=dashboard');
        } else {
            // Mostrar mensaje de error
            echo 'Credenciales inválidas.';
        }
    }

    public function createUser($name, $email, $password)
    {
        // Crear un nuevo usuario
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        User::create($name, $email, $hashedPassword);

        // Redirigir al inicio de sesión
        header('Location: index.php?route=login');
    }

    public function logout()
    {
        // Cerrar sesión
        session_destroy();
        // Redirigir al inicio de sesión
        header('Location: index.php?route=login');
    }
}
?>