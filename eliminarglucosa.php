<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";

?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style8.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>eliminarglucosa</title>
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
                <form method="POST" action="eliminar_g.php">
                        <fieldset>
                        <div class="formulario">
                    Seleccione la ID del registro que quiere eliminar:&nbsp;&nbsp; <input type="text" name="id" /> &nbsp;&nbsp;
                                
                                <button type="submit">Enviar</button>&nbsp;&nbsp;
			        <button type="reset">Borrar</button>
                        </div>
                                </fieldset>

                        </form>
                <?php
        
       
            
                $consulta2 = "SELECT U.Nombre, U.Primer_apellido, I.insulina_id, I.usuario_id, I.fecha, I.glucosa_manana, I.insulina_manana, I.glucosa_almuerzo, 
                I.insulina_almuerzo, I.glucosa_comida, I.insulina_comida, I.glucosa_tarde, I.insulina_tarde, I.glucosa_cena, 
                I.insulina_cena, I.OBSERVACIONES 
                FROM USUARIOS U, REGISTROS_INSULINA I where U.usuario_id = I.usuario_id "; 
                $resultado2 = mysqli_query($conexion, $consulta2);
                
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
                                echo "Fecha";
                        echo "</th>";
                        echo "<th>";
                                echo "Glucosa mañana";
                        echo "</th>";
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
                while ($fila2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC)) {
                echo "<tr>";
                        echo "<td>"; 
                                echo $fila2['insulina_id'];
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
                                echo $fila2['fecha'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['glucosa_manana'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['insulina_manana'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['glucosa_almuerzo'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['insulina_almuerzo'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['glucosa_comida'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['insulina_comida'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['glucosa_tarde'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['insulina_tarde'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['glucosa_cena'];
                        echo "</td>";
                        echo "<td>"; 
                                echo $fila2['insulina_cena'];
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
                
</hmtl>