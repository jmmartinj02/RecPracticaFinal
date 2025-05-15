<?php
// public/miproyecto/controllers/eventosController.php

require_once __DIR__.'/../Models/EventoModel.php';
require_once __DIR__.'/../Models/ParticipanteModel.php';
require_once __DIR__.'/../Vistas/View.php';

class eventosController {
    public function index() {
        $eventoModel = new EventoModel();
        $data = [
            'titulo' => "Eventos disponibles",
            'eventos' => $eventoModel->obtenerTodosLosEventos()
        ];
        View::show('eventosView', $data);
    }

    public function detalle() {
        // Verificar que existe el ID
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=paginasController&action=error");
            exit();
        }

        $eventoModel = new EventoModel();
        $participanteModel = new ParticipanteModel();
        
        // Obtener datos
        $evento = $eventoModel->obtenerEventoPorId($_GET['id']);
        $participantes = $participanteModel->obtenerParticipantesPorEvento($_GET['id']);

        // Verificar que el evento existe
        if (!$evento) {
            header("Location: index.php?controller=paginasController&action=error");
            exit();
        }

        // Preparar datos para la vista
        $data = [
            'eventoDetalle' => $evento,
            'participantes' => $participantes,
            'titulo' => 'Detalles del Evento: '.$evento['nombre']
        ];
        
        View::show('detalleView', $data);
    }


    public function listarEventos() {
        $eventoModel = new EventoModel();
        $data = [
            'eventos' => $eventoModel->obtenerTodosLosEventos(),
            'titulo' => 'Eventos de Escalada'
        ];
    
        View::show('eventosView', $data);
    }
    // En eventosController.php
}