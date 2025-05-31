<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">
    <div class="alert alert-danger">
        <p><?= htmlspecialchars($mensaje) ?></p>
        <a href="index.php" class="btn btn-primary">Volver al inicio</a>
    </div>
</div>