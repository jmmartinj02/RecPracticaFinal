<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Añadir Nuevo Evento</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form action="index.php?controller=AdminController&action=addEvento" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre del Evento</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       value="<?= isset($datos['nombre']) ? htmlspecialchars($datos['nombre']) : '' ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lugar" class="form-label">Lugar</label>
                                <input type="text" class="form-control" id="lugar" name="lugar" 
                                       value="<?= isset($datos['lugar']) ? htmlspecialchars($datos['lugar']) : '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?= isset($datos['descripcion']) ? htmlspecialchars($datos['descripcion']) : '' ?></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                       value="<?= isset($datos['fecha_inicio']) ? htmlspecialchars($datos['fecha_inicio']) : '' ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de finalización</label>
                                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" 
                                       value="<?= isset($datos['fecha_fin']) ? htmlspecialchars($datos['fecha_fin']) : '' ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max_participantes" class="form-label">Máximo de participantes</label>
                                <input type="number" class="form-control" id="max_participantes" name="max_participantes" 
                                       value="<?= isset($datos['max_participantes']) ? htmlspecialchars($datos['max_participantes']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dificultad" class="form-label">Dificultad</label>
                                <select class="form-select" id="dificultad" name="dificultad" required>
                                    <option value="facil" <?= (isset($datos['dificultad']) && $datos['dificultad'] === 'facil') ? 'selected' : '' ?>>Principiante</option>
                                    <option value="media" <?= (isset($datos['dificultad']) && $datos['dificultad'] === 'media') ? 'selected' : '' ?>>Media</option>
                                    <option value="dificil" <?= (isset($datos['dificultad']) && $datos['dificultad'] === 'dificil') ? 'selected' : '' ?>>Difícil</option>
                                    <option value="extrema" <?= (isset($datos['dificultad']) && $datos['dificultad'] === 'extrema') ? 'selected' : '' ?>>Extrema</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Crear Evento</button>
                            <a href="index.php?controller=AdminController&action=gestionEventos" class="btn btn-secondary mt-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>