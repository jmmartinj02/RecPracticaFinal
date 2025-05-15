<?php
class View {
    public static function show($viewName, $data = []) {
        // Extraer variables del array data
        extract($data);
        
        // Construir la ruta correcta según tu estructura
        $viewPath = __DIR__.'/'.$viewName.'.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("La vista {$viewName} no existe");
        }
    }
}