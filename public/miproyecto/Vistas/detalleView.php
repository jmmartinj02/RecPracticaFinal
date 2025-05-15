<?php
// public/miproyecto/Vistas/detalleView.php
require_once __DIR__.'/../includes/header.php';

// Verificación segura sin headers
if (empty($eventoDetalle)) {
    echo '<div class="alert alert-danger mt-4">El evento no existe</div>';
    require_once __DIR__.'/../includes/footer.php';
    exit;
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= htmlspecialchars($eventoDetalle['nombre']) ?></h1>
        <a href="index.php?controller=eventosController&action=index" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Tarjeta con detalles del evento -->
    <div class="card mb-4">
        <div class="card-body">
            <!-- ... (tu código actual de detalles del evento) ... -->
        </div>
    </div>

    <!-- Sección de participantes -->
    <h3 class="mb-3">Participantes Inscritos</h3>
    
    <?php if (!empty($participantes)): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participantes as $participante): ?>
                        <tr>
                            <td><?= htmlspecialchars($participante['nombre']) ?></td>
                            <td><?= htmlspecialchars($participante['apellidos']) ?></td>
                            <td><?= ucfirst($participante['nivel_escalada']) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $participante['estado'] === 'confirmado' ? 'success' : 
                                    ($participante['estado'] === 'pendiente' ? 'warning' : 'secondary') 
                                ?>">
                                    <?= ucfirst($participante['estado']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No hay participantes inscritos todavía. 
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="index.php?controller=eventosController&action=inscribir&id=<?= $eventoDetalle['id'] ?>" 
                   class="alert-link">¡Sé el primero!</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__.'/../includes/footer.php'; ?>