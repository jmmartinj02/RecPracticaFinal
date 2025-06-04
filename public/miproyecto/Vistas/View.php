<?php
class View {
    public static function show($nombreVista, $datos = []) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //sacado de reddit, carga el directorio base y monta una ruta para los archivos
        //para las vistas, carga tanto el header como el footer, y guarda la ruta de la vista
        //como se encuentra en la misma carpeta no hace falta nada mas en directorio base.
        $baseDir = __DIR__ . '/';
        $rutaHeader = $baseDir . '../includes/header.php';
        $rutaVista = $baseDir . $nombreVista . '.php';
        $rutaFooter = $baseDir . '../includes/footer.php';
        
        //verifica si existen los archivos
        if (!file_exists($rutaVista)) {
            //si la vista no existe, redirigir a error view
            header('Location: index.php?controller=PaginasController&action=error&mensaje=Vista no encontrada');
            exit;
        }
        
        //Extraer variables para la vista
        extract($datos);
        
        //incluir componentes, OJO, SI SE HACE REQUIRE EN ALGUNA OTRA VISTA
        //PUEDE QUE ALGUNA PAGINA PIERDA LAS FUNCIONALIDADES DEL HEADER, NO PODRÁS ACCEDER, POR EJEMPLO
        //A LA OPCIÓN DE CERRAR SESIÓN
        require $rutaHeader;
        require $rutaVista;
        require $rutaFooter;
        
        exit();
    }
}