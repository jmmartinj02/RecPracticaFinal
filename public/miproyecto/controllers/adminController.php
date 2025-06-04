<?php
class AdminController {
    //
    public function gestionEventos() {

        require_once __DIR__.'/../Models/EventoModel.php';
        $eventoModel = new EventoModel();
        $eventos = $eventoModel->obtenerTodosConParticipantes();

        View::show('adminGestionEventosView', [
            'titulo' => 'Gestión de Eventos',
            'eventos' => $eventos,
            'usuario' => $_SESSION['usuario']
        ]);
    }
    // Añade estos métodos a tu AdminController
public function addEvento() {
        // Verificación de sesión
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=LoginController&action=login');
            exit();
        }

        if ($_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: index.php?controller=PaginasController&action=error');
            exit();
        }

        $datosVista = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__.'/../Models/EventoModel.php';
            $eventoModel = new EventoModel();
            
            // Recoger y sanitizar datos
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin'] ?? null,
                'lugar' => trim($_POST['lugar']),
                'max_participantes' => !empty($_POST['max_participantes']) ? (int)$_POST['max_participantes'] : null,
                'dificultad' => $_POST['dificultad']
            ];
            
            // Validar datos
            $errores = $eventoModel->validarDatosEvento($datos);
            
            if (empty($errores)) {
                if ($eventoModel->crearEvento($datos)) {
                    $_SESSION['mensaje_exito'] = "Evento creado correctamente";
                    header('Location: index.php?controller=AdminController&action=gestionEventos');
                    exit();
                } else {
                    $datosVista['error'] = "Error al crear el evento. Por favor, inténtalo de nuevo.";
                    $datosVista['datos'] = $datos;
                }
            } else {
                $datosVista['error'] = implode("<br>", $errores);
                $datosVista['datos'] = $datos;
            }
        }
        
        View::show('addEventoView', $datosVista);
    }

    public function gestionDeEventos() {
        // Verificación de sesión
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=LoginController&action=login');
            exit();
        }

        if ($_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: index.php?controller=PaginasController&action=error');
            exit();
        }

        require_once __DIR__.'/../Models/EventoModel.php';
        $eventoModel = new EventoModel();
        
        $datosVista = [
            'eventos' => $eventoModel->obtenerTodosConParticipantes(),
            'titulo' => 'Gestión de Eventos'
        ];
        
        View::show('adminGestionEventosView', $datosVista);
    }

}