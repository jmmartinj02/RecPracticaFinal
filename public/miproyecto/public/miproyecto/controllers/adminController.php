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

}