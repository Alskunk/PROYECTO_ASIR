<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$ID=$_GET['PRESCRIPCION_ID'];

$consulta = "SELECT U.Nombre, U.Primer_apellido, P.PRESCRIPCION_ID, M.usuario_id, P.CANTIDAD_PRES, M.Medicamento, M.medicacion_id
                        FROM USUARIOS U  LEFT JOIN MEDICAMENTO M ON M.usuario_id = U.usuario_id  LEFT JOIN PRESCRIPCIONES P ON P.medicacion_id = M.medicacion_id 
                        WHERE P.PRESCRIPCION_ID= '$ID'";
                        $resultado = mysqli_query($conexion, $consulta);
                        $fila = mysqli_fetch_assoc($resultado);
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style5.css">
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
                <section class='container'>
                <form method="POST" action="registro_me.php">
                                
                                <b><?php echo $fila['Nombre'];?>&nbsp;</b>
                                <b><?php echo $fila['Primer_apellido'];?><br/><br/></b>
                                <b><?php echo $fila['Medicamento'];?><br/><br/></b>
                                ID PAUTA:<br/> <input type="text" name="idpauta" value="<?php echo $fila['PRESCRIPCION_ID'];?>"/> <br/><br/>
                                ID MEDICAMENTO:<br/> <input type="text" name="idmedi" value="<?php echo $fila['medicacion_id'];?>"/> <br/><br/>
                                Cantidad prescrita:<br/> <input type="text" name="cantidad" value="<?php echo $fila['CANTIDAD_PRES'];?>"/> <br/><br/>
                                Toma la medicación<br/>
                                <input type="radio" name="toma" value="si">Si<br/>
                                <input type="radio" name="toma" value="ausente">Ausente<br/>
                                <input type="radio" name="toma" value="incidencia">Incidecia<br/><br/>
                                Observaciones:<br/><br/>
                                <textarea name="observaciones" rows="4" cols="20"></textarea><br/><br/>
                                <button type="submit">Enviar</button>&nbsp;&nbsp;
                                <button type="reset">Borrar</button>
                                

                        </form>

            <?php
                mysqli_close($conexion);
            ?>
                
                
               
        </section>
                
        </body>
</hmtl>