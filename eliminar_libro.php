<?php
include 'conexion.php';

$nombre=$_POST["nombre"];

//$temas=$_POST["temas"]; 


$verificar_libro = mysqli_query($conexion, "SELECT * FROM libro WHERE Nombre = '$nombre'");

if(mysqli_num_rows($verificar_libro)>0){
	$libro_delete = "DELETE FROM libro WHERE Nombre='$nombre'";

	$resultado=mysqli_query($conexion,$libro_delete); 
	if (!$resultado) {
		echo '<script>
		  alert("Error al eliminar en la BD");
		  </script>';

	}else{


		echo '<script>
		  confirm("El libro se ha eliminado");
		  </script>';
		
	}	
	
}else{
	echo '<script>
		  alert("El libro no existe");
		  window.history.go(-1);
		  </script>'; 
	
}
mysqli_close($conexion); 

?>