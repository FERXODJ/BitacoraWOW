<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'restaurantes';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Obtener los restaurantes
$stmt = $pdo->query("SELECT * FROM restaurante");
$restaurants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home de Restaurantes</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        /* Estilos para el botón de cerrar sesión */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #ff1a1a;
        }

        header {
            position: relative;
        }
    </style>
</head>
<body>
    <header>
        <img src="P01.png" alt="Encabezado">
        <h1>Descubre los Mejores Restaurantes</h1>
        <form action="CerrarSesion.php" method="POST" style="display:inline;">
            <button type="submit" class="logout-button">Cerrar Sesión</button>
        </form>
    </header>

    <main>
        <h2>Elige un Restaurante</h2>
        <div class="restaurant-options">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="restaurant-card">
                    <h3><?php echo htmlspecialchars($restaurant['Nombre_Restaurante']); ?></h3>
                    <button onclick="showMenu(<?php echo $restaurant['Id']; ?>)">Ver Menú</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="menu" style="display:none;">
            <h2>Menú</h2>
            <div id="menu-items"></div>
        </div>
    </main>

    <script>
        function showMenu(restaurantId) {
            // Hacer una solicitud AJAX para obtener el menú
            fetch(`get_menu.php?id=${restaurantId}`)
                .then(response => response.json())
                .then(data => {
                    const menuItemsDiv = document.getElementById('menu-items');
                    menuItemsDiv.innerHTML = '';

                    data.forEach(item => {
                        const itemDiv = document.createElement('div');
                        itemDiv.innerHTML = `<h4>${item.name}</h4><p>${item.description}</p><p>Precio: $${item.price}</p>`;
                        menuItemsDiv.appendChild(itemDiv);
                    });

                    document.getElementById('menu').style.display = 'block';
                });
        }
    </script>
</body>
</html>