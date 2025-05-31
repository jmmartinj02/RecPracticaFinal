<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-4">
    <h1><i class="bi bi-shield-lock"></i> <?= htmlspecialchars($titulo) ?></h1>
    
    <div class="table-responsive mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Fecha</th>
                    <th>Participantes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= htmlspecialchars($evento['nombre']) ?></td>
                        <td><?= date('d/m/Y', strtotime($evento['fecha_inicio'])) ?></td>
                        <td>
                            <?= $evento['total_participantes'] ?>
                            <?php if ($evento['total_participantes'] > 0): ?>
                                <button class="btn btn-sm btn-info ms-2" data-bs-toggle="collapse" 
                                        data-bs-target="#participantes-<?= $evento['id'] ?>">
                                    <i class="bi bi-people"></i> Ver
                                </button>
                                <div id="participantes-<?= $evento['id'] ?>" class="collapse mt-2">
                                    <small><?= htmlspecialchars($evento['nombres_participantes']) ?></small>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?controller=EventosController&action=detalle&id=<?= $evento['id'] ?>" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-gear"></i> Gestionar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>