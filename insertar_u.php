<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$DNI=$_POST['DNI'];
$Nombre=$_POST['nombre'];
$P_Apellido=$_POST['primer_apellido'];
$S_Apellido=$_POST['segundo_apellido'];
$F_Nacimiento=$_POST['f_nacimiento'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$centro=$_POST['centro'];
$paracetamol=$_POST['paracetamol'];
$alergias=$_POST['alergias'];
$glucosa= $_POST['glucosa'];

$consulta = "select * from USUARIOS where DNI='".$DNI."'";  
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_assoc($resultado);
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style9.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>Insertarusuario</title>
        </head>
        <body>
              <header>
                        <nav>
                                <ul class="sidebar">
                                        <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                                        <li><a href="https://www.alskunk.es/inicio.php">Inicio</a></li>
                                        <li><a href="https://www.alskunk.es/usuarios.php">Usuarios</a></li>
                                        <li><a href="https://www.alskunk.es/m_esporadica.php">Esporádica</a></li>
                                        <li><a href="https://www.alskunk.es/glucosa.php">Glucosa</a></li>
                                        <li><a href="https://www.alskunk.es/pautas.php">Pautas</a></li>
                                        <li><a href="https://www.alskunk.es/stock.php">Stock</a></li>
                                        <li><a href="https://www.alskunk.es/registros.php">Registros</a></li>
                                        <li><a href="https://www.alskunk.es/pedidos.php">Pedidos</a></li>
                                </ul>
                                <ul>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/inicio.php">Inicio</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/usuarios.php">Usuarios</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/m_esporadica.php">Esporádica</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/glucosa.php">Glucosa</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/pautas.php">Pautas</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/stock.php">Stock</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/registros.php">Registros</a></li>
                                        <li class="hideOnMobile"><a href="https://www.alskunk.es/pedidos.php">Pedidos</a></li>
                                        <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                                </ul>
                        </nav>
                        <script>
                                function showSidebar(){
                                        const sidebar = document.querySelector('.sidebar')
                                        sidebar.style.display = 'flex'
                                }
                                function hideSidebar(){
                                        const sidebar = document.querySelector('.sidebar')
                                        sidebar.style.display = 'none'
                                }
                        </script>
                        <div class="inicio">
                                USUARIOS
                        </div>
                        <div class="usuario">
                        Usuario registrado: </br>
                        <i class="fa-solid fa-user"></i>
                        <?php 
                                echo $_SESSION["Nombre"]. " " . $_SESSION["Primer_apellido"];
                        ?>
                        </div>
                        <div class="logo">
                                <a href="https://www.alskunk.es/login.php"><img src="/imagenes/logo.png" alt="logo"/></a>
                        </div>
                       
                </header>
 <section class="container">
        <?php
        
        if ($fila['DNI'] == $DNI) {
        echo "<div class='bloque1'>";
            echo "<div class='contenedor1'>";
            
            echo "El usuario ya existe";
            echo "</div>";
        echo "</div>";
        }
        else {
            $insertar="INSERT INTO USUARIOS (DNI, Nombre, Primer_apellido, Segundo_Apellido, Fecha_nacimiento, telefono, centro, alergias, paracetamol, email, glucosa)
            values ('$DNI', '$Nombre', '$P_Apellido', '$S_Apellido', '$F_Nacimiento', '$telefono', '$centro', '$alergias', '$paracetamol', '$email', '$glucosa')";
            $datos = mysqli_query($conexion, $insertar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("Registro AÑADIDO");
                echo "</div>";
                echo "</div>";
                $consulta = "select * from USUARIOS where DNI='".$DNI."'"; 
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                                echo "ID";
                        echo "</th>";
                        echo "<th>";
                                echo "DNI";
                        echo "</th>";
                        echo "<th>";
                                echo "Nombre";
                        echo "</th>";
                        echo "<th>";
                                echo "Primer apellido";
                        echo "</th>";
                        echo "<th>";
                                echo "Segundo apellido";
                        echo "</th>";
                        echo "<th>";
                                echo "Fecha de nacimiento";
                        echo "</th>";
                        echo "<th>";
                                echo "Teléfono";
                        echo "</th>";
                        echo "<th>";
                                echo "Centro";
                        echo "</th>";
                        echo "<th>";
                                echo "Alegias";
                        echo "</th>";
                        echo "<th>";
                                echo "Paracetamol";
                        echo "</th>";
                        echo "<th>";
                                echo "Email";
                        echo "</th>";
						echo "<th>";
                                echo "Glucosa";
                        echo "</th>";
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila['usuario_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['DNI'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Segundo_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Fecha_nacimiento'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['telefono'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['centro'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['alergias'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['paracetamol'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Email'];
                        echo "</td>";
						echo "<td>"; 
                                echo $fila['glucosa'];
                        echo "</td>";
                echo "</tr>";
                echo "</table>";

                }
        }
        mysqli_close($conexion);
?>
                
                
               
        </section>
                
        </body>
</hmtl>