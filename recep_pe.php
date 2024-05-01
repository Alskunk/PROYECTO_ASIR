<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$pedido_id=$_POST['idpedido'];
$medicacion_id=$_POST['idmedi'];
$usuario=$_POST['usuario_id'];
$Cantidad=$_POST['cantidad'];
$fecha=$_POST['fecha'];

?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style9.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>receppedido</title>
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
                                PEDIDOS
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
        $insertar="UPDATE PEDIDOS SET fecha_recepcion='$fecha' where pedidos_id='$pedido_id'";
        $datos = mysqli_query($conexion, $insertar);
        $update = "UPDATE MEDICAMENTO SET stock=stock+'$Cantidad' where medicacion_id='$medicacion_id'";
        $datos3 = mysqli_query($conexion, $update);
        if (mysqli_errno($conexion)==0){
            echo "<div class='bloque1'>";
            echo "<div class='contenedor1'>";       
            echo("REGISTRO AÑADIDO");
           
            echo "</div>";
            echo "</div>";
            
       
            
                $consulta2 = "SELECT U.Nombre, U.Primer_apellido, M.Medicamento, M.stock, P.pedidos_id, P.medicacion_id, P.fecha_pedido, P.fecha_recepcion 
                FROM PEDIDOS P
                LEFT JOIN MEDICAMENTO M ON M.medicacion_id =  P.medicacion_id
                LEFT JOIN USUARIOS U ON U.usuario_id =  P.usuario_id
                where P.pedidos_id = '$pedido_id' "; 
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                echo "<table class='result' border='1'>";
                echo "<tr>";
                        echo "<th>";
                            echo "Pedido_id";
                        echo "</th>";
                        echo "<th>";
                                echo "Medicación_id";
                        echo "</th>";
                        echo "<th>";
                                echo "Medicación";
                        echo "</th>";
                        echo "<th>";
                                echo "Nombre";
                        echo "</th>";
                        echo "<th>";
                                echo "Primer apellido";
                        echo "</th>";
                        echo "<th>";
                                echo "Fecha pedido";
                        echo "</th>";
                        echo "<th>";
                                echo "Fecha recepción";
                        echo "</th>";
                        echo "<th>";
                                echo "Stock";
                        echo "</th>";
                        
                        
                        
                echo "</tr>";
                while ($fila2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC)) {
                echo "<tr>";
                        echo "<td>"; 
                            echo $fila2['pedidos_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['medicacion_id'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Medicamento'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Nombre'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['Primer_apellido'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['fecha_pedido'];
                        echo "</td>";
                        echo "<td>"; 
                        echo $fila2['fecha_recepcion'];
                echo "</td>";
                        echo "<td>"; 
                                echo $fila2['stock'];
                        echo "</td>";
                        
                        
                        
                        
                echo "</tr>";
                }
                echo "</table>";
        }    
                
                
                
                
         

            mysqli_close($conexion);
        ?>
                
                
               
        </section>
                
        </body>
</hmtl>