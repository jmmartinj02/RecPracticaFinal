<?php
// Incluir dependencias manualmente con rutas correctas
require_once __DIR__ . '/../Models/EventoModel.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Vistas/View.php';

class EventosController {
    //llama a los metodos de los modelos para transferir los datos que extraen a las vistas.
    public function index() {
        $modeloEvento = new EventoModel();
        $modeloUsuario = new UsuarioModel();
        
        $datos = [
            'titulo' => "Eventos disponibles",
            'eventos' => $modeloEvento->obtenerTodos(),
            'usuario' => $_SESSION['usuario'] ?? null
        ];
        
        View::show('eventosView', $datos);
    }

    public function detalle() {

        $eventoModel = new EventoModel();
        $usuarioModel = new UsuarioModel();
        
        $evento = $eventoModel->obtenerPorId($_GET['id']);
        //ºmete en data los datos obtenidos en ibtenerPorId
        $data = [
            'eventoDetalle' => $evento,
            'participantes' => $usuarioModel->obtenerPorEvento($_GET['id']),
            'titulo' => 'Detalles del Evento: '.$evento['nombre'],
            'usuario' => $_SESSION['usuario'] ?? null,
            'totalParticipantes' => $eventoModel->contarParticipantes($_GET['id'])
        ];
        //utiliza show, a la vista detalleView con los datos almacenados en $data
        View::show('detalleView', $data);
    }
    //inscribe a un usario en un evento
   public function inscribir() {

    //si la sesion no está creada como usuario, es decir, que no se ha iniciado sesion, a logearse chavalongo
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?controller=LoginController&action=login');
        exit;
    }

    $eventoId = (int)$_GET['id'];
    $usuarioId = (int)$_SESSION['usuario']['id'];
    
    //simple y conciso directo al grano, llamada al metodo en eventomodel para inscribir
    //esto es lo que te comenté, iba a redirigir a OTRA PAGINA con la informacion del evento y del usuario
    //para compararla y si era mas dificil el evento que le nivel del participante, preguntarle si estaba seguro
    $eventoModel = new EventoModel();
    $eventoModel->inscribirUsuario($eventoId, $usuarioId);
    
    //uso de metodo detalle para que una vez inscrito, nos enseñe los participantes inscritos
    //así el usuario verá cambiop y podrá cerciorarse de que se ha inscrito
    $this->detalle();
}

}