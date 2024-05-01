<!DOCTYPE html>
<html>
    <head>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="styles/Style.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
       integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <title>Inicio de sesión</title>
</head>
<body>
    <form action="" method="POST">
        <?php
        include "modelo/conexion.php";
        include "controlador/controlador_login.php";
        ?>
        <h1>INICIAR SESION</h1>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="test" name="usuario" placeholder="Nombre de usuario">
        <i class="fa-solid fa-unlock"></i>
        <label>Password</label>
        <input type="test" name="password" placeholder="Password">
        <hr>
        <input name="ingresar" type="submit" value="INICIAR SESION">
    </form>
</body>
</html>