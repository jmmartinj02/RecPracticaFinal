<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="bi bi-lock"></i> Acceso</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form action="index.php?controller=LoginController&action=login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <p class="text-muted">¿No tienes cuenta?</p>
                        <a href="index.php?controller=LoginController&action=registro" class="btn btn-outline-success">
                            <i class="bi bi-person-plus"></i> Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>