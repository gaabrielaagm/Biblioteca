<?php

include 'conexion.php';
$id_usr=$_POST["usuario"];
$id_libro=$_POST["libro"];

$verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE Id_usuario = '$id_usr'" );

$verificar_libro= mysqli_query($conexion,"SELECT * FROM libro WHERE Id_libro = '$id_libro'" );

$prestamo= mysqli_query($conexion,"SELECT * FROM prestamo WHERE Id_libro = '$id_libro'" );

$row=mysqli_fetch_array($prestamo);
$prestamo=$row["Disponibles"];
echo("Prestamo: ".$prestamo);


if($prestamo>0){
	if (mysqli_num_rows($verificar_usuario)>0 and mysqli_num_rows($verificar_libro)>0 ){

		while($row=mysqli_fetch_assoc($prestamo)){
			echo "Id prestamo: " .$row["Id_prestamo"]. " Id libro: " .$row["Id_libro"]. " Id usuario: " .$row["Id_usuario"]. "Fecha prestamo: " .$row["Fecha_prestamo"]. "Fecha devolucion: " .$row["Fecha_devolucion"]. " Estado: " .$row["Estado"]. "<br>";
		}





	}else{
		echo '<script>
			  alert("Datos no encontrados");
			  </script>';
	}

}else{
	echo '<script>
		  alert("No hay prestamos");
		  </script>';
}
mysqli_close($conexion);
?>