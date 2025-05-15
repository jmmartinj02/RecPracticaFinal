<?php
// public/miproyecto/Models/ParticipantesModel.php

class ParticipanteModel {
    private $db;

    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }

    public function obtenerParticipantesPorEvento($eventoId) {
        $query = "SELECT p.nombre, p.apellidos, p.nivel_escalada, ep.estado 
                  FROM participantes p
                  JOIN evento_participante ep ON p.id = ep.participante_id
                  WHERE ep.evento_id = :evento_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':evento_id', $eventoId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}