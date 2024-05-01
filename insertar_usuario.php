<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
?>
<html>
        <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles/Style3.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>Insertar</title>
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
      <section class='container'>
                        <form method="POST" action="insertar_u.php">
                                
                                DNI:<br/> <input type="text" name="DNI" placeholder="DNI" minlength="9" maxlength="9"/> <br/><br/>
                                Nombre:<br/> <input type="text" name="nombre" placeholder="Nombre"/> <br/><br/>
                                1º apellido:<br/> <input type="text" name="primer_apellido" placeholder="Primer apellido"/> <br/><br/>
                                2ª apellido:<br/> <input type="text" name="segundo_apellido" placeholder="Segundo apellido"/> <br/><br/>
                                Fecha de nacimiento:<br/> <input type="date" name="f_nacimiento" placeholder="AAAA-MM-DD"/> <br/><br/>
                                Teléfono:<br/> <input type="text" name="telefono" placeholder="Telefono"/> <br/><br/>
                                Email:<br/> <input type="text" name="email" placeholder="Email"/> <br/><br/>
                                Centro:<br/>
                                <select name="centro">
                                        <option value="Cad_la_sierra">Cad La Sierra</option>
                                        <option value="Cad_vareia">Cad Vareia</option>
                                        <option value="Residencia">Residencia</option>
                                </select><br/><br/>
                               
                                ¿Puede tomar paracetamol?<br/><br/>
                                <input type="radio" name="paracetamol" value="si">Si<br/>
                                <input type="radio" name="paracetamol" value="no">No<br/><br/>
								 ¿Control de glucosa?<br/><br/>
                                <input type="radio" name="glucosa" value="si">Si<br/>
                                <input type="radio" name="glucosa" value="no">No<br/><br/>
                              
                                Alergias:<br/><br/>
                                <textarea name="alergias" rows="4" cols="30"></textarea><br/><br/>
                                <button type="submit">Enviar</button>&nbsp;&nbsp;
			        <button type="reset">Borrar</button>
                                

                        </form>
                
                        
                </section>
                
        </body>
</html>