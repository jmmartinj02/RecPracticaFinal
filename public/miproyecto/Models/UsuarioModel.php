<?php
// miproyecto/Models/UsuarioModel.php
class UsuarioModel {
    private $db;

    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }

    public function obtenerPorEmail($email) {
        $query = "SELECT id, nombre, email, password, rol FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}