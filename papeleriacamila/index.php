<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Control</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>

<style>
/* Estilo Global */
body {
    font-family: 'Comic Sans MS', cursive, sans-serif; /* Fuente divertida y adorable */
    background-color: #ffebf6; /* Fondo rosa pastel */
    color: #4a4a4a; /* Texto gris oscuro para buen contraste */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}

/* Contenedor principal */
.dashboard-container {
    width: 100%;
    max-width: 800px;
    padding: 30px;
    background: #fff0f5; /* Fondo blanco rosado */
    border-radius: 20px; /* Bordes redondeados */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
    border: 3px solid #ffb6c1; /* Borde rosa pastel */
}

/* Título del Dashboard */
.dashboard-container h2 {
    font-size: 2.5rem;
    color: #ff69b4; /* Rosa brillante */
    font-weight: 900;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase; /* Títulos en mayúsculas */
    letter-spacing: 2px;
    text-shadow: 2px 2px 5px rgba(255, 182, 193, 0.6); /* Sombra luminosa */
}

/* Estilo de las tarjetas */
.card {
    background: #fff; /* Fondo blanco */
    border-radius: 15px;
    padding: 25px;
    width: 100%;
    max-width: 300px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Sombra ligera */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    border: 3px solid #ffb6c1; /* Borde rosa pastel */
    position: relative;
}

.card::after {
    content: '🌸'; /* Agrega un emoji de flor como fondo */
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 5rem;
    color: rgba(255, 182, 193, 0.2);
    pointer-events: none;
}

.card:hover {
    transform: translateY(-5px); /* Eleva la tarjeta al pasar el mouse */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Sombra más definida */
}

.card h3 {
    color: #ff69b4; /* Rosa brillante */
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.card p {
    color: #6a6a6a; /* Gris suave */
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 15px;
    font-style: italic;
}

/* Botones dentro de las tarjetas */
.card a {
    padding: 12px 20px;
    background-color: #ffb6c1; /* Rosa pastel */
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 20px;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.card a:hover {
    background-color: #ff69b4; /* Rosa más brillante */
}

/* Botón de cerrar sesión */
.logout {
    padding: 12px 25px;
    background-color: #ffd1dc; /* Rosa muy claro */
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    border-radius: 20px;
    text-align: center;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

.logout:hover {
    background-color: #ff69b4; /* Rosa más vibrante */
}

/* Ajustes para dispositivos pequeños */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 20px;
        gap: 15px;
    }

    .card {
        max-width: 100%;
        padding: 20px;
    }

    .card a {
        padding: 10px 20px;
    }

    .logout {
        padding: 10px 20px;
    }
}
</style>

<body>
    <div class="dashboard-container">
        <h2>¡Bienvenido! 🌸</h2>
        <div class="card">
            <h3>Catálogo de productos</h3>
            <p>¡Explora nuestro catálogo adorable! 🛍️</p>
            <a href="catalogo.php">Ver Catálogo</a>
        </div>
        <!-- Enlace para cerrar sesión -->
        <a class="logout" href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
