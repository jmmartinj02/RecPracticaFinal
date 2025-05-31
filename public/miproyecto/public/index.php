<?php
session_start();

// Incluir clases esenciales
require_once __DIR__ . '/miproyecto/Vistas/View.php';

// Lógica principal
if (isset($_GET['action']) && isset($_GET['controller'])) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];
    
    // Incluir el controlador específico
    $controllerFile = __DIR__ . "/miproyecto/controllers/$controller.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            
            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
                exit();
            }
        }
    }
    
    // Mostrar error si no se encuentra el controlador
    View::show('errorView', ['mensaje' => 'Controlador o acción no encontrada']);
    exit();
}

// Página por defecto (about)
View::show('aboutview');