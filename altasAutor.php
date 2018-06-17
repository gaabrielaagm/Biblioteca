<?php
    include 'conexion.php';

    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $nacion=$_POST["nacion"];

    $verificar_autor = mysqli_query($conexion,"SELECT * FROM autor WHERE nombre='$nombre' AND apellido='$apellido';" );
    if (mysqli_num_rows($verificar_autor)>0){
        echo '<script>
		        alert("Autor ya existe");
		        window.history.go(-1);
		     </script>';
    }else{
        $insert="INSERT INTO autor (Nombre,Apellido,Nacionalidad) VALUES ('$nombre','$apellido','$nacion')";
        mysqli_query($conexion,$insert);
        mysqli_close($conexion);
        echo '<script>
		        alert("Autor Registrado");
		        window.history.go(-1);
		     </script>'; 
    }
?>