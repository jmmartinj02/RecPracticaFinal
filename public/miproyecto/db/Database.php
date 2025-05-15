<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Configuración usando los datos de tu .env
        $host = 'mariadb'; // Nombre del servicio en docker-compose
        $dbname = 'pagina_escalada';
        $user = 'root';
        $password = 'changepassword';

        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            die("Error al conectar con la base de datos. Por favor, inténtalo más tarde.");
        }
    }

    public static function conectar() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}