<?php
// public/miproyecto/Vistas/eventos/eventosView.php
require_once __DIR__.'/../includes/header.php';
?>

<div class="container mt-4">
    <h1 class="mb-4">Eventos de Escalada</h1>
    
    <?php if (empty($eventos)): ?>
        <div class="alert alert-info">No hay eventos programados actualmente.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($eventos as $evento): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($evento['nombre']) ?></h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-calendar"></i> 
                                <?= date('d/m/Y H:i', strtotime($evento['fecha_inicio'])) ?> - 
                                <?= date('d/m/Y H:i', strtotime($evento['fecha_fin'])) ?>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>
                            </p>
                            <p class="card-text">
                                Dificultad: 
                                <span class="badge bg-<?= 
                                    $evento['dificultad'] === 'facil' ? 'success' : 
                                    ($evento['dificultad'] === 'media' ? 'warning' : 'danger') 
                                ?>">
                                    <?= ucfirst($evento['dificultad']) ?>
                                </span>
                            </p>
                            <!-- En la tarjeta de cada evento (dentro del foreach) -->
                            <a href="index.php?controller=eventosController&action=detalle&id=<?= $evento['id'] ?>" 
                               class="btn btn-primary">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__.'/../includes/footer.php'; ?>