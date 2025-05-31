<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4"><?= htmlspecialchars($titulo) ?></h1>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Eventos</h5>
                    <p class="display-4"><?= $totalEventos ?></p>
                    <a href="index.php?controller=EventosController&action=index" class="btn btn-primary">
                        Gestionar Eventos
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="display-4"><?= $totalUsuarios ?></p>
                    <a href="index.php?controller=AdminController&action=usuarios" class="btn btn-primary">
                        Gestionar Usuarios
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>