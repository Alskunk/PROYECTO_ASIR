<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$Nombre=$_POST['nombre'];
$P_Apellido=$_POST['primer_apellido'];
$medicacion=$_POST['medicacion'];
$F_Inicio=$_POST['f_inicio'];
$F_Fin=$_POST['f_fin'];
$cantidad=$_POST['cantidad'];
$hora=$_POST['hora'];
$observaciones=$_POST['observaciones'];

$consulta = "select * from USUARIOS where Nombre='$Nombre' and Primer_apellido='$P_Apellido'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_assoc($resultado);
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style9.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>Medicación esporadica</title>
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
                                ESPORÁDICA
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
        
       
            $insertar="INSERT INTO MEDICACION_ESPORADICA (usuario_id, fecha_inicio, fecha_fin, medicamento, hora, cantidad, observaciones)
            select (select usuario_id from USUARIOS where Nombre='$Nombre' and Primer_apellido='$P_Apellido'), '$F_Inicio', '$F_Fin', 
            '$medicacion', '$hora', '$cantidad', '$observaciones'";
            $datos = mysqli_query($conexion, $insertar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";
                $consulta = "SELECT U.Nombre, U.Primer_apellido, E.esporadica_id, E.usuario_id, E.fecha_inicio, E.fecha_fin, E.medicamento, E.hora, E.cantidad, E.observaciones 
                FROM USUARIOS U JOIN MEDICACION_ESPORADICA E ON U.usuario_id = E.usuario_id WHERE U.Nombre = '$Nombre' 
                and U.Primer_apellido = '$P_Apellido' and E.fecha_inicio = '$F_Inicio'"; 
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                                echo "ID_Medicación";
                        echo "</th>";
                        echo "<th>";
                                echo "ID_Usuario";
                        echo "</th>";
                        echo "<th>";
                                echo "Nombre";
                        echo "</th>";
                        echo "<th>";
                                echo "Primer apellido";
                        echo "</th>";
                        echo "<th>";
                                echo "Fechas de inicio";
                        echo "</th>";
                        echo "<th>";
                                echo "Fecha fin";
                        echo "</th>";
                        echo "<th>";
                                echo "Medicamento";
                        echo "</th>";
                        echo "<th>";
                                echo "Hora";
                        echo "</th>";
                        echo "<th>";
                                echo "Cantidad";
                        echo "</th>";
                        echo "<th>";
                                echo "Observaciones";
                        echo "</th>";
                        
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila['esporadica_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['usuario_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['fecha_inicio'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['fecha_fin'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['medicamento'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['hora'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['cantidad'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['observaciones'];
                        echo "</td>";
                        
                        
                echo "</tr>";
                echo "</table>";

                }
        
        mysqli_close($conexion);
        ?>
                
                
               
        </section>
                
        </body>
</hmtl>