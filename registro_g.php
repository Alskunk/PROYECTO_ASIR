<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$fecha=$_POST['fecha'];
$Nombre=$_POST['nombre'];
$P_Apellido=$_POST['primer_apellido'];
$glucosa_m=$_POST['glucosa_m'];
$insulina_m=$_POST['insulina_m'];
$glucosa_a=$_POST['glucosa_a'];
$insulina_a=$_POST['insulina_a'];
$glucosa_c=$_POST['glucosa_c'];
$insulina_c=$_POST['insulina_c'];
$glucosa_t=$_POST['glucosa_t'];
$insulina_t=$_POST['insulina_t'];
$glucosa_ce=$_POST['glucosa_ce'];
$insulina_ce=$_POST['insulina_ce'];
$observaciones=$_POST['observaciones'];

$consulta = "select * from USUARIOS where Nombre='$Nombre' and Primer_apellido='$P_Apellido'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_assoc($resultado);
$id = $fila['usuario_id'];
$consulta3 = "select * from REGISTROS_INSULINA where fecha='$fecha' and usuario_id='$id'";
$resultado3 = mysqli_query($conexion, $consulta3);
$fila3 = mysqli_fetch_assoc($resultado3);
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style9.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>Registroglucosa</title>
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
                                GLUCOSA
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
        
       
        if ($fila3['fecha'] != $fecha) {
           
  
            $insertar="INSERT INTO REGISTROS_INSULINA (usuario_id, fecha, glucosa_manana, insulina_manana, glucosa_almuerzo, insulina_almuerzo,
             glucosa_comida, insulina_comida, glucosa_tarde, insulina_tarde, glucosa_cena, insulina_cena, OBSERVACIONES)
            select (select usuario_id from USUARIOS where Nombre='$Nombre' and Primer_apellido='$P_Apellido'), '$fecha', '$glucosa_m', 
            '$insulina_m', '$glucosa_a', '$insulina_a', '$glucosa_c', '$insulina_c', '$glucosa_t', '$insulina_t', '$glucosa_ce', '$insulina_ce','$observaciones'";
            $datos = mysqli_query($conexion, $insertar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
            }
        elseif ($glucosa_m > '0' or $insulina_m > '0') {
                $modificar= "UPDATE REGISTROS_INSULINA SET glucosa_manana='$glucosa_m', insulina_manana='$insulina_m', 
                OBSERVACIONES=CONCAT(OBSERVACIONES, ' $observaciones') where fecha = '$fecha' and usuario_id = '$id'";
                $datos2 = mysqli_query($conexion, $modificar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
        }
        elseif ($glucosa_a > '0' or $insulina_a > '0') {
                $modificar= "UPDATE REGISTROS_INSULINA SET glucosa_almuerzo='$glucosa_a', insulina_almuerzo='$insulina_a', 
                OBSERVACIONES=CONCAT(OBSERVACIONES, ' $observaciones')
                where fecha = '$fecha' and usuario_id = '$id'";
                $datos2= mysqli_query($conexion, $modificar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
        }
        elseif ($glucosa_c > '0' or $insulina_c > '0') {
                $modificar= "UPDATE REGISTROS_INSULINA SET glucosa_comida='$glucosa_c', insulina_comida='$insulina_c', 
                OBSERVACIONES=CONCAT(OBSERVACIONES, ' $observaciones') where fecha = '$fecha' and usuario_id = '$id'";
                $datos2 = mysqli_query($conexion, $modificar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
        }
        elseif ($glucosa_t > '0' or $insulina_t > '0') {
                $modificar= "UPDATE REGISTROS_INSULINA SET glucosa_tarde='$glucosa_t', insulina_tarde='$insulina_t', 
                OBSERVACIONES=CONCAT(OBSERVACIONES, ' $observaciones') where fecha = '$fecha' and usuario_id = '$id'";
                $datos2 = mysqli_query($conexion, $modificar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
        }
        elseif ($glucosa_ce > '0' or $insulina_ce > '0') {
                $modificar= "UPDATE REGISTROS_INSULINA SET glucosa_cena='$glucosa_ce', insulina_cena='$insulina_ce', 
                OBSERVACIONES=CONCAT(OBSERVACIONES, ' $observaciones') where fecha = '$fecha' and usuario_id = '$id'";
                $datos2 = mysqli_query($conexion, $modificar);
                if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("REGISTRO AÑADIDO");
                echo "</div>";
                echo "</div>";   
                }
        }
        $consulta = "SELECT U.Nombre, U.Primer_apellido, R.insulina_id, R.usuario_id, R.fecha, R.glucosa_manana, R.insulina_manana, R.glucosa_almuerzo, 
                R.insulina_almuerzo, R.glucosa_comida, R.insulina_comida, R.glucosa_tarde, R.insulina_tarde, R.glucosa_cena, R.insulina_cena, R.OBSERVACIONES 
                FROM USUARIOS U JOIN REGISTROS_INSULINA R ON U.usuario_id = R.usuario_id 
                WHERE U.Nombre = '$Nombre' and U.Primer_apellido = '$P_Apellido' and R.fecha = '$fecha'"; 
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                                echo "ID_Insulina";
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
                                echo "Fechas";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa mañana";  
                        echo "<th>";
                                echo "Insulina mañana";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa almuerzo";
                        echo "</th>";
                        echo "<th>";
                                echo "Insulina almuerzo";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa comida";
                        echo "</th>";
                        echo "<th>";
                                echo "Insulina comida";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa tarde";
                        echo "</th>";
                        echo "<th>";
                                echo "Insulina tarde";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa cena";
                        echo "</th>";
                        echo "<th>";
                                echo "Insulina cena";
                        echo "</th>";
                        echo "<th>";
                                echo "Observaciones";
                        echo "</th>";
                        
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila['insulina_id'];
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
                                echo $fila['fecha'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['glucosa_manana'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['insulina_manana'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['glucosa_almuerzo'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['insulina_almuerzo'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['glucosa_comida'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['insulina_comida'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['glucosa_tarde'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['insulina_tarde'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['glucosa_cena'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['insulina_cena'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['OBSERVACIONES'];
                        echo "</td>";
                        
                        
                echo "</tr>";
                echo "</table>";
        mysqli_close($conexion);
        ?>
                
                
               
        </section>
                
        </body>
</hmtl>