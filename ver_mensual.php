<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$nombre=$_POST['nombre'];
$apellido=$_POST['primer_apellido'];
$finicio=$_POST['fechai'];
$ffin=$_POST['fechaf'];
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style6.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>registromensual</title>
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
                                REGISTROS
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
        
       
            
                $consulta2 = "SELECT U.Nombre, U.Primer_apellido, R.FECHA_ADMINISTRAR, R.TOMA, R.OBSERVACIONES, P.TURNO, M.Medicamento
                FROM USUARIOS U
                LEFT JOIN MEDICAMENTO M ON M.usuario_id =  U.usuario_id
                LEFT JOIN PRESCRIPCIONES P ON P.medicacion_id =  M.medicacion_id
                LEFT JOIN REGISTROS_MEDICACION R ON R.PRESCRIPCION_ID =  P.PRESCRIPCION_ID
                where U.Nombre = '$nombre' and U.Primer_apellido = '$apellido' and R.FECHA_ADMINISTRAR >= '$finicio' and  R.FECHA_ADMINISTRAR <= '$ffin'"; 
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        
                        echo "<th>";
                                echo "Nombre";
                        echo "</th>";
                        echo "<th>";
                                echo "Primer apellido";
                        echo "</th>";
                        echo "<th>";
                                echo "Fecha";
                        echo "</th>";
                        echo "<th>";
                                echo "Medicación";
                        echo "</th>";
                        echo "<th>";
                                echo "Turno";
                        echo "</th>";
                        echo "<th>";
                                echo "Toma";
                        echo "</th>";
                        echo "<th>";
                                echo "Observaciones";
                        echo "</th>";
                        
                        
                echo "</tr>";
                while ($fila2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC)) {
                echo "<tr>";
                        
                        echo "<td>"; 
                                echo $fila2['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['FECHA_ADMINISTRAR'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Medicamento'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['TURNO'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['TOMA'];
                        echo "</td>";
                        
                        echo "<td>"; 
                                echo $fila2['OBSERVACIONES'];
                        echo "</td>";
                        
                        
                echo "</tr>";
                }
                echo "</table>";

                
        
        
?>
                
          
               
        </section>
        <?php mysqli_close($conexion); ?>
                
        </body>
</hmtl>