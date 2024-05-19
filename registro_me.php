<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$PRESCRIPCION_ID=$_POST['idpauta'];
$medicacion_id=$_POST['idmedi'];
$Cantidad=$_POST['cantidad'];
$Toma=$_POST['toma'];
$Observaciones=$_POST['observaciones'];

?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style16.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>registromedicacion</title>
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
        $insertar="INSERT INTO REGISTROS_MEDICACION (PRESCRIPCION_ID, FECHA_ADMINISTRAR, TOMA, OBSERVACIONES)
        values ('$PRESCRIPCION_ID', CURDATE(), '$Toma', '$Observaciones')";
        $datos = mysqli_query($conexion, $insertar);
                if ($Toma == 'si') {
        $update = "UPDATE MEDICAMENTO SET stock=(stock-'$Cantidad') where medicacion_id='$medicacion_id'";
        $datos3 = mysqli_query($conexion, $update);
                }
        if (mysqli_errno($conexion)==0){
            echo "<div class='bloque1'>";
            echo "<div class='contenedor1'>";       
            echo("REGISTRO AÑADIDO");
            echo "</div>";
            echo "</div>";
            
        }
        $consulta="SELECT * FROM MEDICAMENTO WHERE medicacion_id='$medicacion_id'";
        $datos2 = mysqli_query($conexion, $consulta);
        $fila = mysqli_fetch_assoc($datos2);
        $usuario_id =$fila['usuario_id'];
        $medicacion=$fila['Medicamento'];
        $stock=$fila['stock'];
            if ($fila['stock'] < 10) {
                
                echo "<div class='bloque1'>";
                echo "<div class='contenedor1'>";       
                echo "El stock de $medicacion";
                echo "&nbsp;"; 
                echo "es $stock";
                echo "</div>";
                echo "</div>";


            }

            mysqli_close($conexion);
        ?>
                
                <a href="https://www.alskunk.es/registromedicacion.php"><button>Volver</button></a>         
               
        </section>
                
        </body>
</hmtl>