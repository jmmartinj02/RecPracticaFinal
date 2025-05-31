<?php
class ParticipanteModel {
    private $db;

    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }
    //obtiene una lista de todos los participantes inscritos en un evento.
    public function obtenerParticipantesPorEvento($eventoId) {
        $query = "SELECT u.id, u.nombre, u.apellidos, u.nivel_escalada, ep.estado, ep.fecha_inscripcion 
                 FROM usuarios u
                 JOIN evento_participante ep ON u.id = ep.participante_id
                 WHERE ep.evento_id = :evento_id
                 ORDER BY ep.fecha_inscripcion DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':evento_id', $eventoId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}