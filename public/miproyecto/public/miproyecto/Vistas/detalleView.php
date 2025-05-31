<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= htmlspecialchars($titulo) ?></h1>
        <a href="index.php?controller=EventosController&action=index" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h2><?= htmlspecialchars($eventoDetalle['nombre']) ?></h2>
            <p><?= nl2br(htmlspecialchars($eventoDetalle['descripcion'])) ?></p>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($eventoDetalle['fecha_inicio'])) ?> - <?= date('d/m/Y H:i', strtotime($eventoDetalle['fecha_fin'])) ?></p>
                    <p><strong>Lugar:</strong> <?= htmlspecialchars($eventoDetalle['lugar']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Dificultad:</strong> 
                        <span class="badge bg-<?= 
                            $eventoDetalle['dificultad'] === 'facil' ? 'success' : 
                            ($eventoDetalle['dificultad'] === 'media' ? 'warning' : 'danger') 
                        ?>">
                            <?= ucfirst($eventoDetalle['dificultad']) ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h3>Participantes</h3>
    <?php if (!empty($participantes)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
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
                            <td><?= $participante['nivel_escalada'] ? ucfirst($participante['nivel_escalada']) : 'No especificado' ?></td>
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
        <div class="alert alert-info">No hay participantes inscritos todavía.</div>
    <?php endif; ?>

    <?php if (isset($usuario)): ?>
        <?php 
        $estaInscrito = false;
        foreach ($participantes as $participante) {
            if ($participante['id'] == $usuario['id']) {
                $estaInscrito = true;
                break;
            }
        }
        ?>
        
        <div class="mt-4 text-center">
            <?php if ($estaInscrito): ?>
                <span class="text-success"><i class="bi bi-check-circle-fill"></i> Estás inscrito en este evento</span>
            <?php else: ?>
                <a href="index.php?controller=EventosController&action=inscribir&id=<?= $eventoDetalle['id'] ?>" 
                   class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Inscribirse
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>