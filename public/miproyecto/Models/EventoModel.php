<?php
// public/miproyecto/Models/EventoModel.php

class EventoModel {
    private $db;

    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }

    // Unificar los métodos (puedes usar cualquiera de los dos nombres)
    public function obtenerTodos() {
        return $this->obtenerTodosLosEventos();
    }

    public function obtenerTodosLosEventos() {
        $query = "SELECT * FROM eventos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // En EventoModel.php
    public function obtenerEventoPorId($id) {
        $query = "SELECT * FROM eventos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}