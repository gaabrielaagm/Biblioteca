<?php
    include 'conexion.php';

    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $nacion=$_POST["nacion"];

    $insert="INSERT INTO autor (Nombre,Apellido,Nacionalidad) VALUES ('$nombre','$apellido','$nacion')";
    mysqli_query($conexion,$insert);
    mysqli_close($conexion);
?>