<?php
class EventoModel {
    private $db;
    //inicializa la conexion a la base de datos al crear una instancia
    public function __construct() {
        require_once __DIR__.'/../db/Database.php';
        $this->db = Database::conectar();
    }
    //otbiene los mismo campos que id pero sin filtros, es decir, todos, y los ordena por fecha de inicio
    public function obtenerTodos() {
        $query = "SELECT id, nombre, descripcion, fecha_inicio, fecha_fin, 
                         lugar, max_participantes, dificultad 
                  FROM eventos 
                  ORDER BY fecha_inicio ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //obtiene los datos de un evento por su id
    public function obtenerPorId($id) {
        $query = "SELECT id, nombre, descripcion, fecha_inicio, fecha_fin, 
                         lugar, max_participantes, dificultad 
                  FROM eventos 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function inscribirUsuario($eventoId, $usuarioId) {
        //verifico si está inscrito el usuario que tiene iniciada en el evento que ha hecho clic
        //como solamente puede inscribirse una vez...
        $queryCheck = "SELECT 1 FROM evento_participante 
                      WHERE evento_id = ? AND participante_id = ?";
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->execute([$eventoId, $usuarioId]);
        
        if (!$stmtCheck->fetch()) {
            //inscripción si no existe el check quiere decir que puedo
            //hacer la isnercion en la base de datos.
            $query = "INSERT INTO evento_participante (evento_id, participante_id, estado) 
                 VALUES (?, ?, 'pendiente')";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$eventoId, $usuarioId]);
        }
    }
    //cuenta el contenido en la tabla evento_participantes y lo almacena en total
    public function contarParticipantes($eventoId) {
        $query = "SELECT COUNT(*) as total 
                 FROM evento_participante 
                 WHERE evento_id = :evento_id";
        //esta linea prepara la consulta, para que sea imposible hacer inyecciones sql
        $stmt = $this->db->prepare($query);
        //vincula un parámetro a una variable PHP, en este caso un numero
        $stmt->bindParam(':evento_id', $eventoId, PDO::PARAM_INT);
        //ejecuta la consulta
        $stmt->execute();
        //como en este caso está devolviendo la base de datos un numero, porque los está contando
        //utilizo el fetch que es unico, si fuese como por ejemplo, obtener todos los eventos como son varios
        //debería de utilizar el fetchALL
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    //consiste en hacer dos left join en la base de datos
    //para meter los datos obtenidos en un array, esto es rarísimo,
    //no se si es por el visual o por php pero hay veces que me salta un fallo aquí.
    public function obtenerTodosConParticipantes() {
    $query = "SELECT e.*, 
                     COUNT(ep.participante_id) as total_participantes,
                     GROUP_CONCAT(u.nombre SEPARATOR ', ') as nombres_participantes
              FROM eventos e
              LEFT JOIN evento_participante ep ON e.id = ep.evento_id
              LEFT JOIN usuarios u ON ep.participante_id = u.id
              GROUP BY e.id
              ORDER BY e.fecha_inicio ASC";
    
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Obtiene los eventos por usuario utilizando un join ordenando los eventos por la fecha de inicio
    //es decir el más cercano a comenzar, con un fetchAll que los utiliza todos.
    public function obtenerEventosPorUsuario($usuarioId) {
        $query = "SELECT e.*, ep.estado, ep.fecha_inscripcion 
                FROM eventos e
                JOIN evento_participante ep ON e.id = ep.evento_id
                WHERE ep.participante_id = :usuario_id
                ORDER BY e.fecha_inicio ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}