<?php
session_start();
// 2. Incluir el header
include_once "miproyecto/includes/header.php";
// 3. Lógica principal
if (isset($_GET['action']) && isset($_GET['controller'])) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];
    
    // Incluir el controlador
    include "miproyecto/controllers/$controller.php";
    $controllerInstance = new $controller();
    $controllerInstance->$action();
}
else {
    // Página de inicio (mostrar about)
    include "miproyecto/controllers/paginasController.php";
    $paginas = new paginasController();
    $paginas->about();
}
// 4. Incluir el footer
include_once "miproyecto/includes/footer.php";
