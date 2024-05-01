<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$ID=$_GET['usuario_id'];
$consulta = "select * from USUARIOS WHERE usuario_id= '$ID'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_assoc($resultado);
$nombre = $fila['Nombre'];
$apellido = $fila['Primer_apellido'];
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style3.css">
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
                <section class='container'>
                        <form method="POST" action="registro_g.php">
                                
                                Fecha:<br/> <input type="date" name="fecha" placeholder="AAAA-MM-DD"/> <br/><br/>
                                
                                Nombre:<br/> <input type="text" name="nombre" value="<?php echo $nombre?>"/> <br/>
                                
                                1º apellido:<br/> <input type="text" name="primer_apellido" value="<?php echo $apellido?>"/> <br/><br/>
                                
                                Glucosa mañana:<br/> <input type="text" name="glucosa_m" value="0" placeholder="glucosa mañana"/><br/>
                                 
                                Insulina mañana:<br/> <input type="text" name="insulina_m" value="0" placeholder="Insulina mañana"/> <br/><br/>
                                        
                                Glucosa almuerzo:<br/> <input type="text" name="glucosa_a" value="0"  placeholder="glucosa almuerzo"/> <br/>
                                
                                Insulina almuerzo:<br/> <input type="text" name="insulina_a" value="0" placeholder="Insulina almuerzo"/> <br/><br/>
                                
                                Glucosa comida:<br/> <input type="text" name="glucosa_c" value="0" placeholder="glucosa comida"/> <br/>
                               
                                Insulina comida:<br/> <input type="text" name="insulina_c" value="0" placeholder="Insulina comida"/> <br/><br/>
                                
                                Glucosa tarde:<br/> <input type="text" name="glucosa_t" value="0" placeholder="glucosa tarde"/> <br/>
                               
                                Insulina tarde:<br/> <input type="text" name="insulina_t" value="0" placeholder="Insulina tarde"/> <br/><br/>
                               
                                Glucosa cena:<br/> <input type="text" name="glucosa_ce" value="0" placeholder="glucosa cena"/> <br/>
                               
                                Insulina cena:<br/> <input type="text" name="insulina_ce" value="0" placeholder="Insulina cena"/> <br/><br/>
                                
                                Observaciones:<br/><br/>
                                <textarea name="observaciones" rows="4" cols="30"></textarea><br/><br/>
                                
                                <button type="submit">Enviar</button>&nbsp;&nbsp;
                                <button type="reset">Borrar</button>
                                
                                
                        </form>
                
                        
                </section>
                
        </body>
</html>