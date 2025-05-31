<?php
//incluyo las dependencias manualmente, por si acaso xd
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Vistas/View.php';
require_once __DIR__ . '/../Models/EventoModel.php';

class LoginController {
        public function login() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['usuario'])) {
                $this->redirigirSegunRol();
                return;
            }

            $error = null;
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $correo = $_POST['email'] ?? '';
                $contrasena = $_POST['password'] ?? '';
                
                $modeloUsuario = new UsuarioModel();
                $usuario = $modeloUsuario->obtenerPorEmail($correo);
                
                if ($usuario && $contrasena === $usuario['password']) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'apellidos' => $usuario['apellidos'],
                        'email' => $usuario['email'],
                        'telefono' => $usuario['telefono'],
                        'nivel_escalada' => $usuario['nivel_escalada'],
                        'rol' => $usuario['rol']
                    ];
                    $this->redirigirSegunRol();
                    return;
                } else {
                    $error = "Credenciales incorrectas";
                }
            }

            View::show('loginView', [
                'error' => $error,
                'titulo' => 'Iniciar sesión'
            ]);
        }

    private function redirigirSegunRol() {
        //manejo la sesion desde que se inicia sesión, utilizando el rol de ese usuario de la base de datos
        //como tengo almacenado dicha caracteristica del usuario en la sesion, puedo hacer las debidas
        //comprobaciones para mostrar o no, pequeñas variaciones en las vistas, o en el header
        // o simplemente, permitir el acceso o no a ciertas funcionalidades de la web.
        if ($_SESSION['usuario']['rol'] === 'admin') {
            // redirigir usando header para evitar problemas de ruta, aun no está implementado,s
            // será una vista de control de la web, ver usuarios, eventos y usuarios en eventos...
            header('Location: index.php?controller=adminController&action=gestionEventos');
            exit;
        } else {
            //para usuarios normales, mostrar la lista de eventos
            header('Location: index.php?controller=eventosController&action=index');
            exit;
        }
    }

        public function invitado() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            //activar modo invitado
            $_SESSION['invitado'] = true;
            View::show('aboutView', [
                'mensaje' => 'Modo invitado activado'
            ]);
        }
        public function logout() {
        // iniciar sesión por si no lo estaba ya,
        // me daba fallos, como que no se actualizaba el header despues de cerrar sesión.
        //por eso aunque parezca que no tiene sentido el hecho de que incie sesion cuando voy a cerrarla...
        //a mi me ha funcionado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        //destruir completamente la sesión, asignando un nuevo array vacio.
        $_SESSION = array();
        
        //destruir la sesión
        session_destroy();
        
        // Redirigir a la página principal con mensaje
        header('Location: index.php?controller=PaginasController&action=about&mensaje=Has cerrado sesión correctamente');
        exit;
    }
    public function registro() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //redirigir, por si por algun casual, ya hubiese una sesion iniciada,
        // manda a un sitio u otro, echa un vistazo a la funcion redirigSegunRol para mas info.
        if (isset($_SESSION['usuario'])) {
            $this->redirigirSegunRol();
            return;
        }

        $error = null;
        $modeloUsuario = new UsuarioModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'apellidos' => trim($_POST['apellidos']),
                'email' => trim($_POST['email']),
                'telefono' => trim($_POST['telefono'] ?? ''),
                'password' => $_POST['password'],
                'nivel_escalada' => $_POST['nivel_escalada']
            ];

            // Validaciones
            if (empty($datos['nombre']) || empty($datos['email']) || empty($datos['password'])) {
                $error = "Todos los campos obligatorios deben ser completados";
            } elseif ($_POST['password'] !== $_POST['confirm_password']) {
                $error = "Las contraseñas no coinciden";
            } elseif ($modeloUsuario->obtenerPorEmail($datos['email'])) {
                $error = "Este correo electrónico ya está registrado";
            } else {
                // Registrar usuario
                if ($modeloUsuario->registrarUsuario($datos)) {
                    // Iniciar sesión automáticamente
                    $usuario = $modeloUsuario->obtenerPorEmail($datos['email']);
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'apellidos' => $usuario['apellidos'],
                        'email' => $usuario['email'],
                        'telefono' => $usuario['telefono'],
                        'nivel_escalada' => $usuario['nivel_escalada'],
                        'rol' => $usuario['rol']
                    ];
                    
                    $this->redirigirSegunRol();
                    return;
                } else {
                    $error = "Error al registrar el usuario. Por favor, inténtelo de nuevo.";
                }
            }
        }
        

        View::show('registroView', [
            'error' => $error,
            'titulo' => 'Registro de usuario',
            'valores' => $_POST ?? [] // Mantener valores ingresados
        ]);
    }
    public function misEventos() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=LoginController&action=login');
            exit;
        }

        require_once __DIR__.'/../Models/EventoModel.php';
        $eventoModel = new EventoModel();
        $misEventos = $eventoModel->obtenerEventosPorUsuario($_SESSION['usuario']['id']);

        View::show('misEventosView', [
            'titulo' => 'Mis Eventos Inscritos',
            'eventos' => $misEventos,
            'usuario' => $_SESSION['usuario']
        ]);
    }
}