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

$cantidad=$_POST['cantidad'];
$turno=$_POST['turno'];
$stock=$_POST['stock'];
$observaciones=$_POST['observaciones'];
$consulta5 = "select * from USUARIOS where Nombre='$Nombre' and Primer_apellido='$P_Apellido'";
$resultado5 = mysqli_query($conexion, $consulta5);
$fila3 = mysqli_fetch_assoc($resultado5);
$usuario_id=$fila3['usuario_id'];
$consulta = "SELECT U.*, M.Medicamento, M.medicacion_id, M.activo 
from USUARIOS U
LEFT JOIN MEDICAMENTO M ON M.usuario_id = U.usuario_id
where Nombre='$Nombre' and Primer_apellido='$P_Apellido' and M.Medicamento='$medicacion'";
$resultado = mysqli_query($conexion, $consulta);
$fila6 = mysqli_fetch_assoc($resultado);

$med_id=$fila6['medicacion_id'];

?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style9.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>Insetarpauta</title>
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
                                PAUTAS
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
        
        if ($fila3['Nombre'] != $Nombre and $fila3['Primer_apellido'] != $P_Apellido) {
        echo "<div class='bloque1'>";
            echo "<div class='contenedor1'>";
            
            echo "El usuario no existe";
            echo "</div>";
        echo "</div>";
        }
        elseif (isset($med_id) ) {
                
                        $consulta = "SELECT U.Nombre, U.Primer_apellido, M.medicacion_id, M.usuario_id, M.Medicamento, M.stock
                        FROM USUARIOS U JOIN MEDICAMENTO M ON U.usuario_id = M.usuario_id WHERE U.Nombre = '$Nombre' 
                        and U.Primer_apellido = '$P_Apellido' and M.Medicamento = '$medicacion' and M.activo is NULL"; 
                        $resultado = mysqli_query($conexion, $consulta);
                        $fila = mysqli_fetch_assoc($resultado);
                        $medica= $fila['medicacion_id'];
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
                                        echo "Medicamento";
                                echo "</th>";
                                echo "<th>";
                                        echo "Stock";
                                echo "</th>";
                                
                                
                        echo "</tr>";
                        echo "<tr>";
                                echo "<td>"; 
                                        echo $fila['medicacion_id'];
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
                                        echo $fila['Medicamento'];
                                echo "</td>";
                                echo "<td>"; 
                                        echo $fila['stock'];
                                echo "</td>";
                                
                                
                                
                        echo "</tr>";
                        echo "</table>";
        
                        if (mysqli_errno($conexion)==0){
                                
                        $insertar2="INSERT INTO PRESCRIPCIONES (usuario_id, medicacion_id, FECHA_INICIO, CANTIDAD_PRES, TURNO, OBSERVACIONES)
            values ('$usuario_id', '$medica', '$F_Inicio', '$cantidad', '$turno', '$observaciones')";
            $datos2 = mysqli_query($conexion, $insertar2);
            $consulta2 = "SELECT U.Nombre, U.Primer_apellido, P.PRESCRIPCION_ID, P.usuario_id, P.medicacion_id, P.FECHA_INICIO, P.CANTIDAD_PRES, P.TURNO, P.OBSERVACIONES
                FROM USUARIOS U JOIN PRESCRIPCIONES P ON U.usuario_id = P.usuario_id WHERE U.Nombre = '$Nombre' 
                and U.Primer_apellido = '$P_Apellido' and P.medicacion_id = '$medica' and P.TURNO = '$turno'"; 
                $resultado2 = mysqli_query($conexion, $consulta2);
                $fila2 = mysqli_fetch_assoc($resultado2);
                
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                                echo "PRESCRIPCION_ID";
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
                                echo "Medicacion_id";
                        echo "</th>";
                        echo "<th>";
                                echo "FECHA INICIO";
                        echo "</th>";
                        echo "<th>";
                                echo "CANTIDAD PRESCRITA";
                        echo "</th>";
                        echo "<th>";
                                echo "TURNO";
                        echo "</th>";
                        echo "<th>";
                                echo "OBSERVACIONES";
                        echo "</th>";
                        
                        
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila2['PRESCRIPCION_ID'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['usuario_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['medicacion_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['FECHA_INICIO'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['CANTIDAD_PRES'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['TURNO'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['OBSERVACIONES'];
                        echo "</td>";
                        
                        
                        
                echo "</tr>";
                echo "</table>";
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("Registro AÑADIDO");
                echo "</div>";
                echo "</div>";

                }
        }
        
        
        else {
            $insertar="INSERT INTO MEDICAMENTO (usuario_id, Medicamento, stock)
            values ('$usuario_id', '$medicacion', '$stock')";
            $datos = mysqli_query($conexion, $insertar);
            if (mysqli_errno($conexion)==0){
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo("Registro AÑADIDO");
                echo "</div>";
                echo "</div>";
                $consulta = "SELECT U.Nombre, U.Primer_apellido, M.medicacion_id, M.usuario_id, M.Medicamento, M.stock
                FROM USUARIOS U JOIN MEDICAMENTO M ON U.usuario_id = M.usuario_id WHERE U.Nombre = '$Nombre' 
                and U.Primer_apellido = '$P_Apellido' and M.Medicamento = '$medicacion' and M.activo is NULL"; 
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
                $medica= $fila['medicacion_id'];
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
                                echo "Medicamento";
                        echo "</th>";
                        echo "<th>";
                                echo "Stock";
                        echo "</th>";
                        
                        
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila['medicacion_id'];
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
                                echo $fila['Medicamento'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila['stock'];
                        echo "</td>";
                        
                        
                        
                echo "</tr>";
                echo "</table>";

                }
                $insertar2="INSERT INTO PRESCRIPCIONES (usuario_id, medicacion_id, FECHA_INICIO, CANTIDAD_PRES, TURNO, OBSERVACIONES)
            values ('$usuario_id', '$medica', '$F_Inicio', '$cantidad', '$turno', '$observaciones')";
            $datos2 = mysqli_query($conexion, $insertar2);
            $consulta2 = "SELECT U.Nombre, U.Primer_apellido, P.PRESCRIPCION_ID, P.usuario_id, P.medicacion_id, P.FECHA_INICIO, P.CANTIDAD_PRES, P.TURNO, P.OBSERVACIONES
                FROM USUARIOS U JOIN PRESCRIPCIONES P ON U.usuario_id = P.usuario_id WHERE U.Nombre = '$Nombre' 
                and U.Primer_apellido = '$P_Apellido' and P.medicacion_id = '$medica'"; 
                $resultado2 = mysqli_query($conexion, $consulta2);
                $fila2 = mysqli_fetch_assoc($resultado2);
                
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                                echo "PRESCRIPCION_ID";
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
                                echo "Medicacion_id";
                        echo "</th>";
                        echo "<th>";
                                echo "FECHA INICIO";
                        echo "</th>";
                        echo "<th>";
                                echo "CANTIDAD PRESCRITA";
                        echo "</th>";
                        echo "<th>";
                                echo "TURNO";
                        echo "</th>";
                        echo "<th>";
                                echo "OBSERVACIONES";
                        echo "</th>";
                        
                        
                echo "</tr>";
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila2['PRESCRIPCION_ID'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['usuario_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['medicacion_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['FECHA_INICIO'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['CANTIDAD_PRES'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['TURNO'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['OBSERVACIONES'];
                        echo "</td>";
                        
                        
                        
                echo "</tr>";
                echo "</table>";

        }
        mysqli_close($conexion);
        ?>
                
                
               
        </section>
                
        </body>
</hmtl>