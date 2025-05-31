<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escalada Montaña Viva - <?= $titulo ?? 'Inicio' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-item {
            margin-left: 0.5rem;
        }
        .user-badge {
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/miproyecto/imagenes/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-top me-2">
                Escalada Montaña Viva
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=paginasController&action=about">Sobre nosotros</a>
                    </li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=eventosController&action=index">Eventos</a>
                        </li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=LoginController&action=misEventos">
                                <i class="bi bi-calendar-check"></i> Mis Eventos
                            </a>
                        </li>
                        <?php if($_SESSION['usuario']['rol'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="index.php?controller=AdminController&action=gestionEventos">
                                    <i class="bi bi-shield-lock"></i> Admin
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <span class="badge bg-<?= $_SESSION['usuario']['rol'] === 'admin' ? 'danger' : 'primary' ?> user-badge">
                                    <i class="bi bi-person-fill"></i> <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?controller=LoginController&action=perfil"><i class="bi bi-person"></i> Mi perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="index.php?controller=LoginController&action=logout" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                                </li>
                            </ul>
                        </li>
                    <?php elseif(isset($_SESSION['invitado'])): ?>
                        <li class="nav-item">
                            <span class="badge bg-secondary user-badge me-2">
                                <i class="bi bi-person"></i> Invitado
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?controller=loginController&action=login" class="btn btn-sm btn-outline-light">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="index.php?controller=loginController&action=login" class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?controller=loginController&action=registro" class="btn btn-sm btn-outline-light">
                                <i class="bi bi-person-plus"></i> Registrarse
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-shrink-0">