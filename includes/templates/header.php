<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

/* var_dump($auth); */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public">
                    <img src="/public/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/public/build/img/dark-mode.svg" alt="">
                    <nav class="navegacion">
                        <a href="/public/nosotros.php">Nosotros</a>
                        <a href="/public/anuncios.php">Anuncios</a>
                        <a href="/public/blog.php">Blog</a>
                        <a href="/public/contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/public/cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>

            <?php if ($inicio) : ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php endif; ?>
        </div>
    </header>