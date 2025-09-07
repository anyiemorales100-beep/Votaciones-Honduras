<?php
require 'conexion.php';

$mensaje = "";
if (isset($_POST['registro'])) {
    $nombre   = trim($_POST['nombre']);
    $correo   = trim($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $tipo     = "usuario"; 

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, tipo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $password, $tipo);

    if ($stmt->execute()) {
        $mensaje = "✅ Registro exitoso, ahora puedes iniciar sesión";
    } else {
        $mensaje = "❌ Ese correo ya está registrado o ocurrió un error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro - Votaciones Honduras</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Times New Roman', serif;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* Video de fondo */
#bgVideo {
    position: fixed;
    top: 0;
    left: 0;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -1;
    object-fit: cover;
}

/* Tarjeta flotante */
.card {
    width: 430px;
    background: rgba(255,255,255,0.25); /* semi-transparente */
    border: 2px solid rgba(0,0,139,0.5);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    z-index: 10;
    animation: floatCard 4s ease-in-out infinite;
    position: relative;
}

/* Animación flotación */
@keyframes floatCard {
    0%   { transform: translateY(0px); }
    50%  { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

/* Mapa pequeño de Honduras */
.card::before {
    content: '';
    position: absolute;
    bottom: 15px;
    right: 15px;
    width: 60px;
    height: 60px;
    background: url('https://upload.wikimedia.org/wikipedia/commons/8/8e/Honduras_location_map.svg') no-repeat center center;
    background-size: contain;
    opacity: 0.8;
    pointer-events: none;
}

.card h3 {
    color: #004aad;
    font-weight: bold;
    text-align: center;
}

.form-control {
    border-radius: 12px;
    font-family: 'Times New Roman', serif;
    font-weight: bold;
    color: black;
}

.form-control::placeholder {
    color: rgba(0,0,0,0.6);
    font-style: italic;
}

.btn-custom {
    background: linear-gradient(to right, #004aad, #1e90ff);
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 12px;
    padding: 12px;
    transition: 0.3s;
}

.btn-custom:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 18px rgba(0,0,0,0.3);
}

.footer-link {
    text-align: center;
    margin-top: 15px;
}

.footer-link a {
    color: #004aad;
    font-weight: bold;
    text-decoration: none;
}

.footer-link a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<!-- Video de fondo -->
<video autoplay muted loop id="bgVideo">
    <source src="https://www.shutterstock.com/shutterstock/videos/1106893489/preview/stock-footage-map-of-honduras-in-the-old-style-brown-graphics-in-retro-fantasy-style-perfect-for-intro-or-video.webm" type="video/webm">
    Tu navegador no soporta videos de fondo.
</video>

<!-- Tarjeta de registro flotante -->
<div class="card">
    <h3 class="mb-3"><i class="fa-solid fa-user-plus"></i> Registro de Usuario</h3>
    <?php if($mensaje) { ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php } ?>
    <form method="POST">
        <div class="mb-3">
            <label><i class="fa-solid fa-user"></i> Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Tu nombre completo" required>
        </div>
        <div class="mb-3">
            <label><i class="fa-solid fa-envelope"></i> Correo</label>
            <input type="email" name="correo" class="form-control" placeholder="ejemplo@correo.com" required>
        </div>
        <div class="mb-3">
            <label><i class="fa-solid fa-lock"></i> Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="********" required>
        </div>
        <button type="submit" name="registro" class="btn btn-custom w-100">Registrarse</button>
    </form>
    <div class="footer-link">
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>

</body>
</html>
