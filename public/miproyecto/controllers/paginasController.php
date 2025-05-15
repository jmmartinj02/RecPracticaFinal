<?php
// public/miproyecto/controllers/paginasController.php

class paginasController {
    public function about() {
        $titulo = "Sobre la Asociación";
        include 'miproyecto/Vistas/aboutView.php';
    }
    
    public function home() {
        // Redirigir a about como página principal
        header('Location: index.php?controller=paginasController&action=about');
        exit;
    }
}