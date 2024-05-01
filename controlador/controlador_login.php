<?php
session_start();
if (!empty($_POST["ingresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];
        $sql=$conexion->query("select * from PROFESIONALES where Nombre='$usuario' and Contrasena='$password' ");
        if ($datos=$sql->fetch_object()) {
            $_SESSION["profesional_id"]=$datos->profesional_id;
            $_SESSION["Nombre"]=$datos->Nombre;
            $_SESSION["Primer_apellido"]=$datos->Primer_apellido;
            
            header("location: inicio.php");
        } else {
            echo "<div>Acceso denegado</div>";
        }
        
     } else {
        echo "Campos vacios";
        
    }
}
?>