<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-4">
    <h1><?= htmlspecialchars($titulo) ?></h1>
    
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    
    <?php if (empty($eventos)): ?>
        <div class="alert alert-info">No hay eventos programados actualmente.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($eventos as $evento): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($evento['nombre']) ?></h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-calendar"></i> <?= date('d/m/Y H:i', strtotime($evento['fecha_inicio'])) ?>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>
                            </p>
                            <p class="card-text">
                                <span class="badge bg-<?= 
                                    $evento['dificultad'] === 'facil' ? 'success' : 
                                    ($evento['dificultad'] === 'media' ? 'warning' : 'danger') 
                                ?>">
                                    <?= ucfirst($evento['dificultad']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="index.php?controller=EventosController&action=detalle&id=<?= $evento['id'] ?>" 
                               class="btn btn-primary btn-sm">
                                Ver detalles
                            </a>
                            
                            <?php if (isset($usuario)): ?>
                                <a href="index.php?controller=EventosController&action=inscribir&id=<?= $evento['id'] ?>" 
                                   class="btn btn-success btn-sm">
                                    Inscribirse
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>