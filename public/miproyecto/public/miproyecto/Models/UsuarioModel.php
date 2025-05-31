<?php
class UsuarioModel {
    private $db;

    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }
    //busca un usuario en la base de datos por su dirección de email.
    public function obtenerPorEmail($email) {
        $query = "SELECT id, nombre, apellidos, email, telefono, password, 
                         nivel_escalada, rol, fecha_registro 
                  FROM usuarios 
                  WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //inserta un nuevo usuario en la base de datos, utilizando los datos del formulario
    public function registrarUsuario($datos) {
    //validar datos antes de insertar, no voy a encriptar contraseñas, luego es un lio
    if (empty($datos['nombre']) || empty($datos['email']) || empty($datos['password'])) {
        return false;
    }

    $query = "INSERT INTO usuarios (nombre, apellidos, email, telefono, password, nivel_escalada, rol) 
              VALUES (:nombre, :apellidos, :email, :telefono, :password, :nivel_escalada, 'usuario')";
    
    try {
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':apellidos' => $datos['apellidos'] ?? null,
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono'] ?? null,
            ':password' => $datos['password'],
            ':nivel_escalada' => $datos['nivel_escalada'] ?? 'principiante'
        ]);
    } catch (PDOException $e) {
        error_log("Error al registrar usuario: " . $e->getMessage());
        return false;
    }
}
    //lsita los participantes de un evento específico
    public function obtenerPorEvento($eventoId) {
        $query = "SELECT u.id, u.nombre, u.apellidos, u.nivel_escalada, ep.estado, ep.fecha_inscripcion 
                  FROM usuarios u
                  JOIN evento_participante ep ON u.id = ep.participante_id
                  WHERE ep.evento_id = :evento_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':evento_id', $eventoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //en un principio tenia este metodo, pero, lo he dejado aunque no lo use, podría ser util en administración
    public function obtenerTodos() {
        $query = "SELECT id, nombre, apellidos, email, telefono, nivel_escalada, rol, fecha_registro 
                  FROM usuarios";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}