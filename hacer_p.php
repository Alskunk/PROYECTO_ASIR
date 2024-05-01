<?php
session_start();
if (empty($_SESSION["profesional_id"])) {
        header("location: login.php");
}
include "modelo/conexion.php";
$ID=$_GET['medicacion_id'];

$consulta = "SELECT U.Nombre, U.Primer_apellido, M.usuario_id, M.Medicamento, M.medicacion_id
                        FROM USUARIOS U  JOIN MEDICAMENTO M ON M.usuario_id = U.usuario_id  
                        WHERE M.medicacion_id= '$ID'";
                        $resultado = mysqli_query($conexion, $consulta);
                        $fila = mysqli_fetch_assoc($resultado);
$usuario_id = $fila['usuario_id'];
$usuario = $fila['Nombre'];
$apellido = $fila['Primer_apellido'];
$medica = $fila['Medicamento'];
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
                        $insertar="INSERT INTO PEDIDOS (medicacion_id, usuario_id, fecha_pedido)
                        values ('$ID', '$usuario_id', CURDATE())";
                        $datos = mysqli_query($conexion, $insertar);
                            
                            
                                use PHPMailer\PHPMailer\PHPMailer;
                                use PHPMailer\PHPMailer\Exception;

                                require 'PHPMailer/Exception.php';
                                require 'PHPMailer/PHPMailer.php';
                                require 'PHPMailer/SMTP.php';

                                $mail = new PHPMailer(true);

                                try {
                                        
                                        $mail->SMTPDebug = 0;                                       
                                        $mail->isSMTP();                                            
                                        $mail->Host       = 'smtp.gmail.com';                       
                                        $mail->SMTPAuth   = true;                                   
                                        $mail->Username   = 'alskunkproyecto@gmail.com';           
                                        $mail->Password   = 'whmnzmdzqhheghwb';                         
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                                        $mail->Port       = 465;                                    																						

                              
                                $mail->setFrom('alskunkproyecto@gmail.com', 'Alvaro');
								$mail->addAddress('zinjasalvaro@gmail.com', 'Alvaro');
                                $mail->addAddress('alvarosaez@asprodema.org', 'Alvaro');     
                               

                                

                                
                                $mail->isHTML(true);                                 
                                $mail->Subject = 'Pedido de medicacion';
                                $mail->Body    = "El usuario $usuario  $apellido 
                                debe traer la medicación:  $medica";
                                

                                $mail->send();
                                        echo "<div class='bloque1'>";
                                        echo "<div class='contenedor1'>";       
                                        echo("PEDIDO REALIZADO");
                                        echo "</div>";
                                        echo "</div>";
                                                } catch (Exception $e) {
                                        echo "El correo no se ha podido enviar: {$mail->ErrorInfo}";
                                        }


                            

                    

            
                mysqli_close($conexion);
            ?>
                
                
               
        </section>
               
        </body>
</hmtl>