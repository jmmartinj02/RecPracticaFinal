<?php require_once __DIR__.'/../includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registro de Nuevo Usuario</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form action="index.php?controller=LoginController&action=registro" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" 
                                       value="<?= htmlspecialchars($valores['apellidos'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($valores['email'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" 
                                       value="<?= htmlspecialchars($valores['telefono'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Contraseña*</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña*</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nivel_escalada" class="form-label">Nivel de Escalada*</label>
                            <select class="form-select" id="nivel_escalada" name="nivel_escalada" required>
                                <option value="principiante" <?= (isset($valores['nivel_escalada']) && $valores['nivel_escalada'] === 'principiante') ? 'selected' : '' ?>>Principiante</option>
                                <option value="intermedio" <?= (isset($valores['nivel_escalada']) && $valores['nivel_escalada'] === 'intermedio') ? 'selected' : '' ?>>Intermedio</option>
                                <option value="avanzado" <?= (isset($valores['nivel_escalada']) && $valores['nivel_escalada'] === 'avanzado') ? 'selected' : '' ?>>Avanzado</option>
                                <option value="experto" <?= (isset($valores['nivel_escalada']) && $valores['nivel_escalada'] === 'experto') ? 'selected' : '' ?>>Experto</option>
                            </select>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        ¿Ya tienes cuenta? <a href="index.php?controller=LoginController&action=login">Inicia sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
