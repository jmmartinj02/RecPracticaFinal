<?php
require_once __DIR__.'/../Models/UsuarioModel.php';
require_once __DIR__.'/../Vistas/View.php';

class LoginController {
    public function login() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, redirigir
        if (isset($_SESSION['usuario'])) {
            $this->redirigirSegunRol();
            exit;
        }

        $error = null;
        //proceso de formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->obtenerPorEmail($email);
            
            if ($usuario && $password === $usuario['password']) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email'],
                    'rol' => $usuario['rol']
                ];
                $this->redirigirSegunRol();
                exit;
            } else {
                $error = "Credenciales incorrectas";
            }
        }

        // Mostrar vista
        View::show('loginView', ['error' => $error]);
    }

    public function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Limpiar y destruir la sesión
    $_SESSION = array();
    session_destroy();
    
    // Redirigir a la página principal
    View::show('aboutView');
    exit();
    }
    private function redirigirSegunRol() {
        $url = ($_SESSION['usuario']['rol'] === 'admin') 
            ? 'index.php?controller=adminController&action=index'
            : 'index.php?controller=paginasController&action=about';
            View::show('eventosView');
        exit;
    }
}