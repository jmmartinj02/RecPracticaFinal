<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-4">
    <h1><i class="bi bi-calendar-check"></i> <?= htmlspecialchars($titulo) ?></h1>
    
    <?php if (empty($eventos)): ?>
        <div class="alert alert-info mt-4">No estás inscrito en ningún evento.</div>
    <?php else: ?>
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= htmlspecialchars($evento['nombre']) ?></td>
                            <td><?= date('d/m/Y', strtotime($evento['fecha_inicio'])) ?></td>
                            <td>
                                <span class="badge bg-<?= $evento['estado'] === 'confirmado' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($evento['estado']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?controller=EventosController&action=detalle&id=<?= $evento['id'] ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__.'/../includes/footer.php'; ?>