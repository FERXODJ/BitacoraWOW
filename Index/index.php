<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<form action="inicioSesion.php" method ="POST">

    <!-- Logo -->
    <img src="LOGO.png" alt="Pedidos Ya" style="display: block; margin: 0 auto; width: 100px; height: auto;">

    <h1>Iniciar Sesion</h1>
    <hr>

    <?php
        if(isset($_GET['error'])){
            ?>
            <p class ="error">
                <?php 
                    echo $_GET['error'];
                ?>
            </p>      
    <?php        
        }
    ?>

    <hr>

    <i class="fa-solid fa-user"></i>
    <label> Usuario</label>
    <input type="text" name="Usuario" placeholder = "Nombre de Usuario">

    <i class="fa-solid fa-unlock"></i>
    <label> Clave</label>
    <input type="password" name="Clave" placeholder = "Clave">

    <hr>
    <button type = "submit">Iniciar Sesion</button>
    <a href="registro.php">Crear Cuenta</a>
</form>
    
</body>
</html>