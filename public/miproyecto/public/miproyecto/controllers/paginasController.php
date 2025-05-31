<?php
// Incluir View manualmente con la ruta correcta
require_once __DIR__ . '/../Vistas/View.php';

class paginasController {
    public function about() {
        View::show('aboutView', [
            'titulo' => "Sobre la Asociación"
        ]);
    }
    
    //public function home() {
    //    header('Location: index.php?controller=paginasController&action=about');
    //    exit;
    //}
    //si por algun casual algo falla, envia a la vista errorview
    public function error() {
    $mensaje = $_GET['mensaje'] ?? 'Error desconocido';
    View::show('errorView', [
        'titulo' => 'Error',
        'mensaje' => $mensaje
    ]);
}
}