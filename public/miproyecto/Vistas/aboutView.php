<?php require_once __DIR__.'/../includes/header.php'; ?>
<div class="about-page">
    <!-- Carrusel de imágenes -->
    <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/miproyecto/imagenes/escaladaroca.png" class="d-block w-100" alt="Escalada en roca">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Pasión por la verticalidad</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/miproyecto/imagenes/viasescalada.png" class="d-block w-100" alt="Vías de escalada">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Descubre nuestras vías</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/miproyecto/imagenes/escalada3.png" class="d-block w-100" alt="Comunidad escaladora">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Únete a nuestra comunidad</h2>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <!-- Contenido principal -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">Escalada Montaña Viva</h1>
            <p class="lead">Desde Mérida, impulsando el deporte de aventura con seguridad y pasión</p>
           <script>
            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';
            exit
            </script>
        </div>
        <div class="row g-4">
            <!-- Tarjeta 1 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <h3 class="h5">Seguridad ante todo</h3>
                        <p class="text-muted">Protocolos rigurosos y equipos certificados para que solo te preocupes por disfrutar de la escalada.</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 2 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle bg-success text-white mb-3 mx-auto">
                            <i class="bi bi-activity fs-3"></i>
                        </div>
                        <h3 class="h5">Adrenalina controlada</h3>
                        <p class="text-muted">Vías para todos los niveles, desde iniciación hasta grados avanzados, siempre con el asesoramiento adecuado.</p>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 3 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle bg-warning text-white mb-3 mx-auto">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <h3 class="h5">Comunidad activa</h3>
                        <p class="text-muted">Más de 200 miembros que comparten tu pasión por la escalada y el aire libre.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de tipos de escalada -->
        <div class="row mt-5 align-items-center">
            <div class="col-lg-6">
                <img src="/miproyecto/imagenes/cintaexpress.png" class="img-fluid rounded shadow" alt="Escalada deportiva">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mt-4 mt-lg-0">Escalada Deportiva</h2>
                <p class="lead">Perfecta para iniciarse en el mundo vertical</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Más de 50 vías equipadas</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Grados desde 4 hasta 8a</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Reequipamiento anual de seguros</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Zonas específicas para principiantes</li>
                </ul>
            </div>
        </div>

        <div class="row mt-5 flex-lg-row-reverse align-items-center">
            <div class="col-lg-6">
                <img src="/miproyecto/imagenes/friend.png" class="img-fluid rounded shadow" alt="Escalada clásica">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold">Escalada Clásica</h2>
                <p class="lead">Para los que buscan la esencia pura de la escalada</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Vías tradicionales en roca caliza</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Requiere experiencia previa</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Material de protección no fijo</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Rutas de varios largos disponibles</li>
                </ul>
            </div>
        </div>

        <!-- Si no está iniciada la sesión muestra inicio sesion y registrarse, si -->
         <!-- si está iniciada la sesión y por algun casual el usuario
           pasa por aboutview podra ir a evento si baja hasta abajo -->
        <div class="cta-section bg-dark text-white rounded p-5 mt-5 text-center">
            <h2 class="fw-bold mb-3">¿Listo para la aventura?</h2>
            <p class="lead mb-4">Únete a nuestra asociación y accede a todas las actividades, cursos y material compartido</p>
            <?php if(isset($_SESSION['invitado']) || !isset($_SESSION['usuario'])): ?>
                <a href="index.php?controller=loginController&action=login" class="btn btn-primary btn-lg px-4 me-2">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                </a>
                <a href="index.php?controller=loginController&action=registro" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-person-plus"></i> Registrarse
                </a>
            <?php else: ?>
                <a href="index.php?controller=eventosController&action=index" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-calendar-event"></i> Ver próximos eventos
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .about-page {
        padding-top: 56px;
    }
    .carousel-item {
        height: 60vh;
        min-height: 400px;
        background: no-repeat center center;
        background-size: cover;
    }
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cta-section {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('/miproyecto/imagenes/cta-background.jpg');
        background-size: cover;
        background-position: center;
    }
</style>

